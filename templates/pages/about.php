<!-- Hero Section -->
<section class="relative overflow-hidden">
    <!-- Hero background with overlay -->
    <div class="w-full h-[60vh] md:h-[50vh] bg-cover bg-center" style="background-image: url('<?= asset('images/baleniere.png') ?>');">
        <div class="absolute inset-0 bg-gradient-to-r from-primary/90 to-primary/70"></div>
        <div class="absolute inset-0 flex items-center justify-center">
            <div class="text-center text-white z-10 px-4 animate-text-1">
                <h1 class="text-4xl md:text-5xl font-serif mb-4 md:mb-6">À propos de Jessica Bussa</h1>
                <p class="text-xl md:text-2xl animate-text-2">Entrepreneure | Leader | Activiste sociale</p>
                <!-- Decorative elements -->
                <div class="mt-8 flex justify-center space-x-4">
                    <div class="w-2 h-2 bg-white rounded-full animate-pulse"></div>
                    <div class="w-2 h-2 bg-white rounded-full animate-pulse delay-100"></div>
                    <div class="w-2 h-2 bg-white rounded-full animate-pulse delay-200"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Floating decorative elements -->
    <div class="absolute top-1/4 right-1/4 w-16 md:w-24 h-16 md:h-24 rounded-full bg-secondary/30 blur-xl floating-slow"></div>
    <div class="absolute bottom-1/3 right-1/3 w-20 md:w-32 h-20 md:h-32 rounded-full bg-white/20 blur-xl floating"></div>
</section>

