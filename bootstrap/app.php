<?php

declare(strict_types=1);

/**
 * Détecte la racine du projet (htdocs, www, public/, etc.).
 */
function detect_base_path(string $entryFile): string
{
    $dir = realpath(dirname($entryFile)) ?: dirname($entryFile);

    for ($i = 0; $i < 6 && $dir !== false && $dir !== '/' && $dir !== '\\'; $i++) {
        if (is_file($dir . '/config/app.php') || is_file($dir . '/composer.json')) {
            return $dir;
        }
        $parent = dirname($dir);
        if ($parent === $dir) {
            break;
        }
        $dir = $parent;
    }

    return dirname($entryFile);
}

function register_fallback_autoload(string $basePath): void
{
    $prefix = 'App\\';
    $baseDir = $basePath . '/src/';

    spl_autoload_register(static function (string $class) use ($prefix, $baseDir, $basePath): void {
        if (!str_starts_with($class, $prefix)) {
            return;
        }

        $relative = substr($class, strlen($prefix));
        $file = $baseDir . str_replace('\\', '/', $relative) . '.php';

        if (is_file($file)) {
            require $file;
            return;
        }

        // classmap : plusieurs classes dans Service.php
        $serviceFile = $basePath . '/src/Models/Service.php';
        if (is_file($serviceFile)) {
            require_once $serviceFile;
        }
    });
}

function bootstrap_app(string $entryFile): void
{
    if (defined('BASE_PATH')) {
        return;
    }

    define('BASE_PATH', detect_base_path($entryFile));

    $autoloadCandidates = [
        BASE_PATH . '/vendor/autoload.php',
        dirname(BASE_PATH) . '/vendor/autoload.php',
    ];

    $loaded = false;
    foreach ($autoloadCandidates as $autoload) {
        if (is_file($autoload)) {
            require $autoload;
            $loaded = true;
            break;
        }
    }

    if (!$loaded) {
        register_fallback_autoload(BASE_PATH);
        require BASE_PATH . '/src/helpers.php';
    }
}
