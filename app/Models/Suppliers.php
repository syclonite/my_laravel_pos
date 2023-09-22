<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Suppliers extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'supplier_name','phone_1','address','status','remarks'
    ];

    public function purchase_order(){
        return $this->hasMany(PurchaseOrder::class);
    }
}
