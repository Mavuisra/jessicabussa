<?php

declare(strict_types=1);

use App\Controllers\Admin\AuthController;
use App\Controllers\Admin\CampaignController;
use App\Controllers\Admin\ContactAdminController;
use App\Controllers\Admin\DashboardController;
use App\Controllers\Admin\EventAdminController;
use App\Controllers\Admin\GalleryAdminController;
use App\Controllers\Admin\ArticleAdminController;
use App\Controllers\Admin\NewsletterAdminController;
use App\Controllers\BlogController;
use App\Controllers\ContactController;
use App\Controllers\EventController;
use App\Controllers\GalleryController;
use App\Controllers\HomeController;
use App\Controllers\PageController;
use App\Core\Router;

$home = new HomeController();
$blog = new BlogController();
$event = new EventController();
$contact = new ContactController();
$gallery = new GalleryController();
$page = new PageController();

$auth = new AuthController();
$dashboard = new DashboardController();
$articles = new ArticleAdminController();
$events = new EventAdminController();
$galleryAdmin = new GalleryAdminController();
$contactsAdmin = new ContactAdminController();
$newsletterAdmin = new NewsletterAdminController();
$campaigns = new CampaignController();

Router::get('/', fn () => $home->index(), 'home');
Router::get('/activities', fn () => $page->activities(), 'activities');
Router::get('/about', fn () => $page->about(), 'about');
Router::get('/services', fn () => $page->services(), 'services');
Router::get('/foundation', fn () => $page->foundation(), 'foundation');
Router::get('/leadership', fn () => $page->leadership(), 'leadership');
Router::get('/media', fn () => $page->media(), 'media');
Router::get('/events', fn () => $event->index(), 'events');
Router::get('/partners', fn () => $page->partners(), 'partners');
Router::get('/academic', fn () => $page->academic(), 'academic');
Router::get('/gallery', fn () => $gallery->index(), 'gallery');
Router::match(['GET', 'POST'], '/contact', fn () => $contact->index(), 'contact');
Router::get('/contact/success', fn () => $contact->success(), 'contact_success');
Router::get('/blog', fn () => $blog->index(), 'blog');
Router::match(['GET', 'POST'], '/blog/{slug}', fn (string $slug) => $blog->show($slug), 'blog_detail');
Router::post('/blog/{slug}/like', fn (string $slug) => $blog->like($slug), 'like_blog_post');
Router::post('/blog/{slug}/share', fn (string $slug) => $blog->share($slug), 'share_blog_post');
Router::post('/newsletter/subscribe', fn () => $contact->subscribeNewsletter(), 'subscribe_newsletter');
Router::post('/newsletter/unsubscribe', fn () => $contact->unsubscribeNewsletter(), 'unsubscribe_newsletter');
Router::get('/events/{slug}', fn (string $slug) => $event->show($slug), 'event_detail');
Router::get('/entrepreneurship', fn () => $page->entrepreneurship(), 'entrepreneurship');
Router::get('/education', fn () => $page->education(), 'education');
Router::get('/career', fn () => $page->career(), 'career');
Router::get('/social', fn () => $page->social(), 'social');
Router::get('/awards', fn () => $page->awards(), 'awards');
Router::get('/politics', fn () => $page->politics(), 'politics');

Router::match(['GET', 'POST'], '/admin/login', fn () => $auth->login(), 'admin_login');
Router::get('/admin/dashboard', fn () => $dashboard->index(), 'admin_dashboard', ['auth']);
Router::get('/admin/logout', fn () => $auth->logout(), 'admin_logout');

Router::get('/admin/articles', fn () => $articles->index(), 'admin_articles', ['auth']);
Router::match(['GET', 'POST'], '/admin/articles/create', fn () => $articles->create(), 'admin_article_create', ['auth']);
Router::match(['GET', 'POST'], '/admin/articles/{id}/edit', fn (string $id) => $articles->edit((int) $id), 'admin_article_edit', ['auth']);
Router::match(['GET', 'POST'], '/admin/articles/{id}/delete', fn (string $id) => $articles->delete((int) $id), 'admin_article_delete', ['auth']);

Router::get('/admin/events', fn () => $events->index(), 'admin_events', ['auth']);
Router::match(['GET', 'POST'], '/admin/events/create', fn () => $events->create(), 'admin_event_create', ['auth']);
Router::match(['GET', 'POST'], '/admin/events/{id}/edit', fn (string $id) => $events->edit((int) $id), 'admin_event_edit', ['auth']);
Router::match(['GET', 'POST'], '/admin/events/{id}/delete', fn (string $id) => $events->delete((int) $id), 'admin_event_delete', ['auth']);

Router::get('/admin/gallery', fn () => $galleryAdmin->index(), 'admin_gallery', ['auth']);
Router::match(['GET', 'POST'], '/admin/gallery/create', fn () => $galleryAdmin->create(), 'admin_gallery_create', ['auth']);
Router::match(['GET', 'POST'], '/admin/gallery/{id}/edit', fn (string $id) => $galleryAdmin->edit((int) $id), 'admin_gallery_edit', ['auth']);
Router::match(['GET', 'POST'], '/admin/gallery/{id}/delete', fn (string $id) => $galleryAdmin->delete((int) $id), 'admin_gallery_delete', ['auth']);

Router::get('/admin/contacts', fn () => $contactsAdmin->index(), 'admin_contacts', ['auth']);
Router::get('/admin/contacts/{id}', fn (string $id) => $contactsAdmin->show((int) $id), 'admin_contact_detail', ['auth']);

Router::get('/admin/newsletter', fn () => $newsletterAdmin->index(), 'admin_newsletter', ['auth']);

Router::get('/admin/campaigns', fn () => $campaigns->index(), 'admin_campaigns', ['auth']);
Router::match(['GET', 'POST'], '/admin/campaigns/create', fn () => $campaigns->create(), 'admin_campaign_create', ['auth']);
Router::get('/admin/campaigns/{id}', fn (string $id) => $campaigns->show((int) $id), 'admin_campaign_detail', ['auth']);
Router::post('/admin/campaigns/{id}/send', fn (string $id) => $campaigns->send((int) $id), 'admin_campaign_send', ['auth']);
Router::post('/admin/campaigns/{id}/preview', fn (string $id) => $campaigns->preview((int) $id), 'admin_campaign_preview', ['auth']);
