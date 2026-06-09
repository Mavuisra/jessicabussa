<?php

declare(strict_types=1);

namespace App\Core;

final class Router
{
    /** @var array<string, array{pattern:string,methods:array<int,string>,handler:callable,middleware:array<int,string>}> */
    private static array $routes = [];

    /** @var array<string, string> */
    private static array $named = [];

    public static function get(string $path, callable $handler, ?string $name = null, array $middleware = []): void
    {
        self::add(['GET'], $path, $handler, $name, $middleware);
    }

    public static function post(string $path, callable $handler, ?string $name = null, array $middleware = []): void
    {
        self::add(['POST'], $path, $handler, $name, $middleware);
    }

    public static function match(array $methods, string $path, callable $handler, ?string $name = null, array $middleware = []): void
    {
        self::add($methods, $path, $handler, $name, $middleware);
    }

    private static function add(array $methods, string $path, callable $handler, ?string $name, array $middleware): void
    {
        $pattern = '#^' . preg_replace('#\{([a-zA-Z_]+)\}#', '(?P<$1>[^/]+)', rtrim($path, '/')) . '/?$#';
        $route = [
            'pattern' => $pattern === '#^/?$#' ? '#^/$#' : $pattern,
            'methods' => $methods,
            'handler' => $handler,
            'middleware' => $middleware,
        ];
        self::$routes[] = $route;
        if ($name) {
            self::$named[$name] = $path;
        }
    }

    public static function url(string $name, mixed ...$params): string
    {
        if (!isset(self::$named[$name])) {
            return '/';
        }

        $path = self::$named[$name];
        if ($params) {
            $path = preg_replace_callback('/\{[a-zA-Z_]+\}/', function () use (&$params) {
                return (string) array_shift($params);
            }, $path) ?? $path;
        }

        return rtrim($path, '/') . '/';
    }

    public static function dispatch(string $method, string $uri): void
    {
        $uri = parse_url($uri, PHP_URL_PATH) ?: '/';
        $uri = $uri === '' ? '/' : $uri;

        foreach (self::$routes as $route) {
            if (!in_array($method, $route['methods'], true)) {
                continue;
            }
            if (!preg_match($route['pattern'], rtrim($uri, '/') ?: '/', $matches)) {
                continue;
            }

            foreach ($route['middleware'] as $middleware) {
                if ($middleware === 'auth') {
                    Auth::requireLogin();
                }
            }

            $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
            ($route['handler'])(...array_values($params));
            return;
        }

        http_response_code(404);
        echo View::render('pages/errors/404', ['title' => 'Page non trouvée'], 'base');
    }
}
