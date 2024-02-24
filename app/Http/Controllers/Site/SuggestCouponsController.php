<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Setting;
use App\Models\SuggestCoupon;
use Illuminate\Http\Request;

class SuggestCouponsController extends Controller
{
    public function index()
    {
        $setting  = Setting::first();
        $categories = Category::all();
        return view('site.suggestCoupon',compact('categories','setting'));
    }
    public function store(Request  $request){
        $this->validate($request,[
            'full_name'=>'required',
            'email'=>'required|email',
            'whatsapp'=>'required',
            'address'=>'required',
            'coupon_code'=>'required',
            'category_id'=>'required|exists:categories,id',
            'discount_percent'=>'required'
        ]);

        SuggestCoupon::create($request->all());
        toast(\Lang::get('data.sentSuccess'),'success');
        return redirect()->back();
    }
}
