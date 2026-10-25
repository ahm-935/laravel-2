<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('welcome',function(){
    return view('welcome');
});
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/product-details/{id}', [HomeController::class, 'details'])->name('product.details');
Route::get('/cart', [HomeController::class, 'cart'])->name('cart');
Route::resource('/orders', OrderController::class);

Route::get('/dashboard', function () {
    return view('admin.pages.dashboard');
})->middleware(['auth', 'verified', 'role_id:1,2,3,4'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class)->except(['show']);

    Route::get('/roles/search', [RoleController::class, 'search'])->name('roles.search');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth', 'role_id:1,2,3,4')->group(function () {
    Route::resource('products', ProductController::class);
});

require __DIR__.'/auth.php';

require __DIR__.'/payment-web.php';
