<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Models\Contact;

final class ContactAdminController extends Controller
{
    public function index(): void
    {
        $page = max(1, (int) ($_GET['page'] ?? 1));
        $pagination = Contact::paginate('1=1', [], $page, 20, 'created_at DESC');

        $this->adminView('admin/contacts/list', [
            'title' => 'Messages de contact',
            'contacts' => $pagination['items'],
            'total_contacts' => Contact::count(),
            'new_contacts' => Contact::count("status = 'new'"),
            'read_contacts' => Contact::count("status = 'read'"),
            'replied_contacts' => Contact::count("status = 'replied'"),
            'archived_contacts' => Contact::count("status = 'archived'"),
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

    public function show(int $id): void
    {
        $contact = Contact::find($id);
        if (!$contact) {
            http_response_code(404);
            exit('Message introuvable');
        }

        if ($contact->status === 'new') {
            $contact->update(['status' => 'read', 'updated_at' => date('Y-m-d H:i:s')]);
            $contact = Contact::find($id) ?? $contact;
        }

        $this->adminView('admin/contacts/detail', [
            'title' => 'Détail du message',
            'contact' => $contact,
        ]);
    }
}
