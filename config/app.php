<?php

declare(strict_types=1);

return [
    'name' => 'Jessica Bussa Portfolio',
    'env' => env('APP_ENV', 'local'),
    'debug' => filter_var(env('APP_DEBUG', 'true'), FILTER_VALIDATE_BOOLEAN),
    'url' => rtrim(env('APP_URL', 'http://127.0.0.1:8000'), '/'),
    'timezone' => 'UTC',
    'mail' => [
        'host' => env('MAIL_HOST', 'mail1.netim.hosting'),
        'port' => (int) env('MAIL_PORT', 465),
        'encryption' => env('MAIL_ENCRYPTION', 'ssl'),
        'username' => env('MAIL_USERNAME', 'contact@jessicabussa.cd'),
        'password' => env('MAIL_PASSWORD', ''),
        'from' => env('MAIL_FROM', 'contact@jessicabussa.cd'),
    ],
];
