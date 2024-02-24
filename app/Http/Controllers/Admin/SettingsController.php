<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $row = Setting::first();
        return view('admin.settings.index', compact('row'));
    }

    public function rules()
    {
        return [
            'mobile' => 'required',
            'email' => 'required|email',
        ];
    }

    public function update(Request $request, $id)
    {

        $this->validate($request, $this->rules());


        $setting = Setting::find($id);
        $setting['mobile'] = $request['mobile'];
        $setting['email'] = $request['email'];

        $setting->update();
        toast('تمت تعديل الإعدادات بنجاح', 'success', 'left');
        return redirect()->back();
    }
}
