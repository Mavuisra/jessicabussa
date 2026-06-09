#!/usr/bin/env python3
"""Convert Django HTML templates to PHP templates."""

import re
import os
from pathlib import Path

ROOT = Path(__file__).resolve().parent.parent
SRC = ROOT / "templates_django"
DJANGO_TEMPLATES = ROOT / "templates"
OUT = ROOT / "templates"

# Backup: copy original templates to templates_django if not exists
if not SRC.exists():
    import shutil
    # We'll read from existing html in templates folder - but we need originals
    pass

URL_NAMES = {
    "portefolio:home": "home",
    "portefolio:activities": "activities",
    "portefolio:about": "about",
    "portefolio:services": "services",
    "portefolio:foundation": "foundation",
    "portefolio:leadership": "leadership",
    "portefolio:media": "media",
    "portefolio:events": "events",
    "portefolio:partners": "partners",
    "portefolio:academic": "academic",
    "portefolio:gallery": "gallery",
    "portefolio:contact": "contact",
    "portefolio:contact_success": "contact_success",
    "portefolio:blog": "blog",
    "portefolio:blog_detail": "blog_detail",
    "portefolio:like_blog_post": "like_blog_post",
    "portefolio:share_blog_post": "share_blog_post",
    "portefolio:subscribe_newsletter": "subscribe_newsletter",
    "portefolio:unsubscribe_newsletter": "unsubscribe_newsletter",
    "portefolio:event_detail": "event_detail",
    "portefolio:entrepreneurship": "entrepreneurship",
    "portefolio:education": "education",
    "portefolio:career": "career",
    "portefolio:social": "social",
    "portefolio:awards": "awards",
    "portefolio:politics": "politics",
    "portefolio:admin_login": "admin_login",
    "portefolio:admin_dashboard": "admin_dashboard",
    "portefolio:admin_logout": "admin_logout",
    "portefolio:admin_articles": "admin_articles",
    "portefolio:admin_article_create": "admin_article_create",
    "portefolio:admin_article_edit": "admin_article_edit",
    "portefolio:admin_article_delete": "admin_article_delete",
    "portefolio:admin_events": "admin_events",
    "portefolio:admin_event_create": "admin_event_create",
    "portefolio:admin_event_edit": "admin_event_edit",
    "portefolio:admin_event_delete": "admin_event_delete",
    "portefolio:admin_gallery": "admin_gallery",
    "portefolio:admin_gallery_create": "admin_gallery_create",
    "portefolio:admin_gallery_edit": "admin_gallery_edit",
    "portefolio:admin_gallery_delete": "admin_gallery_delete",
    "portefolio:admin_contacts": "admin_contacts",
    "portefolio:admin_contact_detail": "admin_contact_detail",
    "portefolio:admin_newsletter": "admin_newsletter",
    "portefolio:admin_campaigns": "admin_campaigns",
    "portefolio:admin_campaign_create": "admin_campaign_create",
    "portefolio:admin_campaign_detail": "admin_campaign_detail",
    "portefolio:admin_campaign_send": "admin_campaign_send",
    "portefolio:admin_campaign_preview": "admin_campaign_preview",
}


def extract_block(content: str, block_name: str) -> str:
    pattern = rf"\{{% block {block_name} %\}}(.*?)\{{% endblock %\}}"
    match = re.search(pattern, content, re.DOTALL)
    return match.group(1).strip() if match else content


def convert_url_tag(match: re.Match) -> str:
    inner = match.group(1).strip()
    # {% url 'portefolio:blog_detail' post.slug %}
    parts = re.findall(r"'([^']+)'|(\w+(?:\.\w+)*)", inner)
    tokens = []
    for q, v in parts:
        tokens.append(q or v)
    if not tokens:
        return "<?= url('home') ?>"
    name = URL_NAMES.get(tokens[0], tokens[0].replace("portefolio:", ""))
    args = tokens[1:]
    php_args = []
    for arg in args:
        arg = arg.replace(".", "->")
        if not arg.startswith("$"):
            arg = "$" + arg
        php_args.append(f"e({arg})" if False else arg)
    if php_args:
        return "<?= url('" + name + "', " + ", ".join(php_args) + ") ?>"
    return "<?= url('" + name + "') ?>"


