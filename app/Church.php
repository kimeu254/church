<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use SebastianBergmann\CodeCoverage\Report\Xml\Unit;


class Church extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'tbl_churches';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'church_name', 'email_address', 'password', 'phone_number'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    public function sms_logs()
    {
        return $this->belongsToMany(SmsLog::class, 'tbl_sms_log', 'church_id', 'id');
    }

    public function sms_units()
    {
        return $this->belongsTo(SmsUnit::class, 'id', 'church_id');
    }


}
