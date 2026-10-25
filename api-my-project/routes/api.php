<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketTypeController;
use App\Http\Controllers\BookingController;


// React: create pending booking and initialize payment
Route::post(
    '/payments/initialize',
    [BookingController::class, 'apiInitialize']
)->name('api.payments.initialize');

Route::post(
    '/bookings/cash',
    [BookingController::class, 'apiCashBooking']
)->name('api.bookings.cash');

Route::get('/bookings', [BookingController::class, 'apiMyBookings']);

Route::get('/bookings/{booking}/details', [
    BookingController::class,
    'apiDetails',
]);

// SSLCommerz server callbacks
Route::post('/payment/success', [BookingController::class, 'paymentSuccess'])
    ->name('payment.success');

Route::post('/payment/fail', [BookingController::class, 'paymentFail'])
    ->name('payment.fail');

Route::post('/payment/cancel', [BookingController::class, 'paymentCancel'])
    ->name('payment.cancel');

Route::post('/payment/ipn', [BookingController::class, 'paymentIpn'])
    ->name('payment.ipn');

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::apiResource('users', UserController::class);
Route::get('roles',[RoleController::class, 'index']);
Route::get('events',[EventController::class, 'index']);
Route::get('/events/{event}', [EventController::class, 'show']);
Route::get('tickets',[TicketTypeController::class, 'index']);

Route::post('login',[AuthController::class, 'login']);
Route::post('register',[AuthController::class, 'register']);

