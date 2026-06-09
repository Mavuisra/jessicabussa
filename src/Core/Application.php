<?php

declare(strict_types=1);

namespace App\Core;

final class Application
{
    public static function boot(): void
    {
        date_default_timezone_set(config('app')['timezone']);
        Session::start();

        if (is_file(base_path('.env'))) {
            // loaded via env() helper
        } elseif (is_file(base_path('.env.example')) && !is_file(base_path('.env'))) {
            copy(base_path('.env.example'), base_path('.env'));
        }

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
