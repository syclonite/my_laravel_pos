<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function index()
    {
//        $users = User::withTrashed()->get();
//        $check = Auth::id();
        $users = User::orderBy('created_at','DESC')->withTrashed()->get();
//        $roles = Role::get();
        return view('backend.user.index',compact('users'))->with('i');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get();
        return view('backend.user.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request);

        $validated = $request->validate([
            'name' => 'required|min:2',
            'email' => 'required|email|min:5',
            'password' => 'required',
            'phone' => 'required|max:11',
            'role_id'=>'required'
        ]);

        if ($validated == true){
            $users = new User([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => bcrypt($request->get('password')),
                'phone' => $request->get('phone'),
                'status' => $request->get('status'),
                'address' => $request->get('address'),
                'role_id' => $request->get('role_id'),
            ]);
            $users->save();
            return redirect()->route('users.index')->with('success','User has been created successfully.');
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::get();
        return view('backend.user.edit',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
//        dd($request->all());

        $validated = $request->validate([
            'name' => 'required|min:2',
            'email' => 'required|email|min:5',
            'phone' => 'required|max:11',
            'role_id' => 'required',
        ]);

        if ($validated == true){
            if ($request->get('password') == '') {
                $user->name = $request->get('name');
                $user->phone = $request->get('phone');
                $user->email = $request->get('email');
                $user->status = $request->get('status');
                $user->address = $request->get('address');
                $user->role_id = $request->get('role_id');
                $user->save();
                return redirect()->route('users.index')->with('success','User has been updated successfully.');
            } else {
                $user->name = $request->get('name');
                $user->phone = $request->get('phone');
                $user->email = $request->get('email');
                $user->password = bcrypt($request->get('password'));
                $user->status = $request->get('status');
                $user->address = $request->get('address');
                $user->role_id = $request->get('role_id');
                $user->save();
                return redirect()->route('users.index')->with('success','User has been updated successfully.');
            }

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete(); // Easy right?

        return redirect()->route('users.index')->with('success','User Deleted.');
    }
    public function restore($id)
    {
        User::where('id', $id)->withTrashed()->restore();

        return redirect()->route('users.index')->with('User restored successfully.');
    }

    public function forceDelete($id)
    {
        User::where('id', $id)->withTrashed()->forceDelete();

        return redirect()->route('users.index')->with('User force deleted successfully.');
    }

}
