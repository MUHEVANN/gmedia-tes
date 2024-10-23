<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login-page');
});

Route::prefix('auth')->controller(AuthController::class)->group(function () {
    Route::get('login', 'login_page')->name('login-page');
    Route::get('register', 'register_page')->name('register-page');

    // action
    Route::post('register', 'register')->name('register');
    Route::post('login', 'login')->name('login');
    Route::post('logout', 'logout')->name('logout');
});


Route::middleware('auth')->group(function () {
    Route::resource('category', CategoryController::class)->only(['create', 'store', 'index']);
    Route::resource('product', ProductController::class)->only(['create', 'store', 'destroy']);
    Route::resource('cart', CartController::class)->only(['index', 'store', 'destroy']);
    Route::post('/cart-tambah/{product}', [CartController::class, 'cart_tambah'])->name('cart-tambah');
    Route::post('/cart-kurang/{product}', [CartController::class, 'cart_kurang'])->name('cart-kurang');
    Route::post('/payment', [PaymentController::class, 'store'])->name('payment');
    Route::get('search-product', [ProductController::class, 'search'])->name('search-product');
    Route::controller(DashboardController::class)->group(function () {
        Route::get('dashboard', 'index')->name('dashboard');
    });
});
