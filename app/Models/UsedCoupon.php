<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsedCoupon extends Model 
{

    protected $table = 'used_coupons';
    public $timestamps = true;
    protected $fillable = array('user_id', 'item_id');

}