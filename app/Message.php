<?php

namespace App;

use App\Data\Members;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    protected $table = 'tbl_messages';

    protected $fillable = [
        'message_content',
        'added_by',
        'church_id',
        'message_type',
        'send_at',
        'status'
    ];

    public function recipients()
    {
        return $this->hasManyThrough(
            Members::class,
            MessageRecipient::class,
            'message_id',
            'id',
            'id',
            'member_id'
        );
    }
}