def convert_vars(text: str) -> str:
    # .url on image fields
    text = re.sub(
        r"\{\{\s*(\w+)\.(featured_image|image|logo)\.url\s*\}\}",
        r"<?= e(media_url($\1->\2 ?? '')) ?>",
        text,
    )
    text = re.sub(
        r"\{\{\s*(\w+)\.get_category_display\s*\}\}",
        r"<?= e($\1->getCategoryDisplay()) ?>",
        text,
    )
    text = re.sub(
        r"\{\{\s*(\w+)\.(\w+)\s*\|\s*date:\"([^\"]+)\"\s*\}\}",
        lambda m: f"<?= e(date('{m.group(3)}', strtotime((string) (${m.group(1)}->{m.group(2)} ?? '')))) ?>",
        text,
    )
    text = re.sub(
        r"\{\{\s*(\w+)\.(\w+)\s*\|\s*date:\"([^\"]+)\"\s*\}\}",
        lambda m: f"<?= e(date('{m.group(3)}', strtotime((string) (${m.group(1)}->{m.group(2)} ?? '')))) ?>",
        text,
    )
    text = re.sub(
        r"\{\{\s*(\w+)\.(\w+)\s*\|\s*truncatewords:(\d+)\s*\}\}",
        lambda m: f"<?= e(truncate_words(strip_tags((string) (${m.group(1)}->{m.group(2)} ?? '')), {m.group(3)})) ?>",
        text,
    )
    text = re.sub(
        r"\{\{\s*(\w+)\.(\w+)\s*\|\s*striptags\s*\|\s*truncatewords:(\d+)\s*\}\}",
        lambda m: f"<?= e(truncate_words(strip_tags((string) (${m.group(1)}->{m.group(2)} ?? '')), {m.group(3)})) ?>",
        text,
    )
    text = re.sub(
        r"\{\{\s*(\w+)\.(\w+)\s*\|\s*default:\"([^\"]*)\"\s*\}\}",
        lambda m: f"<?= e($\1->\2 ?? '{m.group(3)}') ?>",
        text,
    )
    text = re.sub(
        r"\{\{\s*(\w+)\.(\w+)\s*\}\}",
        r"<?= e($\1->\2) ?>",
        text,
    )
    text = re.sub(
        r"\{\{\s*(\w+)\s*\}\}",
        r"<?= e($\1) ?>",
        text,
    )
    return text


def convert_django_to_php(content: str, is_layout: bool = False) -> str:
    content = re.sub(r"\{% load static %\}\s*", "", content)
    content = re.sub(r"\{% csrf_token %\}", "<?= csrf_field() ?>", content)
    content = re.sub(r"\{% static '([^']+)' %\}", r"<?= asset('\1') ?>", content)
    content = re.sub(r"\{% url '([^']+)'([^%]*)\%}", convert_url_tag, content)
    content = re.sub(r"\{% url \"([^\"]+)\"([^%]*)\%}", convert_url_tag, content)

    # for loops
    content = re.sub(
        r"\{% for (\w+) in (\w+) %\}",
        r"<?php foreach ($\2 as $\1): ?>",
        content,
    )
    content = re.sub(r"\{% empty %\}", "<?php endforeach; if (false): ?><?php endif; if (true): ?><?php /* empty */ ?><?php if (false): ?><?php foreach ([] as $_): ?><?php endforeach; ?><?php endif; ?><?php if (true): ?><?php /* end empty hack */ ?><?php endif; ?><?php if (false): ?>", content)
    # Simpler empty: use endforeach + comment
    content = content.replace("<?php endforeach; if (false): ?><?php endif; if (true): ?><?php /* empty */ ?><?php if (false): ?><?php foreach ([] as $_): ?><?php endforeach; ?><?php endif; ?><?php if (true): ?><?php /* end empty hack */ ?><?php endif; ?><?php if (false): ?>", "\n<?php endforeach; ?>\n<?php if (empty($ITEM)): ?>\n")
    content = re.sub(r"\{% endfor %\}", "<?php endforeach; ?>", content)

    # if tags
    content = re.sub(r"\{% if (\w+) %\}", r"<?php if ($\1): ?>", content)
    content = re.sub(
        r"\{% if (\w+)\.(\w+) %\}",
        r"<?php if ($\1->\2): ?>",
        content,
    )
    content = re.sub(
        r"\{% elif (\w+) %\}",
        r"<?php elseif ($\1): ?>",
        content,
    )
    content = re.sub(r"\{% else %\}", "<?php else: ?>", content)
    content = re.sub(r"\{% endif %\}", "<?php endif; ?>", content)

    content = convert_vars(content)

    # messages django
    content = re.sub(
        r"\{% if messages %\}.*?\{% endif %\}",
        "<?php if ($success = flash('success')): ?><div class=\"alert success\"><?= e($success) ?></div><?php endif; ?><?php if ($error = flash('error')): ?><div class=\"alert error\"><?= e($error) ?></div><?php endif; ?>",
        content,
        flags=re.DOTALL,
    )

    if not is_layout:
        # Remove extends and outer blocks for content pages
        if "{% extends" in content:
            content = extract_block(content, "content") or extract_block(content, "admin_content") or content
        content = re.sub(r"\{% block title %\}.*?\{% endblock %\}", "", content, flags=re.DOTALL)
        content = re.sub(r"\{% block extra_css %\}.*?\{% endblock %\}", "", content, flags=re.DOTALL)

    # Layout files: replace block content with $content echo
    if is_layout:
        content = re.sub(
            r"\{% block content %\}.*?\{% endblock %\}",
            "<?= $content ?? '' ?>",
            content,
            flags=re.DOTALL,
        )
        content = re.sub(
            r"\{% block admin_content %\}.*?\{% endblock %\}",
            "<?= $content ?? '' ?>",
            content,
            flags=re.DOTALL,
        )
        content = re.sub(
            r"\{% block title %\}(.*?)\{% endblock %\}",
            r"<?= e($title ?? '\1') ?>",
            content,
            flags=re.DOTALL,
        )
        content = re.sub(r"\{% extends [^%]+%\}\s*", "", content)

    # form fields django -> simple php
    content = re.sub(r"\{\{\s*form\.(\w+)\.value\s*\}\}", r"<?= e(old('\1')) ?>", content)
    content = re.sub(
        r"\{% if form\.(\w+)\.errors %\}(.*?)\{% endif %\}",
        r"<?php if (!empty($errors['\1'])): ?>\2<?php endif; ?>",
        content,
        flags=re.DOTALL,
    )

    return content


