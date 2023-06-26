<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\MenuHasCategory;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    // getAllMenus
	public function getAllMenus()
	{
		$menus = Menu::orderBy('created_at', 'desc')->get();
		return response()->json($menus);
	}

	// getAllMenusWithCategory
	public function getAllMenusWithCategory()
	{
		$menus = Menu::orderBy('created_at', 'desc')->get();
		foreach ($menus as $menu) {
			$menuHasCategory = MenuHasCategory::where('menu_id', $menu->id)->get();
			$categories = collect();
			foreach ($menuHasCategory as $menua) {
				$category = Category::find($menua->category_id);
				$categories->push($category);
			}
			// Attach Categories directly to the menu
			$menu->categories = $categories;
		}
	
		return response()->json($menus);
	}

	// getAllMenusPublishedWithCategory
	public function getAllMenusPublishedWithCategory()
	{
		$menus = Menu::where('published', 1)->get();
		foreach ($menus as $menu) {
			$menuHasCategory = MenuHasCategory::where('menu_id', $menu->id)->get();
			$categories = collect();
			foreach ($menuHasCategory as $menua) {
				$category = Category::find($menua->category_id);
				$categories->push($category);
			}
			// Attach Categories directly to the menu
			$menu->categories = $categories;
		}
	
		return response()->json($menus);
	}

	//getAllMenusPublished
	public function getAllMenusPublished()
	{
		$menus = Menu::where('published', 1)->get();
		return response()->json($menus);
	}

	// getMenuById
	public function getMenuById($id)
	{
		$menu = Menu::find($id);
		if(is_null($menu)){
			return response()->json(['message' => 'Menu Not Found'], 404);
		}
		return response()->json($menu);
	}

	// getMenuByIdWithCategory
	public function getMenuByIdWithCategory($id)
	{
		$menu = Menu::find($id);
		if(is_null($menu)){
			return response()->json(['message' => 'Menu Not Found'], 404);
		}
		$menuHasCategory = MenuHasCategory::where('menu_id', $menu->id)->get();
		$categories = collect();
		foreach ($menuHasCategory as $menua) {
			$category = Category::find($menua->category_id);
			$categories->push($category);
		}
		// Attach Categories directly to the menu
		$menu->categories = $categories;
	
		return response()->json($menu);
	}

	// addMenu
	public function addMenu(Request $request)
	{
		$data = $request->all(); // get all data from the request

		// If there's an image
		if ($request->hasFile('url_img')) {
			$file = $request->file('url_img');
			$extension = $file->getClientOriginalExtension(); // get image extension
			$filename = time() . '.' . $extension; // rename image
			$file->move('img/menu/', $filename); // move image to appropriate directory
			$url = '/img/menu/' . $filename;
			$data['url_img'] = $url; // update the url_img in the data array
		} else {
			$data['url_img'] = '/img/menu/default.png'; // set the default url_img
		}

		$menu = Menu::create($data); // create the menu with the updated data

		// Add Categories to the menu
		$menuHasCategory = $request->categories;

		if($menuHasCategory) {
			foreach ($menuHasCategory as $categoryId) {
				$menuHasCategory = new MenuHasCategory();
				$menuHasCategory->menu_id = $menu->id;
				$menuHasCategory->category_id = $categoryId;
				$menuHasCategory->save();
			}
		}

		return response($menu, 201);
	}

	// updateMenu
	public function updateMenu(Request $request, $id)
	{
		// Find the menu using id, if not found return a 404 message
		$menu = Menu::find($id);
		if(is_null($menu)){
			return response()->json(['message' => 'Menu Not Found'], 404);
		}

		// Check if the request contains an image
		if ($request->hasFile('url_img')) {
			// Delete the old image
			$oldImage = str_replace('/img/menu', '', $menu->url_img);
			if(Storage::exists('img/menu' . $oldImage)) {
				Storage::delete('img/menu' . $oldImage);
			}

			$file = $request->file('url_img');
			$extension = $file->getClientOriginalExtension(); // get image extension
			$filename = time() . '.' . $extension; // rename image
			$file->move('img/menu/', $filename); // move image to appropriate directory
			$url = '/img/menu/' . $filename;
			$menu->url_img = $url; // set the url_img attribute directly on the $menu object
			$menu->save(); // save the menu to store the updated image url
		}

		$menu->update($request->except('url_img', 'categories')); // exclude 'url_img' and 'categories' from the request data, because we've already handled it

		// Delete all categories from the menu
		$menuHasCategory = MenuHasCategory::where('menu_id', $menu->id)->get();
		foreach ($menuHasCategory as $menuCategory) {
			$menuCategory->delete();
		}

		// Add new categories to the menu
		if($request->has('categories')) {
			$newCategories = $request->categories;
			foreach ($newCategories as $categoryId) {
				$menuHasCategory = new MenuHasCategory();
				$menuHasCategory->menu_id = $menu->id;
				$menuHasCategory->category_id = $categoryId;
				$menuHasCategory->save();
			}
		}
		return response()->json($menu, 200);
	}

	// deleteMenu
	public function deleteMenu($id)
	{
		$menu = Menu::find($id);
		$menuHasCategory = MenuHasCategory::where('menu_id', $id)->get();
		if(is_null($menu)){
			return response()->json(['message' => 'Menu Not Found'], 404);
		}
		foreach ($menuHasCategory as $menua) {
			$menua->delete();
		}
		$menu->delete();
		return response()->json(null, 204);
	}
}
