<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{

    protected $table = 'settings';
    public $timestamps = true;
    protected $fillable = array('mobile', 'email','site_banner');


    function setSiteBannerAttribute($value) {
        if($value){
            $imageName = time() . '.' . $value->extension();
            $value->move('dash/settings/', $imageName);
            $this->attributes['site_banner'] = $imageName;
        }
    }

    function getSiteBannerPathAttribute() {
        if(!$this->attributes['site_banner']) return null;
        return asset('/dash/settings/'.$this->attributes['site_banner']);
    }
}