def process_file(src_path: Path, dest_path: Path, is_layout: bool = False):
    content = src_path.read_text(encoding="utf-8")
    php = convert_django_to_php(content, is_layout=is_layout)
    dest_path.parent.mkdir(parents=True, exist_ok=True)
    dest_path.write_text(php, encoding="utf-8")
    print(f"Converted: {src_path.name} -> {dest_path}")


def main():
    # Use templates_html backup - read from .html files we saved
    html_root = ROOT / "templates_html"
    if not html_root.exists():
        html_root = ROOT / "templates"
        # Save backup first time
        backup = ROOT / "templates_html"
        if not backup.exists():
            import shutil
            shutil.copytree(html_root, backup, ignore=shutil.ignore_patterns("*.php", "layouts"))
            print("Backed up templates to templates_html/")

    html_root = ROOT / "templates_html"
    if not html_root.exists():
        html_root = DJANGO_TEMPLATES

    # Layouts
    base_html = html_root / "base.html"
    if base_html.exists():
        process_file(base_html, OUT / "layouts" / "base.php", is_layout=True)

    admin_base = html_root / "admin" / "base.html"
    if admin_base.exists():
        process_file(admin_base, OUT / "layouts" / "admin.php", is_layout=True)

    public_pages = [
        "home", "about", "politics", "activities", "social", "career", "education",
        "entrepreneurship", "awards", "gallery", "blog", "blog_detail", "event_detail",
        "contact", "contact_success",
    ]
    for page in public_pages:
        src = html_root / f"{page}.html"
        if src.exists():
            process_file(src, OUT / "pages" / f"{page}.php")

    admin_pages = [
        ("admin/login.html", "admin/login.php"),
        ("admin/dashboard.html", "admin/dashboard.php"),
        ("admin/articles/list.html", "admin/articles/list.php"),
        ("admin/articles/create.html", "admin/articles/create.php"),
        ("admin/articles/edit.html", "admin/articles/edit.php"),
        ("admin/articles/delete.html", "admin/articles/delete.php"),
        ("admin/events/list.html", "admin/events/list.php"),
        ("admin/events/create.html", "admin/events/create.php"),
        ("admin/events/edit.html", "admin/events/edit.php"),
        ("admin/events/delete.html", "admin/events/delete.php"),
        ("admin/gallery/list.html", "admin/gallery/list.php"),
        ("admin/gallery/create.html", "admin/gallery/create.php"),
        ("admin/gallery/edit.html", "admin/gallery/edit.php"),
        ("admin/gallery/delete.html", "admin/gallery/delete.php"),
        ("admin/contacts/list.html", "admin/contacts/list.php"),
        ("admin/contacts/detail.html", "admin/contacts/detail.php"),
        ("admin/newsletter/list.html", "admin/newsletter/list.php"),
        ("admin/campaigns/list.html", "admin/campaigns/list.php"),
        ("admin/campaigns/create.html", "admin/campaigns/create.php"),
        ("admin/campaigns/detail.html", "admin/campaigns/detail.php"),
    ]
    for src_rel, dest_rel in admin_pages:
        src = html_root / src_rel
        if src.exists():
            process_file(src, OUT / dest_rel)


if __name__ == "__main__":
    main()
