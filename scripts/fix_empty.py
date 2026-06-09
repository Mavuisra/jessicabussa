#!/usr/bin/env python3
"""Fix broken empty($ITEM) blocks in converted templates."""

import re
from pathlib import Path

ROOT = Path(__file__).resolve().parent.parent

for path in (ROOT / "templates").rglob("*.php"):
    text = path.read_text(encoding="utf-8")
    original = text

    # Fix empty($ITEM) by finding preceding foreach variable
    def fix_empty(match, full_text):
        pos = match.start()
        before = full_text[:pos]
        foreach = re.findall(r"foreach\s*\(\s*\$(\w+)\s+as", before)
        if foreach:
            return f"<?php if (empty(${foreach[-1]})): ?>"
        return "<?php if (false): ?>"

    text = re.sub(r"<\?php if \(empty\(\$ITEM\)\): \?>", lambda m: fix_empty(m, original), text)

    # Remove duplicate endforeach after empty blocks
    text = re.sub(r"(<\?php endif; \?>)\s*<\?php endforeach; \?>", r"\1", text)

    # Fix remaining django in base
    text = text.replace(
        '{% if request.path != \'/\' and request.path != \'/home/\' %}pt-20<?php endif; %}',
        '<?= (($_SERVER[\'REQUEST_URI\'] ?? \'/\') !== \'/\' ? \'pt-20\' : \'\') ?>',
    )

    # Strip form.errors blocks in admin - replace with nothing
    text = re.sub(r"\{% if form\.\w+\.errors %\}\s*.*?\{% endif %\}", "", text, flags=re.DOTALL)
    text = re.sub(r"\{% if form\.\w+\.help_text %\}\s*.*?\{% endif %\}", "", text, flags=re.DOTALL)
    text = re.sub(
        r"\{% if form\.(\w+)\.value == '([^']+)' %\}selected",
        r"<?php if (old('\1', \$\2->\1 ?? '') === '\2'): ?>selected",
        text,
    )
    text = re.sub(
        r"\{% if form\.is_featured\.value %\}checked",
        "<?php if (!empty($_POST['is_featured'])): ?>checked",
        text,
    )

    if text != original:
        path.write_text(text, encoding="utf-8")
        print("Fixed empty:", path.relative_to(ROOT))
