import sqlite3
from pathlib import Path

ROOT = Path(__file__).resolve().parent.parent
conn = sqlite3.connect(ROOT / "db.sqlite3")
schema = []
for row in conn.execute(
    "SELECT sql FROM sqlite_master WHERE type='table' AND sql IS NOT NULL ORDER BY name"
):
    schema.append(row[0] + ";")

(ROOT / "database").mkdir(exist_ok=True)
(ROOT / "database" / "schema.sql").write_text("\n\n".join(schema), encoding="utf-8")
print(f"Exported {len(schema)} tables")
