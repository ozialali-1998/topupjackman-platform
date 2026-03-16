<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\OrderManagementController;
use App\Http\Controllers\Admin\ProductManagementController;
use App\Http\Controllers\Admin\ReferralManagementController;
use App\Http\Controllers\Admin\WithdrawalManagementController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\OrderStatusController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TopUpController;
use App\Http\Controllers\WithdrawalController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/top-up', [TopUpController::class, 'index'])->name('topup.index');
Route::post('/top-up/checkout', [TopUpController::class, 'checkout'])->name('topup.checkout');
Route::post('/top-up/create-order', [TopUpController::class, 'createOrder'])->name('topup.create-order');
Route::get('/checkout/{order}', [TopUpController::class, 'showCheckout'])->name('checkout.show');

Route::post('/create-transaction', [PaymentController::class, 'createTransaction'])->name('midtrans.create-transaction');
Route::post('/midtrans/callback', [PaymentController::class, 'callback'])->name('midtrans.callback');

Route::get('/order-status', [OrderStatusController::class, 'index'])->name('order-status.index');
Route::post('/order-status', [OrderStatusController::class, 'show'])->name('order-status.show');

Route::middleware('guest')->group(function (): void {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware('auth')->group(function (): void {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/withdrawals', [WithdrawalController::class, 'store'])->name('withdrawals.store');
});

Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function (): void {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('/orders', [OrderManagementController::class, 'index'])->name('orders.index');
    Route::patch('/orders/{order}/status', [OrderManagementController::class, 'updateStatus'])->name('orders.status');

    Route::get('/products', [ProductManagementController::class, 'index'])->name('products.index');
    Route::post('/products', [ProductManagementController::class, 'store'])->name('products.store');
    Route::put('/products/{product}', [ProductManagementController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductManagementController::class, 'destroy'])->name('products.destroy');

    Route::get('/referrals', [ReferralManagementController::class, 'index'])->name('referrals.index');

    Route::get('/withdrawals', [WithdrawalManagementController::class, 'index'])->name('withdrawals.index');
    Route::patch('/withdrawals/{withdrawal}/status', [WithdrawalManagementController::class, 'updateStatus'])->name('withdrawals.status');
});
