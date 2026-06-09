<div class="space-y-6">
    <!-- Page header -->
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-800">Supprimer l'article</h1>
        <a href="<?= url('admin_articles') ?>" class="text-gray-600 hover:text-primary">
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
                    Vous êtes sur le point de supprimer l'article "<?= e($object->title) ?>". Cette action est irréversible.
                </p>
                <form method="post" class="flex justify-center space-x-4">
                    <?= csrf_field() ?>
                    <a href="<?= url('admin_articles') ?>" class="px-4 py-2 border rounded-lg hover:bg-gray-50">
                        Annuler
                    </a>
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                        Supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>