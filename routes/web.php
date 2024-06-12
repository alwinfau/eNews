<?php

use App\Http\Controllers\BeritaController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/' , [FrontController::class, 'index'])->name('frontapp');
Route::get('/sort-by-categories/{slug_categoryname}', [FrontController::class ,'getCategories'])->name('getCategories');

Auth::routes();

Route::get('/dashboard-admin', [HomeController::class, 'index'])->name('dashboard');

// Routing untuk categories
Route::get('categories', [CategoriesController::class, 'index'])->name('categories');
Route::get('add-categories', [CategoriesController::class, 'create'])->name('add-categories');
Route::post('post-categories', [CategoriesController::class, 'store'])->name('post-categories');
Route::get('udpate-category/{slug_categoryname}',[CategoriesController::class,'edit'])->name('edit-category');
Route::put('udpate-categories/{slug_categoryname}', [CategoriesController::class, 'update'])->name('udpate-categories');
Route::delete('delete-categories/{slug_categoryname}', [CategoriesController::class, 'destory'])->name('delete-categories');

Route::get('berita', [BeritaController::class, 'index'])->name('berita');
Route::get('add-berita', [BeritaController::class, 'create'])->name('add-berita');
Route::post('post-berita', [BeritaController::class, 'store'])->name('post-berita');

// code to update data news
Route::get('edit/berita/{slug_title}', [BeritaController::class, 'edit'])->name('edit-berita');
Route::post('update/berita/{slug_title}', [BeritaController::class, 'update'])->name('update-berita');
Route::delete('delete/berita/{slug_title}', [BeritaController::class, 'destroy'])->name('delete-berita');

