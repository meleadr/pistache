<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\MenuHasCategory;
use App\Models\Category;

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
		$menu = Menu::create($request->all());
		return response($menu, 201);
	}

	// updateMenu
	public function updateMenu(Request $request, $id)
	{
		$menu = Menu::find($id);
		if(is_null($menu)){
			return response()->json(['message' => 'Menu Not Found'], 404);
		}
		$menu->update($request->all());
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
