<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerPaymentDetails;
use App\Models\PurchaseOrder;
use App\Models\SaleOrder;
use App\Models\SupplierPaymentDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function customer_payment_index(){

        $customer_billing_details = DB::select(DB::raw("SELECT customers.id,customers.name,customers.phone,
        ( SELECT sum(sale_orders.billing_amount)
          FROM sale_orders
          WHERE sale_orders.customer_id=customers.id AND sale_orders.status = 1) total_billing_amount,
        ( SELECT sum(customer_payment_details.paid_amount)
          FROM customer_payment_details
          WHERE customer_payment_details.customer_id=customers.id) total_paid_amount
        FROM customers LEFT JOIN sale_orders ON sale_orders.customer_id=customers.id
        LEFT JOIN customer_payment_details ON customer_payment_details.customer_id=customers.id
        WHERE sale_orders.status = 1 group by customers.id,customers.name,customers.phone;"));
//      dd($customer_billing_details);

        $customer_due_summary = DB::select(DB::raw("SELECT (SELECT COUNT(DISTINCT(customer_payment_details.customer_id)) FROM customer_payment_details ) customer_count,SUM((SELECT sum(sale_orders.billing_amount) FROM sale_orders WHERE sale_orders.customer_id=customers.id AND sale_orders.status = 1)) total_bill,
       SUM(( SELECT sum(customer_payment_details.paid_amount) FROM customer_payment_details WHERE customers.id = customer_payment_details.customer_id)) total_paid FROM customers;"));


//            $only_total_due_amount = DB::select(DB::raw("SELECT SUM(sale_orders.billing_amount- sale_orders.paid_amount) as only_total_due
//            FROM sale_orders WHERE sale_orders.billing_amount > sale_orders.paid_amount;"));

            $array_all_customer_data = DB::select(DB::raw("SELECT ( SELECT sum(sale_orders.billing_amount)
          FROM sale_orders
          WHERE sale_orders.customer_id=customers.id AND sale_orders.status = 1) total_billing_amount,
        ( SELECT sum(IFNULL(customer_payment_details.paid_amount,0))
          FROM customer_payment_details
          WHERE customer_payment_details.customer_id=customers.id) total_paid_amount,
          (SELECT total_billing_amount - total_paid_amount) as total_due,
         (SELECT SUM(CASE WHEN total_due > 0 THEN total_due ELSE 0 END) ) AS sum_total_due
        FROM customers LEFT JOIN sale_orders ON sale_orders.customer_id=customers.id
        LEFT JOIN customer_payment_details ON customer_payment_details.customer_id=customers.id
        WHERE sale_orders.status = 1  GROUP BY total_billing_amount"));

        $only_total_due_amount = array_sum(array_column($array_all_customer_data, 'sum_total_due'));


        return view('backend.customer.customer_payment_index',compact('customer_billing_details','only_total_due_amount','customer_due_summary'))->with('i');

    }

    public function due_customer_billing_list($id){
        $customer_sale_orders = SaleOrder::where([['customer_id',$id],['status',1]])->get();
//        dd($customer_sale_order);
        return view('backend.customer.customer_billing_list',compact('customer_sale_orders'))->with('i');
    }

    public function customer_payment_create($bill_id){

        $customer_bill_wise_payments = CustomerPaymentDetails::where('sale_order_id',$bill_id)->get();
        $customer_bills = SaleOrder::where('id',$bill_id)->value('billing_amount');
        $customer_bill_no = SaleOrder::where('id',$bill_id)->value('id');
        $customer_id = SaleOrder::where('id',$bill_id)->value('customer_id');
        return view('backend.customer.customer_payment_create',compact('customer_id','customer_bill_wise_payments','customer_bills','customer_bill_no'))->with('i');
    }

    public function customer_payment_store(Request $request){
//        dd($request->all());
        $validated = $request->validate([
            'paid_amount' => 'required|min:1',
            'status' => 'required',
            'sale_order_id' => 'required',
            'customer_id' => 'required',
        ]);

        if ($validated == true){
            DB::transaction(function() use ($request){
                CustomerPaymentDetails::create([
                    'paid_amount'=> $request->get('paid_amount'),
                    'status'=> $request->get('status'),
                    'sale_order_id' => $request->get('sale_order_id'),
                    'customer_id' => $request->get('customer_id')
                ]);
                $sale_order_id = $request->get('sale_order_id');
                $customer_id = $request->get('customer_id');
                $current_paid_amount = $request->get('paid_amount');
                $sale_order_paid_amount = SaleOrder::where('id',$sale_order_id)->value('paid_amount');
                $result = $sale_order_paid_amount + $current_paid_amount;
//        dd($result);
                SaleOrder::where([['id',$sale_order_id],['customer_id',$customer_id]])->update([
                    'paid_amount' => $result
                ]);
            });

        }
        return redirect()->back();
    }

    public function customer_payment_edit_list($bill_id){
        $customer_bill_wise_payments = CustomerPaymentDetails::where('sale_order_id',$bill_id)->get();
        return view('backend.customer.customer_payment_edit_list',compact('customer_bill_wise_payments'))->with('i');
    }

    public function customer_payment_edit_payment($id){
        $customer_payments_details = CustomerPaymentDetails::find($id);
//        dd($customer_payments_details->sale_order->billing_amount);
        return view('backend.customer.customer_payment_update',compact('customer_payments_details'));
    }
    public function customer_payment_update(Request $request,$id){

//        dd($customer_payment_paid_amount);
        DB::transaction(function() use ($request,$id){
            $customer_payments_id = CustomerPaymentDetails::find($id);
            $sale_order_id = $request->get('sale_order_id');
            $customer_id = $request->get('customer_id');
            $current_paid_amount = $request->get('paid_amount');
            $sale_order_paid_amount = SaleOrder::where('id',$sale_order_id)->value('paid_amount');
            $customer_payment_paid_amount = $customer_payments_id->paid_amount;
            if($customer_payment_paid_amount > $current_paid_amount){
                $data = $customer_payment_paid_amount - $current_paid_amount;
                $result = $sale_order_paid_amount - $data;
                SaleOrder::where([['id',$sale_order_id],['customer_id',$customer_id]])->update([
                    'paid_amount' => $result
                ]);
            }elseif($customer_payment_paid_amount < $current_paid_amount){
                $data = $current_paid_amount - $customer_payment_paid_amount;
                $result = $sale_order_paid_amount + $data;

                SaleOrder::where([['id',$sale_order_id],['customer_id',$customer_id]])->update([
                    'paid_amount' => $result
                ]);
            }elseif ($customer_payment_paid_amount == $current_paid_amount){
                return redirect()->back();
            }
            $validated = $request->validate([
                'paid_amount' => 'required|min:1',
                'status' => 'required',
            ]);
            if ($validated == true){
                $customer_payments_id->paid_amount = $request->get('paid_amount');
                $customer_payments_id->status = $request->get('status');
                $customer_payments_id->save();
            }
        });

        return redirect()->back();
    }



    public function due_supplier_list_index(){

        $supplier_billing_details = DB::select(DB::raw("SELECT suppliers.id,suppliers.supplier_name, suppliers.phone_1,
        ( SELECT sum(purchase_orders.billing_amount)
          FROM purchase_orders
          WHERE purchase_orders.supplier_id=suppliers.id AND purchase_orders.status = 1) total_billing_amount,
        ( SELECT sum(supplier_payment_details.paid_amount)
          FROM supplier_payment_details
          WHERE supplier_payment_details.supplier_id=suppliers.id) total_paid_amount
        FROM suppliers LEFT JOIN purchase_orders ON purchase_orders.supplier_id=suppliers.id
        LEFT JOIN supplier_payment_details ON supplier_payment_details.supplier_id=suppliers.id
        WHERE purchase_orders.status = 1 group by suppliers.id,suppliers.supplier_name,suppliers.phone_1"));

        $supplier_due_summary = DB::select(DB::raw("SELECT (SELECT COUNT(DISTINCT(supplier_payment_details.supplier_id)) FROM supplier_payment_details) supplier_count,
        SUM((SELECT sum(purchase_orders.billing_amount)
          FROM purchase_orders
          WHERE purchase_orders.supplier_id=suppliers.id AND purchase_orders.status = 1)) total_billing_amount,
        SUM((SELECT sum(supplier_payment_details.paid_amount)
          FROM supplier_payment_details
          WHERE supplier_payment_details.supplier_id=suppliers.id)) total_paid_amount
        FROM suppliers;"));

        $array_all_supplier_data = DB::select(DB::raw("SELECT ( SELECT sum(purchase_orders.billing_amount) FROM purchase_orders WHERE purchase_orders.supplier_id=suppliers.id AND purchase_orders.status = 1) total_billing_amount,
       ( SELECT sum(IFNULL(supplier_payment_details.paid_amount,0)) FROM supplier_payment_details
       WHERE supplier_payment_details.supplier_id=suppliers.id) total_paid_amount,
       (SELECT total_billing_amount - total_paid_amount) as total_due,
       (SELECT SUM(CASE WHEN total_due > 0 THEN total_due ELSE 0 END) ) AS sum_total_due FROM suppliers LEFT JOIN purchase_orders ON purchase_orders.supplier_id=suppliers.id
       LEFT JOIN supplier_payment_details ON supplier_payment_details.supplier_id=suppliers.id
       WHERE purchase_orders.status = 1 GROUP BY total_billing_amount;"));

        $only_supplier_total_due_amount = array_sum(array_column($array_all_supplier_data, 'sum_total_due'));

//        dd($sum);

        return view('backend.suppliers.due_supplier_payment_index',compact('only_supplier_total_due_amount','supplier_billing_details','supplier_due_summary'))->with('i');
    }

    public function due_supplier_billing_list($id){
        $supplier_purchase_orders = PurchaseOrder::where([['supplier_id',$id],['status',1]])->get();
//        dd($customer_sale_order);
        return view('backend.suppliers.due_supplier_billing_list',compact('supplier_purchase_orders'))->with('i');
    }

    public function due_supplier_payment_create($bill_id){
        $supplier_bill_wise_payments = SupplierPaymentDetails::where('purchase_order_id',$bill_id)->get();
        $supplier_bills = PurchaseOrder::where('id',$bill_id)->value('billing_amount');
        $supplier_bill_no = PurchaseOrder::where('id',$bill_id)->value('id');
        $supplier_id = PurchaseOrder::where('id',$bill_id)->value('supplier_id');
        return view('backend.suppliers.due_supplier_payment_create',compact('supplier_id','supplier_bill_wise_payments','supplier_bills','supplier_bill_no'))->with('i');
    }

    public function due_supplier_payment_store(Request $request){
//        dd($request->all());
        $validated = $request->validate([
            'paid_amount' => 'required|min:1',
            'status' => 'required',
            'purchase_order_id' => 'required',
            'supplier_id' => 'required',
        ]);

        if ($validated == true){
            DB::transaction(function() use ($request){
//                dd($request->all());
                SupplierPaymentDetails::create([
                    'paid_amount'=> $request->get('paid_amount'),
                    'status'=> $request->get('status'),
                    'purchase_order_id' => $request->get('purchase_order_id'),
                    'supplier_id' => $request->get('supplier_id')
                ]);
                $purchase_order_id = $request->get('purchase_order_id');
                $supplier_id = $request->get('supplier_id');
                $current_paid_amount = $request->get('paid_amount');
                $purchase_order_paid_amount = PurchaseOrder::where('id',$purchase_order_id)->value('paid_amount');
                $result = $purchase_order_paid_amount + $current_paid_amount;
//        dd($result);
                PurchaseOrder::where([['id',$purchase_order_id],['supplier_id',$supplier_id]])->update([
                    'paid_amount' => $result
                ]);
            });

        }
        return redirect()->back();
    }

    public function due_supplier_payment_edit_list($bill_id){
        $supplier_bill_wise_payments = SupplierPaymentDetails::where('purchase_order_id',$bill_id)->get();
        return view('backend.suppliers.due_supplier_payment_edit_list',compact('supplier_bill_wise_payments'))->with('i');

    }

    public function due_supplier_payment_edit_page($id){
        $supplier_payments_details = SupplierPaymentDetails::find($id);
        $supplier_billing_amount = PurchaseOrder::where('id',$supplier_payments_details->purchase_order_id)->value('billing_amount');
        return view('backend.suppliers.due_supplier_payment_edit_page',compact('supplier_payments_details','supplier_billing_amount'));
    }

    public function due_supplier_payment_update(Request $request,$id)
    {
//      dd($customer_payment_paid_amount);
        DB::transaction(function () use ($request, $id) {
            $supplier_payments_id = SupplierPaymentDetails::find($id);
            $purchase_order_id = $request->get('purchase_order_id');
            $supplier_id = $request->get('supplier_id');
            $current_paid_amount = $request->get('paid_amount');
            $purchase_order_paid_amount = PurchaseOrder::where('id', $purchase_order_id)->value('paid_amount');
            $supplier_payment_paid_amount = $supplier_payments_id->paid_amount;
            if ($supplier_payment_paid_amount > $current_paid_amount) {
                $data = $supplier_payment_paid_amount - $current_paid_amount;
                $result = $purchase_order_paid_amount - $data;
                PurchaseOrder::where([['id', $purchase_order_id], ['supplier_id', $supplier_id]])->update([
                    'paid_amount' => $result
                ]);
            } elseif ($supplier_payment_paid_amount < $current_paid_amount) {
                $data = $current_paid_amount - $supplier_payment_paid_amount;
                $result = $supplier_payment_paid_amount + $data;
                PurchaseOrder::where([['id', $purchase_order_id], ['supplier_id', $supplier_id]])->update([
                    'paid_amount' => $result
                ]);
            } elseif ($supplier_payment_paid_amount == $current_paid_amount) {
                return redirect()->back();
            }
            $validated = $request->validate([
                'paid_amount' => 'required|min:1',
                'status' => 'required',
            ]);
            if ($validated == true) {
                $supplier_payments_id->paid_amount = $request->get('paid_amount');
                $supplier_payments_id->status = $request->get('status');
                $supplier_payments_id->save();
            }
        });

        return redirect()->back();
    }
}
