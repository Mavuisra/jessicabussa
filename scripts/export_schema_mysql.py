"""Exporte le schéma SQLite vers syntaxe MySQL (InnoDB, utf8mb4)."""
import re
import sqlite3
from pathlib import Path

ROOT = Path(__file__).resolve().parent.parent


def sqlite_type_to_mysql(sql: str) -> str:
    sql = re.sub(r'\binteger\b', 'INT', sql, flags=re.I)
    sql = re.sub(r'\bbigint\b', 'BIGINT', sql, flags=re.I)
    sql = re.sub(r'\bsmallint\b', 'SMALLINT', sql, flags=re.I)
    sql = re.sub(r'\bbool\b', 'TINYINT(1)', sql, flags=re.I)
    sql = re.sub(r'\bdatetime\b', 'DATETIME', sql, flags=re.I)
    sql = re.sub(r'\bdate\b', 'DATE', sql, flags=re.I)
    sql = re.sub(r'\btime\b', 'TIME', sql, flags=re.I)
    sql = re.sub(r'\btext\b', 'TEXT', sql, flags=re.I)
    return sql


def convert_create(sql: str) -> str | None:
    if 'sqlite_sequence' in sql:
        return None

    sql = sql.strip().rstrip(';')
    sql = sql.replace('"', '`')
    sql = re.sub(r'\s+DEFERRABLE INITIALLY DEFERRED', '', sql)
    sql = sqlite_type_to_mysql(sql)

    sql = re.sub(
        r'`(\w+)`\s+INT\s+NOT\s+NULL\s+PRIMARY\s+KEY\s+AUTOINCREMENT',
        r'`\1` INT NOT NULL AUTO_INCREMENT PRIMARY KEY',
        sql,
        flags=re.I,
    )

    sql += ' ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci'
    return sql + ';'


def main() -> None:
    conn = sqlite3.connect(ROOT / 'db.sqlite3')
    statements: list[str] = [
        'SET NAMES utf8mb4;',
        'SET FOREIGN_KEY_CHECKS = 0;',
    ]

    for (raw,) in conn.execute(
        "SELECT sql FROM sqlite_master WHERE type='table' AND sql IS NOT NULL ORDER BY name"
    ):
        converted = convert_create(raw)
        if converted:
            statements.append(converted)

    statements.append('SET FOREIGN_KEY_CHECKS = 1;')

    out = ROOT / 'database' / 'schema.mysql.sql'
    out.write_text('\n\n'.join(statements) + '\n', encoding='utf-8')
    print(f'Exported {len(statements) - 3} tables -> {out.relative_to(ROOT)}')


if __name__ == '__main__':
    main()