<!-- Biography Section -->
<section class="py-12 md:py-16 bg-white relative overflow-hidden">
    <!-- Background decorative elements -->
    <div class="absolute -top-24 -left-24 w-64 h-64 bg-primary/5 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-secondary/5 rounded-full blur-3xl"></div>
    
    <div class="container mx-auto px-4 relative z-10">
        <div class="flex flex-col md:flex-row gap-8 md:gap-12 items-center">
            <div class="md:w-1/3 fade-in">
                <div class="relative">
                    <img src="<?= asset('images/jessica.png') ?>" alt="Jessica Bussa" class="rounded-2xl shadow-lg w-full hover-lift">
                    <div class="absolute -bottom-3 -right-3 w-24 h-24 bg-primary/10 rounded-full blur-md floating-slow"></div>
                </div>
            </div>
            
            <div class="md:w-2/3 fade-in">
                <h2 class="text-2xl md:text-3xl font-serif text-primary mb-6">
                    <i class="fas fa-user-circle mr-2"></i> Biographie
                </h2>
                
                <p class="text-base md:text-lg mb-4 text-justify">
                    Née et élevée à Kinshasa, Dr Jessica Bussa Nyamboyo est titulaire d'un Ph.D. en leadership organisationnel, avec une spécialisation sur le leadership féminin. Intelligente, rigoureuse, assidue, dynamique et entreprenante, elle est reconnue comme une défenseure engagée de l'égalité des genres dans toutes les sphères de la société, et comme une militante active pour l'autonomisation économique des femmes — un levier qu'elle considère fondamental pour le 
                    Développement socio-économique de la République Démocratique du Congo.
                </p>
                
                <p class="text-base md:text-lg mb-4 text-justify">
                    Depuis six ans, elle occupe diverses fonctions au sein de l'Office Congolais de Contrôle (OCC), où elle a gravi les échelons avec détermination. Elle a débuté en tant qu'Inspectrice de Conformité avant d'assumer le rôle de Responsable des Services Administratifs et Financiers au Département de l'Exportation. À ce poste, elle était notamment en charge de la gestion du personnel, de la planification des formations, de la gestion administrative et financière, ainsi que de l'élaboration et de l'exécution du budget du département. Aujourd'hui, elle occupe le poste d'Assistante Financière auprès de la Direction Générale, où elle supervise l'élaboration, le suivi et l'exécution du budget du secrétariat de la Direction Générale, ainsi que l'évaluation budgétaire des départements et entités provinciales.
                </p>
                
                <p class="text-base md:text-lg mb-4 text-justify">
                    Parallèlement à sa carrière institutionnelle, elle a fondé et dirige Okapi Consulting SARL, une société multi service active dans divers secteurs, notamment le coaching en affaires, l'événementiel via Okapi Events & Catering, le service aux entreprises (mobiliers, décoration intérieur et ameublement, et bientôt dans l'immobilier et l'agriculture. Okapi Consulting SARL incarne la vision de Dr Jessica Bussa en matière de développement inclusif et durable. À travers cette entreprise, elle s'engage activement dans la création d'emplois pour la jeunesse congolaise. Aujourd'hui, plus de 50 jeunes femmes y sont employées en tant qu'hôtesses et agentes de protocole, tandis que de nombreux jeunes hommes sont intégrés dans des services aux entreprises, incluant la fourniture de matériel de bureau, le nettoyage professionnel et d'autres prestations logistiques. Okapi Consulting illustre ainsi un modèle d'entrepreneuriat social qui place l'humain et l'impact communautaire au cœur de ses activités.
                </p>
                
                <p class="text-base md:text-lg mb-4 text-justify">
                    Elle est également la Fondatrice et Présidente de la Fondation FME, une organisation dédiée à l'autonomisation des femmes, des jeunes filles et des enfants. À travers des programmes axés sur l'insertion socio-économique et le développement durable, la Fondation œuvre pour l'amélioration des conditions de vie dans les zones rurales et périurbaines. Elle mène des actions concrètes contre la pauvreté, le chômage, la malnutrition, les violences basées sur le genre, et milite pour un meilleur accès à l'éducation, à la formation professionnelle et à l'équité sociale.
                </p>
                
                <p class="text-base md:text-lg mb-4 text-justify">
                    À ce jour, la Fondation FME a formé plus de 3 000 jeunes dans divers métiers dans les districts de Tshangu et Lukunga, distribué des kits scolaires à plus de 30 000 enfants, et octroyé des financements à plus de 2 500 femmes commerçantes. Elle rassemble aujourd'hui 34 979 membres, engagés autour de ses valeurs et missions.
                </p>
                
                <p class="text-base md:text-lg mb-6 text-justify">
                    Son engagement social a été couronné par plusieurs distinctions. En 2022, elle a reçu le prestigieux Mosala Award dans la catégorie Ambassadrice du social et du développement. Elle est également nominée pour une nouvelle distinction en mai 2025, pour ses actions en faveur de l'éducation des enfants démunis et de l'autonomisation des femmes. Lauréate des Mwasi ya Motuya Awards dans la catégorie Philanthropie et Développement Social, elle incarne une voix forte et visionnaire au service du changement.
                </p>
                
                <div class="glass p-6 rounded-2xl my-8 hover-lift relative overflow-hidden">
                    <div class="absolute -top-6 -right-6 w-12 h-12 rounded-full bg-primary/30 blur-xl floating-fast"></div>
                    <blockquote class="border-l-4 border-primary pl-4 italic text-gray-600 relative z-10">
                        "Je crois fermement que lorsque nous investissons dans les femmes et les jeunes, nous investissons dans l'avenir de notre nation. Mon objectif est de créer des opportunités qui permettent à chacun de réaliser son plein potentiel."
                    </blockquote>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Vision & Values Section -->
