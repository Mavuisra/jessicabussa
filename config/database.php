<?php

declare(strict_types=1);

$driver = env('DB_DRIVER', 'sqlite');

if ($driver === 'mysql') {
    return [
        'driver' => 'mysql',
        'host' => env('DB_HOST', '127.0.0.1'),
        'port' => env('DB_PORT', '3306'),
        'database' => env('DB_NAME', 'jessicabussa'),
        'username' => env('DB_USER', 'root'),
        'password' => env('DB_PASSWORD', ''),
        'charset' => 'utf8mb4',
    ];
}

return [
    'driver' => 'sqlite',
    'path' => base_path(env('DB_PATH', 'db.sqlite3')),
];
