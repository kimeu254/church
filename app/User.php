<?php

namespace App;

use App\Data\Projectstages;
use App\Data\Zones;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $primaryKey = 'id';

    protected $table = 'tbl_members';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'church_id', 'phone_number', 'confirmed', 'residence_zone','sms_code_verified'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    public function church()
    {
        return $this->belongsTo(Church::class, 'church_id', 'id');
    }

    public function zone(){
        return $this->belongsTo(Zones::class,'residence_zone','id');
    }
}
