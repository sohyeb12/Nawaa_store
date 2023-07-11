<?php

use App\Http\Controllers\Api\V1\CartsController;
use App\Http\Controllers\Api\V1\CategoriesController;
use App\Http\Controllers\Api\V1\OrdersController;
use App\Http\Controllers\Api\V1\ProductsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('products',ProductsController::class); // 5 routes 
Route::apiResource('categories',CategoriesController::class); // 5 routes 
Route::apiResource('orders',OrdersController::class); // 5 routes 
Route::apiResource('carts',CartsController::class); // 5 routes 
