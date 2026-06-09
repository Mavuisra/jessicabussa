// Gestion de la navigation mobile
document.addEventListener('DOMContentLoaded', function() {
    // Ajouter la classe pour le padding dans le body
    if (document.querySelector('.mobile-tab-bar')) {
        document.body.classList.add('has-mobile-nav');
    }

    // Gestion du menu mobile
    const menuToggle = document.getElementById('menuToggle');
    const mobileFullMenu = document.getElementById('mobileFullMenu');
    
    if (menuToggle && mobileFullMenu) {
        menuToggle.addEventListener('click', function() {
            mobileFullMenu.classList.toggle('open');
            document.body.classList.toggle('menu-open');
        });
        
        // Fermer le menu en cliquant à l'extérieur
        document.addEventListener('click', function(e) {
            if (mobileFullMenu.classList.contains('open') && 
                !mobileFullMenu.contains(e.target) && 
                e.target !== menuToggle) {
                mobileFullMenu.classList.remove('open');
                document.body.classList.remove('menu-open');
            }
        });
    }
    
    // Gestion des animations d'apparition
    const handleScrollAnimation = () => {
        const elements = document.querySelectorAll('.fade-in');
        elements.forEach(el => {
            const elementTop = el.getBoundingClientRect().top;
            const elementVisible = 150;
            if (elementTop < window.innerHeight - elementVisible) {
                el.classList.add('visible');
            }
        });
    };
    
    // Activer les animations au défilement
    window.addEventListener('scroll', handleScrollAnimation);
    handleScrollAnimation();
    
    // Contrôle de la visibilité de la barre mobile pendant le défilement
    let lastScrollTop = 0;
    const mobileTabBar = document.querySelector('.mobile-tab-bar');
    
    if (mobileTabBar) {
        window.addEventListener('scroll', function() {
            let currentScroll = window.pageYOffset || document.documentElement.scrollTop;
            
            // Seuil minimum pour activer le comportement (évite les microdéfilements)
            if (Math.abs(lastScrollTop - currentScroll) < 10) return;
            
            // Si on défile vers le bas et qu'on n'est pas tout en haut
            if (currentScroll > lastScrollTop && currentScroll > 100) {
                mobileTabBar.style.transform = 'translateY(100%)';
            } else {
                // Défilement vers le haut ou en haut de la page
                mobileTabBar.style.transform = 'translateY(0)';
            }
            
            lastScrollTop = currentScroll;
        }, { passive: true });
    }
    
    // Gestion de l'onglet actif
    const setActiveTab = () => {
        const mobileTabItems = document.querySelectorAll('.mobile-tab-item');
        const currentPath = window.location.pathname;
        
        mobileTabItems.forEach(item => {
            const link = item.getAttribute('data-href') || '';
            
            // Vérifier si le lien correspond à la page actuelle
            if (currentPath === link || 
                (link !== '/' && currentPath.startsWith(link))) {
                item.classList.add('active');
            } else if (currentPath === '/' && link === '/') {
                item.classList.add('active');
            } else {
                item.classList.remove('active');
            }
        });
    };
    
    setActiveTab();
    
    // Ajouter des retours tactiles
    const addTouchFeedback = () => {
        const touchElements = document.querySelectorAll('.active-state');
        
        touchElements.forEach(element => {
            element.addEventListener('touchstart', function() {
                this.classList.add('active');
            }, { passive: true });
            
            element.addEventListener('touchend', function() {
                this.classList.remove('active');
            }, { passive: true });
            
            element.addEventListener('touchcancel', function() {
                this.classList.remove('active');
            }, { passive: true });
        });
    };
    
    addTouchFeedback();
}); 