<section class="py-12 md:py-16 bg-light relative overflow-hidden">
    <!-- Background blob decoration -->
    <div class="absolute top-0 left-1/2 w-96 h-96 bg-primary/5 rounded-full blur-3xl -translate-x-1/2"></div>
    
    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-4xl mx-auto fade-in">
            <h2 class="text-2xl md:text-3xl font-serif text-primary mb-8 text-center">
                <i class="fas fa-compass mr-2"></i> Vision et Valeurs
            </h2>
            
            <div class="glass rounded-2xl shadow-md p-6 md:p-8 mb-10 hover-lift">
                <h3 class="text-xl md:text-2xl font-semibold mb-4 text-primary">Ma Vision</h3>
                <p class="text-base md:text-lg text-justify">
                    Créer une société où chaque individu, en particulier les femmes et les jeunes, dispose des outils, des ressources et des opportunités nécessaires pour réaliser son plein potentiel et contribuer activement au développement économique et social de la communauté.
                </p>
            </div>
            
            <div class="overflow-x-auto pb-4">
                <div class="flex space-x-6 min-w-max">
                    <div class="glass rounded-2xl p-6 text-center hover-lift tap-highlight active-state relative overflow-hidden min-w-[250px]">
                    <div class="absolute top-0 right-0 w-16 h-16 bg-primary/10 rounded-full blur-md floating-slow -z-10"></div>
                    <div class="w-16 h-16 bg-primary/10 text-primary rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-handshake text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2 text-primary">Intégrité</h3>
                        <p class="text-justify">
                        Agir avec honnêteté, transparence et respect dans toutes mes interactions professionnelles et personnelles.
                    </p>
                </div>
                
                    <div class="glass rounded-2xl p-6 text-center hover-lift tap-highlight active-state relative overflow-hidden min-w-[250px]">
                    <div class="absolute top-0 right-0 w-16 h-16 bg-primary/10 rounded-full blur-md floating-slow -z-10"></div>
                    <div class="w-16 h-16 bg-primary/10 text-primary rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-lightbulb text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2 text-primary">Innovation</h3>
                        <p class="text-justify">
                        Rechercher constamment de nouvelles approches et solutions créatives pour résoudre les défis sociaux et économiques.
                    </p>
                </div>
                
                    <div class="glass rounded-2xl p-6 text-center hover-lift tap-highlight active-state relative overflow-hidden min-w-[250px]">
                    <div class="absolute top-0 right-0 w-16 h-16 bg-primary/10 rounded-full blur-md floating-slow -z-10"></div>
                    <div class="w-16 h-16 bg-primary/10 text-primary rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-users text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2 text-primary">Inclusion</h3>
                        <p class="text-justify">
                        Valoriser la diversité et créer des environnements où chacun se sent respecté, valorisé et habilité à contribuer.
                    </p>
                </div>
                
                    <div class="glass rounded-2xl p-6 text-center hover-lift tap-highlight active-state relative overflow-hidden min-w-[250px]">
                    <div class="absolute top-0 right-0 w-16 h-16 bg-primary/10 rounded-full blur-md floating-slow -z-10"></div>
                    <div class="w-16 h-16 bg-primary/10 text-primary rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-gem text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2 text-primary">Excellence</h3>
                        <p class="text-justify">
                        Viser les plus hauts standards de qualité dans tous les projets et initiatives entrepris.
                    </p>
                </div>
                
                    <div class="glass rounded-2xl p-6 text-center hover-lift tap-highlight active-state relative overflow-hidden min-w-[250px]">
                    <div class="absolute top-0 right-0 w-16 h-16 bg-primary/10 rounded-full blur-md floating-slow -z-10"></div>
                    <div class="w-16 h-16 bg-primary/10 text-primary rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-hands-helping text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2 text-primary">Solidarité</h3>
                        <p class="text-justify">
                        Promouvoir l'entraide et la collaboration pour créer un impact positif durable dans nos communautés.
                    </p>
                </div>
                
                    <div class="glass rounded-2xl p-6 text-center hover-lift tap-highlight active-state relative overflow-hidden min-w-[250px]">
                    <div class="absolute top-0 right-0 w-16 h-16 bg-primary/10 rounded-full blur-md floating-slow -z-10"></div>
                    <div class="w-16 h-16 bg-primary/10 text-primary rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-seedling text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2 text-primary">Durabilité</h3>
                        <p class="text-justify">
                        Développer des initiatives qui créent un impact positif à long terme sur les plans social, économique et environnemental.
                    </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Professional Journey Section -->
