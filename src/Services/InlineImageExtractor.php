<?php

declare(strict_types=1);

namespace App\Services;

final class InlineImageExtractor
{
    /**
     * Remplace les src data:image/...;base64,... par des fichiers dans media/inline/.
     *
     * @return array{0: string, 1: int} HTML nettoyé et nombre d'images extraites
     */
    public static function extractFromHtml(string $html): array
    {
        $count = 0;
        $targetDir = media_path('inline');

        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0775, true);
        }

        $result = preg_replace_callback(
            '/src=(["\'])(data:image\/([a-zA-Z0-9+.-]+);base64,([^"\']+))\1/',
            static function (array $m) use ($targetDir, &$count): string {
                $quote = $m[1];
                $mime = strtolower($m[3]);
                $data = base64_decode($m[4], true);

                if ($data === false || $data === '') {
                    return 'src=' . $quote . $m[2] . $quote;
                }

                $ext = match ($mime) {
                    'jpeg', 'jpg' => 'jpg',
                    'png' => 'png',
                    'gif' => 'gif',
                    'webp' => 'webp',
                    'svg+xml' => 'svg',
                    default => 'bin',
                };

                $filename = 'inline_' . substr(sha1($data), 0, 16) . '.' . $ext;
                $path = $targetDir . DIRECTORY_SEPARATOR . $filename;

                if (!is_file($path)) {
                    file_put_contents($path, $data);
                }

                $count++;

                return 'src=' . $quote . '/media/inline/' . $filename . $quote;
            },
            $html
        );

        return [(string) $result, $count];
    }
}
