<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Models\Contact;
use App\Models\Newsletter;
use App\Services\MailService;

final class ContactController extends Controller
{
    public function index(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->validateCsrf();
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $subject = trim($_POST['subject'] ?? '');
            $message = trim($_POST['message'] ?? '');

            if ($name && $email && $subject && $message) {
                Contact::create([
                    'name' => $name,
                    'email' => $email,
                    'subject' => $subject,
                    'message' => $message,
                    'status' => 'new',
                    'ip_address' => get_client_ip(),
                    'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? '',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);

                (new MailService())->send(
                    'contact@jessicabussa.cd',
                    'Contact Form: ' . $subject,
                    "From: {$name} <{$email}>\n\n{$message}",
                    $email
                );

                $this->redirectRoute('contact_success');
            }

            Session::setOld(compact('name', 'email', 'subject', 'message'));
            $this->flashError('Veuillez remplir tous les champs.');
        }

        $this->view('pages/contact', ['title' => 'Contact']);
    }

    public function success(): void
    {
        $this->view('pages/contact_success', ['title' => 'Message envoyé']);
    }

    public function subscribeNewsletter(): void
    {
        $email = trim($_POST['email'] ?? '');
        if (!$email) {
            $this->json(['success' => false, 'message' => 'Email requis']);
        }

        $subscriber = Newsletter::findByEmail($email);
        if ($subscriber) {
            if ($subscriber->status === 'active') {
                $this->json(['success' => false, 'message' => 'Vous êtes déjà abonné à notre newsletter']);
            }
            $subscriber->update(['status' => 'active', 'unsubscribed_at' => null]);
            $this->json(['success' => true, 'message' => 'Bienvenue de nouveau dans notre newsletter !']);
        }

        Newsletter::create([
            'email' => $email,
            'status' => 'active',
            'ip_address' => get_client_ip(),
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? '',
            'subscribed_at' => date('Y-m-d H:i:s'),
        ]);
        $this->json(['success' => true, 'message' => 'Merci pour votre abonnement à notre newsletter !']);
    }

    public function unsubscribeNewsletter(): void
    {
        $email = trim($_POST['email'] ?? '');
        if (!$email) {
            $this->json(['success' => false, 'message' => 'Email requis']);
        }

        $subscriber = Newsletter::findByEmail($email);
        if (!$subscriber) {
            $this->json(['success' => false, 'message' => "Email non trouvé dans notre liste d'abonnés"]);
        }

        $subscriber->unsubscribe();
        $this->json(['success' => true, 'message' => 'Vous avez été désabonné de notre newsletter']);
    }
}
