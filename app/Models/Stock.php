<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    protected $fillable = [
        'purchase_order_id','supplier_id','product_id','unit_id','quantity','purchase_amount','selling_amount'
    ];

}
