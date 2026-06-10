<?php

declare(strict_types=1);

$driver = env('DB_DRIVER', 'sqlite');

if ($driver === 'mysql') {
    return [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '127.0.0.1'), // 127.0.0.1 requis sur LWS (évite socket Unix)
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_NAME', 'lasav2675681_12lmwo'),
        'username' => env('DB_USER', 'lasav2675681'),
        'password' => env('DB_PASSWORD', ''),
        'charset' => 'utf8mb4',
    ];
}

return [
    'driver' => 'sqlite',
    'path' => base_path(env('DB_PATH', 'db.sqlite3')),
];
