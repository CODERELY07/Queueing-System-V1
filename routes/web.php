<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QueueTransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('guest')->group(function(){
    Route::controller(QueueTransactionController::class)->group(function(){
        Route::get('/c/name', 'showQueue')->name('get.client.name');
        Route::post('/c/name', 'storeQueueNumber')->name('get.store.name');
    });
});

require __DIR__.'/auth.php';
