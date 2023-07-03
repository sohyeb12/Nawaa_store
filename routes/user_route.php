<?php 

use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\UpdatePasswordUser;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth' , 'auth.ensuretype:admin,super-admin'])->group(function () {

    Route::get('/admin/users/trashed', [UserController::class, 'trashed'])->name('users.trashed');

    Route::put('/admin/users/{user}/restore', [UserController::class, 'restore'])->name('users.restore');

    Route::delete('/admin/users/{user}/force', [UserController::class, 'forceDelete'])->name('users.force-delete');

    Route::get('/admin/users',[UserController::class,'index'])->name('users.index');
    Route::get('/admin/users/create',[UserController::class,'create'])->name('users.create');
    Route::post('/admin/users',[UserController::class,'store'])->name('users.store');
    Route::get('/admin/users/{user}',[UserController::class,'show'])->name('users.show');
    Route::get('/admin/users/{user}/edit',[UserController::class,'edit'])->name('users.edit');
    Route::put('/admin/users/{user}',[UserController::class,'update'])->name('users.update');
    Route::delete('/admin/users/{user}',[UserController::class,'destroy'])->name('users.destroy');

    Route::get('/admin/users/{user}/edit-password',[UpdatePasswordUser::class,'edit_password'])->name('users.edit-password');
    Route::put('/admin/users/update-user/{user}',[UpdatePasswordUser::class,'update'])->name('users.update-password');
});