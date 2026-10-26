-- ==========================================================
-- SOUND Group Entertainment Portal Database Backup
-- Generated: 2026-10-22 06:06:02
-- Compatible with MySQL 5.7+, MySQL 8.0+, MariaDB & SQLite
-- ==========================================================

SET FOREIGN_KEY_CHECKS=0;

-- --------------------------------------------------------
-- Table structure for table `users`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `userid` varchar(255) NOT NULL UNIQUE,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL UNIQUE,
  `phone` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `avatar` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `users`
INSERT INTO `users` (`id`, `userid`, `name`, `email`, `phone`, `address`, `role`, `avatar`, `is_active`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES (1, 'adeeba', 'adeeba', 'adeeba2506e@aptechgdn.net', 224643254654, 'garden west', 'admin', NULL, 1, NULL, '$2y$12$SgkMua/3/.yW8nRb3BNTDOj3KMtbP2GufRC1L8k3WQPVDkNAqSADm', NULL, '2026-10-22 05:56:15', '2026-10-22 05:56:15');
INSERT INTO `users` (`id`, `userid`, `name`, `email`, `phone`, `address`, `role`, `avatar`, `is_active`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES (2, 'eman12', 'eman', 'eman@gmail.com', 13242343435, 'asefdsfefg4wer', 'user', NULL, 1, NULL, '$2y$12$sXihHg1pp.uElC4yMMagUeRjlUYd.JCjFcOluDuFpa/Fba0qZP3De', NULL, '2026-10-22 06:05:42', '2026-10-22 06:05:42');

-- --------------------------------------------------------
-- Table structure for table `password_reset_tokens`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `password_reset_tokens`;
-- Generic table password_reset_tokens

-- --------------------------------------------------------
-- Table structure for table `sessions`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `sessions`;
-- Generic table sessions

-- Dumping data for table `sessions`
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES ('6dhqrAmuENf3AzGupy9wTLuLRqRwpw6DOx1N3CYT', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/155.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiR05UZHNwd3VVbVlHRThzR3V1aG9SYnBlTlJMcmtiSkdjd2R3WWhwRyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9zZXR0aW5ncyI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1792649158);

-- --------------------------------------------------------
-- Table structure for table `artists`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `artists`;
CREATE TABLE `artists` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL UNIQUE,
  `bio` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `genres`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `genres`;
CREATE TABLE `genres` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL UNIQUE,
  `slug` varchar(255) NOT NULL UNIQUE,
  `description` text DEFAULT NULL,
  `color` varchar(255) DEFAULT '#10B981',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `languages`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `languages`;
CREATE TABLE `languages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL UNIQUE,
  `code` varchar(10) NOT NULL,
  `type` enum('english','regional') NOT NULL DEFAULT 'regional',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `years`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `years`;
CREATE TABLE `years` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `year` int(11) NOT NULL UNIQUE,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `albums`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `albums`;
CREATE TABLE `albums` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL UNIQUE,
  `artist_id` bigint(20) unsigned NOT NULL,
  `genre_id` bigint(20) unsigned DEFAULT NULL,
  `year_id` bigint(20) unsigned DEFAULT NULL,
  `language_id` bigint(20) unsigned DEFAULT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `release_year` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `musics`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `musics`;
CREATE TABLE `musics` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL UNIQUE,
  `artist_id` bigint(20) unsigned NOT NULL,
  `album_id` bigint(20) unsigned DEFAULT NULL,
  `genre_id` bigint(20) unsigned NOT NULL,
  `language_id` bigint(20) unsigned NOT NULL,
  `year_id` bigint(20) unsigned NOT NULL,
  `duration` varchar(255) DEFAULT '3:30',
  `audio_url` text NOT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `lyrics` text DEFAULT NULL,
  `is_new` tinyint(1) NOT NULL DEFAULT 1,
  `plays_count` int(10) unsigned NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `videos`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `videos`;
CREATE TABLE `videos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL UNIQUE,
  `artist_id` bigint(20) unsigned NOT NULL,
  `album_id` bigint(20) unsigned DEFAULT NULL,
  `genre_id` bigint(20) unsigned NOT NULL,
  `language_id` bigint(20) unsigned NOT NULL,
  `year_id` bigint(20) unsigned NOT NULL,
  `duration` varchar(255) DEFAULT '4:00',
  `video_url` text NOT NULL,
  `thumbnail_image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_new` tinyint(1) NOT NULL DEFAULT 1,
  `views_count` int(10) unsigned NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `reviews`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `reviews`;
CREATE TABLE `reviews` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `item_type` varchar(255) NOT NULL,
  `item_id` bigint(20) unsigned NOT NULL,
  `rating` tinyint(3) unsigned NOT NULL,
  `review_text` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `reviews_user_item_unique` (`user_id`,`item_type`,`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table structure for table `site_settings`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `site_settings`;
CREATE TABLE `site_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL UNIQUE,
  `value` text DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS=1;
