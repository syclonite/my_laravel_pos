<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderDetail;
use App\Models\Stock;
use App\Models\StockCount;
use App\Models\SupplierPaymentDetails;
use App\Models\Suppliers;
use App\Models\Unit;
use App\CustomClass\StockManipulation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchaseOrders = PurchaseOrder::orderBy('created_at','DESC')->get();
        return view('backend.purchase.purchase_order_index',compact('purchaseOrders'))->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::where('status',1)->orderBy('created_at','DESC')->get();
        $suppliers = Suppliers::where('status',1)->orderBy('created_at','DESC')->get();
        $units = Unit::where('status',1)->orderBy('created_at','DESC')->get();
        return view('backend.purchase.purchase_order_create',compact('products','suppliers','units'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
//        dd($request->all());
//        $test = $request['purchase_order']['billing_amount'];

        $validator = Validator::make($request[ 'purchase_order'], [
            'supplier_id' => 'required',
            'billing_amount' => 'required|min:1',
            'status' => 'required',
        ]);
        if ($validator->validated()){
            DB::transaction(function() use ($request) {
//            dd($request->all());
                $purchase_order = new PurchaseOrder([
                    'supplier_id' => $request['purchase_order']['supplier_id'],
                    'user_id' => Auth::id(),
                    'billing_amount' => $request['purchase_order']['billing_amount'],
                    'paid_amount' => $request['purchase_order']['paid_amount'],
                    'extra_charge' => $request['purchase_order']['extra_charge'],
                    'discount' => $request['purchase_order']['discount'],
                    'status' => $request['purchase_order']['status'],
                ]);
                $purchase_order->save();
                if($request['purchase_order']['status'] == 1){
                    SupplierPaymentDetails::create([
                        'purchase_order_id' => $purchase_order->id,
                        'supplier_id' => $request['purchase_order']['supplier_id'],
                        'paid_amount' => $request['purchase_order']['paid_amount'],
                        'status' => $request['purchase_order']['status'],
                    ]);
                }
                $purchase_order_details = $request['purchase_order_details'];
                $stocks = new StockManipulation();
                foreach ($purchase_order_details as $purchase_order_detail){
//            dd($purchase_order_detail['quantity']);
                    PurchaseOrderDetail::create([
                        'supplier_id' => $request['purchase_order']['supplier_id'],
                        'user_id' => Auth::id(),
                        'purchase_order_id' =>  $purchase_order->id,
                        'product_id' => $purchase_order_detail['product_id'],
                        'unit_id' => $purchase_order_detail['unit_id'],
                        'quantity' => $purchase_order_detail['quantity'],
                        'purchase_amount' => $purchase_order_detail['purchase_price'],
                        'selling_amount' => $purchase_order_detail['selling_price'],
                        'status' => '1',
                        'discount' =>'0',
                        'extra_charge' => '0'
                    ]);
                    $stocks->add_stock([
                        'supplier_id' => $request['purchase_order']['supplier_id'],
                        'purchase_order_id' => $purchase_order->id,
                        'unit_id' => $purchase_order_detail['unit_id'],
                        'product_id' => $purchase_order_detail['product_id'],
                        'quantity' => $purchase_order_detail['quantity'],
                        'purchase_amount' => $purchase_order_detail['purchase_price'],
                        'selling_amount' => $purchase_order_detail['selling_price'],
                    ]);
                }

                $stocks->add_update_total_stock($request);

                $result_data = array('success' => true,'link' => route('purchase.print_purchase_invoice',$purchase_order->id));
                echo json_encode($result_data);
            });

        }
//        return response()->json([
//            'message' => "Please Put the Values Correctly"
//        ]);

//        return route('purchase.index')->with('success','Purchase successful.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function show(PurchaseOrder $purchaseOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchaseOrder $id)
    {
        $products = Product::where('status',1)->get();
        $suppliers = Suppliers::where('status',1)->get();
        $units = Unit::where('status',1)->get();
        $purchase_order = PurchaseOrder::find($id)->first();
        $purchase_order_details = PurchaseOrderDetail::where('purchase_order_id',$purchase_order->id)->get();
        return view('backend.purchase.purchase_order_edit', compact('purchase_order','purchase_order_details','suppliers','products','units'))->with('i');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PurchaseOrder $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
//        dd($request->all());

        $validator = Validator::make($request[ 'purchase_order'], [
            'supplier_id' => 'required',
            'billing_amount' => 'required|min:1',
            'status' => 'required',
        ]);

        if ($validator->validated()){
            DB::transaction(function() use ($request,$id) {

                $purchase_order = PurchaseOrder::find($id);
                $purchase_order->supplier_id = $request['purchase_order']['supplier_id'];
                $purchase_order->user_id = Auth::id();
                $purchase_order->billing_amount = $request['purchase_order']['billing_amount'];
                $purchase_order->paid_amount = $request['purchase_order']['paid_amount'];
                $purchase_order->extra_charge = $request['purchase_order']['extra_charge'];
                $purchase_order->discount = $request['purchase_order']['discount'];
                $purchase_order->status = $request['purchase_order']['status'];
                $purchase_order->save();
                if($request['purchase_order']['status'] == 1){
                    $get_supplier_payment_details = SupplierPaymentDetails::where('purchase_order_id',$purchase_order->id)->get();
//                    dd($get_supplier_payment_details->isEmpty());
                    if ($get_supplier_payment_details->isEmpty()){
                        SupplierPaymentDetails::create([
                            'purchase_order_id' => $purchase_order->id,
                            'supplier_id' => $request['purchase_order']['supplier_id'],
                            'paid_amount' => $request['purchase_order']['paid_amount'],
                            'status' => $request['purchase_order']['status'],
                        ]);
                    }elseif ($get_supplier_payment_details->isNotEmpty()){
                        SupplierPaymentDetails::where('purchase_order_id',$purchase_order->id)->update([
                            'supplier_id' => $request['purchase_order']['supplier_id'],
                            'paid_amount' => $request['purchase_order']['paid_amount'],
                            'status' => $request['purchase_order']['status']
                        ]);
                    }

                }
                $purchase_order_details = $request['purchase_order_details'];
                $stocks = new StockManipulation();
                $stocks->update_purchase_order_total_quantity($purchase_order_details,$id);
                PurchaseOrderDetail::where('purchase_order_id',$id)->delete();
                Stock::where('purchase_order_id',$id)->delete();
                foreach ($purchase_order_details as $purchase_order_detail) {
//            dd($purchase_order_detail['quantity']);
                    PurchaseOrderDetail::create([
                        'supplier_id' => $request['purchase_order']['supplier_id'],
                        'user_id' => Auth::id(),
                        'purchase_order_id' => $purchase_order->id,
                        'product_id' => $purchase_order_detail['product_id'],
                        'unit_id' => $purchase_order_detail['unit_id'],
                        'quantity' => $purchase_order_detail['quantity'],
                        'purchase_amount' => $purchase_order_detail['purchase_price'],
                        'selling_amount' => $purchase_order_detail['selling_price'],
                        'status' => '1',
                        'discount' => '0',
                        'extra_charge' => '0'
                    ]);
                    $stocks->update_stock([
                        'supplier_id' => $request['purchase_order']['supplier_id'],
                        'purchase_order_id' => $purchase_order->id,
                        'unit_id' => $purchase_order_detail['unit_id'],
                        'product_id' => $purchase_order_detail['product_id'],
                        'quantity' => $purchase_order_detail['quantity'],
                        'purchase_amount' => $purchase_order_detail['purchase_price'],
                        'selling_amount' => $purchase_order_detail['selling_price'],
                    ]);
                }
            });
        }

//        $stocks->add_update_total_stock($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PurchaseOrder  $purchase_order
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::transaction(function() use ($id) {
            $purchase_order_id = PurchaseOrder::find($id);
//        dd($purchase_order_id->id);
            $purchase_order_details = PurchaseOrderDetail::where('purchase_order_id',$purchase_order_id->id)->get();
//      dd($purchase_order_details);
            foreach ($purchase_order_details as $purchase_order_detail){
//            dd($purchase_order_detail);
                $product_id = $purchase_order_detail->product_id;
                $unit_id = $purchase_order_detail->unit_id;
                $quantity = $purchase_order_detail->quantity;
                $stock_quantity = StockCount::where([['product_id',$product_id],['unit_id',$unit_id]])->value('total_quantity');
                $subtraction = $stock_quantity - $quantity;
                StockCount::where([['product_id',$product_id],['unit_id',$unit_id]])->update([
                    'total_quantity' => $subtraction
                ]);
                Product::where([['id',$product_id],['unit_id',$unit_id]])->update([
                    'quantity' => $subtraction
                ]);
            }
            $purchase_order_id->delete(); // Easy right?
            SupplierPaymentDetails::where('purchase_order_id',$id)->delete(); // Easy right?
//        $stocks = new StockManipulation();
//        $stocks->adjust_total_stock($data);
        });

        return redirect()->route('purchase.index')->with('success','Purchase Order Deleted.');
    }

    public function get_supplier(Request $request)
    {
//        dd($request['id']);
        $supplier_data = Suppliers::where('id',$request['id'])->first();
        return json_encode(array('supplier_data'=>$supplier_data));
//        return response()->json(['customer_data'=>$customer_data]);

    }

    public function add_new_supplier(Request $request)
    {
        $validator = Validator::make($request[ 'suppliers'], [
            'supplier_name' => 'required',
            'supplier_phone' => 'required|max:11',
        ]);
        if ($validator->validated()){
            DB::transaction(function() use ($request) {
                $add_supplier = new Suppliers([
                    'supplier_name' => $request['suppliers']['supplier_name'],
                    'phone_1' => $request['suppliers']['supplier_phone'],
                    'address' => $request['suppliers']['supplier_address'],
                    'status' => '1',
                ]);
                $add_supplier->save();
            });
        }
//        dd($request->all());

    }

    public function get_supplier_ajax(Request $request){
        if ($request == true){
            $supplier_data_ajax = Suppliers::orderBy('created_at','DESC')->get();
            return json_encode(array('supplier_data_ajax'=>$supplier_data_ajax));
        }

    }

    public function add_new_unit(Request $request){
        $validator = Validator::make($request[ 'units'], [
            'unit_name' => 'required',
            'unit_des' => '',
            'status' => '',
        ]);
        if ($validator->validated()){
            DB::transaction(function() use ($request) {
                $add_unit = new Unit([
                    'unit_name' => $request['units']['unit_name'],
                    'unit_description' => $request['units']['unit_des'],
                    'status' => '1',
                ]);
                $add_unit->save();
            });

        }

    }

    public function get_units_all_ajax(Request $request)
    {
//        if ($request == true) {
//            $units_data_ajax = Unit::orderBy('created_at', 'DESC')->get();
            $units = Unit::select('unit_name','id')->where('status',1)->where('unit_name','Like','%'.$request->search.'%')->get();
            return response()->json($units);
//            return json_encode(array('units_data_ajax' => $units_data_ajax));
//        }
    }

    public function print_purchase_invoice($id){

//        if ($id == 1){
//            $purchase_order = PurchaseOrder::latest()->first(['id','supplier_id','created_at','extra_charge','discount','billing_amount','paid_amount']);
//        $suppliers = Suppliers::find($purchase_order->supplier_id);
//        $purchase_order_details = PurchaseOrderDetail::where('purchase_order_id',$purchase_order->id)->get();
//        return view('backend.purchase.print_purchase_invoice',compact('purchase_order','suppliers','purchase_order_details'));
//        }else{
            $purchase_order = PurchaseOrder::find($id);
            $suppliers = Suppliers::find($purchase_order->supplier_id);
            $purchase_order_details = PurchaseOrderDetail::where('purchase_order_id',$purchase_order->id)->get();
            return view('backend.purchase.print_purchase_invoice',compact('purchase_order','suppliers','purchase_order_details'));
//        }
    }


}
