<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Award;
use App\Models\Event;
use App\Models\Foundation;
use App\Models\Gallery;
use App\Models\Partner;
use App\Models\Service;

final class PageController extends Controller
{
    public function activities(): void
    {
        $this->view('pages/activities', [
            'title' => 'Activités',
            'events' => Event::published(),
            'services' => Service::all('id ASC'),
        ]);
    }

    public function about(): void
    {
        $this->view('pages/about', ['title' => 'À propos']);
    }

    public function services(): void
    {
        $this->view('pages/services', [
            'title' => 'Services',
            'services' => Service::all('id ASC'),
            'consulting_services' => Service::where('category', 'consulting'),
            'events_services' => Service::where('category', 'events'),
            'cleaning_services' => Service::where('category', 'cleaning'),
        ]);
    }

    public function foundation(): void
    {
        $this->view('pages/foundation', [
            'title' => 'Fondation',
            'foundation' => \App\Models\Foundation::getFirst(),
            'foundation_gallery' => Gallery::where('category', 'foundation'),
        ]);
    }

    public function leadership(): void
    {
        $this->view('pages/leadership', ['title' => 'Leadership']);
    }

    public function media(): void
    {
        $this->view('pages/media', [
            'title' => 'Médias',
            'awards' => Award::all('date DESC'),
        ]);
    }

    public function partners(): void
    {
        $this->view('pages/partners', [
            'title' => 'Partenaires',
            'partners' => Partner::all('id ASC'),
        ]);
    }

    public function academic(): void
    {
        $this->view('pages/academic', ['title' => 'Académique']);
    }

    public function entrepreneurship(): void
    {
        $this->view('pages/entrepreneurship', [
            'title' => 'Entrepreneuriat',
            'services' => Service::all('id ASC'),
            'events' => Event::where('event_type', 'business'),
        ]);
    }

    public function education(): void
    {
        $this->view('pages/education', [
            'title' => 'Éducation',
            'education_gallery' => Gallery::where('category', 'education'),
        ]);
    }

    public function career(): void
    {
        $this->view('pages/career', [
            'title' => 'Carrière',
            'career_gallery' => Gallery::where('category', 'career'),
        ]);
    }

    public function social(): void
    {
        $this->view('pages/social', [
            'title' => 'Social',
            'foundation' => \App\Models\Foundation::getFirst(),
            'social_gallery' => Gallery::where('category', 'social'),
            'social_events' => Event::where('event_type', 'charity'),
        ]);
    }

    public function awards(): void
    {
        $this->view('pages/awards', [
            'title' => 'Distinctions',
            'awards' => Award::all('date DESC'),
            'awards_gallery' => Gallery::where('category', 'awards'),
        ]);
    }

    public function politics(): void
    {
        $this->view('pages/politics', [
            'title' => 'Politique',
            'politics_gallery' => Gallery::where('category', 'politics'),
        ]);
    }
}
