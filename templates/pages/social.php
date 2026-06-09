<!-- Hero Section -->
<section class="relative bg-gradient-to-r from-blue-900 to-accent text-white py-16">
    <div class="absolute inset-0 bg-cover bg-center opacity-20" style="background-image: url('<?= asset('images/home/fondation.jpg') ?>');"></div>
    <div class="container mx-auto px-4 relative">
        <div class="max-w-3xl">
            <h1 class="text-4xl font-bold mb-4">Fondation Maboko Ya Elikia</h1>
            <p class="text-xl mb-6">Des mains tendues vers l'espoir pour les femmes et les jeunes de la République Démocratique du Congo.</p>
            <div class="flex flex-wrap gap-3">
                <a href="#mission" class="bg-white text-accent hover:bg-gray-100 px-6 py-3 rounded-full transition duration-300">
                    <i class="fas fa-heart mr-2"></i> Notre Mission
                </a>
                <a href="<?= url('contact') ?>" class="bg-transparent border-2 border-white hover:bg-white hover:text-accent px-6 py-3 rounded-full transition duration-300">
                    <i class="fas fa-envelope mr-2"></i> Nous Contacter
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Foundation Overview Section -->
<section id="mission" class="py-16 bg-light">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row items-center gap-8 md:gap-12">
            <div class="w-full md:w-1/2" data-aos="fade-right">
                <img src="<?= asset('images/home/fondation.jpg') ?>" alt="Fondation Maboko Ya Elikia" class="rounded-2xl shadow-lg w-full hover-lift">
            </div>
            <div class="w-full md:w-1/2" data-aos="fade-left">
                <div class="inline-block px-3 py-1 rounded-full bg-accent/10 text-accent text-sm font-semibold mb-4">
                    <i class="fas fa-heart mr-1"></i> Notre Engagement
                </div>
                <h2 class="text-2xl md:text-3xl font-serif text-primary mb-4 md:mb-6">
                    À Propos de Maboko Ya Elikia
                </h2>
                <p class="text-base md:text-lg mb-3 md:mb-4">
                    La Fondation Maboko Ya Elikia, qui signifie "Mains d'Espoir" en lingala, est une organisation à but non lucratif fondée par Jessica Bussa en 2016, dédiée à l'autonomisation des femmes et des jeunes en République Démocratique du Congo.
                </p>
                <p class="text-base md:text-lg mb-5 md:mb-6">
                    Notre mission est de transformer des vies à travers l'éducation, la formation professionnelle, le microfinancement et l'accès aux ressources essentielles pour bâtir un avenir meilleur et durable.
                </p>
                <div class="grid grid-cols-2 gap-3 md:gap-4 mb-6 md:mb-8">
                    <div class="glass p-3 md:p-4 rounded-xl shadow-md">
                        <i class="fas fa-users text-xl md:text-2xl text-accent mb-1 md:mb-2"></i>
                        <h3 class="font-semibold">Bénéficiaires</h3>
                        <p class="text-xs md:text-sm">+1500 femmes et jeunes</p>
                    </div>
                    <div class="glass p-3 md:p-4 rounded-xl shadow-md">
                        <i class="fas fa-map-marker-alt text-xl md:text-2xl text-accent mb-1 md:mb-2"></i>
                        <h3 class="font-semibold">Régions</h3>
                        <p class="text-xs md:text-sm">Kinshasa, Nord-Kivu, Équateur</p>
                    </div>
                    <div class="glass p-3 md:p-4 rounded-xl shadow-md">
                        <i class="fas fa-calendar-alt text-xl md:text-2xl text-accent mb-1 md:mb-2"></i>
                        <h3 class="font-semibold">Fondation</h3>
                        <p class="text-xs md:text-sm">Établie en 2016</p>
                    </div>
                    <div class="glass p-3 md:p-4 rounded-xl shadow-md">
                        <i class="fas fa-hands-helping text-xl md:text-2xl text-accent mb-1 md:mb-2"></i>
                        <h3 class="font-semibold">Partenaires</h3>
                        <p class="text-xs md:text-sm">Locaux et internationaux</p>
                    </div>
                </div>
                <a href="https://fondationmabokoyaelikia.org/" target="_blank" class="text-accent hover:text-primary font-medium inline-flex items-center">
                    <span>Visiter le site officiel</span>
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Impact Stats Section -->
<section class="py-16 bg-accent text-white">
    <div class="container px-4 mx-auto">
        <div class="text-center mb-10">
            <p class="uppercase tracking-widest font-semibold text-sm">Notre Impact</p>
            <h2 class="text-3xl md:text-4xl font-bold mb-4">En Chiffres</h2>
            <div class="w-20 h-1 bg-white mx-auto mb-6"></div>
            <p class="max-w-2xl mx-auto">
                Depuis sa création, la Fondation Maboko Ya Elikia a transformé des milliers de vies à travers ses programmes.
            </p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
            <div class="glass text-center p-6 rounded-xl">
                <span class="text-3xl md:text-5xl font-bold block mb-2">500+</span>
                <p class="text-sm md:text-base">Femmes formées en entrepreneuriat</p>
            </div>
            
            <div class="glass text-center p-6 rounded-xl">
                <span class="text-3xl md:text-5xl font-bold block mb-2">1000+</span>
                <p class="text-sm md:text-base">Kits scolaires distribués</p>
            </div>
            
            <div class="glass text-center p-6 rounded-xl">
                <span class="text-3xl md:text-5xl font-bold block mb-2">200+</span>
                <p class="text-sm md:text-base">Micro-entreprises financées</p>
            </div>
            
            <div class="glass text-center p-6 rounded-xl">
                <span class="text-3xl md:text-5xl font-bold block mb-2">10+</span>
                <p class="text-sm md:text-base">Communautés soutenues</p>
            </div>
        </div>
    </div>
