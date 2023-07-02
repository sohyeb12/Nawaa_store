<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth' , 'auth.ensuretype:admin,super-admin'])->group(function () {

    // Categories Routes
    Route::get('/admin/categories/trashed', [CategoryController::class, 'trashed'])->name('categories.trashed');

    Route::put('/admin/categories/{category}/restore', [CategoryController::class, 'restore'])->name('categories.restore');

    Route::delete('/admin/categories/{category}/force', [CategoryController::class, 'forceDelete'])->name('categories.force-delete');

    Route::resource('/admin/categories', CategoryController::class);

    //Products Routes

    Route::get('/admin/products/trashed', [ProductController::class, 'trashed'])->name('products.trashed');

    Route::put('/admin/products/{product}/restore', [ProductController::class, 'restore'])->name('products.restore');

    Route::delete('/admin/products/{product}/force', [ProductController::class, 'forceDelete'])->name('products.force-delete');

    Route::resource('/admin/products', ProductController::class);
});
