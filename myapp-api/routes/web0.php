<?php
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.layouts.master');
});

Route::get('/dashboard', function () {
    return view('admin.pages.dashboard');
});

// Route::get('/users', [UserController::class, 'index'])->name('users.index');
// Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
// Route::post('/users', [UserController::class, 'store'])->name('users.store');
// Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
// Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
// Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
// Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

Route::resources(['users' => UserController::class,]);
Route::resources(['products' => ProductController::class,]);

// Auth
Route::get('/login', function () {
    return view('admin.pages.auth.login');
});
