<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Unit;
use App\Models\Voucher;
use App\Models\VoucherDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class VoucherController extends Controller
{
    public function index(){
        $vouchers = Voucher::orderBy('created_at','DESC')->withTrashed()->get();
        return view('backend.voucher.index_voucher',compact('vouchers'))->with('i');
    }
    public function create_voucher(){
            $customers = Customer::get();
            $products = Product::get();
            $units = Unit::get();
            return view('backend.voucher.create_voucher',compact('customers','products','units'));
    }
    public function add_customer_voucher(Request $request)
    {
//        dd($request['customers']);
        $add_customer = new Customer([
            'name' => $request['customers']['name'],
            'phone' => $request['customers']['phone'],
            'address' => $request['customers']['address'],
            'status' => '1',
        ]);
        $add_customer->save();
    }

    public function voucher_store(Request $request){

//          dd($item_lists);
//          $other_details = $request['voucher_order'];
        $validator = Validator::make($request['voucher_order'], [
            'customer_id' => 'required',
            'billing_amount' => 'required',
        ]);
        if ($validator->validated()){
            $voucher = new Voucher([
                'customer_id' => $request['voucher_order']['customer_id'],
                'billing_amount' => $request['voucher_order']['billing_amount'],
                'extra_charge' => $request['voucher_order']['extra_charge'],
                'discount' => $request['voucher_order']['discount'],
            ]);
//            dd($voucher);
            $voucher->save();
            $item_lists = $request['item_list'];
            foreach( $item_lists as $item_list ) {
//            dd($item_lists);
                VoucherDetail::create([
                    'voucher_id' => $voucher->id,
                    'product_id' => $item_list['product_id'],
                    'unit_id' => $item_list['unit_id'],
                    'quantity' => $item_list['quantity'],
                    'product_price' => $item_list['product_price'],
                    'subtotal' => $item_list['subtotal'],
                ]);
            }
        }
    }

    public function destroy($id){
        $voucher = Voucher::find($id);
        $voucher->delete();
        return redirect()->route('voucher.voucher_index')->with('success','Voucher Deleted.');
    }

    public function print_voucher($id){
        $voucher = Voucher::find($id);
//        dd($voucher);
        if($voucher != null){
            $customers = Customer::find($voucher->customer_id);
            $voucher_details = VoucherDetail::where('voucher_id',$voucher->id)->where('product_id', '<>','')->get();
//        dd($voucher_details);
            return view('backend.voucher.print_voucher',compact('voucher','customers','voucher_details'));
        }else{
            return redirect()->route('voucher.voucher_index')->with('success','Voucher was Deleted so cant print.');
        }

    }


    public function all_voucher_customer_ajax(Request $request){
        if ($request == true){
            $customer_data_ajax = Customer::where('name','!=','Walking Customer')->get();
            return json_encode(array('customer_data_ajax'=>$customer_data_ajax));
        }
    }

    public function voucher_selected_customer(Request $request){
        $customer_data = Customer::where('id',$request['id'])->first();
        return json_encode(array('customer_data'=>$customer_data));
    }

    public function all_voucher_product_price_ajax(Request $request){
        if ($request == true){
//            dd($request->all());
            $product_id = $request['parameters']['product_id'];
            $unit_id = $request['parameters']['unit_id'];
            $product_price = Product::where([['id',$product_id],['unit_id',$unit_id]])->pluck('selling_price');
            if ($product_price->isNotEmpty()){
                return json_encode(array('product_price'=>$product_price));
            }elseif ($product_price->isEmpty()){
                $product_price = 0;
                return json_encode(array('product_price'=>$product_price));
            }

        }
    }

    public function voucher_restore($id)
    {
        Voucher::where('id', $id)->withTrashed()->restore();

        return redirect()->route('voucher.voucher_index')->with('Voucher restored successfully.');
    }

    public function voucher_forceDelete($id)
    {
        Voucher::where('id', $id)->withTrashed()->forceDelete();
        return redirect()->route('voucher.voucher_index')->with('Voucher force deleted successfully.');
    }


}
