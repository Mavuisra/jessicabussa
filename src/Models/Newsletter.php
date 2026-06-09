<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Model;

class Newsletter extends Model
{
    protected static string $table = 'portefolio_newsletter';

    public function unsubscribe(): void
    {
        $this->update([
            'status' => 'unsubscribed',
            'unsubscribed_at' => date('Y-m-d H:i:s'),
        ]);
    }

    public static function findByEmail(string $email): ?static
    {
        return static::first('SELECT * FROM portefolio_newsletter WHERE email = ? LIMIT 1', [$email]);
    }

    public static function active(): array
    {
        return static::where('status', 'active');
    }
}
