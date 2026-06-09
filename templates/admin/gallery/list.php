<?php $extra_css = <<<'HTML_BLOCK'
<style>
    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 1.5rem;
        margin-top: 1.5rem;
    }
    
    .gallery-item {
        background: white;
        border-radius: 12px;
        border: 1px solid #e5e7eb;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }
    
    .gallery-item:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        border-color: #4F46E5;
    }
    
    .gallery-item img {
        width: 100%;
        height: 180px;
        object-fit: cover;
    }
    
    .gallery-item .content {
        padding: 1rem;
    }
    
    .gallery-item .title {
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: #1f2937;
        font-size: 0.875rem;
        line-height: 1.4;
    }
    
    .gallery-item .category {
        font-size: 0.75rem;
        color: #6b7280;
        margin-bottom: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-weight: 500;
    }
    
    .gallery-item .actions {
        display: flex;
        gap: 0.5rem;
        justify-content: flex-end;
    }
    
    .action-btn {
        padding: 0.5rem;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        transition: all 0.2s ease;
        font-size: 0.875rem;
    }
    
    .action-btn.edit {
        background: #f3f4f6;
        color: #4F46E5;
    }
    
    .action-btn.edit:hover {
        background: #e0e7ff;
        color: #3730a3;
    }
    
    .action-btn.delete {
        background: #fef2f2;
        color: #dc2626;
    }
    
    .action-btn.delete:hover {
        background: #fee2e2;
        color: #b91c1c;
    }
    
    .empty-state {
        text-align: center;
        padding: 3rem 1rem;
        background: white;
        border-radius: 12px;
        border: 1px solid #e5e7eb;
    }
    
    .empty-state i {
        font-size: 3rem;
        color: #d1d5db;
        margin-bottom: 1rem;
    }
    
    .empty-state h3 {
        color: #6b7280;
        font-size: 1.125rem;
        margin-bottom: 0.5rem;
    }
    
    .empty-state p {
        color: #9ca3af;
        margin-bottom: 1.5rem;
    }
</style>
HTML_BLOCK; ?>

<!-- Header -->
<header class="mb-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Gestion de la Galerie</h1>
            <p class="text-gray-500">Gérez les images et vidéos de votre galerie</p>
        </div>
        <div class="flex items-center space-x-4">
            <a href="<?= url('admin_gallery_create') ?>" class="inline-flex items-center px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition-colors">
                <i class="fas fa-plus mr-2"></i>
                Ajouter une image
            </a>
        </div>
    </div>
</header>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Total Images</p>
                <h3 class="text-2xl font-bold text-gray-800"><?= e($total_items) ?></h3>
            </div>
            <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                <i class="fas fa-images"></i>
            </div>
        </div>
        <div class="mt-4">
            <div class="flex items-center text-sm">
                <span class="text-primary flex items-center">
                    <i class="fas fa-layer-group mr-1"></i>
                    Galerie complète
                </span>
                <span class="text-gray-500 ml-2">images et vidéos</span>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Fondation</p>
                <h3 class="text-2xl font-bold text-gray-800"><?= e($foundation_items) ?></h3>
            </div>
            <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center text-green-500">
                <i class="fas fa-heart"></i>
            </div>
        </div>
        <div class="mt-4">
            <div class="flex items-center text-sm">
                <span class="text-green-500 flex items-center">
                    <i class="fas fa-hand-holding-heart mr-1"></i>
                    Activités sociales
                </span>
                <span class="text-gray-500 ml-2">images de fondation</span>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Consulting</p>
                <h3 class="text-2xl font-bold text-gray-800"><?= e($consulting_items) ?></h3>
            </div>
            <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center text-blue-500">
                <i class="fas fa-briefcase"></i>
            </div>
        </div>
        <div class="mt-4">
            <div class="flex items-center text-sm">
                <span class="text-blue-500 flex items-center">
                    <i class="fas fa-chart-line mr-1"></i>
                    Services professionnels
                </span>
                <span class="text-gray-500 ml-2">images de consulting</span>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Événements</p>
                <h3 class="text-2xl font-bold text-gray-800"><?= e($events_items) ?></h3>
            </div>
            <div class="w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center text-purple-500">
                <i class="fas fa-calendar-alt"></i>
            </div>
        </div>
        <div class="mt-4">
            <div class="flex items-center text-sm">
                <span class="text-purple-500 flex items-center">
                    <i class="fas fa-star mr-1"></i>
                    Moments forts
                </span>
                <span class="text-gray-500 ml-2">images d'événements</span>
            </div>
        </div>
    </div>
