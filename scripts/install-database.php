<?php

declare(strict_types=1);

/**
 * Installe le schéma MySQL sur LWS.
 *
 * Usage (SSH ou terminal LWS) :
 *   php scripts/install-database.php
 *
 * Vérifie uniquement :
 *   php scripts/install-database.php --check
 */

$root = dirname(__DIR__);
require $root . '/bootstrap/app.php';
bootstrap_app($root . '/index.php');

use App\Core\Database;
use App\Core\EnvLoader;

EnvLoader::load($root);

$checkOnly = in_array('--check', $argv ?? [], true);
$schemaFile = $root . '/database/schema.mysql.sql';

if (!is_file($schemaFile)) {
    fwrite(STDERR, "Fichier introuvable : database/schema.mysql.sql\n");
    exit(1);
}

$config = config('database');

if (($config['driver'] ?? '') !== 'mysql') {
    fwrite(STDERR, "DB_DRIVER doit être mysql (actuel : " . ($config['driver'] ?? 'inconnu') . ").\n");
    exit(1);
}

echo "Base cible : {$config['database']} @ {$config['host']}\n";

try {
    $pdo = Database::connection();
} catch (Throwable $e) {
    fwrite(STDERR, "Connexion impossible : {$e->getMessage()}\n");
    exit(1);
}

$existing = $pdo->query('SHOW TABLES')->fetchAll(PDO::FETCH_COLUMN);
$required = ['portefolio_service', 'portefolio_article', 'auth_user'];
$missing = array_values(array_diff($required, $existing));

if ($checkOnly) {
    if ($missing === []) {
        echo "OK — " . count($existing) . " table(s) présente(s).\n";
        exit(0);
    }

    fwrite(STDERR, "Tables manquantes : " . implode(', ', $missing) . "\n");
    exit(1);
}

if ($missing === [] && count($existing) >= count($required)) {
    echo "Le schéma semble déjà installé (" . count($existing) . " tables).\n";
    echo "Pour forcer la réinstallation, supprimez les tables dans phpMyAdmin puis relancez.\n";
    exit(0);
}

$sql = file_get_contents($schemaFile);
if ($sql === false) {
    fwrite(STDERR, "Impossible de lire schema.mysql.sql\n");
    exit(1);
}

$statements = array_filter(
    array_map('trim', preg_split('/;\s*\n/', $sql) ?: []),
    static fn (string $statement): bool => $statement !== '' && !str_starts_with($statement, '--')
);

$executed = 0;

foreach ($statements as $statement) {
    if (preg_match('/^(SET\s|CREATE\s)/i', $statement) !== 1) {
        continue;
    }

    try {
        $pdo->exec($statement);
        $executed++;
    } catch (PDOException $e) {
        if (str_contains($e->getMessage(), 'already exists')) {
            continue;
        }

        fwrite(STDERR, "Erreur SQL : {$e->getMessage()}\n");
        fwrite(STDERR, substr($statement, 0, 120) . "...\n");
        exit(1);
    }
}

$tables = $pdo->query('SHOW TABLES')->fetchAll(PDO::FETCH_COLUMN);

echo "Installation terminée — {$executed} instruction(s) exécutée(s), " . count($tables) . " table(s).\n";

if (!in_array('portefolio_service', $tables, true)) {
    fwrite(STDERR, "Attention : portefolio_service est toujours absente.\n");
    exit(1);
}

echo "Le site peut maintenant charger la page d'accueil.\n";
