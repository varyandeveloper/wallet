<?php

return [
    'default' => [
        'code' => 'USD'
    ],

    'providers' => [
        'default' => env('CURRENCY_EXCHANGE_DRIVER', 'exchange_rate_api'),

        'exchange_rate_api' => [
            'url' => env('CURRENCY_EXCHANGE_RATE_API_URL', 'https://api.exchangeratesapi.io/'),
            'key' => [

            ]
        ]
    ]
];
