<?php

namespace App\Http\Controllers;

use App\Events\Queueing;
use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class QueuingController extends Controller
{
    public function index(){
        return view('queuing.queuing');
    }
    public function monitoring(){
        return view('queuing.monitoring');
    }
    public function fireNext(Request $request){
       $client = Client::where('status', 'waiting')
                         ->orderBy('created_at', 'asc')
                         ->first();

      if($client){
        $client->status = 'servicing';
        $client->cashier_id = $request->cashier_id;
        $client->save();

        broadcast(new Queueing($client));

        return response()->json([
            'client' => [
                'id' => $client->id,
                'name' => $client->name,
                'cashier_id' => $client->cashier_id,
            ]
        ]);
      }
      return response()->json(['message' => 'No clients in the queue']);

    }

    public function fireNotification(Request $request){
        $client = Client::where('status', 'servicing')
        ->where('cashier_id', $request->cashier_id)
        ->orderBy('created_at', 'desc')
        ->first();
        if($client){
    
            broadcast(new Queueing($client));
    
            return response()->json([
                'client' => [
                    'id' => $client->id,
                    'name' => $client->name,
                    'cashier_id' => $client->cashier_id,
                ]
            ]);
          }

    }
}
