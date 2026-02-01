<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Services
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/{slug}', [ServiceController::class, 'show'])->name('services.show');

// Booking
Route::get('/book', [BookingController::class, 'create'])->name('booking.create');
Route::post('/book', [BookingController::class, 'store'])->name('booking.store');
Route::get('/api/available-slots', [BookingController::class, 'getAvailableSlots'])->name('booking.slots');
