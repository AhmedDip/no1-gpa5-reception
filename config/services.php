<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],
    'textlocal' => [
        'api_key' => env('TEXTLOCAL_API_KEY'),
        'sender' => env('TEXTLOCAL_SENDER', 'NO1BKS'),
    ],

    'twilio' => [
        'sid' => env('TWILIO_SID'),
        'token' => env('TWILIO_TOKEN'),
        'from' => env('TWILIO_FROM'),
    ],

    'smsapi' => [
        'key' => env('SMSAPI_KEY'),
        'sender' => env('SMSAPI_SENDER', 'NO1BKS'),
    ],

    'sms_provider' => [
        'api_key' => env('SMS_PROVIDER_API_KEY'),
        'sender_id' => env('SMS_PROVIDER_SENDER_ID', 'NO1BKS'),
        'url' => env('SMS_PROVIDER_URL'),
    ],

];
