<?php

return [
    'driver' => env('FCM_PROTOCOL', 'http'),
    'log_enabled' => false,

    'http' => [
        'server_key' => env('FCM_SERVER_KEY', 'AAAAnR-EfyY:APA91bEYeo6QIwa9zzgsjJjzDsdEeR5E1EHCVEpqQnzmEafSXCw71uhQHAbmxLHb0fsY8Ga5AkNxYbXP9CvLD9odLeVqY4xGE-ziOYG4EjeRintLeDp99qexoxBy-Iq6BeurON3VEw78'),
        'sender_id' => env('FCM_SENDER_ID', '674838642470'),
        'server_send_url' => 'https://fcm.googleapis.com/fcm/send',
        'server_group_url' => 'https://android.googleapis.com/gcm/notification',
        'timeout' => 30.0, // in second
    ],
];
