<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketTypeController;
use App\Http\Controllers\BookingController;

Route::get('/', function () {
    return view('admin.layouts.master');
});

Route::get('/dashboard', function () {
    return view('admin.pages.dashboard');
})->name('dashboard');

Route::get('/login', function () {
    return view('admin.pages.auth.login');
})->name('login');

Route::get('/register', function () {
    return view('admin.pages.auth.register');
})->name('register');

Route::get('/events/{id}', [EventController::class, 'details'])
    ->name('events.details');

Route::middleware('auth')->group(function () {
    Route::get('/bookings/create', [BookingController::class, 'create'])
        ->name('bookings.create');

    Route::get('/bookings', [BookingController::class, 'store'])
        ->name('bookings.store');

    Route::get('/bookings/{id}', [BookingController::class, 'show'])
        ->name('bookings.show');
});

Route::resources(['users' => UserController::class,]);
Route::resources(['events' => EventController::class,]);
Route::resources(['ticket-types' => TicketTypeController::class,]);




Route::post('/bookings', [BookingController::class, 'store'])
        ->name('bookings.store');

    Route::get('tickets/bookings    ', [BookingController::class, 'show'])
        ->name('tickets.booking');

    Route::get('/bookings/{booking}', [BookingController::class, 'show'])
        ->name('bookings.show');