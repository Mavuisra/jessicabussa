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
                self::$connection = self::connectMysql($config);
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

        if (($config['host'] ?? '') === 'localhost') {
            return 'Sur LWS, remplacez DB_HOST=localhost par DB_HOST=127.0.0.1 dans .env.production.';
        }

        return 'Vérifiez DB_HOST, DB_NAME, DB_USER et DB_PASSWORD dans .env.production ou .env.';
    }

    /** @param array<string, mixed> $config */
    private static function connectMysql(array $config): PDO
    {
        $hosts = self::mysqlHosts((string) $config['host']);
        $lastHost = $hosts[array_key_last($hosts)];
        $lastException = null;

        foreach ($hosts as $host) {
            try {
                $dsn = sprintf(
                    'mysql:host=%s;port=%s;dbname=%s;charset=%s',
                    $host,
                    $config['port'],
                    $config['database'],
                    $config['charset']
                );

                $pdo = new PDO($dsn, $config['username'], $config['password'], [
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]);

                return $pdo;
            } catch (PDOException $e) {
                $lastException = $e;

                if (!self::isSocketConnectionError($e) || $host === $lastHost) {
                    throw $e;
                }
            }
        }

        throw $lastException ?? new PDOException('MySQL connection failed.');
    }

    /** @return list<string> */
    private static function mysqlHosts(string $host): array
    {
        if (strtolower($host) !== 'localhost') {
            return [$host];
        }

        return ['localhost', '127.0.0.1'];
    }

    private static function isSocketConnectionError(PDOException $e): bool
    {
        $message = $e->getMessage();

        return str_contains($message, '2002')
            || str_contains($message, 'No such file or directory');
    }
}
