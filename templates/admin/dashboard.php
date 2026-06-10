<div class="space-y-8">
    <header>
        <h1 class="text-2xl font-bold text-gray-800">Tableau de bord</h1>
        <p class="text-gray-500">Bienvenue dans votre espace d'administration</p>
    </header>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white rounded-xl shadow-sm p-6 border">
            <p class="text-sm text-gray-500">Articles</p>
            <h3 class="text-2xl font-bold"><?= e($total_articles) ?></h3>
            <p class="text-sm text-gray-400 mt-1"><?= e($published_articles) ?> publiés · <?= e($draft_articles) ?> brouillons</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-6 border">
            <p class="text-sm text-gray-500">Événements</p>
            <h3 class="text-2xl font-bold"><?= e($total_events) ?></h3>
            <p class="text-sm text-gray-400 mt-1"><?= e($upcoming_events) ?> à venir</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-6 border">
            <p class="text-sm text-gray-500">Vues articles</p>
            <h3 class="text-2xl font-bold"><?= e($total_views) ?></h3>
            <p class="text-sm text-gray-400 mt-1"><?= e($total_unique_visitors) ?> visiteurs uniques</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-6 border">
            <p class="text-sm text-gray-500">Contacts</p>
            <h3 class="text-2xl font-bold"><?= e($total_contacts) ?></h3>
            <p class="text-sm text-gray-400 mt-1"><?= e($new_contacts) ?> nouveaux</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white rounded-xl shadow-sm p-6 border">
            <h2 class="text-lg font-semibold mb-4">Articles récents</h2>
            <?php if ($recent_articles): ?>
            <ul class="divide-y">
                <?php foreach ($recent_articles as $article): ?>
                <li class="py-3 flex justify-between items-center">
                    <span class="font-medium text-gray-800"><?= e($article->title) ?></span>
                    <a href="<?= url('admin_article_edit', $article->id) ?>" class="text-primary text-sm">Modifier</a>
                </li>
                <?php endforeach; ?>
            </ul>
            <?php else: ?>
            <p class="text-gray-500">Aucun article.</p>
            <?php endif; ?>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 border">
            <h2 class="text-lg font-semibold mb-4">Événements récents</h2>
            <?php if ($recent_events): ?>
            <ul class="divide-y">
                <?php foreach ($recent_events as $event): ?>
                <li class="py-3 flex justify-between items-center">
                    <span class="font-medium text-gray-800"><?= e($event->title) ?></span>
                    <a href="<?= url('admin_event_edit', $event->id) ?>" class="text-primary text-sm">Modifier</a>
                </li>
                <?php endforeach; ?>
            </ul>
            <?php else: ?>
            <p class="text-gray-500">Aucun événement.</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <a href="<?= url('admin_article_create') ?>" class="bg-primary text-white text-center py-3 rounded-lg hover:bg-primary/90">Nouvel article</a>
        <a href="<?= url('admin_event_create') ?>" class="bg-primary text-white text-center py-3 rounded-lg hover:bg-primary/90">Nouvel événement</a>
        <a href="<?= url('admin_gallery_create') ?>" class="bg-primary text-white text-center py-3 rounded-lg hover:bg-primary/90">Ajouter à la galerie</a>
    </div>
</div>
