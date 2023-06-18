<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    //getAllCategories
	public function getAllCategories()
	{
		$categories = Category::all();
		return response()->json($categories);
	}

	//getCategoryById
	public function getCategoryById($id)
	{
		$category = Category::find($id);
		if(is_null($category)){
			return response()->json(['message' => 'Category Not Found'], 404);
		}
		return response()->json($category);
	}

	//addCategory
	public function addCategory(Request $request)
	{
		$category = Category::create($request->all());
		return response($category, 201);
	}

	//updateCategory
	public function updateCategory(Request $request, $id)
	{
		$category = Category::find($id);
		if(is_null($category)){
			return response()->json(['message' => 'Category Not Found'], 404);
		}
		$category->update($request->all());
		return response($category, 200);
	}

	//deleteCategory
	public function deleteCategory($id)
	{
		$category = Category::find($id);
		if(is_null($category)){
			return response()->json(['message' => 'Category Not Found'], 404);
		}
		$category->delete();
		return response()->json(null, 204);
	}
}
