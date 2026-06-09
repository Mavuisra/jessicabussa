<?php

declare(strict_types=1);

$uri = urldecode(parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/');

require dirname(__DIR__) . '/bootstrap/app.php';
bootstrap_app(__FILE__);

if (str_starts_with($uri, '/static/')) {
    $rel = substr($uri, 8);
    $candidates = [
        public_path('static/' . $rel),
        base_path('static/' . $rel),
    ];
    foreach ($candidates as $file) {
        if (is_file($file)) {
            $ext = pathinfo($file, PATHINFO_EXTENSION);
            $types = [
                'css' => 'text/css',
                'js' => 'application/javascript',
                'png' => 'image/png',
                'jpg' => 'image/jpeg',
                'jpeg' => 'image/jpeg',
                'gif' => 'image/gif',
                'webp' => 'image/webp',
                'svg' => 'image/svg+xml',
                'ico' => 'image/x-icon',
            ];
            header('Content-Type: ' . ($types[$ext] ?? 'application/octet-stream'));
            readfile($file);
            exit;
        }
    }
}

if (str_starts_with($uri, '/media/')) {
    $file = media_path(substr($uri, 7));
    if (is_file($file)) {
        $ext = pathinfo($file, PATHINFO_EXTENSION);
        $types = [
            'css' => 'text/css',
            'js' => 'application/javascript',
            'png' => 'image/png',
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'gif' => 'image/gif',
            'webp' => 'image/webp',
            'svg' => 'image/svg+xml',
        ];
        header('Content-Type: ' . ($types[$ext] ?? 'application/octet-stream'));
        readfile($file);
        exit;
    }
}

require __DIR__ . '/index.php';
