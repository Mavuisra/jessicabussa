<?php

declare(strict_types=1);

/**
 * Extrait les images base64 intégrées dans le HTML (éditeur Quill)
 * vers media/inline/ et remplace les src par des URLs /media/...
 *
 * Usage :
 *   php scripts/extract-inline-images.php              # SQLite local
 *   php scripts/extract-inline-images.php --mysql    # MySQL (.env.production)
 */

$root = dirname(__DIR__);
require $root . '/bootstrap/app.php';
bootstrap_app($root . '/index.php');

use App\Core\Database;
use App\Services\InlineImageExtractor;

$useMysql = in_array('--mysql', $argv ?? [], true);
$pdo = $useMysql ? Database::connection() : new PDO('sqlite:' . $root . '/database/db.sqlite3');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

/** @var list<array{table: string, column: string}> */
$targets = [
    ['table' => 'portefolio_article', 'column' => 'content'],
    ['table' => 'portefolio_article', 'column' => 'excerpt'],
    ['table' => 'portefolio_event', 'column' => 'content'],
    ['table' => 'portefolio_event', 'column' => 'excerpt'],
    ['table' => 'portefolio_event', 'column' => 'description'],
    ['table' => 'portefolio_blog', 'column' => 'content'],
    ['table' => 'portefolio_emailcampaign', 'column' => 'content'],
];

$totalExtracted = 0;
$totalUpdated = 0;

foreach ($targets as ['table' => $table, 'column' => $column]) {
    $stmt = $pdo->query("SELECT `id`, `$column` FROM `$table` WHERE `$column` LIKE '%data:image%'");

    foreach ($stmt ?: [] as $row) {
        $original = (string) ($row[$column] ?? '');
        [$html, $count] = InlineImageExtractor::extractFromHtml($original);

        if ($count === 0) {
            continue;
        }

        $update = $pdo->prepare("UPDATE `$table` SET `$column` = ? WHERE `id` = ?");
        $update->execute([$html, $row['id']]);

        $totalExtracted += $count;
        $totalUpdated++;
        echo "  $table#{$row['id']}.$column : $count image(s) extraite(s)\n";
    }
}

echo "\nTerminé : $totalExtracted image(s) extraites, $totalUpdated enregistrement(s) mis à jour.\n";
echo 'Dossier : ' . media_path('inline') . "\n";
