<?php

declare(strict_types=1);

namespace App\Core;

use PDOException;
use RuntimeException;

abstract class Model
{
    protected static string $table;
    protected static string $primaryKey = 'id';

    public function __construct(protected array $attributes = [])
    {
    }

    public function __get(string $key): mixed
    {
        if ($key === 'pk') {
            return $this->attributes['id'] ?? null;
        }

        return $this->attributes[$key] ?? null;
    }

    public function __set(string $key, mixed $value): void
    {
        $this->attributes[$key] = $value;
    }

    public function toArray(): array
    {
        return $this->attributes;
    }

    public function imageUrl(string $field = 'image'): string
    {
        $value = $this->{$field} ?? '';
        return media_url($value);
    }

    protected static function table(): string
    {
        return static::$table;
    }

    protected static function hydrate(array $row): static
    {
        return new static($row);
    }

    public static function find(int $id): ?static
    {
        $stmt = Database::connection()->prepare(
            'SELECT * FROM ' . static::table() . ' WHERE ' . static::$primaryKey . ' = ? LIMIT 1'
        );
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        return $row ? static::hydrate($row) : null;
    }

    public static function findBySlug(string $slug): ?static
    {
        $stmt = Database::connection()->prepare(
            'SELECT * FROM ' . static::table() . ' WHERE slug = ? LIMIT 1'
        );
        $stmt->execute([$slug]);
        $row = $stmt->fetch();
        return $row ? static::hydrate($row) : null;
    }

    public static function all(string $orderBy = 'id DESC'): array
    {
        try {
            $stmt = Database::connection()->query('SELECT * FROM ' . static::table() . ' ORDER BY ' . $orderBy);
            return array_map(fn ($row) => static::hydrate($row), $stmt->fetchAll());
        } catch (PDOException $e) {
            self::rethrowMissingTable($e);
        }
    }

    public static function where(string $column, mixed $value, string $operator = '='): array
    {
        $stmt = Database::connection()->prepare(
            'SELECT * FROM ' . static::table() . " WHERE {$column} {$operator} ?"
        );
        $stmt->execute([$value]);
        return array_map(fn ($row) => static::hydrate($row), $stmt->fetchAll());
    }

    public static function query(string $sql, array $params = []): array
    {
        $stmt = Database::connection()->prepare($sql);
        $stmt->execute($params);
        return array_map(fn ($row) => static::hydrate($row), $stmt->fetchAll());
    }

    public static function first(string $sql, array $params = []): ?static
    {
        $rows = static::query($sql, $params);
        return $rows[0] ?? null;
    }

    public static function count(?string $where = null, array $params = []): int
    {
        $sql = 'SELECT COUNT(*) FROM ' . static::table();
        if ($where) {
            $sql .= ' WHERE ' . $where;
        }
        $stmt = Database::connection()->prepare($sql);
        $stmt->execute($params);
        return (int) $stmt->fetchColumn();
    }

    public static function create(array $data): static
    {
        $columns = array_keys($data);
        $placeholders = implode(', ', array_fill(0, count($columns), '?'));
        $sql = sprintf(
            'INSERT INTO %s (%s) VALUES (%s)',
            static::table(),
            implode(', ', $columns),
            $placeholders
        );
        $stmt = Database::connection()->prepare($sql);
        $stmt->execute(array_values($data));
        $id = (int) Database::connection()->lastInsertId();
        return static::find($id) ?? static::hydrate(array_merge($data, ['id' => $id]));
    }

    public function update(array $data): bool
    {
        if (!isset($this->attributes['id'])) {
            return false;
        }
        $sets = [];
        $values = [];
        foreach ($data as $key => $value) {
            $sets[] = "{$key} = ?";
            $values[] = $value;
        }
        $values[] = $this->attributes['id'];
        $sql = 'UPDATE ' . static::table() . ' SET ' . implode(', ', $sets) . ' WHERE id = ?';
        $stmt = Database::connection()->prepare($sql);
        $result = $stmt->execute($values);
        $this->attributes = array_merge($this->attributes, $data);
        return $result;
    }

    public function delete(): bool
    {
        if (!isset($this->attributes['id'])) {
            return false;
        }
        $stmt = Database::connection()->prepare('DELETE FROM ' . static::table() . ' WHERE id = ?');
        return $stmt->execute([$this->attributes['id']]);
    }

    private static function rethrowMissingTable(PDOException $e): never
    {
        $message = $e->getMessage();

        if (!str_contains($message, 'no such table') && !str_contains($message, "doesn't exist")) {
            throw $e;
        }

        $driver = config('database')['driver'] ?? 'unknown';
        $table = static::table();
        $hint = $driver === 'mysql'
            ? "Importez le fichier database/schema.mysql.sql dans phpMyAdmin (base " . env('DB_NAME', '') . ")."
            : 'Sur LWS, uploadez .env.production avec DB_DRIVER=mysql à la racine du site.';

        throw new RuntimeException(
            "Table « {$table} » introuvable ({$driver}). {$hint}",
            0,
            $e
        );
    }

    public static function paginate(string $where, array $params, int $page, int $perPage, string $orderBy = 'id DESC'): array
    {
        $offset = max(0, ($page - 1) * $perPage);
        $total = static::count($where, $params);
        $sql = 'SELECT * FROM ' . static::table() . ' WHERE ' . $where . ' ORDER BY ' . $orderBy . ' ' . sql_limit($perPage, $offset);
        $stmt = Database::connection()->prepare($sql);
        $stmt->execute($params);
        $items = array_map(fn ($row) => static::hydrate($row), $stmt->fetchAll());

        return [
            'items' => $items,
            'page' => $page,
            'per_page' => $perPage,
            'total' => $total,
            'last_page' => (int) max(1, ceil($total / $perPage)),
        ];
    }
}
