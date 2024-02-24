<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class SeoPage extends Model
{

    protected $fillable = [
        'uri',
        'title',
        'description',
        'model_type',
        'model_id',
        'h1_header',
        'banner',
        'editor_section'
    ];

    protected $casts = [
        'title'=>'array',
        'description'=>'array',
        'h1_header'=>'array',
        'editor_section'=>'array',
    ];

    function model() {
        return $this->morphTo();
    }

    function getTypeAttribute() {
        switch ($this->model_type) {
            case Item::class :
                return 'coupon';
                break;

            default:
                return 'general';
                break;
        }
    }

    function setBannerAttribute($value) {
        if($value){
            $imageName = time() . '.' . $value->extension();
            $value->move('dash/seo-pages/', $imageName);
            $this->attributes['banner'] = $imageName;
        }
    }

    function getBannerPathAttribute() {
        if(empty($this->attributes['banner'])) return NULL;
        return asset('/dash/seo-pages/'.$this->attributes['banner']);
    }
}
