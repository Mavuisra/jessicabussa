<?php

declare(strict_types=1);

function e(mixed $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function env(string $key, mixed $default = null): mixed
{
    static $loaded = false;
    static $vars = [];

    if (!$loaded) {
        $path = dirname(__DIR__) . '/.env';
        if (is_file($path)) {
            foreach (file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
                $line = trim($line);
                if ($line === '' || str_starts_with($line, '#') || !str_contains($line, '=')) {
                    continue;
                }
                [$name, $value] = explode('=', $line, 2);
                $vars[trim($name)] = trim($value, " \t\"'");
            }
        }
        $loaded = true;
    }

    return $vars[$key] ?? $_ENV[$key] ?? getenv($key) ?: $default;
}

function config(string $file): array
{
    static $cache = [];
    if (!isset($cache[$file])) {
        $cache[$file] = require dirname(__DIR__) . '/config/' . $file . '.php';
    }
    return $cache[$file];
}

function base_path(string $path = ''): string
{
    return dirname(__DIR__) . ($path ? DIRECTORY_SEPARATOR . ltrim($path, '/\\') : '');
}

function public_path(string $path = ''): string
{
    return base_path('public' . ($path ? '/' . ltrim($path, '/') : ''));
}

function storage_path(string $path = ''): string
{
    return base_path('storage' . ($path ? '/' . ltrim($path, '/') : ''));
}

function media_path(string $path = ''): string
{
    return base_path('media' . ($path ? '/' . ltrim($path, '/') : ''));
}

function media_url(?string $path): string
{
    if (!$path) {
        return '';
    }
    return '/media/' . ltrim(str_replace('\\', '/', $path), '/');
}

function asset(string $path): string
{
    return '/static/' . ltrim($path, '/');
}

function url(string $name, mixed ...$params): string
{
    return \App\Core\Router::url($name, ...$params);
}

function csrf_token(): string
{
    return \App\Core\Csrf::token();
}

function csrf_field(): string
{
    return '<input type="hidden" name="_csrf" value="' . e(csrf_token()) . '">';
}

function old(string $key, mixed $default = ''): mixed
{
    return $_SESSION['_old'][$key] ?? $default;
}

function flash(string $type): ?string
{
    $message = $_SESSION['_flash'][$type] ?? null;
    unset($_SESSION['_flash'][$type]);
    return $message;
}

function redirect(string $to): never
{
    header('Location: ' . $to);
    exit;
}

function json_response(array $data, int $status = 200): never
{
    http_response_code($status);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit;
}

function get_client_ip(): string
{
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return trim(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])[0]);
    }
    return $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
}

function slugify(string $text): string
{
    $text = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $text);
    $text = preg_replace('~[^\pL\d]+~u', '-', $text) ?? $text;
    $text = trim($text, '-');
    $text = strtolower($text);
    return $text ?: 'n-a';
}

function category_label(string $category): string
{
    return config('categories')['article'][$category] ?? ucfirst($category);
}

function event_type_label(string $type): string
{
    return config('categories')['event'][$type] ?? ucfirst($type);
}

function truncate_words(string $text, int $words = 25): string
{
    $parts = preg_split('/\s+/', strip_tags($text)) ?: [];
    if (count($parts) <= $words) {
        return implode(' ', $parts);
    }
    return implode(' ', array_slice($parts, 0, $words)) . '…';
}
