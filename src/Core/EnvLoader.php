<?php

declare(strict_types=1);

namespace App\Core;

/**
 * Charge les variables d'environnement avant toute configuration applicative.
 *
 * Ordre de priorité (chaque fichier écrase le précédent) :
 *   1. .env.production  — configuration serveur LWS
 *   2. .env             — surcharge locale ou secrets spécifiques au déploiement
 *
 * En développement local uniquement, si aucun fichier n'existe,
 * .env.example est copié vers .env (SQLite).
 */
final class EnvLoader
{
    private static bool $loaded = false;

    /** @var array<string, string> */
    private static array $vars = [];

    public static function load(?string $basePath = null): void
    {
        if (self::$loaded) {
            return;
        }

        $base = $basePath ?? (defined('BASE_PATH') ? BASE_PATH : dirname(__DIR__, 2));

        self::bootstrapLocalEnvironment($base);

        foreach (self::resolveFiles($base) as $file) {
            self::parseFile($file);
        }

        self::$loaded = true;
    }

    public static function get(string $key, mixed $default = null): mixed
    {
        self::load();

        if (array_key_exists($key, self::$vars)) {
            return self::$vars[$key];
        }

        $server = $_ENV[$key] ?? getenv($key);

        return $server !== false && $server !== '' ? $server : $default;
    }

    public static function has(string $key): bool
    {
        self::load();

        return array_key_exists($key, self::$vars)
            || isset($_ENV[$key])
            || getenv($key) !== false;
    }

    public static function isProduction(): bool
    {
        $env = strtolower((string) self::get('APP_ENV', ''));

        if ($env === 'production') {
            return true;
        }

        if ($env === 'local' || $env === 'development') {
            return false;
        }

        return self::isProductionHost();
    }

    /** @return list<string> */
    private static function resolveFiles(string $base): array
    {
        $production = $base . DIRECTORY_SEPARATOR . '.env.production';
        $local = $base . DIRECTORY_SEPARATOR . '.env';

        $hasProduction = is_file($production);
        $hasLocal = is_file($local);

        if (!$hasProduction && !$hasLocal) {
            return [];
        }

        if ($hasProduction && $hasLocal && self::isProductionHost()) {
            $localDriver = self::peekValue($local, 'DB_DRIVER');
            $productionDriver = self::peekValue($production, 'DB_DRIVER');

            if ($localDriver === 'sqlite' && $productionDriver === 'mysql') {
                return [$production];
            }
        }

        $files = [];

        if ($hasProduction) {
            $files[] = $production;
        }

        if ($hasLocal) {
            $files[] = $local;
        }

        return $files;
    }

    private static function peekValue(string $path, string $key): ?string
    {
        $lines = file($path, FILE_IGNORE_NEW_LINES);

        if ($lines === false) {
            return null;
        }

        $prefix = $key . '=';

        foreach ($lines as $line) {
            $line = trim($line);

            if ($line === '' || str_starts_with($line, '#') || !str_starts_with($line, $prefix)) {
                continue;
            }

            return self::normalizeValue(trim(substr($line, strlen($prefix))));
        }

        return null;
    }

    private static function bootstrapLocalEnvironment(string $base): void
    {
        if (self::isProductionHost() || is_file($base . DIRECTORY_SEPARATOR . '.env.production')) {
            return;
        }

        $env = $base . DIRECTORY_SEPARATOR . '.env';
        $example = $base . DIRECTORY_SEPARATOR . '.env.example';

        if (!is_file($env) && is_file($example)) {
            copy($example, $env);
        }
    }

    private static function isProductionHost(): bool
    {
        $host = strtolower((string) ($_SERVER['HTTP_HOST'] ?? $_SERVER['SERVER_NAME'] ?? ''));

        if ($host === '') {
            return PHP_SAPI !== 'cli';
        }

        return str_contains($host, 'jessicabussa.cd');
    }

    private static function parseFile(string $path): void
    {
        $lines = file($path, FILE_IGNORE_NEW_LINES);

        if ($lines === false) {
            return;
        }

        foreach ($lines as $line) {
            $line = trim($line);

            if ($line === '' || str_starts_with($line, '#')) {
                continue;
            }

            if (str_starts_with($line, 'export ')) {
                $line = trim(substr($line, 7));
            }

            if (!str_contains($line, '=')) {
                continue;
            }

            [$name, $value] = explode('=', $line, 2);
            $name = trim($name);
            $value = self::normalizeValue(trim($value));

            self::$vars[$name] = $value;
            $_ENV[$name] = $value;
            putenv($name . '=' . $value);
        }
    }

    private static function normalizeValue(string $value): string
    {
        if ($value === '') {
            return '';
        }

        $first = $value[0];
        $last = $value[strlen($value) - 1];

        if (($first === '"' && $last === '"') || ($first === "'" && $last === "'")) {
            return substr($value, 1, -1);
        }

        return $value;
    }
}
