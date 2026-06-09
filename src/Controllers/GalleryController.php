<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Gallery;

final class GalleryController extends Controller
{
    public function index(): void
    {
        $this->view('pages/gallery', [
            'title' => 'Galerie',
            'gallery_items' => Gallery::all('id DESC'),
            'foundation_items' => Gallery::where('category', 'foundation'),
            'consulting_items' => Gallery::where('category', 'consulting'),
            'events_items' => Gallery::where('category', 'events'),
            'personal_items' => Gallery::where('category', 'personal'),
            'photos' => Gallery::query('SELECT * FROM portefolio_gallery WHERE is_video = 0 ORDER BY id DESC'),
            'videos' => Gallery::query('SELECT * FROM portefolio_gallery WHERE is_video = 1 ORDER BY id DESC'),
        ]);
    }
}
