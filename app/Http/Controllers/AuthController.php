<?php

namespace App\Http\Controllers;

use App\Events\CashierLogStatus;
use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Log;
use Session;

class AuthController extends Controller
{
    public function login(){
        return view('auth.login');
    }

    public function loginPost(Request $request){

        $request->validate([
            'name' => 'required|string',
            'password' => 'required'
        ]);

        $credentials = $request->only('name', 'password');
        $user = User::where('name', $request->name)->first();
        // Debugging to view this go to storage/logs/laravel.log
        // Log::debug('Logged-in user details: ', ['user' => $user]);

        if (!$user) {
            return response()->json(['error' => 'No User Found']); 
        }
        
        //check if user is logged in 
        if($user->log_status == 'logged_out'){
            if(Auth::attempt($credentials)){
                $user = Auth::user();
            
                // CashierLogStatus Event To update status and update last_login
                $user->update(['log_status' => 'logged_in', 'last_login' => now()]);
                event(new CashierLogStatus($user));
                
                $request->session()->regenerate();
    
                $user = Auth::user();
        
                if ($user->role === 'admin') {
                    $redirectUrl = route('admin.index');
                } elseif ($user->role === 'cashier') {
                    $redirectUrl = route('cashier.index');
                } else {
                    $redirectUrl = route('login');
                }
                return response()->json(['success' => 'Login Successfully', 'redirectUrl' => $redirectUrl]);
            }
        }else{
            return response()->json(['error' => 'User is currently Logged in other device.']);
        }
        return response()->json(['error' => 'Invalid Credentials']);
    }
    public function logout(){
        // CashierLogStatus Event To update status
        $user = Auth::user();
        event(new CashierLogStatus($user));
        if($user){
            $user->update(['log_status' => 'logged_out']);
        }
        
        Session::flush();
        Auth::logout();

        return response()->json(['redirectUrl' => route('login')]);
    }
}
