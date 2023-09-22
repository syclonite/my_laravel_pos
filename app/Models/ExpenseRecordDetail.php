<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ExpenseRecordDetail extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'expense_id','expense_record_id','status','amount'
    ];
}
