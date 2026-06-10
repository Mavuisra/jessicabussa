<?php

declare(strict_types=1);

/**
 * Migre les données SQLite → MySQL (LWS).
 *
 * Export SQL pour phpMyAdmin (depuis votre PC) :
 *   php scripts/migrate-sqlite-to-mysql.php --export database/data.mysql.sql
 *
 * Migration directe sur le serveur LWS (après upload de database/db.sqlite3) :
 *   php scripts/migrate-sqlite-to-mysql.php
 *
 * Schéma + données en une commande :
 *   php scripts/migrate-sqlite-to-mysql.php --install-schema
 */

$root = dirname(__DIR__);
require $root . '/bootstrap/app.php';
bootstrap_app($root . '/index.php');

use App\Core\Database;
use App\Core\EnvLoader;

final class SqliteToMysqlMigrator
{
    private const TABLE_ORDER = [
        'django_content_type',
        'auth_group',
        'auth_permission',
        'auth_group_permissions',
        'auth_user',
        'auth_user_groups',
        'auth_user_user_permissions',
        'django_migrations',
        'django_session',
        'django_admin_log',
        'portefolio_category',
        'portefolio_article',
        'portefolio_articlecomment',
        'portefolio_blog',
        'portefolio_blogcomment',
        'portefolio_blogvisitor',
        'portefolio_award',
        'portefolio_contact',
        'portefolio_emailcampaign',
        'portefolio_event',
        'portefolio_foundation',
        'portefolio_gallery',
        'portefolio_newsletter',
        'portefolio_partner',
        'portefolio_service',
        'portefolio_testimonial',
    ];

    public function __construct(
        private readonly PDO $sqlite,
        private readonly ?PDO $mysql = null,
    ) {
    }

    /** @return list<string> */
    public function sqliteTables(): array
    {
        $tables = [];
        $stmt = $this->sqlite->query(
            "SELECT name FROM sqlite_master WHERE type = 'table' AND name NOT LIKE 'sqlite_%' ORDER BY name"
        );

        foreach ($stmt ?: [] as $row) {
            $tables[] = (string) $row['name'];
        }

        return $tables;
    }

    /** @return list<string> */
    private function orderedTables(array $available): array
    {
        $ordered = [];

        foreach (self::TABLE_ORDER as $table) {
            if (in_array($table, $available, true)) {
                $ordered[] = $table;
            }
        }

        foreach ($available as $table) {
            if (!in_array($table, $ordered, true)) {
                $ordered[] = $table;
            }
        }

        return $ordered;
    }

    /** @return list<string> */
    private function sqliteColumns(string $table): array
    {
        $columns = [];
        $stmt = $this->sqlite->query("PRAGMA table_info(\"$table\")");

        foreach ($stmt ?: [] as $row) {
            $columns[] = (string) $row['name'];
        }

        return $columns;
    }

    /** @return list<string> */
    private function mysqlColumns(string $table): array
    {
        if (!$this->mysql instanceof PDO) {
            return $this->sqliteColumns($table);
        }

        $columns = [];
        $stmt = $this->mysql->query('SHOW COLUMNS FROM `' . str_replace('`', '``', $table) . '`');

        foreach ($stmt ?: [] as $row) {
            $columns[] = (string) $row['Field'];
        }

        return $columns;
    }

    /** @return list<array<string, mixed>> */
    private function fetchRows(string $table, array $columns): array
    {
        if ($columns === []) {
            return [];
        }

        $quoted = implode(', ', array_map(static fn (string $c): string => '"' . str_replace('"', '""', $c) . '"', $columns));
        $stmt = $this->sqlite->query("SELECT $quoted FROM \"$table\"");

        return $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
    }

    public function exportToFile(string $path): void
    {
        $tables = $this->orderedTables($this->sqliteTables());
        $lines = [
            '-- Données migrées depuis database/db.sqlite3',
            '-- Import phpMyAdmin : après schema.mysql.sql',
            'SET NAMES utf8mb4;',
            'SET FOREIGN_KEY_CHECKS = 0;',
        ];

        $totalRows = 0;

        foreach ($tables as $table) {
            $columns = array_values(array_intersect(
                $this->sqliteColumns($table),
                $this->mysqlColumns($table)
            ));

            $rows = $this->fetchRows($table, $columns);
            $lines[] = '';
            $lines[] = "DELETE FROM `$table`;";

            if ($rows === []) {
                $lines[] = "-- $table : 0 ligne";
                continue;
            }

            $columnList = implode(', ', array_map(static fn (string $c): string => "`$c`", $columns));

            foreach ($rows as $row) {
                $values = implode(', ', array_map(
                    fn (string $col): string => $this->quoteValue($row[$col] ?? null),
                    $columns
                ));
                $lines[] = "INSERT INTO `$table` ($columnList) VALUES ($values);";
            }

            $totalRows += count($rows);
            $lines[] = "-- $table : " . count($rows) . ' ligne(s)';
        }

        $lines[] = '';
        $lines[] = 'SET FOREIGN_KEY_CHECKS = 1;';

        file_put_contents($path, implode("\n", $lines) . "\n");

        echo "Export terminé : $path\n";
        echo count($tables) . " table(s), $totalRows ligne(s).\n";
    }

