<?php

namespace App\Http\Controllers;

use App\Models\Suppliers;
use Illuminate\Http\Request;

class SuppliersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Suppliers::orderby('created_at','DESC')->withTrashed()->get();
        return view('backend.suppliers.index',compact('suppliers'))->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.suppliers.create');
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
            'phone' => 'required|max:11',
            'remarks' => '',
            'status' => '',
            'address' => '',
        ]);

        if ($validated == true){
            $suppliers = new Suppliers([
                'supplier_name' => $request->get('name'),
                'phone_1' => $request->get('phone'),
                'remarks' => $request->get('remarks'),
                'status' => $request->get('status'),
                'address' => $request->get('address')
            ]);
            $suppliers->save();
            return redirect()->route('suppliers.index')->with('success','Supplier has been created successfully.');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Suppliers  $suppliers
     * @return \Illuminate\Http\Response
     */
    public function show(Suppliers $suppliers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Suppliers  $suppliers
     * @return \Illuminate\Http\Response
     */
    public function edit(Suppliers $supplier)
    {
//        dd($supplier);
        return view('backend.suppliers.edit',compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Suppliers  $suppliers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Suppliers $supplier)
    {

        $validated = $request->validate([
            'name' => 'required|min:2',
            'phone' => 'required|max:11',
            'remarks' => '',
            'status' => '',
            'address' => '',
        ]);
        if ($validated == true){
            $supplier->supplier_name = $request->get('name');
            $supplier->phone_1 = $request->get('phone');
            $supplier->remarks = $request->get('remarks');
            $supplier->status = $request->get('status');
            $supplier->address = $request->get('address');
            $supplier->save();
            return redirect()->route('suppliers.index')->with('success','Supplier has been updated successfully.');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Suppliers  $suppliers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Suppliers $supplier)
    {
        $supplier->delete(); // Easy right?
        return redirect()->route('suppliers.index')->with('success','Supplier Deleted.');
    }

    public function restore($id)
    {
        Suppliers::where('id', $id)->withTrashed()->restore();

        return redirect()->route('suppliers.index')->with('Supplier restored successfully.');
    }

    public function forceDelete($id)
    {
        Suppliers::where('id', $id)->withTrashed()->forceDelete();

        return redirect()->route('suppliers.index')->with('Suppliers force deleted successfully.');
    }

}
