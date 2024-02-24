<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;
use App\Models\Notification;
use Illuminate\Http\Request;
use JWTAuth;

class NotificationsController extends Controller
{
    public function index()
    {
        $lang = \request()->header('Accept-Language', 'ar');
        \App::setLocale($lang);

        $authorization = \request()->header('Authorization');

        if(!empty($authorization)){
            $user = JWTAuth::parseToken()->authenticate();
        }else{
            $user = null;
        }

        $rows = Notification::query();

        if($user){
            $rows = $rows->where(function ($q) use($user) {
                $q->where('user_id', $user->id)->orWhereNull('user_id');
            });
        }else{
            $rows = $rows->whereNull('user_id');
        }

        $rows = $rows->orderByDesc('id')->paginate(10);
        return NotificationResource::collection($rows)->additional(['value' => true]);
    }

    public function delete_all_notifications()
    {
        if (!$user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['value' => false, 'msg' => \Lang::get('data.wrong_token'), 'code' => 401]);
        }
        Notification::whereUserId($user->id)->delete();
        $rows = Notification::where('user_id', $user->id)->orderByDesc('id')->paginate(10);
        return NotificationResource::collection($rows)->additional(['value' => true]);
    }

    public function destroy($id)
    {
        if (!$user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['value' => false, 'msg' => \Lang::get('data.wrong_token'), 'code' => 401]);
        }
        Notification::whereId($id)->delete();
        $rows = Notification::where('user_id', $user->id)->orderByDesc('id')->paginate(10);
        return NotificationResource::collection($rows)->additional(['value' => true]);
    }
}
