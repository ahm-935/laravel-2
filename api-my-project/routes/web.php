<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketTypeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Login page
Route::get('/', function () {
    return view('admin.pages.auth.login');
});


/*
|--------------------------------------------------------------------------
| Event Routes
|--------------------------------------------------------------------------
*/

Route::resource('events', EventController::class);


/*
|--------------------------------------------------------------------------
| Booking Routes
|--------------------------------------------------------------------------
*/

Route::get('/events/{event}/booking', [BookingController::class, 'create'])
    ->name('tickets.booking');

Route::post('/events/{event}/booking', [BookingController::class, 'store'])
    ->name('tickets.booking.store');


/*
|--------------------------------------------------------------------------
| SSLCOMMERZ Payment Callback Routes
|--------------------------------------------------------------------------
*/

Route::post('/payment/success', [BookingController::class, 'paymentSuccess'])
    ->name('payment.success');

Route::post('/payment/fail', [BookingController::class, 'paymentFail'])
    ->name('payment.fail');

Route::post('/payment/cancel', [BookingController::class, 'paymentCancel'])
    ->name('payment.cancel');

Route::post('/payment/ipn', [BookingController::class, 'paymentIpn'])
    ->name('payment.ipn');

Route::get('/payment/success-page/{booking}', [BookingController::class, 'successPage'])
    ->name('payment.success.page');

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', function () {
        return view('admin.pages.dashboard');
    })->middleware('verified')->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | Users
    |--------------------------------------------------------------------------
    */

    Route::resource('users', UserController::class);


    /*
    |--------------------------------------------------------------------------
    | Roles
    |--------------------------------------------------------------------------
    */

    Route::resource('roles', RoleController::class);


    /*
    |--------------------------------------------------------------------------
    | My Bookings
    |--------------------------------------------------------------------------
    */

    Route::get('/my-bookings/{booking}', [BookingController::class, 'show'])
        ->name('bookings.show');

    Route::get('/my-bookings/{booking}/ticket', [BookingController::class, 'ticket'])
        ->name('bookings.ticket');

    Route::get('/my-bookings', [BookingController::class, 'index'])
        ->name('bookings.index');
});


/*
|--------------------------------------------------------------------------
| Ticket Type Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:1,2'])->group(function () {

    Route::resources([
        'ticket-types' => TicketTypeController::class,
    ]);
});


/*
|--------------------------------------------------------------------------
| Breeze Authentication Routes
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';  