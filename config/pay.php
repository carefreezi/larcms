<?php

return [

    'alipay' => [
        'app_id'         => env('alipay_app_id'),
        'ali_public_key' => env('ali_public_key'),
        'private_key'    => env('alipay_private_key'),
        'log'            => [
            'file' => storage_path('logs/alipay.log'),
        ],
    ],

    'wechat' => [
        'app_id'      =>  env('wechat_app_id'),
        'mch_id'      =>  env('wechat_mch_id'),
        'key'         =>  env('wechat_key'),
        'cert_client' => resource_path('wechat_pay/apiclient_cert.pem'),
        'cert_key'    => resource_path('wechat_pay/apiclient_key.pem'),
        'log'         => [
            'file' => storage_path('logs/wechat_pay.log'),
        ],
    ],
];
