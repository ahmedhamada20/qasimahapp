<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Help;
use App\Models\Setting;
use Illuminate\Http\Request;

class HelpController extends Controller
{
    public function help()
    {
        $setting = Setting::first();
        return view('site.help', compact('setting'));
    }

    public function help_post(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'address' => 'required',
            'brand' => 'required',
            'coupon' => 'required',
            'message' => 'required'
        ]);

        Help::create($request->all());

        toast(\Lang::get('data.helpSent'), 'success');
        return redirect()->route('home');
    }
}