</div>

<!-- Gallery Content -->
<div class="bg-white rounded-xl shadow-sm border border-gray-100">
    <div class="p-6 border-b border-gray-100">
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-semibold text-gray-800">Images de la Galerie</h3>
            <div class="flex items-center space-x-2">
                <span class="text-sm text-gray-500">{{ gallery_items|length }} éléments</span>
            </div>
        </div>
    </div>
    
    <div class="p-6">
        <?php if ($gallery_items): ?>
            <div class="gallery-grid">
                <?php $__loop_items = $gallery_items; foreach ($gallery_items as $item): ?>
                    <div class="gallery-item">
                        <?php if ($item->image): ?>
                            <img src="<?= e(media_url($item->image ?? '')) ?>" alt="<?= e($item->title) ?>">
                        <?php else: ?>
                            <div style="height: 180px; background: #f3f4f6; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-image text-gray-400 text-2xl"></i>
                            </div>
                        <?php endif; ?>
                        
                        <div class="content">
                            <div class="title"><?= e($item->title) ?></div>
                            <div class="category"><?= e($item->getCategoryDisplay()) ?></div>
                            
                            <div class="actions">
                                <a href="<?= url('admin_gallery_edit', $item->pk) ?>" class="action-btn edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="<?= url('admin_gallery_delete', $item->pk) ?>" class="action-btn delete">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Pagination -->
            <?php if ($is_paginated): ?>
                <div class="mt-8 flex items-center justify-between">
                    <div class="text-sm text-gray-500">
                        Affichage de <?= e($page_obj->start_index) ?> à <?= e($page_obj->end_index) ?> sur {{ page_obj.paginator.count }} éléments
                    </div>
                    <div class="flex items-center space-x-2">
                        <?php if ($page_obj->has_previous): ?>
                            <a href="?page=1" class="px-3 py-1 text-sm bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">
                                <i class="fas fa-angle-double-left mr-1"></i>Première
                            </a>
                            <a href="?page=<?= e($page_obj->previous_page_number) ?>" class="px-3 py-1 text-sm bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">
                                <i class="fas fa-angle-left mr-1"></i>Précédent
                            </a>
                        <?php endif; ?>
                        
                        <span class="px-3 py-1 text-sm bg-primary text-white rounded-lg">
                            <?= e($page_obj->number) ?> / {{ page_obj.paginator.num_pages }}
                        </span>
                        
                        <?php if ($page_obj->has_next): ?>
                            <a href="?page=<?= e($page_obj->next_page_number) ?>" class="px-3 py-1 text-sm bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">
                                Suivant<i class="fas fa-angle-right ml-1"></i>
                            </a>
                            <a href="?page={{ page_obj.paginator.num_pages }}" class="px-3 py-1 text-sm bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">
                                Dernière<i class="fas fa-angle-double-right ml-1"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        <?php else: ?>
            <div class="empty-state">
                <i class="fas fa-images"></i>
                <h3>Aucune image dans la galerie</h3>
                <p>Commencez par ajouter votre première image ou vidéo.</p>
                <a href="<?= url('admin_gallery_create') ?>" class="inline-flex items-center px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition-colors">
                    <i class="fas fa-plus mr-2"></i>
                    Ajouter une image
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>