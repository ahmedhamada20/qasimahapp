<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BrandsResource;
use App\Http\Resources\CategoriesResource;
use App\Models\Brand;
use App\Models\Category;

use App\Models\Setting;
use JWTAuth;

class DataController extends Controller
{
    public function brands()
    {
        $lang = \request()->header('Accept-Language', 'ar');
        \App::setLocale($lang);
        $rows = Brand::all();
        return BrandsResource::collection($rows)->additional(['value' => true]);
    }

    public function categories()
    {
        $lang = \request()->header('Accept-Language', 'ar');
        \App::setLocale($lang);
        // $rows = Category::all();
        $rows = Category::orderBy('sort_order', 'ASC')->get();
        return CategoriesResource::collection($rows)->additional(['value' => true]);
    }


    public function settings()
    {
        $setting = Setting::first();
        $data['mobile'] = $setting ? $setting->mobile : '';
        $data['email'] = $setting ? $setting->email : '';
        return response()->json(['value' => true, 'data' => $data]);
    }

}
