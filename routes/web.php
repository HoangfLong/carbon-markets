<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::prefix('user')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('user.profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('user.profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('user.profile.destroy');

        Route::get('/orders', [OrderController::class, 'index'])->name('user.orders.index');
        Route::get('/orders/{order}', [OrderController::class, 'show'])->name('user.orders.show');

        Route::get('/cart', [CartController::class, 'showCart'])->name('user.cart.index');
        Route::post('/cart/add', [CartController::class, 'addToCart'])->name('user.cart.add');
        Route::post('/cart/update/{itemId}', [CartController::class, 'update'])->name('user.cart.update');
        Route::post('/cart/clear/{cartItemId}', [CartController::class, 'clearCart'])->name('user.cart.clear');
        Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('user.cart.checkout');
        Route::get('/cart/success/{orderId}', [CartController::class, 'success'])->name('user.cart.success');
        Route::get('/cart/cancel', [CartController::class, 'cancel'])->name('user.cart.cancel');
    });

    Route::prefix('payment')->group(function () {
        Route::post('/checkout/{projectId}', [PaymentController::class, 'checkout'])->name('payment.checkout');
        Route::get('/success/{orderId}', [PaymentController::class, 'success'])->name('payment.success');
        Route::get('/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');
    });
});

//Home
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/marketplace', [HomeController::class, 'market'])->name('projects.marketplace');
Route::get('project/{projectId}', [PaymentController::class, 'show'])->name('payment.show');
Route::get('/marketplace/search', [HomeController::class, 'market'])->name('market');

require __DIR__ . '/auth.php';
