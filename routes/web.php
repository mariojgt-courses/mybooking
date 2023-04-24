<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SlotsController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\BookingManagerController;
use App\Http\Controllers\BookingCustomerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
});

Route::controller(BookingManagerController::class)->group(function () {
    Route::get('/manage', 'index')->name('slots.index');
});

Route::controller(BookingCustomerController::class)->group(function () {
    Route::get('/bookings', 'index')->name('booking');
});

Route::controller(BookingController::class)->group(function () {
    Route::post('/bookings', 'store')->name('booking.store');
    Route::delete('/booking/{booking}', 'destroy')->name('booking.delete');
    Route::delete('/block/day/{bookingBlockedSlot}', 'destroyDay')->name('day.delete');
});
