<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Article;
use App\Models\Event;
use App\Models\Foundation;
use App\Models\Service;
use App\Models\Testimonial;

final class HomeController extends Controller
{
    public function index(): void
    {
        $this->view('pages/home', [
            'title' => 'Jessica Bussa - Accueil',
            'services' => array_slice(Service::all('id ASC'), 0, 3),
            'foundation' => Foundation::getFirst(),
            'testimonials' => array_slice(Testimonial::all('id ASC'), 0, 3),
            'recent_articles' => Article::recentPublished(3),
            'upcoming_events' => Event::publishedUpcoming(3),
        ]);
    }
}
