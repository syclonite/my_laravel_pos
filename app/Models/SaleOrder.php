<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id','user_id','billing_amount','paid_amount','status','discount','extra_charge'];

    public function sale_order_details(){
        return $this->hasMany(SaleOrderDetail::class);
    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
