<?php

namespace App\Http\Controllers;

use App\Events\CashierLogStatus;
use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
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
        if(Auth::attempt($credentials)){
            $user = Auth::user();

            // CashierLogStatus Event To update status
            $user->update(['log_status' => 'logged_in']);
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
