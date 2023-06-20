<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuHasCategory;

class MenuHasCategoryController extends Controller
{
    // getAllMenuHasCategories
	public function getAllMenuHasCategories()
	{
		$menuHasCategories = MenuHasCategory::all();
		return response()->json($menuHasCategories);
	}

	// getMenuHasCategoryById
	public function getMenuHasCategoryById($id)
	{
		$menuHasCategory = MenuHasCategory::find($id);
		if(is_null($menuHasCategory)){
			return response()->json(['message' => 'MenuHasCategory Not Found'], 404);
		}
		return response()->json($menuHasCategory);
	}

	public function getMenuHasCategoryByMenuId($id)
	{
		$menuHasCategory = MenuHasCategory::where('menu_id', $id)->get();
		if(is_null($menuHasCategory)){
			return response()->json(['message' => 'MenuHasCategory Not Found'], 404);
		}
		return response()->json($menuHasCategory);
	}

	// addMenuHasCategory
	public function addMenuHasCategory(Request $request)
	{
		$menuHasCategory = MenuHasCategory::create($request->all());
		return response($menuHasCategory, 201);
	}

	// updateMenuHasCategory
	public function updateMenuHasCategory(Request $request, $id)
	{
		$menuHasCategory = MenuHasCategory::find($id);
		if(is_null($menuHasCategory)){
			return response()->json(['message' => 'MenuHasCategory Not Found'], 404);
		}
		$menuHasCategory->update($request->all());
		return response($menuHasCategory, 200);
	}

	// deleteMenuHasCategory
	public function deleteMenuHasCategory($id)
	{
		$menuHasCategory = MenuHasCategory::find($id);
		if(is_null($menuHasCategory)){
			return response()->json(['message' => 'MenuHasCategory Not Found'], 404);
		}
		$menuHasCategory->delete();
		return response()->json(null, 204);
	}
}
