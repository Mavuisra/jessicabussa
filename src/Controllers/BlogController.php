<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;
use App\Models\Article;
use App\Models\ArticleComment;
use App\Models\BlogVisitor;
use App\Services\VisitorService;

final class BlogController extends Controller
{
    public function index(): void
    {
        $page = max(1, (int) ($_GET['page'] ?? 1));
        $pagination = Article::published($page, 6);

        $this->view('pages/blog', [
            'title' => 'Jessica Bussa - Blog',
            'blog_posts' => $pagination['items'],
            'page_obj' => (object) [
                'number' => $pagination['page'],
                'has_previous' => $pagination['page'] > 1,
                'has_next' => $pagination['page'] < $pagination['last_page'],
                'previous_page_number' => $pagination['page'] - 1,
                'next_page_number' => $pagination['page'] + 1,
                'paginator' => (object) ['page_range' => range(1, $pagination['last_page'])],
            ],
            'is_paginated' => $pagination['last_page'] > 1,
        ]);
    }

    public function show(string $slug): void
    {
        $post = Article::findBySlug($slug);
        if (!$post || $post->status !== 'published') {
            http_response_code(404);
            $this->view('pages/errors/404', ['title' => 'Article introuvable']);
            return;
        }

        $visitorService = new VisitorService();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->validateCsrf();
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $content = trim($_POST['content'] ?? '');

            if ($name && $email && $content) {
                ArticleComment::create([
                    'article_id' => (int) $post->id,
                    'name' => $name,
                    'email' => $email,
                    'content' => $content,
                    'created_at' => date('Y-m-d H:i:s'),
                    'is_approved' => 0,
                ]);
                $visitorService->markCommented($post);
                $this->flashSuccess('Votre commentaire a été soumis avec succès. Il sera publié après modération.');
            } else {
                $this->flashError('Une erreur est survenue lors de la soumission de votre commentaire.');
            }
            $this->redirectRoute('blog_detail', $slug);
        }

        $visitor = $visitorService->track($post);
        if ($visitor->isUniqueVisitor()) {
            $post->update(['views' => (int) $post->views + 1]);
            $post = Article::find((int) $post->id) ?? $post;
        }

        $db = Database::connection();
        $uniqueVisitors = BlogVisitor::count('article_id = ?', [(int) $post->id]);
        $totalVisitsStmt = $db->prepare('SELECT COALESCE(SUM(visit_count), 0) FROM portefolio_blogvisitor WHERE article_id = ?');
        $totalVisitsStmt->execute([(int) $post->id]);
        $totalVisits = (int) $totalVisitsStmt->fetchColumn();

        $this->view('pages/blog_detail', [
            'title' => $post->title,
            'post' => $post,
            'comments' => ArticleComment::approvedForArticle((int) $post->id),
            'visitor_stats' => [
                'is_unique_visitor' => $visitor->isUniqueVisitor(),
                'visit_count' => (int) $visitor->visit_count,
                'has_liked' => (bool) $visitor->has_liked,
                'has_shared' => (bool) $visitor->has_shared,
                'has_commented' => (bool) $visitor->has_commented,
            ],
            'article_stats' => [
                'unique_visitors' => $uniqueVisitors,
                'total_visits' => $totalVisits,
                'likes_count' => (int) $post->likes,
                'shares_count' => (int) $post->shares,
                'comments_count' => ArticleComment::approvedCountForArticle((int) $post->id),
            ],
        ]);
    }

    public function like(string $slug): void
    {
        $post = Article::findBySlug($slug);
        if (!$post) {
            $this->json(['success' => false, 'message' => 'Article introuvable'], 404);
        }

        $service = new VisitorService();
        if (!$service->markLiked($post)) {
            $post = Article::find((int) $post->id) ?? $post;
            $this->json(['success' => false, 'message' => 'Vous avez déjà aimé cet article', 'likes' => (int) $post->likes]);
        }

        $post = Article::find((int) $post->id) ?? $post;
        $this->json(['success' => true, 'likes' => (int) $post->likes, 'message' => 'Merci pour votre like !']);
    }

    public function share(string $slug): void
    {
        $post = Article::findBySlug($slug);
        if (!$post) {
            $this->json(['success' => false, 'message' => 'Article introuvable'], 404);
        }

        $service = new VisitorService();
        if (!$service->markShared($post)) {
            $post = Article::find((int) $post->id) ?? $post;
            $this->json(['success' => false, 'message' => 'Vous avez déjà partagé cet article', 'shares' => (int) $post->shares]);
        }

        $post = Article::find((int) $post->id) ?? $post;
        $this->json(['success' => true, 'shares' => (int) $post->shares, 'message' => 'Merci pour le partage !']);
    }
}
