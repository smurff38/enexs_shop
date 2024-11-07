<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;

Route::prefix('lk')->group(function () {
<<<<<<< HEAD
    // Регистрация и авторизация для гостей
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])
        ->name('register')
        ->middleware('guest');
    Route::post('/register', [RegisterController::class, 'register'])
        ->middleware('guest');

    Route::get('/login', [LoginController::class, 'showLoginForm'])
        ->name('login')
        ->middleware('guest');
    Route::post('/login', [LoginController::class, 'login'])
        ->middleware('guest');

    // Выход только для авторизованных пользователей
    Route::post('/logout', [LoginController::class, 'logout'])
        ->name('logout')
        ->middleware('auth');

    // Доступ к профилю только для авторизованных пользователей
    Route::get('/profile', [ProfileController::class, 'show'])
        ->name('profile/profile.show')
        ->middleware('auth');
    Route::post('/profile/update', [ProfileController::class, 'update'])
        ->name('profile.update')
        ->middleware('auth');
=======
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register')->middleware('guest');
    Route::post('/register', [RegisterController::class, 'register'])->middleware('guest');
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
    Route::post('/login', [LoginController::class, 'login'])->middleware('guest');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile/profile.show');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
>>>>>>> origin/main
});

// Публичные маршруты
Route::get('/', function () {
    return view('index');
});

Route::get('/catalog', function () {
    return view('shop/catalog');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/cart', function () {
    return view('shop/cart');
});
