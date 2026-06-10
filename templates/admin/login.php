<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion — Administration</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root { --primary-color: #4F46E5; --secondary-color: #7C3AED; }
        .bg-primary { background-color: var(--primary-color); }
        .text-primary { color: var(--primary-color); }
        .from-primary { --tw-gradient-from: var(--primary-color); }
        .to-secondary { --tw-gradient-to: var(--secondary-color); }
    </style>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen bg-gradient-to-br from-primary/5 to-secondary/5 flex items-center justify-center p-4">
        <div class="max-w-md w-full">
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="relative h-32 bg-gradient-to-r from-primary to-secondary">
                    <div class="absolute inset-0 flex items-center justify-center text-center text-white">
                        <div>
                            <h1 class="text-3xl font-serif mb-2">Administration</h1>
                            <p class="text-white/80">Jessica Bussa</p>
                        </div>
                    </div>
                </div>

                <div class="p-8">
                    <?php if ($err = flash('error')): ?>
                    <div class="mb-4 p-4 rounded-lg bg-red-100 text-red-700"><?= e($err) ?></div>
                    <?php endif; ?>
                    <?php if ($ok = flash('success')): ?>
                    <div class="mb-4 p-4 rounded-lg bg-green-100 text-green-700"><?= e($ok) ?></div>
                    <?php endif; ?>

                    <form method="post" class="space-y-6">
                        <?= csrf_field() ?>
                        <div>
                            <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Nom d'utilisateur</label>
                            <input type="text" name="username" id="username" required
                                   value="<?= e(old('username')) ?>"
                                   class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary">
                        </div>
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Mot de passe</label>
                            <input type="password" name="password" id="password" required
                                   class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary">
                        </div>
                        <button type="submit" class="w-full bg-primary text-white py-2 px-4 rounded-lg hover:bg-primary/90">
                            Se connecter
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
