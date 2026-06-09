<div class="space-y-6">
    <!-- Page header -->
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-800">Supprimer l'événement</h1>
        <a href="<?= url('admin_events') ?>" class="text-gray-600 hover:text-primary">
            <i class="fas fa-arrow-left mr-2"></i>Retour à la liste
        </a>
    </div>

    <!-- Delete confirmation -->
    <div class="bg-white rounded-xl shadow-sm">
        <div class="p-6">
            <div class="text-center">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-exclamation-triangle text-red-600 text-2xl"></i>
                </div>
                <h2 class="text-xl font-semibold text-gray-800 mb-2">Êtes-vous sûr ?</h2>
                <p class="text-gray-600 mb-6">
                    Vous êtes sur le point de supprimer l'événement "<?= e($object->title) ?>". Cette action est irréversible.
                </p>
                
                <!-- Event details -->
                <div class="bg-gray-50 rounded-lg p-4 mb-6 text-left max-w-md mx-auto">
                    <div class="flex items-center space-x-3 mb-3">
                        <?php if ($object->featured_image): ?>
                        <img src="<?= e(media_url($object->featured_image ?? '')) ?>" alt="<?= e($object->title) ?>" class="w-12 h-12 object-cover rounded-lg">
                        <?php else: ?>
                        <div class="w-12 h-12 bg-gray-200 rounded-lg flex items-center justify-center">
                            <i class="fas fa-calendar-alt text-gray-400"></i>
                        </div>
                        <?php endif; ?>
                        <div>
                            <h3 class="font-medium text-gray-800"><?= e($object->title) ?></h3>
                            <p class="text-sm text-gray-500"><?= e(event_type_label($object->event_type ?? '')) ?></p>
                        </div>
                    </div>
                    <div class="text-sm text-gray-600 space-y-1">
                        <div class="flex items-center">
                            <i class="fas fa-calendar-alt w-4 mr-2"></i>
                            <?= e(date('d M Y', strtotime((string) ($object->date ?? '')))) ?>
                            <?php if ($object->time): ?>
                            à {{ object.time|time:"H:i" }}
                            <?php endif; ?>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-map-marker-alt w-4 mr-2"></i>
                            <?= e($object->location) ?>
                            <?php if ($object->city): ?>, <?= e($object->city) ?><?php endif; ?>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-eye w-4 mr-2"></i>
                            <?= e($object->views) ?> vues
                        </div>
                    </div>
                </div>
                
                <form method="post" class="flex justify-center space-x-4">
                    <?= csrf_field() ?>
                    <a href="<?= url('admin_events') ?>" class="px-4 py-2 border rounded-lg hover:bg-gray-50">
                        Annuler
                    </a>
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                        Supprimer définitivement
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>