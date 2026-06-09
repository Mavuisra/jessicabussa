#!/usr/bin/env python3
"""Fix broken url() conversions in PHP templates."""

import re
from pathlib import Path

ROOT = Path(__file__).resolve().parent.parent
TEMPLATES = ROOT / "templates"

SIMPLE_ROUTES = {
    "contact", "foundation", "services", "about", "entrepreneurship",
    "education", "social", "awards", "politics", "activities", "blog",
    "gallery", "home", "events",
}

DETAIL_ROUTES = {
    "event_detail": "event",
    "blog_detail": "post",
}


ADMIN_ROUTES = {
    "admin_articles", "admin_article_create", "admin_article_edit", "admin_article_delete",
    "admin_events", "admin_event_create", "admin_event_edit", "admin_event_delete",
    "admin_gallery", "admin_gallery_create", "admin_gallery_edit", "admin_gallery_delete",
    "admin_contacts", "admin_contact_detail", "admin_newsletter", "admin_campaigns",
    "admin_campaign_create", "admin_campaign_detail", "admin_dashboard", "admin_login",
}

def fix_file(text: str) -> str:
    for route in SIMPLE_ROUTES | ADMIN_ROUTES:
        text = text.replace(f"url('portefolio', ${route})", f"url('{route}')")

    text = re.sub(
        r"<\?= url\('portefolio', \$event_detail\) \?>",
        "<?= url('event_detail', $event->slug) ?>",
        text,
    )
    text = re.sub(
        r"<\?= url\('portefolio', \$(\w+)_(\w+) \) \?>",
        lambda m: f"<?= url('admin_{m.group(2)}', ${m.group(1)}->id) ?>" if m.group(1) in ('article', 'event', 'item', 'campaign', 'contact') else m.group(0),
        text,
    )

    text = re.sub(r"\{% if not (\w+)\.(\w+) %\}", r"<?php if (!$\1->\2): ?>", text)
    text = re.sub(
        r"\{% if not (\w+) and not (\w+) and not (\w+) and not (\w+) %\}",
        r"<?php if (!$\1 && !$\2 && !$\3 && !$\4): ?>",
        text,
    )
    text = re.sub(r"\{% if '([^']+)' in (\w+)\.(\w+) %\}", r"<?php if (str_contains((string) ($\2->\3 ?? ''), '\1')): ?>", text)
    text = re.sub(r"\{% elif '([^']+)' in (\w+)\.(\w+) %\}", r"<?php elseif (str_contains((string) ($\2->\3 ?? ''), '\1')): ?>", text)
    text = re.sub(r"\{% comment %\}.*?\{% endcomment %\}", "", text, flags=re.DOTALL)
    text = re.sub(r"\{% block extra_js %\}.*", "", text, flags=re.DOTALL)
    text = re.sub(r"\{% cycle '[^']+' '[^']+' %\}", "", text)
    text = re.sub(r"\{% for num in page_obj\.paginator\.page_range %\}", "<?php foreach ($page_obj->paginator->page_range as $num): ?>", text)

    text = text.replace("<?= e($event->event_type) ?>", "<?= e(event_type_label($event->event_type ?? '')) ?>")

    return text


def main():
    for path in TEMPLATES.rglob("*.php"):
        original = path.read_text(encoding="utf-8")
        fixed = fix_file(original)
        if fixed != original:
            path.write_text(fixed, encoding="utf-8")
            print("Fixed URLs:", path.relative_to(ROOT))


if __name__ == "__main__":
    main()
