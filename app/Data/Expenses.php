<?php

namespace App\Data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Expenses extends Model
{
    use HasApiTokens;
    protected $table = 'tbl_expenses';

    protected $fillable = [
        'expense_type_id','church_id',
        'id', 'expense_type', 'expense_detail', 'date_received', 'amount', 'confirmed', 'status',
    ];

    public function expense_type(){

        return $this->belongsTo(ExpenseTypes::class,'expense_type_id','id');
    }



}
