<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('accueil');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard/menu', function () {
	return Inertia::render('Menu/AllMenu');
})->middleware(['auth', 'verified'])->name('menu.index');

Route::get('/dashboard/menu/add', function () {
	return Inertia::render('Menu/MenuForm');
})->middleware(['auth', 'verified'])->name('menu.add');

Route::get('/dashboard/menu/edit/{id}', function () {
	return Inertia::render('Menu/MenuForm');
})->middleware(['auth', 'verified'])->name('menu.edit');

// category
Route::get('/dashboard/categorie', function () {
	return Inertia::render('Categorie/AllCategorie');
})->middleware(['auth', 'verified'])->name('categorie.index');

Route::get('/dashboard/categorie/add', function () {
	return Inertia::render('Categorie/CategorieForm');
})->middleware(['auth', 'verified'])->name('categorie.add');

Route::get('/dashboard/categorie/edit/{id}', function () {
	return Inertia::render('Categorie/CategorieForm');
})->middleware(['auth', 'verified'])->name('categorie.edit');

Route::get('/menu', function () {
	return Inertia::render('Menu');
})->name('menu');

Route::get('/about', function () {
	return Inertia::render('About');
})->name('about');

Route::get('/contact', function () {
	return Inertia::render('Contact');
})->name('contact');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
