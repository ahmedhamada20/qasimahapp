<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubItems extends Model
{
    protected $table = 'sub_items';
    public $timestamps = true;
    protected $fillable = [
        'item_id',
        'brand_id',
        'category_id',
        'discount_code',
        'description',
        'url',
        'offer',
        'advice',
        'alert',
        'discount_percent',
        'show',
        'used_count',
        'last_used',
        'click_count',
        'copy_count',
    ];

    protected $casts = ['description' => 'json', 'title' => 'json', 'advice' => 'json', 'alert' => 'json'];

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
