<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfferSlider extends Model
{

    protected $table = 'offers_sliders';
    public $timestamps = true;
    protected $fillable = array('discount_code', 'image');

    public function setImageAttribute()
    {
        $file = request()->file('image');
        $destinationPath = 'images/offers_sliders/';
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move($destinationPath, $filename);
        $this->attributes['image'] = $filename;
    }

    public function getImageAttribute()
    {
        if ($this->attributes['image']) {
            return asset('images/offers_sliders/') . '/' . $this->attributes['image'];
        }
        return asset('logo.png');
    }

}
