<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::orderby('created_at','DESC')->withTrashed()->get();
        return view('backend.role.index',compact('roles'))->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.role.create');
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'role_name' => 'required|min:2',
            'role_des' => '',
            'status' => 'required',


        ]);

        if($validated == true){
            $role = new Role([
                'role_name' => $request->get('role_name'),
                'role_description' => $request->get('role_des'),
                'status' => $request->get('status')
            ]);
            $role->save();
            return redirect()->route('roles.index')->with('success','Role has been created successfully.');
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view('backend.role.edit',compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'role_name' => 'required|min:2',
            'role_des' => '',
            'status' => 'required',
        ]);

        if ($validated == true){

            $role->role_name = $request->get('role_name');
            $role->role_description = $request->get('role_des');
            $role->status = $request->get('status');
            $role->save();
            return redirect()->route('roles.index')->with('success','Role has been updated successfully.');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete(); // Easy right?

        return redirect()->route('roles.index')->with('success','Role Deleted.');
    }
    public function restore($id)
    {
        Role::where('id', $id)->withTrashed()->restore();

        return redirect()->route('roles.index')->with('Role restored successfully.');
    }

    public function forceDelete($id)
    {
        Role::where('id', $id)->withTrashed()->forceDelete();

        return redirect()->route('roles.index')->with('Role force deleted successfully.');
    }
}
