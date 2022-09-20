<?php

namespace App\Data;

use Illuminate\Database\Eloquent\Model;

class Contributions extends Model
{
    protected $table = 'tbl_contributions';

    protected $fillable = [
        'project_name_id','payment_mode','code','names','phone_number','church_id',
        'id', 'member', 'project_name', 'contribution_date', 'amount_contributed',
        ];

    public function project_name(){

        return $this->belongsTo(Projects::class,'project_name_id','id');
    }

    public function name(){

        return $this->belongsTo(Members::class,'member','id');
    }
}
