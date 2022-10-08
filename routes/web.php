<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\HomeController;
use \App\Http\Controllers\AuthorController;
use \App\Http\Controllers\CategoryController;
use \App\Http\Controllers\TagController;
use \App\Http\Controllers\AdminController;

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

/**
 *  Home page
 */
Route::get('/', [HomeController::class, 'index']);

/**
 *  block Author page
 */
Route::get('/author/{authorId}', [AuthorController::class, 'index'])->name('author');
Route::get('/author/{authorId}/category/{categoryId}', [AuthorController::class, 'category'])->name('authorCategory');
Route::get('/author/{authorId}/category/{categoryId}/tag/{tagId}', [AuthorController::class, 'categoryTag'])->name('authorCategoryTag');

/**
 *  block Category page
 */
Route::get('/category/{categoryId}', [CategoryController::class, 'index'])->name('category');

/**
 *  block Tag page
 */
Route::get('/tag/{tagId}', [TagController::class, 'index'])->name('tag');

/**
 *  block Admin
 */
Route::get('/admin', [AdminController::class, 'index'])->name('admin');

Route::get('/admin/category', [AdminController::class, 'category'])->name('adminCategory');


Route::get('/admin/post', [AdminController::class, 'post'])->name('adminPost');


Route::get('/admin/tag', [AdminController::class, 'tag'])->name('adminTag');

