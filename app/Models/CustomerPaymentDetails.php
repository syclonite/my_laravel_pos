<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerPaymentDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'sale_order_id',
        'remarks','paid_amount','status',
    ];

    public function sale_order(){
        return $this->belongsTo(SaleOrder::class);
    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

}
