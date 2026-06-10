<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4F46E5;
            --secondary-color: #7C3AED;
        }
        .bg-primary { background-color: var(--primary-color); }
        .text-primary { color: var(--primary-color); }
        .from-primary { --tw-gradient-from: var(--primary-color); }
        .to-secondary { --tw-gradient-to: var(--secondary-color); }
        .animate-fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .sidebar {
            width: 250px;
            transition: all 0.3s ease;
        }
        .main-content {
            margin-left: 250px;
            transition: all 0.3s ease;
        }
        @media (max-width: 768px) {
            .sidebar {
                width: 0;
                overflow: hidden;
            }
            .main-content {
                margin-left: 0;
            }
            .sidebar.active {
                width: 250px;
            }
            .main-content.active {
                margin-left: 250px;
            }
        }
    </style>
    <?= $extra_css ?? '' ?>
</head>
<body class="bg-gray-50">
    <!-- Sidebar -->
    <aside class="sidebar fixed top-0 left-0 h-full bg-white shadow-lg z-10">
        <div class="p-4 border-b">
            <div class="flex items-center justify-between">
                <h1 class="text-xl font-bold text-primary">Administration</h1>
                <button id="toggle-sidebar" class="md:hidden text-gray-500 hover:text-gray-700">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
        <nav class="p-4">
            <ul class="space-y-2">
                <li>
                    <a href="<?= url('admin_dashboard') ?>" class="flex items-center p-2 text-gray-700 hover:bg-primary/10 rounded-lg <?php if (str_contains($_SERVER['REQUEST_URI'] ?? '', 'admin_dashboard')): ?>bg-primary/10<?php endif; ?>">
                        <i class="fas fa-tachometer-alt w-6"></i>
                        <span>Tableau de bord</span>
                    </a>
                </li>
                <li>
                    <a href="<?= url('admin_articles') ?>" class="flex items-center p-2 text-gray-700 hover:bg-primary/10 rounded-lg <?php if (str_contains($_SERVER['REQUEST_URI'] ?? '', 'admin_articles')): ?>bg-primary/10<?php endif; ?>">
                        <i class="fas fa-newspaper w-6"></i>
                        <span>Articles</span>
                    </a>
                </li>
                <li>
                    <a href="<?= url('admin_events') ?>" class="flex items-center p-2 text-gray-700 hover:bg-primary/10 rounded-lg <?php if (str_contains($_SERVER['REQUEST_URI'] ?? '', 'admin_events')): ?>bg-primary/10<?php endif; ?>">
                        <i class="fas fa-calendar-alt w-6"></i>
                        <span>Événements</span>
                    </a>
                </li>
                <li>
                    <a href="<?= url('admin_gallery') ?>" class="flex items-center p-2 text-gray-700 hover:bg-primary/10 rounded-lg <?php if (str_contains($_SERVER['REQUEST_URI'] ?? '', 'admin_gallery')): ?>bg-primary/10<?php endif; ?>">
                        <i class="fas fa-images w-6"></i>
                        <span>Galerie</span>
                    </a>
                </li>
                <li>
                    <a href="<?= url('admin_contacts') ?>" class="flex items-center p-2 text-gray-700 hover:bg-primary/10 rounded-lg <?php if (str_contains($_SERVER['REQUEST_URI'] ?? '', 'admin/contacts')): ?>bg-primary/10<?php endif; ?>">
                        <i class="fas fa-envelope w-6"></i>
                        <span>Contacts</span>
                    </a>
                </li>
                <li>
                    <a href="<?= url('admin_newsletter') ?>" class="flex items-center p-2 text-gray-700 hover:bg-primary/10 rounded-lg <?php if (str_contains($_SERVER['REQUEST_URI'] ?? '', 'admin/newsletter')): ?>bg-primary/10<?php endif; ?>">
                        <i class="fas fa-paper-plane w-6"></i>
                        <span>Newsletter</span>
                    </a>
                </li>
                <li>
                    <a href="<?= url('admin_campaigns') ?>" class="flex items-center p-2 text-gray-700 hover:bg-primary/10 rounded-lg <?php if (str_contains($_SERVER['REQUEST_URI'] ?? '', 'admin/campaigns')): ?>bg-primary/10<?php endif; ?>">
                        <i class="fas fa-bullhorn w-6"></i>
                        <span>Campagnes</span>
                    </a>
                </li>
            </ul>
        </nav>
        <div class="absolute bottom-0 left-0 right-0 p-4 border-t">
            <div class="flex items-center">
                <div class="w-8 h-8 rounded-full bg-primary/20 flex items-center justify-center text-primary">
                    <i class="fas fa-user"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-gray-700"><?= e(\App\Core\Auth::user()?->username ?? 'Admin') ?></p>
                    <a href="<?= url('admin_logout') ?>" class="text-red-600 hover:text-red-800">
                        <i class="fas fa-sign-out-alt mr-2"></i>Déconnexion
                    </a>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content min-h-screen p-6">
        <?php
        $flashSuccess = flash('success');
        $flashError = flash('error');
        ?>
        <?php if ($flashSuccess): ?>
        <div class="mb-6">
            <div class="p-4 rounded-lg bg-green-100 text-green-700 border border-green-200 animate-fade-in">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    <?= e($flashSuccess) ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <?php if ($flashError): ?>
        <div class="mb-6">
            <div class="p-4 rounded-lg bg-red-100 text-red-700 border border-red-200 animate-fade-in">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    <?= e($flashError) ?>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <?= $content ?? '' ?>
    </main>

    <script>
        // Toggle sidebar on mobile
        document.getElementById('toggle-sidebar').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('active');
            document.querySelector('.main-content').classList.toggle('active');
        });
    </script>
    <?= $extra_js ?? '' ?>
</body>
</html> 