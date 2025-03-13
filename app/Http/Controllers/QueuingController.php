<?php

namespace App\Http\Controllers;

use App\Events\Queueing;
use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Log;

class QueuingController extends Controller
{
    public function index(){
        return view('queuing.queuing');
    }
    public function monitoring(){
        return view('queuing.monitoring');
    }
    public function getQueuingMonitoring(){
        $allQueue = Client::where('status', 'servicing')
                            ->with('cashier')
                            ->get();
        return response()->json($allQueue);
    }
    
    public function fireNext(Request $request)
    {
     
        $previousClient = Client::where('status', 'servicing')
                                ->where('cashier_id', $request->cashier_id)
                                ->orderBy('created_at', 'asc')
                                ->first();
    
        if ($previousClient) {
          
            $previousClient->status = 'done';
            $previousClient->save();
        }
        
       
        $client = Client::where('status', 'waiting')
                        ->with('cashier')
                        ->orderBy('created_at', 'asc')
                        ->first();
        
        if ($client) {
            $client->status = 'servicing';
            $client->cashier_id = $request->cashier_id;
            $client->save();
    
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
    
    public function firePrev(Request $request){
        $currentClient = Client::where('status', 'servicing')
                                ->where('cashier_id' , $request->cashier_id)
                                ->orderBy('created_at', 'asc')
                                ->first();

        if($currentClient){
            $currentClient->status = 'waiting';
            $currentClient->save();
        }
  
        
        $previousClient = Client::where('status', 'done')
        ->where('cashier_id', $request->cashier_id)
        ->orderBy('created_at', 'asc')
        ->get()->last();

        if($previousClient){
            $previousClient->status = 'servicing';
            $previousClient->save();

            // broadcast(new Queueing($previousClient));
            return response()->json([
                'client' => [
                    'id' => $previousClient->id,
                    'name' => $previousClient->name,
                    'cashier_id' => $previousClient->cashier_id,
                ]
            ]);
        }
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
