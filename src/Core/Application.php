<?php

declare(strict_types=1);

namespace App\Core;

final class Application
{
    public static function boot(): void
    {
        EnvLoader::load();

        date_default_timezone_set(config('app')['timezone']);
        Session::start();

        require base_path('config/routes.php');
    }

    public static function run(): void
    {
        self::boot();
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $uri = $_SERVER['REQUEST_URI'] ?? '/';
        Router::dispatch($method, $uri);
    }
}
