<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Pesan;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

class NotifController extends HomeController
{
    public function __construct()
    {
        parent::__construct();

        $this->Pesan = new Pesan;
    }
   
    public function store(Request $request)
    {
        $this->validate($request, [
            'subject' => 'required|max:255',
            'pesan' => 'required',
        ]);

        $input = array_except($request->all(),array('_token'));

        $this->Pesan->AddData($input);

        $notification = \DB::table('api_users')->get();

        foreach ($notification as $key => $value) {
            $this->notification($value->token, $request->get('subject'));
        }

        \Session::put('success','Post store and send notification successfully!!');

        return redirect()->route('notif.index');
    }

    public function notification($token, $title)
    {
        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
        $token=$token;

        $notification = [
            'subject' => $title,
            'sound' => true,
        ];
        
        $extraNotificationData = ["message" => $notification,"moredata" =>'dd'];

        $fcmNotification = [
            //'registration_ids' => $tokenList, //multple token array
            'to'        => $token, //single token
            'notification' => $notification,
            'data' => $extraNotificationData
        ];

        $headers = [
            'Authorization: key=Legacy server key',
            'Content-Type: application/json'
        ];


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
        $result = curl_exec($ch);
        curl_close($ch);

        return true;
    }

    public function test()
    {
    $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
    $token='AAAARHfxqvk:APA91bHb-8TNHP_iV1JwUptH1vTPmc5LWggXOVfUpZYqhXQGRyiRNY_wYGvcczF22FCN3xy5blmZt6TbExvQPmsT--Qw7IuVlMWbyWZXFA7c-zZa3WoBOruDeJNiYxYPIRsU5TwQKzh9';
    

    $notification = [
        'body' => 'this is test',
        'sound' => true,
    ];
    
    $extraNotificationData = ["message" => $notification,"moredata" =>'dd'];

    $fcmNotification = [
        //'registration_ids' => $tokenList, //multple token array
        'to'        => $token, //single token
        'notification' => $notification,
        'data' => $extraNotificationData
    ];

    $headers = [
        'Authorization: key=Legacy server key',
        'Content-Type: application/json'
    ];


    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$fcmUrl);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
    $result = curl_exec($ch);
    curl_close($ch);


    dd($result);
    }
}