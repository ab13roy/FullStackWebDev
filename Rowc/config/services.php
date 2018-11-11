<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    'facebook' => [
        'client_id'     => '350859285394203',
        'client_secret' => '25b6f2976b0ebb3a42ea01ef04e7c2a4',
        'redirect'      => 'http://165.227.191.207/SoEat/login/facebook/callback',
    ],
    'google' => [
        'client_id'     => '953117271861-qth58j86ktl8gdih8qsclstbneflo0gf.apps.googleusercontent.com',
        'client_secret' => 'Nc16hiFMR82kAOAEMHdURAl-',
        'redirect'      => 'http://165.227.191.207/SoEat/login/google/callback',
    ]


];
