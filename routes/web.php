<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    //Payment
    Route::post('project/{projectId}/checkout', [PaymentController::class, 'checkout'])->name('payment.checkout');
    Route::get('project/success/{orderId}', [PaymentController::class, 'success'])->name('payment.success');
    Route::get('project/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');

    //Order
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');

    //Cart
    Route::get('/cart',[CartController::class, 'showCart'])->name('cart.index');
    Route::post('/cart/add',[CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::get('/cart/success/{orderId}', [CartController::class, 'success'])->name('cart.success');
    Route::get('/cart/cancel', [CartController::class, 'cancel'])->name('cart.cancel');


    
});
//Home
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/marketplace', [HomeController::class, 'market'])->name('projects.marketplace');
Route::get('project/{projectId}', [PaymentController::class, 'show'])->name('payment.show');
Route::get('/marketplace/search', [HomeController::class, 'market'])->name('market');

require __DIR__ . '/auth.php';
