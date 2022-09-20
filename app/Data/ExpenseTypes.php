<?php

namespace App\Data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseTypes extends Model
{
    protected $table='tbl_expense_types';

    protected $fillable = [
        'id','expense_type','status','church_id',
    ];
}
