<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupMember extends Model
{
    //
    protected $table = 'tbl_group_members';

    protected $fillable = [
        'member_id', 'church_id',
        'group_id',
        'status'
    ];
}
