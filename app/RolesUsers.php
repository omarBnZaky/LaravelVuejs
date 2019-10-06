<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RolesUsers extends Model
{
    protected $fillable = ['user_id','role_id'];
}