</section>

<!-- Key Programs Section -->
<section class="py-16">
    <div class="container px-4 mx-auto">
        <div class="text-center mb-10">
            <p class="text-accent uppercase tracking-widest font-semibold text-sm">Nos Piliers</p>
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Programmes Clés</h2>
            <div class="w-20 h-1 bg-accent mx-auto mb-6"></div>
            <p class="max-w-2xl mx-auto text-gray-600">
                Nos programmes visent à créer un impact durable à travers quatre axes d'intervention principaux.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
            <!-- Programme 1 -->
            <div class="glass rounded-xl overflow-hidden shadow-md hover-lift flex flex-col h-full">
                <div class="h-48 bg-cover bg-center" style="background-image: url('<?= asset('images/home/formation.jpeg') ?>');">
                    <div class="h-full w-full bg-gradient-to-t from-dark/70 to-transparent/20"></div>
                </div>
                <div class="p-6 flex-grow">
                    <h3 class="text-xl font-semibold mb-2">Formation & Entrepreneuriat</h3>
                    <p class="text-gray-600 mb-4">
                        Nous donnons aux femmes les compétences et ressources nécessaires pour créer et développer leurs propres entreprises à travers des formations pratiques, du mentorat et un accès au microfinancement.
                    </p>
                    <div class="flex items-center text-accent mt-auto">
                        <i class="fas fa-users mr-2"></i>
                        <span>500+ femmes autonomisées</span>
                    </div>
                </div>
            </div>
            
            <!-- Programme 2 -->
            <div class="glass rounded-xl overflow-hidden shadow-md hover-lift flex flex-col h-full">
                <div class="h-48 bg-cover bg-center" style="background-image: url('<?= asset('images/home/meres.jpg') ?>');">
                    <div class="h-full w-full bg-gradient-to-t from-dark/70 to-transparent/20"></div>
                </div>
                <div class="p-6 flex-grow">
                    <h3 class="text-xl font-semibold mb-2">Éducation & Avenir</h3>
                    <p class="text-gray-600 mb-4">
                        Notre programme éducatif fournit des kits scolaires, des bourses d'études et du soutien aux enfants défavorisés pour leur permettre d'accéder à une éducation de qualité et construire un meilleur avenir.
                    </p>
                    <div class="flex items-center text-accent mt-auto">
                        <i class="fas fa-book mr-2"></i>
                        <span>1000+ enfants soutenus</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Vision Section -->
