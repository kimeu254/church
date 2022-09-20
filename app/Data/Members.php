<?php

namespace App\Data;

use App\GroupMember;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Members extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'tbl_members';

    protected $fillable = [
        'membership_number', 'national_id',
        'name', 'email', 'phone_number', 'gender', 'marital_status', 'baptized', 'sms_code_verified', 'confirmed', 'spouse', 'password', 'residence_zone', 'married_in_church', 'church_id'
    ];

    public function groups()
    {

        return $this->hasMany('App\Data\Groups', 'group_id', 'id');

    }
}
