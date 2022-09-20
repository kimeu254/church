<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmsRate extends Model
{
    //
    protected $table = 'tbl_sms_rates';

    protected $fillable = [
        'church_id',
        'rate'
    ];
}
