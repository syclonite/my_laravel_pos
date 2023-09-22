<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes,HasFactory;

    protected $fillable = [
        'name',
        'email',
        'remarks','phone','address','status',
    ];
    public function SaleOrder(){
        return $this->hasMany(SaleOrder::class);
    }

}

