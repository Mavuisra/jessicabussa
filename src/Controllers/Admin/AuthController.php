<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Core\Auth;
use App\Core\Controller;
use App\Core\Session;

final class AuthController extends Controller
{
    public function login(): void
    {
        if (Auth::check()) {
            $this->redirectRoute('admin_dashboard');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->validateCsrf();
            $username = trim($_POST['username'] ?? '');
            $password = $_POST['password'] ?? '';

            if (Auth::attempt($username, $password)) {
                $this->flashSuccess('Bienvenue, ' . $username . ' !');
                $this->redirectRoute('admin_dashboard');
            }

            $this->flashError("Nom d'utilisateur ou mot de passe incorrect.");
        }

        $this->view('admin/login', ['title' => 'Connexion Admin'], null);
    }

    public function logout(): void
    {
        Auth::logout();
        $this->flashSuccess('Vous avez été déconnecté avec succès.');
        $this->redirectRoute('admin_login');
    }
}
