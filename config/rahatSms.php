<?php

return [
    'default' => 'smsIr',
    'drivers' => [
        'smsIr' => [
            'api_key' => env('SMSIR_APP_KEY'),
            'line_number' => env('SMSIR_LINE_NUMBER'),
            'routes' => [
                'verify' => 'https://api.sms.ir/v1/send/verify',
                'bulk' => 'https://api.sms.ir/v1/send/bulk',
                'bulk_delete' => 'https://api.sms.ir/v1/send/scheduled/',
            ]
        ],
    ],
];
