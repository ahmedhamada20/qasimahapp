<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;


    protected $table = 'admins';
    public $timestamps = true;
    protected $fillable = array('email', 'name', 'password');



    protected $hidden = [
        'password', 'remember_token',
    ];

}
