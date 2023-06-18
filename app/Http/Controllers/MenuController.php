<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class MenuController extends Controller
{
    // getAllMenus
	public function getAllMenus()
	{
		$menus = Menu::all();
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
		if(is_null($menu)){
			return response()->json(['message' => 'Menu Not Found'], 404);
		}
		$menu->delete();
		return response()->json(null, 204);
	}
}
