<!-- Hero Section -->
<section class="relative w-full h-screen">
    <!-- Hero background with image positioned on the left for desktop and centered for mobile -->
    <div class="flex flex-col md:flex-row w-full h-screen relative bg-[#1e56a0]">
        <!-- Image container (full width on mobile, 100% on desktop with overlay) -->
        <div class="w-full h-screen bg-cover bg-[18%_center] md:bg-center" style="background-image: url('<?= asset('images/home/cc.jpg') ?>');">
            <div class="absolute inset-0 bg-gradient-to-b from-transparent via-transparent to-[#1e56a0] md:bg-gradient-to-r md:from-dark/20 md:to-[#1e56a0]/90"></div>
        </div>

        <!-- Content positioned over the full-width image - DESKTOP VERSION -->
        <div class="hidden md:flex container mx-auto px-4 absolute inset-0 items-center justify-end z-10">
            <div class="w-full max-w-xl p-8">
                <h1 class="text-4xl font-bold font-serif mb-3 text-white !text-white animate-text-1 drop-shadow-lg">
                    Jessica Bussa Nyamboyo
                </h1>
                <div class="mb-4">
                    <p class="text-xl italic text-white drop-shadow-md">
                        <span id="typewriter" class="typewriter"></span>
                    </p>
                </div>
                <p class="text-base mb-6 text-white animate-text-3 drop-shadow-md">
                    <i class="fas fa-briefcase mr-2"></i> Entrepreneure
                    <i class="fas fa-briefcase ml-3 mr-2"></i> Administratrice Publique
                    <i class="fas fa-heart ml-3 mr-2"></i> Leader et Activiste
                </p>
                <div class="flex flex-wrap gap-3 animate-text-4">
                    <a href="https://www.mabokoelikia.org/" class="text-sm bg-primary text-white px-3 py-2 rounded-full hover:bg-opacity-90 transition-all animated-button tap-highlight active-state hover:shadow-lg">
                        <i class="fas fa-heart mr-2"></i> Maboko Elikia
                    </a>
                    <a href="https://www.okapievents.com/" class="text-sm bg-secondary text-dark px-3 py-2 rounded-full hover:bg-opacity-90 transition-all animated-button tap-highlight active-state hover:shadow-lg">
                        <i class="fas fa-briefcase mr-2"></i> Okapi Consulting
                    </a>
                    <a href="<?= url('contact') ?>" class="text-sm bg-transparent border-2 border-white text-white px-3 py-1.5 rounded-full hover:bg-white hover:text-[#3a7bd5] transition-all animated-button tap-highlight active-state hover:shadow-lg">
                        <i class="fas fa-envelope mr-2"></i> Contact
                    </a>
                </div>
            </div>
        </div>

        <!-- MOBILE INFO CARD - Positioned at the bottom of the hero section -->
        <div class="md:hidden absolute bottom-8 left-0 right-0 z-10 px-4 text-center">
            <h1 class="text-2xl font-bold font-serif text-white !text-white mb-2 drop-shadow-lg">
                Jessica Bussa
            </h1>
            <div class="mb-2">
                <p class="text-base italic text-white drop-shadow-md">
                    <span id="typewriter-mobile" class="typewriter"></span>
                </p>
            </div>
            <p class="text-sm text-white mb-3 drop-shadow-md">
                <i class="fas fa-briefcase mr-1"></i> Entrepreneure
                <i class="fas fa-crown ml-2 mr-1"></i> Leader
                <i class="fas fa-heart ml-2 mr-1"></i> Activiste
            </p>
            <div class="flex flex-wrap justify-center gap-2">
                <a href="<?= url('foundation') ?>" class="text-xs bg-primary text-white px-3 py-1.5 rounded-full hover:bg-opacity-90 transition-all animated-button tap-highlight active-state hover:shadow-lg">
                    <i class="fas fa-heart mr-1"></i> La Fondation
                </a>
                <a href="<?= url('services') ?>" class="text-xs bg-secondary text-dark px-3 py-1.5 rounded-full hover:bg-opacity-90 transition-all animated-button tap-highlight active-state hover:shadow-lg">
                    <i class="fas fa-briefcase mr-1"></i> Okapi Event
                </a>
                <a href="<?= url('contact') ?>" class="text-xs bg-transparent border border-white text-white px-3 py-1.5 rounded-full hover:bg-white hover:text-[#3a7bd5] transition-all animated-button tap-highlight active-state hover:shadow-lg">
                    <i class="fas fa-envelope mr-1"></i> Contact
                </a>
            </div>
        </div>

        <!-- Floating decorative elements -->
        <div class="absolute top-[15%] right-[10%] md:right-1/6 w-16 md:w-24 h-16 md:h-24 rounded-full bg-primary/30 blur-xl floating-slow"></div>
        <div class="absolute bottom-[25%] md:bottom-1/3 right-[20%] md:right-1/4 w-20 md:w-32 h-20 md:h-32 rounded-full bg-secondary/20 blur-xl floating"></div>
        <div class="absolute top-[30%] left-[10%] md:left-1/6 w-12 md:w-16 h-12 md:h-16 rounded-full bg-accent/20 blur-xl floating-fast"></div>
    </div>
</section>

