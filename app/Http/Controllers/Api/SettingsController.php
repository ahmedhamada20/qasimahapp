<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BannerResource;
use App\Http\Resources\PaymentMethodsResource;
use App\Models\Banner;
use App\Models\PaymentMethod;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function settings(){
        $lang  = \request()->header('Accept-Language','ar');
        $row = Setting::first();
        $data['about'] = $row ? $row->about[$lang] : '';
        $data['policy'] = $row ? $row->policy[$lang] : '';
        $data['email'] = $row ? $row->email : '';
        $data['mobile'] = $row ? $row->mobile : '';
        $data['twitter'] = $row ? $row->twitter : '';
        $data['snapchat'] = $row ? $row->snapchat : '';
        $data['telegram'] = $row ? $row->telegram : '';
        $data['instagram'] = $row ? $row->instagram : '';
        $data['whatsapp'] = $row ? $row->whatsapp : '';
        $data['tax'] = $row ? $row->tax : '';
        $data['delivery_cost'] = $row ? $row->delivery_cost : '';
        $data['receive_cost'] = $row ? $row->receive_cost : '';
        return response()->json(['value'=>true,'data'=>$data]);
    }
    public function payment_methods(){
        $rows = PaymentMethod::whereStatus('active')->get();
        return PaymentMethodsResource::collection($rows)->additional(['value'=>true]);
    }


    public function informationssettings()
    {

        $data['min_version_name'] =  '1.9';
        $data['min_version_code'] =  '19';
        $data['latest_version_name'] =  '1.9';
        $data['latest_version_code'] =  '19';

        return response()->json(['data'=>$data]);

    }

    public function banners()
    {
        $data = Banner::where('status','active')->latest()->get();
        return BannerResource::collection($data)->additional([
            'value' => true,
        ]);
    }



}
