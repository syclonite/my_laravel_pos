<?php

namespace App\Http\Controllers;

use App\CustomClass\StockManipulation;
use App\Models\Customer;
use App\Models\CustomerPaymentDetails;
use App\Models\Product;
use App\Models\SaleOrder;
use App\Models\SaleOrderDetail;
use App\Models\Stock;
use App\Models\StockCount;
use App\Models\Unit;
use http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SaleOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sale_orders = SaleOrder::orderBy('created_at', 'DESC')->where('customer_id','<>','')->get();
        return view('backend.sale.sale_order_index', compact('sale_orders'))->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::where('status',1)->get();
        $units = Unit::where('status',1)->get();
//        $customers = Customer::where('name', 'Walking Customer')->get();
        $customers = Customer::get();
        $customers_due = Customer::where('name', '!=', 'Walking Customer')->get();
        $sale_order_bill_no = SaleOrder::pluck('id')->last();
//        $customers_due_ajax = Customer::where('name','!=','Walking Customer')->get();
//        return json_encode(array('customer_data'=>$customers_due_ajax));
        return view('backend.sale.sale_order_create', compact('products', 'units', 'customers', 'sale_order_bill_no', 'customers_due'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return false|\Illuminate\Http\JsonResponse|string
     */
    public function store(Request $request)
    {
//        dd($request->all());
        $validator = Validator::make($request[ 'sale_order'], [
            'customer_id' => 'required',
            'billing_amount' => 'required|min:1',
            'quantity' => 'required',
//            'status' => 'required',
        ]);
//        dd($validator->errors());
        if ($validator->validated()) {
//            dd($request->all());
//            DB::transaction(function () use ($request) {
                $sale_order = new SaleOrder([
                    'customer_id' => $request['sale_order']['customer_id'],
                    'user_id' => Auth::id(),
                    'billing_amount' => $request['sale_order']['billing_amount'],
                    'paid_amount' => $request['sale_order']['paid_amount'],
                    'extra_charge' => $request['sale_order']['extra_charge'],
                    'discount' => $request['sale_order']['discount'],
                    'status' => $request['sale_order']['status'],
                ]);
                $sale_order->save();
                $sale_order_details = $request['sale_order_details'];
                foreach ($sale_order_details as $sale_order_detail) {
//            dd($sale_order_detail);
                    SaleOrderDetail::create([
                        'customer_id' => $request['sale_order']['customer_id'],
                        'user_id' => Auth::id(),
                        'sale_order_id' => $sale_order->id,
                        'product_id' => $sale_order_detail['product_id'],
                        'unit_id' => $sale_order_detail['unit_id'],
                        'quantity' => $sale_order_detail['quantity'],
                        'product_selling_price' => $sale_order_detail['product_price'],
                        'status' => $request['sale_order']['status'],
                        'discount' => '0',
                        'extra_charge' => '0'
                    ]);

                    $current_stock = Stock::where([['product_id', $sale_order_detail['product_id']], ['unit_id', $sale_order_detail['unit_id']]])->get();
                    if ($current_stock->isEmpty()) {
                        $stock_count_quantity = StockCount::where([['product_id', $sale_order_detail['product_id']], ['unit_id', $sale_order_detail['unit_id']]])->value('total_quantity');
                        $sale_order_quantity = $sale_order_detail['quantity'];
                        $total_quantity = $stock_count_quantity - $sale_order_quantity;
                        StockCount::where([['product_id', $sale_order_detail['product_id']], ['unit_id', $sale_order_detail['unit_id']]])->update([
                            'total_quantity'=>$total_quantity
                        ]);
                        Product::where([['id', $sale_order_detail['product_id']], ['unit_id', $sale_order_detail['unit_id']]])->update([
                            'quantity'=>$total_quantity
                        ]);

                    } else {
                        $stocks = new StockManipulation();
                        $stocks->reduce_stock($sale_order_details);
                        $stock_count_quantity = StockCount::where([['product_id', $sale_order_detail['product_id']], ['unit_id', $sale_order_detail['unit_id']]])->value('total_quantity');
                        $sale_order_quantity = $sale_order_detail['quantity'];
                        $total_quantity = $stock_count_quantity - $sale_order_quantity;
                        StockCount::where([['product_id', $sale_order_detail['product_id']], ['unit_id', $sale_order_detail['unit_id']]])->update([
                            'total_quantity'=>$total_quantity
                        ]);
                        Product::where([['id', $sale_order_detail['product_id']], ['unit_id', $sale_order_detail['unit_id']]])->update([
                            'quantity'=>$total_quantity
                        ]);

//                        $stocks->mail_current_stock();
                    }

                }

                if($request['sale_order']['status'] == 1){
                    CustomerPaymentDetails::create([
                        'sale_order_id' => $sale_order->id,
                        'customer_id' => $request['sale_order']['customer_id'],
                        'paid_amount' => $request['sale_order']['paid_amount'],
                        'status' => $request['sale_order']['status'],
                    ]);
                }
//            });

            $result_data = array('success' => true,'link' => route('sales.print_sale_invoice',$sale_order->id));
            echo json_encode($result_data);

//            return response()->json(['success' => true,'status' => "redirect",'url' => "sales/print_sale_invoice/$sale_order->id"]);

        }
//
//            return response()->json([
//                'message' => "Please Put the Values Correctly"
//            ]);

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $products = Product::where('status',1)->get();
        $units = Unit::where('status',1)->get();
        $customers = Customer::all();
        $sale_order = SaleOrder::find($id);
        $sale_order_details = SaleOrderDetail::get()->where('sale_order_id', $id);
        return view('backend.sale.sale_order_edit', compact('sale_order', 'sale_order_details', 'customers', 'products', 'units'))->with('i');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
//        dd($request->all());
        $validator = Validator::make($request[ 'sale_order'], [
            'customer_id' => 'required',
            'billing_amount' => 'required|min:1',
//            'status' => 'required',
        ]);
        if ($validator->validated()){
            DB::transaction(function() use ($request, $id) {
                $sale_order = SaleOrder::find($id);
                $sale_order_id = SaleOrder::where('id', $id)->pluck('id');
                $sale_order->customer_id = $request['sale_order']['customer_id'];
                $sale_order->user_id = Auth::id();
                $sale_order->billing_amount = $request['sale_order']['billing_amount'];
                $sale_order->paid_amount = $request['sale_order']['paid_amount'];
                $sale_order->extra_charge = $request['sale_order']['extra_charge'];
                $sale_order->discount = $request['sale_order']['discount'];
                $sale_order->status = $request['sale_order']['status'];
                $sale_order->save();
                if($request['sale_order']['status'] == 1){
                    $get_customer_payment_details = CustomerPaymentDetails::where('sale_order_id',$sale_order->id)->get();
//                    dd($get_supplier_payment_details->isEmpty());
                    if ($get_customer_payment_details->isEmpty()){
                        CustomerPaymentDetails::create([
                            'sale_order_id' => $sale_order->id,
                            'customer_id' => $request['sale_order']['customer_id'],
                            'paid_amount' => $request['sale_order']['paid_amount'],
                            'status' => $request['sale_order']['status'],
                        ]);
                    }elseif ($get_customer_payment_details->isNotEmpty()){
                        CustomerPaymentDetails::where('sale_order_id',$sale_order->id)->update([
                            'customer_id' => $request['sale_order']['customer_id'],
                            'paid_amount' => $request['sale_order']['paid_amount'],
                            'status' => $request['sale_order']['status']
                        ]);
                    }

                }
                $sale_order_details = $request['sale_order_details'];
                $stock = new StockManipulation();
                foreach ($sale_order_details as $sale_order_detail) {
                    $current_stock = Stock::where([['product_id', $sale_order_detail['product_id']], ['unit_id', $sale_order_detail['unit_id']]])->get();
                    if ($current_stock->isEmpty()) {
                        $stock_count_quantity = StockCount::where([['product_id', $sale_order_detail['product_id']], ['unit_id', $sale_order_detail['unit_id']]])->value('total_quantity');
                        $sale_order_detail_quantity = SaleOrderDetail::where([['sale_order_id',$id],['product_id', $sale_order_detail['product_id']], ['unit_id', $sale_order_detail['unit_id']]])->value('quantity');
                        $quantity_parameters = $sale_order_detail['quantity'];

                        if ($sale_order_detail_quantity > $quantity_parameters){
                            $calculate_quantity = $stock_count_quantity + $quantity_parameters;
                            StockCount::where([['product_id', $sale_order_detail['product_id']], ['unit_id', $sale_order_detail['unit_id']]])->update([
                                'total_quantity'=>$calculate_quantity
                            ]);
                            Product::where([['id', $sale_order_detail['product_id']], ['unit_id', $sale_order_detail['unit_id']]])->update([
                                'quantity'=>$calculate_quantity
                            ]);

//            dd($purchase_order_detail['quantity']);
                            SaleOrderDetail::where([['sale_order_id',$sale_order->id],['product_id',$sale_order_detail['product_id']],['unit_id',$sale_order_detail['unit_id']]])->update([
                                'customer_id' => $request['sale_order']['customer_id'],
                                'user_id' => Auth::id(),
                                'sale_order_id' => $sale_order->id,
                                'product_id' => $sale_order_detail['product_id'],
                                'unit_id' => $sale_order_detail['unit_id'],
                                'quantity' => $sale_order_detail['quantity'],
                                'product_selling_price' => $sale_order_detail['product_price'],
                                'status' => '1',
                                'discount' => '0',
                                'extra_charge' => '0'
                            ]);

                        }elseif ($stock_count_quantity == $sale_order_detail_quantity){

                            StockCount::where([['product_id', $sale_order_detail['product_id']],['unit_id', $sale_order_detail['unit_id']]])->update([
                                'total_quantity'=>$sale_order_detail_quantity
                            ]);

                            Product::where([['id', $sale_order_detail['product_id']], ['unit_id', $sale_order_detail['unit_id']]])->update([
                                'quantity'=>$sale_order_detail_quantity
                            ]);

//            dd($purchase_order_detail['quantity']);
                            SaleOrderDetail::where([['sale_order_id',$sale_order->id],['product_id',$sale_order_detail['product_id']],['unit_id',$sale_order_detail['unit_id']]])->update([
                                'customer_id' => $request['sale_order']['customer_id'],
                                'user_id' => Auth::id(),
                                'sale_order_id' => $sale_order->id,
                                'product_id' => $sale_order_detail['product_id'],
                                'unit_id' => $sale_order_detail['unit_id'],
                                'quantity' => $sale_order_detail['quantity'],
                                'product_selling_price' => $sale_order_detail['product_price'],
                                'status' => '1',
                                'discount' => '0',
                                'extra_charge' => '0'
                            ]);

                        }elseif ($sale_order_detail_quantity < $quantity_parameters){
                            $result = $quantity_parameters - $sale_order_detail_quantity;
                            $quantity_result = $stock_count_quantity - $result;

                            StockCount::where([['product_id', $sale_order_detail['product_id']], ['unit_id', $sale_order_detail['unit_id']]])->update([
                                'total_quantity'=>$quantity_result
                            ]);

                            Product::where([['id', $sale_order_detail['product_id']], ['unit_id', $sale_order_detail['unit_id']]])->update([
                                'quantity'=>$quantity_result
                            ]);

//            dd($purchase_order_detail['quantity']);
                            SaleOrderDetail::where([['sale_order_id',$sale_order->id],['product_id',$sale_order_detail['product_id']],['unit_id',$sale_order_detail['unit_id']]])->update([
                                'customer_id' => $request['sale_order']['customer_id'],
                                'user_id' => Auth::id(),
                                'sale_order_id' => $sale_order->id,
                                'product_id' => $sale_order_detail['product_id'],
                                'unit_id' => $sale_order_detail['unit_id'],
                                'quantity' => $sale_order_detail['quantity'],
                                'product_selling_price' => $sale_order_detail['product_price'],
                                'status' => '1',
                                'discount' => '0',
                                'extra_charge' => '0'
                            ]);
                        }

                    }else{
                        $stock->update_sale_order_total_quantity($sale_order_details,$id);
                        $stock->restore_stock($sale_order_id);
//                        SaleOrderDetail::where('sale_order_id', $id)->delete();
//            dd($purchase_order_detail['quantity']);
//                        SaleOrderDetail::create([
//                            'customer_id' => $request['sale_order']['customer_id'],
//                            'user_id' => Auth::id(),
//                            'sale_order_id' => $sale_order->id,
//                            'product_id' => $sale_order_detail['product_id'],
//                            'unit_id' => $sale_order_detail['unit_id'],
//                            'quantity' => $sale_order_detail['quantity'],
//                            'product_selling_price' => $sale_order_detail['product_price'],
//                            'status' => '1',
//                            'discount' => '0',
//                            'extra_charge' => '0'
//                        ]);
                        SaleOrderDetail::where([['sale_order_id',$sale_order->id],['product_id',$sale_order_detail['product_id']],['unit_id',$sale_order_detail['unit_id']]])->update([
                            'customer_id' => $request['sale_order']['customer_id'],
                            'user_id' => Auth::id(),
                            'sale_order_id' => $sale_order->id,
                            'product_id' => $sale_order_detail['product_id'],
                            'unit_id' => $sale_order_detail['unit_id'],
                            'quantity' => $sale_order_detail['quantity'],
                            'product_selling_price' => $sale_order_detail['product_price'],
                            'status' => '1',
                            'discount' => '0',
                            'extra_charge' => '0'
                        ]);

                        $stock->reduce_stock($sale_order_details);
                    }

                }
            });
        }

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        DB::transaction(function() use ($id) {
            $sale_order_id = SaleOrder::where('id',$id)->pluck('id');
            $sale_order = SaleOrder::where('id',$id)->firstOrFail();
            $stocks = new StockManipulation();
            $stocks->restore_stock($sale_order_id);
//            $sale_order_id_data = SaleOrderDetail::where('sale_order_id',$sale_order);
            CustomerPaymentDetails::where('sale_order_id',$id)->delete(); // Easy right?
            SaleOrderDetail::where('sale_order_id',$id)->delete(); // Easy right?
            $sale_order->delete(); // Easy right?
        });
        return redirect()->route('sales.index')->with('success','Order Deleted.');
    }

    /**
     * @param Request $request
     * @return false|\Illuminate\Http\JsonResponse|string
     */
    public function get_customer(Request $request)
    {
//        dd($request['id']);
        $customer_data = Customer::where('id',$request['id'])->first();
        return json_encode(array('customer_data'=>$customer_data));
//        return response()->json(['customer_data'=>$customer_data]);

    }

    public function add_new_customer(Request $request)
    {
//        dd($request['customers']);
        $validator = Validator::make($request[ 'customers'], [
            'name' => 'required',
            'phone' => 'required|max:11',
        ]);
        if ($validator->validated()){
            DB::transaction(function() use ($request) {
                $add_customer = new Customer([
                    'name' => $request['customers']['name'],
                    'phone' => $request['customers']['phone'],
                    'address' => $request['customers']['address'],
                    'status' => '1',
                ]);
                $add_customer->save();
            });
        }

    }

    public function get_products_ajax(Request $request){

        $products = Product::select('product_name','id')->where('status',1)->where('product_name','Like','%'.$request->search.'%')->get();
        return response()->json($products);
    }

    public function get_customer_ajax(Request $request){
        if ($request == true){
            $customer_data_ajax = Customer::get();
            return json_encode(array('customer_data_ajax'=>$customer_data_ajax));
        }

    }

    public function available_stock_price_ajax(Request $request){
//        dd($request->all());
        if ($request == true){
            $product_id = $request['product_id'];
            $unit_id = $request['unit_id'];
            $available_stock_ajax = Product::where([['id',$product_id],['unit_id',$unit_id]])->pluck('quantity');
            $available_product_price_ajax = Product::where([['id',$product_id],['unit_id',$unit_id]])->pluck('selling_price');
            return json_encode(array('available_stock_ajax'=>$available_stock_ajax,'product_price'=>$available_product_price_ajax));
        }
    }


    public function available_units_ajax(Request $request){
        if ($request == true){
            $product_id = $request['product_id'];
            $unit_id = $request['unit_id'];
            //$available_stock_ajax = Product::where([['id',$product_id],['unit_id',$unit_id]])->pluck('quantity');
            $available_units_ajax =  DB::table('units')
                ->join('products', 'units.id', '=', 'products.unit_id')
                ->select('units.unit_name','units.id as unit_id')
                ->where('products.id',$product_id)
                ->get();
            //$product_id = $request['product_id'];
            //$unit_id = $request['unit_id'];
            $available_stock_ajax = Product::where([['id',$product_id],['unit_id',$available_units_ajax[0]->unit_id]])->pluck('quantity');
            $available_product_price_ajax = Product::where([['id',$product_id],['unit_id',$available_units_ajax[0]->unit_id]])->pluck('selling_price');
            // dd($available_units_ajax);
            return json_encode(array('available_units_ajax'=>$available_units_ajax,'available_stock_ajax'=>$available_stock_ajax,'product_price'=>$available_product_price_ajax));
        }
    }
    public function print_sale_invoice($id){
//        if ($id == 1){
//            $sale_order = SaleOrder::latest()->first(['id','customer_id','created_at','extra_charge','discount','billing_amount','paid_amount']);
////            dd($sale_order);
//            $customers = Customer::find($sale_order->customer_id);
//            $sale_order_details = SaleOrderDetail::where('sale_order_id',$sale_order->id)->where('product_id','<>','')->get();
//            return view('backend.sale.print_sale_invoice',compact('sale_order','customers','sale_order_details'));
//        }else{
            $sale_order = SaleOrder::find($id);
            $customers = Customer::find($sale_order->customer_id);
            $sale_order_details = SaleOrderDetail::where('sale_order_id',$sale_order->id)->where('product_id','<>','')->get();
           return view('backend.sale.print_sale_invoice',compact('sale_order','customers','sale_order_details'));
//        }

    }



}