<!-- About Section -->
<section class="py-12 md:py-16 bg-light">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row gap-8">
            <div class="w-full md:w-3/5 mb-10" data-aos="fade-up">
                <h2 class="text-2xl md:text-3xl font-serif text-primary mb-4 md:mb-6">
                    <i class="fas fa-user-circle mr-2"></i> Qui est Jessica ?
                </h2>
                <p class="text-base md:text-lg mb-3 md:mb-4 text-justify">
                    Entrepreneure dynamique, académicienne et activiste sociale engagée, je suis passionnée par le développement des compétences professionnelles des femmes et l'amélioration des conditions sociales.
                </p>
                <p class="text-base md:text-lg mb-5 md:mb-6 text-justify">
                    Titulaire d'un Doctorat en Leadership Organisationnel de Beulah Heights University (États-Unis), je dirige Okapi Consulting Services et préside la Fondation Maboko Ya Elikia qui soutient les femmes et les jeunes défavorisés.
                </p>

                <div class="mt-6 text-center md:text-left">
                    <a href="<?= url('about') ?>" class="bg-primary text-white px-4 md:px-6 py-2 md:py-3 rounded-full hover:bg-opacity-90 transition-colors inline-block animated-button tap-highlight active-state hover:scale-105">
                        <i class="fas fa-arrow-right mr-2"></i> Voir plus
                    </a>
                </div>
            </div>

            <!-- Infos rapides Section -->
            <div class="w-full md:w-2/5" data-aos="fade-up" data-aos-delay="100">
                <div class="glass p-6 rounded-2xl shadow-md hover-lift">
                    <h3 class="text-xl font-semibold text-primary mb-4">Infos rapides</h3>
                    <ul class="space-y-3">
                        <li class="flex items-center tap-highlight active-state">
                            <div class="w-8 h-8 bg-primary/10 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-graduation-cap text-primary"></i>
                            </div>
                            <span>PhD en Leadership Organisationnel, spécialisation leadership féminin</span>
                        </li>
                        <li class="flex items-center tap-highlight active-state">
                            <div class="w-8 h-8 bg-primary/10 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-briefcase text-primary"></i>
                            </div>
                            <span>Assistante Financière à l'Office Congolais de Contrôle (OCC)</span>
                        </li>
                        <li class="flex items-center tap-highlight active-state">
                            <div class="w-8 h-8 bg-primary/10 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-building text-primary"></i>
                            </div>
                            <span>Fondatrice d'Okapi Consulting SARL</span>
                        </li>
                        <li class="flex items-center tap-highlight active-state">
                            <div class="w-8 h-8 bg-primary/10 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-heart text-primary"></i>
                            </div>
                            <span>Présidente de la Fondation FME</span>
                        </li>
                        <li class="flex items-center tap-highlight active-state">
                            <div class="w-8 h-8 bg-primary/10 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-award text-primary"></i>
                            </div>
                            <span>Lauréate du Mosala Award 2022</span>
                        </li>
                        <li class="flex items-center tap-highlight active-state">
                            <div class="w-8 h-8 bg-primary/10 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-map-marker-alt text-primary"></i>
                            </div>
                            <span>Kinshasa, RD Congo</span>
                        </li>
                        <li class="flex items-center tap-highlight active-state">
                            <div class="w-8 h-8 bg-primary/10 rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-users text-primary"></i>
                            </div>
                            <span>Impact: 34 979 membres FME</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Domaines d'expertise - Section séparée -->
