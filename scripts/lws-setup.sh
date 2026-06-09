#!/bin/bash
# À lancer sur LWS après git pull (htdocs/jessicabussa.cd)
set -e
cd "$(dirname "$0")/.."

echo "Suppression page par défaut LWS..."
rm -f default_index.html default.html index.html

echo "Installation dépendances PHP..."
if command -v composer >/dev/null 2>&1; then
    composer install --no-dev --no-interaction
elif [ -f composer.phar ]; then
    php composer.phar install --no-dev --no-interaction
else
    echo "Attention: composer absent — uploadez vendor/ depuis votre PC"
fi

echo "Permissions storage/media..."
chmod -R 775 storage media 2>/dev/null || true

echo "OK — vérifiez que index.php est à la racine du site."
