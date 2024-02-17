<?php

use App\Http\Controllers\DeliveryAddressController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductReviewController;
use App\Http\Controllers\AuthController;
use App\Services\ServiceOrder;
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

Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('login', [AuthController::class, 'login'])->name('login');

Route::get('products', [ProductController::class, 'index'])->name('products.index');
Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('products/{product}/reviews', [ProductReviewController::class, 'index'])->name('products.reviews.index');

Route::get('orders/{id}/summary', [ServiceOrder::class, 'generateOrderSummaryPdf'])->name('orders.summary');


Route::middleware('auth:api')->group(function () {
    Route::apiResource('delivery_addresses', DeliveryAddressController::class);
    Route::apiResource('orders', OrderContoller::class);
    Route::apiResource('order_lines', OrderLineController::class);
    Route::post('create_order', [ServiceOrder::class, 'createOrder'])->name('create.order');
});
