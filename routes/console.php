<?php

use App\Models\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


Schedule::call(callback: function () {
    $dayAgo = Carbon::now()->subDay(); 

    $users = User::where('last_login', '<', $dayAgo)->get();
    
    foreach ($users as $user) {
        // Set status to inactive for users that is not logged  everyday
        $user->update(['status' => 'inactive']);
        \Log::info("User ID: {$user->id} status updated to inactive.");
    }
    
    $users = User::where('last_login', '>=', $dayAgo)->get();
    
    foreach ($users as $user) {
        // Set status to active for users that is logged  everyday
        $user->update(['status' => 'active']);
        \Log::info("User ID: {$user->id} status updated to inactive.");
    }

})->daily();