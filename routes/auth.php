<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| AUTH ROUTES (ADMIN LOGIN VIA MODAL)
|--------------------------------------------------------------------------
*/

// ✅ LOGIN ADMIN (POST ONLY)
// JANGAN ADA GET /login DI MANA PUN
Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->name('login');


// ❌ OPTIONAL (boleh HAPUS kalau ga dipakai)
Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
    ->name('password.request');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
    ->name('password.email');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
    ->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
    ->name('password.store');

/*
|--------------------------------------------------------------------------
| LOGOUT (AUTH ONLY)
|--------------------------------------------------------------------------
*/
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');