<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CheckoutController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class,'register']);
Route::post('/login', [AuthController::class,'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class,'logout']);

    Route::post('/cart/items', [CartController::class,'add']);
    Route::get('/cart', [CartController::class,'view']);
    Route::patch('/cart/items/{product_id}', [CartController::class,'update']);
    Route::delete('/cart/items/{product_id}', [CartController::class,'delete']);

    Route::post('/cart/checkout', [CheckoutController::class,'checkout']);
});
