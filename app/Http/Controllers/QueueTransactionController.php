<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Str;

class QueueTransactionController extends Controller
{
    public function showQueue(){
        return view('index');
    }
    public function storeQueueNumber(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|unique:clients,name'
        ]);

        $client = Client::create($validated);
        $transactionNumber = Str::padLeft($client->id, 4, '0');
        return response()->json([
            'transactionNumber' => $transactionNumber,
            'name' => $client->name
        ]);
        
    }
}
