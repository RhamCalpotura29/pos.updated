<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->paginate(6);
        return view('users.index',compact('users'))->with(request()->input('page'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $users = new User();
        $users->name =$request->name;
        $users->email = $request->email;
        $users->password = Hash::make($request->password);
        $users->is_admin = $request->is_admin;
        $res = $users->save();
        if($res){
            return back()->with('success', 'You have been registered');
        }else{
            return back()->with('fail', 'Something went Wrong');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function search(Request $request, User $users )
     {
         $search = $request->input('search');
         $users = User::query()
        ->where('name', 'LIKE', "%{$search}%")
        ->orWhere('email', 'LIKE', "%{$search}%")
        ->orWhere('is_admin', 'LIKE', "%{$search}%")
        ->paginate(5);
        
        return view('users.index', compact('users'));
     }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $users = User::find($id);
        if(!$users){
            return back()->with('Error','User Not Found');
        }
        $users->update($request->all());
        return back()->with('Success','Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $users = User::find($id);
        if(!$users){
            return back()->with('Error','User Not Found');
        }
        $users->delete();
        return back()->with('Success','Deleted Successfully');
    }
}
