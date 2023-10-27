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

Route::get('/', [App\Http\Controllers\GuestController::class, 'home']);
Route::get('/product/details/{id}', [App\Http\Controllers\GuestController::class, 'details']);
Route::get('/product/shop/{id_cat}', [App\Http\Controllers\GuestController::class, 'shop']);
Route::post('/product/search', [App\Http\Controllers\GuestController::class, 'search']);





Auth::routes();

//Client Routes

Route::get('/client/dashboard', [App\Http\Controllers\ClientController::class, 'index'])->middleware('auth','active');
Route::get('/client/commandes', [App\Http\Controllers\ClientController::class, 'mesCommande'])->middleware('auth','active');
Route::get('/client/profile', [App\Http\Controllers\ClientController::class, 'profile'])->middleware('auth','active');
Route::post('/client/profile/edit', [App\Http\Controllers\ClientController::class, 'EditProfile'])->middleware('auth');
Route::post('/client/review/store', [App\Http\Controllers\ClientController::class, 'AddReview'])->middleware('auth');
Route::post('/client/order/store', [App\Http\Controllers\CommandeController::class, 'AddCommand'])->middleware('auth');
Route::get('/client/cart', [App\Http\Controllers\ClientController::class, 'cart'])->middleware('auth');
Route::get('/client/lc/{idlc}/destroy', [App\Http\Controllers\CommandeController::class, 'lcDestroy'])->middleware('auth');
Route::post('/client/checkout', [App\Http\Controllers\ClientController::class, 'checkout'])->middleware('auth');




// Admin Routes

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin/dashboard', [App\Http\Controllers\AdminController::class, 'index'])->middleware('auth','admin');
Route::get('/admin/clients', [App\Http\Controllers\AdminController::class, 'clients'])->middleware('auth','admin');
Route::get('/admin/clients/{id}/block', [App\Http\Controllers\AdminController::class, 'block'])->middleware('auth','admin');
Route::get('/admin/clients/{id}/active', [App\Http\Controllers\AdminController::class, 'active'])->middleware('auth','admin');
Route::get('/admin/profile', [App\Http\Controllers\AdminController::class, 'profile'])->middleware('auth','admin');
Route::post('/admin/profile/edit', [App\Http\Controllers\AdminController::class, 'EditProfile'])->middleware('auth','admin');
Route::get('/admin/category', [App\Http\Controllers\CategoryController::class, 'list'])->middleware('auth','admin');;
Route::post('/admin/category/add', [App\Http\Controllers\CategoryController::class, 'add'])->middleware('auth','admin');;
Route::get('/admin/category/{id}/destroy', [App\Http\Controllers\CategoryController::class, 'destroy'])->middleware('auth','admin');;
Route::post('/admin/category/update', [App\Http\Controllers\CategoryController::class, 'update'])->middleware('auth','admin');;

// Products Route //

Route::get('/admin/dashboard', [App\Http\Controllers\AdminController::class, 'index'])->middleware('auth','admin');
Route::get('/admin/product', [App\Http\Controllers\ProductController::class, 'list'])->middleware('auth','admin');;
Route::post('/admin/product/add', [App\Http\Controllers\ProductController::class, 'add'])->middleware('auth','admin');;
Route::get('/admin/product/{id}/destroy', [App\Http\Controllers\ProductController::class, 'destroy'])->middleware('auth','admin');;
Route::post('/admin/product/update', [App\Http\Controllers\ProductController::class, 'update'])->middleware('auth','admin');;
Route::get('/admin/commandes', [App\Http\Controllers\AdminController::class, 'commandes'])->middleware('auth','admin');
Route::post('/admin/product/search', [App\Http\Controllers\ProductController::class, 'search'])->middleware('auth','admin');




Route::get('/client/bloquer', [App\Http\Controllers\ClientController::class, 'messageBlock'])->name('auth');
