<?php

namespace App\Http\Controllers;


use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\StockCount;
use App\Models\Suppliers;
use App\Models\Unit;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderby('created_at','DESC')->withTrashed()->get();
        return view('backend.products.index',compact('products'))->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $units = Unit::get();
        $subcategories = SubCategory::get();
        return view('backend.products.create',compact('subcategories','units'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        DB::transaction(function () use ($request) {
            $validated = $request->validate([
                'product_name' => 'required|',
                'quantity' => 'required|min:1',
                'purchase_price' => 'required|min:1',
                'selling_price' => 'required|min:1',
                'product_des' => '',
                'status' => '',
                'subcategory_id' => 'required',
                'unit_id' => 'required',

            ]);

            if($validated == true){
                $product = new Product([
                    'product_name' => $request->get('product_name'),
                    'quantity' => $request->get('quantity'),
                    'purchase_price' => $request->get('purchase_price'),
                    'selling_price' => $request->get('selling_price'),
                    'product_description' => $request->get('product_des'),
                    'status' => '1',
                    'subcategory_id' => $request->get('subcategory_id'),
                    'unit_id' => $request->get('unit_id'),
                ]);
                $product->save();
                $check_stock_counts = StockCount::where([['product_id',$product->id],['unit_id',$product->unit_id]])->get();
                if ($check_stock_counts->isEmpty()){
                    ($product->subcategory_id);
                    StockCount::create([
                        'product_id'=> $product->id,
                        'unit_id' => $product->unit_id,
                        'subcategory_id' => $product->subcategory_id,
                        'user_id' => Auth::id(),
                        'total_quantity' => $product->quantity,
                        'status' => '1',
                        'currently_product_selling_price' => $product->selling_price,
                        'currently_product_purchase_price' => $product->purchase_price,
                    ]);
                }
            }

        });

        return redirect()->route('products.index')->with('success','Product has been created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $subcategories = SubCategory::get();
        $units = Unit::get();
        return view('backend.products.edit',compact('product','subcategories','units'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {

        $validated = $request->validate([
            'product_name' => 'required|',
            'quantity' => 'required|min:1',
            'purchase_price' => 'required|min:1',
            'selling_price' => 'required|min:1',
            'product_des' => '',
            'status' => '',
            'subcategory_id' => 'required',
            'unit_id' => 'required',

        ]);

        if ($validated == true){
            $product->product_name = $request->get('product_name');
            $product->product_description = $request->get('product_des');
            $product->quantity = $request->get('quantity');
            $product->purchase_price = $request->get('purchase_price');
            $product->selling_price = $request->get('selling_price');
            $product->status = $request->get('status');
            $product->subcategory_id = $request->get('subcategory_id');
            $product->unit_id = $request->get('unit_id');
            $product->save();
            StockCount::where([['product_id',$product->id]])->update([
                'total_quantity' => $product->quantity,
                'status' => '1',
                'currently_product_selling_price' => $product->selling_price,
                'currently_product_purchase_price' => $product->purchase_price,
                'unit_id' => $product->unit_id,
                'subcategory_id' => $product->subcategory_id,
            ]);
            return redirect()->route('products.index')->with('success','Product has been updated successfully.');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete(); // Easy right?
        StockCount::where('product_id',$product->id)->delete();
        return redirect()->route('products.index')->with('success','Product Deleted.');
    }

    public function restore($id)
    {
        Product::where('id', $id)->withTrashed()->restore();
        StockCount::where('product_id', $id)->withTrashed()->restore();

        return redirect()->route('products.index')->with('Product restored successfully.');
    }

    public function forceDelete($id)
    {
        Product::where('id', $id)->withTrashed()->forceDelete();
        StockCount::where('id', $id)->withTrashed()->forceDelete();

        return redirect()->route('products.index')->with('Product force deleted successfully.');
    }

    public function get_unit_ajax(Request $request){

        if ($request == true){
            $unit_data_ajax = Unit::get();
            return json_encode(array('unit_data_ajax'=>$unit_data_ajax));
        }
    }


}
