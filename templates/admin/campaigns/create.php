<div class="max-w-2xl space-y-6">
    <h1 class="text-2xl font-bold text-gray-800">Nouvelle campagne email</h1>

    <form method="post" class="bg-white rounded-xl shadow-sm p-6 space-y-4">
        <?= csrf_field() ?>
        <div>
            <label for="title" class="block text-sm font-medium mb-1">Titre interne</label>
            <input type="text" name="title" id="title" required class="w-full border rounded-lg px-3 py-2">
        </div>
        <div>
            <label for="subject" class="block text-sm font-medium mb-1">Objet de l'email</label>
            <input type="text" name="subject" id="subject" required class="w-full border rounded-lg px-3 py-2">
        </div>
        <div>
            <label for="content" class="block text-sm font-medium mb-1">Contenu HTML</label>
            <textarea name="content" id="content" rows="12" required class="w-full border rounded-lg px-3 py-2"></textarea>
        </div>
        <button type="submit" class="bg-primary text-white px-4 py-2 rounded-lg">Créer la campagne</button>
    </form>
</div>
