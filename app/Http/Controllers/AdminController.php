<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;


class AdminController extends Controller
{
    // admin home
    public function index(){
        return view('admin.index');
    }
    //creaete Cashier 
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:users,name',
            'password' => 'required|min:6',
        ]);

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
        // Validate input
        $request->validate([
            'name' => 'required|unique:users,name',
            'password' => 'nullable|min:6'
        ]);
    
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
