<?php $extra_css = <<<'HTML_BLOCK'
<style>
    .delete-container {
        max-width: 500px;
        margin: 0 auto;
    }
    
    .warning-card {
        background: #fef2f2;
        border: 1px solid #fecaca;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
    }
    
    .warning-icon {
        color: #dc2626;
        font-size: 2rem;
        margin-bottom: 10px;
    }
    
    .warning-title {
        color: #dc2626;
        font-weight: 600;
        margin-bottom: 10px;
    }
    
    .warning-text {
        color: #7f1d1d;
        font-size: 0.875rem;
    }
    
    .item-preview {
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
    }
    
    .item-image {
        max-width: 150px;
        max-height: 150px;
        border-radius: 6px;
        margin-bottom: 15px;
    }
    
    .item-title {
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 5px;
    }
    
    .item-category {
        color: #6b7280;
        font-size: 0.875rem;
        margin-bottom: 10px;
    }
    
    .item-description {
        color: #4b5563;
        font-size: 0.875rem;
    }
    
    .btn-danger {
        background: #dc2626;
        border: none;
        padding: 10px 20px;
        border-radius: 6px;
        font-weight: 600;
        transition: background-color 0.2s ease;
    }
    
    .btn-danger:hover {
        background: #b91c1c;
    }
    
    .btn-secondary {
        background: #6b7280;
        border: none;
        padding: 10px 20px;
        border-radius: 6px;
        font-weight: 600;
    }
</style>
HTML_BLOCK; ?>

<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Supprimer l'image</h1>
            <p class="text-muted">Confirmez la suppression de cette image</p>
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

    <!-- Contenu -->
    <div class="delete-container">
        <!-- Avertissement -->
        <div class="warning-card">
            <div class="text-center">
                <i class="fas fa-exclamation-triangle warning-icon"></i>
                <div class="warning-title">Attention !</div>
                <div class="warning-text">
                    Cette action est irréversible. L'image sera définitivement supprimée de votre galerie.
                </div>
            </div>
        </div>

        <!-- Aperçu de l'élément à supprimer -->
        <div class="item-preview">
            <div class="text-center">
                <?php if ($object->image): ?>
                    <img src="<?= e(media_url($object->image ?? '')) ?>" alt="<?= e($object->title) ?>" class="item-image">
                <?php else: ?>
                    <div class="item-image" style="background: #f3f4f6; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-image text-gray-400" style="font-size: 2rem;"></i>
                    </div>
                <?php endif; ?>
                
                <div class="item-title"><?= e($object->title) ?></div>
                <div class="item-category"><?= e($object->getCategoryDisplay()) ?></div>
                <?php if ($object->description): ?>
                    <div class="item-description"><?= e($object->description) ?></div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Formulaire de confirmation -->
        <form method="post">
            <?= csrf_field() ?>
            <div class="text-center">
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-trash"></i> Supprimer définitivement
                </button>
                <a href="<?= url('admin_gallery') ?>" class="btn btn-secondary ml-2">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>