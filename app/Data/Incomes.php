<?php

namespace App\Data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class Incomes extends Model
{
    use HasApiTokens;
    protected $table = 'tbl_incomes';

    protected $fillable = [
        'income_type_id','church_id',
        'id', 'income_type', 'income_detail', ' member' , 'service' ,'date_received', 'payment_mode', 'code', 'amount', 'confirmed', 'status',
    ];
    public function income_type(){

        return $this->belongsTo(IncomeTypes::class,'income_type_id','id');
    }
}
