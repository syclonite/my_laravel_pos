<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Voucher extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'customer_id','billing_amount','extra_charge','discount'
    ];

    public function customer(){
        return $this->belongsTo(Customer::class);
    }
}
