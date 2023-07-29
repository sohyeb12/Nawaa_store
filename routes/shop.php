<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CommunicationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

Route::get('products/{product}',[ProductsController::class, 'show'])
          ->name('shop.products.show');
          
Route::post('product_review/{product}',[ReviewController::class,'store'])->name('products.review');

Route::get('/cart',[CartController::class, 'index'])->name('cart');
Route::post('/cart',[CartController::class, 'store'])->name('cart.store');
Route::delete('/cart/{id}',[CartController::class, 'destroy'])->name('cart.destroy');

Route::get('/checkout',[CheckoutController::class , 'create'])->name('checkout');
Route::post('/checkout',[CheckoutController::class , 'store'])->name('checkout.store');
Route::get('/checkout/thankyou',[CheckoutController::class , 'success'])->name('checkout.success');


// communications
Route::get('/communications/create',[CommunicationController::class , 'create'])->name('communications.create');
Route::post('/communications/store',[CommunicationController::class , 'store'])->name('communications.store');

// About us
Route::get('/about_us',[HomeController::class , 'about_us'])->name('about_us');
