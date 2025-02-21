<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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
        Session::flush();
        Auth::logout();

        return redirect(route('login'));
    }
}
