<?php

declare(strict_types=1);

namespace App\Core;

final class StaticFiles
{
    /** @var array<string, string> */
    private const MIME = [
        'css' => 'text/css; charset=utf-8',
        'js' => 'application/javascript; charset=utf-8',
        'png' => 'image/png',
        'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'gif' => 'image/gif',
        'webp' => 'image/webp',
        'svg' => 'image/svg+xml',
        'ico' => 'image/x-icon',
        'woff' => 'font/woff',
        'woff2' => 'font/woff2',
    ];

    public static function serve(string $uri): bool
    {
        $path = parse_url($uri, PHP_URL_PATH) ?: '/';

        if (str_starts_with($path, '/static/')) {
            return self::sendFile(self::staticCandidates(substr($path, 8)));
        }

        if (str_starts_with($path, '/media/')) {
            return self::sendFile(self::mediaCandidates(substr($path, 7)));
        }

        return false;
    }

    /** @return list<string> */
    private static function staticCandidates(string $relative): array
    {
        $relative = ltrim(str_replace(['\\', '..'], ['/', ''], $relative), '/');

        return array_values(array_unique([
            base_path('static/' . $relative),
            public_path('static/' . $relative),
        ]));
    }

    /** @return list<string> */
    private static function mediaCandidates(string $relative): array
    {
        $relative = ltrim(str_replace(['\\', '..'], ['/', ''], $relative), '/');

        $candidates = [media_path($relative)];

        if (str_starts_with($relative, 'images/')) {
            $candidates[] = base_path('static/' . $relative);
            $candidates[] = public_path('static/' . $relative);
        }

        return array_values(array_unique($candidates));
    }

    /** @param list<string> $candidates */
    private static function sendFile(array $candidates): bool
    {
        foreach ($candidates as $file) {
            if (!is_file($file)) {
                continue;
            }

            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            header('Content-Type: ' . (self::MIME[$ext] ?? 'application/octet-stream'));
            header('Cache-Control: public, max-age=604800');
            header('Content-Length: ' . (string) filesize($file));
            readfile($file);

            return true;
        }

        http_response_code(404);
        header('Content-Type: text/plain; charset=utf-8');
        echo 'Fichier introuvable.';

        return true;
    }
}
