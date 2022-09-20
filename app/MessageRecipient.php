<?php

namespace App;

use App\Data\Members;
use Illuminate\Database\Eloquent\Model;

class MessageRecipient extends Model
{
    //
    protected $table = 'tbl_message_recipients';

    protected $fillable = [
        'message_id',
        'member_id',
        'status'
    ];

    public function message()
    {
        return $this->belongsTo(Message::class, 'message_id', 'id');
    }

    public function recipient()
    {
        return $this->belongsTo(Members::class, 'member_id', 'id');
    }

}
