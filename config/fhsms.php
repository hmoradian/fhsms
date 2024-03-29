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
    'services' => [
        'base_url' => env('FHSMS_BASE_URL'),
        'user_name' => env('FHSMS_USERNAME'),
        'password' => env('FHSMS_PASSWORD'),
        'phone_number' => env('FHSMS_PHONE_NUMBER'),
    ],
];
