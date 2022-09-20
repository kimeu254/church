<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmsLog extends Model
{
    //
    protected $table = 'tbl_sms_log';

    protected $fillable = [
        'church_id',
        'sender',
        'message',
        'sent_to',
        'message_id',
        'category',
        'network_id',
        'response_code',
        'response_desc',
        'cost',
        'sent_at'
    ];

    public function church()
    {
        return $this->belongsTo(Church::class, 'church_id', 'id');
    }

    public function network()
    {
        return $this->belongsTo(Network::class, 'network_id', 'id');
    }
}
