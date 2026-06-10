<div class="space-y-6 max-w-3xl">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-800"><?= e($campaign->title) ?></h1>
        <a href="<?= url('admin_campaigns') ?>" class="text-primary">← Retour</a>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6 space-y-4">
        <p><strong>Objet :</strong> <?= e($campaign->subject) ?></p>
        <p><strong>Statut :</strong> <?= e($campaign->status) ?></p>
        <p><strong>Destinataires actifs :</strong> <?= e($recipients_count) ?></p>
        <div class="border rounded-lg p-4 bg-gray-50 prose max-w-none">
            <?= (string) $campaign->content ?>
        </div>
        <?php if ($campaign->status === 'draft'): ?>
        <form method="post" action="<?= url('admin_campaign_send', $campaign->id) ?>">
            <?= csrf_field() ?>
            <button type="submit" class="bg-primary text-white px-4 py-2 rounded-lg">Envoyer la campagne</button>
        </form>
        <?php endif; ?>
    </div>
</div>
