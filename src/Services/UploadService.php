<?php

declare(strict_types=1);

namespace App\Services;

use RuntimeException;

final class UploadService
{
    public function store(array $file, string $directory): ?string
    {
        if (($file['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) {
            return null;
        }

        if (($file['error'] ?? UPLOAD_ERR_OK) !== UPLOAD_ERR_OK) {
            throw new RuntimeException('Upload failed with code ' . ($file['error'] ?? 0));
        }

        $targetDir = media_path($directory);
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0775, true);
        }

        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = uniqid('upload_', true) . ($extension ? '.' . $extension : '');
        $destination = $targetDir . DIRECTORY_SEPARATOR . $filename;

        if (!move_uploaded_file($file['tmp_name'], $destination)) {
            throw new RuntimeException('Unable to move uploaded file.');
        }

        return trim($directory, '/') . '/' . $filename;
    }
}