<section class="py-8 md:py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-8">
            <h2 class="text-2xl md:text-3xl font-serif text-primary mb-4">
                <i class="fas fa-compass mr-2"></i> Domaines d'expertise
            </h2>
            <p class="text-base md:text-lg max-w-3xl mx-auto text-gray-600">
                Explorez les différentes facettes de mon parcours professionnel et personnel
            </p>
        </div>

        <!-- Navigation buttons -->
        <div class="flex justify-between items-center mb-6 px-4">
            <button id="expertise-scroll-left" class="bg-blue-100 text-primary p-4 rounded-full shadow-sm hover:bg-primary hover:text-white transition-all duration-300 focus:outline-none group">
                <i class="fas fa-chevron-left group-hover:-translate-x-1 transition-transform"></i>
            </button>
            <div></div>
            <button id="expertise-scroll-right" class="bg-blue-100 text-primary p-4 rounded-full shadow-sm hover:bg-primary hover:text-white transition-all duration-300 focus:outline-none group">
                <i class="fas fa-chevron-right group-hover:translate-x-1 transition-transform"></i>
            </button>
        </div>

        <!-- Horizontal scroll container -->
        <div class="relative overflow-x-auto pb-4">
            <div id="expertise-carousel" class="flex space-x-6 overflow-x-auto scrollbar-hide snap-x snap-mandatory scroll-smooth px-2">
                <!-- Entrepreneure -->
                <a href="<?= url('entrepreneurship') ?>" class="group flex-shrink-0 w-72 bg-white rounded-xl p-5 shadow-md transition-all duration-300 hover:shadow-lg hover:-translate-y-1 border-l-4 border-primary snap-start">
                    <div class="flex items-center mb-3">
                        <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center mr-3">
                            <i class="fas fa-briefcase text-primary text-xl group-hover:scale-110 transition-transform"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-dark">Entrepreneure</h3>
                    </div>
                    <p class="text-gray-600 text-sm mb-3">Okapi Consulting</p>
                    <div class="text-primary text-sm flex items-center">
                        <span>Découvrir</span>
                        <i class="fas fa-arrow-right ml-2 transition-transform group-hover:translate-x-1"></i>
                    </div>
                </a>

                <!-- Éducation -->
                <a href="<?= url('education') ?>" class="group flex-shrink-0 w-72 bg-white rounded-xl p-5 shadow-md transition-all duration-300 hover:shadow-lg hover:-translate-y-1 border-l-4 border-secondary snap-start">
                    <div class="flex items-center mb-3">
                        <div class="w-12 h-12 rounded-full bg-secondary/10 flex items-center justify-center mr-3">
                            <i class="fas fa-graduation-cap text-secondary text-xl group-hover:scale-110 transition-transform"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-dark">Éducation</h3>
                    </div>
                    <p class="text-gray-600 text-sm mb-3">PhD & MBA</p>
                    <div class="text-secondary text-sm flex items-center">
                        <span>Découvrir</span>
                        <i class="fas fa-arrow-right ml-2 transition-transform group-hover:translate-x-1"></i>
                    </div>
                </a>

                <!-- Activiste -->
                <a href="<?= url('social') ?>" class="group flex-shrink-0 w-72 bg-white rounded-xl p-5 shadow-md transition-all duration-300 hover:shadow-lg hover:-translate-y-1 border-l-4 border-accent snap-start">
                    <div class="flex items-center mb-3">
                        <div class="w-12 h-12 rounded-full bg-accent/10 flex items-center justify-center mr-3">
                            <i class="fas fa-heart text-accent text-xl group-hover:scale-110 transition-transform"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-dark">Activiste</h3>
                    </div>
                    <p class="text-gray-600 text-sm mb-3">Fondation</p>
                    <div class="text-accent text-sm flex items-center">
                        <span>Découvrir</span>
                        <i class="fas fa-arrow-right ml-2 transition-transform group-hover:translate-x-1"></i>
                    </div>
                </a>

                <!-- Récompenses -->
                <a href="<?= url('awards') ?>" class="group flex-shrink-0 w-72 bg-white rounded-xl p-5 shadow-md transition-all duration-300 hover:shadow-lg hover:-translate-y-1 border-l-4 border-amber-500 snap-start">
                    <div class="flex items-center mb-3">
                        <div class="w-12 h-12 rounded-full bg-amber-500/10 flex items-center justify-center mr-3">
                            <i class="fas fa-award text-amber-500 text-xl group-hover:scale-110 transition-transform"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-dark">Récompenses</h3>
                    </div>
                    <p class="text-gray-600 text-sm mb-3">Mosala Awards</p>
                    <div class="text-amber-500 text-sm flex items-center">
                        <span>Découvrir</span>
                        <i class="fas fa-arrow-right ml-2 transition-transform group-hover:translate-x-1"></i>
                    </div>
                </a>

                <!-- Politique -->
                <a href="<?= url('politics') ?>" class="group flex-shrink-0 w-72 bg-white rounded-xl p-5 shadow-md transition-all duration-300 hover:shadow-lg hover:-translate-y-1 border-l-4 border-purple-500 snap-start">
                    <div class="flex items-center mb-3">
                        <div class="w-12 h-12 rounded-full bg-purple-500/10 flex items-center justify-center mr-3">
                            <i class="fas fa-landmark text-purple-500 text-xl group-hover:scale-110 transition-transform"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-dark">Politique</h3>
                    </div>
                    <p class="text-gray-600 text-sm mb-3">Engagement</p>
                    <div class="text-purple-500 text-sm flex items-center">
                        <span>Découvrir</span>
                        <i class="fas fa-arrow-right ml-2 transition-transform group-hover:translate-x-1"></i>
                    </div>
                </a>
            </div>
        </div>

        <!-- Scroll indicators -->
        <div class="flex justify-center space-x-3 mt-6">
            <button class="w-3 h-3 rounded-full bg-blue-200 hover:bg-primary transition-all duration-300 expertise-scroll-indicator active"></button>
            <button class="w-3 h-3 rounded-full bg-blue-200 hover:bg-primary transition-all duration-300 expertise-scroll-indicator"></button>
            <button class="w-3 h-3 rounded-full bg-blue-200 hover:bg-primary transition-all duration-300 expertise-scroll-indicator"></button>
        </div>
    </div>
</section>

<!-- Services Section -->


