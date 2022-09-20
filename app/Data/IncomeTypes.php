<?php

namespace App\Data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomeTypes extends Model
{
    protected $table='tbl_income_types';

    protected $fillable = [
        'id','income_type','status','church_id'
    ];
}
