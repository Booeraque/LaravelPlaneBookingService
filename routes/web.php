<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PlaneController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\BookingController;


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('index');
});

Route::controller(LoginController::class)-> group(function () {
    Route::get('/login', 'showLoginForm');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout');
});

Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'showRegistrationForm');
    Route::post('/register', 'register');
});

Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

Route::get('/worker/bookings', [BookingController::class, 'workerBookings'])->name('worker.bookings');

Route::get('/planes', [PlaneController::class, 'index'])->name('planes.index');
Route::get('/planes/{plane}', [PlaneController::class, 'show'])->name('planes.show');

Route::post('/cart/add/{plane}', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/remove/{plane}', [CartController::class, 'remove'])->name('cart.remove');

Route::get('/shopping-cart/{id}', [ShoppingCartController::class, 'show'])->name('shopping-cart.show');

Route::get('/booking/proceed', [BookingController::class, 'proceed'])->name('booking.proceed');
Route::post('/booking/confirm', [BookingController::class, 'confirm'])->name('booking.confirm');
Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
Route::get('/bookings/{id}', [BookingController::class, 'show'])->name('bookings.show');
Route::get('/bookings/{id}/edit', [BookingController::class, 'edit'])->name('bookings.edit');
Route::delete('/cart/remove/{plane}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/bookings/{id}', [BookingController::class, 'update'])->name('bookings.update');
Auth::routes();
