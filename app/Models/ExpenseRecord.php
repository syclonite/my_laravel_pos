<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ExpenseRecord extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'remarks','status','type','amount','user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }


}
