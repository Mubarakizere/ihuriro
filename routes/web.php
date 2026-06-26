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

// Customer Auth
Route::middleware('guest')->group(function () {
    Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);
    Route::get('/register', [App\Http\Controllers\AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [App\Http\Controllers\AuthController::class, 'register']);
});

Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->middleware('auth')->name('logout');

// Customer Dashboard
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Customer\DashboardController::class, 'index'])->name('customer.dashboard');
});

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Guest
    Route::middleware('guest')->group(function () {
        Route::get('login', [App\Http\Controllers\Admin\LoginController::class, 'showLoginForm'])->name('login');
        Route::post('login', [App\Http\Controllers\Admin\LoginController::class, 'login']);
    });

    // Auth & Admin
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::post('logout', [App\Http\Controllers\Admin\LoginController::class, 'logout'])->name('logout');
        
        Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
        
        Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class);
        Route::get('services/bulk-create', [App\Http\Controllers\Admin\ServiceController::class, 'bulkCreate'])->name('services.bulk-create');
        Route::post('services/bulk', [App\Http\Controllers\Admin\ServiceController::class, 'bulkStore'])->name('services.bulk-store');
        Route::resource('services', App\Http\Controllers\Admin\ServiceController::class);
        Route::resource('countries', App\Http\Controllers\Admin\CountryController::class);
        Route::get('cities/bulk-create', [App\Http\Controllers\Admin\CityController::class, 'bulkCreate'])->name('cities.bulk-create');
        Route::post('cities/bulk', [App\Http\Controllers\Admin\CityController::class, 'bulkStore'])->name('cities.bulk-store');
        Route::resource('cities', App\Http\Controllers\Admin\CityController::class);
        Route::resource('bookings', App\Http\Controllers\Admin\BookingController::class);
        
        Route::patch('bookings/{booking}/status', [App\Http\Controllers\Admin\BookingController::class, 'updateStatus'])->name('bookings.status');

        // Site Settings
        Route::get('settings', [App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
        Route::put('settings', [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
    });
});
