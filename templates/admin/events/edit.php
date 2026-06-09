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
    
    .status-cancelled {
        @apply bg-red-100 text-red-700;
    }
</style>
HTML_BLOCK; ?>

<div class="max-w-6xl mx-auto">
    <!-- Header avec navigation -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Modifier l'événement</h1>
            <p class="text-gray-600">Modifiez le contenu et les paramètres de votre événement</p>
        </div>
        <div class="flex items-center space-x-4">
            <a href="<?= url('admin_events') ?>" class="btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i>Retour à la liste
            </a>
            <?php if ($object->status === 'published'): ?>
            <a href="#" target="_blank" class="btn-primary">
                <i class="fas fa-external-link-alt mr-2"></i>Voir l'événement
            </a>
            <?php endif; ?>
        </div>
    </div>

    <!-- Informations de l'événement -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-8">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <?php if ($object->featured_image): ?>
                <img src="<?= e(media_url($object->featured_image ?? '')) ?>" alt="<?= e($object->title) ?>" class="w-16 h-16 object-cover rounded-lg">
                <?php else: ?>
                <div class="w-16 h-16 bg-gray-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-calendar-alt text-gray-400"></i>
                </div>
                <?php endif; ?>
                <div>
                    <h3 class="text-lg font-semibold text-gray-800"><?= e($object->title) ?></h3>
                    <div class="flex items-center space-x-4 text-sm text-gray-500">
                        <span class="status-badge <?php if ($object->status === 'published'): ?>status-published<?php elseif ($object->status === 'draft'): ?>status-draft<?php else: ?>status-cancelled<?php endif; ?>">
                            <?= e($object->get_status_display) ?>
                        </span>
                        <span><?= e(event_type_label($object->event_type ?? '')) ?></span>
                        <span><?= e(date('d M Y', strtotime((string) ($object->date ?? '')))) ?></span>
                        <span><?= e($object->location) ?></span>
                        <span><?= e($object->views) ?> vues</span>
                        <?php if ($object->is_featured): ?>
                        <span class="px-2 py-1 text-xs bg-yellow-100 text-yellow-700 rounded-full">
                            <i class="fas fa-star mr-1"></i>À la une
                        </span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Formulaire principal -->
    <form method="post" enctype="multipart/form-data" id="eventForm" class="space-y-8">
        <?= csrf_field() ?>
        
        <!-- Titre et Slug -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-6">Informations de base</h2>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <label for="id_title" class="block text-sm font-medium text-gray-700 mb-2">
                        Titre de l'événement <span class="text-red-500">*</span>
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
                           class="form-input" placeholder="titre-de-l-evenement" required>
                    <div class="text-xs text-gray-500 mt-1">URL: /events/<span id="slugPreview">{{ form.slug.value|default:'titre-de-l-evenement' }}</span>/</div>
                    {% if form.slug.errors %}
                    <p class="mt-1 text-sm text-red-600">{{ form.slug.errors.0 }}</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Type et Statut -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-6">Classification</h2>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <label for="id_event_type" class="block text-sm font-medium text-gray-700 mb-2">
                        Type d'événement <span class="text-red-500">*</span>
                    </label>
                    <select name="event_type" id="id_event_type" class="form-select" required>
                        <option value="">Sélectionnez un type</option>
                        <option value="conference" <?php if (old('event_type') === 'conference'): ?>selected<?php endif; ?>>Conférence</option>
                        <option value="training" <?php if (old('event_type') === 'training'): ?>selected<?php endif; ?>>Formation</option>
                        <option value="charity" <?php if (old('event_type') === 'charity'): ?>selected<?php endif; ?>>Événement caritatif</option>
                        <option value="workshop" <?php if (old('event_type') === 'workshop'): ?>selected<?php endif; ?>>Atelier</option>
                        <option value="seminar" <?php if (old('event_type') === 'seminar'): ?>selected<?php endif; ?>>Séminaire</option>
                        <option value="networking" <?php if (old('event_type') === 'networking'): ?>selected<?php endif; ?>>Networking</option>
                        <option value="award" <?php if (old('event_type') === 'award'): ?>selected<?php endif; ?>>Cérémonie de remise de prix</option>
                        <option value="launch" <?php if (old('event_type') === 'launch'): ?>selected<?php endif; ?>>Lancement</option>
                    </select>
                    {% if form.event_type.errors %}
                    <p class="mt-1 text-sm text-red-600">{{ form.event_type.errors.0 }}</p>
                    <?php endif; ?>
                </div>
                
                <div>
                    <label for="id_status" class="block text-sm font-medium text-gray-700 mb-2">
                        Statut de publication
                    </label>
                    <select name="status" id="id_status" class="form-select">
                        <option value="draft" <?php if (old('status') === 'draft'): ?>selected<?php endif; ?>>Brouillon</option>
                        <option value="published" <?php if (old('status') === 'published'): ?>selected<?php endif; ?>>Publié</option>
                        <option value="cancelled" <?php if (old('status') === 'cancelled'): ?>selected<?php endif; ?>>Annulé</option>
                    </select>
                    {% if form.status.errors %}
                    <p class="mt-1 text-sm text-red-600">{{ form.status.errors.0 }}</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Date et Heure -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-6">Date et heure</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div>
                    <label for="id_date" class="block text-sm font-medium text-gray-700 mb-2">
                        Date de début <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="date" id="id_date" value="{{ form.date.value|default:'' }}" 
                           class="form-input" required>
                    {% if form.date.errors %}
                    <p class="mt-1 text-sm text-red-600">{{ form.date.errors.0 }}</p>
                    <?php endif; ?>
                </div>
                
                <div>
                    <label for="id_time" class="block text-sm font-medium text-gray-700 mb-2">
                        Heure de début
                    </label>
                    <input type="time" name="time" id="id_time" value="{{ form.time.value|default:'' }}" 
                           class="form-input">
                    {% if form.time.errors %}
                    <p class="mt-1 text-sm text-red-600">{{ form.time.errors.0 }}</p>
                    <?php endif; ?>
                </div>
                
                <div>
                    <label for="id_end_date" class="block text-sm font-medium text-gray-700 mb-2">
                        Date de fin
                    </label>
                    <input type="date" name="end_date" id="id_end_date" value="{{ form.end_date.value|default:'' }}" 
                           class="form-input">
                    {% if form.end_date.errors %}
                    <p class="mt-1 text-sm text-red-600">{{ form.end_date.errors.0 }}</p>
                    <?php endif; ?>
                </div>
                
                <div>
                    <label for="id_end_time" class="block text-sm font-medium text-gray-700 mb-2">
                        Heure de fin
                    </label>
                    <input type="time" name="end_time" id="id_end_time" value="{{ form.end_time.value|default:'' }}" 
                           class="form-input">
                    {% if form.end_time.errors %}
                    <p class="mt-1 text-sm text-red-600">{{ form.end_time.errors.0 }}</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Lieu -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-6">Lieu</h2>
            
            <div class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="id_location" class="block text-sm font-medium text-gray-700 mb-2">
                            Lieu <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="location" id="id_location" value="{{ form.location.value|default:'' }}" 
                               class="form-input" placeholder="Nom du lieu..." required>
                        {% if form.location.errors %}
                        <p class="mt-1 text-sm text-red-600">{{ form.location.errors.0 }}</p>
                        <?php endif; ?>
                    </div>
                    
                    <div>
                        <label for="id_city" class="block text-sm font-medium text-gray-700 mb-2">
                            Ville
                        </label>
                        <input type="text" name="city" id="id_city" value="{{ form.city.value|default:'' }}" 
                               class="form-input" placeholder="Ville...">
                        {% if form.city.errors %}
                        <p class="mt-1 text-sm text-red-600">{{ form.city.errors.0 }}</p>
                        <?php endif; ?>
                    </div>
                    
                    <div>
                        <label for="id_country" class="block text-sm font-medium text-gray-700 mb-2">
                            Pays
                        </label>
                        <input type="text" name="country" id="id_country" value="{{ form.country.value|default:'RDC' }}" 
                               class="form-input" placeholder="Pays...">
                        {% if form.country.errors %}
                        <p class="mt-1 text-sm text-red-600">{{ form.country.errors.0 }}</p>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div>
                    <label for="id_address" class="block text-sm font-medium text-gray-700 mb-2">
                        Adresse complète
                    </label>
                    <textarea name="address" id="id_address" rows="3" 
                              class="form-textarea" placeholder="Adresse complète de l'événement...">{{ form.address.value|default:'' }}</textarea>
                    {% if form.address.errors %}
                    <p class="mt-1 text-sm text-red-600">{{ form.address.errors.0 }}</p>
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

        <!-- Description -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-6">Description</h2>
            
            <div>
                <label for="id_description" class="block text-sm font-medium text-gray-700 mb-2">
                    Description courte <span class="text-red-500">*</span>
                </label>
                <textarea name="description" id="id_description" rows="3" 
                          class="form-textarea" placeholder="Description courte de l'événement..." required>{{ form.description.value|default:'' }}</textarea>
                <div class="character-counter" id="descriptionCounter">0/500 caractères</div>
                {% if form.description.errors %}
                <p class="mt-1 text-sm text-red-600">{{ form.description.errors.0 }}</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Extrait -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-6">Extrait</h2>
            
            <div>
                <label for="id_excerpt" class="block text-sm font-medium text-gray-700 mb-2">
                    Résumé de l'événement
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
            <h2 class="text-xl font-semibold text-gray-800 mb-6">Contenu détaillé</h2>
            
            <div>
                <label for="id_content" class="block text-sm font-medium text-gray-700 mb-2">
                    Contenu détaillé
                </label>
                <div id="editor" class="quill-editor"></div>
                <textarea name="content" id="id_content" class="hidden">{{ form.content.value|default:'' }}</textarea>
                {% if form.content.errors %}
                <p class="mt-1 text-sm text-red-600">{{ form.content.errors.0 }}</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Informations pratiques -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-6">Informations pratiques</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label for="id_capacity" class="block text-sm font-medium text-gray-700 mb-2">
                        Capacité
                    </label>
                    <input type="number" name="capacity" id="id_capacity" value="{{ form.capacity.value|default:'' }}" 
                           class="form-input" placeholder="Nombre max de participants">
                    {% if form.capacity.errors %}
                    <p class="mt-1 text-sm text-red-600">{{ form.capacity.errors.0 }}</p>
                    <?php endif; ?>
                </div>
                
                <div>
                    <label for="id_price" class="block text-sm font-medium text-gray-700 mb-2">
                        Prix (USD)
                    </label>
                    <input type="number" name="price" id="id_price" value="{{ form.price.value|default:'' }}" 
                           class="form-input" step="0.01" placeholder="0.00">
                    {% if form.price.errors %}
                    <p class="mt-1 text-sm text-red-600">{{ form.price.errors.0 }}</p>
                    <?php endif; ?>
                </div>
                
                <div>
                    <label for="id_registration_url" class="block text-sm font-medium text-gray-700 mb-2">
                        Lien d'inscription
                    </label>
                    <input type="url" name="registration_url" id="id_registration_url" value="{{ form.registration_url.value|default:'' }}" 
                           class="form-input" placeholder="https://...">
                    {% if form.registration_url.errors %}
                    <p class="mt-1 text-sm text-red-600">{{ form.registration_url.errors.0 }}</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Contact -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-6">Contact</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="id_contact_email" class="block text-sm font-medium text-gray-700 mb-2">
                        Email de contact
                    </label>
                    <input type="email" name="contact_email" id="id_contact_email" value="{{ form.contact_email.value|default:'' }}" 
                           class="form-input" placeholder="contact@example.com">
                    {% if form.contact_email.errors %}
                    <p class="mt-1 text-sm text-red-600">{{ form.contact_email.errors.0 }}</p>
                    <?php endif; ?>
                </div>
                
                <div>
                    <label for="id_contact_phone" class="block text-sm font-medium text-gray-700 mb-2">
                        Téléphone de contact
                    </label>
                    <input type="tel" name="contact_phone" id="id_contact_phone" value="{{ form.contact_phone.value|default:'' }}" 
                           class="form-input" placeholder="+243 XXX XXX XXX">
                    {% if form.contact_phone.errors %}
                    <p class="mt-1 text-sm text-red-600">{{ form.contact_phone.errors.0 }}</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Options -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-6">Options</h2>
            
            <div class="space-y-4">
                <label class="flex items-center">
                    <input type="checkbox" name="is_featured" id="id_is_featured" <?php if (old('is_featured')): ?>checked<?php endif; ?> class="mr-3">
                    <span class="text-sm font-medium text-gray-700">
                        <i class="fas fa-star mr-2"></i>
                        Mettre en avant cet événement
                    </span>
                </label>
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
                    <a href="<?= url('admin_events') ?>" class="btn-secondary">
                        <i class="fas fa-times mr-2"></i>Annuler
                    </a>
                    <button type="button" id="saveDraftBtn" class="btn-secondary">
                        <i class="fas fa-save mr-2"></i>Sauvegarder comme brouillon
                    </button>
                    <button type="button" id="publishBtn" class="btn-primary">
                        <i class="fas fa-paper-plane mr-2"></i>Publier l'événement
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
    const form = document.getElementById('eventForm');
    const titleInput = document.getElementById('id_title');
    const slugInput = document.getElementById('id_slug');
    const eventTypeSelect = document.getElementById('id_event_type');
    const statusSelect = document.getElementById('id_status');
    const descriptionTextarea = document.getElementById('id_description');
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
    const descriptionCounter = document.getElementById('descriptionCounter');
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
            slugPreview.textContent = slug || 'titre-de-l-evenement';
        }
    });
    
    // Mise à jour du slug preview
    slugInput.addEventListener('input', function() {
        slugPreview.textContent = slugInput.value || 'titre-de-l-evenement';
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
    descriptionTextarea.addEventListener('input', () => updateCounter(descriptionTextarea, descriptionCounter, 500));
    excerptTextarea.addEventListener('input', () => updateCounter(excerptTextarea, excerptCounter, 300));
    
    // Initialiser les compteurs
    updateCounter(titleInput, titleCounter, 100);
    updateCounter(descriptionTextarea, descriptionCounter, 500);
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
        const eventType = eventTypeSelect.value;
        const date = document.getElementById('id_date').value;
        const location = document.getElementById('id_location').value;
        const description = descriptionTextarea.value.trim();
        
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
            eventTypeSelect.focus();
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
            descriptionTextarea.focus();
            return false;
        }
        
        // Mettre à jour le contenu avant soumission
        contentTextarea.value = quill.root.innerHTML;
        return true;
    });
});
</script>
HTML_BLOCK; ?>
