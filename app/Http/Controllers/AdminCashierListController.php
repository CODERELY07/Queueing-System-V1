<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class AdminCashierListController extends Controller
{
    // admin home
    public function index(){
        return view('admin.index');
    }
    //creaete Cashier 
    public function store(Request $request)
    {
         $validator = Validator::make($request->all(),[
            'name' => 'required|unique:users,name',
            'password' => 'required|min:6',
        ]);

        $response = failsReponse200($validator);
        
        if($response){
            return $response;
        }
          

        $hashed = Hash::make($request->password);

        $cashier = User::create([
            'name' => $request->name,
            'password' => $hashed
        ]);
        return response()->json( $cashier);
    }
    // Fetch cashier list
    public function cashierList(){
        return response()->json(User::all()->where('role', 'cashier'));
    }

    //update cashier
    public function update(Request $request, $id)
    {

         $validator = Validator::make($request->all(),[
            'name' => 'required|unique:users,name,' .$id,
            'password' => 'nullable|min:6',
        ]);

        $response = failsReponse200($validator);
        if($response){
            return $response;
        }
        $cashier = User::findOrFail($id);
    
        $updateData = [
            'name' => $request->name,
        ];

        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }
    
        $cashier->update($updateData);
    
        return response()->json($cashier);
    }
    
    //show cashier data in the modal
    public function show($id){
        return response()->json(User::findOrFail($id));
    }
    //delete
    public function destroy($id){
        User::destroy($id);
        return response()->json(['message' => 'Cashier Deleted Successfully!']);
    }
}