<!-- Activités Récentes Section -->
<section class="py-16 bg-gradient-to-b from-white to-blue-50 text-dark relative overflow-hidden">
    <!-- Éléments décoratifs de fond -->
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0">
        <div class="absolute top-10 left-[10%] w-72 h-72 rounded-full bg-primary/5 blur-3xl"></div>
        <div class="absolute bottom-10 right-[10%] w-80 h-80 rounded-full bg-secondary/5 blur-3xl"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 rounded-full bg-accent/5 blur-3xl"></div>
    </div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center mb-12">
            <p class="text-primary uppercase tracking-widest font-semibold text-sm animate-fade-in-up">Engagements et Initiatives</p>
            <h2 class="text-3xl md:text-4xl font-serif font-bold mb-4 text-[#072a57] animate-fade-in-up animation-delay-150">Activités Récentes</h2>
            <div class="w-20 h-1 bg-primary mx-auto mb-6 animate-fade-in-up animation-delay-300"></div>
            <p class="max-w-2xl mx-auto text-gray-600 animate-fade-in-up animation-delay-450">
                Découvrez les projets et événements récents auxquels j'ai participé ou que j'ai organisés.
            </p>
        </div>

        <!-- Navigation buttons -->
        <div class="flex justify-between items-center mb-10 px-4">
            <button id="scroll-left" class="bg-blue-100 text-primary p-4 rounded-full shadow-sm hover:bg-primary hover:text-white transition-all duration-300 focus:outline-none group">
                <i class="fas fa-chevron-left group-hover:-translate-x-1 transition-transform"></i>
            </button>
            <a href="<?= url('activities') ?>" class="bg-primary text-white font-semibold px-6 py-3 rounded-full hover:bg-primary/90 transition-all animated-button tap-highlight active-state hover:shadow-lg">
                <i class="fas fa-calendar-alt mr-2"></i> Voir toutes les activités
            </a>
            <button id="scroll-right" class="bg-blue-100 text-primary p-4 rounded-full shadow-sm hover:bg-primary hover:text-white transition-all duration-300 focus:outline-none group">
                <i class="fas fa-chevron-right group-hover:translate-x-1 transition-transform"></i>
            </button>
        </div>

        <!-- Horizontal scroll container -->
        <div class="relative">
            <div id="activities-carousel" class="flex overflow-x-auto scrollbar-hide pb-8 snap-x snap-mandatory scroll-smooth space-x-8">
                <?php if ($upcoming_events): ?>
                    <?php $__loop_items = $upcoming_events; foreach ($upcoming_events as $event): ?>
                    <!-- Événement dynamique -->
                    <a href="<?= url('event_detail', $event->slug) ?>" class="group snap-start flex-shrink-0 w-full md:w-[380px] max-w-[380px]">
                    <div class="rounded-xl overflow-hidden shadow-md transition-all duration-300 hover:shadow-lg border border-blue-100 h-full bg-white">
                            <?php if ($event->featured_image): ?>
                            <div class="h-64 bg-cover bg-center relative" style="background-image: url('<?= e(media_url($event->featured_image ?? '')) ?>');">
                            <?php else: ?>
                            <div class="h-64 bg-gradient-to-br from-primary/20 to-secondary/20 relative flex items-center justify-center">
                            <?php endif; ?>
                            <div class="absolute inset-0 bg-gradient-to-t from-[#1e56a0]/90 via-[#1e56a0]/60 to-transparent opacity-90 group-hover:opacity-75 transition-opacity"></div>
                                <?php if (!$event->featured_image): ?>
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <?php if ($event->event_type === 'conference'): ?>
                                    <i class="fas fa-microphone text-white text-6xl opacity-50"></i>
                                    <?php elseif ($event->event_type === 'training'): ?>
                                    <i class="fas fa-graduation-cap text-white text-6xl opacity-50"></i>
                                    <?php elseif ($event->event_type === 'charity'): ?>
                                    <i class="fas fa-heart text-white text-6xl opacity-50"></i>
                                    <?php elseif ($event->event_type === 'workshop'): ?>
                                    <i class="fas fa-tools text-white text-6xl opacity-50"></i>
                                    <?php elseif ($event->event_type === 'seminar'): ?>
                                    <i class="fas fa-chalkboard-teacher text-white text-6xl opacity-50"></i>
                                    <?php elseif ($event->event_type === 'networking'): ?>
                                    <i class="fas fa-users text-white text-6xl opacity-50"></i>
                                    <?php elseif ($event->event_type === 'award'): ?>
                                    <i class="fas fa-trophy text-white text-6xl opacity-50"></i>
                                    <?php elseif ($event->event_type === 'launch'): ?>
                                    <i class="fas fa-rocket text-white text-6xl opacity-50"></i>
                                    <?php else: ?>
                                    <i class="fas fa-calendar-day text-white text-6xl opacity-50"></i>
                                    <?php endif; ?>
                            </div>
                                <?php endif; ?>
                            <div class="absolute bottom-4 left-4 flex space-x-2">
                                    <span class="bg-primary text-white text-xs px-4 py-1.5 rounded-full font-medium"><?= e(event_type_label($event->event_type ?? '')) ?></span>
                                    <span class="bg-white/80 backdrop-blur-sm text-blue-900 text-xs px-4 py-1.5 rounded-full"><?= e(date('M Y', strtotime((string) ($event->date ?? '')))) ?></span>
                            </div>
                        </div>
                        <div class="p-7">
                                <h3 class="text-xl font-bold mb-4 text-primary group-hover:text-secondary transition-colors"><?= e($event->title) ?></h3>
                                <p class="text-gray-600 mb-5 line-clamp-2 text-sm">
                                    <?php if ($event->excerpt): ?>
                                        <?= e($event->excerpt) ?>
                                    <?php else: ?>
                                        <?= e(truncate_words(strip_tags((string) ($event->description ?? '')), 20)) ?>
                                    <?php endif; ?>
                                </p>
                            <div class="flex justify-between items-center">
                                    <span class="text-xs text-gray-500">
                                        <i class="fas fa-map-marker-alt mr-1"></i>
                                        <?= e($event->location) ?><?php if ($event->city): ?>, <?= e($event->city) ?><?php endif; ?>
                                    </span>
                                <div class="text-primary group-hover:text-secondary group-hover:translate-x-1 transition-all flex items-center font-medium">
                                    Voir plus <i class="fas fa-arrow-right ml-2"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                    <?php endforeach; ?>
                <?php else: ?>
                    <!-- Message si aucun événement à venir -->
                    <div class="flex-shrink-0 w-full md:w-[380px] max-w-[380px] flex items-center justify-center">
                        <div class="text-center py-16">
                            <div class="w-24 h-24 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-6">
                                <i class="fas fa-calendar-alt text-4xl text-primary"></i>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-700 mb-4">Aucun événement à venir</h3>
                            <p class="text-gray-500 max-w-md mx-auto">
                                Les prochains événements seront bientôt publiés. Revenez nous voir régulièrement !
                            </p>
                        </div>
                                </div>
                <?php endif; ?>

            </div>

            <!-- Scroll indicators -->
            <div class="flex justify-center space-x-3 mt-8">
                <button class="w-3 h-3 rounded-full bg-blue-200 hover:bg-primary transition-all duration-300 scroll-indicator active"></button>
                <button class="w-3 h-3 rounded-full bg-blue-200 hover:bg-primary transition-all duration-300 scroll-indicator"></button>
                <button class="w-3 h-3 rounded-full bg-blue-200 hover:bg-primary transition-all duration-300 scroll-indicator"></button>
                <button class="w-3 h-3 rounded-full bg-blue-200 hover:bg-primary transition-all duration-300 scroll-indicator"></button>
                <button class="w-3 h-3 rounded-full bg-blue-200 hover:bg-primary transition-all duration-300 scroll-indicator"></button>
            </div>
        </div>
    </div>
