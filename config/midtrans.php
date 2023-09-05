<?php

use Midtrans\Config;

return [
    'mercant_id' => env('MIDTRANS_MERCHAT_ID'),
    'client_key' => env('MIDTRANS_CLIENT_KEY'),
    'server_key' => env('MIDTRANS_SERVER_KEY'),

    'is_production' => env('MIDTRANS_IS_PRODUCTION', false),
    'is_sanitized' => false,
    'is_3ds' => false,

    Config::$serverKey = env('MIDTRANS_SERVER_KEY'),
    Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false),
    Config::$isSanitized = false,
    Config::$is3ds = true,
];
