<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{

    protected $table = 'brands';
    public $timestamps = true;
    protected $fillable = array('name', 'image');
    protected $casts = ['name'=>'json'];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($q) {


            $slug = $q->id . '--' .\Str::slug($q->name['en']);

            $arTitle = $q->name['ar'];
            $enTitle = $q->name['en'];

            $seoPage = new SeoPage();
            $seoPage->uri = '/brands/' . $slug;
            $seoPage->title = [
                'en' => "كود خصم $enTitle | كوبونات فعالة 100% | تطبيق قسيمة",
                'ar' => "كود خصم $arTitle | كوبونات فعالة 100% | تطبيق قسيمة",
            ];
            $seoPage->description = [
                'en' => "تطبيق قسيمة يوفر لك كود خصم اسم التطبيق لتعيش تجربة شراء افضل مع خصومات و كوبونات تخفيض فعالة على اي عدد من المشتريات لك ولعائلتك، استمتع بالشراء مع قسيمة باستخدام كوبون خصم $enTitle",
                'ar' => "تطبيق قسيمة يوفر لك كود خصم اسم التطبيق لتعيش تجربة شراء افضل مع خصومات و كوبونات تخفيض فعالة على اي عدد من المشتريات لك ولعائلتك، استمتع بالشراء مع قسيمة باستخدام كوبون خصم $arTitle",
            ];

            $seoPage->h1_header = [
                'ar'=> "كود خصم $arTitle",
                'en'=>"كود خصم $enTitle"
            ];
            $seoPage->model_type = Brand::class;
            $seoPage->model_id = $q->id;
            $seoPage->save();
        });
    }

    public function items()
    {
        return $this->hasMany(Item::class, 'brand_id');
    }

    public function setImageAttribute()
    {
        $file = request()->file('image');
        $destinationPath = 'images/brands/';
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move($destinationPath, $filename);
        $this->attributes['image'] = $filename;
    }

    public function getImageAttribute()
    {
        if ($this->attributes['image']) {
            return asset('images/brands/') . '/' . $this->attributes['image'];
        }
        return asset('logo.png');
    }

    function seoPage() {
        return $this->morphOne(SeoPage::class,'model');
    }
}
