<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Article;
use App\Models\BlogVisitor;

final class VisitorService
{
    public function track(Article $article): BlogVisitor
    {
        $ip = get_client_ip();
        $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';
        $existing = BlogVisitor::findByArticleAndIp((int) $article->id, $ip);

        if ($existing) {
            $existing->update([
                'last_visit' => date('Y-m-d H:i:s'),
                'visit_count' => (int) $existing->visit_count + 1,
                'user_agent' => $userAgent,
            ]);
            return BlogVisitor::find((int) $existing->id) ?? $existing;
        }

        return BlogVisitor::create([
            'article_id' => (int) $article->id,
            'ip_address' => $ip,
            'user_agent' => $userAgent,
            'first_visit' => date('Y-m-d H:i:s'),
            'last_visit' => date('Y-m-d H:i:s'),
            'visit_count' => 1,
            'has_liked' => 0,
            'has_shared' => 0,
            'has_commented' => 0,
        ]);
    }

    public function markLiked(Article $article): bool
    {
        $visitor = $this->getOrCreate($article);
        if ($visitor->has_liked) {
            return false;
        }
        $visitor->update(['has_liked' => 1]);
        $article->update(['likes' => (int) $article->likes + 1]);
        return true;
    }

    public function markShared(Article $article): bool
    {
        $visitor = $this->getOrCreate($article);
        if ($visitor->has_shared) {
            return false;
        }
        $visitor->update(['has_shared' => 1]);
        $article->update(['shares' => (int) $article->shares + 1]);
        return true;
    }

    public function markCommented(Article $article): void
    {
        $visitor = BlogVisitor::findByArticleAndIp((int) $article->id, get_client_ip());
        if ($visitor) {
            $visitor->update(['has_commented' => 1]);
        }
    }

    private function getOrCreate(Article $article): BlogVisitor
    {
        return BlogVisitor::findByArticleAndIp((int) $article->id, get_client_ip())
            ?? $this->track($article);
    }
}
