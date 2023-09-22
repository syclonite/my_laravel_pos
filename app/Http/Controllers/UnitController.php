<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units = Unit::orderby('created_at','DESC')->withTrashed()->get();
        return view('backend.unit.index',compact('units'))->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.unit.create');
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
//        dd($request->all());
        $validated = $request->validate([
            'unit_name' => 'required|min:2',
            'unit_des' => '',
            'status' => '',
        ]);

        if($validated == true){
            $unit = new Unit([
                'unit_name' => $request->get('unit_name'),
                'unit_description' => $request->get('unit_des'),
                'status' => '1'
            ]);
            $unit->save();
            return redirect()->route('units.index')->with('success','Unit has been created successfully.');
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function show(Unit $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function edit(Unit $unit)
    {
        return view('backend.unit.edit',compact('unit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Unit $unit)
    {
        $validated = $request->validate([
            'unit_name' => 'required|min:2',
            'unit_des' => '',
            'status' => '',
        ]);
        if ($validated == true){

            $unit->unit_name = $request->get('unit_name');
            $unit->unit_description = $request->get('unit_des');
            $unit->status = $request->get('status');
            $unit->save();
            return redirect()->route('units.index')->with('success','Unit has been updated successfully.');

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unit $unit)
    {
        $unit->delete(); // Easy right?
        return redirect()->route('units.index')->with('success','Unit Deleted.');
    }
    public function restore($id)
    {
        Unit::where('id', $id)->withTrashed()->restore();

        return redirect()->route('units.index')->with('Unit restored successfully.');
    }

    public function forceDelete($id)
    {
        Unit::where('id', $id)->withTrashed()->forceDelete();

        return redirect()->route('units.index')->with('Unit force deleted successfully.');
    }

}
