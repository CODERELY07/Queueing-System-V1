<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Str;

class QueueTransactionController extends Controller
{
    public function showQueue(){
        return view('index');
    }
    public function storeQueueNumber(Request $request){
        $validated = Validator::make($request->all(),[
            'name' => 'required|string|unique:clients,name'
        ]);
        $response = failsReponse200($validated);
        
        if($response){
            return $response;
        }

        $client = Client::create($request->all());
        $transactionNumber = Str::padLeft($client->id, 4, '0');
        return response()->json([
            'transactionNumber' => $transactionNumber,
            'name' => $client->name
        ]);
        
    }
}
