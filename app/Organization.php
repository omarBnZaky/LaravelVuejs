<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Organization extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $guard = 'org';

    protected $fillable = [
        'hash_id','name','email','password','profile','status'
    ];
    protected $hidden = [
     'password', 'remember_token',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
