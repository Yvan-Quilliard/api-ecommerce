<?php

use App\Http\Controllers\DeliveryAddressController;
use App\Http\Controllers\ProductController;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::apiResource('categories', CategoryController::class);
Route::apiResource('delivery_addresses', DeliveryAddressController::class);
Route::apiResource('orders', OrderContoller::class);
Route::apiResource('order_lines', OrderLineController::class);
Route::apiResource('products', ProductController::class);
