CREATE TABLE "auth_group" ("id" integer NOT NULL PRIMARY KEY AUTOINCREMENT, "name" varchar(150) NOT NULL UNIQUE);

CREATE TABLE "auth_group_permissions" ("id" integer NOT NULL PRIMARY KEY AUTOINCREMENT, "group_id" integer NOT NULL REFERENCES "auth_group" ("id") DEFERRABLE INITIALLY DEFERRED, "permission_id" integer NOT NULL REFERENCES "auth_permission" ("id") DEFERRABLE INITIALLY DEFERRED);

CREATE TABLE "auth_permission" ("id" integer NOT NULL PRIMARY KEY AUTOINCREMENT, "content_type_id" integer NOT NULL REFERENCES "django_content_type" ("id") DEFERRABLE INITIALLY DEFERRED, "codename" varchar(100) NOT NULL, "name" varchar(255) NOT NULL);

CREATE TABLE "auth_user" ("id" integer NOT NULL PRIMARY KEY AUTOINCREMENT, "password" varchar(128) NOT NULL, "last_login" datetime NULL, "is_superuser" bool NOT NULL, "username" varchar(150) NOT NULL UNIQUE, "last_name" varchar(150) NOT NULL, "email" varchar(254) NOT NULL, "is_staff" bool NOT NULL, "is_active" bool NOT NULL, "date_joined" datetime NOT NULL, "first_name" varchar(150) NOT NULL);

CREATE TABLE "auth_user_groups" ("id" integer NOT NULL PRIMARY KEY AUTOINCREMENT, "user_id" integer NOT NULL REFERENCES "auth_user" ("id") DEFERRABLE INITIALLY DEFERRED, "group_id" integer NOT NULL REFERENCES "auth_group" ("id") DEFERRABLE INITIALLY DEFERRED);

CREATE TABLE "auth_user_user_permissions" ("id" integer NOT NULL PRIMARY KEY AUTOINCREMENT, "user_id" integer NOT NULL REFERENCES "auth_user" ("id") DEFERRABLE INITIALLY DEFERRED, "permission_id" integer NOT NULL REFERENCES "auth_permission" ("id") DEFERRABLE INITIALLY DEFERRED);

CREATE TABLE "django_admin_log" ("id" integer NOT NULL PRIMARY KEY AUTOINCREMENT, "object_id" text NULL, "object_repr" varchar(200) NOT NULL, "action_flag" smallint unsigned NOT NULL CHECK ("action_flag" >= 0), "change_message" text NOT NULL, "content_type_id" integer NULL REFERENCES "django_content_type" ("id") DEFERRABLE INITIALLY DEFERRED, "user_id" integer NOT NULL REFERENCES "auth_user" ("id") DEFERRABLE INITIALLY DEFERRED, "action_time" datetime NOT NULL);

CREATE TABLE "django_content_type" ("id" integer NOT NULL PRIMARY KEY AUTOINCREMENT, "app_label" varchar(100) NOT NULL, "model" varchar(100) NOT NULL);

CREATE TABLE "django_migrations" ("id" integer NOT NULL PRIMARY KEY AUTOINCREMENT, "app" varchar(255) NOT NULL, "name" varchar(255) NOT NULL, "applied" datetime NOT NULL);

CREATE TABLE "django_session" ("session_key" varchar(40) NOT NULL PRIMARY KEY, "session_data" text NOT NULL, "expire_date" datetime NOT NULL);

CREATE TABLE "portefolio_article" ("id" integer NOT NULL PRIMARY KEY AUTOINCREMENT, "title" varchar(500) NOT NULL, "slug" varchar(500) NOT NULL UNIQUE, "content" text NOT NULL, "featured_image" varchar(100) NULL, "excerpt" text NOT NULL, "status" varchar(20) NOT NULL, "views" integer unsigned NOT NULL CHECK ("views" >= 0), "created_at" datetime NOT NULL, "updated_at" datetime NOT NULL, "published_at" datetime NULL, "category" varchar(100) NOT NULL, "likes" integer unsigned NOT NULL CHECK ("likes" >= 0), "shares" integer unsigned NOT NULL CHECK ("shares" >= 0));

CREATE TABLE "portefolio_articlecomment" ("id" integer NOT NULL PRIMARY KEY AUTOINCREMENT, "name" varchar(100) NOT NULL, "email" varchar(254) NOT NULL, "content" text NOT NULL, "created_at" datetime NOT NULL, "is_approved" bool NOT NULL, "article_id" bigint NOT NULL REFERENCES "portefolio_article" ("id") DEFERRABLE INITIALLY DEFERRED);

CREATE TABLE "portefolio_award" ("id" integer NOT NULL PRIMARY KEY AUTOINCREMENT, "title" varchar(200) NOT NULL, "organization" varchar(200) NOT NULL, "date" date NOT NULL, "description" text NOT NULL, "image" varchar(100) NULL);

CREATE TABLE "portefolio_blog" ("id" integer NOT NULL PRIMARY KEY AUTOINCREMENT, "title" varchar(200) NOT NULL, "slug" varchar(50) NOT NULL UNIQUE, "content" text NOT NULL, "created_at" datetime NOT NULL, "updated_at" datetime NOT NULL, "is_published" bool NOT NULL, "likes" integer unsigned NOT NULL CHECK ("likes" >= 0), "shares" integer unsigned NOT NULL CHECK ("shares" >= 0), "views" integer unsigned NOT NULL CHECK ("views" >= 0), "image" varchar(100) NULL);

