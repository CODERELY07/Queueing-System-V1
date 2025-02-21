<?php


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
    return view('errors.unauthorized'); // create a corresponding view
})->name('unauthorized');


require __DIR__.'/auth.php';



