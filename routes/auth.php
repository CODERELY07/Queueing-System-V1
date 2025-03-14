<?php

use App\Http\Controllers\AdminUserListController;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminCashierListController;
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
    // admin home
    Route::get('/admin', [AdminCashierListController::class, 'index'])->name('admin.index');

       //Admin User List
    Route::controller(AdminUserListController::class)->group(function(){
        Route::get('/admin/user-list-view', 'index')->name('admin.userList');
        Route::delete('admin/clients/delete-selected',  'deleteSelected')->name('clients.delete-selected');
        Route::put('admin/clients/update',  'update')->name('clients.update');
    });

    // Admin CashierListCrud
    // view cashier
    Route::get('/admin/cashier-list-view', function () {
        return view('admin.cashier-list'); 
    })->name('admin.cashierList');

    // fetch cashierList
    Route::get('/admin/cashier-list', [AdminCashierListController::class, 'cashierList']);
    //create new cashier
    Route::post('/admin/cashier-list', [AdminCashierListController::class, 'store']);
    //Updaate cashier
    Route::put('/admin/cashier-list/{id}', [AdminCashierListController::class, 'update']);
    // Delete cashierList
    Route::delete('/admin/cashier-list/{id}', [AdminCashierListController::class, 'destroy']);
    //show edit cashier
    Route::get('/admin/cashier-list/{id}', [AdminCashierListController::class, 'show']);
    //logout cashier from admin
    Route::get('/admin/cashier-list-logout/{id}', [AdminCashierListController::class, 'logout']);

});

//cashier
Route::middleware(['auth', 'role:cashier'])->group(function(){
    Route::get('/cashier', [CashierController::class, 'index'])->name('cashier.index');
});
