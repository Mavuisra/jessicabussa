<?php

declare(strict_types=1);

namespace App\Core;

use PDO;
use PDOException;
use RuntimeException;

final class Database
{
    private static ?PDO $connection = null;

    public static function connection(): PDO
    {
        if (self::$connection instanceof PDO) {
            return self::$connection;
        }

        $config = config('database');

        try {
            if ($config['driver'] === 'sqlite') {
                self::$connection = new PDO('sqlite:' . $config['path']);
            } else {
                $dsn = sprintf(
                    'mysql:host=%s;port=%s;dbname=%s;charset=%s',
                    $config['host'],
                    $config['port'],
                    $config['database'],
                    $config['charset']
                );
                self::$connection = new PDO($dsn, $config['username'], $config['password']);
            }

            self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $hint = self::connectionHint($config);
            throw new RuntimeException(
                'Database connection failed: ' . $e->getMessage() . ($hint ? ' — ' . $hint : ''),
                0,
                $e
            );
        }

        return self::$connection;
    }

    /** @param array<string, mixed> $config */
    private static function connectionHint(array $config): string
    {
        if (($config['driver'] ?? '') === 'sqlite') {
            return 'Le site utilise SQLite. Sur LWS, placez un fichier .env.production avec DB_DRIVER=mysql à la racine du site.';
        }

        return 'Vérifiez DB_HOST, DB_NAME, DB_USER et DB_PASSWORD dans .env.production ou .env.';
    }
}
