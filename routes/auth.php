<?php

use App\Http\Controllers\CashierController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\QueueTransactionController;

// Routes for guest users (not logged in)
Route::middleware('guest')->group(function() {

    // Queue Transaction Routes
    Route::prefix('queue')->controller(QueueTransactionController::class)->group(function(){
        Route::get('/client', 'showQueue')->name('get.client.name');
        Route::post('/client', 'storeQueueNumber')->name('get.store.name');
    });

    // Authentication Routes 
    Route::prefix('auth')->controller(AuthController::class)->group(function(){
        Route::get('/login', 'login')->name('login');
        Route::post('/login', 'loginPost')->name('login.post');
    });
});

// Routes for logged-in users (authenticated)
Route::middleware('auth')->group(function() {

    // Admin Routes
    // Route::prefix('admin')->controller(AdminController::class)->group(function(){
    //     Route::get('/', 'index')->name('admin.index');  
    // });

    // Logout Route
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});


Route::middleware(['auth', 'role:admin'])->group(function(){
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
});

Route::middleware(['auth', 'role:cashier'])->group(function(){
    Route::get('/cashier', [CashierController::class, 'index'])->name('cashier.index');
});


// Public route for the admin index page 
// Route::get('/admin', function () {
//     return view('admin.index');
// })->middleware(['auth', 'verified'])->name('admin.index');
