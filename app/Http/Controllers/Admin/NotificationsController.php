<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\NotificationJob;
use App\Models\Item;
use App\Models\Notification;
use App\Models\Token;
use App\User;
use Carbon\Carbon;
use Edujugon\PushNotification\PushNotification;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function index(Request $request)
    {
        $ads =\DB::table('items')->where('show',1)->select([
            'id',
            'title',
        ])->get();
        $users = \DB::table('users')->select(['id','name','email'])->get();
        return view('admin.notifications.index',get_defined_vars());
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'body_ar' => 'required',
            'body_en' => 'required',
            'title_ar' => 'required',
            'title_en' => 'required',
        ]);


// //        $users = User::whereHas('tokens')->get();
//         // $users = User::whereHas('tokens')->whereIn('id',[56794,56795])->get();
//         $users = \DB::table('device_tokens')->whereIn('user_id',['56793',56794,56795])->where('device_type','ios')->whereNotNull('token')->pluck('token')->all();
//         // dd($users);

        if($request->url_type == 'internal'){
            $url_value = $request->internal_url_value;
        }else{
            $url_value = $request->external_url_value;
        }

        if($request->image != null){
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move('dash/notifications/', $imageName);
            $image = $imageName;
        }

        $userIds = collect($request->user_id??[])->filter(fn($user)=>$user!='all')->toArray();


        if(count($userIds) != 0 && !in_array('all',$request->user_id??[])){
            foreach ($userIds as $value) {
                Notification::create([
                    'body'=> [
                        'ar'=>$request->body_ar,
                        'en'=>$request->body_en,
                    ],
                    'title'=>[
                        'ar'=>$request->title_ar,
                        'en'=>$request->title_en,
                    ],
                    'url_type'=>$request->url_type,
                    'url_value'=> $url_value,
                    'user_id'=>$value,
                    'image'=> isset($image) ?  asset('dash/notifications/'.$image) : null
                ]);
            }
        }else{
            Notification::create([
                'body'=> [
                    'ar'=>$request->body_ar,
                    'en'=>$request->body_en,
                ],
                'title'=>[
                    'ar'=>$request->title_ar,
                    'en'=>$request->title_en,
                ],
                'url_type'=>$request->url_type,
                'url_value'=> $url_value,
                'image'=> isset($image) ?  asset('dash/notifications/'.$image) : null
            ]);
        }



          $SERVER_API_KEY = env('FCM_SERVER_KEY');

          $data = [
            "title" => $request['title_ar'],$request['title_en'],
            "sound"=>"Default",
            "body" => $request['body_ar'], $request['body_en'],
            'image_url'=> isset($image) ? asset('dash/notifications/'.$image) : '',
            'url_type'=>$request->url_type,
            'url_value'=>$url_value,
            'image'=> isset($image) ?  asset('dash/notifications/'.$image) : ''
          ];



        if(count($userIds) > 0){
            $users = User::with('tokens')->whereIn('id',$userIds)->get();
            $tokens = $users->pluck('tokens')->flatten();
            $androidTokens = $tokens->where('device_type','android')->pluck('token')->values()->toArray();
            $iosTokens = $tokens->where('device_type','ios')->pluck('token')->values()->toArray();


            if(count($androidTokens) > 0){
                $this->sendFcm($data,'android',$androidTokens);
            }
            if(count($iosTokens) > 0){
                $this->sendFcm($data,'ios',$iosTokens);
            }

        }else{
            $this->sendFcm($data);
        }


        toast('تم الارسال بنجاح', 'success', 'top-left');
        return back();

    }

    function sendFcm($data,$type = NULL,$tokens = []) {
        $dataToSend = [
            "notification" => $data,
            "content_available"=> true,
            "mutable_content"=> true,
            "priority"=> "HIGH"
        ];

        if(count($tokens) == 0){
            $dataToSend['to'] = "/topics/QasimahApp";
        }else{
            $dataToSend['registration_ids'] = $tokens;
            if($type == 'android'){
                $dataToSend['data'] = $data;
            }
        }

        $dataString = json_encode($dataToSend);

        $headers = [
            'Authorization: key=AAAAfO1PyFY:APA91bGUIKw1Wg7nIxpa5sG8Q1_3tEDpouai7Ow4i9MfIe7M6J2lYtNuZf4Cq7m4NRxZUIEphuZfz5lKTsnnj7eKlj-o58V9gyMdLDrhGqg8O5I0eSFC2fvlK0ef9lL9aoBoJH022pK2',
            'Content-Type: application/json',
        ];


        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response = curl_exec($ch);

        return json_decode($response);
    }
}
