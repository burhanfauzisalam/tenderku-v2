<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\GuestMiddleware;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::middleware(GuestMiddleware::class)->group(function () {
    Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
    Route::post('/register-process', [AuthController::class, 'register'])->name('register.process');

    Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login-process', [AuthController::class, 'login'])->name('login.process');
});

Route::middleware(AuthMiddleware::class)->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});