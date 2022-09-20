<?php

namespace App\Data;

use Illuminate\Database\Eloquent\Model;

class Groups extends Model
{
    protected $table = 'tbl_groups';
    
    protected $fillable = [
        'name','description','status','added_by','church_id'
    ];

    public function groups()
    {
        return $this->belongsTo('App\Data\Members','id','group_id');
    }
}
