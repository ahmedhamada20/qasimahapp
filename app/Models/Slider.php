<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $guarded = [];
    protected $table = 'sliders';

    public function setImageAttribute()
    {
        $file = request()->file('image');
        $destinationPath = 'images/sliders/';
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move($destinationPath, $filename);
        $this->attributes['image'] = $filename;
    }

    public function getImageAttribute()
    {
        if ($this->attributes['image']) {
            return asset('images/sliders/') . '/' . $this->attributes['image'];
        }
        return asset('logo.png');
    }
}
