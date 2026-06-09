<?php $extra_css = <<<'HTML_BLOCK'
<style>
    :root {
        --primary-color: #4F46E5;
        --secondary-color: #7C3AED;
        --accent-color: #EC4899;
    }
    
    .form-input {
        @apply w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors;
    }
    
    .form-select {
        @apply w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors bg-white;
    }
    
    .form-textarea {
        @apply w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors resize-none;
    }
    
    .character-counter {
        @apply text-xs text-gray-500 mt-1;
    }
    
    .character-counter.warning {
        @apply text-yellow-600;
    }
    
    .character-counter.error {
        @apply text-red-600;
    }
    
    .drag-drop-area {
        @apply border-2 border-dashed border-gray-300 rounded-lg p-8 text-center transition-colors;
    }
    
    .drag-drop-area.dragover {
        @apply border-primary bg-primary/5;
    }
    
    .image-preview {
        @apply w-full h-48 object-cover rounded-lg border border-gray-200;
    }
    
    .quill-editor {
        @apply border border-gray-300 rounded-lg;
    }
    
    .quill-editor .ql-toolbar {
        @apply border-b border-gray-300;
    }
    
    .quill-editor .ql-container {
        @apply min-h-96;
    }
    
    .btn-primary {
        @apply bg-primary text-white px-6 py-3 rounded-lg hover:bg-primary/90 transition-colors font-medium;
    }
    
    .btn-secondary {
        @apply bg-gray-100 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-200 transition-colors font-medium;
    }
    
    .btn-danger {
        @apply bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 transition-colors font-medium;
    }
    
    .status-badge {
        @apply px-3 py-1 rounded-full text-sm font-medium;
    }
    
    .status-published {
        @apply bg-green-100 text-green-700;
    }
    
    .status-draft {
        @apply bg-yellow-100 text-yellow-700;
    }
</style>
HTML_BLOCK; ?>

