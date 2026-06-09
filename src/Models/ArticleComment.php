<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Model;

class ArticleComment extends Model
{
    protected static string $table = 'portefolio_articlecomment';

    public static function approvedForArticle(int $articleId): array
    {
        return static::query(
            'SELECT * FROM portefolio_articlecomment WHERE article_id = ? AND is_approved = 1 ORDER BY created_at DESC',
            [$articleId]
        );
    }

    public static function approvedCountForArticle(int $articleId): int
    {
        return static::count('article_id = ? AND is_approved = 1', [$articleId]);
    }
}
