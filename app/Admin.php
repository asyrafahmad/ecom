<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticable;

use Illuminate\Database\Eloquent\Model;

class Admin extends Authenticable
{
    use Notifiable;

    protected $guard = 'admin';
    protected $fillable = [
        'name',
        'email',
        'password'
    ];
    protected $hidden = [
        'password',
        'remember_password'
    ];
}