</section>

<style>
/* Styles pour le carrousel d'activités */
.scrollbar-hide::-webkit-scrollbar {
    display: none;
}
.scrollbar-hide {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
.scroll-indicator.active {
    background-color: #23a2f7;
    width: 18px;
    border-radius: 10px;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Carrousel défilement horizontal
    const carousel = document.getElementById('activities-carousel');
    const scrollLeftBtn = document.getElementById('scroll-left');
    const scrollRightBtn = document.getElementById('scroll-right');
    const indicators = document.querySelectorAll('.scroll-indicator');

    if (carousel && scrollLeftBtn && scrollRightBtn) {
        // Défilement vers la gauche
        scrollLeftBtn.addEventListener('click', function() {
            carousel.scrollBy({ left: -400, behavior: 'smooth' });
            updateIndicators();
        });

        // Défilement vers la droite
        scrollRightBtn.addEventListener('click', function() {
            carousel.scrollBy({ left: 400, behavior: 'smooth' });
            updateIndicators();
        });

        // Mettre à jour les indicateurs
        function updateIndicators() {
            const scrollPercentage = carousel.scrollLeft / (carousel.scrollWidth - carousel.clientWidth);
            const activeIndex = Math.min(
                Math.floor(scrollPercentage * indicators.length),
                indicators.length - 1
            );

            indicators.forEach((indicator, index) => {
                if (index === activeIndex) {
                    indicator.classList.add('active');
                } else {
                    indicator.classList.remove('active');
                }
            });
        }

        // Écouter le défilement pour mettre à jour les indicateurs
        carousel.addEventListener('scroll', updateIndicators);

        // Cliquer sur les indicateurs pour naviguer
        indicators.forEach((indicator, index) => {
            indicator.addEventListener('click', function() {
                const itemWidth = carousel.querySelector('a').offsetWidth + 32; // width + margin
                const scrollPosition = index * itemWidth;
                carousel.scrollTo({ left: scrollPosition, behavior: 'smooth' });
            });
        });

        // Initialiser les indicateurs
        updateIndicators();

        // Ajouter effet de survol pour les cartes d'activités
        const activityCards = carousel.querySelectorAll('.group');
        activityCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.querySelector('h3').classList.add('text-secondary');
            });
            card.addEventListener('mouseleave', function() {
                if (!this.classList.contains('active')) {
                    this.querySelector('h3').classList.remove('text-secondary');
                }
            });
        });
    }

    // Carrousel défilement horizontal pour domaines d'expertise
    const expertiseCarousel = document.getElementById('expertise-carousel');
    const expertiseScrollLeftBtn = document.getElementById('expertise-scroll-left');
    const expertiseScrollRightBtn = document.getElementById('expertise-scroll-right');
    const expertiseIndicators = document.querySelectorAll('.expertise-scroll-indicator');

    if (expertiseCarousel && expertiseScrollLeftBtn && expertiseScrollRightBtn) {
        // Défilement vers la gauche
        expertiseScrollLeftBtn.addEventListener('click', function() {
            expertiseCarousel.scrollBy({ left: -300, behavior: 'smooth' });
            updateExpertiseIndicators();
        });

        // Défilement vers la droite
        expertiseScrollRightBtn.addEventListener('click', function() {
            expertiseCarousel.scrollBy({ left: 300, behavior: 'smooth' });
            updateExpertiseIndicators();
        });

        // Mettre à jour les indicateurs
        function updateExpertiseIndicators() {
            const scrollPercentage = expertiseCarousel.scrollLeft / (expertiseCarousel.scrollWidth - expertiseCarousel.clientWidth);
            const activeIndex = Math.min(
                Math.floor(scrollPercentage * expertiseIndicators.length),
                expertiseIndicators.length - 1
            );

            expertiseIndicators.forEach((indicator, index) => {
                if (index === activeIndex) {
                    indicator.classList.add('active');
                } else {
                    indicator.classList.remove('active');
                }
            });
        }

        // Écouter le défilement pour mettre à jour les indicateurs
        expertiseCarousel.addEventListener('scroll', updateExpertiseIndicators);

        // Cliquer sur les indicateurs pour naviguer
        expertiseIndicators.forEach((indicator, index) => {
            indicator.addEventListener('click', function() {
                const itemWidth = expertiseCarousel.querySelector('a').offsetWidth + 24; // width + margin
                const scrollPosition = index * itemWidth * 2; // Afficher environ 2 items à la fois
                expertiseCarousel.scrollTo({ left: scrollPosition, behavior: 'smooth' });
            });
        });

        // Initialiser les indicateurs
        updateExpertiseIndicators();
    }
});
</script>

