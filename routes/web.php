<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

Route::prefix('lk')->group(function () {
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register')->middleware('guest');
    Route::post('/register', [RegisterController::class, 'register'])->middleware('guest');
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
    Route::post('/login', [LoginController::class, 'login'])->middleware('guest');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});


Route::get('/', function () {
    return view('index');
});

Route::get('/catalog', function () {
    return view('shop/catalog');
});

Route::get('/contacts', function () {
    return view('shop/contacts');
});

Route::get('/cart', function () {
    return view('shop/cart');
});



