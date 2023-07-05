<?php

use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

Route::get('products/{product}',[ProductsController::class, 'show'])
          ->name('shop.products.show');
Route::post('product_review/{product}',[ReviewController::class,'store'])->name('products.review');