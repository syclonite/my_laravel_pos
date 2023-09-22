<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'unit_name',
        'unit_description',
        'status',
    ];

    public function product()
    {
        return $this->hasMany(Product::class);
    }

    public function stockCount()
    {
        return $this->hasMany(StockCount::class);
    }

}