    public function migrate(bool $truncate = true): void
    {
        if (!$this->mysql instanceof PDO) {
            throw new RuntimeException('Connexion MySQL requise pour la migration directe.');
        }

        $tables = $this->orderedTables($this->sqliteTables());
        $this->mysql->exec('SET FOREIGN_KEY_CHECKS = 0');

        $totalRows = 0;

        if ($truncate) {
            foreach (array_reverse($tables) as $table) {
                $this->mysql->exec("DELETE FROM `$table`");
            }
        }

        foreach ($tables as $table) {
            $columns = array_values(array_intersect(
                $this->sqliteColumns($table),
                $this->mysqlColumns($table)
            ));

            $rows = $this->fetchRows($table, $columns);

            if ($rows === []) {
                echo "  $table : 0 ligne\n";
                continue;
            }

            $placeholders = implode(', ', array_fill(0, count($columns), '?'));
            $columnList = implode(', ', array_map(static fn (string $c): string => "`$c`", $columns));
            $sql = "INSERT INTO `$table` ($columnList) VALUES ($placeholders)";
            $stmt = $this->mysql->prepare($sql);

            foreach ($rows as $row) {
                $stmt->execute(array_map(static fn (string $col) => $row[$col] ?? null, $columns));
            }

            $totalRows += count($rows);
            echo '  ' . $table . ' : ' . count($rows) . " ligne(s)\n";
        }

        $this->mysql->exec('SET FOREIGN_KEY_CHECKS = 1');

        echo "Migration terminée — $totalRows ligne(s) importée(s).\n";
    }

    private function quoteValue(mixed $value): string
    {
        if ($value === null) {
            return 'NULL';
        }

        if (is_bool($value)) {
            return $value ? '1' : '0';
        }

        if (is_int($value) || is_float($value)) {
            return (string) $value;
        }

        return $this->mysql instanceof PDO
            ? $this->mysql->quote((string) $value)
            : "'" . str_replace(["\\", "'"], ["\\\\", "''"], (string) $value) . "'";
    }
}

function installSchema(PDO $pdo, string $schemaFile): void
{
    $sql = file_get_contents($schemaFile);
    if ($sql === false) {
        throw new RuntimeException("Impossible de lire $schemaFile");
    }

    $statements = array_filter(
        array_map('trim', preg_split('/;\s*\n/', $sql) ?: []),
        static fn (string $s): bool => $s !== '' && !str_starts_with($s, '--')
    );

    foreach ($statements as $statement) {
        if (preg_match('/^(SET\s|CREATE\s)/i', $statement) !== 1) {
            continue;
        }
        $pdo->exec($statement);
    }

    echo "Schéma MySQL installé.\n";
}

EnvLoader::load($root);

$sqlitePath = $root . '/database/db.sqlite3';
$exportPath = null;
$installSchema = in_array('--install-schema', $argv ?? [], true);

foreach ($argv ?? [] as $arg) {
    if (str_starts_with($arg, '--export=')) {
        $exportPath = substr($arg, 9);
    }
}

if ($exportPath === null && in_array('--export', $argv ?? [], true)) {
    $exportPath = $root . '/database/data.mysql.sql';
}

if (!is_file($sqlitePath)) {
    fwrite(STDERR, "Base SQLite introuvable : database/db.sqlite3\n");
    fwrite(STDERR, "Placez votre fichier db.sqlite3 dans le dossier database/.\n");
    exit(1);
}

$sqlite = new PDO('sqlite:' . $sqlitePath);
$sqlite->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($exportPath !== null) {
    $exportFull = str_starts_with($exportPath, '/') || preg_match('/^[A-Za-z]:/', $exportPath)
        ? $exportPath
        : $root . '/' . ltrim($exportPath, '/');

    $migrator = new SqliteToMysqlMigrator($sqlite);
    $migrator->exportToFile($exportFull);

    $fullInstall = $root . '/database/full-install.mysql.sql';
    $header = <<<'HDR'
-- INSTALLATION COMPLÈTE jessicabussa.cd
-- phpMyAdmin : sélectionnez la base lasav2675681_12lmwo → Importer → ce fichier UNIQUEMENT
-- (tables + données en une seule fois — ne pas importer data.mysql.sql séparément avant)

HDR;
    file_put_contents(
        $fullInstall,
        $header . file_get_contents($root . '/database/schema.mysql.sql') . "\n\n" . file_get_contents($exportFull)
    );
    echo "Fichier tout-en-un : database/full-install.mysql.sql\n";

    exit(0);
}

$config = config('database');
if (($config['driver'] ?? '') !== 'mysql') {
    fwrite(STDERR, "DB_DRIVER doit être mysql. Configurez .env.production sur le serveur.\n");
    exit(1);
}

echo "SQLite : database/db.sqlite3\n";
echo "MySQL  : {$config['database']} @ {$config['host']}\n\n";

try {
    $mysql = Database::connection();
} catch (Throwable $e) {
    fwrite(STDERR, 'Connexion MySQL impossible : ' . $e->getMessage() . "\n");
    exit(1);
}

if ($installSchema) {
    installSchema($mysql, $root . '/database/schema.mysql.sql');
}

$migrator = new SqliteToMysqlMigrator($sqlite, $mysql);
$migrator->migrate(true);

echo "\nComptes admin disponibles dans auth_user.\n";
echo "Testez https://www.jessicabussa.cd/\n";
