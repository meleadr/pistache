<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MenuHasCategoryController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// route for menu CRUD operations
Route::controller(MenuController::class)->group(function () {
	Route::get('/menus', 'getAllMenus');
	Route::get('/menusPublished', 'getAllMenusPublished');
	Route::get('/menus/{id}', 'getMenuById');
	Route::post('/menus', 'addMenu');
	Route::put('/menus/{id}', 'updateMenu');
	Route::delete('/menus/{id}', 'deleteMenu');
});

// route for category CRUD operations
Route::controller(CategoryController::class)->group(function () {
	Route::get('/categories', 'getAllCategories');
	Route::get('/categories/{id}', 'getCategoryById');
	Route::post('/categories', 'addCategory');
	Route::put('/categories/{id}', 'updateCategory');
	Route::delete('/categories/{id}', 'deleteCategory');
});

// route for menuHasCategory CRUD operations
Route::controller(MenuHasCategoryController::class)->group(function () {
	Route::get('/menuHasCategory', 'getAllMenuHasCategories');
	Route::get('/menuHasCategory/{id}', 'getMenuHasCategoryById');
	Route::post('/menuHasCategory', 'addMenuHasCategory');
	Route::put('/menuHasCategory/{id}', 'updateMenuHasCategory');
	Route::delete('/menuHasCategory/{id}', 'deleteMenuHasCategory');
});
