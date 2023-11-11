<?php

use App\Http\Controllers\DeliveryAddressController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductReviewController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderContoller;
use App\Http\Controllers\OrderLineController;

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

//create routes for login and register
Route::post('register', [RegisterController::class, 'register'])->name('register');
Route::post('login', [RegisterController::class, 'login'])->name('login');

Route::middleware('auth:api')->group(function () {
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('delivery_addresses', DeliveryAddressController::class);
    Route::apiResource('orders', OrderContoller::class);
    Route::apiResource('order_lines', OrderLineController::class);
    Route::apiResource('products', ProductController::class);
    Route::apiResource('product_reviews', ProductReviewController::class);
});
