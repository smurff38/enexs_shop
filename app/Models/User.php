<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'last_name',
        'first_name',
        'middle_name',
        'phone',
        'login',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
