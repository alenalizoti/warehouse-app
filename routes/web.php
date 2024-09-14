<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['auth', 'role:storage'])->group(function () {
    Route::get('/add-product', [ProductController::class, 'add_product'])->name('add.product');
    Route::get('/create-product', [ProductController::class, 'create_product'])->name('create.product');
    Route::post('/create-product', [ProductController::class, 'new_product'])->name('create.product');
    Route::get('/add-existing', [ProductController::class, 'existing_product'])->name('existing.product');
    Route::post('/add-existing', [ProductController::class, 'add_existing_product'])->name('existing.product');
});

Route::middleware(['auth', 'role:packer'])->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('products');
    Route::post('/', [ProductController::class, 'search_product'])->name('product.search');
    Route::get('/product/{id}', [ProductController::class, 'product'])->name('product.single');
    Route::post('/product/{id}', [ProductController::class, 'pack_product'])->name('product.single');
});

