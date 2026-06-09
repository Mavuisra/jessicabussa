<!-- Hero Section -->
<section class="relative bg-gradient-to-r from-gray-900 to-primary text-white py-16">
    <div class="absolute inset-0 bg-gradient-to-r from-gray-900/50 to-primary/50"></div>
    <div class="container mx-auto px-4 relative">
        <div class="max-w-3xl">
            <h1 class="text-4xl font-bold mb-4">Parcours Académique</h1>
            <p class="text-xl mb-6">Un engagement continu envers l'excellence académique et le développement du leadership.</p>
            <div class="flex flex-wrap gap-3">
                <a href="#phd" class="bg-white text-primary hover:bg-gray-100 px-6 py-3 rounded-full transition duration-300">
                    <i class="fas fa-graduation-cap mr-2"></i> Mon PhD
                </a>
                <a href="<?= url('contact') ?>" class="bg-transparent border-2 border-white hover:bg-white hover:text-primary px-6 py-3 rounded-full transition duration-300">
                    <i class="fas fa-envelope mr-2"></i> Contact
                </a>
            </div>
        </div>
    </div>
</section>

<!-- PhD Section -->
<section id="phd" class="py-16 bg-light">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <div class="w-full" data-aos="fade-up">
                <div class="inline-block px-3 py-1 rounded-full bg-primary/10 text-primary text-sm font-semibold mb-4">
                    <i class="fas fa-graduation-cap mr-1"></i> Parcours académique
                </div>
                <h2 class="text-2xl md:text-3xl font-serif text-primary mb-4 md:mb-6">
                    PhD en Leadership Organisationnel
                </h2>
                <p class="text-base md:text-lg mb-3 md:mb-4 text-justify">
                    Dr Jessica Bussa est titulaire d'un Ph.D. en Leadership Organisationnel, avec une spécialisation en leadership féminin. Son doctorat, fruit de plusieurs années de recherche, explore les dynamiques de pouvoir, la gouvernance inclusive et la contribution des femmes à la transformation des organisations.
                </p>
                <p class="text-base md:text-lg mb-3 md:mb-4 text-justify">
                    Elle est également détentrice d'un MBA en Administration des Affaires, d'une Licence en Administration des Affaires, et d'un Graduat en Gestion d'Entreprise, témoignant d'un solide ancrage en sciences de gestion et en management stratégique.
                </p>
                <p class="text-base md:text-lg mb-5 md:mb-6 text-justify">
                    Engagée dans une logique de perfectionnement continu, elle s'est inscrite à une formation en Global Management – Cohorte de juillet 2025, en préparation de son futur Master à Harvard University. Cette formation vise à consolider ses compétences en stratégie internationale, en leadership global et en innovation managériale.
                </p>
                <div class="grid grid-cols-2 gap-3 md:gap-4 mb-6 md:mb-8">
                    <div class="glass p-3 md:p-4 rounded-xl shadow-md">
                        <i class="fas fa-university text-xl md:text-2xl text-primary mb-1 md:mb-2"></i>
                        <h3 class="font-semibold">Université</h3>
                        <p class="text-xs md:text-sm">Beulah Heights University, 2024</p>
                    </div>
                    <div class="glass p-3 md:p-4 rounded-xl shadow-md">
                        <i class="fas fa-book text-xl md:text-2xl text-primary mb-1 md:mb-2"></i>
                        <h3 class="font-semibold">Recherche</h3>
                        <p class="text-xs md:text-sm">Leadership Féminin</p>
                    </div>
                    <div class="glass p-3 md:p-4 rounded-xl shadow-md">
                        <i class="fas fa-award text-xl md:text-2xl text-primary mb-1 md:mb-2"></i>
                        <h3 class="font-semibold">Prochaine Étape</h3>
                        <p class="text-xs md:text-sm">Harvard University, 2025</p>
                    </div>
                    <div class="glass p-3 md:p-4 rounded-xl shadow-md">
                        <i class="fas fa-users text-xl md:text-2xl text-primary mb-1 md:mb-2"></i>
                        <h3 class="font-semibold">Spécialisation</h3>
                        <p class="text-xs md:text-sm">Global Management</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Education Timeline Section -->
