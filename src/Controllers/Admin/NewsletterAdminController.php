<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Models\Newsletter;

final class NewsletterAdminController extends Controller
{
    public function index(): void
    {
        $page = max(1, (int) ($_GET['page'] ?? 1));
        $pagination = Newsletter::paginate('1=1', [], $page, 50, 'subscribed_at DESC');

        $this->adminView('admin/newsletter/list', [
            'title' => 'Newsletter',
            'subscribers' => $pagination['items'],
            'total_subscribers' => Newsletter::count(),
            'active_subscribers' => Newsletter::count("status = 'active'"),
            'unsubscribed_count' => Newsletter::count("status = 'unsubscribed'"),
            'bounced_count' => Newsletter::count("status = 'bounced'"),
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
}
