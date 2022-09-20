<?php

namespace App\Data;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'tbl_schedules';
    
    protected $fillable = [
        'id','church_id','maxmembers','start_time','end_time','event_name','servicedate','event_status','addedby'
    ];
}
