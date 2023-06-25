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
		// If there's an image
		if ($request->hasFile('url_img')) {
			$file = $request->file('url_img');
			$extension = $file->getClientOriginalExtension(); // get image extension
			$filename = $request->id . '.' . $extension; // rename image
			$file->move('img/menu/', $filename); // move image to appropriate directory
			$request->merge(['url_img' => '/img/menu/' . $filename]); // set the url_img attribute
		}

		$menu = Menu::create($request->all());

		$categories = $request->categories;
		foreach ($categories as $category) {
			$menuHasCategory = new MenuHasCategory();
			$menuHasCategory->menu_id = $menu->id;
			$menuHasCategory->category_id = $category['id'];
			$menuHasCategory->save();
		}
		return response($menu, 201);
	}

	// updateMenu
	public function updateMenu(Request $request, $id)
	{
		$menu = Menu::find($id);
		if(is_null($menu)){
			return response()->json(['message' => 'Menu Not Found'], 404);
		}

		// If there's an image
		if ($request->hasFile('url_img')) {
			// Delete the old image
			$oldImage = str_replace('/storage', '', $menu->url_img);
			Storage::delete('/public' . $oldImage);

			$file = $request->file('url_img');
			$extension = $file->getClientOriginalExtension(); // get image extension
			$filename = $request->id . '.' . $extension; // rename image
			$path = $file->storeAs('public/img/menu', $filename); // move image to appropriate directory
			$url = Storage::url($path);
			$request->merge(['url_img' => $url]); // set the url_img attribute
		}

		$menu->update($request->all());

		// Delete all categories from the menu
		$menuHasCategory = MenuHasCategory::where('menu_id', $menu->id)->get();
		foreach ($menuHasCategory as $menua) {
			$menua->delete();
		}

		// Add Categories to the menu
		$menuHasCategory = $request->categories;
		foreach ($menuHasCategory as $menua) {
			$menuHasCategory = new MenuHasCategory();
			$menuHasCategory->menu_id = $menu->id;
			$menuHasCategory->category_id = $menua['id'];
			$menuHasCategory->save();
		}
		return response($menu, 200);
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
