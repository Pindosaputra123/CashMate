<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\CustomerController;
use FontLib\Table\Type\name;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/**
 * Route Midleware Guest
 */
Route::middleware('guest')->group(function(){
    // Login
    Route::get('login', [App\Http\Controllers\LoginController::class, 'index'])->name('login');
    Route::post('authLogin', [App\Http\Controllers\LoginController::class, 'login'])->name('authLogin');
});


/**
 * Route Middleware Authentication
 */
Route::middleware('auth')->group(function(){
    // Dahboard Route
    Route::redirect('/', '/dashboard');
    Route::get('dashboard', [App\Http\Controllers\DashboardContoller::class, 'index'])->name('dashboard');
    
    // Logout
    // Sementara get dulu karena belum ada fitur logoutnya, sebatas test logout
    Route::get('logout', [App\Http\Controllers\LogoutController::class, 'logout'])->name('logout');

    // for User
    Route::prefix('user')->group(function () {
        Route::get('', [App\Http\Controllers\UserController::class, 'index'])->name('user.index');
        Route::get('create', [App\Http\Controllers\UserController::class, 'create'])->name('user.create');
        Route::post('store', [App\Http\Controllers\UserController::class, 'store'])->name('user.store');
        Route::get('{user}/get', [\App\Http\Controllers\UserController::class, 'get'])->name('user.get');
        Route::put('{user}/update', [\App\Http\Controllers\UserController::class, 'update'])->name('user.update');
        Route::delete('{user}/delete', [\App\Http\Controllers\UserController::class, 'destroy'])->name('user.destroy');
    });

    // for Barang
    Route::prefix('barang')->group(function () {
        Route::get('', [App\Http\Controllers\BarangController::class, 'index'])->name('barang.index');
        Route::get('create', [App\Http\Controllers\BarangController::class, 'create'])->name('barang.create');
        Route::post('store', [App\Http\Controllers\BarangController::class, 'store'])->name('barang.store');
        Route::get('{barang}/get', [\App\Http\Controllers\BarangController::class, 'get'])->name('barang.get');
        Route::put('{barang}/update', [\App\Http\Controllers\BarangController::class, 'update'])->name('barang.update');
        Route::delete('{barang}/delete', [\App\Http\Controllers\BarangController::class, 'destroy'])->name('barang.destroy');
    });

    Route::get('get-barang', [BarangController::class, 'getBarang'])->name('getBarang');

    // for Customer
    Route::prefix('customer')->group(function () {
        Route::get('', [App\Http\Controllers\CustomerController::class, 'index'])->name('customer.index');
        Route::get('create', [App\Http\Controllers\CustomerController::class, 'create'])->name('customer.create');
        Route::post('store', [App\Http\Controllers\CustomerController::class, 'store'])->name('customer.store');
        Route::get('{customer}/get', [\App\Http\Controllers\CustomerController::class, 'get'])->name('customer.get');
        Route::put('{customer}/update', [\App\Http\Controllers\CustomerController::class, 'update'])->name('customer.update');
        Route::delete('{customer}/delete', [\App\Http\Controllers\CustomerController::class, 'destroy'])->name('customer.destroy');
    });

    Route::get('get-cust', [CustomerController::class, 'getCust'])->name('getCust');

    // for setting profile user auth
    Route::prefix('setting')->group(function(){
        Route::get('set-password', [App\Http\Controllers\SettingController::class, 'setPassword'])->name('settings.set-password');
        Route::get('set-profile', [App\Http\Controllers\SettingController::class, 'setProfile'])->name('settings.set-profile');
        Route::put('update-profile', [\App\Http\Controllers\SettingController::class, 'updateProfile'])->name('setting.update-profile');
        Route::put('update-password', [\App\Http\Controllers\SettingController::class, 'updatePassword'])->name('setting.update-password');
    });

    // For Incoming Sales
    Route::prefix('incoming-sales')->group(function(){
        Route::get('', [App\Http\Controllers\SaleController::class, 'index'])->name('incoming_sale.index');
        Route::get('add', [App\Http\Controllers\SaleController::class, 'create'])->name('incoming_sale.create');
        Route::post('store', [App\Http\Controllers\SaleController::class, 'store'])->name('incoming_sale.store');
        Route::get('{sale}/detail', [App\Http\Controllers\SaleController::class, 'detail'])->name('incoming_sale.detail');
    });
});