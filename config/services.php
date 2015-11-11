<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => '',
        'secret' => '',
    ],

    'mandrill' => [
        'secret' => 'ET2EpmbghDxbCI79s-dvNw',
    ],

    'ses' => [
        'key'    => '',
        'secret' => '',
        'region' => 'us-east-1',
    ],

    'stripe' => [
        'model'  => App\Src\User\User::class,
        'key'    => '',
        'secret' => '',
    ],
    'facebook' => [
        'client_id' => '1146208565408830',
        'client_secret' => '4058a5fcc24060792367ca3a9ea3b687',
        'redirect' => 'http://ebook.ideasowners.net/auth/facebook/callback',
    ],
    'github' => [
        'client_id' => 'd088c9e51c8d5a25766c',
        'client_secret' => '981c66868911c55af54002b04439fa7aeea8ae0e',
        'redirect' => 'http://ebook.ideasowners.net/auth/github/callback',
    ],
    'google' => [
        'client_id' => env('GOOGLE_KEY','535985071980-ac56en2hi3duvmonpthpagrqiv19pfkv.apps.googleusercontent.com'),
        'client_secret' => env('GOOGLE_SECRET','UmlpraKBYl4XazUZRBVz0vtT'),
        'redirect' => env('GOOGLE_REDIRECT_URI','http://ebook.com/auth/google/callback'),
    ],

];
