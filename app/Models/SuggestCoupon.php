<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuggestCoupon extends Model
{

    protected $table = 'suggested_coupons';
    public $timestamps = true;
    protected $fillable = array('store_affiliate','full_name', 'email', 'whatsapp', 'address', 'coupon_code', 'brand', 'category_id','discount_percent');

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
