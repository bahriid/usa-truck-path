<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Google reCAPTCHA Keys
    |--------------------------------------------------------------------------
    |
    | Get your keys from: https://www.google.com/recaptcha/admin
    | Select reCAPTCHA v2 "I'm not a robot" Checkbox
    |
    */

    'site_key' => env('RECAPTCHA_SITE_KEY', ''),
    'secret_key' => env('RECAPTCHA_SECRET_KEY', ''),

    /*
    |--------------------------------------------------------------------------
    | Enable reCAPTCHA
    |--------------------------------------------------------------------------
    |
    | Set to false to disable reCAPTCHA validation (useful for testing)
    |
    */

    'enabled' => env('RECAPTCHA_ENABLED', true),
];
