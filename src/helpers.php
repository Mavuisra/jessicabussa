<?php

declare(strict_types=1);

function e(mixed $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function env(string $key, mixed $default = null): mixed
{
    return \App\Core\EnvLoader::get($key, $default);
}

function sql_today(): string
{
    return (config('database')['driver'] ?? 'sqlite') === 'mysql' ? 'CURDATE()' : "date('now')";
}

/**
 * LIMIT/OFFSET en SQL brut — requis pour MySQL/MariaDB (les placeholders ? sont quotés).
 */
function sql_limit(int $limit, int $offset = 0): string
{
    $limit = max(0, $limit);
    $offset = max(0, $offset);

    if ($offset > 0) {
        return 'LIMIT ' . $limit . ' OFFSET ' . $offset;
    }

    return 'LIMIT ' . $limit;
}

function config(string $file): array
{
    static $cache = [];
    if (!isset($cache[$file])) {
        $cache[$file] = require base_path('config/' . $file . '.php');
    }
    return $cache[$file];
}

function base_path(string $path = ''): string
{
    $root = defined('BASE_PATH') ? BASE_PATH : dirname(__DIR__);
    return $root . ($path ? DIRECTORY_SEPARATOR . ltrim(str_replace('/', DIRECTORY_SEPARATOR, $path), '/\\') : '');
}

function public_path(string $path = ''): string
{
    $public = is_dir(base_path('public')) ? base_path('public') : base_path();
    return $public . ($path ? DIRECTORY_SEPARATOR . ltrim(str_replace('/', DIRECTORY_SEPARATOR, $path), '/\\') : '');
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

    $path = ltrim(str_replace('\\', '/', $path), '/');

    // Ancien Django : certaines images blog sont dans static/images/
    if (str_starts_with($path, 'images/')) {
        return asset($path);
    }

    return '/media/' . $path;
}

function asset(string $path): string
{
    return '/static/' . ltrim($path, '/');
}

function current_url(): string
{
    $base = rtrim((string) config('app')['url'], '/');
    $path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
    $query = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_QUERY);

    return $base . $path . ($query ? '?' . $query : '');
}

function absolute_url(string $path): string
{
    if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
        return $path;
    }

    return rtrim((string) config('app')['url'], '/') . '/' . ltrim($path, '/');
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

function gallery_label(string $category): string
{
    return config('categories')['gallery'][$category] ?? ucfirst($category);
}

function truncate_words(string $text, int $words = 25): string
{
    $parts = preg_split('/\s+/', strip_tags($text)) ?: [];
    if (count($parts) <= $words) {
        return implode(' ', $parts);
    }
    return implode(' ', array_slice($parts, 0, $words)) . '…';
}
