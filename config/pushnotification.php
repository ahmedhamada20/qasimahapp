<?php
/**
 * @see https://github.com/Edujugon/PushNotification
 */

return [
    'gcm' => [
        'priority' => 'normal',
        'dry_run' => false,
        'apiKey' => 'My_ApiKey',
    ],
    'fcm' => [
        'priority' => 'normal',
        'dry_run' => false,
        'apiKey' => 'AAAAQ1BvQyg:APA91bFwNk7XO7xfblTB2aKlcEZRwaWOY9uuYgEA_8u1ny7GVUxX_-v8NOfW80sYq88g-pLGF34G5dDJPoviMxfRVLyWjsNwEyuifg6Y3X65aBICsq81StC6MUAHJ2LnFcRlChltedyF',
    ],
    'apn' => [
        'certificate' => __DIR__ . '/iosCertificates/apns-dev-cert.pem',
        'passPhrase' => 'secret', //Optional
        'passFile' => __DIR__ . '/iosCertificates/yourKey.pem', //Optional
        'dry_run' => true,
    ],
];