<section class="py-12 md:py-16 bg-white relative overflow-hidden">
    <!-- Background blobs -->
    <div class="absolute -left-20 top.20 w-64 h-64 bg-primary/5 rounded-full blur-3xl"></div>
    <div class="absolute -right-20 bottom-20 w-64 h-64 bg-secondary/5 rounded-full blur-3xl"></div>
    
    <div class="container mx-auto px-4 relative z-10">
        <h2 class="text-2xl md:text-3xl font-serif text-primary mb-10 text-center fade-in">
            <i class="fas fa-route mr-2"></i> Parcours Professionnel
        </h2>
        
        <div class="max-w-4xl mx-auto">
            <div class="relative border-l-2 border-primary pl-8 pb-10 fade-in hover-lift">
                <div class="absolute left-0 top-0 w-6 h-6 rounded-full bg-primary transform -translate-x-1/2 shadow-md"></div>
                <div class="mb-4">
                    <span class="glass bg-primary text-white px-4 py-2 rounded-full text-sm shadow-md">Sept. 2021 - Présent</span>
                </div>
                <div class="glass rounded-2xl p-6">
                    <h3 class="text-xl font-semibold mb-2 text-primary">Assistante financière</h3>
                    <p class="text-accent italic mb-4">Office Congolais de Contrôle (OCC), Kinshasa, RDC</p>
                    <p class="text-justify">
                        Responsable de l'élaboration, du suivi et de l'exécution de la ligne budgétaire du département secrétariat de la Direction Générale. Supervision du budget des départements et entités provinciales.
                    </p>
                </div>
            </div>
            
            <div class="relative border-l-2 border-primary pl-8 pb-10 fade-in hover-lift">
                <div class="absolute left-0 top-0 w-6 h-6 rounded-full bg-primary transform -translate-x-1/2 shadow-md"></div>
                <div class="mb-4">
                    <span class="glass bg-primary text-white px-4 py-2 rounded-full text-sm shadow-md">Jan. 2019 - Nov. 2021</span>
                </div>
                <div class="glass rounded-2xl p-6">
                    <h3 class="text-xl font-semibold mb-2 text-primary">Chef de Service Administratif et Financier</h3>
                    <p class="text-accent italic mb-4">Office Congolais de Contrôle (OCC), Kinshasa, RDC</p>
                    <p class="text-justify">
                        Gestion du personnel, planification des formations, suivi administratif, élaboration du budget du département, suivi de l'exécution financière.
                    </p>
                </div>
            </div>
            
            <div class="relative pl-8 fade-in hover-lift">
                <div class="absolute left-0 top-0 w-6 h-6 rounded-full bg-primary transform -translate-x-1/2 shadow-md"></div>
                <div class="mb-4">
                    <span class="glass bg-primary text-white px-4 py-2 rounded-full text-sm shadow-md">Fév. 2018 - Mai 2018</span>
                </div>
                <div class="glass rounded-2xl p-6">
                    <h3 class="text-xl font-semibold mb-2 text-primary">Assistante comptable interne</h3>
                    <p class="text-accent italic mb-4">BIVAC BV RDC</p>
                    <p class="text-justify">
                        Gestion des tâches comptables internes au sein de l'entreprise.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Skills Section -->
