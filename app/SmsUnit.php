<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmsUnit extends Model
{
    //
    protected $table = 'sms_units';

    protected $fillable = [
        'church_id', 'units'
    ];

    public function church()
    {
        return $this->belongsTo(Church::class, 'church_id', 'id');
    }
}
