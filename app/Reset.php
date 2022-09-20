<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reset extends Model
{
    protected $fillable = ['member_id', 'code', 'expires_in', 'status'];
}
