<?php
$isEdit = isset($item) && $item;
$itemTitle = $isEdit ? (string) $item->title : '';
$itemCategory = old('category', $isEdit ? (string) $item->category : 'personal');
$itemDescription = old('description', $isEdit ? (string) ($item->description ?? '') : '');
$itemVideoUrl = old('video_url', $isEdit ? (string) ($item->video_url ?? '') : '');
$itemImage = $isEdit ? (string) ($item->image ?? '') : '';
$isVideoChecked = (bool) old('is_video', $isEdit ? (bool) $item->is_video : false);

$extra_css = <<<'HTML_BLOCK'
<style>
    .form-container { max-width: 600px; margin: 0 auto; }
    .form-group { margin-bottom: 20px; }
    .form-label { font-weight: 600; color: #374151; margin-bottom: 8px; display: block; }
    .form-control {
        border: 1px solid #d1d5db; border-radius: 6px; padding: 10px 12px; font-size: 14px;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }
    .form-control:focus {
        border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1); outline: none;
    }
    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none; padding: 10px 20px; border-radius: 6px; font-weight: 600;
    }
    .btn-secondary { background: #6b7280; border: none; padding: 10px 20px; border-radius: 6px; font-weight: 600; }
    .current-image {
        max-width: 200px; max-height: 200px; border-radius: 8px;
        border: 2px solid #d1d5db; padding: 10px; margin-top: 10px;
    }
    .current-image img { width: 100%; height: 100%; object-fit: cover; border-radius: 4px; }
    .image-preview {
        max-width: 200px; max-height: 200px; border-radius: 8px; border: 2px dashed #d1d5db;
        padding: 10px; margin-top: 10px; display: none;
    }
    .image-preview img { width: 100%; height: 100%; object-fit: cover; border-radius: 4px; }
    .video-info {
        background: #f3f4f6; border-radius: 6px; padding: 15px; margin-top: 10px; border-left: 4px solid #3b82f6;
    }
    .video-info h6 { color: #1f2937; margin-bottom: 8px; }
    .video-info p { color: #6b7280; font-size: 0.875rem; margin: 0; }
</style>
HTML_BLOCK;

$extra_js = <<<'HTML_BLOCK'
<script>
document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.getElementById('id_image');
    const imagePreview = document.getElementById('imagePreview');
    const isVideoCheckbox = document.getElementById('id_is_video');
    const videoUrlGroup = document.getElementById('videoUrlGroup');
    const imageGroup = document.getElementById('imageGroup');
    if (!imageInput || !isVideoCheckbox) return;

    imageInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (!file) { imagePreview.style.display = 'none'; return; }
        const reader = new FileReader();
        reader.onload = function(ev) {
            imagePreview.querySelector('img').src = ev.target.result;
            imagePreview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    });

    function toggleVideoFields() {
        const showVideo = isVideoCheckbox.checked;
        videoUrlGroup.style.display = showVideo ? 'block' : 'none';
        imageGroup.style.display = showVideo ? 'none' : 'block';
    }
    isVideoCheckbox.addEventListener('change', toggleVideoFields);
    toggleVideoFields();
});
</script>
HTML_BLOCK;
?>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800"><?= $isEdit ? 'Modifier l\'image' : 'Ajouter une image' ?></h1>
            <p class="text-muted"><?= $isEdit ? 'Modifiez les informations de cette image' : 'Ajoutez une nouvelle image ou vidéo à la galerie' ?></p>
        </div>
        <a href="<?= url('admin_gallery') ?>" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Retour à la liste
        </a>
    </div>

    <div class="form-container">
        <form method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>

            <div class="form-group">
                <label for="id_title" class="form-label">Titre *</label>
                <input type="text" name="title" id="id_title" class="form-control"
                       value="<?= e(old('title', $itemTitle)) ?>" required>
            </div>

            <div class="form-group">
                <label for="id_category" class="form-label">Catégorie *</label>
                <select name="category" id="id_category" class="form-control" required>
                    <option value="foundation"<?php if ($itemCategory === 'foundation'): ?> selected<?php endif; ?>>Fondation</option>
                    <option value="consulting"<?php if ($itemCategory === 'consulting'): ?> selected<?php endif; ?>>Consulting</option>
                    <option value="events"<?php if ($itemCategory === 'events'): ?> selected<?php endif; ?>>Événements</option>
                    <option value="personal"<?php if ($itemCategory === 'personal'): ?> selected<?php endif; ?>>Personnel</option>
                </select>
            </div>

            <div class="form-group" id="imageGroup">
                <label for="id_image" class="form-label">Image</label>
                <input type="file" name="image" id="id_image" class="form-control" accept="image/*">
                <?php if ($itemImage !== ''): ?>
                <div class="current-image">
                    <img src="<?= e(media_url($itemImage)) ?>" alt="<?= e($itemTitle) ?>">
                    <p class="text-muted mt-2 mb-0">Image actuelle</p>
                </div>
                <?php endif; ?>
                <div class="image-preview" id="imagePreview">
                    <img src="" alt="Aperçu">
                </div>
            </div>

            <div class="form-group">
                <label for="id_description" class="form-label">Description</label>
                <textarea name="description" id="id_description" class="form-control" rows="4"><?= e($itemDescription) ?></textarea>
            </div>

            <div class="form-group">
                <div class="form-check">
                    <input type="checkbox" name="is_video" id="id_is_video" class="form-check-input"<?php if ($isVideoChecked): ?> checked<?php endif; ?>>
                    <label for="id_is_video" class="form-check-label">C'est une vidéo</label>
                </div>
            </div>

            <div class="form-group" id="videoUrlGroup" style="display: none;">
                <label for="id_video_url" class="form-label">URL de la vidéo</label>
                <input type="url" name="video_url" id="id_video_url" class="form-control"
                       value="<?= e($itemVideoUrl) ?>" placeholder="https://www.youtube.com/watch?v=...">
                <div class="video-info">
                    <h6>Formats supportés :</h6>
                    <p>• YouTube : https://www.youtube.com/watch?v=VIDEO_ID</p>
                    <p>• Vimeo : https://vimeo.com/VIDEO_ID</p>
                    <p>• Fichier vidéo direct : https://example.com/video.mp4</p>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> <?= $isEdit ? 'Mettre à jour' : 'Ajouter' ?>
                </button>
                <a href="<?= url('admin_gallery') ?>" class="btn btn-secondary ml-2">Annuler</a>
            </div>
        </form>
    </div>
</div>
