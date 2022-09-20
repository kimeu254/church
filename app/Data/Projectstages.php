<?php

namespace App\Data;

use Illuminate\Database\Eloquent\Model;

class Projectstages extends Model
{
    protected $table='tbl_project_stages';

    protected $fillable = [
        'id','project_stage','church_id'
    ];
}
