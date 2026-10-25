<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResources(['users' => UserController::class]);
Route::get('roles' ,[ RoleController::class, 'index']);
Route::post('/login' ,[ AuthController::class, 'login']);
Route::post('/register' ,[ AuthController::class, 'register']);
Route::post('/logout' ,[ AuthController::class, 'logout']);

