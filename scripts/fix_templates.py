#!/usr/bin/env python3
"""Post-process converted PHP templates to fix remaining Django syntax."""

import re
from pathlib import Path

ROOT = Path(__file__).resolve().parent.parent
TEMPLATES = ROOT / "templates"


def fix_content(text: str) -> str:
    text = re.sub(r"\{% extends '[^']+' %\}\s*", "", text)
    text = re.sub(r"\{% block admin_content %\}\s*", "", text)
    text = re.sub(r"\{% block content %\}\s*", "", text)
    text = re.sub(r"\{% endblock %\}\s*", "", text)
    text = re.sub(r"\{% block extra_css %\}.*?\{% endblock %\}", "", text, flags=re.DOTALL)
    text = re.sub(r"\{% block extra_js %\}.*?\{% endblock %\}", "", text, flags=re.DOTALL)
    text = re.sub(r"\{% block title %\}.*?\{% endblock %\}", "", text, flags=re.DOTALL)
    text = re.sub(r"\{% load static %\}\s*", "", text)
    text = re.sub(r"\{% csrf_token %\}", "<?= csrf_field() ?>", text)
    text = re.sub(r"\{% static '([^']+)' %\}", r"<?= asset('\1') ?>", text)

    # url tags with args
    def url_fix(m):
        full = m.group(0)
        name = m.group(1).replace("portefolio:", "")
        rest = (m.group(2) or "").strip()
        if rest:
            arg = rest.split()[0].replace(".", "->")
            if not arg.startswith("$"):
                arg = "$" + arg
            return f"<?= url('{name}', {arg}) ?>"
        return f"<?= url('{name}') ?>"

    text = re.sub(r"\{% url 'portefolio:([^']+)'\s*([^%]*)\%}", url_fix, text)
    text = re.sub(r"\{% url '([^']+)'\s*([^%]*)\%}", url_fix, text)

    # if / elif / else / endif
    text = re.sub(
        r"\{% if (\w+)\.(\w+) == '([^']+)' %\}",
        r"<?php if ($\1->\2 === '\3'): ?>",
        text,
    )
    text = re.sub(
        r"\{% elif (\w+)\.(\w+) == '([^']+)' %\}",
        r"<?php elseif ($\1->\2 === '\3'): ?>",
        text,
    )
    text = re.sub(r"\{% if (\w+)\.(\w+) %\}", r"<?php if ($\1->\2): ?>", text)
    text = re.sub(r"\{% elif (\w+)\.(\w+) %\}", r"<?php elseif ($\1->\2): ?>", text)
    text = re.sub(r"\{% if (\w+) %\}", r"<?php if ($\1): ?>", text)
    text = re.sub(r"\{% elif (\w+) %\}", r"<?php elseif ($\1): ?>", text)
    text = re.sub(r"\{% if (\w+) > (\d+) %\}", r"<?php if ($\1 > \2): ?>", text)
    text = re.sub(r"\{% else %\}", "<?php else: ?>", text)
    text = re.sub(r"\{% endif %\}", "<?php endif; ?>", text)

    # for loops
    text = re.sub(r"\{% for (\w+) in (\w+) %\}", r"<?php foreach ($\2 as $\1): ?>", text)
    text = re.sub(r"\{% empty %\}", "<?php endforeach; ?><?php if (false): ?><?php foreach ([] as $_e): ?><?php endforeach; ?><?php if (true): ?>", text)
    text = re.sub(r"\{% endfor %\}", "<?php endforeach; ?>", text)

    # pagination conditions
    text = re.sub(
        r"\{% elif num > page_obj\.number\|add:'-2' and num < page_obj\.number\|add:'2' %\}",
        "<?php elseif ($num > $page_obj->number - 2 && $num < $page_obj->number + 2): ?>",
        text,
    )
    text = re.sub(r"\{% if page_obj\.number == num %\}", "<?php if ($page_obj->number == $num): ?>", text)

    # variables
    text = re.sub(
        r"\{\{\s*(\w+)\.(featured_image|image|logo)\.url\s*\}\}",
        r"<?= e(media_url($\1->\2 ?? '')) ?>",
        text,
    )
    text = re.sub(
        r"\{\{\s*(\w+)\.get_category_display\s*\}\}",
        r"<?= e(category_label($\1->category ?? '')) ?>",
        text,
    )
    text = re.sub(
        r"\{\{\s*(\w+)\.get_event_type_display\s*\}\}",
        r"<?= e(event_type_label($\1->event_type ?? '')) ?>",
        text,
    )
    text = re.sub(
        r"\{\{\s*(\w+)\.(\w+)\s*\|\s*date:\"([^\"]+)\"\s*\}\}",
        lambda m: f"<?= e(date('{m.group(3)}', strtotime((string) (${m.group(1)}->{m.group(2)} ?? '')))) ?>",
        text,
    )
    text = re.sub(
        r"\{\{\s*(\w+)\.(\w+)\s*\|\s*striptags\s*\|\s*truncatewords:(\d+)\s*\}\}",
        lambda m: f"<?= e(truncate_words(strip_tags((string) (${m.group(1)}->{m.group(2)} ?? '')), {m.group(3)})) ?>",
        text,
    )
    text = re.sub(
        r"\{\{\s*(\w+)\.(\w+)\s*\}\}",
        r"<?= e($\1->\2) ?>",
        text,
    )
    text = re.sub(r"\{\{\s*(\w+)\s*\}\}", r"<?= e($\1) ?>", text)

    # request/resolver
    text = re.sub(
        r"\{% if request\.path == '/' or request\.path == '/home/' %\}",
        "<?php if (($_SERVER['REQUEST_URI'] ?? '/') === '/'): ?>",
        text,
    )
    text = re.sub(
        r"\{% if '([^']+)' in request\.resolver_match\.url_name %\}",
        r"<?php if (str_contains(\$_SERVER['REQUEST_URI'] ?? '', '\1')): ?>",
        text,
    )
    text = re.sub(
        r"\{% if request\.resolver_match\.url_name == '([^']+)' %\}",
        r"<?php if (str_contains(\$_SERVER['REQUEST_URI'] ?? '', '\1')): ?>",
        text,
    )

    # form django
    text = re.sub(r"\{\{\s*form\.(\w+)\.value\s*\}\}", r"<?= e(old('\1')) ?>", text)
    text = re.sub(r"\{% if form\.(\w+)\.errors %\}.*?\{% endif %\}", "", text, flags=re.DOTALL)
    text = re.sub(r"\{% if form\.(\w+)\.help_text %\}.*?\{% endif %\}", "", text, flags=re.DOTALL)
    text = re.sub(r"\{\{\s*form\.(\w+)\.(\w+)\s*\}\}", "", text)

    # object -> $object in templates (article, event, item)
    text = text.replace("$article->", "$article->").replace("get_event_type_display", "event_type")  # noop cleanup
    text = re.sub(r"\$event->get_event_type_display", "event_type_label($event->event_type ?? '')", text)
    text = re.sub(r"\$post->get_category_display", "category_label($post->category ?? '')", text)

    # messages block replacement
    text = re.sub(
        r"<\?php if \(\$messages\): \?>.*?<\?php endif; \?>",
        "<?php if ($success = flash('success')): ?><div class=\"p-4 mb-4 rounded-lg bg-blue-100 text-blue-700\"><?= e($success) ?></div><?php endif; ?><?php if ($error = flash('error')): ?><div class=\"p-4 mb-4 rounded-lg bg-red-100 text-red-700\"><?= e($error) ?></div><?php endif; ?>",
        text,
        flags=re.DOTALL,
    )

    # csrf js
    text = text.replace(
        "document.querySelector('[name=csrfmiddlewaretoken]')?.value || ''",
        "document.querySelector('[name=_csrf]')?.value || ''",
    )

    text = text.replace("url('portefolio', $home)", "url('home')")

    # admin templates use $article, $event, $item - map object variable
    text = text.replace("{{ object.", "<?= e($article->")  # leftover

    return text


def main():
    count = 0
    for path in TEMPLATES.rglob("*.php"):
        for _ in range(3):  # multiple passes
            original = path.read_text(encoding="utf-8")
            fixed = fix_content(original)
            if fixed != original:
                path.write_text(fixed, encoding="utf-8")
                count += 1
                print("Fixed:", path.relative_to(ROOT))
            else:
                break


if __name__ == "__main__":
    main()
