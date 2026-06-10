<?php $extra_css = <<<'HTML_BLOCK'
<!-- Quill CSS -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<!-- TinyMCE CSS -->
<link href="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.css" rel="stylesheet">
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
    
    /* Status Badge */
    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    
    .status-draft {
        background: #fef3c7;
        color: #92400e;
    }
    
    .status-published {
        background: #d1fae5;
        color: #065f46;
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
    
    /* Progress Bar */
    .progress-bar {
        width: 100%;
        height: 4px;
        background: #e5e7eb;
        border-radius: 2px;
        overflow: hidden;
        margin-top: 0.5rem;
    }
    
    .progress-fill {
        height: 100%;
        background: linear-gradient(90deg, #4F46E5, #7C3AED);
        width: 0%;
        transition: width 0.3s ease;
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
                    <i class="fas fa-plus-circle text-primary mr-3"></i>
                    Créer un nouvel article
                </h1>
                <p class="text-gray-600">Rédigez et publiez un nouvel article pour votre blog</p>
            </div>
            <div class="flex items-center space-x-3">
                <a href="<?= url('admin_articles') ?>" class="btn btn-secondary">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Retour aux articles
                </a>
            </div>
        </div>
    </div>

    <!-- Form Container -->
    <div class="form-container">
        <div class="form-content">
            <form method="post" enctype="multipart/form-data" id="article-form">
                <?= csrf_field() ?>
                
                <!-- Title and Slug Row -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                    <div class="lg:col-span-2">
                        <div class="form-group">
                            <label for="id_title" class="form-label">
                                <i class="fas fa-heading mr-2"></i>
                                Titre de l'article
                            </label>
                            <input type="text" name="title" id="id_title" class="form-input" 
                                   value="<?= e(old('title', $article?->title ?? '')) ?>"
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
                                   value="<?= e(old('slug', $article?->slug ?? '')) ?>"
                                   placeholder="url-de-l-article" required>
                            <p class="text-xs text-gray-500 mt-1">Généré automatiquement</p>
                        </div>
                    </div>
                </div>

                <!-- Category and Status Row -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div class="form-group">
                        <label for="id_category" class="form-label">
                            <i class="fas fa-folder mr-2"></i>
                            Catégorie
                        </label>
                        <?php $cat = old('category', $article?->category ?? ''); ?>
                        <select name="category" id="id_category" class="form-input form-select" required>
                            <option value="">Sélectionnez une catégorie</option>
                            <option value="leadership" <?= $cat === 'leadership' ? 'selected' : '' ?>>Leadership</option>
                            <option value="entrepreneuriat" <?= $cat === 'entrepreneuriat' ? 'selected' : '' ?>>Entrepreneuriat</option>
                            <option value="education" <?= $cat === 'education' ? 'selected' : '' ?>>Éducation</option>
                            <option value="social" <?= $cat === 'social' ? 'selected' : '' ?>>Social & Développement</option>
                            <option value="politique" <?= $cat === 'politique' ? 'selected' : '' ?>>Politique</option>
                            <option value="actualites" <?= $cat === 'actualites' ? 'selected' : '' ?>>Actualités</option>
                            <option value="temoignages" <?= $cat === 'temoignages' ? 'selected' : '' ?>>Témoignages</option>
                            <option value="conseils" <?= $cat === 'conseils' ? 'selected' : '' ?>>Conseils & Astuces</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_status" class="form-label">
                            <i class="fas fa-eye mr-2"></i>
                            Statut de publication
                        </label>
                        <?php $st = old('status', $article?->status ?? 'draft'); ?>
                        <select name="status" id="id_status" class="form-input form-select" required>
                            <option value="draft" <?= $st === 'draft' ? 'selected' : '' ?>>Brouillon</option>
                            <option value="published" <?= $st === 'published' ? 'selected' : '' ?>>Publié</option>
                        </select>
                    </div>
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
                    <?php if (!empty($article?->featured_image)): ?>
                    <p class="text-sm text-gray-500 mt-2">Image actuelle : <?= e(basename((string) $article->featured_image)) ?></p>
                    <img src="<?= e(media_url((string) $article->featured_image)) ?>" alt="" class="mt-2 max-h-40 rounded-lg">
                    <?php endif; ?>
                </div>

                <!-- Content Editor -->
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-edit mr-2"></i>
                        Contenu de l'article
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
                        Extrait de l'article
                    </label>
                    <textarea name="excerpt" id="id_excerpt" class="form-input form-textarea" 
                              placeholder="Résumé court de l'article qui apparaîtra dans les aperçus..."><?= e(old('excerpt', $article?->excerpt ?? '')) ?></textarea>
                    <div class="char-counter" id="excerpt-counter">0/300</div>
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
                        <a href="<?= url('admin_articles') ?>" class="btn btn-secondary">
                            <i class="fas fa-times mr-2"></i>
                            Annuler
                        </a>
                        <button type="submit" class="btn btn-primary" id="publish-btn">
                            <i class="fas fa-rocket mr-2"></i>
                            Publier l'article
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
        placeholder: 'Commencez à écrire votre article ici...'
    });
    <?php if (!empty($article?->content)): ?>
    quill.root.innerHTML = <?= json_encode((string) $article->content, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>;
    document.getElementById('id_content').value = quill.root.innerHTML;
    <?php endif; ?>

    // Character counters
    const titleInput = document.getElementById('id_title');
    const excerptInput = document.getElementById('id_excerpt');
    const titleCounter = document.getElementById('title-counter');
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
    const form = document.getElementById('article-form');
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
    
    // Form validation - simplified
    form.addEventListener('submit', function(e) {
        const title = titleInput.value.trim();
        const slug = slugInput.value.trim();
        const category = document.getElementById('id_category').value;
        const content = quill.getText().trim();
        
        if (!title) {
            e.preventDefault();
            alert('Veuillez saisir un titre pour l\'article.');
            titleInput.focus();
            return false;
        }
        
        if (!slug) {
            e.preventDefault();
            alert('Veuillez saisir un slug pour l\'article.');
            slugInput.focus();
            return false;
        }
        
        if (!category) {
            e.preventDefault();
            alert('Veuillez sélectionner une catégorie.');
            document.getElementById('id_category').focus();
            return false;
        }
        
        if (!content) {
            e.preventDefault();
            alert('Veuillez saisir le contenu de l\'article.');
            quill.focus();
            return false;
        }
        
        // Update content before submit
        document.getElementById('id_content').value = quill.root.innerHTML;
        return true;
    });
    
    // Auto-save functionality (optional)
    let autoSaveTimeout;
    function autoSave() {
        clearTimeout(autoSaveTimeout);
        autoSaveTimeout = setTimeout(function() {
            if (titleInput.value.trim() || quill.getText().trim()) {
                console.log('Auto-save triggered');
                // Here you could implement auto-save functionality
            }
        }, 30000); // Auto-save every 30 seconds
    }
    
    titleInput.addEventListener('input', autoSave);
    quill.on('text-change', autoSave);
});
</script>
HTML_BLOCK; ?>
