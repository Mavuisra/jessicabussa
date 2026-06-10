<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Model;

class Article extends Model
{
    protected static string $table = 'portefolio_article';

    public function getCategoryDisplay(): string
    {
        return category_label((string) $this->category);
    }

    public static function published(int $page = 1, int $perPage = 6): array
    {
        return static::paginate("status = 'published'", [], $page, $perPage, 'created_at DESC');
    }

    public static function recentPublished(int $limit = 3): array
    {
        return static::query(
            "SELECT * FROM portefolio_article WHERE status = 'published' ORDER BY created_at DESC " . sql_limit($limit)
        );
    }
}
