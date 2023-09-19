<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin/dashboard', [App\Http\Controllers\AdminController::class, 'index'])->middleware('auth','admin');
Route::get('/client/dashboard', [App\Http\Controllers\ClientController::class, 'index']);
Route::get('/admin/category', [App\Http\Controllers\CategoryController::class, 'list'])->middleware('auth','admin');;
Route::post('/admin/category/add', [App\Http\Controllers\CategoryController::class, 'add'])->middleware('auth','admin');;
Route::get('/admin/category/{id}/destroy', [App\Http\Controllers\CategoryController::class, 'destroy'])->middleware('auth','admin');;
Route::post('/admin/category/update', [App\Http\Controllers\CategoryController::class, 'update'])->middleware('auth','admin');;

// Products Route //

Route::get('/admin/dashboard', [App\Http\Controllers\AdminController::class, 'index'])->middleware('auth','admin');
Route::get('/client/dashboard', [App\Http\Controllers\ClientController::class, 'index']);
Route::get('/admin/product', [App\Http\Controllers\ProductController::class, 'list'])->middleware('auth','admin');;
Route::post('/admin/product/add', [App\Http\Controllers\ProductController::class, 'add'])->middleware('auth','admin');;
Route::get('/admin/product/{id}/destroy', [App\Http\Controllers\ProductController::class, 'destroy'])->middleware('auth','admin');;
Route::post('/admin/product/update', [App\Http\Controllers\ProductController::class, 'update'])->middleware('auth','admin');;




