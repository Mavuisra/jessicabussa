<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="theme-color" content="#23a2f7">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="format-detection" content="telephone=no">
    <link rel="apple-touch-icon" href="<?= asset('images/touch-icon.png') ?>">
    <title></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#23a2f7',
                        primaryLight: '#4BB4FF',
                        primaryDark: '#0063C9',
                        secondary: '#F8B195',
                        accent: '#355C7D',
                        light: '#F9F7FF',
                        dark: '#1A1423',
                    },
                    fontFamily: {
                        sans: ['Montserrat', 'sans-serif'],
                        serif: ['Playfair Display', 'serif'],
                    },
                    backdropBlur: {
                        'xs': '2px',
                    },
                    backgroundImage: {
                        'blue-gradient': 'linear-gradient(135deg, #0063C9, #23a2f7, #4BB4FF)',
                        'blue-gradient-hover': 'linear-gradient(135deg, #0052A8, #0F93E8, #37A7F3)',
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="<?= asset('css/blue-gradients.css') ?>">
    <style>
        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(50px); }
            to { opacity: 1; transform: translateX(0); }
        }
        
        @keyframes slideInLeft {
            from { opacity: 0; transform: translateX(-50px); }
            to { opacity: 1; transform: translateX(0); }
        }
        
        @keyframes scaleUp {
            from { transform: scale(0.8); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }
        
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        
        /* Animation pour la section héros */
        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        .gradient-animation {
            background-size: 300% 300%;
            animation: gradientBG 12s ease infinite;
        }
        
        /* Style spécifique pour la page d'accueil */
        body.home-page #main-header .navbar-solid a.home-logo {
            background-image: none !important;
            -webkit-background-clip: initial !important;
            -webkit-text-fill-color: white !important;
            background-clip: initial !important;
            text-fill-color: white !important;
            color: white !important;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3) !important;
        }
        
        /* Typewriter effect */
        .typewriter {
            border-right: 3px solid white;
            white-space: nowrap;
            overflow: hidden;
            display: inline-block;
        }
        
        /* Styles for gradient text and backgrounds */
        .text-gradient {
            background-image: linear-gradient(135deg,rgb(24, 23, 97),rgb(103, 122, 209),rgb(216, 211, 233));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-fill-color: transparent;
        }
        .text-gradient:hover
        {
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-fill-color: transparent;
            background-image: linear-gradient(135deg, #0063C9, #23a2f7, #4BB4FF); 
        }
        .bg-blue-gradient {
            background-image: linear-gradient(135deg, #0063C9, #23a2f7, #4BB4FF);
        }
        
        .btn-gradient {
            background-image: linear-gradient(135deg, #0063C9, #23a2f7, #4BB4FF);
            color: white;
            transition: all 0.3s ease;
            background-size: 200% auto;
        }
        
        .btn-gradient:hover {
            background-position: right center;
            box-shadow: 0 7px 14px rgba(0, 99, 201, 0.2);
        }
        
        /* Gradient borders and accents */
        .gradient-border-bottom {
            position: relative;
        }
        
        .gradient-border-bottom::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background-image: linear-gradient(135deg, #0063C9, #23a2f7, #4BB4FF);
            transition: width 0.3s ease;
        }
        
        .gradient-border-bottom:hover::after {
            width: 100%;
        }
        
        .hero-blue-gradient {
            background-image: linear-gradient(135deg, #0b346e, #0063C9, #23a2f7);
        }
        
        /* Contact card styles for reuse */
        .contact-card {
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }
        
        .contact-card:hover {
            transform: translateY(-5px);
            border-left: 3px solid #23a2f7;
        }
        
        .contact-icon {
            background-image: linear-gradient(135deg, #0063C9, #23a2f7, #4BB4FF);
            color: white;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-size: 20px;
            box-shadow: 0 4px 10px rgba(0, 99, 201, 0.2);
        }
        
        /* Input styles for forms */
        .input-field {
            transition: all 0.3s ease;
            border: 1px solid #e2e8f0;
        }
        
        .input-field:focus {
            border-color: transparent;
            box-shadow: 0 0 0 2px rgba(35, 162, 247, 0.5);
        }
        
        .input-field-label {
            position: absolute;
            top: -12px;
            left: 10px;
            padding: 0 5px;
            font-size: 12px;
            background-color: white;
            transition: all 0.3s ease;
        }
        
        /* Glass effect */
        .glass {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(12px) saturate(180%);
            -webkit-backdrop-filter: blur(12px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.18);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        }
        
        .glass-dark {
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(12px) saturate(180%);
            -webkit-backdrop-filter: blur(12px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .glass-navbar {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px) saturate(160%);
            -webkit-backdrop-filter: blur(10px) saturate(160%);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
            transition: all 0.3s ease;
        }
        
        .navbar-transparent {
            background: rgba(255, 255, 255, 0);
            backdrop-filter: blur(0px);
            -webkit-backdrop-filter: blur(0px);
            border-bottom: none;
        }
        
        .navbar-transparent a {
            color: white;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
        }
        
        .navbar-transparent a.bg-primary {
            text-shadow: none;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        
        .navbar-transparent .mobile-menu-button {
            color: white;
        }
        
        .navbar-solid {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px) saturate(160%);
            -webkit-backdrop-filter: blur(10px) saturate(160%);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        .navbar-solid a {
            color: #1A1423; /* Dark text color */
            text-shadow: none;
        }
        
        /* Mobile bottom navigation */
        .mobile-tab-bar {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            display: flex;
            justify-content: space-around;
            padding: 12px 0 8px;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
            z-index: 40;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
        }
        
        .mobile-tab-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            font-size: 10px;
            color: #777;
            transition: color 0.3s;
        }
        
        .mobile-tab-item.active {
            background-image: linear-gradient(135deg, #0063C9, #23a2f7, #4BB4FF);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-fill-color: transparent;
        }
        
        .mobile-tab-item i {
            font-size: 20px;
            margin-bottom: 4px;
        }
        
        /* Safe area for bottom navigation */
        @supports (padding-bottom: env(safe-area-inset-bottom)) {
            .mobile-tab-bar {
                padding-bottom: calc(8px + env(safe-area-inset-bottom));
            }
            
            .pb-safe {
                padding-bottom: env(safe-area-inset-bottom);
            }
        }
        
        /* Smooth transitions */
        .hover-lift {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }
        
        /* Text animations */
        .animate-text-1 {
            animation: fadeIn 0.8s ease-out forwards;
        }
        
        .animate-text-2 {
            animation: fadeIn 0.8s ease-out 0.3s forwards;
            opacity: 0;
        }
        
        .animate-text-3 {
            animation: fadeIn 0.8s ease-out 0.6s forwards;
            opacity: 0;
        }
        
        .animate-text-4 {
            animation: fadeIn 0.8s ease-out 0.9s forwards;
            opacity: 0;
        }
        
        /* Button animation */
        .animated-button {
            position: relative;
            overflow: hidden;
            z-index: 1;
            transition: all 0.4s ease;
        }
        
        .animated-button:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.2);
            z-index: -2;
        }
        
        .animated-button:before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.2);
            transition: all 0.4s;
            z-index: -1;
        }
        
        .animated-button:hover:before {
            width: 100%;
        }
        
        /* Active state for buttons on mobile */
        .tap-highlight {
            -webkit-tap-highlight-color: transparent;
        }
        .active-state:active {
            transform: scale(0.98);
            opacity: 0.8;
        }
        
        /* Floating elements */
        .floating {
            animation: float 6s ease-in-out infinite;
        }
        
        .floating-slow {
            animation: float 8s ease-in-out infinite;
        }
        
        .floating-fast {
            animation: float 4s ease-in-out infinite;
        }
        
        /* Mobile optimization */
        @media (max-width: 768px) {
            .typewriter {
                white-space: normal;
                display: block;
                border-right: none;
            }
            
            h1, h2, h3 {
                line-height: 1.2;
            }
            
            .container {
                padding-left: 16px !important;
                padding-right: 16px !important;
            }
            
            .mobile-pb-extra {
                padding-bottom: 80px; /* Space for the mobile tab bar */
            }
        }
    </style>
    <?= $extra_css ?? '' ?>
</head>
<body class="bg-light text-dark font-sans min-h-screen flex flex-col <?php if (in_array(parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH), ['/', '/home', '/home/'], true)): ?>home-page<?php endif; ?>">
    <!-- Header Navigation -->
    <header id="main-header" class="fixed w-full top-0 z-50 glass-navbar navbar-transparent">
        <nav class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="<?= url('home') ?>" class="text-2xl font-bold <?php if (in_array(parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH), ['/', '/home', '/home/'], true)): ?>text-gradient home-logo<?php else: ?>text-gradient<?php endif; ?> font-serif transition-colors duration-300">Jessica Bussa Nyamboyo</a>
            
            <!-- Mobile Menu Button -->
            <button id="mobile-menu-button" class="lg:hidden text-gradient tap-highlight active-state transition-colors duration-300">
                <i class="fas fa-bars text-xl"></i>
            </button>
            
            <!-- Desktop Navigation - Redesigned -->
            <div class="hidden lg:flex items-center space-x-1">
                <a href="<?= url('about') ?>" class="relative px-4 py-2 font-medium group overflow-hidden gradient-border-bottom">
                    <span class="absolute inset-0 w-0 bg-blue-50 transition-all duration-300 ease-out group-hover:w-full"></span>
                    <span class="relative  group-hover:text-primaryDark transition-colors">À propos</span>
                </a>
                <a href="<?= url('blog') ?>" class="relative px-4 py-2 font-medium group overflow-hidden gradient-border-bottom">
                    <span class="absolute inset-0 w-0 bg-blue-50 transition-all duration-300 ease-out group-hover:w-full"></span>
                    <span class="relative group-hover:text-primaryDark transition-colors">Blog</span>
                </a>
                <a href="<?= url('gallery') ?>" class="relative px-4 py-2 font-medium group overflow-hidden gradient-border-bottom">
                    <span class="absolute inset-0 w-0 bg-blue-50 transition-all duration-300 ease-out group-hover:w-full"></span>
                    <span class="relative  group-hover:text-primaryDark transition-colors">Galerie</span>
                </a>
                <a href="<?= url('activities') ?>" class="relative px-4 py-2 font-medium group overflow-hidden gradient-border-bottom">
                    <span class="absolute inset-0 w-0 bg-blue-50 transition-all duration-300 ease-out group-hover:w-full"></span>
                    <span class="relative   group-hover:text-primaryDark transition-colors">Activités</span>
                </a>
                <a href="<?= url('contact') ?>" class="ml-2 btn-gradient px-5 py-2 rounded-full hover:shadow-lg transform hover:-translate-y-0.5">
                    Contact
                </a>
            </div>
        </nav>
        
        <!-- Mobile Navigation -->
        <div id="mobile-menu" class="hidden lg:hidden bg-white glass-navbar">
            <div class="container mx-auto px-4 py-2 flex flex-col space-y-3">
                <a href="<?= url('about') ?>" class="text-dark hover:text-primaryDark transition-colors py-2 border-b border-gray-100">
                    <i class="fas fa-user mr-2"></i> À propos
                </a>
                <a href="<?= url('blog') ?>" class="text-dark hover:text-primaryDark transition-colors py-2 border-b border-gray-100">
                    <i class="fas fa-blog mr-2"></i> Blog
                </a>
                <a href="<?= url('gallery') ?>" class="text-dark hover:text-primaryDark transition-colors py-2 border-b border-gray-100">
                    <i class="fas fa-images mr-2"></i> Galerie
                </a>
                <a href="<?= url('activities') ?>" class="text-dark hover:text-primaryDark transition-colors py-2 border-b border-gray-100">
                    <i class="fas fa-calendar-alt mr-2"></i> Activités
                </a>
                <a href="<?= url('contact') ?>" class="btn-gradient px-4 py-2 rounded-full hover:bg-opacity-90 transition-colors inline-block w-max">
                    <i class="fas fa-envelope mr-2"></i> Contact
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content with padding for fixed header -->
    <main class="flex-grow <?php if (!in_array(parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH), ['/', '/home', '/home/'], true)): ?>pt-20<?php endif; ?> mobile-pb-extra">
        <?= $content ?? '' ?>
    </main>

    <!-- Footer Section for Desktop -->
    <footer class="bg-black text-white py-8">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- About Column -->
                <div class="col-span-1">
                    <h3 class="text-xl font-bold mb-4">Jessica Bussa</h3>
                    <p class="mb-4 text-gray-300">Entrepreneuse, Leader et Activiste dédiée à l'autonomisation des femmes et au développement communautaire.</p>
                    <div class="flex space-x-4">
                        <a href="https://www.facebook.com/profile.php?id=100071847219729" class="text-gray-300 hover:text-gradient">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://twitter.com/bussa_jessica" class="text-gray-300 hover:text-gradient">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="https://www.instagram.com/jessica_bussa/" class="text-gray-300 hover:text-gradient">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://www.linkedin.com/in/jessica-bussa-phd-02a10b51/" class="text-gray-300 hover:text-gradient">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Quick Links Column -->
                <div class="col-span-1">
                    <h3 class="text-xl font-bold mb-4">Liens Rapides</h3>
                    <ul class="space-y-2">
                        <li><a href="<?= url('home') ?>" class="text-gray-300 hover:text-gradient">Accueil</a></li>
                        <li><a href="<?= url('about') ?>" class="text-gray-300 hover:text-gradient">À Propos</a></li>
                        <li><a href="<?= url('activities') ?>" class="text-gray-300 hover:text-gradient">Activités</a></li>
                        <li><a href="<?= url('blog') ?>" class="text-gray-300 hover:text-gradient">Blog</a></li>
                        <li><a href="<?= url('gallery') ?>" class="text-gray-300 hover:text-gradient">Galerie</a></li>
                        <li><a href="<?= url('contact') ?>" class="text-gray-300 hover:text-gradient">Contact</a></li>
                    </ul>
                </div>
                
                <!-- Contact Column -->
                <div class="col-span-1">
                    <h3 class="text-xl font-bold mb-4">Contact</h3>
                    <ul class="space-y-2">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt mt-1 mr-2 text-gradient"></i>
                            <span class="text-gray-300">Kinshasa, RDC</span>
                        </li>
        <li class="flex items-start">
            <i class="fas fa-envelope mt-1 mr-2 text-gradient"></i>
            <span class="text-gray-300">contact@jessicabussa.cd</span>
        </li>
                        
                    </ul>
                </div>
                
                <!-- Newsletter Column -->
                <div class="col-span-1">
                    <h3 class="text-xl font-bold mb-4">Newsletter</h3>
                    <p class="mb-4 text-gray-300">Abonnez-vous pour recevoir nos dernières actualités.</p>
                    <form id="newsletter-form" class="space-y-2">
                        <?= csrf_field() ?>
                        <div>
                            <input type="email" id="newsletter-email" placeholder="Votre email" class="w-full px-4 py-2 bg-gray-800 text-white border border-gray-700 rounded focus:outline-none focus:border-primary" required>
                        </div>
                        <button type="submit" class="btn-gradient px-4 py-2 rounded transition duration-300">S'abonner</button>
                    </form>
                    <div id="newsletter-message" class="mt-2 text-sm hidden"></div>
                </div>
            </div>
            
            <!-- Copyright -->
            <div class="border-t border-gray-800 mt-8 pt-6 text-center">
                <p class="text-gray-400">&copy; 2023 Jessica Bussa. Tous droits réservés.</p>
                <p class="text-gray-400 mt-2">Site développé par <a href="https://israelmv.netlify.app/" class="text-gradient hover:opacity-80" target="_blank">mavdev</a></p>
            </div>
        </div>
    </footer>
    
    <!-- Mobile Footer -->
    <footer class="bg-black text-white py-4 md:hidden">
        <div class="container mx-auto px-4">
            <div class="text-center">
                <div class="flex justify-center space-x-4 mb-3">
                    <a href="https://www.facebook.com/profile.php?id=100071847219729" class="text-gray-300 hover:text-gradient">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://twitter.com/bussa_jessica" class="text-gray-300 hover:text-gradient">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://www.instagram.com/jessica_bussa/" class="text-gray-300 hover:text-gradient">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://www.linkedin.com/in/jessica-bussa-phd-02a10b51/" class="text-gray-300 hover:text-gradient">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
                <p class="text-gray-400 text-xs">Site développé par <a href="https://israelmv.netlify.app/" class="text-gradient hover:opacity-80" target="_blank">mavdev</a></p>
            </div>
        </div>
    </footer>

    <!-- Mobile Tab Bar -->
    <div class="mobile-tab-bar lg:hidden">
        <a href="<?= url('home') ?>" class="mobile-tab-item tap-highlight active-state <?php if ($request->path === '/'): ?>text-gradient<?php else: ?>text-gray-500<?php endif; ?>">
            <i class="fas fa-home"></i>
            <span>Accueil</span>
        </a>
        <a href="<?= url('about') ?>" class="mobile-tab-item tap-highlight active-state <?php if (str_contains((string) ($request->path ?? ''), '/about/')): ?>text-gradient<?php else: ?>text-gray-500<?php endif; ?>">
            <i class="fas fa-user"></i>
            <span>À propos</span>
        </a>
        <a href="<?= url('blog') ?>" class="mobile-tab-item tap-highlight active-state <?php if (str_contains((string) ($request->path ?? ''), '/blog/')): ?>text-gradient<?php else: ?>text-gray-500<?php endif; ?>">
            <i class="fas fa-blog"></i>
            <span>Blog</span>
        </a>
        <a href="<?= url('gallery') ?>" class="mobile-tab-item tap-highlight active-state <?php if (str_contains((string) ($request->path ?? ''), '/gallery/')): ?>text-gradient<?php else: ?>text-gray-500<?php endif; ?>">
            <i class="fas fa-images"></i>
            <span>Galerie</span>
        </a>
        <a href="<?= url('contact') ?>" class="mobile-tab-item tap-highlight active-state <?php if (str_contains((string) ($request->path ?? ''), '/contact/')): ?>text-gradient<?php else: ?>text-gray-500<?php endif; ?>">
            <i class="fas fa-envelope"></i>
            <span>Contact</span>
        </a>
    </div>

    <!-- JavaScript Section -->
    <script>
        // Mobile menu toggle
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            
            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', function() {
                    mobileMenu.classList.toggle('hidden');
                });
            }
            
            // Detect iOS for safe area insets
            const isIOS = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;
            if (isIOS) {
                document.documentElement.classList.add('ios-device');
            }
            
            // Set active state for mobile tab bar
            const currentPage = window.location.pathname;
            document.querySelectorAll('.mobile-tab-item').forEach(item => {
                const href = item.getAttribute('href');
                if (href === currentPage || (href === '/' && currentPage === '/') || currentPage.includes(href) && href !== '/') {
                    item.classList.add('text-gradient');
                    item.classList.remove('text-gray-500');
                }
            });
            
            // Navbar scroll effect with direct logo color control
            const header = document.getElementById('main-header');
            const isHomePage = window.location.pathname === '/' || window.location.pathname === '/home/';
            const logo = document.querySelector('.home-logo');
            
            // Function to set logo style
            function setLogoColor(isScrolled) {
                if (isHomePage && logo) {
                    if (isScrolled) {
                        // Change to gradient blue on scroll
                        logo.style.backgroundImage = 'linear-gradient(135deg,rgb(24, 23, 97),rgb(103, 122, 209),rgb(216, 211, 233))';
                        logo.style.webkitBackgroundClip = 'text';
                        logo.style.webkitTextFillColor = 'transparent';
                        logo.style.backgroundClip = 'text';
                        logo.style.textShadow = '0 2px 4px rgba(0, 0, 0, 0.2)';
                    } else {
                        // White color when at top
                        logo.style.backgroundImage = 'none';
                        logo.style.webkitBackgroundClip = 'initial';
                        logo.style.webkitTextFillColor = 'white';
                        logo.style.backgroundClip = 'initial';
                        logo.style.color = 'white';
                        logo.style.textShadow = '0 1px 2px rgba(0, 0, 0, 0.3)';
                    }
                }
            }
            
            // On load, if not home page, make navbar solid
            if (!isHomePage) {
                header.classList.remove('navbar-transparent');
                header.classList.add('navbar-solid');
            }
            
            // Initial check for scroll position
            setLogoColor(window.scrollY > 50);
            
            // Listen for scroll
            window.addEventListener('scroll', function() {
                const isScrolled = window.scrollY > 50;
                
                if (isScrolled) {
                    header.classList.remove('navbar-transparent');
                    header.classList.add('navbar-solid');
                } else if (isHomePage) {
                    header.classList.add('navbar-transparent');
                    header.classList.remove('navbar-solid');
                }
                
                // Update logo color based on scroll
                setLogoColor(isScrolled);
            });
            
            // Newsletter form handling
            const newsletterForm = document.getElementById('newsletter-form');
            if (newsletterForm) {
                newsletterForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    const email = document.getElementById('newsletter-email').value;
                    const messageDiv = document.getElementById('newsletter-message');
                    const submitBtn = newsletterForm.querySelector('button[type="submit"]');
                    
                    if (!email) {
                        showNewsletterMessage('Veuillez entrer une adresse email valide', 'error');
                        return;
                    }
                    
                    // Disable button during request
                    submitBtn.disabled = true;
                    submitBtn.textContent = 'Abonnement...';
                    
                    fetch('<?= url('home') ?>', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                            'X-CSRFToken': document.querySelector('[name=_csrf]')?.value || ''
                        },
                        body: `email=${encodeURIComponent(email)}`
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            showNewsletterMessage(data.message, 'success');
                            newsletterForm.reset();
                        } else {
                            showNewsletterMessage(data.message, 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showNewsletterMessage('Une erreur est survenue. Veuillez réessayer.', 'error');
                    })
                    .finally(() => {
                        // Re-enable button
                        submitBtn.disabled = false;
                        submitBtn.textContent = 'S\'abonner';
                    });
                });
            }
            
            function showNewsletterMessage(message, type) {
                const messageDiv = document.getElementById('newsletter-message');
                if (messageDiv) {
                    messageDiv.textContent = message;
                    messageDiv.className = `mt-2 text-sm ${type === 'success' ? 'text-green-400' : 'text-red-400'}`;
                    messageDiv.classList.remove('hidden');
                    
                    // Hide message after 5 seconds
                    setTimeout(() => {
                        messageDiv.classList.add('hidden');
                    }, 5000);
                }
            }
        });
    </script>
    <?= $extra_js ?? '' ?>
</body>
</html> 