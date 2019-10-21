<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use SMartins\PassportMultiauth\HasMultiAuthApiTokens;

class Organization extends Authenticatable
{
    use Notifiable, HasMultiAuthApiTokens;

    protected $guard = 'organization';

    protected $fillable = [
        'hash_id','name','email','password','profile','status'
    ];
    protected $hidden = [
     'password', 'remember_token',
    ];

    public function users()
    {
        return $this->hasMany(User::class,'org_id');
    }
}
