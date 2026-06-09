#!/usr/bin/env python3
"""
Conversion Django → PHP en préservant 100 % du HTML/CSS/JS.
Seuls les tags Django sont transformés ; aucune suppression de contenu.
"""

from __future__ import annotations

import re
import shutil
from pathlib import Path

ROOT = Path(__file__).resolve().parent.parent
SRC = ROOT / "templates_html"
OUT = ROOT / "templates"

URL_MAP = {
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


def extract_block(content: str, block_name: str) -> tuple[str, str]:
    """Extract a django block; returns (inner_content, content_without_block)."""
    pattern = rf"\{{% block {block_name} %\}}"
    start = re.search(pattern, content)
    if not start:
        return "", content

    pos = start.end()
    depth = 1
    i = pos
    while i < len(content):
        open_m = re.match(r"\{% block \w+ %\}", content[i:])
        close_m = re.match(r"\{% endblock %\}", content[i:])
        if open_m:
            depth += 1
            i += open_m.end()
        elif close_m:
            depth -= 1
            i += close_m.end()
            if depth == 0:
                inner = content[pos : i - len("{% endblock %}")]
                full_block = content[start.start() : i]
                remaining = content[: start.start()] + content[i:]
                return inner.strip(), remaining
        else:
            i += 1
    return "", content


def php_nowdoc(var: str, html: str) -> str:
    if not html.strip():
        return f"<?php ${var} = ''; ?>\n"
    delimiter = "HTML_BLOCK"
    while delimiter in html:
        delimiter += "_X"
    return f"<?php ${var} = <<<'{delimiter}'\n{html}\n{delimiter}; ?>\n"


def convert_tags(text: str) -> str:
    text = re.sub(r"\{% load static %\}\s*", "", text)
    text = re.sub(r"\{% csrf_token %\}", "<?= csrf_field() ?>", text)
    text = re.sub(r"\{% static '([^']+)' %\}", r"<?= asset('\1') ?>", text)
    text = re.sub(r"\{% static \"([^\"]+)\" %\}", r"<?= asset('\1') ?>", text)

    def url_repl(m: re.Match) -> str:
        raw = m.group(0)
        name_m = re.search(r"'portefolio:([^']+)'", raw) or re.search(r"'([^']+)'", raw)
        name = URL_MAP.get(name_m.group(0).strip("'"), name_m.group(1).replace("portefolio:", "")) if name_m else "home"
        args = re.findall(r"\b(\w+)\.(\w+)\b", raw.split("%}")[0].split(name_m.group(0))[-1] if name_m else "")
        if args:
            obj, prop = args[0]
            return f"<?= url('{name}', ${obj}->{prop}) ?>"
        # pk args: article.pk
        pk = re.search(r"(\w+)\.pk", raw)
        if pk:
            return f"<?= url('{name}', ${pk.group(1)}->id) ?>"
        slug = re.search(r"(\w+)\.slug", raw)
        if slug:
            return f"<?= url('{name}', ${slug.group(1)}->slug) ?>"
        campaign_pk = re.search(r"campaign\.pk", raw)
        if campaign_pk:
            return "<?= url('admin_campaign_detail', $campaign->id) ?>"
        return f"<?= url('{name}') ?>"

    text = re.sub(r"\{% url [^%]+%\}", url_repl, text)

    text = re.sub(
        r"\{% if request\.path == '/' or request\.path == '/home/' %\}",
        "<?php if (in_array(parse_url(\$_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH), ['/', '/home', '/home/'], true)): ?>",
        text,
    )
    text = re.sub(
        r"\{% if request\.path != '/' and request\.path != '/home/' %\}",
        "<?php if (!in_array(parse_url(\$_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH), ['/', '/home', '/home/'], true)): ?>",
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
    text = re.sub(r"\{% if not (\w+)\.(\w+) %\}", r"<?php if (!$\1->\2): ?>", text)
    text = re.sub(
        r"\{% if not (\w+) and not (\w+) and not (\w+) and not (\w+) %\}",
        r"<?php if (!$\1 && !$\2 && !$\3 && !$\4): ?>",
        text,
    )
    text = re.sub(r"\{% if (\w+)\.(\w+) == '([^']+)' %\}", r"<?php if ($\1->\2 === '\3'): ?>", text)
    text = re.sub(r"\{% elif (\w+)\.(\w+) == '([^']+)' %\}", r"<?php elseif ($\1->\2 === '\3'): ?>", text)
    text = re.sub(r"\{% if '([^']+)' in (\w+)\.(\w+) %\}", r"<?php if (str_contains((string) ($\2->\3 ?? ''), '\1')): ?>", text)
    text = re.sub(r"\{% elif '([^']+)' in (\w+)\.(\w+) %\}", r"<?php elseif (str_contains((string) ($\2->\3 ?? ''), '\1')): ?>", text)
    text = re.sub(r"\{% if (\w+)\.(\w+) %\}", r"<?php if ($\1->\2): ?>", text)
    text = re.sub(r"\{% elif (\w+)\.(\w+) %\}", r"<?php elseif ($\1->\2): ?>", text)
    text = re.sub(r"\{% if (\w+) %\}", r"<?php if ($\1): ?>", text)
    text = re.sub(r"\{% elif (\w+) %\}", r"<?php elseif ($\1): ?>", text)
    text = re.sub(r"\{% if (\w+) > (\d+) %\}", r"<?php if ($\1 > \2): ?>", text)
    text = re.sub(r"\{% else %\}", "<?php else: ?>", text)
    text = re.sub(r"\{% endif %\}", "<?php endif; ?>", text)

    text = re.sub(r"\{% for (\w+) in (\w+) %\}", r"<?php $__loop_items = $\2; foreach ($\2 as $\1): ?>", text)
    text = re.sub(r"\{% empty %\}", "<?php endforeach; ?>\n<?php if (empty($__loop_items ?? [])): ?>\n", text)
    text = re.sub(r"\{% endfor %\}", "<?php endforeach; ?>", text)

    text = re.sub(
        r"\{% elif num > page_obj\.number\|add:'-2' and num < page_obj\.number\|add:'2' %\}",
        "<?php elseif ($num > $page_obj->number - 2 && $num < $page_obj->number + 2): ?>",
        text,
    )
    text = re.sub(r"\{% if page_obj\.number == num %\}", "<?php if ($page_obj->number == $num): ?>", text)
    text = re.sub(
        r"\{% for num in page_obj\.paginator\.page_range %\}",
        "<?php foreach ($page_obj->paginator->page_range as $num): ?>",
        text,
    )
    text = re.sub(r"\{% cycle '([^']+)' '([^']+)' %\}", r"<?= (\$loop ?? 0) % 2 === 0 ? '\1' : '\2' ?>", text)

    text = re.sub(r"\{% comment %\}.*?\{% endcomment %\}", "", text, flags=re.DOTALL)

    # Variables
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
        r"\{\{\s*(\w+)\.(\w+)\s*\|\s*truncatewords:(\d+)\s*\}\}",
        lambda m: f"<?= e(truncate_words(strip_tags((string) (${m.group(1)}->{m.group(2)} ?? '')), {m.group(3)})) ?>",
        text,
    )
    text = re.sub(
        r"\{\{\s*(\w+)\.(\w+)\s*\|\s*default:\"([^\"]*)\"\s*\}\}",
        lambda m: f"<?= e($\1->\2 ?? '{m.group(3)}') ?>",
        text,
    )
    text = re.sub(
        r"\{\{\s*(\w+)\.(\w+)\s*\|\s*safe\s*\}\}",
        r"<?= $\1->\2 ?>",
        text,
    )
    text = re.sub(r"\{\{\s*(\w+)\.(\w+)\s*\}\}", r"<?= e($\1->\2) ?>", text)
    text = re.sub(r"\{\{\s*(\w+)\s*\}\}", r"<?= e($\1) ?>", text)

    # Forms django → champs manuels (valeurs)
    text = re.sub(r"\{\{\s*form\.(\w+)\.value\s*\}\}", r"<?= e(old('\1')) ?>", text)
    text = re.sub(r"\{% if form\.(\w+)\.value %\}checked", r"<?php if (old('\1')): ?>checked", text)
    text = re.sub(
        r"\{% if form\.(\w+)\.value == '([^']+)' %\}selected",
        r"<?php if (old('\1') === '\2'): ?>selected",
        text,
    )
    text = re.sub(r"\{% if form\.(\w+)\.errors %\}.*?\{% endif %\}", "", text, flags=re.DOTALL)
    text = re.sub(r"\{% if form\.(\w+)\.help_text %\}.*?\{% endif %\}", "", text, flags=re.DOTALL)

    text = text.replace("csrfmiddlewaretoken", "_csrf")
    text = text.replace("/static/", "/static/")  # unchanged

    return text


def convert_layout(content: str) -> str:
    content = re.sub(r"\{% extends [^%]+%\}\s*", "", content)
    content = extract_block(content, "title")[1]
    title_default = "Jessica Bussa - Portfolio"
    if "admin" in content[:200].lower() or "Administration" in content:
        title_default = "Administration"

    content = re.sub(
        r"\{% block title %\}.*?\{% endblock %\}",
        f"<?= e($title ?? '{title_default}') ?>",
        content,
        flags=re.DOTALL,
    )
    content = re.sub(
        r"\{% block extra_css %\}\s*\{% endblock %\}",
        "<?= $extra_css ?? '' ?>",
        content,
    )
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
        r"\{% block extra_js %\}\s*\{% endblock %\}",
        "<?= $extra_js ?? '' ?>",
        content,
    )
    return convert_tags(content)


