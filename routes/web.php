<?php


use App\Http\Controllers\QueuingController;
use Illuminate\Support\Facades\Route;

// Home
Route::get('/', function () {
    if(auth()->check()){
        if(auth()->user()->role == 'admin'){
            return redirect(route('admin.index'));
        }
        return redirect(route('cashier.index'));
       
    }
    return view('auth.login');
});

Route::get('/unauthorized', function () {
    return view('errors.unauthorized'); 
})->name('unauthorized');

// Queuing
Route::controller(QueuingController::class)->group(function(){
    Route::get('/queuing', 'index')->name('queuing');
    Route::get('/queuing/monitoring', 'monitoring')->name('monitoring');
    Route::post('/queing/fireQueue', 'fireNext')->name('queue.fire');
    Route::post('/queing/fireNotification', 'fireNotification')->name('queue.fire.notification');
});

require __DIR__.'/auth.php';