<section class="py-16 bg-gray-50">
    <div class="container px-4 mx-auto">
        <div class="flex flex-col md:flex-row items-center gap-8">
            <div class="w-full md:w-1/2">
                <h2 class="text-3xl md:text-4xl font-bold mb-6 text-primary">Notre Vision</h2>
                <p class="text-lg mb-6 text-gray-700">
                    Nous aspirons à un Congo où chaque femme et chaque jeune a les moyens de réaliser son plein potentiel, contribuant ainsi au développement durable de leurs communautés et de la nation.
                </p>
                <p class="text-lg mb-6 text-gray-700">
                    À travers nos programmes, nous travaillons pour réduire la pauvreté, promouvoir l'égalité des sexes et renforcer la résilience communautaire face aux défis socio-économiques.
                </p>
                <div class="flex flex-wrap gap-4 mt-8">
                    <a href="<?= url('contact') ?>" class="bg-accent text-white px-6 py-3 rounded-full hover:bg-opacity-90 transition-colors">
                        <i class="fas fa-hands-helping mr-2"></i> Nous Soutenir
                    </a>
                    <a href="<?= url('contact') ?>" class="border-2 border-accent text-accent px-6 py-3 rounded-full hover:bg-accent hover:text-white transition-colors">
                        <i class="fas fa-envelope mr-2"></i> Nous Contacter
                    </a>
                </div>
            </div>
            <div class="w-full md:w-1/2">
                <div class="grid grid-cols-2 gap-4">
                    <img src="<?= asset('images/home/formation.jpeg') ?>" alt="Formation" class="rounded-xl shadow-md object-cover h-48 w-full">
                    <img src="<?= asset('images/home/meres.jpg') ?>" alt="Mères" class="rounded-xl shadow-md object-cover h-48 w-full">
                    <img src="<?= asset('images/home/aide.jpeg') ?>" alt="Aide" class="rounded-xl shadow-md object-cover h-48 w-full">
                    <img src="<?= asset('images/home/fondation.jpg') ?>" alt="Fondation" class="rounded-xl shadow-md object-cover h-48 w-full">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section (Simplified) -->
<section class="py-16 bg-white">
    <div class="container px-4 mx-auto">
        <div class="text-center mb-10">
            <p class="text-primary uppercase tracking-widest font-semibold text-sm">Témoignages</p>
            <h2 class="text-3xl md:text-4xl font-bold mb-4">L'Impact de Notre Action</h2>
            <div class="w-20 h-1 bg-primary mx-auto mb-6"></div>
        </div>

        <div class="max-w-4xl mx-auto">
            <div class="glass p-8 rounded-xl shadow-md text-center">
                <p class="text-xl italic text-gray-700 mb-6">
                    "La Fondation Maboko Ya Elikia m'a donné les moyens de subvenir aux besoins de ma famille. Grâce à la formation et au prêt reçus, j'ai pu démarrer mon commerce qui aujourd'hui nourrit mes enfants et paie leurs études."
                </p>
                <div class="flex items-center justify-center">
                    <div class="w-16 h-16 rounded-full bg-primary/20 flex items-center justify-center mr-3">
                        <i class="fas fa-user text-2xl text-primary"></i>
                    </div>
                    <div class="text-left">
                        <h4 class="font-semibold">Jeanne Mbala</h4>
                        <p class="text-sm text-gray-500">Bénéficiaire, Programme de Microfinancement</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-12 bg-accent text-white relative overflow-hidden">
    <div class="absolute inset-0 bg-cover bg-center opacity-10" style="background-image: url('<?= asset('images/home/fondation.jpg') ?>');"></div>
    <div class="container mx-auto px-4 text-center relative">
        <h2 class="text-2xl md:text-3xl font-serif mb-4">
            <i class="fas fa-hands-helping mr-2"></i> Découvrez Notre Site Officiel
        </h2>
        <p class="text-base md:text-lg max-w-3xl mx-auto mb-6">
            Visitez notre site web officiel pour en savoir plus sur nos programmes et comment vous pouvez contribuer à notre mission.
        </p>
        <div class="flex flex-wrap justify-center gap-3 mb-6">
            <a href="https://fondationmabokoyaelikia.org/" target="_blank" class="bg-white text-accent px-6 py-3 rounded-full hover:bg-opacity-90 transition-colors">
                <i class="fas fa-external-link-alt mr-2"></i> Visiter le Site Officiel
            </a>
        </div>
        <div class="flex flex-wrap justify-center gap-3">
            <a href="<?= url('contact') ?>" class="bg-white text-accent px-6 py-3 rounded-full hover:bg-opacity-90 transition-colors">
                <i class="fas fa-envelope mr-2"></i> Nous Contacter
            </a>
        </div>
    </div>
</section>