<section class="py-12 md:py-16 bg-primary text-white relative overflow-hidden">
    <!-- Background decoration -->
    <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 bg-secondary/20 rounded-full blur-3xl"></div>
    
    <div class="container mx-auto px-4 relative z-10">
        <h2 class="text-2xl md:text-3xl font-serif mb-10 text-center fade-in">
            <i class="fas fa-chart-line mr-2"></i> Compétences Clés
        </h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
            <!-- Compétences Techniques -->
            <div class="fade-in bg-white rounded-2xl p-6 md:p-8 hover-lift h-full flex flex-col shadow-lg transform transition-all duration-300 hover:scale-105">
                <h3 class="text-xl font-semibold mb-6 text-center border-b border-primary/20 pb-3 text-primary">
                    <i class="fas fa-tools mr-2"></i>Compétences Techniques
                </h3>
                
                <div class="space-y-4 flex-grow">
                    <div class="bg-primary/5 rounded-xl p-4 hover:bg-primary/10 transition-colors">
                        <h4 class="font-medium mb-2 text-primary">Gestion Administrative & Financière</h4>
                        <ul class="list-disc list-inside text-sm space-y-1 text-gray-700">
                            <li>Analyse budgétaire</li>
                            <li>Planification stratégique</li>
                            <li>Suivi-évaluation (M&E)</li>
                            <li>Digitalisation administrative</li>
                        </ul>
                    </div>
                    
                    <div class="bg-primary/5 rounded-xl p-4 hover:bg-primary/10 transition-colors">
                        <h4 class="font-medium mb-2 text-primary">Gestion de Projets</h4>
                        <ul class="list-disc list-inside text-sm space-y-1 text-gray-700">
                            <li>Montage de projets</li>
                            <li>Fundraising / Levée de fonds</li>
                            <li>Gestion de partenariats</li>
                            <li>Logistique événementielle</li>
                        </ul>
                    </div>
                    
                    <div class="bg-primary/5 rounded-xl p-4 hover:bg-primary/10 transition-colors">
                        <h4 class="font-medium mb-2 text-primary">Communication & Formation</h4>
                        <ul class="list-disc list-inside text-sm space-y-1 text-gray-700">
                            <li>Rédaction professionnelle</li>
                            <li>Coaching & formation</li>
                            <li>Animation de séances</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <!-- Compétences Personnelles -->
            <div class="fade-in bg-white rounded-2xl p-6 md:p-8 hover-lift h-full flex flex-col shadow-lg transform transition-all duration-300 hover:scale-105">
                <h3 class="text-xl font-semibold mb-6 text-center border-b border-primary/20 pb-3 text-primary">
                    <i class="fas fa-user-tie mr-2"></i>Compétences Personnelles
                </h3>
                
                <div class="space-y-4 flex-grow">
                    <div class="bg-primary/5 rounded-xl p-4 hover:bg-primary/10 transition-colors">
                        <h4 class="font-medium mb-2 text-primary">Leadership & Management</h4>
                        <ul class="list-disc list-inside text-sm space-y-1 text-gray-700">
                            <li>Leadership transformationnel</li>
                            <li>Esprit d'initiative</li>
                            <li>Gestion du temps et des priorités</li>
                            <li>Esprit d'équipe</li>
                        </ul>
                    </div>
                    
                    <div class="bg-primary/5 rounded-xl p-4 hover:bg-primary/10 transition-colors">
                        <h4 class="font-medium mb-2 text-primary">Communication & Relations</h4>
                        <ul class="list-disc list-inside text-sm space-y-1 text-gray-700">
                            <li>Communication interpersonnelle</li>
                            <li>Empathie & intelligence émotionnelle</li>
                            <li>Résolution de problèmes</li>
                        </ul>
                    </div>
                    
                    <div class="bg-primary/5 rounded-xl p-4 hover:bg-primary/10 transition-colors">
                        <h4 class="font-medium mb-2 text-primary">Adaptabilité</h4>
                        <ul class="list-disc list-inside text-sm space-y-1 text-gray-700">
                            <li>Résilience</li>
                            <li>Gestion du stress</li>
                            <li>Capacité d'adaptation</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <!-- Compétences Sectorielles -->
            <div class="fade-in bg-white rounded-2xl p-6 md:p-8 hover-lift h-full flex flex-col shadow-lg transform transition-all duration-300 hover:scale-105">
                <h3 class="text-xl font-semibold mb-6 text-center border-b border-primary/20 pb-3 text-primary">
                    <i class="fas fa-globe mr-2"></i>Compétences Sectorielles
                </h3>
                
                <div class="space-y-4 flex-grow">
                    <div class="bg-primary/5 rounded-xl p-4 hover:bg-primary/10 transition-colors">
                        <h4 class="font-medium mb-2 text-primary">Développement Social</h4>
                        <ul class="list-disc list-inside text-sm space-y-1 text-gray-700">
                            <li>Genre et développement</li>
                            <li>Education & formation professionnelle</li>
                            <li>Insertion socio-économique</li>
                        </ul>
                    </div>
                    
                    <div class="bg-primary/5 rounded-xl p-4 hover:bg-primary/10 transition-colors">
                        <h4 class="font-medium mb-2 text-primary">Entreprise & Innovation</h4>
                        <ul class="list-disc list-inside text-sm space-y-1 text-gray-700">
                            <li>Responsabilité sociétale des entreprises (RSE)</li>
                            <li>Autonomisation digitale</li>
                            <li>Innovation sociale</li>
                        </ul>
                    </div>
                    
                    <div class="bg-primary/5 rounded-xl p-4 hover:bg-primary/10 transition-colors">
                        <h4 class="font-medium mb-2 text-primary">Langues</h4>
                        <ul class="list-disc list-inside text-sm space-y-1 text-gray-700">
                            <li>Français (Natif)</li>
                            <li>Anglais (Courant)</li>
                            <li>Lingala (Natif)</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-12 md:py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center fade-in">
            <h2 class="text-2xl md:text-3xl font-serif text-primary mb-6">
                <i class="fas fa-handshake mr-2"></i> Travaillons ensemble
            </h2>
            <p class="text-base md:text-lg mb-8 text-justify">
                Que vous soyez intéressé par mes services de conseil, désireux de collaborer avec la Fondation FME, ou simplement curieux d'en savoir plus sur mon parcours, n'hésitez pas à me contacter.
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="<?= url('contact') ?>" class="bg-primary text-white px-6 py-3 rounded-full hover:bg-opacity-90 transition-colors flex items-center animated-button tap-highlight active-state">
                    <i class="fas fa-envelope mr-2"></i> Me contacter
                </a>
                <a href="https://fondationmabokoyaelikia.org/" class="bg-accent text-white px-6 py-3 rounded-full hover:bg-opacity-90 transition-colors flex items-center animated-button tap-highlight active-state">
                    <i class="fas fa-heart mr-2"></i> Découvrir la Fondation
                </a>
            </div>
        </div>
    </div>
