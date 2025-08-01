<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Gate;

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'can:access-admin'])->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);

    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class)->except(['show']);
    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
    Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class)->except(['create', 'store']);
    
    Route::post('orders/{order}/status', [\App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])
        ->name('orders.status');
    
    Route::get('orders/{order}/print', [\App\Http\Controllers\Admin\OrderController::class, 'printInvoice'])
        ->name('orders.print');
    
    // POS System
    Route::prefix('pos')->name('pos.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\PosController::class, 'index'])->name('index');
        Route::post('/add-to-cart', [\App\Http\Controllers\Admin\PosController::class, 'addToCart'])->name('add-to-cart');
        Route::post('/update-cart', [\App\Http\Controllers\Admin\PosController::class, 'updateCart'])->name('update-cart');
        Route::post('/remove-from-cart', [\App\Http\Controllers\Admin\PosController::class, 'removeFromCart'])->name('remove-from-cart');
        Route::post('/clear-cart', [\App\Http\Controllers\Admin\PosController::class, 'clearCart'])->name('clear-cart');
        Route::post('/checkout', [\App\Http\Controllers\Admin\PosController::class, 'checkout'])->name('checkout');
        Route::get('/get-cart', [\App\Http\Controllers\Admin\PosController::class, 'getCart'])->name('get-cart');
    });
});

// Cashier Routes
Route::prefix('kasir')->name('cashier.')->middleware(['auth', 'can:access-cashier'])->group(function () {
    // POS System
    Route::prefix('pos')->name('pos.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Cashier\PosController::class, 'index'])->name('index');
        Route::post('/add-to-cart', [\App\Http\Controllers\Cashier\PosController::class, 'addToCart'])->name('add-to-cart');
        Route::post('/update-cart', [\App\Http\Controllers\Cashier\PosController::class, 'updateCart'])->name('update-cart');
        Route::post('/remove-from-cart', [\App\Http\Controllers\Cashier\PosController::class, 'removeFromCart'])->name('remove-from-cart');
        Route::post('/clear-cart', [\App\Http\Controllers\Cashier\PosController::class, 'clearCart'])->name('clear-cart');
        Route::post('/checkout', [\App\Http\Controllers\Cashier\PosController::class, 'checkout'])->name('checkout');
        Route::get('/get-cart', [\App\Http\Controllers\Cashier\PosController::class, 'getCart'])->name('get-cart');
    });
    
    // Order Management
    Route::resource('orders', \App\Http\Controllers\Cashier\OrderController::class)->only(['index', 'show'])
        ->names([
            'index' => 'orders.index',
            'show' => 'orders.show'
        ]);
    
    Route::post('orders/{order}/status', [\App\Http\Controllers\Cashier\OrderController::class, 'updateStatus'])
        ->name('orders.status');
    
    Route::get('orders/{order}/print', [\App\Http\Controllers\Cashier\OrderController::class, 'printInvoice'])
        ->name('orders.print');
});

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.photo.update');
    Route::delete('/profile/photo', [ProfileController::class, 'deletePhoto'])->name('profile.photo.delete');
});

// Home Redirects
Route::redirect('/', '/login')->middleware('guest');
Route::get('/home', function () {
    if (Gate::allows('access-admin')) {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('cashier.pos.index');
})->middleware('auth');


Route::get('/', [ProfileController::class, 'show'])->name('profile.show');