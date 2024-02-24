<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{

    protected $table = 'items';
    public $timestamps = true;
    protected $fillable = array('image','advice','high_light','alert','brand_id', 'category_id', 'store_affiliate', 'discount_code', 'description', 'url', 'used_count',
     'last_used', 'offer','discount_percent','title','sort_order','copy_count','click_count');

    protected $casts = ['high_light'=>'json','description'=>'json','title'=>'json' , 'advice'=>'json' , 'alert'=>'json'];


    public function subItems()
    {
        return $this->hasMany(SubItems::class,'item_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    function thumbs() {
        return $this->hasMany(ItemThumb::class,'item_id');
    }

    function seoPage() {
        return $this->morphOne(SeoPage::class,'model');
    }


    public function setImageAttribute()
    {
        $file = request()->file('image');
        $destinationPath = 'images/items/';
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move($destinationPath, $filename);
        $this->attributes['image'] = $filename;
    }

    public function getImageAttribute()
    {
        if ($this->attributes['image']) {
            return asset('images/items/') . '/' . $this->attributes['image'];
        }
        return asset('logo.png');
    }

}