<section class="py-16 bg-gray-50">
    <div class="container px-4 mx-auto">
        <div class="text-center mb-10">
            <p class="text-primary uppercase tracking-widest font-semibold text-sm">Mon Parcours</p>
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Parcours Académique</h2>
            <div class="w-20 h-1 bg-primary mx-auto mb-6"></div>
            <p class="max-w-2xl mx-auto text-gray-600">
                Découvrez mon parcours académique, des études de base jusqu'au doctorat et mes projets futurs.
            </p>
        </div>

        <div class="relative max-w-4xl mx-auto">
            <!-- Ligne verticale pour la timeline -->
            <div class="absolute left-1/2 transform -translate-x-1/2 h-full w-1 bg-primary"></div>
            
            <!-- Timeline items -->
            <div class="relative z-10">
                <!-- Future Item -->
                <div class="flex flex-col md:flex-row items-center mb-12">
                    <div class="md:w-1/2 md:pr-8 md:text-right order-2 md:order-1">
                        <div class="glass p-6 rounded-xl shadow-md hover-lift border-l-4 border-amber-500">
                            <h3 class="text-xl font-semibold mb-2">Formation en Global Management</h3>
                            <p class="text-gray-500 text-sm mb-3">Harvard University (États-Unis) - Juillet 2025</p>
                            <p class="text-gray-600">Préparation au Master en Management Global avec focus sur la stratégie internationale, le leadership global et l'innovation managériale.</p>
                        </div>
                    </div>
                    <div class="md:w-1/2 flex justify-center items-center order-1 md:order-2 mb-4 md:mb-0">
                        <div class="w-12 h-12 rounded-full bg-amber-500 flex items-center justify-center shadow-lg">
                            <i class="fas fa-star text-white"></i>
                        </div>
                    </div>
                </div>
                
                <!-- Item 1 -->
                <div class="flex flex-col md:flex-row items-center mb-12">
                    <div class="md:w-1/2 md:pl-8 order-2">
                        <div class="glass p-6 rounded-xl shadow-md hover-lift">
                            <h3 class="text-xl font-semibold mb-2">Doctorat en Leadership Organisationnel</h3>
                            <p class="text-gray-500 text-sm mb-3">Beulah Heights University (États-Unis) - 2021 - 2024</p>
                            <p class="text-gray-600">Spécialisation en leadership féminin avec recherche sur les dynamiques de pouvoir, la gouvernance inclusive et la contribution des femmes à la transformation des organisations.</p>
                        </div>
                    </div>
                    <div class="md:w-1/2 flex justify-center items-center order-1 mb-4 md:mb-0">
                        <div class="w-12 h-12 rounded-full bg-primary flex items-center justify-center shadow-lg">
                            <i class="fas fa-graduation-cap text-white"></i>
                        </div>
                    </div>
                </div>
                
                <!-- Item 2 -->
                <div class="flex flex-col md:flex-row items-center mb-12">
                    <div class="md:w-1/2 md:pr-8 md:text-right order-2 md:order-1">
                        <div class="glass p-6 rounded-xl shadow-md hover-lift">
                            <h3 class="text-xl font-semibold mb-2">Master of Business Administration (MBA)</h3>
                            <p class="text-gray-500 text-sm mb-3">Beulah Heights University (États-Unis) - 2018 - 2020</p>
                            <p class="text-gray-600">MBA en Administration et Gestion des Affaires, renforçant ses compétences en management stratégique.</p>
                        </div>
                    </div>
                    <div class="md:w-1/2 flex justify-center items-center order-1 md:order-2 mb-4 md:mb-0">
                        <div class="w-12 h-12 rounded-full bg-primary flex items-center justify-center shadow-lg">
                            <i class="fas fa-user-graduate text-white"></i>
                        </div>
                    </div>
                </div>
                
                <!-- Item 3 -->
                <div class="flex flex-col md:flex-row items-center mb-12">
                    <div class="md:w-1/2 md:pl-8 order-2">
                        <div class="glass p-6 rounded-xl shadow-md hover-lift">
                            <h3 class="text-xl font-semibold mb-2">Licence en Administration des Affaires</h3>
                            <p class="text-gray-500 text-sm mb-3">Université - 2014 - 2016</p>
                            <p class="text-gray-600">Formation approfondie en sciences de gestion et administration des entreprises.</p>
                        </div>
                    </div>
                    <div class="md:w-1/2 flex justify-center items-center order-1 mb-4 md:mb-0">
                        <div class="w-12 h-12 rounded-full bg-primary flex items-center justify-center shadow-lg">
                            <i class="fas fa-university text-white"></i>
                        </div>
                    </div>
                </div>
                
                <!-- Item 4 -->
                <div class="flex flex-col md:flex-row items-center">
                    <div class="md:w-1/2 md:pr-8 md:text-right order-2 md:order-1">
                        <div class="glass p-6 rounded-xl shadow-md hover-lift">
                            <h3 class="text-xl font-semibold mb-2">Graduat en Gestion d'Entreprise</h3>
                            <p class="text-gray-500 text-sm mb-3">Université - 2010 - 2013</p>
                            <p class="text-gray-600">Formation initiale en gestion d'entreprise, établissant les bases solides de son parcours académique.</p>
                        </div>
                    </div>
                    <div class="md:w-1/2 flex justify-center items-center order-1 md:order-2 mb-4 md:mb-0">
                        <div class="w-12 h-12 rounded-full bg-primary flex items-center justify-center shadow-lg">
                            <i class="fas fa-school text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Publications Section -->
