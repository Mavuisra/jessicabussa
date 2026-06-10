<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Model;

class Event extends Model
{
    protected static string $table = 'portefolio_event';

    public function isPast(): bool
    {
        return strtotime((string) $this->date) < strtotime('today');
    }

    public function isUpcoming(): bool
    {
        return !$this->isPast();
    }

    public static function publishedUpcoming(int $limit = 3): array
    {
        return static::query(
            'SELECT * FROM portefolio_event WHERE status = \'published\' AND date >= ' . sql_today() . ' ORDER BY date ASC ' . sql_limit($limit)
        );
    }

    public static function published(string $orderBy = 'date ASC'): array
    {
        return static::query(
            "SELECT * FROM portefolio_event WHERE status = 'published' ORDER BY {$orderBy}"
        );
    }
}