</section>
<?php $extra_js = <<<'HTML_BLOCK'
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animation des éléments au scroll
    const animateOnScroll = function() {
        const elements = document.querySelectorAll('.fade-in');
        elements.forEach(element => {
            const position = element.getBoundingClientRect();
            // Si l'élément est visible
            if(position.top < window.innerHeight - 100 && position.bottom >= 0) {
                element.classList.add('visible');
            }
        });
    };
    
    // Initialisation
    window.addEventListener('scroll', animateOnScroll, { passive: true });
    animateOnScroll(); // Pour les éléments visibles au chargement
    
    // Ajouter la classe 'fade-in' aux éléments pour l'animation CSS
    document.querySelectorAll('.fade-in').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
    });
    
    // Fonction pour ajouter la classe 'visible' qui déclenche l'animation
    function makeVisible(el) {
        el.style.opacity = '1';
        el.style.transform = 'translateY(0)';
    }
    
    // Observer pour les animations au scroll
    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    makeVisible(entry.target);
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });
        
        document.querySelectorAll('.fade-in').forEach(el => {
            observer.observe(el);
        });
    } else {
        // Fallback pour les navigateurs qui ne supportent pas IntersectionObserver
        document.querySelectorAll('.fade-in').forEach(el => {
            makeVisible(el);
        });
    }

    // Ajout des retours tactiles pour les éléments interactifs
    document.querySelectorAll('.tap-highlight').forEach(el => {
        el.addEventListener('touchstart', function() {
            this.style.transform = 'scale(0.98)';
            this.style.opacity = '0.9';
        }, { passive: true });
        
        el.addEventListener('touchend', function() {
            this.style.transform = '';
            this.style.opacity = '';
        }, { passive: true });
    });
});
</script>
HTML_BLOCK; ?>
