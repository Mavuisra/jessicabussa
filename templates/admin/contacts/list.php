<div class="space-y-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Messages de contact</h1>
            <p class="text-sm text-gray-500">
                Total: <?= e($total_contacts) ?> · Nouveaux: <?= e($new_contacts) ?> · Lus: <?= e($read_contacts) ?> · Répondus: <?= e($replied_contacts) ?>
            </p>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 border-b">
                <tr class="text-left text-sm text-gray-500">
                    <th class="p-4">Nom</th>
                    <th class="p-4">Email</th>
                    <th class="p-4">Sujet</th>
                    <th class="p-4">Statut</th>
                    <th class="p-4">Date</th>
                    <th class="p-4"></th>
                </tr>
            </thead>
            <tbody class="divide-y">
                <?php foreach ($contacts as $contact): ?>
                <tr class="hover:bg-gray-50">
                    <td class="p-4 font-medium"><?= e($contact->name) ?></td>
                    <td class="p-4"><?= e($contact->email) ?></td>
                    <td class="p-4"><?= e($contact->subject ?? '') ?></td>
                    <td class="p-4"><span class="px-2 py-1 text-xs rounded-full bg-gray-100"><?= e($contact->status) ?></span></td>
                    <td class="p-4 text-sm text-gray-500"><?= e(date('d/m/Y H:i', strtotime((string) $contact->created_at))) ?></td>
                    <td class="p-4"><a href="<?= url('admin_contact_detail', $contact->id) ?>" class="text-primary">Voir</a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php if (!$contacts): ?>
        <p class="p-8 text-center text-gray-500">Aucun message.</p>
        <?php endif; ?>
    </div>
</div>
