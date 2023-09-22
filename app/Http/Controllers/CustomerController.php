<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::orderby('created_at','DESC')->withTrashed()->get();
        return view('backend.customer.index',compact('customers'))->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('backend.customer.create');

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
            'name' => 'required|min:2',
            'email' => '',
            'phone' => 'required|max:11',
            'status' => '',
            'address' => '',
            'remarks' => '',

        ]);

        if ($validated == true){
            $customers = new Customer([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'phone' => $request->get('phone'),
                'status' => $request->get('status'),
                'address' => $request->get('address'),
                'remarks' => $request->get('remarks')
            ]);
            $customers->save();
        }
        return redirect()->route('customers.index')->with('success','Customer has been created successfully.');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
        return view('backend.customer.edit',compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {

        $validated = $request->validate([
            'name' => 'required|min:2',
            'email' => '',
            'phone' => 'required|max:11',
            'status' => '',
            'address' => '',
            'remarks' => '',

        ]);

        if ($validated == true){

            $customer->name = $request->get('name');
            $customer->phone = $request->get('phone');
            $customer->email = $request->get('email');
            $customer->status = $request->get('status');
            $customer->address = $request->get('address');
            $customer->remarks = $request->get('remarks');
            $customer->save();

        }
        return redirect()->route('customers.index')->with('success','Customer has been updated successfully.');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete(); // Easy right?

        return redirect()->route('customers.index')->with('success','Customer Deleted.');
    }

    public function restore($id)
    {
        Customer::where('id', $id)->withTrashed()->restore();

        return redirect()->route('customers.index')->with('Customer restored successfully.');
    }

    public function forceDelete($id)
    {
        Customer::where('id', $id)->withTrashed()->forceDelete();

        return redirect()->route('customers.index')->with('Customer force deleted successfully.');
    }


}
