<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Help extends Model
{

    protected $table = 'helps';
    public $timestamps = true;
    protected $fillable = array('address', 'email', 'message', 'brand', 'coupon');

}
