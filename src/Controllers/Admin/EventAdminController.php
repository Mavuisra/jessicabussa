<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Models\Event;
use App\Services\UploadService;

final class EventAdminController extends Controller
{
    public function index(): void
    {
        $page = max(1, (int) ($_GET['page'] ?? 1));
        $pagination = Event::paginate('1=1', [], $page, 10, 'created_at DESC');

        $this->adminView('admin/events/list', [
            'title' => 'Événements',
            'events' => $pagination['items'],
            'total_events' => Event::count(),
            'published_events' => Event::count("status = 'published'"),
            'draft_events' => Event::count("status = 'draft'"),
            'upcoming_events' => Event::count("status = 'published' AND date >= date('now')"),
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
                $data['featured_image'] = (new UploadService())->store($_FILES['featured_image'], 'events');
            }
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['updated_at'] = date('Y-m-d H:i:s');
            if ($data['status'] === 'published') {
                $data['published_at'] = date('Y-m-d H:i:s');
            }
            Event::create($data);
            $this->flashSuccess('Événement créé avec succès.');
            $this->redirectRoute('admin_events');
        }

        $this->adminView('admin/events/create', ['title' => 'Créer un événement', 'event' => null]);
    }

    public function edit(int $id): void
    {
        $event = Event::find($id);
        if (!$event) {
            http_response_code(404);
            exit('Événement introuvable');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->validateCsrf();
            $data = $this->collectData();
            if (!empty($_FILES['featured_image']['name'])) {
                $data['featured_image'] = (new UploadService())->store($_FILES['featured_image'], 'events');
            }
            $data['updated_at'] = date('Y-m-d H:i:s');
            if ($data['status'] === 'published' && !$event->published_at) {
                $data['published_at'] = date('Y-m-d H:i:s');
            }
            $event->update($data);
            $this->flashSuccess('Événement mis à jour avec succès.');
            $this->redirectRoute('admin_events');
        }

        $this->adminView('admin/events/edit', ['title' => 'Modifier l\'événement', 'event' => $event]);
    }

    public function delete(int $id): void
    {
        $event = Event::find($id);
        if (!$event) {
            http_response_code(404);
            exit('Événement introuvable');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->validateCsrf();
            $event->delete();
            $this->flashSuccess('Événement supprimé avec succès.');
            $this->redirectRoute('admin_events');
        }

        $this->adminView('admin/events/delete', ['title' => 'Supprimer l\'événement', 'event' => $event]);
    }

    private function collectData(): array
    {
        $slug = trim($_POST['slug'] ?? '');
        if ($slug === '') {
            $slug = slugify($_POST['title'] ?? '');
        }

        return [
            'title' => trim($_POST['title'] ?? ''),
            'slug' => $slug,
            'event_type' => $_POST['event_type'] ?? 'conference',
            'description' => $_POST['description'] ?? '',
            'content' => $_POST['content'] ?? '',
            'excerpt' => $_POST['excerpt'] ?? '',
            'date' => $_POST['date'] ?? date('Y-m-d'),
            'time' => $_POST['time'] ?: null,
            'end_date' => $_POST['end_date'] ?: null,
            'end_time' => $_POST['end_time'] ?: null,
            'location' => $_POST['location'] ?? '',
            'address' => $_POST['address'] ?? '',
            'city' => $_POST['city'] ?? '',
            'country' => $_POST['country'] ?? 'RDC',
            'capacity' => $_POST['capacity'] !== '' ? (int) $_POST['capacity'] : null,
            'registration_url' => $_POST['registration_url'] ?: null,
            'contact_email' => $_POST['contact_email'] ?: null,
            'contact_phone' => $_POST['contact_phone'] ?: null,
            'status' => $_POST['status'] ?? 'draft',
            'is_featured' => isset($_POST['is_featured']) ? 1 : 0,
        ];
    }
}
