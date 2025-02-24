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
        // CashierListEvent
        Route::post('/login', 'loginPost')->name('login.post');
    });
});

// Routes for logged-in users (authenticated)
Route::middleware('auth')->group(function() {
    // Logout Route/CashierListEvent
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// admin
Route::middleware(['auth', 'role:admin'])->group(function(){
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

    // Admin CashierListCrud
    // view cashier
    Route::get('/admin/cashier-list-view', function () {
        return view('admin.cashier-list'); 
    })->name('admin.cashierList');
    // fetch cashierList
    Route::get('/admin/cashier-list', [AdminController::class, 'cashierList']);
    //create new cashier
    Route::post('/admin/cashier-list', [AdminController::class, 'store']);
    //Updaate cashier
    Route::put('/admin/cashier-list/{id}', [AdminController::class, 'update']);
    // Delete cashierList
    Route::delete('/admin/cashier-list/{id}', [AdminController::class, 'destroy']);
    //show edit cashier
    Route::get('/admin/cashier-list/{id}', [AdminController::class, 'show']);

});

//cashier
Route::middleware(['auth', 'role:cashier'])->group(function(){
    Route::get('/cashier', [CashierController::class, 'index'])->name('cashier.index');
});
