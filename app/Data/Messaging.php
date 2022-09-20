<?php

namespace App\Data;

use Illuminate\Database\Eloquent\Model;

class Messaging extends Model
{
    protected $table = 'tbl_messages';
    
    protected $fillable = [
        'message_type', 'added_by', 'message_content', 'status','church_id'
    ];

}
