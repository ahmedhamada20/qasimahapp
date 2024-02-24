<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    public function login()
    {
        return view('admin.auth.login');
    }


    public function authenticate(Request $request)
    {
        if (\Auth::guard('admin')->attempt(['email' => $request['email'], 'password' => $request['password']])) {
            toast('مرحبا بكم في لوحة التحكم', 'success', 'left');

            return redirect()->route('admin');
        } else {
            Alert::error('خطأ في البيانات', 'البريد الألكتروني أو الرقم السري خطأ');

            return redirect()->back();
        }
    }

    public function index()
    {
        return view('admin.auth.index');
    }

    public function admin_logout()
    {
        \Auth::guard('admin')->logout();
        toast('تم تسجيل الخروج بنجاح', 'success', 'top-left');

        return redirect()->route('admin_login');
    }
}
