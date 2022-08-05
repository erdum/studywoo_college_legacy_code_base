<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default Quality
    |--------------------------------------------------------------------------
    |
    | This is a default quality unless you provide while generation of the WebP
    |
    */

    'default_quality' => 10,

    /*
    |--------------------------------------------------------------------------
    | Default Driver
    |--------------------------------------------------------------------------
    |
    | This is a default image processing driver. Available: ['cwebp']
    |
    */

    'default_driver' => 'cwebp',

    /*
    |--------------------------------------------------------------------------
    | Drivers
    |--------------------------------------------------------------------------
    |
    | Available drivers which can be selected
    |
    */

    'drivers' => [

        'cwebp' => [
            'path' => './../webp_package/bin/cwebp',
        ],

    ],
];
