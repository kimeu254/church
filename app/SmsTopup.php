<?php

namespace App;

use App\Data\MpesaCallback;
use Illuminate\Database\Eloquent\Model;

class SmsTopup extends Model
{
    //
    protected $table = 'sms_topups';

    protected $fillable = [
        'church_id',
        'checkout_request_id',
        'amount',
        'units'
    ];

    public function transaction()
    {
        return $this->belongsTo(MpesaCallback::class, 'checkout_request_id', 'checkout_request_id');
    }
}
