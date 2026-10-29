<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::apiResource('users', UserController::class);
Route::apiResource('products', ProductController::class);
Route::get('roles',[RoleController::class, 'index']);
Route::get('categories',[CategoryController::class, 'index']);
Route::get('brands',[BrandController::class, 'index']);

Route::post('login',[AuthController::class, 'login']);
Route::post('register',[AuthController::class, 'register']);
Route::post('logout',[AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('check-token',[AuthController::class, 'checkToken']);