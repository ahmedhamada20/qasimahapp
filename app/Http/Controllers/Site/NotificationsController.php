<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function notifications()
    {
        $rows = Notification::where('user_id', \Auth::user()->id)->latest()->get();
        return view('site.notifications', compact('rows'));
    }

    public function delete_notifications()
    {
        Notification::where('user_id', \Auth::user()->id)->delete();
        toast(\Lang::get('data.removedSuccess'), 'success');
        return redirect()->back();
    }
}