<!-- Articles Section -->
<section class="py-16">
    <div class="container px-4 mx-auto">
        <div class="text-center mb-10">
            <p class="text-primary uppercase tracking-widest font-semibold text-sm animate-fade-in-up">Mes Publications</p>
            <h2 class="text-3xl md:text-4xl font-bold mb-4 animate-fade-in-up animation-delay-150">Articles Récents</h2>
            <div class="w-20 h-1 bg-primary mx-auto mb-6 animate-fade-in-up animation-delay-300"></div>
            <p class="max-w-2xl mx-auto text-gray-600 animate-fade-in-up animation-delay-450">
                Découvrez mes réflexions sur le leadership, l'entrepreneuriat et l'éducation en Afrique.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
            <?php $__loop_items = $recent_articles; foreach ($recent_articles as $article): ?>
            <div class="glass rounded-xl shadow-md overflow-hidden hover-lift tap-highlight active-state transition-all duration-300 hover:shadow-xl">
                <?php if ($article->featured_image): ?>
                <div class="h-48 bg-cover bg-center" style="background-image: url('<?= e(media_url($article->featured_image ?? '')) ?>');">
                    <div class="h-full w-full bg-gradient-to-t from-dark/70 to-transparent/20 flex items-end">
                        <div class="p-4 text-white">
                            <span class="bg-primary/80 text-white text-xs px-2 py-1 rounded-full"><?= e($article->getCategoryDisplay()) ?></span>
                        </div>
                    </div>
                </div>
                <?php else: ?>
                <div class="h-48 bg-gradient-to-br from-primary/20 to-secondary/20 flex items-center justify-center">
                    <div class="text-center text-gray-600">
                        <i class="fas fa-newspaper text-4xl mb-2"></i>
                        <p class="text-sm"><?= e($article->getCategoryDisplay()) ?></p>
                    </div>
                </div>
                <?php endif; ?>
                <div class="p-4 md:p-6">
                    <h3 class="text-lg font-semibold mb-2 line-clamp-2"><?= e($article->title) ?></h3>
                    <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                        <?php if ($article->excerpt): ?>
                            <?= e($article->excerpt) ?>
                        <?php else: ?>
                            <?= e(truncate_words(strip_tags((string) ($article->content ?? '')), 20)) ?>
                        <?php endif; ?>
                    </p>
                    <div class="flex justify-between items-center">
                        <span class="text-xs text-gray-500">
                            <i class="far fa-calendar-alt mr-1"></i> <?= e(date('d M Y', strtotime((string) ($article->created_at ?? '')))) ?>
                            <i class="far fa-eye ml-3 mr-1"></i> <?= e($article->views) ?>
                        </span>
                        <a href="<?= url('blog_detail', $article->slug) ?>" class="text-primary hover:text-accent flex items-center text-sm">
                            Lire plus <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
<?php if (empty($__loop_items ?? [])): ?>

            <!-- Message quand aucun article n'est disponible -->
            <div class="col-span-full text-center py-12">
                <div class="glass rounded-xl p-8 max-w-md mx-auto">
                    <i class="fas fa-newspaper text-4xl text-gray-400 mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-600 mb-2">Aucun article disponible</h3>
                    <p class="text-gray-500 mb-4">Les articles récents apparaîtront ici une fois publiés.</p>
                    <a href="<?= url('blog') ?>" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary/90 transition-colors">
                        <i class="fas fa-book-reader mr-2"></i>Voir le blog
                    </a>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <div class="text-center">
            <a href="<?= url('blog') ?>" class="bg-primary text-white px-4 md:px-6 py-2 md:py-3 rounded-full hover:bg-opacity-90 transition-colors inline-block animated-button tap-highlight active-state hover:scale-105">
                <i class="fas fa-book-reader mr-2"></i> Voir tous les articles
            </a>
        </div>
    </div>
</section>

