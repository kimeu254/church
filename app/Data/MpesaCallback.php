<?php

namespace App\Data;

use Illuminate\Database\Eloquent\Model;

class MpesaCallback extends Model
{
    //
    protected $table = 'tbl_mpesa_callbacks';

    protected $fillable = [
        'checkout_request_id',
        'checkout_request_body'
    ];
}
