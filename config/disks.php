<?php

return [
    'upload_files' => [
        'driver' => 's3',
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION'),
        'bucket' => env('AWS_BUCKET'),
        'url' => env('AWS_URL'),
        'endpoint' => env('AWS_ENDPOINT'),
        'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
        'throw' => false,
    ],

    'tmp_files' => [
        'driver' => 's3',
        'key' => env('AWS_TMP_ACCESS_KEY_ID'),
        'secret' => env('AWS_TMP_SECRET_ACCESS_KEY'),
        'region' => env('AWS_TMP_DEFAULT_REGION'),
        'bucket' => env('AWS_TMP_BUCKET'),
        'url' => env('AWS_URL'),
        'endpoint' => env('AWS_ENDPOINT'),
        'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
        'throw' => false,
    ],
];
