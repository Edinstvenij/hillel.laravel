<?php

use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminPostController;
use App\Http\Controllers\Admin\AdminTagController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\OauthGithubController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\GeoIpController;
use Dcblogdev\Dropbox\Facades\Dropbox;

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
Route::prefix('/posts')->group(function () {

    Route::get('/show/{id}', [HomeController::class, 'show'])->name('postShow');
    Route::post('/addRating', [HomeController::class, 'addRating'])->name('postAddRating');
});
/**
 *  block Author page
 */
Route::prefix('/author')->group(function () {

    Route::get('/{authorId}', [AuthorController::class, 'index'])->name('author');
    Route::get('/{authorId}/category/{categoryId}', [AuthorController::class, 'category'])->name('authorCategory');
    Route::get('/{authorId}/category/{categoryId}/tag/{tagId}', [AuthorController::class, 'categoryTag'])->name('authorCategoryTag');
});

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
Route::middleware(['guest'])->prefix('/auth')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('authLogin');
    Route::post('/handleLogin', [AuthController::class, 'handleLogin'])->name('authHandleLogin');
});
Route::get('auth/logout', [AuthController::class, 'logout'])->name('authLogout')->middleware('auth');

/**
 *  block Admin
 */
Route::get('/geo', [GeoIpController::class, 'index']);

Route::middleware(['auth'])->prefix('/admin')->group(function () {

    Route::get('', [AdminController::class, 'index'])->name('admin');

    //  Category
    Route::prefix('/category')->group(function () {

        Route::get('', [AdminCategoryController::class, 'index'])->name('adminCategory');
        Route::get('/create', [AdminCategoryController::class, 'create'])->name('adminCategoryCreate');
        Route::post('/store', [AdminCategoryController::class, 'store'])->name('adminCategoryStore');
        Route::get('/edit/{id}', [AdminCategoryController::class, 'edit'])->name('adminCategoryEdit');
        Route::post('/update', [AdminCategoryController::class, 'update'])->name('adminCategoryUpdate');
        Route::get('/delete/{id}', [AdminCategoryController::class, 'delete'])->name('adminCategoryDelete');
        Route::get('/trash', [AdminCategoryController::class, 'trash'])->name('adminCategoryTrash');
        Route::get('/restore/{id}', [AdminCategoryController::class, 'restore'])->name('adminCategoryRestore');
        Route::get('/forceDelete/{id}', [AdminCategoryController::class, 'forceDelete'])->name('adminCategoryForceDelete');
    });

    // Tag
    Route::prefix('/tag')->group(function () {

        Route::get('', [AdminTagController::class, 'index'])->name('adminTag');
        Route::get('/create', [AdminTagController::class, 'create'])->name('adminTagCreate');
        Route::post('/store', [AdminTagController::class, 'store'])->name('adminTagStore');
        Route::get('/edit/{id}', [AdminTagController::class, 'edit'])->name('adminTagEdit');
        Route::post('/update', [AdminTagController::class, 'update'])->name('adminTagUpdate');
        Route::get('/delete/{id}', [AdminTagController::class, 'delete'])->name('adminTagDelete');
        Route::get('/trash', [AdminTagController::class, 'trash'])->name('adminTagTrash');
        Route::get('/restore/{id}', [AdminTagController::class, 'restore'])->name('adminTagRestore');
        Route::get('/forceDelete/{id}', [AdminTagController::class, 'forceDelete'])->name('adminTagForceDelete');
    });

    //  Post
    Route::prefix('/post')->group(function () {

        Route::get('', [AdminPostController::class, 'index'])->name('adminPost');
        Route::get('/create', [AdminPostController::class, 'create'])->name('adminPostCreate');
        Route::post('/store', [AdminPostController::class, 'store'])->name('adminPostStore')->can('create');
        Route::get('/edit/{id}', [AdminPostController::class, 'edit'])->name('adminPostEdit');
        Route::post('/update', [AdminPostController::class, 'update'])->name('adminPostUpdate');
        Route::get('/delete/{id}', [AdminPostController::class, 'delete'])->name('adminPostDelete');
        Route::get('/trash', [AdminPostController::class, 'trash'])->name('adminPostTrash');
        Route::get('/restore/{id}', [AdminPostController::class, 'restore'])->name('adminPostRestore');
        Route::get('/forceDelete/{id}', [AdminPostController::class, 'forceDelete'])->name('adminPostForceDelete');
    });
});

Route::group(['middleware' => ['web']], function () {

    Route::get('dropbox', [HomeController::class, 'test']);

    Route::get('dropbox/connect', function () {
        return Dropbox::connect();
    });

    Route::get('dropbox/disconnect', function () {
        return Dropbox::disconnect('app/dropbox');
    });
});
