-- Corrige la troncature des articles longs (MySQL TEXT = 64 Ko max).
-- phpMyAdmin → base lasav2675681_12lmwo → SQL → exécuter ce fichier
--
-- Si les articles sont tronqués à cause d'images base64 dans le HTML :
--   1. php scripts/extract-inline-images.php --mysql  (sur le serveur)
--   2. Uploadez le dossier media/inline/ via FTP
--   OU réimportez database/full-install.mysql.sql (schéma + données nettoyées)

ALTER TABLE `portefolio_article`
  MODIFY `content` LONGTEXT NOT NULL,
  MODIFY `excerpt` LONGTEXT NOT NULL;

ALTER TABLE `portefolio_blog`
  MODIFY `content` LONGTEXT NOT NULL;

ALTER TABLE `portefolio_event`
  MODIFY `description` LONGTEXT NOT NULL,
  MODIFY `content` LONGTEXT NOT NULL,
  MODIFY `excerpt` LONGTEXT NOT NULL;

ALTER TABLE `portefolio_emailcampaign`
  MODIFY `content` LONGTEXT NOT NULL;
