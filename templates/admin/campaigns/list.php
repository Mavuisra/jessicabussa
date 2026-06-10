<div class="space-y-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Campagnes email</h1>
            <p class="text-sm text-gray-500">
                Total: <?= e($total_campaigns) ?> · Brouillons: <?= e($draft_campaigns) ?> · Envoyées: <?= e($sent_campaigns) ?>
            </p>
        </div>
        <a href="<?= url('admin_campaign_create') ?>" class="bg-primary text-white px-4 py-2 rounded-lg">Nouvelle campagne</a>
    </div>

    <div class="bg-white rounded-xl shadow-sm divide-y">
        <?php foreach ($campaigns as $campaign): ?>
        <div class="p-4 flex justify-between items-center hover:bg-gray-50">
            <div>
                <p class="font-medium"><?= e($campaign->title) ?></p>
                <p class="text-sm text-gray-500"><?= e($campaign->subject) ?> · <?= e($campaign->status) ?></p>
            </div>
            <a href="<?= url('admin_campaign_detail', $campaign->id) ?>" class="text-primary">Détail</a>
        </div>
        <?php endforeach; ?>
        <?php if (!$campaigns): ?>
        <p class="p-8 text-center text-gray-500">Aucune campagne.</p>
        <?php endif; ?>
    </div>
</div>
