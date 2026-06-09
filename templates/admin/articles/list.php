<div class="space-y-6">
    <!-- Page header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Articles</h1>
            <p class="text-sm text-gray-500">
                Total: <?= e($total_articles) ?> | Publiés: <?= e($published_articles) ?> | Brouillons: <?= e($draft_articles) ?>
            </p>
        </div>
        <a href="<?= url('admin_article_create') ?>" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary/90 transition-colors">
            <i class="fas fa-plus mr-2"></i>Nouvel article
        </a>
    </div>

    <!-- Articles list -->
    <div class="bg-white rounded-xl shadow-sm">
        <div class="p-6 border-b">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold text-gray-800">Liste des articles</h2>
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <input type="text" placeholder="Rechercher..." class="pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary/20">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>
                    <select class="border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primary/20">
                        <option value="">Tous les statuts</option>
                        <option value="published">Publiés</option>
                        <option value="draft">Brouillons</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="text-left border-b">
                            <th class="pb-4 font-medium text-gray-500">Titre</th>
                            <th class="pb-4 font-medium text-gray-500">Catégorie</th>
                            <th class="pb-4 font-medium text-gray-500">Statut</th>
                            <th class="pb-4 font-medium text-gray-500">Date de création</th>
                            <th class="pb-4 font-medium text-gray-500">Vues</th>
                            <th class="pb-4 font-medium text-gray-500">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        <?php $__loop_items = $articles; foreach ($articles as $article): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="py-4">
                                <div class="flex items-center space-x-3">
                                    <?php if ($article->featured_image): ?>
                                    <img src="<?= e(media_url($article->featured_image ?? '')) ?>" alt="<?= e($article->title) ?>" class="w-10 h-10 object-cover rounded-lg">
                                    <?php else: ?>
                                    <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-image text-gray-400"></i>
                                    </div>
                                    <?php endif; ?>
                                    <span class="font-medium text-gray-800"><?= e($article->title) ?></span>
                                </div>
                            </td>
                            <td class="py-4 text-gray-600"><?= e($article->getCategoryDisplay()) ?></td>
                            <td class="py-4">
                                <span class="px-2 py-1 text-xs rounded-full <?php if ($article->status === 'published'): ?>bg-green-100 text-green-700<?php else: ?>bg-yellow-100 text-yellow-700<?php endif; ?>">
                                    <?= e($article->get_status_display) ?>
                                </span>
                            </td>
                            <td class="py-4 text-gray-600"><?= e(date('d M Y', strtotime((string) ($article->created_at ?? '')))) ?></td>
                            <td class="py-4 text-gray-600"><?= e($article->views) ?></td>
                            <td class="py-4">
                                <div class="flex items-center space-x-3">
                                    <a href="<?= url('admin_article_edit', $article->pk) ?>" class="text-gray-400 hover:text-primary" title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="<?= url('admin_article_delete', $article->pk) ?>" class="text-gray-400 hover:text-red-600" title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
<?php if (empty($__loop_items ?? [])): ?>

                        <tr>
                            <td colspan="6" class="py-8 text-center text-gray-500">
                                <div class="flex flex-col items-center">
                                    <i class="fas fa-newspaper text-4xl text-gray-300 mb-4"></i>
                                    <h3 class="text-lg font-medium text-gray-600 mb-2">Aucun article trouvé</h3>
                                    <p class="text-gray-500 mb-4">Commencez par créer votre premier article.</p>
                                    <a href="<?= url('admin_article_create') ?>" class="bg-primary text-white px-4 py-2 rounded-lg hover:bg-primary/90 transition-colors">
                                        <i class="fas fa-plus mr-2"></i>Créer un article
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <?php if ($is_paginated): ?>
            <div class="mt-6 flex justify-center">
                <nav class="flex items-center space-x-2">
                    <?php if ($page_obj->has_previous): ?>
                    <a href="?page=<?= e($page_obj->previous_page_number) ?>" class="px-3 py-2 border rounded-lg hover:bg-gray-50">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                    <?php endif; ?>

                    <?php foreach ($page_obj->paginator->page_range as $num): ?>
                    <?php if ($page_obj->number == $num): ?>
                    <span class="px-3 py-2 bg-primary text-white rounded-lg"><?= e($num) ?></span>
                    <?php else: ?>
                    <a href="?page=<?= e($num) ?>" class="px-3 py-2 border rounded-lg hover:bg-gray-50"><?= e($num) ?></a>
                    <?php endif; ?>
                    <?php endforeach; ?>

                    <?php if ($page_obj->has_next): ?>
                    <a href="?page=<?= e($page_obj->next_page_number) ?>" class="px-3 py-2 border rounded-lg hover:bg-gray-50">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                    <?php endif; ?>
                </nav>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>