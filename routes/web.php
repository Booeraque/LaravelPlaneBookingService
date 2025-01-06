<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PlaneController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('index');
});

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'showLoginForm');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout');
});

Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'showRegistrationForm');
    Route::post('/register', 'register');
});

Route::controller(ProfileController::class)->group(function () {
    Route::get('/profile', 'show')->name('profile');
    Route::get('/profile/edit', 'edit')->name('profile.edit');
    Route::put('/profile/update', 'update')->name('profile.update');
});

Route::controller(BookingController::class)->group(function () {
    Route::get('/worker/bookings', 'workerBookings')->name('worker.bookings');
    Route::get('/booking/proceed', 'proceed')->name('booking.proceed');
    Route::post('/booking/confirm', 'confirm')->name('booking.confirm');
    Route::get('/bookings', 'index')->name('bookings.index');
    Route::get('/bookings/{id}', 'show')->name('bookings.show');
    Route::get('/bookings/{id}/edit', 'edit')->name('bookings.edit');
    Route::put('/bookings/{id}', 'update')->name('bookings.update'); // Ensure this line is present
});

Route::controller(PlaneController::class)->group(function () {
    Route::get('/planes', 'index')->name('planes.index');
    Route::get('/planes/create', 'create')->name('planes.create');
    Route::post('/planes', 'store')->name('planes.store');
    Route::get('/planes/{plane}', 'show')->name('planes.show');
    Route::get('/planes/{plane}/edit', 'edit')->name('planes.edit');
    Route::put('/planes/{plane}', 'update')->name('planes.update');
    Route::delete('/planes/{plane}', 'destroy')->name('planes.destroy');
});

Route::controller(UserController::class)->group(function () {
    Route::get('/users', 'index')->name('users.index');
    Route::get('/users/create', 'create')->name('users.create');
    Route::post('/users', 'store')->name('users.store');
    Route::get('/users/{user}', 'show')->name('users.show');
    Route::get('/users/{user}/edit', 'edit')->name('users.edit');
    Route::put('/users/{user}', 'update')->name('users.update');
    Route::delete('/users/{user}', 'destroy')->name('users.destroy');
});

Route::controller(CartController::class)->group(function () {
    Route::post('/cart/add/{plane}', 'add')->name('cart.add');
    Route::delete('/cart/remove/{plane}', 'remove')->name('cart.remove');
});

Route::controller(ShoppingCartController::class)->group(function () {
    Route::get('/shopping-cart/{id}', 'show')->name('shopping-cart.show');
});

Auth::routes();
