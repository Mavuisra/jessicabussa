<?php $extra_css = <<<'HTML_BLOCK'
<style>
    .form-container {
        max-width: 600px;
        margin: 0 auto;
    }
    
    .form-group {
        margin-bottom: 20px;
    }
    
    .form-label {
        font-weight: 600;
        color: #374151;
        margin-bottom: 8px;
        display: block;
    }
    
    .form-control {
        border: 1px solid #d1d5db;
        border-radius: 6px;
        padding: 10px 12px;
        font-size: 14px;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }
    
    .form-control:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        outline: none;
    }
    
    .form-text {
        font-size: 0.875rem;
        color: #6b7280;
        margin-top: 4px;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        padding: 10px 20px;
        border-radius: 6px;
        font-weight: 600;
        transition: transform 0.2s ease;
    }
    
    .btn-primary:hover {
        transform: translateY(-1px);
    }
    
    .btn-secondary {
        background: #6b7280;
        border: none;
        padding: 10px 20px;
        border-radius: 6px;
        font-weight: 600;
    }
    
    .current-image {
        max-width: 200px;
        max-height: 200px;
        border-radius: 8px;
        border: 2px solid #d1d5db;
        padding: 10px;
        margin-top: 10px;
    }
    
    .current-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 4px;
    }
    
    .image-preview {
        max-width: 200px;
        max-height: 200px;
        border-radius: 8px;
        border: 2px dashed #d1d5db;
        padding: 10px;
        margin-top: 10px;
        display: none;
    }
    
    .image-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 4px;
    }
    
    .video-info {
        background: #f3f4f6;
        border-radius: 6px;
        padding: 15px;
        margin-top: 10px;
        border-left: 4px solid #3b82f6;
    }
    
    .video-info h6 {
        color: #1f2937;
        margin-bottom: 8px;
    }
    
    .video-info p {
        color: #6b7280;
        font-size: 0.875rem;
        margin: 0;
    }
</style>
HTML_BLOCK; ?>

<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Modifier l'image</h1>
            <p class="text-muted">Modifiez les informations de cette image</p>
        </div>
        <a href="<?= url('admin_gallery') ?>" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Retour à la liste
        </a>
    </div>

    <!-- Messages -->
    <?php if ($messages): ?>
        <?php $__loop_items = $messages; foreach ($messages as $message): ?>
            <div class="alert alert-<?= e($message->tags) ?> alert-dismissible fade show" role="alert">
                <?= e($message) ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

    <!-- Formulaire -->
    <div class="form-container">
        <form method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            
            <div class="form-group">
                <label for="{{ form.title.id_for_label }}" class="form-label">Titre *</label>
                <?= e($form->title) ?>
                {% if form.title.help_text %}
                    <small class="form-text">{{ form.title.help_text }}</small>
                <?php endif; ?>
                {% if form.title.errors %}
                    <div class="text-danger">{{ form.title.errors }}</div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="{{ form.category.id_for_label }}" class="form-label">Catégorie *</label>
                <?= e($form->category) ?>
                {% if form.category.help_text %}
                    <small class="form-text">{{ form.category.help_text }}</small>
                <?php endif; ?>
                {% if form.category.errors %}
                    <div class="text-danger">{{ form.category.errors }}</div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="{{ form.image.id_for_label }}" class="form-label">Image</label>
                <?= e($form->image) ?>
                {% if form.image.help_text %}
                    <small class="form-text">{{ form.image.help_text }}</small>
                <?php endif; ?>
                {% if form.image.errors %}
                    <div class="text-danger">{{ form.image.errors }}</div>
                <?php endif; ?>
                
                <!-- Image actuelle -->
                <?php if ($object->image): ?>
                    <div class="current-image">
                        <img src="<?= e(media_url($object->image ?? '')) ?>" alt="<?= e($object->title) ?>">
                        <p class="text-muted mt-2 mb-0">Image actuelle</p>
                    </div>
                <?php endif; ?>
                
                <!-- Aperçu de la nouvelle image -->
                <div class="image-preview" id="imagePreview">
                    <img src="" alt="Aperçu">
                </div>
            </div>

            <div class="form-group">
                <label for="{{ form.description.id_for_label }}" class="form-label">Description</label>
                <?= e($form->description) ?>
                {% if form.description.help_text %}
                    <small class="form-text">{{ form.description.help_text }}</small>
                <?php endif; ?>
                {% if form.description.errors %}
                    <div class="text-danger">{{ form.description.errors }}</div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <div class="form-check">
                    <?= e($form->is_video) ?>
                    <label for="{{ form.is_video.id_for_label }}" class="form-check-label">
                        C'est une vidéo
                    </label>
                </div>
                {% if form.is_video.help_text %}
                    <small class="form-text">{{ form.is_video.help_text }}</small>
                <?php endif; ?>
                {% if form.is_video.errors %}
                    <div class="text-danger">{{ form.is_video.errors }}</div>
                <?php endif; ?>
            </div>

            <div class="form-group" id="videoUrlGroup" style="display: none;">
                <label for="{{ form.video_url.id_for_label }}" class="form-label">URL de la vidéo</label>
                <?= e($form->video_url) ?>
                {% if form.video_url.help_text %}
                    <small class="form-text">{{ form.video_url.help_text }}</small>
                <?php endif; ?>
                {% if form.video_url.errors %}
                    <div class="text-danger">{{ form.video_url.errors }}</div>
                <?php endif; ?>
                
                <div class="video-info">
                    <h6>Formats supportés :</h6>
                    <p>• YouTube : https://www.youtube.com/watch?v=VIDEO_ID</p>
                    <p>• Vimeo : https://vimeo.com/VIDEO_ID</p>
                    <p>• Fichier vidéo direct : https://example.com/video.mp4</p>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Mettre à jour
                </button>
                <a href="<?= url('admin_gallery') ?>" class="btn btn-secondary ml-2">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Aperçu de l'image
    const imageInput = document.getElementById('{{ form.image.id_for_label }}');
    const imagePreview = document.getElementById('imagePreview');
    
    imageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.querySelector('img').src = e.target.result;
                imagePreview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            imagePreview.style.display = 'none';
        }
    });
    
    // Gestion du champ vidéo
    const isVideoCheckbox = document.getElementById('{{ form.is_video.id_for_label }}');
    const videoUrlGroup = document.getElementById('videoUrlGroup');
    const imageGroup = document.querySelector('label[for="{{ form.image.id_for_label }}"]').parentElement;
    
    isVideoCheckbox.addEventListener('change', function() {
        if (this.checked) {
            videoUrlGroup.style.display = 'block';
            imageGroup.style.display = 'none';
        } else {
            videoUrlGroup.style.display = 'none';
            imageGroup.style.display = 'block';
        }
    });
    
    // Initialiser l'état selon la valeur actuelle
    if (isVideoCheckbox.checked) {
        videoUrlGroup.style.display = 'block';
        imageGroup.style.display = 'none';
    }
});
</script>