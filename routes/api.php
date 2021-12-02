<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::resource('products','ProductController');

// List products
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// List products
Route::post('/productsFilter', [ProductController::class, 'Filter'])->name('products.Filter');

// List single products
Route::get('product/{id}', [ProductController::class, 'show'])->name('products.show');

// Create new products
Route::post('product', [ProductController::class, 'store'])->name('products.store');

// Update products
Route::put('product/{id}', [ProductController::class, 'update'])->name('products.update');

// Delete products
Route::delete('product/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

// List categories
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

// List single categories
Route::get('category/{id}', [CategoryController::class, 'show'])->name('categories.show');

// Create new categories
Route::post('category', [CategoryController::class, 'store'])->name('categories.store');

// Update categories
Route::put('category/{id}', [CategoryController::class, 'update'])->name('categories.update');

// Delete categories
Route::delete('category/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');