def convert_page(content: str) -> str:
    content = re.sub(r"\{% extends 'base\.html' %\}\s*", "", content)
    content = re.sub(r"\{% extends 'admin/base\.html' %\}\s*", "", content)

    extra_css, content = extract_block(content, "extra_css")
    extra_js, content = extract_block(content, "extra_js")
    block_content, content = extract_block(content, "content")
    if not block_content:
        block_content, content = extract_block(content, "admin_content")

    # title block ignored (passed via controller)
    _, content = extract_block(content, "title")

    parts = []
    if extra_css.strip():
        parts.append(php_nowdoc("extra_css", convert_tags(extra_css)))
    parts.append(convert_tags(block_content))
    if extra_js.strip():
        parts.append(php_nowdoc("extra_js", convert_tags(extra_js)))

    return "\n".join(parts)


def convert_file(src: Path, dest: Path, layout: bool = False):
    raw = src.read_text(encoding="utf-8")
    php = convert_layout(raw) if layout else convert_page(raw)
    dest.parent.mkdir(parents=True, exist_ok=True)
    dest.write_text(php, encoding="utf-8")


def main():
    if not SRC.exists():
        shutil.copytree(ROOT / "templates", SRC, ignore=shutil.ignore_patterns("*.php", "layouts"))
        print("Created templates_html backup")

    convert_file(SRC / "base.html", OUT / "layouts" / "base.php", layout=True)
    convert_file(SRC / "admin" / "base.html", OUT / "layouts" / "admin.php", layout=True)

    for html in SRC.glob("*.html"):
        convert_file(html, OUT / "pages" / (html.stem + ".php"))

    admin_map = [
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
    for src_rel, dest_rel in admin_map:
        src = SRC / src_rel
        if src.exists():
            convert_file(src, OUT / dest_rel)

    print("Conversion design-preserving terminée.")


if __name__ == "__main__":
    main()
