<div class="space-y-6 max-w-3xl">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-800">Message de <?= e($contact->name) ?></h1>
        <a href="<?= url('admin_contacts') ?>" class="text-primary">← Retour</a>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6 space-y-4">
        <p><strong>Email :</strong> <a href="mailto:<?= e($contact->email) ?>"><?= e($contact->email) ?></a></p>
        <?php if ($contact->subject ?? null): ?>
        <p><strong>Sujet :</strong> <?= e($contact->subject) ?></p>
        <?php endif; ?>
        <p><strong>Date :</strong> <?= e(date('d/m/Y H:i', strtotime((string) $contact->created_at))) ?></p>
        <p><strong>Statut :</strong> <?= e($contact->status) ?></p>
        <div class="border-t pt-4">
            <strong>Message :</strong>
            <p class="mt-2 whitespace-pre-wrap text-gray-700"><?= e($contact->message) ?></p>
        </div>
    </div>
</div>
