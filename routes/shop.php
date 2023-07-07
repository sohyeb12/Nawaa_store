<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

Route::get('products/{product}',[ProductsController::class, 'show'])
          ->name('shop.products.show');
          
Route::post('product_review/{product}',[ReviewController::class,'store'])->name('products.review');

Route::get('/cart',[CartController::class, 'index'])->name('cart');

Route::post('/cart',[CartController::class, 'store'])->name('cart.store');

Route::delete('/cart/{id}',[CartController::class, 'destroy'])->name('cart.destroy');