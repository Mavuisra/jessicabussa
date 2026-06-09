<?php

declare(strict_types=1);

namespace App\Services;

use RuntimeException;

final class MailService
{
    public function send(string $to, string $subject, string $body, ?string $from = null): bool
    {
        $config = config('app')['mail'];
        $from = $from ?? $config['from'];

        if (empty($config['password'])) {
            error_log("Mail skipped (no password): {$subject} -> {$to}");
            return false;
        }

        $headers = [
            'From: ' . $from,
            'Reply-To: ' . $from,
            'MIME-Version: 1.0',
            'Content-Type: text/plain; charset=UTF-8',
        ];

        $transport = sprintf('%s://%s:%d', $config['encryption'], $config['host'], $config['port']);
        ini_set('SMTP', $config['host']);
        ini_set('smtp_port', (string) $config['port']);

        return @mail($to, $subject, $body, implode("\r\n", $headers));
    }
}
