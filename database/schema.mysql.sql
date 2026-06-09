SET NAMES utf8mb4;

SET FOREIGN_KEY_CHECKS = 0;

CREATE TABLE `auth_group` (`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, `name` varchar(150) NOT NULL UNIQUE) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `auth_group_permissions` (`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, `group_id` INT NOT NULL REFERENCES `auth_group` (`id`), `permission_id` INT NOT NULL REFERENCES `auth_permission` (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `auth_permission` (`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, `content_type_id` INT NOT NULL REFERENCES `django_content_type` (`id`), `codename` varchar(100) NOT NULL, `name` varchar(255) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `auth_user` (`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, `password` varchar(128) NOT NULL, `last_login` DATETIME NULL, `is_superuser` TINYINT(1) NOT NULL, `username` varchar(150) NOT NULL UNIQUE, `last_name` varchar(150) NOT NULL, `email` varchar(254) NOT NULL, `is_staff` TINYINT(1) NOT NULL, `is_active` TINYINT(1) NOT NULL, `date_joined` DATETIME NOT NULL, `first_name` varchar(150) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `auth_user_groups` (`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, `user_id` INT NOT NULL REFERENCES `auth_user` (`id`), `group_id` INT NOT NULL REFERENCES `auth_group` (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `auth_user_user_permissions` (`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, `user_id` INT NOT NULL REFERENCES `auth_user` (`id`), `permission_id` INT NOT NULL REFERENCES `auth_permission` (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `django_admin_log` (`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, `object_id` TEXT NULL, `object_repr` varchar(200) NOT NULL, `action_flag` SMALLINT unsigned NOT NULL CHECK (`action_flag` >= 0), `change_message` TEXT NOT NULL, `content_type_id` INT NULL REFERENCES `django_content_type` (`id`), `user_id` INT NOT NULL REFERENCES `auth_user` (`id`), `action_time` DATETIME NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `django_content_type` (`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, `app_label` varchar(100) NOT NULL, `model` varchar(100) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `django_migrations` (`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, `app` varchar(255) NOT NULL, `name` varchar(255) NOT NULL, `applied` DATETIME NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `django_session` (`session_key` varchar(40) NOT NULL PRIMARY KEY, `session_data` TEXT NOT NULL, `expire_date` DATETIME NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `portefolio_article` (`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, `title` varchar(500) NOT NULL, `slug` varchar(500) NOT NULL UNIQUE, `content` TEXT NOT NULL, `featured_image` varchar(100) NULL, `excerpt` TEXT NOT NULL, `status` varchar(20) NOT NULL, `views` INT unsigned NOT NULL CHECK (`views` >= 0), `created_at` DATETIME NOT NULL, `updated_at` DATETIME NOT NULL, `published_at` DATETIME NULL, `category` varchar(100) NOT NULL, `likes` INT unsigned NOT NULL CHECK (`likes` >= 0), `shares` INT unsigned NOT NULL CHECK (`shares` >= 0)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `portefolio_articlecomment` (`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, `name` varchar(100) NOT NULL, `email` varchar(254) NOT NULL, `content` TEXT NOT NULL, `created_at` DATETIME NOT NULL, `is_approved` TINYINT(1) NOT NULL, `article_id` BIGINT NOT NULL REFERENCES `portefolio_article` (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `portefolio_award` (`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, `title` varchar(200) NOT NULL, `organization` varchar(200) NOT NULL, `DATE` DATE NOT NULL, `description` TEXT NOT NULL, `image` varchar(100) NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `portefolio_blog` (`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, `title` varchar(200) NOT NULL, `slug` varchar(50) NOT NULL UNIQUE, `content` TEXT NOT NULL, `created_at` DATETIME NOT NULL, `updated_at` DATETIME NOT NULL, `is_published` TINYINT(1) NOT NULL, `likes` INT unsigned NOT NULL CHECK (`likes` >= 0), `shares` INT unsigned NOT NULL CHECK (`shares` >= 0), `views` INT unsigned NOT NULL CHECK (`views` >= 0), `image` varchar(100) NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `portefolio_blogcomment` (`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, `name` varchar(100) NOT NULL, `email` varchar(254) NOT NULL, `content` TEXT NOT NULL, `created_at` DATETIME NOT NULL, `is_approved` TINYINT(1) NOT NULL, `blog_id` BIGINT NOT NULL REFERENCES `portefolio_blog` (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `portefolio_blogvisitor` (`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, `ip_address` char(39) NOT NULL, `user_agent` TEXT NOT NULL, `first_visit` DATETIME NOT NULL, `last_visit` DATETIME NOT NULL, `visit_count` INT unsigned NOT NULL CHECK (`visit_count` >= 0), `has_liked` TINYINT(1) NOT NULL, `has_shared` TINYINT(1) NOT NULL, `has_commented` TINYINT(1) NOT NULL, `article_id` BIGINT NOT NULL REFERENCES `portefolio_article` (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `portefolio_category` (`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, `name` varchar(100) NOT NULL, `slug` varchar(50) NOT NULL UNIQUE, `description` TEXT NOT NULL, `created_at` DATETIME NOT NULL, `updated_at` DATETIME NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `portefolio_contact` (`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, `name` varchar(100) NOT NULL, `email` varchar(254) NOT NULL, `subject` varchar(200) NOT NULL, `message` TEXT NOT NULL, `status` varchar(20) NOT NULL, `ip_address` char(39) NULL, `user_agent` TEXT NOT NULL, `created_at` DATETIME NOT NULL, `updated_at` DATETIME NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `portefolio_emailcampaign` (`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, `title` varchar(200) NOT NULL, `subject` varchar(200) NOT NULL, `content` TEXT NOT NULL, `status` varchar(20) NOT NULL, `created_at` DATETIME NOT NULL, `scheduled_at` DATETIME NULL, `sent_at` DATETIME NULL, `total_recipients` INT unsigned NOT NULL CHECK (`total_recipients` >= 0), `sent_count` INT unsigned NOT NULL CHECK (`sent_count` >= 0), `failed_count` INT unsigned NOT NULL CHECK (`failed_count` >= 0), `created_by_id` INT NOT NULL REFERENCES `auth_user` (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `portefolio_event` (`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, `event_type` varchar(50) NOT NULL, `DATE` DATE NOT NULL, `location` varchar(200) NOT NULL, `description` TEXT NOT NULL, `featured_image` varchar(100) NULL, `slug` varchar(500) NOT NULL UNIQUE, `content` TEXT NOT NULL, `excerpt` TEXT NOT NULL, `TIME` TIME NULL, `end_date` DATE NULL, `end_time` TIME NULL, `address` TEXT NOT NULL, `city` varchar(100) NOT NULL, `country` varchar(100) NOT NULL, `capacity` INT unsigned NULL CHECK (`capacity` >= 0), `registration_url` varchar(200) NULL, `contact_email` varchar(254) NULL, `contact_phone` varchar(20) NULL, `status` varchar(20) NOT NULL, `is_featured` TINYINT(1) NOT NULL, `views` INT unsigned NOT NULL CHECK (`views` >= 0), `created_at` DATETIME NOT NULL, `updated_at` DATETIME NOT NULL, `published_at` DATETIME NULL, `title` varchar(500) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `portefolio_foundation` (`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, `title` varchar(200) NOT NULL, `description` TEXT NOT NULL, `impact_number` INT NOT NULL, `impact_description` varchar(255) NOT NULL, `image` varchar(100) NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `portefolio_gallery` (`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, `title` varchar(200) NOT NULL, `category` varchar(50) NOT NULL, `description` TEXT NULL, `is_video` TINYINT(1) NOT NULL, `video_url` varchar(200) NULL, `image` varchar(100) NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `portefolio_newsletter` (`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, `email` varchar(254) NOT NULL UNIQUE, `status` varchar(20) NOT NULL, `ip_address` char(39) NULL, `user_agent` TEXT NOT NULL, `subscribed_at` DATETIME NOT NULL, `unsubscribed_at` DATETIME NULL, `last_email_sent` DATETIME NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `portefolio_partner` (`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, `name` varchar(200) NOT NULL, `logo` varchar(100) NOT NULL, `website` varchar(200) NULL, `description` TEXT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `portefolio_service` (`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, `title` varchar(200) NOT NULL, `description` TEXT NOT NULL, `category` varchar(50) NOT NULL, `image` varchar(100) NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `portefolio_testimonial` (`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY, `name` varchar(200) NOT NULL, `position` varchar(200) NOT NULL, `content` TEXT NOT NULL, `image` varchar(100) NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS = 1;
