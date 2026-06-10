<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Models\Article;
use App\Services\InlineImageExtractor;
use App\Services\UploadService;

final class ArticleAdminController extends Controller
{
    public function index(): void
    {
        $page = max(1, (int) ($_GET['page'] ?? 1));
        $pagination = Article::paginate('1=1', [], $page, 10, 'created_at DESC');

        $this->adminView('admin/articles/list', [
            'title' => 'Articles',
            'articles' => $pagination['items'],
            'total_articles' => Article::count(),
            'published_articles' => Article::count("status = 'published'"),
            'draft_articles' => Article::count("status = 'draft'"),
            'page_obj' => (object) [
                'number' => $pagination['page'],
                'has_previous' => $pagination['page'] > 1,
                'has_next' => $pagination['page'] < $pagination['last_page'],
                'previous_page_number' => $pagination['page'] - 1,
                'next_page_number' => $pagination['page'] + 1,
            ],
            'is_paginated' => $pagination['last_page'] > 1,
        ]);
    }

    public function create(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->validateCsrf();
            $data = $this->collectData();
            if (!empty($_FILES['featured_image']['name'])) {
                $data['featured_image'] = (new UploadService())->store($_FILES['featured_image'], 'articles');
            }
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');
            if ($data['status'] === 'published') {
                $data['published_at'] = date('Y-m-d H:i:s');
            }
            Article::create($data);
            $this->flashSuccess('Article créé avec succès.');
            $this->redirectRoute('admin_articles');
        }

        $this->adminView('admin/articles/create', ['title' => 'Créer un article', 'article' => null]);
    }

    public function edit(int $id): void
    {
        $article = Article::find($id);
        if (!$article) {
            http_response_code(404);
            exit('Article introuvable');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->validateCsrf();
            $data = $this->collectData();
            if (!empty($_FILES['featured_image']['name'])) {
                $data['featured_image'] = (new UploadService())->store($_FILES['featured_image'], 'articles');
            }
            $data['updated_at'] = date('Y-m-d H:i:s');
            if ($data['status'] === 'published' && !$article->published_at) {
                $data['published_at'] = date('Y-m-d H:i:s');
            }
            $article->update($data);
            $this->flashSuccess('Article mis à jour avec succès.');
            $this->redirectRoute('admin_articles');
        }

        $this->adminView('admin/articles/edit', ['title' => 'Modifier l\'article', 'article' => $article]);
    }

    public function delete(int $id): void
    {
        $article = Article::find($id);
        if (!$article) {
            http_response_code(404);
            exit('Article introuvable');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->validateCsrf();
            $article->delete();
            $this->flashSuccess('Article supprimé avec succès.');
            $this->redirectRoute('admin_articles');
        }

        $this->adminView('admin/articles/delete', ['title' => 'Supprimer l\'article', 'article' => $article]);
    }

    private function collectData(): array
    {
        $slug = trim($_POST['slug'] ?? '');
        if ($slug === '') {
            $slug = slugify($_POST['title'] ?? '');
        }

        [$content] = InlineImageExtractor::extractFromHtml($_POST['content'] ?? '');
        [$excerpt] = InlineImageExtractor::extractFromHtml($_POST['excerpt'] ?? '');

        return [
            'title' => trim($_POST['title'] ?? ''),
            'slug' => $slug,
            'category' => $_POST['category'] ?? 'actualites',
            'content' => $content,
            'excerpt' => $excerpt,
            'status' => $_POST['status'] ?? 'draft',
        ];
    }
}
