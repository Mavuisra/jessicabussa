<?php $extra_css = <<<'HTML_BLOCK'
<!-- Quill CSS -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<style>
    /* Form Styles */
    .form-container {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 20px;
        padding: 2px;
        margin-bottom: 2rem;
    }
    
    .form-content {
        background: white;
        border-radius: 18px;
        padding: 2rem;
    }
    
    .form-group {
        margin-bottom: 1.5rem;
    }
    
    .form-label {
        display: block;
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.5rem;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    
    .form-input {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: #fafafa;
    }
    
    .form-input:focus {
        outline: none;
        border-color: #4F46E5;
        background: white;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        transform: translateY(-1px);
    }
    
    .form-textarea {
        min-height: 120px;
        resize: vertical;
    }
    
    .form-select {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 0.5rem center;
        background-repeat: no-repeat;
        background-size: 1.5em 1.5em;
        padding-right: 2.5rem;
    }
    
    /* Image Upload Styles */
    .image-upload-area {
        border: 2px dashed #d1d5db;
        border-radius: 12px;
        padding: 2rem;
        text-align: center;
        transition: all 0.3s ease;
        background: #f9fafb;
        cursor: pointer;
    }
    
    .image-upload-area:hover {
        border-color: #4F46E5;
        background: #f0f4ff;
    }
    
    .image-upload-area.dragover {
        border-color: #4F46E5;
        background: #e0e7ff;
        transform: scale(1.02);
    }
    
    .image-preview {
        max-width: 100%;
        max-height: 200px;
        border-radius: 12px;
        margin-top: 1rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        display: none;
    }
    
    /* Editor Styles */
    .editor-container {
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        overflow: hidden;
        background: white;
    }
    
    .editor-toolbar {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        border-bottom: 1px solid #e5e7eb;
        padding: 0.75rem;
    }
    
    .editor-content {
        min-height: 400px;
        padding: 1rem;
        font-size: 16px;
        line-height: 1.6;
    }
    
    /* Action Buttons */
    .btn {
        display: inline-flex;
        align-items: center;
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        font-size: 0.875rem;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #4F46E5 0%, #7C3AED 100%);
        color: white;
        box-shadow: 0 4px 14px 0 rgba(79, 70, 229, 0.3);
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px 0 rgba(79, 70, 229, 0.4);
    }
    
    .btn-secondary {
        background: white;
        color: #6b7280;
        border: 2px solid #e5e7eb;
    }
    
    .btn-secondary:hover {
        background: #f9fafb;
        border-color: #d1d5db;
    }
    
    /* Character Counter */
    .char-counter {
        text-align: right;
        font-size: 0.75rem;
        color: #6b7280;
        margin-top: 0.25rem;
    }
    
    .char-counter.warning {
        color: #f59e0b;
    }
    
    .char-counter.error {
        color: #ef4444;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .form-content {
            padding: 1rem;
        }
        
        .btn {
            width: 100%;
            justify-content: center;
        }
    }
    
    /* Animation */
    .animate-slide-up {
        animation: slideUp 0.5s ease-out;
    }
    
    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
HTML_BLOCK; ?>

