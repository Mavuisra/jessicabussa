<?php $extra_css = <<<'HTML_BLOCK'
<style>
    /* Variables de couleur pour cohérence */
    :root {
        --color-primary-light: rgba(159, 122, 234, 0.1);
        --color-primary-medium: rgba(159, 122, 234, 0.5);
        --color-primary-dark: rgba(126, 87, 194, 0.8);
    }
    
    /* Typographie améliorée avec ajustements mobiles */
    .event-content {
        font-size: 1.125rem;
        line-height: 1.9;
        color: #424242;
        text-align: left;
    }
    
    @media (max-width: 768px) {
        .event-content {
            font-size: 1rem;
            line-height: 1.7;
            padding: 0 0.5rem;
        }
        
        .event-content p {
            margin-bottom: 1.25rem;
        }
    }
    
    .event-content p {
        margin-bottom: 1.8rem;
    }
    
    /* Styles pour le contenu HTML riche (Quill) */
    .event-content h1, .event-content h2, .event-content h3, .event-content h4, .event-content h5, .event-content h6 {
        font-family: 'Playfair Display', serif;
        font-weight: 600;
        margin-top: 2rem;
        margin-bottom: 1rem;
        color: #1a202c;
        line-height: 1.3;
    }
    
    .event-content h1 {
        font-size: 2.5rem;
        border-bottom: 3px solid var(--color-primary-medium);
        padding-bottom: 0.5rem;
    }
    
    .event-content h2 {
        font-size: 2rem;
        color: var(--color-primary-dark);
    }
    
    .event-content h3 {
        font-size: 1.5rem;
        color: var(--color-primary-dark);
    }
    
    .event-content blockquote {
        border-left: 4px solid var(--color-primary-medium);
        padding-left: 1.5rem;
        margin: 2rem 0;
        font-style: italic;
        background: var(--color-primary-light);
        padding: 1.5rem;
        border-radius: 0.5rem;
    }
    
    .event-content ul, .event-content ol {
        margin: 1.5rem 0;
        padding-left: 2rem;
    }
    
    .event-content li {
        margin-bottom: 0.5rem;
    }
    
    .event-content a {
        color: var(--color-primary-dark);
        text-decoration: underline;
        transition: color 0.3s ease;
    }
    
    .event-content a:hover {
        color: var(--color-primary-medium);
    }
    
    .event-content img {
        max-width: 100%;
        height: auto;
        border-radius: 0.5rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        margin: 2rem 0;
    }
    
    /* Animation pour les titres avec soulignement progressif */
    .title-underline {
        display: inline-block;
        position: relative;
    }
    
    .title-underline::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--color-primary-medium), transparent);
        transition: width 0.6s ease-out;
    }
    
    .title-underline.animated::after {
        width: 100%;
    }
    
    /* Effets de parallax et animations avancées */
    .scroll-reveal {
        opacity: 0;
        transform: translateY(30px);
        transition: opacity 0.8s ease, transform 0.8s ease;
    }
    
    .scroll-reveal.revealed {
        opacity: 1;
        transform: translateY(0);
    }
    
    /* Effets de glassmorphism et blur améliorés */
    .glass-elite {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.18);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    }
    
    /* Améliorations pour les images et conteneurs */
    .event-image-container {
        position: relative;
        overflow: hidden;
        border-radius: 20px;
        box-shadow: 0 30px 60px -12px rgba(0, 0, 0, 0.25), 0 18px 36px -18px rgba(0, 0, 0, 0.3);
        transform: perspective(1000px) rotateX(2deg);
        transition: all 0.7s ease;
    }
    
    .event-image-container:hover {
        transform: perspective(1000px) rotateX(0deg);
    }
    
    .event-image {
        transition: transform 0.9s cubic-bezier(0.165, 0.84, 0.44, 1);
    }
    
    .event-image-container:hover .event-image {
        transform: scale(1.08);
    }
    
    /* Effets d'ombre dynamiques pour les cartes */
    .dynamic-shadow {
        position: relative;
    }
    
    .dynamic-shadow::after {
        content: '';
        position: absolute;
        top: 10%;
        left: 5%;
        width: 90%;
        height: 85%;
        border-radius: inherit;
        background: rgba(0, 0, 0, 0.15);
        filter: blur(20px);
        z-index: -1;
        opacity: 0;
        transform: translateY(10px);
        transition: opacity 0.5s ease, transform 0.5s ease;
    }
    
    .dynamic-shadow:hover::after {
        opacity: 1;
        transform: translateY(20px);
    }
    
    /* Animation de brillance pour les boutons */
    .btn-shine {
        position: relative;
        overflow: hidden;
    }
    
    .btn-shine::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(
            to right,
            rgba(255, 255, 255, 0) 0%,
            rgba(255, 255, 255, 0.3) 50%,
            rgba(255, 255, 255, 0) 100%
        );
        transform: rotate(30deg);
        transition: transform 0.7s ease-in-out;
        z-index: 1;
        opacity: 0;
    }
    
    .btn-shine:hover::before {
        transform: rotate(30deg) translate(100%, -100%);
        opacity: 1;
    }
    
    /* Animations pour interactions */
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.15); }
        100% { transform: scale(1); }
    }
    
    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
        100% { transform: translateY(0px); }
    }
    
    .float-animation {
        animation: float 3s ease-in-out infinite;
    }
    
    .pulse-animation {
        animation: pulse 0.6s cubic-bezier(0.4, 0, 0.6, 1);
    }
    
    /* Scroll progression */
    .progress-container {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: transparent;
        z-index: 9999;
    }
    
    .progress-bar {
        height: 100%;
        background: linear-gradient(90deg, #9f7aea, #f687b3);
        width: 0%;
        transition: width 0.1s ease;
    }
    
    /* Séparateurs stylisés */
    .stylish-divider {
        position: relative;
        height: 1px;
        background-color: #e5e7eb;
        margin: 3rem 0;
    }
    
    .stylish-divider::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 40px;
        height: 40px;
        background-color: white;
        border-radius: 50%;
        box-shadow: 0 0 0 8px white;
    }
    
    .stylish-divider::after {
        content: '✦';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: #9f7aea;
        font-size: 1.5rem;
    }
    
    /* Styles spécifiques aux événements */
    .event-info-card {
        background: linear-gradient(135deg, rgba(159, 122, 234, 0.1) 0%, rgba(246, 135, 179, 0.1) 100%);
        border: 1px solid rgba(159, 122, 234, 0.2);
    }
    
    .event-type-badge {
        background: linear-gradient(135deg, #9f7aea, #f687b3);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 9999px;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.875rem;
        letter-spacing: 0.05em;
    }
    
    .event-date-badge {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 9999px;
        font-weight: 600;
        font-size: 1rem;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .mobile-center {
            text-align: center;
            justify-content: center;
        }
        
        .mobile-full {
            width: 100%;
            margin-left: 0;
            margin-right: 0;
        }
        
        .mobile-stack {
            flex-direction: column !important;
            align-items: center !important;
        }
        
        .mobile-stack > * {
            margin-bottom: 1rem;
        }
        
        .mobile-smaller-text {
            font-size: 0.9rem;
        }
        
        .mobile-smaller-heading {
            font-size: 1.5rem !important;
        }
        
        .mobile-compact-padding {
            padding: 1rem !important;
        }
        
        .mobile-top-spacing {
            margin-top: 0.5rem !important;
        }
    }
</style>
HTML_BLOCK; ?>

<!-- Indicateur de progression de lecture -->
<div class="progress-container">
    <div class="progress-bar" id="progressBar"></div>
</div>

<!-- Hero Section immersif -->
<section class="relative bg-primary py-20 md:py-32 overflow-hidden">
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute top-0 right-0 w-96 h-96 bg-secondary/30 rounded-full blur-3xl opacity-60"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-accent/30 rounded-full blur-3xl opacity-60"></div>
        <div class="absolute top-1/3 left-1/4 w-60 h-60 bg-white/10 rounded-full blur-2xl opacity-30"></div>
    </div>
    
    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center text-white">
            <div class="flex justify-center mb-8 float-animation">
                <a href="<?= url('activities') ?>" class="glass-elite text-white px-8 py-3 rounded-full hover:bg-white/40 transition-all flex items-center space-x-3 btn-shine">
                    <i class="fas fa-arrow-left text-lg"></i>
                    <span class="font-medium">Retour aux activités</span>
                </a>
            </div>
            
            <h1 class="text-3xl md:text-5xl lg:text-6xl font-serif font-bold mb-8 leading-tight text-shadow-lg max-w-5xl mx-auto">
                <span class="title-underline" id="mainTitle"><?= e($event->title) ?></span>
            </h1>
            
            <div class="flex flex-wrap items-center justify-center gap-6 text-sm font-medium">
                <span class="flex items-center space-x-2 glass-elite px-4 py-2 rounded-full">
                    <i class="far fa-calendar-alt text-secondary"></i>
                    <span><?= e(date('d F Y', strtotime((string) ($event->date ?? '')))) ?></span>
                </span>
                <?php if ($event->time): ?>
                <span class="flex items-center space-x-2 glass-elite px-4 py-2 rounded-full">
                    <i class="far fa-clock text-secondary"></i>
                    <span>{{ event.time|time:"H:i" }}<?php if ($event->end_time): ?> - {{ event.end_time|time:"H:i" }}<?php endif; ?></span>
                </span>
                <?php endif; ?>
                <span class="flex items-center space-x-2 glass-elite px-4 py-2 rounded-full">
                    <i class="far fa-eye text-secondary"></i>
                    <span id="viewsCounter"><?= e($event->views) ?> vues</span>
                </span>
            </div>
        </div>
    </div>
</section>

<!-- Event Content Section avec design élégant -->
<section class="py-16 md:py-24 bg-light relative">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto relative">
            <?php if ($event->featured_image): ?>
            <div class="event-image-container -mt-32 md:-mt-32 mb-12 md:mb-16 z-10 dynamic-shadow">
                <img src="<?= e(media_url($event->featured_image ?? '')) ?>" alt="<?= e($event->title) ?>" class="event-image w-full h-auto" id="featuredImage">
            </div>
            <?php endif; ?>
            
            <!-- Contenu principal avec design amélioré -->
            <article class="space-y-6 md:space-y-8">
                <!-- Informations de l'événement -->
                <div class="event-info-card glass-elite p-6 md:p-8 rounded-xl shadow-lg scroll-reveal mobile-compact-padding">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div class="flex items-center space-x-3">
                                <span class="event-type-badge"><?= e(event_type_label($event->event_type ?? '')) ?></span>
                                <?php if ($event->is_featured): ?>
                                <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-medium">
                                    <i class="fas fa-star mr-1"></i>À la une
                                </span>
                                <?php endif; ?>
                            </div>
                            
                            <div class="event-date-badge inline-block">
                                <i class="fas fa-calendar-day mr-2"></i>
                                <?= e(date('d M Y', strtotime((string) ($event->date ?? '')))) ?>
                            </div>
                            
                            <div class="space-y-2">
                                <div class="flex items-center space-x-2 text-gray-700">
                                    <i class="fas fa-map-marker-alt text-primary"></i>
                                    <span><?= e($event->location) ?><?php if ($event->city): ?>, <?= e($event->city) ?><?php endif; ?></span>
                                </div>
                                
                                <?php if ($event->address): ?>
                                <div class="flex items-start space-x-2 text-gray-600 text-sm">
                                    <i class="fas fa-map text-primary mt-1"></i>
                                    <span><?= e($event->address) ?></span>
                                </div>
                                <?php endif; ?>
                                
                                <?php if ($event->capacity): ?>
                                <div class="flex items-center space-x-2 text-gray-700">
                                    <i class="fas fa-users text-primary"></i>
                                    <span>Capacité : <?= e($event->capacity) ?> participants</span>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <div class="space-y-4">
                            <?php if ($event->contact_email): ?>
                            <div class="flex items-center space-x-2 text-gray-700">
                                <i class="fas fa-envelope text-primary"></i>
                                <a href="mailto:<?= e($event->contact_email) ?>" class="hover:text-primary"><?= e($event->contact_email) ?></a>
                            </div>
                            <?php endif; ?>
                            
                            <?php if ($event->contact_phone): ?>
                            <div class="flex items-center space-x-2 text-gray-700">
                                <i class="fas fa-phone text-primary"></i>
                                <a href="tel:<?= e($event->contact_phone) ?>" class="hover:text-primary"><?= e($event->contact_phone) ?></a>
                            </div>
                            <?php endif; ?>
                            
                            <?php if ($event->registration_url): ?>
                            <div class="mt-6 space-y-3">
                                <a href="<?= e($event->registration_url) ?>" target="_blank" class="btn-shine bg-primary text-white px-6 py-3 rounded-full hover:bg-opacity-90 transition-all flex items-center justify-center space-x-2">
                                    <i class="fas fa-external-link-alt"></i>
                                    <span>S'inscrire à l'événement</span>
                                </a>
                                
                                <!-- Boutons de partage Facebook -->
                                <div class="flex flex-col space-y-2">
                                    <span class="text-sm text-gray-600 text-center">Partager sur Facebook :</span>
                                    <div class="flex justify-center space-x-2">
                                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?= e($request->build_absolute_uri) ?>" target="_blank" class="bg-blue-600 text-white px-4 py-2 rounded-full hover:bg-blue-700 transition-colors flex items-center space-x-2">
                                            <i class="fab fa-facebook-f"></i>
                                            <span>Partager</span>
                                        </a>
                                        <a href="https://www.facebook.com/events/create/?event_name={{ event.title|urlencode }}&event_description={{ event.description|truncatewords:20|urlencode }}&event_start_time={{ event.date|date:'Y-m-d' }}<?php if ($event->time): ?>T{{ event.time|time:'H:i' }}<?php endif; ?>&event_location={{ event.location|urlencode }}" target="_blank" class="bg-green-600 text-white px-4 py-2 rounded-full hover:bg-green-700 transition-colors flex items-center space-x-2">
                                            <i class="fas fa-calendar-plus"></i>
                                            <span>Créer événement FB</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                
                <!-- Description -->
                <?php if ($event->description): ?>
                <div class="glass-elite p-6 md:p-8 rounded-xl shadow-lg scroll-reveal mobile-compact-padding">
                    <h2 class="text-2xl font-serif font-semibold mb-4 flex items-center title-underline animated mobile-center">
                        <i class="fas fa-info-circle mr-3 text-primary"></i>
                        À propos de cet événement
                    </h2>
                    <p class="text-gray-700 text-lg leading-relaxed"><?= e($event->description) ?></p>
                </div>
                <?php endif; ?>
                
                <!-- Contenu détaillé -->
                <?php if ($event->content): ?>
                <div class="prose prose-lg max-w-none event-content scroll-reveal" id="eventContent">
                    <?= $event->content ?>
                </div>
                <?php endif; ?>
                
                <div class="stylish-divider scroll-reveal"></div>
                
                <!-- Profil de l'organisateur -->
                <div class="glass-elite p-4 md:p-8 rounded-xl shadow-lg flex flex-col md:flex-row items-center gap-4 md:gap-6 scroll-reveal mobile-compact-padding">
                    <div class="w-16 h-16 bg-primary/20 rounded-full flex items-center justify-center text-primary flex-shrink-0">
                        <i class="fas fa-user-circle text-3xl"></i>
                    </div>
                    <div class="text-center md:text-left mobile-center">
                        <h3 class="text-xl font-serif font-semibold mb-2">Jessica Bussa</h3>
                        <p class="text-gray-600 mb-3 mobile-smaller-text">Entrepreneuse, philanthrope et conférencière passionnée par l'impact social et l'émancipation des femmes en Afrique.</p>
                        <div class="flex space-x-3 justify-center md:justify-start">
                            <a href="#" class="text-primary hover:text-primary-dark transition-colors"><i class="fab fa-linkedin"></i></a>
                            <a href="#" class="text-primary hover:text-primary-dark transition-colors"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="text-primary hover:text-primary-dark transition-colors"><i class="fas fa-globe"></i></a>
                        </div>
                    </div>
                </div>
                
                <!-- Social Interactions avec animations -->
                <div class="mt-12 md:mt-16 glass-elite p-4 md:p-8 rounded-2xl shadow-lg scroll-reveal mobile-compact-padding">
                    <h3 class="text-xl font-serif font-semibold mb-6 md:mb-8 flex items-center title-underline animated mobile-center">
                        <i class="fas fa-share-alt mr-3 text-primary"></i>
                        Partager cet événement
                    </h3>
                    
                    <div class="flex flex-wrap items-center justify-center gap-2 md:gap-3 mobile-top-spacing">
                        <span class="text-sm text-gray-500 w-full md:w-auto text-center md:text-left mb-2 md:mr-2 md:mb-0">Partager sur :</span>
                        <div class="flex justify-center gap-2">
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?= e($request->build_absolute_uri) ?>" target="_blank" class="w-10 md:w-12 h-10 md:h-12 flex items-center justify-center rounded-full bg-blue-500 text-white hover:bg-blue-600 transition-colors" title="Partager sur Facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="https://www.facebook.com/events/create/?event_name={{ event.title|urlencode }}&event_description={{ event.description|truncatewords:20|urlencode }}&event_start_time={{ event.date|date:'Y-m-d' }}<?php if ($event->time): ?>T{{ event.time|time:'H:i' }}<?php endif; ?>&event_location={{ event.location|urlencode }}" target="_blank" class="w-10 md:w-12 h-10 md:h-12 flex items-center justify-center rounded-full bg-green-600 text-white hover:bg-green-700 transition-colors" title="Créer un événement Facebook">
                                <i class="fas fa-calendar-plus"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url=<?= e($request->build_absolute_uri) ?>&text=<?= e($event->title) ?>" target="_blank" class="w-10 md:w-12 h-10 md:h-12 flex items-center justify-center rounded-full bg-blue-400 text-white hover:bg-blue-500 transition-colors" title="Partager sur Twitter">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?= e($request->build_absolute_uri) ?>&title=<?= e($event->title) ?>" target="_blank" class="w-10 md:w-12 h-10 md:h-12 flex items-center justify-center rounded-full bg-blue-700 text-white hover:bg-blue-800 transition-colors" title="Partager sur LinkedIn">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a href="https://api.whatsapp.com/send?text=<?= e($event->title) ?> - <?= e($request->build_absolute_uri) ?>" target="_blank" class="w-10 md:w-12 h-10 md:h-12 flex items-center justify-center rounded-full bg-green-500 text-white hover:bg-green-600 transition-colors" title="Partager sur WhatsApp">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Événements similaires -->
                <?php if ($similar_events): ?>
                <div class="mt-16 md:mt-20 scroll-reveal">
                    <h3 class="text-2xl font-serif font-semibold mb-6 md:mb-8 flex items-center title-underline animated mobile-center mobile-smaller-heading">
                        <i class="fas fa-calendar-alt mr-3 text-primary"></i>
                        Événements similaires
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6">
                        <?php $__loop_items = $similar_events; foreach ($similar_events as $similar_event): ?>
                        <div class="glass-elite rounded-xl overflow-hidden shadow-lg dynamic-shadow">
                            <?php if ($similar_event->featured_image): ?>
                            <div class="h-36 md:h-48 overflow-hidden">
                                <img src="<?= e(media_url($similar_event->featured_image ?? '')) ?>" alt="<?= e($similar_event->title) ?>" class="w-full h-full object-cover">
                            </div>
                            <?php else: ?>
                            <div class="h-36 md:h-48 bg-primary/10 flex items-center justify-center">
                                <i class="fas fa-calendar-alt text-4xl md:text-5xl text-primary/30"></i>
                            </div>
                            <?php endif; ?>
                            <div class="p-4 md:p-5 text-center md:text-left">
                                <h4 class="text-lg font-semibold mb-2 line-clamp-2"><?= e($similar_event->title) ?></h4>
                                <p class="text-sm text-gray-600 mb-2"><?= e(date('d M Y', strtotime((string) ($similar_event->date ?? '')))) ?></p>
                                <a href="<?= url('event_detail', $similar_event->slug) ?>" class="text-primary hover:text-accent flex items-center justify-center md:justify-start text-sm mt-2">
                                    <span>Voir l'événement</span>
                                    <i class="fas fa-arrow-right ml-2 transition-transform group-hover:translate-x-1"></i>
                                </a>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
            </article>
        </div>
    </div>
</section>

<!-- Call to action pour newsletter -->
<section class="py-16 bg-gradient-to-r from-primary/20 to-secondary/20 relative overflow-hidden">
    <div class="absolute top-0 right-0 w-72 h-72 bg-primary/10 rounded-full blur-3xl opacity-60"></div>
    <div class="absolute bottom-0 left-0 w-72 h-72 bg-secondary/10 rounded-full blur-3xl opacity-60"></div>
    
    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-3xl mx-auto glass-elite p-10 rounded-2xl shadow-xl">
            <div class="text-center">
                <div class="w-20 h-20 mx-auto bg-primary/10 rounded-full flex items-center justify-center mb-6 float-animation">
                    <i class="fas fa-envelope-open-text text-2xl text-primary"></i>
                </div>
                <h2 class="text-2xl md:text-3xl font-serif font-semibold mb-4">
                    Ne manquez aucun événement
                </h2>
                <p class="text-gray-600 mb-8 max-w-xl mx-auto">
                    Abonnez-vous à ma newsletter pour être informé des prochains événements 
                    et actualités directement dans votre boîte de réception.
                </p>
                <form class="flex flex-col md:flex-row gap-4 max-w-md mx-auto">
                    <input type="email" placeholder="Votre adresse email" class="flex-1 px-5 py-4 rounded-full border focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent shadow-sm">
                    <button type="submit" class="btn-shine bg-primary text-white px-8 py-4 rounded-full hover:bg-primary/90 transition-colors flex items-center justify-center space-x-2">
                        <i class="fas fa-paper-plane"></i>
                        <span>S'abonner</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
<?php $extra_js = <<<'HTML_BLOCK'
<script>
// Animation du titre principal et initialisation sécurisée
document.addEventListener('DOMContentLoaded', function() {
    console.log('Event detail script loaded');
    
    // Animation du titre principal
    const mainTitle = document.getElementById('mainTitle');
    if (mainTitle) {
        setTimeout(() => {
            mainTitle.classList.add('animated');
        }, 500);
    }
    
    // Barre de progression avec protection
    initProgressBar();
    
    // Animation des éléments au scroll de manière sécurisée
    try {
        initScrollAnimations();
    } catch (e) {
        console.error('Error initializing scroll animations:', e);
    }
});

// Barre de progression de lecture simplifiée
function initProgressBar() {
    const progressBar = document.getElementById('progressBar');
    if (!progressBar) return;
    
    // Fonction de mise à jour de la barre
    function updateProgressBar() {
        const winScroll = document.documentElement.scrollTop || document.body.scrollTop;
        const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        if (height > 0) {
            const scrolled = (winScroll / height) * 100;
            progressBar.style.width = scrolled + '%';
        }
    }
    
    // Écouter l'événement scroll avec throttling pour les performances
    let isScrolling = false;
    window.addEventListener('scroll', function() {
        if (!isScrolling) {
            window.requestAnimationFrame(function() {
                updateProgressBar();
                isScrolling = false;
            });
            isScrolling = true;
        }
    });
    
    // Initialisation
    updateProgressBar();
}

// Animations au défilement simplifiées
function initScrollAnimations() {
    const elementsToAnimate = document.querySelectorAll('.scroll-reveal');
    if (elementsToAnimate.length === 0) return;
    
    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('revealed');
                    // Désinscrire l'élément une fois qu'il est révélé
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        });
        
        elementsToAnimate.forEach(element => {
            observer.observe(element);
        });
    } else {
        // Fallback pour les navigateurs qui ne supportent pas IntersectionObserver
        elementsToAnimate.forEach(element => {
            element.classList.add('revealed');
        });
    }
}
</script>
HTML_BLOCK; ?>
