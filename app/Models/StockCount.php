<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockCount extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'user_id','product_id','unit_id','total_quantity','currently_product_selling_price','status','subcategory_id','currently_product_purchase_price'];

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function unit(){
        return $this->belongsTo(Unit::class);
    }

}
