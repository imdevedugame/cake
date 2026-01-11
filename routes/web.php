<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Public\ProductController;
use App\Http\Controllers\Public\DiscountController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\DiscountController as AdminDiscountController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

// HOME
Route::get('/', [HomeController::class, 'index'])
    ->name('home');

// PRODUCTS
Route::get('/products', [ProductController::class, 'index'])
    ->name('products.index');

Route::get('/products/{slug}', [ProductController::class, 'show'])
    ->name('product.show');

// DISCOUNTS (PUBLIC → HANYA YANG PUBLISHED & AKTIF)
Route::get('/discounts', [DiscountController::class, 'index'])
    ->name('discounts.index');

Route::get('/discounts/{slug}', [DiscountController::class, 'show'])
    ->name('discounts.show');

// STATIC
Route::view('/contact', 'contact')->name('contact');
Route::view('/about', 'about')->name('about');

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::prefix('admin')
->middleware(['auth', 'admin'])
->name('admin.')
->group(function () {

    // ✅ ADMIN PRODUCTS
    Route::resource('products', AdminProductController::class);

    // ✅ ADMIN DISCOUNTS
    Route::resource('discounts', AdminDiscountController::class);

    Route::get('discounts/{discount}/preview', [AdminDiscountController::class, 'preview'])
        ->name('discounts.preview');

    Route::patch(
        'discounts/{discount}/toggle',
        [AdminDiscountController::class, 'toggleStatus']
    )->name('discounts.toggle');
});
