<?php

namespace App\Data;

use Illuminate\Database\Eloquent\Model;

class Zones extends Model
{
//    public function members()
//    {
//        return $this->hasMany(Members::class, 'id', 'id');
//    }
    protected $table = 'tbl_residential_zones';
    
    protected $fillable = [
        'id','zone_name','status','church_id'
    ];
}
