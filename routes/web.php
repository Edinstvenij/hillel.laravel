<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\HomeController;
use \App\Http\Controllers\AuthorController;
use \App\Http\Controllers\CategoryController;
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

Route::get('/', [HomeController::class, 'index']);

Route::get('/author/{authorId}', [AuthorController::class, 'index']);
Route::get('/author/{authorId}/category/{categoryId}', [AuthorController::class, 'category']);

Route::get('/category/{categoryId}', [CategoryController::class, 'index']);
