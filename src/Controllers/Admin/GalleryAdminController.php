<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Models\Gallery;
use App\Services\UploadService;

final class GalleryAdminController extends Controller
{
    public function index(): void
    {
        $page = max(1, (int) ($_GET['page'] ?? 1));
        $pagination = Gallery::paginate('1=1', [], $page, 12, 'id DESC');

        $this->adminView('admin/gallery/list', [
            'title' => 'Galerie',
            'gallery_items' => $pagination['items'],
            'total_items' => Gallery::count(),
            'foundation_items' => Gallery::count("category = 'foundation'"),
            'consulting_items' => Gallery::count("category = 'consulting'"),
            'events_items' => Gallery::count("category = 'events'"),
            'personal_items' => Gallery::count("category = 'personal'"),
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
            if (!empty($_FILES['image']['name'])) {
                $data['image'] = (new UploadService())->store($_FILES['image'], 'gallery');
            }
            Gallery::create($data);
            $this->flashSuccess('Image ajoutée à la galerie avec succès.');
            $this->redirectRoute('admin_gallery');
        }

        $this->adminView('admin/gallery/create', ['title' => 'Ajouter une image', 'item' => null]);
    }

    public function edit(int $id): void
    {
        $item = Gallery::find($id);
        if (!$item) {
            http_response_code(404);
            exit('Élément introuvable');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->validateCsrf();
            $data = $this->collectData();
            if (!empty($_FILES['image']['name'])) {
                $data['image'] = (new UploadService())->store($_FILES['image'], 'gallery');
            }
            $item->update($data);
            $this->flashSuccess('Image mise à jour avec succès.');
            $this->redirectRoute('admin_gallery');
        }

        $this->adminView('admin/gallery/edit', ['title' => 'Modifier l\'image', 'item' => $item]);
    }

    public function delete(int $id): void
    {
        $item = Gallery::find($id);
        if (!$item) {
            http_response_code(404);
            exit('Élément introuvable');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->validateCsrf();
            $item->delete();
            $this->flashSuccess('Image supprimée de la galerie avec succès.');
            $this->redirectRoute('admin_gallery');
        }

        $this->adminView('admin/gallery/delete', ['title' => 'Supprimer l\'image', 'item' => $item]);
    }

    private function collectData(): array
    {
        return [
            'title' => trim($_POST['title'] ?? ''),
            'category' => $_POST['category'] ?? 'personal',
            'description' => $_POST['description'] ?? '',
            'is_video' => isset($_POST['is_video']) ? 1 : 0,
            'video_url' => $_POST['video_url'] ?: null,
        ];
    }
}
