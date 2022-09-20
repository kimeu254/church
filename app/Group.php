<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    //
    protected $table = 'tbl_groups';

    public function church()
    {
        return $this->belongsTo(Church::class, 'church_id', 'id');
    }
}