<div class="animate-slide-up">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">
                    <i class="fas fa-calendar-plus text-primary mr-3"></i>
                    Créer un nouvel événement
                </h1>
                <p class="text-gray-600">Créez et publiez un nouvel événement</p>
            </div>
            <div class="flex items-center space-x-3">
                <a href="<?= url('admin_events') ?>" class="btn btn-secondary">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Retour aux événements
                </a>
            </div>
        </div>
    </div>

    <!-- Form Container -->
    <div class="form-container">
        <div class="form-content">
            <form method="post" enctype="multipart/form-data" id="event-form">
                <?= csrf_field() ?>
                
                <!-- Title and Slug Row -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                    <div class="lg:col-span-2">
                        <div class="form-group">
                            <label for="id_title" class="form-label">
                                <i class="fas fa-heading mr-2"></i>
                                Titre de l'événement
                            </label>
                            <input type="text" name="title" id="id_title" class="form-input" 
                                   placeholder="Entrez un titre accrocheur..." required>
                            <div class="char-counter" id="title-counter">0/100</div>
                        </div>
                    </div>
                    <div>
                        <div class="form-group">
                            <label for="id_slug" class="form-label">
                                <i class="fas fa-link mr-2"></i>
                                Slug (URL)
                            </label>
                            <input type="text" name="slug" id="id_slug" class="form-input" 
                                   placeholder="titre-de-l-evenement" required>
                            <p class="text-xs text-gray-500 mt-1">Généré automatiquement</p>
                        </div>
                    </div>
                </div>

                <!-- Event Type and Status Row -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div class="form-group">
                        <label for="id_event_type" class="form-label">
                            <i class="fas fa-tag mr-2"></i>
                            Type d'événement
                        </label>
                        <select name="event_type" id="id_event_type" class="form-input form-select" required>
                            <option value="">Sélectionnez un type</option>
                            <option value="conference">Conférence</option>
                            <option value="training">Formation</option>
                            <option value="charity">Événement caritatif</option>
                            <option value="workshop">Atelier</option>
                            <option value="seminar">Séminaire</option>
                            <option value="networking">Networking</option>
                            <option value="award">Cérémonie de remise de prix</option>
                            <option value="launch">Lancement</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_status" class="form-label">
                            <i class="fas fa-eye mr-2"></i>
                            Statut de publication
                        </label>
                        <select name="status" id="id_status" class="form-input form-select" required>
                            <option value="draft">Brouillon</option>
                            <option value="published">Publié</option>
                        </select>
                    </div>
                </div>

                <!-- Date and Time Row -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                    <div class="form-group">
                        <label for="id_date" class="form-label">
                            <i class="fas fa-calendar mr-2"></i>
                            Date de début
                        </label>
                        <input type="date" name="date" id="id_date" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label for="id_time" class="form-label">
                            <i class="fas fa-clock mr-2"></i>
                            Heure de début
                        </label>
                        <input type="time" name="time" id="id_time" class="form-input">
                    </div>
                    <div class="form-group">
                        <label for="id_end_date" class="form-label">
                            <i class="fas fa-calendar mr-2"></i>
                            Date de fin
                        </label>
                        <input type="date" name="end_date" id="id_end_date" class="form-input">
                    </div>
                    <div class="form-group">
                        <label for="id_end_time" class="form-label">
                            <i class="fas fa-clock mr-2"></i>
                            Heure de fin
                        </label>
                        <input type="time" name="end_time" id="id_end_time" class="form-input">
                    </div>
                </div>

                <!-- Location Row -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div class="form-group">
                        <label for="id_location" class="form-label">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            Lieu
                        </label>
                        <input type="text" name="location" id="id_location" class="form-input" 
                               placeholder="Nom du lieu..." required>
                    </div>
                    <div class="form-group">
                        <label for="id_city" class="form-label">
                            <i class="fas fa-city mr-2"></i>
                            Ville
                        </label>
                        <input type="text" name="city" id="id_city" class="form-input" 
                               placeholder="Ville...">
                    </div>
                    <div class="form-group">
                        <label for="id_country" class="form-label">
                            <i class="fas fa-flag mr-2"></i>
                            Pays
                        </label>
                        <input type="text" name="country" id="id_country" class="form-input" 
                               value="RDC" placeholder="Pays...">
                    </div>
                </div>

                <!-- Address -->
                <div class="form-group">
                    <label for="id_address" class="form-label">
                        <i class="fas fa-map mr-2"></i>
                        Adresse complète
                    </label>
                    <textarea name="address" id="id_address" class="form-input form-textarea" 
                              placeholder="Adresse complète de l'événement..."></textarea>
                </div>

                <!-- Featured Image -->
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-image mr-2"></i>
                        Image principale
                    </label>
                    <div class="image-upload-area" id="image-upload-area">
                        <div class="flex flex-col items-center">
                            <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-4"></i>
                            <p class="text-lg font-medium text-gray-700 mb-2">Glissez-déposez votre image ici</p>
                            <p class="text-sm text-gray-500 mb-4">ou cliquez pour sélectionner un fichier</p>
                            <input type="file" name="featured_image" id="id_featured_image" 
                                   class="hidden" accept="image/*">
                            <button type="button" class="btn btn-secondary" onclick="document.getElementById('id_featured_image').click()">
                                <i class="fas fa-upload mr-2"></i>
                                Choisir une image
                            </button>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">Format recommandé : 1200x630 pixels (JPG, PNG, WebP)</p>
                    </div>
                    <img id="image-preview" class="image-preview" src="#" alt="Aperçu de l'image">
                </div>

                <!-- Description -->
                <div class="form-group">
                    <label for="id_description" class="form-label">
                        <i class="fas fa-align-left mr-2"></i>
                        Description courte
                    </label>
                    <textarea name="description" id="id_description" class="form-input form-textarea" 
                              placeholder="Description courte de l'événement..." required></textarea>
                    <div class="char-counter" id="description-counter">0/500</div>
                </div>

                <!-- Content Editor -->
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-edit mr-2"></i>
                        Contenu détaillé
                    </label>
                    <div class="editor-container">
                        <div class="editor-toolbar" id="toolbar">
                            <span class="ql-formats">
                                <select class="ql-header">
                                    <option value="1">Titre 1</option>
                                    <option value="2">Titre 2</option>
                                    <option value="3">Titre 3</option>
                                    <option selected>Normal</option>
                                </select>
                                <select class="ql-font">
                                    <option selected>Sans Serif</option>
                                    <option value="serif">Serif</option>
                                    <option value="monospace">Monospace</option>
                                </select>
                                <select class="ql-size">
                                    <option value="small">Petit</option>
                                    <option selected>Normal</option>
                                    <option value="large">Grand</option>
                                    <option value="huge">Très grand</option>
                                </select>
                            </span>
                            <span class="ql-formats">
                                <button class="ql-bold"></button>
                                <button class="ql-italic"></button>
                                <button class="ql-underline"></button>
                                <button class="ql-strike"></button>
                            </span>
                            <span class="ql-formats">
                                <button class="ql-blockquote"></button>
                                <button class="ql-code-block"></button>
                            </span>
                            <span class="ql-formats">
                                <button class="ql-list" value="ordered"></button>
                                <button class="ql-list" value="bullet"></button>
                                <button class="ql-indent" value="-1"></button>
                                <button class="ql-indent" value="+1"></button>
                            </span>
                            <span class="ql-formats">
                                <button class="ql-link"></button>
                                <button class="ql-image"></button>
                                <button class="ql-video"></button>
                            </span>
                            <span class="ql-formats">
                                <button class="ql-clean"></button>
                            </span>
                        </div>
                        <div id="editor" class="editor-content"></div>
                    </div>
                    <input type="hidden" name="content" id="id_content">
                </div>

                <!-- Excerpt -->
                <div class="form-group">
                    <label for="id_excerpt" class="form-label">
                        <i class="fas fa-quote-left mr-2"></i>
                        Extrait de l'événement
                    </label>
                    <textarea name="excerpt" id="id_excerpt" class="form-input form-textarea" 
                              placeholder="Résumé court de l'événement qui apparaîtra dans les aperçus..."></textarea>
                    <div class="char-counter" id="excerpt-counter">0/300</div>
                </div>

                <!-- Practical Information -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div class="form-group">
                        <label for="id_capacity" class="form-label">
                            <i class="fas fa-users mr-2"></i>
                            Capacité
                        </label>
                        <input type="number" name="capacity" id="id_capacity" class="form-input" 
                               placeholder="Nombre max de participants">
                    </div>
                    <div class="form-group">
                        <label for="id_price" class="form-label">
                            <i class="fas fa-dollar-sign mr-2"></i>
                            Prix (USD)
                        </label>
                        <input type="number" name="price" id="id_price" class="form-input" 
                               step="0.01" placeholder="0.00">
                    </div>
                    <div class="form-group">
                        <label for="id_registration_url" class="form-label">
                            <i class="fas fa-link mr-2"></i>
                            Lien d'inscription
                        </label>
                        <input type="url" name="registration_url" id="id_registration_url" class="form-input" 
                               placeholder="https://...">
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div class="form-group">
                        <label for="id_contact_email" class="form-label">
                            <i class="fas fa-envelope mr-2"></i>
                            Email de contact
                        </label>
                        <input type="email" name="contact_email" id="id_contact_email" class="form-input" 
                               placeholder="contact@example.com">
                    </div>
                    <div class="form-group">
                        <label for="id_contact_phone" class="form-label">
                            <i class="fas fa-phone mr-2"></i>
                            Téléphone de contact
                        </label>
                        <input type="tel" name="contact_phone" id="id_contact_phone" class="form-input" 
                               placeholder="+243 XXX XXX XXX">
                    </div>
                </div>

                <!-- Featured Event -->
                <div class="form-group">
                    <label class="flex items-center">
                        <input type="checkbox" name="is_featured" id="id_is_featured" class="mr-3">
                        <span class="form-label mb-0">
                            <i class="fas fa-star mr-2"></i>
                            Mettre en avant cet événement
                        </span>
                    </label>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                    <div class="flex items-center space-x-4">
                        <button type="button" class="btn btn-secondary" id="save-draft">
                            <i class="fas fa-save mr-2"></i>
                            Enregistrer comme brouillon
                        </button>
                        <button type="button" class="btn btn-secondary" id="preview-btn">
                            <i class="fas fa-eye mr-2"></i>
                            Aperçu
                        </button>
                    </div>
                    <div class="flex items-center space-x-4">
                        <a href="<?= url('admin_events') ?>" class="btn btn-secondary">
                            <i class="fas fa-times mr-2"></i>
                            Annuler
                        </a>
                        <button type="submit" class="btn btn-primary" id="publish-btn">
                            <i class="fas fa-rocket mr-2"></i>
                            Publier l'événement
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $extra_js = <<<'HTML_BLOCK'
<!-- Quill JS -->
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Quill editor
    const quill = new Quill('#editor', {
        theme: 'snow',
        modules: {
            toolbar: '#toolbar'
        },
        placeholder: 'Commencez à écrire le contenu détaillé de votre événement ici...'
    });
    
    // Character counters
    const titleInput = document.getElementById('id_title');
    const descriptionInput = document.getElementById('id_description');
    const excerptInput = document.getElementById('id_excerpt');
    const titleCounter = document.getElementById('title-counter');
    const descriptionCounter = document.getElementById('description-counter');
    const excerptCounter = document.getElementById('excerpt-counter');
    
    function updateCounter(input, counter, max) {
        const length = input.value.length;
        counter.textContent = `${length}/${max}`;
        
        if (length > max * 0.9) {
            counter.classList.add('error');
            counter.classList.remove('warning');
        } else if (length > max * 0.7) {
            counter.classList.add('warning');
            counter.classList.remove('error');
        } else {
            counter.classList.remove('warning', 'error');
        }
    }
    
    titleInput.addEventListener('input', function() {
        updateCounter(this, titleCounter, 100);
    });
    
    descriptionInput.addEventListener('input', function() {
        updateCounter(this, descriptionCounter, 500);
    });
    
    excerptInput.addEventListener('input', function() {
        updateCounter(this, excerptCounter, 300);
    });
    
    // Auto-generate slug from title
    const slugInput = document.getElementById('id_slug');
    
    titleInput.addEventListener('input', function() {
        const title = this.value;
        const slug = title
            .toLowerCase()
            .replace(/[éèêë]/g, 'e')
            .replace(/[àâä]/g, 'a')
            .replace(/[ùûü]/g, 'u')
            .replace(/[ïî]/g, 'i')
            .replace(/[ôö]/g, 'o')
            .replace(/[ç]/g, 'c')
            .replace(/[^a-z0-9\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-')
            .replace(/^-|-$/g, '');
        
        slugInput.value = slug;
    });
    
    // Image upload handling
    const imageUploadArea = document.getElementById('image-upload-area');
    const imageInput = document.getElementById('id_featured_image');
    const imagePreview = document.getElementById('image-preview');
    
    // Drag and drop functionality
    imageUploadArea.addEventListener('dragover', function(e) {
        e.preventDefault();
        this.classList.add('dragover');
    });
    
    imageUploadArea.addEventListener('dragleave', function(e) {
        e.preventDefault();
        this.classList.remove('dragover');
    });
    
    imageUploadArea.addEventListener('drop', function(e) {
        e.preventDefault();
        this.classList.remove('dragover');
        
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            imageInput.files = files;
            previewImage(files[0]);
        }
    });
    
    imageInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            previewImage(this.files[0]);
        }
    });
    
    function previewImage(file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            imagePreview.src = e.target.result;
            imagePreview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
    
    // Form submission handling
    const form = document.getElementById('event-form');
    const saveDraftBtn = document.getElementById('save-draft');
    const publishBtn = document.getElementById('publish-btn');
    
    // Save as draft
    saveDraftBtn.addEventListener('click', function(e) {
        e.preventDefault();
        document.getElementById('id_status').value = 'draft';
        submitForm();
    });
    
    // Publish
    publishBtn.addEventListener('click', function(e) {
        e.preventDefault();
        document.getElementById('id_status').value = 'published';
        submitForm();
    });
    
    function submitForm() {
        // Update hidden content field with Quill HTML
        const contentInput = document.getElementById('id_content');
        contentInput.value = quill.root.innerHTML;
        
        // Show loading state
        publishBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Publication...';
        publishBtn.disabled = true;
        
        // Submit form
        form.submit();
    }
    
    // Form validation
    form.addEventListener('submit', function(e) {
        const title = titleInput.value.trim();
        const slug = slugInput.value.trim();
        const eventType = document.getElementById('id_event_type').value;
        const date = document.getElementById('id_date').value;
        const location = document.getElementById('id_location').value;
        const description = descriptionInput.value.trim();
        
        if (!title) {
            e.preventDefault();
            alert('Veuillez saisir un titre pour l\'événement.');
            titleInput.focus();
            return false;
        }
        
        if (!slug) {
            e.preventDefault();
            alert('Veuillez saisir un slug pour l\'événement.');
            slugInput.focus();
            return false;
        }
        
        if (!eventType) {
            e.preventDefault();
            alert('Veuillez sélectionner un type d\'événement.');
            document.getElementById('id_event_type').focus();
            return false;
        }
        
        if (!date) {
            e.preventDefault();
            alert('Veuillez sélectionner une date pour l\'événement.');
            document.getElementById('id_date').focus();
            return false;
        }
        
        if (!location) {
            e.preventDefault();
            alert('Veuillez saisir un lieu pour l\'événement.');
            document.getElementById('id_location').focus();
            return false;
        }
        
        if (!description) {
            e.preventDefault();
            alert('Veuillez saisir une description pour l\'événement.');
            descriptionInput.focus();
            return false;
        }
        
        // Update content before submit
        document.getElementById('id_content').value = quill.root.innerHTML;
        return true;
    });
});
</script>
HTML_BLOCK; ?>