<div class="max-w-6xl mx-auto">
    <!-- Header avec navigation -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Modifier l'article</h1>
            <p class="text-gray-600">Modifiez le contenu et les paramètres de votre article</p>
        </div>
        <div class="flex items-center space-x-4">
            <a href="<?= url('admin_articles') ?>" class="btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i>Retour à la liste
            </a>
            <?php if ($object->status === 'published'): ?>
            <a href="<?= url('blog_detail', $object->slug) ?>" target="_blank" class="btn-primary">
                <i class="fas fa-external-link-alt mr-2"></i>Voir l'article
            </a>
            <?php endif; ?>
        </div>
    </div>

    <!-- Informations de l'article -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <?php if ($object->featured_image): ?>
                <img src="<?= e(media_url($object->featured_image ?? '')) ?>" alt="<?= e($object->title) ?>" class="w-16 h-16 object-cover rounded-lg">
                <?php else: ?>
                <div class="w-16 h-16 bg-gray-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-image text-gray-400"></i>
                </div>
                <?php endif; ?>
                <div>
                    <h3 class="text-lg font-semibold text-gray-800"><?= e($object->title) ?></h3>
                    <div class="flex items-center space-x-4 text-sm text-gray-500">
                        <span class="status-badge <?php if ($object->status === 'published'): ?>status-published<?php else: ?>status-draft<?php endif; ?>">
                            <?= e($object->get_status_display) ?>
                        </span>
                        <span><?= e($object->getCategoryDisplay()) ?></span>
                        <span><?= e(date('d M Y', strtotime((string) ($object->created_at ?? '')))) ?></span>
                        <span><?= e($object->views) ?> vues</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Formulaire principal -->
    <form method="post" enctype="multipart/form-data" id="articleForm" class="space-y-8">
        <?= csrf_field() ?>
        
        <!-- Titre et Slug -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-6">Informations de base</h2>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <label for="id_title" class="block text-sm font-medium text-gray-700 mb-2">
                        Titre de l'article <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="title" id="id_title" value="{{ form.title.value|default:'' }}" 
                           class="form-input" placeholder="Saisissez un titre accrocheur..." required>
                    <div class="character-counter" id="titleCounter">0/100 caractères</div>
                    {% if form.title.errors %}
                    <p class="mt-1 text-sm text-red-600">{{ form.title.errors.0 }}</p>
                    <?php endif; ?>
                </div>
                
                <div>
                    <label for="id_slug" class="block text-sm font-medium text-gray-700 mb-2">
                        Slug (URL) <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="slug" id="id_slug" value="{{ form.slug.value|default:'' }}" 
                           class="form-input" placeholder="titre-de-l-article" required>
                    <div class="text-xs text-gray-500 mt-1">URL: /blog/<span id="slugPreview">{{ form.slug.value|default:'titre-de-l-article' }}</span>/</div>
                    {% if form.slug.errors %}
                    <p class="mt-1 text-sm text-red-600">{{ form.slug.errors.0 }}</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Catégorie et Statut -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-6">Classification</h2>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <label for="id_category" class="block text-sm font-medium text-gray-700 mb-2">
                        Catégorie <span class="text-red-500">*</span>
                    </label>
                    <select name="category" id="id_category" class="form-select" required>
                        <option value="">Sélectionnez une catégorie</option>
                        <option value="leadership" <?php if (old('category') === 'leadership'): ?>selected<?php endif; ?>>Leadership</option>
                        <option value="entrepreneuriat" <?php if (old('category') === 'entrepreneuriat'): ?>selected<?php endif; ?>>Entrepreneuriat</option>
                        <option value="education" <?php if (old('category') === 'education'): ?>selected<?php endif; ?>>Éducation</option>
                        <option value="social" <?php if (old('category') === 'social'): ?>selected<?php endif; ?>>Social & Développement</option>
                        <option value="politique" <?php if (old('category') === 'politique'): ?>selected<?php endif; ?>>Politique</option>
                        <option value="actualites" <?php if (old('category') === 'actualites'): ?>selected<?php endif; ?>>Actualités</option>
                        <option value="temoignages" <?php if (old('category') === 'temoignages'): ?>selected<?php endif; ?>>Témoignages</option>
                        <option value="conseils" <?php if (old('category') === 'conseils'): ?>selected<?php endif; ?>>Conseils & Astuces</option>
                    </select>
                    {% if form.category.errors %}
                    <p class="mt-1 text-sm text-red-600">{{ form.category.errors.0 }}</p>
                    <?php endif; ?>
                </div>
                
                <div>
                    <label for="id_status" class="block text-sm font-medium text-gray-700 mb-2">
                        Statut de publication
                    </label>
                    <select name="status" id="id_status" class="form-select">
                        <option value="draft" <?php if (old('status') === 'draft'): ?>selected<?php endif; ?>>Brouillon</option>
                        <option value="published" <?php if (old('status') === 'published'): ?>selected<?php endif; ?>>Publié</option>
                    </select>
                    {% if form.status.errors %}
                    <p class="mt-1 text-sm text-red-600">{{ form.status.errors.0 }}</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Image à la une -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-6">Image à la une</h2>
            
            <div class="space-y-4">
                <!-- Image actuelle -->
                <?php if ($object->featured_image): ?>
                <div class="flex items-center space-x-4 p-4 bg-gray-50 rounded-lg">
                    <img src="<?= e(media_url($object->featured_image ?? '')) ?>" alt="Image actuelle" class="w-24 h-24 object-cover rounded-lg">
                    <div>
                        <p class="font-medium text-gray-800">Image actuelle</p>
                        <p class="text-sm text-gray-500">{{ object.featured_image.name }}</p>
                    </div>
                </div>
                <?php endif; ?>
                
                <!-- Zone de téléchargement -->
                <div class="drag-drop-area" id="dropArea">
                    <div class="text-center">
                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-4"></i>
                        <p class="text-lg font-medium text-gray-700 mb-2">
                            <?php if ($object->featured_image): ?>Remplacer l'image<?php else: ?>Ajouter une image<?php endif; ?>
                        </p>
                        <p class="text-gray-500 mb-4">Glissez-déposez une image ou cliquez pour sélectionner</p>
                        <input type="file" name="featured_image" id="id_featured_image" accept="image/*" class="hidden">
                        <button type="button" id="selectImageBtn" class="btn-primary">
                            <i class="fas fa-image mr-2"></i>Sélectionner une image
                        </button>
                    </div>
                </div>
                
                <!-- Aperçu de la nouvelle image -->
                <div id="imagePreview" class="hidden">
                    <img id="previewImg" class="image-preview" alt="Aperçu">
                    <div class="mt-2 flex justify-center">
                        <button type="button" id="removeImageBtn" class="btn-danger">
                            <i class="fas fa-trash mr-2"></i>Supprimer l'image
                        </button>
                    </div>
                </div>
                
                {% if form.featured_image.errors %}
                <p class="text-sm text-red-600">{{ form.featured_image.errors.0 }}</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Extrait -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-6">Extrait</h2>
            
            <div>
                <label for="id_excerpt" class="block text-sm font-medium text-gray-700 mb-2">
                    Résumé de l'article
                </label>
                <textarea name="excerpt" id="id_excerpt" rows="3" 
                          class="form-textarea" placeholder="Saisissez un résumé court et accrocheur...">{{ form.excerpt.value|default:'' }}</textarea>
                <div class="character-counter" id="excerptCounter">0/300 caractères</div>
                {% if form.excerpt.errors %}
                <p class="mt-1 text-sm text-red-600">{{ form.excerpt.errors.0 }}</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Contenu -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-6">Contenu de l'article</h2>
            
            <div>
                <label for="id_content" class="block text-sm font-medium text-gray-700 mb-2">
                    Contenu <span class="text-red-500">*</span>
                </label>
                <div id="editor" class="quill-editor"></div>
                <textarea name="content" id="id_content" class="hidden">{{ form.content.value|default:'' }}</textarea>
                {% if form.content.errors %}
                <p class="mt-1 text-sm text-red-600">{{ form.content.errors.0 }}</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Actions -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div class="text-sm text-gray-500">
                    <i class="fas fa-info-circle mr-2"></i>
                    Les modifications seront sauvegardées automatiquement
                </div>
                <div class="flex items-center space-x-4">
                    <a href="<?= url('admin_articles') ?>" class="btn-secondary">
                        <i class="fas fa-times mr-2"></i>Annuler
                    </a>
                    <button type="button" id="saveDraftBtn" class="btn-secondary">
                        <i class="fas fa-save mr-2"></i>Sauvegarder comme brouillon
                    </button>
                    <button type="button" id="publishBtn" class="btn-primary">
                        <i class="fas fa-paper-plane mr-2"></i>Publier l'article
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
<?php $extra_js = <<<'HTML_BLOCK'
<!-- Quill.js -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Éléments du formulaire
    const form = document.getElementById('articleForm');
    const titleInput = document.getElementById('id_title');
    const slugInput = document.getElementById('id_slug');
    const categorySelect = document.getElementById('id_category');
    const statusSelect = document.getElementById('id_status');
    const excerptTextarea = document.getElementById('id_excerpt');
    const contentTextarea = document.getElementById('id_content');
    const imageInput = document.getElementById('id_featured_image');
    const dropArea = document.getElementById('dropArea');
    const selectImageBtn = document.getElementById('selectImageBtn');
    const imagePreview = document.getElementById('imagePreview');
    const previewImg = document.getElementById('previewImg');
    const removeImageBtn = document.getElementById('removeImageBtn');
    const saveDraftBtn = document.getElementById('saveDraftBtn');
    const publishBtn = document.getElementById('publishBtn');
    
    // Compteurs de caractères
    const titleCounter = document.getElementById('titleCounter');
    const excerptCounter = document.getElementById('excerptCounter');
    const slugPreview = document.getElementById('slugPreview');
    
    // Initialiser Quill
    const quill = new Quill('#editor', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, 3, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'color': [] }, { 'background': [] }],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                [{ 'indent': '-1'}, { 'indent': '+1' }],
                ['blockquote', 'code-block'],
                ['link', 'image'],
                ['clean']
            ]
        }
    });
    
    // Charger le contenu existant dans Quill
    if (contentTextarea.value) {
        quill.root.innerHTML = contentTextarea.value;
    }
    
    // Auto-génération du slug
    titleInput.addEventListener('input', function() {
        if (!slugInput.value || slugInput.value === '{{ form.slug.value|default:'' }}') {
            const slug = titleInput.value
                .toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .replace(/^-|-$/g, '');
            slugInput.value = slug;
            slugPreview.textContent = slug || 'titre-de-l-article';
        }
    });
    
    // Mise à jour du slug preview
    slugInput.addEventListener('input', function() {
        slugPreview.textContent = slugInput.value || 'titre-de-l-article';
    });
    
    // Compteurs de caractères
    function updateCounter(input, counter, max) {
        const count = input.value.length;
        counter.textContent = `${count}/${max} caractères`;
        counter.className = 'character-counter';
        
        if (count > max * 0.8) {
            counter.classList.add('warning');
        }
        if (count > max) {
            counter.classList.add('error');
        }
    }
    
    titleInput.addEventListener('input', () => updateCounter(titleInput, titleCounter, 100));
    excerptTextarea.addEventListener('input', () => updateCounter(excerptTextarea, excerptCounter, 300));
    
    // Initialiser les compteurs
    updateCounter(titleInput, titleCounter, 100);
    updateCounter(excerptTextarea, excerptCounter, 300);
    
    // Gestion des images
    selectImageBtn.addEventListener('click', () => imageInput.click());
    
    imageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                imagePreview.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    });
    
    // Drag & Drop
    dropArea.addEventListener('dragover', function(e) {
        e.preventDefault();
        dropArea.classList.add('dragover');
    });
    
    dropArea.addEventListener('dragleave', function(e) {
        e.preventDefault();
        dropArea.classList.remove('dragover');
    });
    
    dropArea.addEventListener('drop', function(e) {
        e.preventDefault();
        dropArea.classList.remove('dragover');
        
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            imageInput.files = files;
            const file = files[0];
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                imagePreview.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    });
    
    removeImageBtn.addEventListener('click', function() {
        imageInput.value = '';
        imagePreview.classList.add('hidden');
    });
    
    // Soumission du formulaire
    function submitForm(status) {
        // Mettre à jour le statut
        statusSelect.value = status;
        
        // Mettre à jour le contenu avec Quill
        contentTextarea.value = quill.root.innerHTML;
        
        // Afficher l'état de chargement
        const btn = status === 'draft' ? saveDraftBtn : publishBtn;
        const originalText = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Sauvegarde...';
        btn.disabled = true;
        
        // Soumettre le formulaire
        form.submit();
    }
    
    saveDraftBtn.addEventListener('click', function(e) {
        e.preventDefault();
        submitForm('draft');
    });
    
    publishBtn.addEventListener('click', function(e) {
        e.preventDefault();
        submitForm('published');
    });
    
    // Validation du formulaire
    form.addEventListener('submit', function(e) {
        const title = titleInput.value.trim();
        const slug = slugInput.value.trim();
        const category = categorySelect.value;
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
            categorySelect.focus();
            return false;
        }
        
        if (!content) {
            e.preventDefault();
            alert('Veuillez saisir le contenu de l\'article.');
            quill.focus();
            return false;
        }
        
        // Mettre à jour le contenu avant soumission
        contentTextarea.value = quill.root.innerHTML;
        return true;
    });
});
</script>
HTML_BLOCK; ?>
