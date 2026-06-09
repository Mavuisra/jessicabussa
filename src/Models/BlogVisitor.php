<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Model;

class BlogVisitor extends Model
{
    protected static string $table = 'portefolio_blogvisitor';

    public function isUniqueVisitor(): bool
    {
        return (int) ($this->visit_count ?? 0) === 1;
    }

    public static function findByArticleAndIp(int $articleId, string $ip): ?static
    {
        return static::first(
            'SELECT * FROM portefolio_blogvisitor WHERE article_id = ? AND ip_address = ? LIMIT 1',
            [$articleId, $ip]
        );
    }
}