<!-- Foundation Section -->
<section class="py-12 md:py-16 bg-accent relative overflow-hidden">
    <!-- Background blobs -->
    <div class="absolute -top-16 md:-top-24 -left-16 md:-left-24 w-40 md:w-64 h-40 md:h-64 bg-primary/20 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 right-0 w-60 md:w-96 h-60 md:h-96 bg-secondary/10 rounded-full blur-3xl"></div>

    <div class="container mx-auto px-4 relative z-10 text-white">
        <div class="flex flex-col md:flex-row items-center gap-8 md:gap-12">
            <div class="w-full md:w-1/2">
                <h2 class="text-2xl md:text-3xl font-serif mb-4 md:mb-6">
                    <i class="fas fa-heart mr-2"></i> Fondation Maboko Ya Elikia
                </h2>
                <p class="text-base md:text-lg mb-3 md:mb-4">
                    La Fondation Maboko Ya Elikia (Mains d'Espoir) travaille à améliorer les conditions des femmes, des jeunes et des populations vulnérables en RDC.
                </p>
                <p class="text-base md:text-lg mb-5 md:mb-6">
                    Nos activités principales incluent la formation professionnelle, la distribution de kits scolaires et le financement des initiatives commerciales de femmes.
                </p>

                <div class="grid grid-cols-2 gap-4 md:gap-6 mb-6 md:mb-8">
                    <div class="glass text-center p-3 md:p-4 rounded-xl tap-highlight active-state transition-transform duration-300 hover:scale-105">
                        <span class="text-2xl md:text-4xl font-bold block">500+</span>
                        <span class="text-sm md:text-base">Femmes formées</span>
                    </div>
                    <div class="glass text-center p-3 md:p-4 rounded-xl tap-highlight active-state transition-transform duration-300 hover:scale-105">
                        <span class="text-2xl md:text-4xl font-bold block">1000+</span>
                        <span class="text-sm md:text-base">Kits scolaires</span>
                    </div>
                    <div class="glass text-center p-3 md:p-4 rounded-xl tap-highlight active-state transition-transform duration-300 hover:scale-105">
                        <span class="text-2xl md:text-4xl font-bold block">200+</span>
                        <span class="text-sm md:text-base">Micro-entreprises</span>
                    </div>
                    <div class="glass text-center p-3 md:p-4 rounded-xl tap-highlight active-state transition-transform duration-300 hover:scale-105">
                        <span class="text-2xl md:text-4xl font-bold block">10+</span>
                        <span class="text-sm md:text-base">Communautés</span>
                    </div>
                </div>

                <div class="flex flex-wrap gap-3 md:gap-4">
                    <a href="https://fondationmabokoyaelikia.org" class="bg-white text-accent px-4 md:px-6 py-2 md:py-3 rounded-full hover:bg-opacity-90 transition-colors inline-block animated-button tap-highlight active-state hover:scale-105">
                        <i class="fas fa-info-circle mr-2"></i> En savoir plus
                    </a>
                    <a href="https://fondationmabokoyaelikia.org/don" class="bg-transparent border-2 border-white text-white px-4 md:px-6 py-2 md:py-3 rounded-full hover:bg-white hover:text-accent transition-colors inline-block animated-button tap-highlight active-state hover:scale-105">
                        <i class="fas fa-donate mr-2"></i> Faire un don
                    </a>
                </div>
            </div>
            <div class="w-full md:w-1/2 mt-6 md:mt-0">
                <div class="grid grid-cols-2 gap-3 md:gap-4">
                    <img src="<?= asset('images/home/fondation.jpg') ?>" alt="Foundation" class="rounded-xl shadow-lg w-full h-40 md:h-56 object-cover hover-lift floating transition-transform duration-300 hover:scale-105">
                    <img src="<?= asset('images/home/meres.jpg') ?>" alt="Foundation" class="rounded-xl shadow-lg w-full h-40 md:h-56 object-cover hover-lift floating-slow transition-transform duration-300 hover:scale-105">
                    <img src="<?= asset('images/home/formation.jpeg') ?>" alt="Foundation" class="rounded-xl shadow-lg w-full h-40 md:h-56 object-cover hover-lift floating-fast transition-transform duration-300 hover:scale-105">
                    <img src="<?= asset('images/home/aide.jpeg') ?>" alt="Foundation" class="rounded-xl shadow-lg w-full h-40 md:h-56 object-cover hover-lift floating transition-transform duration-300 hover:scale-105">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-12 md:py-16 bg-primary text-white relative overflow-hidden">
    <!-- Background blobs -->
    <div class="absolute top-0 right-0 w-40 md:w-64 h-40 md:h-64 bg-white/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-40 md:w-64 h-40 md:h-64 bg-secondary/20 rounded-full blur-3xl"></div>

    <div class="container mx-auto px-4 text-center relative z-10">
        <h2 class="text-2xl md:text-3xl font-serif mb-4 md:mb-6">
            <i class="fas fa-hands-helping mr-2"></i> Rejoignez notre mission
        </h2>
        <p class="text-base md:text-lg max-w-3xl mx-auto mb-6 md:mb-8">
            Ensemble, nous pouvons faire une différence significative dans la vie de nombreuses personnes.
            Contactez-nous pour collaborer, faire un don ou participer à nos activités.
        </p>
        <div class="flex flex-wrap justify-center gap-3 md:gap-4">
            <a href="<?= url('contact') ?>" class="bg-white text-primary px-4 md:px-6 py-2 md:py-3 rounded-full hover:bg-opacity-90 transition-colors animated-button tap-highlight active-state hover:scale-105">
                <i class="fas fa-envelope mr-2"></i> Contactez-nous
            </a>
            <a href="<?= url('foundation') ?>" class="bg-transparent border-2 border-white text-white px-4 md:px-6 py-2 md:py-3 rounded-full hover:bg-white hover:text-primary transition-colors animated-button tap-highlight active-state hover:scale-105">
                <i class="fas fa-donate mr-2"></i> Faire un don
            </a>
        </div>
    </div>
</section>

<!-- Photo Showcase Section - Intégration de la photo supprimée de la section À propos -->
<section class="py-12 md:py-16 bg-white relative overflow-hidden">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row items-center gap-8">
            <div class="w-full md:w-1/2 relative" data-aos="fade-right">
                <div class="absolute top-0 left-0 w-full h-full bg-primary/10 rounded-2xl transform rotate-3"></div>
                <img src="<?= asset('images/home/about.png') ?>" alt="Jessica Bussa" class="rounded-2xl shadow-lg w-full hover-lift relative z-10 transition-transform duration-300 hover:scale-105">
            </div>
            <div class="w-full md:w-1/2" data-aos="fade-left">
                <h2 class="text-2xl md:text-3xl font-serif text-primary mb-4">
                    <i class="fas fa-quote-left mr-2"></i> Ma Vision
                </h2>
                <p class="text-base md:text-lg mb-5 italic">
                    "Je crois fermement que l'autonomisation des femmes et l'éducation sont les piliers du développement durable de nos communautés. Mon engagement est de contribuer activement à la transformation sociale et économique en République Démocratique du Congo."
                </p>
                <p class="text-right font-serif text-primary text-lg">- Jessica Bussa</p>

                <div class="flex flex-wrap gap-4 mt-8">
                    <div class="flex items-center">
                        <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center mr-3">
                            <i class="fas fa-users text-primary"></i>
                        </div>
                        <div>
                            <h4 class="font-bold">500+</h4>
                            <p class="text-sm text-gray-600">Femmes formées</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div class="w-12 h-12 rounded-full bg-secondary/10 flex items-center justify-center mr-3">
                            <i class="fas fa-briefcase text-secondary"></i>
                        </div>
                        <div>
                            <h4 class="font-bold">200+</h4>
                            <p class="text-sm text-gray-600">Micro-entreprises</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div class="w-12 h-12 rounded-full bg-accent/10 flex items-center justify-center mr-3">
                            <i class="fas fa-graduation-cap text-accent"></i>
                        </div>
                        <div>
                            <h4 class="font-bold">15+</h4>
                            <p class="text-sm text-gray-600">Ans d'expérience</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Background Elements -->
    <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-primary/5 rounded-full blur-3xl"></div>
    <div class="absolute top-1/4 -left-20 w-40 h-40 bg-secondary/5 rounded-full blur-3xl"></div>
</section>
<?php $extra_js = <<<'HTML_BLOCK'
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animation des éléments au scroll avec une meilleure transition
    const animateOnScroll = function() {
        const elements = document.querySelectorAll('.hover-lift');
        elements.forEach(element => {
            const position = element.getBoundingClientRect();
            // Si l'élément est visible
            if(position.top < window.innerHeight && position.bottom >= 0) {
                element.style.opacity = '1';
                element.style.transform = 'translateY(0)';
            }
        });
    };

    // Initialisation des animations
    window.addEventListener('scroll', animateOnScroll);
    animateOnScroll(); // Pour les éléments visibles au chargement

    // Effet typewriter avancé avec plusieurs phrases
    const phrases = [
        "Mon plus grand privilège n'est pas ce que je possède",
        "mais ce que je peux offrir aux autres.",
        "Car c'est dans le don de soi qu'est naît la vraie grandeur",
        "Investir dans les femmes, c'est investir dans l'avenir.",
        "Ensemble, créons un monde d'égalité et d'opportunités.",
        "L'entrepreneuriat, c'est croire en ses idées et",
        "oser bâtir un monde meilleur malgré les obstacles",
        "La politique n'est pas seulement l'art de gouverner,",
        "mais celui d'écouter, de rassembler et ",
        "de construire l'avenir avec courage et vision.",
        "Servir dans l'administration publique, ",
        "c'est choisir de mettre ses compétences",
        "au service du bien commun et ",
        "de bâtir une société plus juste et plus efficace.",
    ];

    const typewriterElement = document.getElementById('typewriter');
    const mobileTypewriterElement = document.getElementById('typewriter-mobile');
    let phraseIndex = 0;
    let charIndex = 0;
    let isDeleting = false;

    function type() {
        if (!typewriterElement) return;

        const currentPhrase = phrases[phraseIndex];
        const displayedText = currentPhrase.substring(0, charIndex);

        typewriterElement.textContent = displayedText;
        if (mobileTypewriterElement) {
            mobileTypewriterElement.textContent = displayedText;
        }

        // Vitesses d'écriture et de suppression
        let typeSpeed = 100;

        if (!isDeleting && charIndex < currentPhrase.length) {
            // Écriture
            charIndex++;
            setTimeout(type, typeSpeed);
        } else if (isDeleting && charIndex > 0) {
            // Effacement
            charIndex--;
            setTimeout(type, typeSpeed / 2);
        } else {
            // Changement de direction (écriture/effacement)
            isDeleting = !isDeleting;

            if (!isDeleting) {
                // Passer à la phrase suivante après effacement complet
                phraseIndex = (phraseIndex + 1) % phrases.length;
                setTimeout(type, 500); // Pause avant d'écrire la nouvelle phrase
            } else {
                // Pause avant d'effacer
                setTimeout(type, 2000);
            }
        }
    }

    // Démarrer l'effet après un délai initial
    setTimeout(type, 1000);

    // Ajouter la classe active au bon élément de navigation
    const tabItems = document.querySelectorAll('.mobile-tab-item');
    const currentPath = window.location.pathname;

    tabItems.forEach(item => {
        const href = item.getAttribute('href');
        if (currentPath.includes(href) || (href.endsWith('/') && currentPath === href)) {
            item.classList.add('active');
        }
    });

    // Animations au survol pour les images de la fondation
    const foundationImages = document.querySelectorAll('.foundation-section img');
    foundationImages.forEach(img => {
        img.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.05)';
            this.style.boxShadow = '0 10px 25px rgba(0, 0, 0, 0.2)';
        });
        img.addEventListener('mouseleave', function() {
            this.style.transform = '';
            this.style.boxShadow = '';
        });
    });

    // Add hover effect for cards
    const cards = document.querySelectorAll('.group');

    cards.forEach(card => {
        // Add subtle pulse animation on load
        card.classList.add('animate-pulse');
        setTimeout(() => {
            card.classList.remove('animate-pulse');
        }, 2000);

        // Add hover sound effect (optional)
        card.addEventListener('mouseenter', function() {
            const hoverSound = new Audio('/static/sounds/hover.mp3');
            hoverSound.volume = 0.1;
            hoverSound.play().catch(() => {}); // Catch and ignore errors if sound fails to play
        });

        // Add click animation
        card.addEventListener('click', function() {
            this.classList.add('scale-95');
            setTimeout(() => {
                this.classList.remove('scale-95');
            }, 200);
        });
    });
});
</script>
HTML_BLOCK; ?>
