<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Core\Auth;
use App\Core\Controller;
use App\Models\EmailCampaign;
use App\Services\MailService;

final class CampaignController extends Controller
{
    public function index(): void
    {
        $page = max(1, (int) ($_GET['page'] ?? 1));
        $pagination = EmailCampaign::paginate('1=1', [], $page, 10, 'created_at DESC');

        $this->adminView('admin/campaigns/list', [
            'title' => 'Campagnes email',
            'campaigns' => $pagination['items'],
            'total_campaigns' => EmailCampaign::count(),
            'draft_campaigns' => EmailCampaign::count("status = 'draft'"),
            'sent_campaigns' => EmailCampaign::count("status = 'sent'"),
            'scheduled_campaigns' => EmailCampaign::count("status = 'scheduled'"),
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
            EmailCampaign::create([
                'title' => trim($_POST['title'] ?? ''),
                'subject' => trim($_POST['subject'] ?? ''),
                'content' => $_POST['content'] ?? '',
                'status' => 'draft',
                'created_by_id' => Auth::id(),
                'created_at' => date('Y-m-d H:i:s'),
            ]);
            $this->flashSuccess("Campagne d'email créée avec succès.");
            $this->redirectRoute('admin_campaigns');
        }

        $this->adminView('admin/campaigns/create', ['title' => 'Nouvelle campagne']);
    }

    public function show(int $id): void
    {
        $campaign = EmailCampaign::find($id);
        if (!$campaign) {
            http_response_code(404);
            exit('Campagne introuvable');
        }

        $recipients = $campaign->getRecipients();
        $this->adminView('admin/campaigns/detail', [
            'title' => $campaign->title,
            'campaign' => $campaign,
            'recipients' => $recipients,
            'recipients_count' => count($recipients),
        ]);
    }

    public function send(int $id): void
    {
        $campaign = EmailCampaign::find($id);
        if (!$campaign || $campaign->status !== 'draft') {
            $this->json(['success' => false, 'message' => "Cette campagne ne peut pas être envoyée dans son état actuel."]);
        }

        $recipients = $campaign->getRecipients();
        $total = count($recipients);
        if ($total === 0) {
            $this->json(['success' => false, 'message' => 'Aucun destinataire actif trouvé.']);
        }

        $campaign->update(['status' => 'sending', 'total_recipients' => $total]);
        $mail = new MailService();
        $sent = 0;
        $failed = 0;

        foreach ($recipients as $subscriber) {
            if ($mail->send($subscriber->email, $campaign->subject, $campaign->content)) {
                $sent++;
                $subscriber->update(['last_email_sent' => date('Y-m-d H:i:s')]);
            } else {
                $failed++;
            }
        }

        $campaign->update(['sent_count' => $sent, 'failed_count' => $failed]);
        $campaign->markAsSent();

        $this->json([
            'success' => true,
            'message' => "Campagne envoyée ! {$sent} emails envoyés, {$failed} échecs.",
            'sent_count' => $sent,
            'failed_count' => $failed,
        ]);
    }

    public function preview(int $id): void
    {
        $campaign = EmailCampaign::find($id);
        if (!$campaign) {
            $this->json(['success' => false, 'message' => 'Campagne introuvable'], 404);
        }

        $this->json([
            'success' => true,
            'subject' => $campaign->subject,
            'content' => $campaign->content,
            'recipients_count' => count($campaign->getRecipients()),
        ]);
    }
}
