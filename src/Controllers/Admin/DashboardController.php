<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\Database;
use App\Models\Article;
use App\Models\ArticleComment;
use App\Models\BlogVisitor;
use App\Models\Contact;
use App\Models\EmailCampaign;
use App\Models\Event;
use App\Models\Newsletter;

final class DashboardController extends Controller
{
    public function index(): void
    {
        $db = Database::connection();
        $weekAgo = date('Y-m-d H:i:s', strtotime('-7 days'));

        $totalViews = (int) $db->query('SELECT COALESCE(SUM(views), 0) FROM portefolio_article')->fetchColumn();
        $totalVisits = (int) $db->query('SELECT COALESCE(SUM(visit_count), 0) FROM portefolio_blogvisitor')->fetchColumn();
        $totalLikes = (int) $db->query('SELECT COALESCE(SUM(likes), 0) FROM portefolio_article')->fetchColumn();
        $totalShares = (int) $db->query('SELECT COALESCE(SUM(shares), 0) FROM portefolio_article')->fetchColumn();

        $this->adminView('admin/dashboard', [
            'title' => 'Tableau de bord',
            'total_articles' => Article::count(),
            'published_articles' => Article::count("status = 'published'"),
            'draft_articles' => Article::count("status = 'draft'"),
            'recent_articles' => array_slice(Article::all('created_at DESC'), 0, 5),
            'total_events' => Event::count(),
            'published_events' => Event::count("status = 'published'"),
            'draft_events' => Event::count("status = 'draft'"),
            'upcoming_events' => Event::count("status = 'published' AND date >= date('now')"),
            'recent_events' => array_slice(Event::all('created_at DESC'), 0, 5),
            'total_views' => $totalViews,
            'total_unique_visitors' => BlogVisitor::count(),
            'total_visits' => $totalVisits,
            'total_likes' => $totalLikes,
            'total_shares' => $totalShares,
            'total_comments' => ArticleComment::count('is_approved = 1'),
            'recent_visitors' => BlogVisitor::query('SELECT * FROM portefolio_blogvisitor ORDER BY last_visit DESC LIMIT 10'),
            'top_articles' => array_slice(Article::query("SELECT * FROM portefolio_article WHERE status = 'published' ORDER BY views DESC LIMIT 3"), 0, 3),
            'top_liked_articles' => array_slice(Article::query("SELECT * FROM portefolio_article WHERE status = 'published' ORDER BY likes DESC LIMIT 3"), 0, 3),
            'top_events' => array_slice(Event::query("SELECT * FROM portefolio_event WHERE status = 'published' ORDER BY views DESC LIMIT 3"), 0, 3),
            'visitors_this_week' => BlogVisitor::count('first_visit >= ?', [$weekAgo]),
            'visits_this_week' => BlogVisitor::count('last_visit >= ?', [$weekAgo]),
            'total_contacts' => Contact::count(),
            'new_contacts' => Contact::count("status = 'new'"),
            'read_contacts' => Contact::count("status = 'read'"),
            'replied_contacts' => Contact::count("status = 'replied'"),
            'recent_contacts' => array_slice(Contact::all('created_at DESC'), 0, 5),
            'total_subscribers' => Newsletter::count(),
            'active_subscribers' => Newsletter::count("status = 'active'"),
            'unsubscribed_count' => Newsletter::count("status = 'unsubscribed'"),
            'new_subscribers_this_week' => Newsletter::count('subscribed_at >= ?', [$weekAgo]),
            'recent_subscribers' => array_slice(Newsletter::query("SELECT * FROM portefolio_newsletter WHERE status = 'active' ORDER BY subscribed_at DESC LIMIT 5"), 0, 5),
            'total_campaigns' => EmailCampaign::count(),
            'draft_campaigns' => EmailCampaign::count("status = 'draft'"),
            'sent_campaigns' => EmailCampaign::count("status = 'sent'"),
            'recent_campaigns' => array_slice(EmailCampaign::all('created_at DESC'), 0, 3),
        ]);
    }
}
