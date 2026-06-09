<!-- Hero Section -->
<section class="relative pt-24 pb-16 md:pb-24 bg-gradient-to-r from-green-800 to-blue-700 text-white">
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-green-800 to-blue-700 opacity-70"></div>
        <img src="<?= asset('images/jessica.png') ?>" alt="Background" class="absolute w-full h-full object-cover opacity-10">
    </div>
    
    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center max-w-3xl mx-auto">
            <div class="mb-8 text-center">
                <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-white bg-opacity-20 text-white text-5xl mb-6">
                    <i class="fas fa-check"></i>
                </div>
            </div>
            <h1 class="text-4xl md:text-5xl font-bold mb-4 animate-text-1">Message Envoyé !</h1>
            <p class="text-xl md:text-2xl opacity-90 mb-8 animate-text-2">Votre message a été envoyé avec succès. Je vous répondrai dans les plus brefs délais.</p>
            
            <div class="mt-10">
                <a href="<?= url('home') ?>" class="inline-flex items-center btn-gradient px-6 py-3 rounded-lg text-white font-medium text-lg hover:shadow-lg transition-all">
                    <i class="fas fa-home mr-2"></i> Retour à l'accueil
                </a>
                <a href="<?= url('contact') ?>" class="inline-flex items-center ml-4 bg-white text-blue-700 px-6 py-3 rounded-lg font-medium text-lg hover:shadow-lg transition-all">
                    <i class="fas fa-envelope mr-2"></i> Nouveau message
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Additional Info Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto text-center">
            <h2 class="text-3xl font-bold mb-8 text-gradient">Que faire maintenant ?</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-10">
                <!-- Option 1 -->
                <div class="p-6 bg-gray-50 rounded-lg hover:shadow-md transition-all">
                    <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-blue-300 text-white rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-newspaper text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Explorez le blog</h3>
                    <p class="text-gray-600 mb-4">Découvrez mes derniers articles sur le leadership et l'entrepreneuriat.</p>
                    <a href="<?= url('blog') ?>" class="text-blue-600 font-medium hover:underline">
                        Lire les articles <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
                
                <!-- Option 2 -->
                <div class="p-6 bg-gray-50 rounded-lg hover:shadow-md transition-all">
                    <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-blue-300 text-white rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-images text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Visitez la galerie</h3>
                    <p class="text-gray-600 mb-4">Parcourez les photos et vidéos de mes activités et événements.</p>
                    <a href="<?= url('gallery') ?>" class="text-blue-600 font-medium hover:underline">
                        Voir la galerie <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
                
                <!-- Option 3 -->
                <div class="p-6 bg-gray-50 rounded-lg hover:shadow-md transition-all">
                    <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-blue-300 text-white rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-hands-helping text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Fondation</h3>
                    <p class="text-gray-600 mb-4">Découvrez les actions de la Fondation Maboko Ya Elikia et comment y contribuer.</p>
                    <a href="https://fondationmabokoyaelikia.org/" class="text-blue-600 font-medium hover:underline">
                        En savoir plus <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>