<?php

use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminPostController;
use App\Http\Controllers\Admin\AdminTagController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OauthGithubController;

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
Route::get('/', [HomeController::class, 'index'])->name('main');

/**
 *
 */
Route::get('/posts/show/{id}', [HomeController::class, 'show'])->name('postShow');
Route::post('/posts/addRating', [HomeController::class, 'addRating'])->name('postAddRating');

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
 *  block Auth
 */
Route::get('oauth/github/callback', [OauthGithubController::class, 'callback'])->name('oauthGithub');
Route::middleware(['guest'])->group(function () {
    Route::get('auth/login', [AuthController::class, 'login'])->name('authLogin');
    Route::post('auth/handleLogin', [AuthController::class, 'handleLogin'])->name('authHandleLogin');
});
Route::get('auth/logout', [AuthController::class, 'logout'])->name('authLogout')->middleware('auth');

/**
 *  block Admin
 */
Route::middleware(['auth'])->group(function () {

    Route::get('/admin', [AdminController::class, 'index'])->name('admin');

    //  Category
    Route::get('/admin/category', [AdminCategoryController::class, 'index'])->name('adminCategory');
    Route::get('/admin/category/create', [AdminCategoryController::class, 'create'])->name('adminCategoryCreate');
    Route::post('/admin/category/store', [AdminCategoryController::class, 'store'])->name('adminCategoryStore');
    Route::get('/admin/category/edit/{id}', [AdminCategoryController::class, 'edit'])->name('adminCategoryEdit');
    Route::post('/admin/category/update', [AdminCategoryController::class, 'update'])->name('adminCategoryUpdate');
    Route::get('/admin/category/delete/{id}', [AdminCategoryController::class, 'delete'])->name('adminCategoryDelete');
    Route::get('/admin/category/trash', [AdminCategoryController::class, 'trash'])->name('adminCategoryTrash');
    Route::get('/admin/category/restore/{id}', [AdminCategoryController::class, 'restore'])->name('adminCategoryRestore');
    Route::get('/admin/category/forceDelete/{id}', [AdminCategoryController::class, 'forceDelete'])->name('adminCategoryForceDelete');

    // Tag
    Route::get('/admin/tag', [AdminTagController::class, 'index'])->name('adminTag');
    Route::get('/admin/tag/create', [AdminTagController::class, 'create'])->name('adminTagCreate');
    Route::post('/admin/tag/store', [AdminTagController::class, 'store'])->name('adminTagStore');
    Route::get('/admin/tag/edit/{id}', [AdminTagController::class, 'edit'])->name('adminTagEdit');
    Route::post('/admin/tag/update', [AdminTagController::class, 'update'])->name('adminTagUpdate');
    Route::get('/admin/tag/delete/{id}', [AdminTagController::class, 'delete'])->name('adminTagDelete');
    Route::get('/admin/tag/trash', [AdminTagController::class, 'trash'])->name('adminTagTrash');
    Route::get('/admin/tag/restore/{id}', [AdminTagController::class, 'restore'])->name('adminTagRestore');
    Route::get('/admin/tag/forceDelete/{id}', [AdminTagController::class, 'forceDelete'])->name('adminTagForceDelete');

    //  Post
    Route::get('/admin/post', [AdminPostController::class, 'index'])->name('adminPost');
    Route::get('/admin/post/create', [AdminPostController::class, 'create'])->name('adminPostCreate');
    Route::post('/admin/post/store', [AdminPostController::class, 'store'])->name('adminPostStore')->can('create');
    Route::get('/admin/post/edit/{id}', [AdminPostController::class, 'edit'])->name('adminPostEdit');
    Route::post('/admin/post/update', [AdminPostController::class, 'update'])->name('adminPostUpdate');
    Route::get('/admin/post/delete/{id}', [AdminPostController::class, 'delete'])->name('adminPostDelete');
    Route::get('/admin/post/trash', [AdminPostController::class, 'trash'])->name('adminPostTrash');
    Route::get('/admin/post/restore/{id}', [AdminPostController::class, 'restore'])->name('adminPostRestore');
    Route::get('/admin/post/forceDelete/{id}', [AdminPostController::class, 'forceDelete'])->name('adminPostForceDelete');

});
