<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\ProductController;


use App\Http\Controllers\Admin\AuthController;

Route::prefix('admin')->name('admin.')->group(function () {

    // Admin login
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

    // Protected admin area
    Route::middleware('auth:admin')->group(function () {

        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        Route::get('/products', [ProductController::class, 'index'])->name('products.index');
        Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/products', [ProductController::class, 'store'])->name('products.store');
        Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

    });
});


Route::get('/', function () {
    return view('welcome');
});
