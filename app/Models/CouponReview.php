<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CouponReview extends Model 
{

    protected $table = 'coupons_reviews';
    public $timestamps = true;
    protected $fillable = array('user_id', 'item_id', 'status');

}