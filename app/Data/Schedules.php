<?php

namespace App\Data;

use Illuminate\Database\Eloquent\Model;

class Schedules extends Model
{
    protected $table = 'tbl_serviceschedules';
    
    protected $fillable = [
        'id','church_id','name','maxmembers','start_time','end_time','description','status','addedby','church_id'
    ];
}
