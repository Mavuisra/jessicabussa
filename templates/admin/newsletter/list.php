<div class="space-y-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Newsletter</h1>
        <p class="text-sm text-gray-500">
            Total: <?= e($total_subscribers) ?> · Actifs: <?= e($active_subscribers) ?> · Désinscrits: <?= e($unsubscribed_count) ?>
        </p>
    </div>

    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 border-b">
                <tr class="text-left text-sm text-gray-500">
                    <th class="p-4">Email</th>
                    <th class="p-4">Statut</th>
                    <th class="p-4">Inscrit le</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                <?php foreach ($subscribers as $sub): ?>
                <tr>
                    <td class="p-4"><?= e($sub->email) ?></td>
                    <td class="p-4"><?= e($sub->status) ?></td>
                    <td class="p-4 text-sm text-gray-500"><?= e(date('d/m/Y', strtotime((string) ($sub->subscribed_at ?? $sub->created_at ?? 'now')))) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php if (!$subscribers): ?>
        <p class="p-8 text-center text-gray-500">Aucun abonné.</p>
        <?php endif; ?>
    </div>
</div>
