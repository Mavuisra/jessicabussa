# Portfolio Jessica Bussa — PHP POO (MVC)

Site portfolio en **PHP 8.2+** avec architecture MVC maison, hébergé sur **LWS**.

Dépôt : [github.com/Mavuisra/jessicabussa](https://github.com/Mavuisra/jessicabussa)

## Prérequis

- PHP 8.2+ (`pdo_mysql`, `mbstring`, `openssl`, `curl`, `fileinfo`)
- Composer (`composer.phar` inclus dans le projet)

## Installation locale

```powershell
cd C:\Users\hp\Music\jessi\home\jessi
copy .env.example .env
php composer.phar install
php composer.phar dump-autoload -o
mkdir storage\sessions, media -Force
php -S 127.0.0.1:8080 -t public public/router.php
```

Ouvrir : **http://127.0.0.1:8080/**

## Déploiement LWS (hébergement mutualisé)

> **Erreur 403 Forbidden ?** Voir la section [Dépannage 403](#dépannage-403-forbidden) en bas.

### Structure obligatoire sur LWS

Le domaine pointe vers le dossier **`www`** (ou `public_html`). **Seul le contenu du dossier `public/`** doit s'y trouver :

```
/home/votrecompte/
├── www/                      ← DocumentRoot (contenu de public/ UNIQUEMENT)
│   ├── index.php
│   ├── .htaccess
│   ├── router.php            (optionnel, dev)
│   └── static/
├── vendor/                   ← un niveau AU-DESSUS de www/
├── src/
├── config/
├── templates/
├── storage/
├── media/
├── .env
└── (PAS de .htaccess ici)    ← ne jamais mettre « Deny all » à cette racine
```

**Via FTP LWS :** uploadez le **contenu** de `public/` dans `www/`, pas le dossier `public/` lui-même.

### 1. Upload des fichiers

Uploader sur le serveur LWS (FTP ou gestionnaire de fichiers) :

- `public/` → **DocumentRoot** du domaine (ou sous-dossier pointé par le domaine)
- `src/`, `config/`, `templates/`, `vendor/`, `storage/`, `media/` → **au-dessus** de `public/` (hors accès web direct)

Structure recommandée sur LWS :

```
/home/votrecompte/
├── public_html/          ← contenu de public/
├── src/
├── config/
├── templates/
├── vendor/
├── storage/
├── media/
└── .env
```

### 2. Base de données MySQL

1. Créer une base MySQL dans **LWS Panel**
2. Importer `database/schema.mysql.sql` dans phpMyAdmin (LWS Panel)
3. Copier `.env.production.example` → `.env` et remplir les identifiants LWS :

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://www.jessicabussa.cd

DB_DRIVER=mysql
DB_HOST=localhost
DB_NAME=votre_base_lws
DB_USER=votre_user_lws
DB_PASSWORD=votre_mot_de_passe

MAIL_HOST=mail1.netim.hosting
MAIL_PORT=465
MAIL_ENCRYPTION=ssl
MAIL_USERNAME=contact@jessicabussa.cd
MAIL_PASSWORD=votre_mot_de_passe_mail
MAIL_FROM=contact@jessicabussa.cd
```

> **Email** : les boîtes mail restent chez **Netim** (`mail1.netim.hosting`, port **465** SSL). L'hébergement du site est sur **LWS**, mais l'envoi SMTP passe toujours par Netim.

### 3. Permissions

- `storage/sessions/` → écriture (755 ou 775)
- `media/` → écriture (755 ou 775)

### 4. Apache

Le fichier `public/.htaccess` gère le routage. Vérifier que **mod_rewrite** est actif (activé par défaut sur LWS).

## Admin

- URL : `/admin/login/`
- Comptes dans la table `auth_user`

## Structure

```
public/         → index.php, .htaccess, static/
config/         → routes, app, database
src/            → Core, Models, Controllers, Services
templates/      → Vues PHP
storage/        → Sessions
media/          → Uploads
database/       → schema.sql (SQLite), schema.mysql.sql (LWS)
```

## Dépannage 403 Forbidden

Message LWS : *« You do not have permission to access this document »*.

**Causes fréquentes :**

1. **Fichier `.htaccess` « Deny all » à la racine du projet** — supprimez-le via FTP dans le dossier parent de `www/`, pas celui dans `www/`.
2. **`index.php` absent de `www/`** — copiez `public/index.php` directement dans `www/`, pas dans `www/public/`.
3. **Tout le dépôt uploadé dans `www/`** — contenu de `public/` → `www/`, le reste → un niveau au-dessus.
4. **Dossier `vendor/` manquant** au-dessus de `www/` — uploadez `vendor/` après `composer install`.

**Checklist FTP :**

- [ ] `www/index.php` existe
- [ ] `www/.htaccess` contient `Require all granted`
- [ ] Pas de `.htaccess` avec `Deny from all` hors de `www/`
- [ ] `../vendor/autoload.php` existe (vendor au même niveau que `www/`)
