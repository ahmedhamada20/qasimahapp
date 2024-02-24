<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Token extends Model 
{

    protected $table = 'device_tokens';
    public $timestamps = true;
    protected $fillable = array('user_id', 'token', 'status', 'device_type', 'device_language');

}