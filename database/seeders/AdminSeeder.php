<?php

namespace Database\Seeders;

use App\Models\User;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin account
        if(!User::where('name', env('ADMIN_NAME'))->exists()){
            User::create([
                'name' => env('ADMIN_NAME'),
                'password' => Hash::make(env('ADMIN_PASSWORD')),
                'role' => 'admin'
            ]);
        }
        if(!User::where('name', 'cashier')->exists()){
            User::create(attributes: [
                'name' => 'cashier',
                'password' => Hash::make('cashier123'),
                'role' => 'cashier'
            ]);
        }
        
    }
}
