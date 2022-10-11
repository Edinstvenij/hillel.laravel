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

//  Category
Route::get('/admin/category', [AdminController::class, 'category'])->name('adminCategory');
Route::get('/admin/category/create', [AdminController::class, 'categoryCreate'])->name('adminCategoryCreate');
Route::post('/admin/category/store', [AdminController::class, 'categoryStore'])->name('adminCategoryStore');
Route::get('/admin/category/edit/{id}', [AdminController::class, 'categoryEdit'])->name('adminCategoryEdit');
Route::post('/admin/category/update', [AdminController::class, 'categoryUpdate'])->name('adminCategoryUpdate');
Route::get('/admin/category/delete/{id}', [AdminController::class, 'categoryDelete'])->name('adminCategoryDelete');
Route::get('/admin/category/trash', [AdminController::class, 'categoryTrash'])->name('adminCategoryTrash');
Route::get('/admin/category/restore/{id}', [AdminController::class, 'categoryRestore'])->name('adminCategoryRestore');
Route::get('/admin/category/forceDelete/{id}', [AdminController::class, 'categoryForceDelete'])->name('adminCategoryForceDelete');

// Tag
Route::get('/admin/tag', [AdminController::class, 'tag'])->name('adminTag');
Route::get('/admin/tag/create', [AdminController::class, 'tagCreate'])->name('adminTagCreate');
Route::post('/admin/tag/store', [AdminController::class, 'tagStore'])->name('adminTagStore');
Route::get('/admin/tag/edit/{id}', [AdminController::class, 'tagEdit'])->name('adminTagEdit');
Route::post('/admin/tag/update', [AdminController::class, 'tagUpdate'])->name('adminTagUpdate');
Route::get('/admin/tag/delete/{id}', [AdminController::class, 'tagDelete'])->name('adminTagDelete');
Route::get('/admin/tag/trash', [AdminController::class, 'tagTrash'])->name('adminTagTrash');
Route::get('/admin/tag/restore/{id}', [AdminController::class, 'tagRestore'])->name('adminTagRestore');
Route::get('/admin/tag/forceDelete/{id}', [AdminController::class, 'tagForceDelete'])->name('adminTagForceDelete');

//  Post
Route::get('/admin/post', [AdminController::class, 'post'])->name('adminPost');
Route::get('/admin/post/create', [AdminController::class, 'postCreate'])->name('adminPostCreate');
Route::post('/admin/post/store', [AdminController::class, 'postStore'])->name('adminPostStore');
Route::get('/admin/post/edit/{id}', [AdminController::class, 'postEdit'])->name('adminPostEdit');
Route::post('/admin/post/update', [AdminController::class, 'postUpdate'])->name('adminPostUpdate');
Route::get('/admin/post/delete/{id}', [AdminController::class, 'postDelete'])->name('adminPostDelete');
Route::get('/admin/post/trash', [AdminController::class, 'postTrash'])->name('adminPostTrash');
Route::get('/admin/post/restore/{id}', [AdminController::class, 'postRestore'])->name('adminPostRestore');
Route::get('/admin/post/forceDelete/{id}', [AdminController::class, 'postForceDelete'])->name('adminPostForceDelete');

