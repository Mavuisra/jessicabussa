<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Event;

final class EventController extends Controller
{
    public function index(): void
    {
        $this->view('pages/events', [
            'title' => 'Événements',
            'events' => Event::published(),
            'conferences' => Event::where('event_type', 'conference'),
            'trainings' => Event::where('event_type', 'training'),
            'charity_events' => Event::where('event_type', 'charity'),
        ]);
    }

    public function show(string $slug): void
    {
        $event = Event::findBySlug($slug);
        if (!$event || $event->status !== 'published') {
            http_response_code(404);
            $this->view('pages/errors/404', ['title' => 'Événement introuvable']);
            return;
        }

        $event->update(['views' => (int) $event->views + 1]);
        $similar = Event::query(
            "SELECT * FROM portefolio_event WHERE status = 'published' AND event_type = ? AND id != ? ORDER BY date ASC LIMIT 3",
            [$event->event_type, (int) $event->id]
        );

        $this->view('pages/event_detail', [
            'title' => $event->title,
            'event' => $event,
            'similar_events' => $similar,
        ]);
    }
}
