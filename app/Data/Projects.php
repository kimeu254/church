<?php

namespace App\Data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    protected $table = 'tbl_projects';

    protected $fillable = [
        'project_stage_id','church_id',
        'id','project_name', 'completion_date_target', 'target_amount','amount_raised', 'start_date', 'project_stage', 'status',
        ];

    public function project_stage(){

        return $this->belongsTo(Projectstages::class,'project_stage_id','id');
    }
}
