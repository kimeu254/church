<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Network extends Model
{
    //
    protected $table = 'tbl_networks';

    protected $fillable = [
        'name'
    ];
}