CREATE TABLE "portefolio_blogcomment" ("id" integer NOT NULL PRIMARY KEY AUTOINCREMENT, "name" varchar(100) NOT NULL, "email" varchar(254) NOT NULL, "content" text NOT NULL, "created_at" datetime NOT NULL, "is_approved" bool NOT NULL, "blog_id" bigint NOT NULL REFERENCES "portefolio_blog" ("id") DEFERRABLE INITIALLY DEFERRED);

CREATE TABLE "portefolio_blogvisitor" ("id" integer NOT NULL PRIMARY KEY AUTOINCREMENT, "ip_address" char(39) NOT NULL, "user_agent" text NOT NULL, "first_visit" datetime NOT NULL, "last_visit" datetime NOT NULL, "visit_count" integer unsigned NOT NULL CHECK ("visit_count" >= 0), "has_liked" bool NOT NULL, "has_shared" bool NOT NULL, "has_commented" bool NOT NULL, "article_id" bigint NOT NULL REFERENCES "portefolio_article" ("id") DEFERRABLE INITIALLY DEFERRED);

CREATE TABLE "portefolio_category" ("id" integer NOT NULL PRIMARY KEY AUTOINCREMENT, "name" varchar(100) NOT NULL, "slug" varchar(50) NOT NULL UNIQUE, "description" text NOT NULL, "created_at" datetime NOT NULL, "updated_at" datetime NOT NULL);

CREATE TABLE "portefolio_contact" ("id" integer NOT NULL PRIMARY KEY AUTOINCREMENT, "name" varchar(100) NOT NULL, "email" varchar(254) NOT NULL, "subject" varchar(200) NOT NULL, "message" text NOT NULL, "status" varchar(20) NOT NULL, "ip_address" char(39) NULL, "user_agent" text NOT NULL, "created_at" datetime NOT NULL, "updated_at" datetime NOT NULL);

CREATE TABLE "portefolio_emailcampaign" ("id" integer NOT NULL PRIMARY KEY AUTOINCREMENT, "title" varchar(200) NOT NULL, "subject" varchar(200) NOT NULL, "content" text NOT NULL, "status" varchar(20) NOT NULL, "created_at" datetime NOT NULL, "scheduled_at" datetime NULL, "sent_at" datetime NULL, "total_recipients" integer unsigned NOT NULL CHECK ("total_recipients" >= 0), "sent_count" integer unsigned NOT NULL CHECK ("sent_count" >= 0), "failed_count" integer unsigned NOT NULL CHECK ("failed_count" >= 0), "created_by_id" integer NOT NULL REFERENCES "auth_user" ("id") DEFERRABLE INITIALLY DEFERRED);

CREATE TABLE "portefolio_event" ("id" integer NOT NULL PRIMARY KEY AUTOINCREMENT, "event_type" varchar(50) NOT NULL, "date" date NOT NULL, "location" varchar(200) NOT NULL, "description" text NOT NULL, "featured_image" varchar(100) NULL, "slug" varchar(500) NOT NULL UNIQUE, "content" text NOT NULL, "excerpt" text NOT NULL, "time" time NULL, "end_date" date NULL, "end_time" time NULL, "address" text NOT NULL, "city" varchar(100) NOT NULL, "country" varchar(100) NOT NULL, "capacity" integer unsigned NULL CHECK ("capacity" >= 0), "registration_url" varchar(200) NULL, "contact_email" varchar(254) NULL, "contact_phone" varchar(20) NULL, "status" varchar(20) NOT NULL, "is_featured" bool NOT NULL, "views" integer unsigned NOT NULL CHECK ("views" >= 0), "created_at" datetime NOT NULL, "updated_at" datetime NOT NULL, "published_at" datetime NULL, "title" varchar(500) NOT NULL);

CREATE TABLE "portefolio_foundation" ("id" integer NOT NULL PRIMARY KEY AUTOINCREMENT, "title" varchar(200) NOT NULL, "description" text NOT NULL, "impact_number" integer NOT NULL, "impact_description" varchar(255) NOT NULL, "image" varchar(100) NULL);

CREATE TABLE "portefolio_gallery" ("id" integer NOT NULL PRIMARY KEY AUTOINCREMENT, "title" varchar(200) NOT NULL, "category" varchar(50) NOT NULL, "description" text NULL, "is_video" bool NOT NULL, "video_url" varchar(200) NULL, "image" varchar(100) NULL);

CREATE TABLE "portefolio_newsletter" ("id" integer NOT NULL PRIMARY KEY AUTOINCREMENT, "email" varchar(254) NOT NULL UNIQUE, "status" varchar(20) NOT NULL, "ip_address" char(39) NULL, "user_agent" text NOT NULL, "subscribed_at" datetime NOT NULL, "unsubscribed_at" datetime NULL, "last_email_sent" datetime NULL);

CREATE TABLE "portefolio_partner" ("id" integer NOT NULL PRIMARY KEY AUTOINCREMENT, "name" varchar(200) NOT NULL, "logo" varchar(100) NOT NULL, "website" varchar(200) NULL, "description" text NULL);

CREATE TABLE "portefolio_service" ("id" integer NOT NULL PRIMARY KEY AUTOINCREMENT, "title" varchar(200) NOT NULL, "description" text NOT NULL, "category" varchar(50) NOT NULL, "image" varchar(100) NULL);

CREATE TABLE "portefolio_testimonial" ("id" integer NOT NULL PRIMARY KEY AUTOINCREMENT, "name" varchar(200) NOT NULL, "position" varchar(200) NOT NULL, "content" text NOT NULL, "image" varchar(100) NULL);

CREATE TABLE sqlite_sequence(name,seq);