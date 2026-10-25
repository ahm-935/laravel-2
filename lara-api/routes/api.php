<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user',[UserController::class,'index']);
Route::resource('/departments',DepartmentController::class);

Route::post('/test', function () {
    return "Laravel Api is not working--->False";
});  
