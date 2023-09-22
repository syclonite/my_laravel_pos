<?php

namespace App\CustomClass;

use App\Models\PurchaseOrderDetail;
use App\Models\SaleOrderDetail;
use App\Models\Product;
use App\Models\Stock;
use App\Models\StockCount;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class StockManipulation
{
   public function add_stock($request){
//       dd($request->all());
//      dd(PurchaseOrderDetail::where('product_id',2)->sum('quantity'));
       DB::transaction(function () use ($request) {
           Stock::create($request);
       });

   }

   public function update_stock($request){
       DB::transaction(function () use ($request) {
           Stock::create($request);
       });

    }

   public function update_purchase_order_total_quantity($purchase_order_details,$purchase_order_id){

       DB::transaction(function () use ($purchase_order_details,$purchase_order_id) {
           foreach($purchase_order_details as $purchase_order_detail){
//           dd($purchase_order_detail['product_id']);
               $current_quantity = PurchaseOrderDetail::where([['purchase_order_id',$purchase_order_id],['product_id', $purchase_order_detail['product_id']], ['unit_id', $purchase_order_detail['unit_id']]])->value('quantity');
               $current_total_quantity = StockCount::where([['product_id', $purchase_order_detail['product_id']], ['unit_id', $purchase_order_detail['unit_id']]])->value('total_quantity');
               $request_quantity = $purchase_order_detail['quantity'];
//           dd("total_quantity:".$current_total_quantity,"current_quantity:".$current_quantity,"request_quantity:".$purchase_order_detail['quantity']);
               if ($current_quantity < $request_quantity){
                   $result = $request_quantity - $current_quantity;
                   $calculate_total = $current_total_quantity + $result;
                   StockCount::where([['product_id', $purchase_order_detail['product_id']], ['unit_id', $purchase_order_detail['unit_id']]])->update([
                       'total_quantity'=>$calculate_total
                   ]);
                   Product::where([['id', $purchase_order_detail['product_id']], ['unit_id', $purchase_order_detail['unit_id']]])->update([
                       'quantity'=>$calculate_total
                   ]);
               }
               elseif ($current_quantity > $request_quantity){
                   $result = $current_quantity - $request_quantity;
                   $calculate_total = $current_total_quantity - $result;
                   StockCount::where([['product_id', $purchase_order_detail['product_id']], ['unit_id', $purchase_order_detail['unit_id']]])->update([
                       'total_quantity'=>$calculate_total
                   ]);
                   Product::where([['id', $purchase_order_detail['product_id']], ['unit_id', $purchase_order_detail['unit_id']]])->update([
                       'quantity'=>$calculate_total
                   ]);
               }
               elseif ($current_quantity == $request_quantity){
                   StockCount::where([['product_id', $purchase_order_detail['product_id']], ['unit_id', $purchase_order_detail['unit_id']]])->update([
                       'total_quantity'=>$current_total_quantity
                   ]);
                   Product::where([['id', $purchase_order_detail['product_id']], ['unit_id', $purchase_order_detail['unit_id']]])->update([
                       'quantity'=>$current_total_quantity
                   ]);
               }

           }
       });


    }


   public function reduce_stock($request){
       DB::transaction(function () use ($request) {
           $quantity_array = [];
           foreach ($request as $params){
//        dd($params['product_id']);
               $stocks_quantity = Stock::where([
                   ['product_id',$params['product_id']],
                   ['unit_id',$params['unit_id']],
               ])->where('quantity','!=',0.0)->pluck('quantity')->toArray();

               $stocks_id = Stock::where([
                   ['product_id',$params['product_id']],
                   ['unit_id',$params['unit_id']],
               ])->where('quantity','!=',0.0)->pluck('id')->toArray();
//           dd($stocks_id,$stocks_quantity);
               $quantity = $params['quantity'];
               $temp_sum = 0;
               $t = $quantity;
               foreach ($stocks_quantity as $key => $stock_quantity){
                   if ($t > $temp_sum){
                       $temp_sum = $temp_sum + $stock_quantity;
                       $result = $temp_sum - $t;
                       if ($result < 0){
                           $result = 0;
                       }elseif ($result > 0 || $result == 0){
                           $result = $temp_sum - $t;
                       }
                       $quantity_array[] = $result;
                   }
               }
           }
//       dd($quantity_array);
           $collection = collect($stocks_id);
           $zipped = $collection->zip($quantity_array);
//       dd($zipped);
           $null_filtered_data = collect($zipped)->reject(function($element) {
               return $element[1] === null;
           });
           $null_filtered_data->map(function($data) {
               $id = $data[0];
               $quantity = $data[1];
               Stock::where('id',$id)->update([
                   'quantity' => $quantity
               ]);
           });
       });

   }

   public function restore_stock($sale_order_id){
       DB::transaction(function () use ($sale_order_id) {
           $quantity_array = [];
           $sale_order_details = SaleOrderDetail::where('sale_order_id', $sale_order_id)->get();
           foreach ($sale_order_details as $sale_order_detail){
               $quantity_reduced = SaleOrderDetail::where([['sale_order_id', $sale_order_detail['sale_order_id']],['product_id', $sale_order_detail['product_id']],['unit_id', $sale_order_detail['unit_id']]])->pluck('quantity');
               $stocks_quantity = Stock::where([['product_id',$sale_order_detail['product_id']],['unit_id',$sale_order_detail['unit_id']],])->orderBy('updated_at','DESC')->pluck('quantity')->toArray();
               $stocks_id = Stock::where([['product_id',$sale_order_detail['product_id']],['unit_id',$sale_order_detail['unit_id']]])->orderBy('updated_at','DESC')->pluck('id')->toArray();
               foreach ($quantity_reduced as $value){
                   $temp_sum = 0;
                   $t = $value;
                   foreach ($stocks_quantity as $key => $stock_quantity){
                       if ($t > $temp_sum){
                           $temp_sum = $temp_sum + $stock_quantity;
                           $result = $temp_sum + $t;
                           if ($t > $result){
                               $result = $temp_sum - $t;
                           }elseif ($t == $result ){
                               $temp_sum = $t ;
                               $result = $temp_sum - $stock_quantity;
                           }elseif($t < $result){
                               $temp_sum = $t ;
                               $result = $temp_sum + $stock_quantity;
//                            dd($result);
                           }
                           $quantity_array[] = $result;
                       }
                   }
//                dd($quantity_array);
                   $collection = collect($stocks_id);
                   $zipped = $collection->zip($quantity_array);
                   $null_filtered_data = collect($zipped)->reject(function($element) {
                       return $element[1] === null;
                   });
                   $null_filtered_data->map(function($data) {
                       $id = $data[0];
                       $quantity = $data[1];
                       Stock::where('id',$id)->update([
                           'quantity' => $quantity
                       ]);
                   });

               }
            $total_quantity = Stock::where([['product_id',$sale_order_detail['product_id']],['unit_id',$sale_order_detail['unit_id']]])->sum('quantity');
            //           $data = StockCount::where([['product_id',$product_id],['unit_id',$unit_id]])->get();
            StockCount::where([['product_id',$sale_order_detail['product_id']],['unit_id',$sale_order_detail['unit_id']]])->update([
                'total_quantity' => $total_quantity,
            ]);
            Product::where([['id',$sale_order_detail['product_id']],['unit_id',$sale_order_detail['unit_id']]])->update([
                'quantity' => $total_quantity,
            ]);

           }
       });

    }

   public function add_update_total_stock($request){
       DB::transaction(function () use ($request) {
           $purchase_stocks = $request['purchase_order_details'];
//       dd($purchase_stocks);
           foreach ($purchase_stocks as $purchase_stock){
               $product_id = $purchase_stock['product_id'];
               $unit_id = $purchase_stock['unit_id'];
               $selling_price = $purchase_stock['selling_price'];
               $purchase_price = $purchase_stock['purchase_price'];
               $total_quantity = Stock::where([['product_id',$product_id],['unit_id',$unit_id]])->sum('quantity');
               $data = StockCount::where([['product_id',$product_id],['unit_id',$unit_id]])->get();
               $subcategory_id = Product::where([['id',$product_id],['unit_id',$unit_id]])->pluck('subcategory_id')->first();
               $total_quantity_stock_count = StockCount::where([['product_id',$product_id],['unit_id',$unit_id]])->sum('total_quantity');
               if ($data->isEmpty()){
//              dd("empty");
                   StockCount::create([
                       'product_id'=> $product_id,
                       'unit_id' => $unit_id,
                       'user_id' => Auth::id(),
                       'total_quantity' => $total_quantity,
                       'status' => '1',
                       'currently_product_selling_price' => $selling_price,
                       'currently_product_purchase_price' => $purchase_price,
                       'subcategory_id' => $subcategory_id,
                   ]);

               }elseif ($data->isNotEmpty()){
//              dd("not Empty");
                   StockCount::where([['product_id',$product_id],['unit_id',$unit_id]])->update([
                       'total_quantity' => $total_quantity + $total_quantity_stock_count,
                       'currently_product_selling_price' => $selling_price,
                       'currently_product_purchase_price' => $purchase_price,
                   ]);
                   Product::where([['id',$product_id],['unit_id',$unit_id]])->update([
                       'quantity' => $total_quantity + $total_quantity_stock_count,
                       'selling_price' => $selling_price,
                       'purchase_price' => $purchase_price,
                   ]);
               }
           }
       });

   }

   public function mail_current_stock(){
       $low_stock_count = StockCount::where('total_quantity','<=', 10)->join('products', 'products.id', '=', 'stock_counts.product_id')
           ->join('units', 'units.id', '=', 'stock_counts.unit_id')
           ->get(['products.product_name', 'units.unit_name', 'stock_counts.total_quantity']);
//       dd($low_stock_count);
        if ($low_stock_count->isNotEmpty()){
             Mail::send('mail.low_stock_mail',['data' => $low_stock_count] ,function($messages){
                $messages->to('admin@gmail.com');
                $messages->subject('Low Stock Product');
             });
        }
   }

   public function update_sale_order_total_quantity($sale_order_details,$sale_order_id){
       DB::transaction(function () use ($sale_order_details,$sale_order_id) {
           foreach($sale_order_details as $sale_order_detail){
               $current_quantity = SaleOrderDetail::where([['sale_order_id',$sale_order_id],['product_id',$sale_order_detail['product_id']],['unit_id',$sale_order_detail['unit_id']]])->value('quantity');
               $current_total_quantity = StockCount::where([['product_id',$sale_order_detail['product_id']],['unit_id',$sale_order_detail['unit_id']]])->value('total_quantity');
               $request_quantity = $sale_order_detail['quantity'];
               if ($current_quantity > $request_quantity){
                   $result = $current_quantity - $request_quantity;
                   $calculate_total = $current_total_quantity + $result;
//            return dd("result-".$result,"calculate_total-".$calculate_total);
                   StockCount::where([['product_id', $sale_order_detail['product_id']], ['unit_id', $sale_order_detail['unit_id']]])->update([
                       'total_quantity'=>$calculate_total
                   ]);
                   Product::where([['id', $sale_order_detail['product_id']], ['unit_id', $sale_order_detail['unit_id']]])->update([
                       'quantity'=>$calculate_total
                   ]);
               }elseif ($current_quantity < $request_quantity){
                   $result = $request_quantity - $current_quantity;
                   $calculate_total = $current_total_quantity - $result;
//            return dd("result-".$result,"calculate_total-".$calculate_total);
                   StockCount::where([['product_id', $sale_order_detail['product_id']], ['unit_id', $sale_order_detail['unit_id']]])->update([
                       'total_quantity'=>$calculate_total
                   ]);
                   Product::where([['id', $sale_order_detail['product_id']], ['unit_id', $sale_order_detail['unit_id']]])->update([
                       'quantity'=>$calculate_total
                   ]);
               }elseif ($current_quantity == $request_quantity){
                   StockCount::where([['product_id', $sale_order_detail['product_id']], ['unit_id', $sale_order_detail['unit_id']]])->update([
                       'total_quantity'=>$current_total_quantity
                   ]);
                   Product::where([['id', $sale_order_detail['product_id']], ['unit_id', $sale_order_detail['unit_id']]])->update([
                       'quantity'=>$current_total_quantity
                   ]);
               }
           }
       });
//      return dd($sale_order_details,$sale_order_id);
   }


}
