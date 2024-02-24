<?php

namespace App\Jobs;

use App\Models\Notification;
use App\Models\Token;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Edujugon\PushNotification\PushNotification;

class NotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user_id;
    public $message_ar;
    public $message_en;
    public $title_ar;
    public $title_en;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user_id, $message_ar, $message_en, $title_ar, $title_en)
    {

        $this->user_id = $user_id;
        $this->message_ar = $message_ar;
        $this->message_en = $message_en;
        $this->title_ar = $title_ar;
        $this->title_en = $title_en;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user = User::findOrFail($this->user_id);
        $notification = new Notification();
        $notification['user_id'] = $this->user_id;
        $notification['body->ar'] = $this->message_ar;
        $notification['body->en'] = $this->message_en;
        $notification['title->ar'] = $this->title_ar;
        $notification['title->en'] = $this->title_en;
        $notification->save();

        $tokens = Token::where('user_id', $user->id)->whereStatus('connected')->get();

        foreach ($tokens as $token) {
            if ($token->device_language = 'ar') {
                $title = $this->title_ar;
                $body = $this->message_ar;
            } else {
                $title = $this->title_en;
                $body = $this->message_en;
            }
            $push = new PushNotification('fcm');
            
          

            if ($token->device_type == 'ios') {

                $msg = [
                    'data' => [
                        'title_ar' => $this->title_ar,
                        'title' => $title,
                        'body' => $body,
                        'title_en' => $this->title_en,
                        'body_ar' => $this->message_ar,
                        'body_en' => $this->message_en,
                        'sound' => 'default',
                        'click_action' => 'FCM_PLUGIN_ACTIVITY',
                    ],
                    'notification' => [
                        'title_ar' => $this->title_ar,
                        'title_en' => $this->title_en,
                        'body_ar' => $this->message_ar,
                        'body_en' => $this->message_en,
                        'title' => $title,
                        'body' => $body,

                        'sound' => 'default',
                        'click_action' => 'FCM_PLUGIN_ACTIVITY',
                    ],
                    'priority' => 'high',
                ];
                $push->setMessage($msg)
                    ->setApiKey('AAAAfO1PyFY:APA91bGUIKw1Wg7nIxpa5sG8Q1_3tEDpouai7Ow4i9MfIe7M6J2lYtNuZf4Cq7m4NRxZUIEphuZfz5lKTsnnj7eKlj-o58V9gyMdLDrhGqg8O5I0eSFC2fvlK0ef9lL9aoBoJH022pK2')
                    ->setDevicesToken($token->token)
                    ->send();

            } else {
                $msg = [
                    'data' => [
                        'title_ar' => $this->title_ar,
                        'title_en' => $this->title_en,
                        'body_ar' => $this->message_ar,
                        'body_en' => $this->message_en,
                        'title' => $title,
                        'body' => $body,
                        'sound' => 'default',
                        'click_action' => 'FCM_PLUGIN_ACTIVITY',
                    ],
                    'priority' => 'high',
                ];
                $push->setMessage($msg)
                    ->setApiKey('AAAAfO1PyFY:APA91bGUIKw1Wg7nIxpa5sG8Q1_3tEDpouai7Ow4i9MfIe7M6J2lYtNuZf4Cq7m4NRxZUIEphuZfz5lKTsnnj7eKlj-o58V9gyMdLDrhGqg8O5I0eSFC2fvlK0ef9lL9aoBoJH022pK2')
                    ->setDevicesToken($token->token)
                    ->send();

            }

        }
    }

}
