<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class CashierController extends Controller
{
    public function index(){
        return view('cashier.index');
    }
    public function getCashierQueuing(Request $request){
        $cashierQueue = Client::where('status', 'servicing')->where('cashier_id', $request->cashier_id)->first();
        return response()->json($cashierQueue);
    }
}