<section class="py-16">
    <div class="container px-4 mx-auto">
        <div class="text-center mb-10">
            <p class="text-primary uppercase tracking-widest font-semibold text-sm">Recherche</p>
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Publications Académiques</h2>
            <div class="w-20 h-1 bg-primary mx-auto mb-6"></div>
            <p class="max-w-2xl mx-auto text-gray-600">
                Mes contributions à la recherche académique sur le leadership et le développement.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10 max-w-4xl mx-auto">
            <!-- Publication 1 -->
            <div class="glass p-6 rounded-xl shadow-md hover-lift">
                <div class="flex items-center mb-3">
                    <i class="fas fa-file-alt text-2xl text-primary mr-3"></i>
                    <h3 class="text-xl font-semibold">L'Impact du Leadership Féminin dans les Organisations Africaines</h3>
                </div>
                <p class="text-gray-500 text-sm mb-3">Journal of Organizational Leadership, Vol. 24, 2019</p>
                <p class="text-gray-600 mb-4">Une analyse des styles de leadership féminins et leur impact sur la performance des organisations en Afrique subsaharienne.</p>
            </div>
            
            <!-- Publication 2 -->
            <div class="glass p-6 rounded-xl shadow-md hover-lift">
                <div class="flex items-center mb-3">
                    <i class="fas fa-file-alt text-2xl text-primary mr-3"></i>
                    <h3 class="text-xl font-semibold">Les Défis de l'Administration Publique en Afrique Centrale</h3>
                </div>
                <p class="text-gray-500 text-sm mb-3">Public Administration Review, Vol. 15, 2018</p>
                <p class="text-gray-600 mb-4">Étude comparative des systèmes administratifs et des défis de gouvernance dans les pays d'Afrique centrale.</p>
            </div>
            
            <!-- Publication 3 -->
            <div class="glass p-6 rounded-xl shadow-md hover-lift">
                <div class="flex items-center mb-3">
                    <i class="fas fa-file-alt text-2xl text-primary mr-3"></i>
                    <h3 class="text-xl font-semibold">L'Entrepreneuriat Féminin comme Moteur de Développement</h3>
                </div>
                <p class="text-gray-500 text-sm mb-3">Journal of Development Economics, Vol. 32, 2017</p>
                <p class="text-gray-600 mb-4">Analyse du rôle des femmes entrepreneures dans le développement économique local et la réduction de la pauvreté.</p>
            </div>
            
            <!-- Publication 4 -->
            <div class="glass p-6 rounded-xl shadow-md hover-lift">
                <div class="flex items-center mb-3">
                    <i class="fas fa-file-alt text-2xl text-primary mr-3"></i>
                    <h3 class="text-xl font-semibold">Modèles de Leadership Adaptés au Contexte Culturel Africain</h3>
                </div>
                <p class="text-gray-500 text-sm mb-3">International Journal of Cross-Cultural Management, Vol. 8, 2016</p>
                <p class="text-gray-600 mb-4">Développement d'un cadre théorique pour des modèles de leadership culturellement adaptés au contexte africain.</p>
            </div>
        </div>
    </div>
</section>

<!-- Gallery Section -->
<section class="py-16 bg-gray-50">
    <div class="container px-4 mx-auto">
        <div class="text-center mb-10">
            <p class="text-primary uppercase tracking-widest font-semibold text-sm">Souvenirs</p>
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Galerie Éducative</h2>
            <div class="w-20 h-1 bg-primary mx-auto mb-6"></div>
            <p class="max-w-2xl mx-auto text-gray-600">
                Quelques moments importants de mon parcours académique.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            <?php $__loop_items = $education_gallery; foreach ($education_gallery as $item): ?>
            <div class="rounded-xl overflow-hidden shadow-md hover-lift transition-transform duration-300 hover:scale-105">
                <?php if ($item->is_video): ?>
                <div class="aspect-w-16 aspect-h-9">
                    <iframe src="<?= e($item->video_url) ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                <div class="p-3 bg-white">
                    <p class="text-sm text-gray-600"><?= e($item->title) ?></p>
                </div>
                <?php else: ?>
                <img src="<?= e(media_url($item->image ?? '')) ?>" alt="<?= e($item->title) ?>" class="w-full h-48 object-cover">
                <div class="p-3 bg-white">
                    <p class="text-sm text-gray-600"><?= e($item->title) ?></p>
                </div>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
<?php if (empty($__loop_items ?? [])): ?>

            <div class="col-span-full text-center py-10">
                <p class="text-gray-500">Galerie en cours de mise à jour.</p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-12 bg-primary text-white relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-r from-primary/20 to-primary/10"></div>
    <div class="container mx-auto px-4 text-center relative">
        <h2 class="text-2xl md:text-3xl font-serif mb-4">
            <i class="fas fa-book-reader mr-2"></i> Apprenons Ensemble
        </h2>
        <p class="text-base md:text-lg max-w-3xl mx-auto mb-6">
            Intéressé par mes recherches ou mes domaines d'expertise? 
            Contactez-moi pour des collaborations académiques, conférences ou formations.
        </p>
        <div class="flex flex-wrap justify-center gap-3">
            <a href="<?= url('contact') ?>" class="bg-white text-primary px-6 py-3 rounded-full hover:bg-opacity-90 transition-colors">
                <i class="fas fa-envelope mr-2"></i> Me Contacter
            </a>
            <a href="<?= url('activities') ?>" class="bg-transparent border-2 border-white text-white px-6 py-3 rounded-full hover:bg-white hover:text-primary transition-colors">
                <i class="fas fa-calendar-alt mr-2"></i> Mes Activités
            </a>
        </div>
    </div>
</section>