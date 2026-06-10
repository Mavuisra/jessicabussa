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

echo "Configuration environnement..."
if [ ! -f .env.production ] && [ -f .env.production.example ]; then
    cp .env.production.example .env.production
    echo "→ .env.production créé depuis l'exemple — complétez DB_PASSWORD et MAIL_PASSWORD"
fi
if [ ! -f .env ] && [ -f .env.production ]; then
    cp .env.production .env
    echo "→ .env créé (optionnel : l'app charge aussi .env.production directement)"
fi

echo "Permissions storage/media..."
chmod -R 775 storage media 2>/dev/null || true

if [ -f database/db.sqlite3 ]; then
    echo "Migration SQLite → MySQL..."
    php scripts/migrate-sqlite-to-mysql.php --install-schema || true
fi

echo "OK — vérifiez que index.php est à la racine du site."
echo "Sans db.sqlite3 sur le serveur : importez database/schema.mysql.sql puis database/data.mysql.sql dans phpMyAdmin."
