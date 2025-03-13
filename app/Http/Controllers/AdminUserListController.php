<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
    
class AdminUserListController extends Controller
{
    public function index(){
        $clients = Client::with('cashier')
                         ->orderBy('created_at', 'asc')
                         ->paginate(7);
        return view('admin.users-list', ['clients' => $clients]);
    }
    public function deleteSelected(Request $request){
        $clientIds = $request->input('selected_clients');
        
        if ($clientIds) {
            Client::whereIn('id', $clientIds)->delete();
        }
        
        return redirect()->route('admin.userList')->with('success', 'Clients deleted successfully');
    }

   public function update(Request $request){
        $validatedData = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'status' => 'required|in:waiting,servicing,done',
        ]);

        $client = Client::find($request->client_id);
        $client->status = $request->status; 
        $client->save();

        return redirect()->route('admin.userList')->with('success', 'Client status updated successfully');
    }

    

}
