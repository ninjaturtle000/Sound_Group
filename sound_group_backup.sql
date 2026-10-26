-- ==========================================================
-- SOUND Group Entertainment Portal Database Backup
-- Generated: 2026-10-21 08:54:50
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
INSERT INTO `users` (`id`, `userid`, `name`, `email`, `phone`, `address`, `role`, `avatar`, `is_active`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES (1, 'admin', 'SOUND Administrator', 'admin@soundgroup.com', '+1 800-555-0199', 'SOUND Group Tower, 500 Melody Way, Hollywood, CA 90028', 'admin', 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=150&auto=format&fit=crop&q=80', 1, NULL, '$2y$12$7PeTGbeXXfQBZF47GKymNegBUO1emT/ihIonggOXYtypWvAIor8oy', NULL, '2026-10-21 08:13:44', '2026-10-21 08:13:44');
INSERT INTO `users` (`id`, `userid`, `name`, `email`, `phone`, `address`, `role`, `avatar`, `is_active`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES (2, 'johndoe', 'John Doe', 'john@example.com', '+1 555-234-5678', '742 Evergreen Terrace, Springfield, OR 97477', 'user', 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?w=150&auto=format&fit=crop&q=80', 1, NULL, '$2y$12$VIpEqKEcgB0ABQbhP.iJY.UDUDqIL18Id.Ms2zkhIhOkTcSY6PgTG', NULL, '2026-10-21 08:13:44', '2026-10-21 08:13:44');
INSERT INTO `users` (`id`, `userid`, `name`, `email`, `phone`, `address`, `role`, `avatar`, `is_active`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES (3, 'priyasharma', 'Priya Sharma', 'priya@example.com', '+91 98765 43210', '45 Marine Drive, Nariman Point, Mumbai 400021, India', 'user', 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=150&auto=format&fit=crop&q=80', 1, NULL, '$2y$12$WBp07s5Pg1vEdkA02mnrIerQ4/kU4fvvY7E1qR0l4vn7jKamqBW9m', NULL, '2026-10-21 08:13:44', '2026-10-21 08:13:44');
INSERT INTO `users` (`id`, `userid`, `name`, `email`, `phone`, `address`, `role`, `avatar`, `is_active`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES (4, 'sounduser77', 'Marcus Bennett', 'marcus@soundtest.com', '+1 555-888-9999', '88 Sunset Boulevard, West Hollywood, CA 90069', 'user', NULL, 1, NULL, '$2y$12$hSDUWfHomyuFiT66dGEs4O0Cf4uBjmSrTJ20v8ISuje8NGB0F/jgO', NULL, '2026-10-21 08:53:24', '2026-10-21 08:53:24');

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
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES ('hJBQId5SOaNT3asp6T0zWxZHgXlpmJKKTC6zgrnZ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.6456', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiU3hZWnBTa1RiSWFDUkJUUTYwMnduMW1oeUhzb1JKakhtdnZUektoNSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792572484);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES ('tcdonDx9lSg1oy919yc6cVpf1LpJC1KHJ2y2GTeq', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.6456', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiM0FlNFNwR1kxQlhMNndRSE5PZ0RGU3EwaGNTUFdnTk9vd0F2MnNncSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792572550);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES ('OlwNr7fbsmJUwPwYORbazNkPc11ZU9HzNI7TF5fS', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.6456', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRWZpOEdmSm5zV3diV2VEeWQ1Z0VpM3BOQ2ZTaVFwSlpjSW8yajFyTCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hYm91dCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792572550);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES ('TGtQk4Dzo30dW69gdJnOlr9XbTxwYA0Qz6G7nsO2', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.6456', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidWR5WnRkdTZwNlRYRW43WEppUlF3bjhDME80eUdmbG9yUmZJenZ1QiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9tdXNpYyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792572551);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES ('EUToizgQutzAEeku9pNgRnOSm68vmqnGpIZ38dCg', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.6456', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiU1Y5WjJIRlpEMlpPNzFsQlpsT3pDdDdHcTBaYmZaVFpweG9sTTBrVSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC92aWRlb3MiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1792572551);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES ('QuMwc3RbAq9ksquoMsyrOC5IqVPkdIBbhiKPo63E', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.6456', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaml2MUxjbnR6Uno2SGZwNkw2ek84bFV1cnJSakFjTlZ0aHBMUzBBbCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYXRlZ29yaWVzL2FydGlzdHMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1792572552);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES ('TdiGocMnPqGq8V5SrRTxIbSViwblzAVsaQYZbhbk', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.6456', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMXAzQXBrRWF5SHZ6VGVUa0ZVd3VSbWFyeU9oM2c1Z0xqS3hYMmozQSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYXRlZ29yaWVzL2FsYnVtcyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792572552);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES ('gJ2aGXfW2fgkOzT1K4ipGCWhUD0fR9ha2IF4eMhV', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.6456', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibHRzT1VjNTdaSXcxUHZ4SGVxOXBSdnplbzQ3ZmFRc01HN3FjSEg3QiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYXRlZ29yaWVzL2dlbnJlcyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792572552);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES ('xnvQVAUdxoVlzKYIMpUW7WKN763xrUu7DPMjP2nO', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.6456', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSmhYNGdoRUFKN2tyUFdReFFrZmNZOUJhSEpMUWpKTGdPcHRSRDRnMiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYXRlZ29yaWVzL3llYXJzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1792572552);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES ('JhFxlRrKlUbm3Dr9vs3RNOaMmtTEXen8JUX5gneH', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.6456', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZjRDYmdGMWh0NDM4VnZadnJYbXNZeWxHZ1d0MVBhaFVkMERTcGZPdCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYXRlZ29yaWVzL2xhbmd1YWdlcyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792572552);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES ('eiU0SF82BIcP6yWD0ds3NiqP1hARo7dcvyC3RheP', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.6456', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNWRwZHJFa0h3QWdzaEJldThpOGVEYndrb3ZLUHNqQWU5YTR1ZlpJZCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792572552);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES ('t5VLTneMtV3dQcAP3NcGRuzn5Vw7z4ezGyY4kGsY', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.6456', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMW1Kd2FmVEhBZ2g1eXUwZVU1eUhzdFFhUjF1UzlmTGNpekRyUkdWYyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9yZWdpc3RlciI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1792572553);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES ('5vsS2koNo5L51sDGWCoo4UeKdRgAA5PSG7eAarAm', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.6456', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiT3UzdjV3amd2MWJYVFpKQ3NVbVRLa0kzbFltRW1qdFdaWWVwdmFjdiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zZWFyY2g/cT10ZXN0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1792572553);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES ('vMxmatStph82XAVhZ6OuKFaEBv1omhcQ8vX6Y7f5', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.6456', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUk1NS1RZVzByeFlRcVFnZXByaWs3dmtJeTFoTE1sRVMyWVFaSWIwdyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9maWxlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1792572634);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES ('sJ2UBMdMpQ0OlxYQdJUqEClovm35B9AcWPab5hXV', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.6456', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVWJ0NWpHYldna0dtMExkYXJrODA0VXpiTjRsdHRUTG8zMmhQUFpGZSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjE6e3M6ODoiaW50ZW5kZWQiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9maWxlIjt9fQ==', 1792572701);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES ('j9gzCV0ugOvZUaGJQRm97xsz0WVjC0CE1rmStQr8', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.6456', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiOE5QQlQ0aU5SMkxYR2NsbVpXSkdISWVXZVhsNXVZUmZRNTV5MkQ4ZSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9maWxlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NDt9', 1792572804);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES ('QcDgRLjl4Pyrpmma9Ysdzpp74x0NFKz3msuYoVGk', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.6456', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMlRoR2JSWVNqVHlCcVZWblFOaFQ1cnc1V1FVeHYzSUkwMHlpVEdoUCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9tdXNpYy8xIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1792572821);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES ('Wt6SfuIPZRoQuTLQBNHPjVfafXqbESQflDZh19Lw', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.6456', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoia2RKNUVicXNNY01kME45Q2hSMVNMdTQ0YnBZR3ZsalFiMGRCTXBuZCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1792572821);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES ('uxk7b6EIE1xNwfLp3GdDNYWgzcMLs2Fqess7ykRi', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.6456', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiMkVtdU5uWUU3MHA1aEl0MjdjelJvbjB4YXV0RlR6anEyZTZJczNMNiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1792572821);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES ('xAhRvxEKmrhq1ss69rjTSYqXv0XfFJMLSntdDvS2', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.6456', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiR1ppdTA2ZHpBajFqbVNheW9lWUZFRXZOck9XRGNJdnBOZGlGNU5TeSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9tdXNpYy8xIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1792572822);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES ('fz7NNQPxS8ZkGkw9hbq9TQkJOSikd6YButQlqbio', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.6456', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidE1uWWFWS00zTGlabk5TcjhmNVpoTFVqQXRqcXhjeFljTDYzWFR1dSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9tdXNpYy8xIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1792572836);
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES ('TNtojmd6cq8JoqZiZNX8GFxdn5Dc7osleYZWNemO', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT; Windows NT 10.0; en-US) WindowsPowerShell/5.1.19041.6456', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSnN6VEc0S21qYVVzSGhzQ0s2bXlvTjVsb0NxeHFGT3RVUGtqMGNDRiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9tdXNpYy8xIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1792572877);

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

-- Dumping data for table `artists`
INSERT INTO `artists` (`id`, `name`, `slug`, `bio`, `image`, `country`, `created_at`, `updated_at`) VALUES (1, 'The Weeknd', 'the-weeknd', 'Canadian singer, songwriter, and record producer known for his sonic versatility and dark lyricism.', 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?w=500&auto=format&fit=crop&q=80', 'Canada', '2026-10-21 08:13:45', '2026-10-21 08:13:45');
INSERT INTO `artists` (`id`, `name`, `slug`, `bio`, `image`, `country`, `created_at`, `updated_at`) VALUES (2, 'A.R. Rahman', 'ar-rahman', 'Two-time Academy Award-winning Indian composer known as the Mozart of Madras, blending Eastern classical with modern sounds.', 'https://images.unsplash.com/photo-1465847899084-d164df4dedc6?w=500&auto=format&fit=crop&q=80', 'India', '2026-10-21 08:13:45', '2026-10-21 08:13:45');
INSERT INTO `artists` (`id`, `name`, `slug`, `bio`, `image`, `country`, `created_at`, `updated_at`) VALUES (3, 'Dua Lipa', 'dua-lipa', 'Grammy-winning British-Albanian pop powerhouse behind modern disco-pop revival.', 'https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?w=500&auto=format&fit=crop&q=80', 'United Kingdom', '2026-10-21 08:13:45', '2026-10-21 08:13:45');
INSERT INTO `artists` (`id`, `name`, `slug`, `bio`, `image`, `country`, `created_at`, `updated_at`) VALUES (4, 'Arijit Singh', 'arijit-singh', 'Acclaimed Indian playback singer and music composer renowned for his soul-stirring romantic and emotional vocals.', 'https://images.unsplash.com/photo-1514525253161-7a46d19cd819?w=500&auto=format&fit=crop&q=80', 'India', '2026-10-21 08:13:45', '2026-10-21 08:13:45');
INSERT INTO `artists` (`id`, `name`, `slug`, `bio`, `image`, `country`, `created_at`, `updated_at`) VALUES (5, 'Diljit Dosanjh', 'diljit-dosanjh', 'Global Punjabi icon, singer, and actor representing authentic regional bhangra-fusion on world stages.', 'https://images.unsplash.com/photo-1508700115892-45ecd05ae2ad?w=500&auto=format&fit=crop&q=80', 'India', '2026-10-21 08:13:45', '2026-10-21 08:13:45');
INSERT INTO `artists` (`id`, `name`, `slug`, `bio`, `image`, `country`, `created_at`, `updated_at`) VALUES (6, 'Daft Punk', 'daft-punk', 'Legendary French electronic music duo pioneers of French touch and futuristic funk.', 'https://images.unsplash.com/photo-1470225620780-dba8ba36b745?w=500&auto=format&fit=crop&q=80', 'France', '2026-10-21 08:13:45', '2026-10-21 08:13:45');
INSERT INTO `artists` (`id`, `name`, `slug`, `bio`, `image`, `country`, `created_at`, `updated_at`) VALUES (7, 'Sid Sriram', 'sid-sriram', 'Indian-American Carnatic musician, music producer and playback singer leading contemporary South Indian cinema.', 'https://images.unsplash.com/photo-1501386761578-eac5c94b800a?w=500&auto=format&fit=crop&q=80', 'India / USA', '2026-10-21 08:13:45', '2026-10-21 08:13:45');
INSERT INTO `artists` (`id`, `name`, `slug`, `bio`, `image`, `country`, `created_at`, `updated_at`) VALUES (8, 'Rosalía', 'rosalia', 'Innovative Spanish singer and songwriter revolutionizing flamenco with reggaeton and urban electronic beats.', 'https://images.unsplash.com/photo-1520523839898-507124cd5371?w=500&auto=format&fit=crop&q=80', 'Spain', '2026-10-21 08:13:45', '2026-10-21 08:13:45');

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

-- Dumping data for table `genres`
INSERT INTO `genres` (`id`, `name`, `slug`, `description`, `color`, `created_at`, `updated_at`) VALUES (1, 'Pop', 'pop', 'Catchy, melodic mainstream and contemporary tunes.', '#EC4899', '2026-10-21 08:13:44', '2026-10-21 08:13:44');
INSERT INTO `genres` (`id`, `name`, `slug`, `description`, `color`, `created_at`, `updated_at`) VALUES (2, 'Rock', 'rock', 'Guitar-driven anthems, classic rock, and indie alternative.', '#EF4444', '2026-10-21 08:13:44', '2026-10-21 08:13:44');
INSERT INTO `genres` (`id`, `name`, `slug`, `description`, `color`, `created_at`, `updated_at`) VALUES (3, 'Hip Hop & Rap', 'hip-hop-rap', 'Rhythmic lyricism, trap beats, and urban storytelling.', '#F59E0B', '2026-10-21 08:13:44', '2026-10-21 08:13:44');
INSERT INTO `genres` (`id`, `name`, `slug`, `description`, `color`, `created_at`, `updated_at`) VALUES (4, 'Bollywood & Film', 'bollywood-film', 'Cinematic regional masterpieces, emotional melodies, and dance beats.', '#10B981', '2026-10-21 08:13:44', '2026-10-21 08:13:44');
INSERT INTO `genres` (`id`, `name`, `slug`, `description`, `color`, `created_at`, `updated_at`) VALUES (5, 'Classical & Carnatic', 'classical-carnatic', 'Timeless ragas, orchestral symphonies, and meditative instrumentation.', '#8B5CF6', '2026-10-21 08:13:44', '2026-10-21 08:13:44');
INSERT INTO `genres` (`id`, `name`, `slug`, `description`, `color`, `created_at`, `updated_at`) VALUES (6, 'Electronic & Dance', 'electronic-dance', 'Synthesizers, club drops, house, and EDM energy.', '#06B6D4', '2026-10-21 08:13:44', '2026-10-21 08:13:44');
INSERT INTO `genres` (`id`, `name`, `slug`, `description`, `color`, `created_at`, `updated_at`) VALUES (7, 'R&B & Soul', 'r-and-b-soul', 'Smooth vocal harmonies, neo-soul warmth, and deep grooves.', '#6366F1', '2026-10-21 08:13:44', '2026-10-21 08:13:44');
INSERT INTO `genres` (`id`, `name`, `slug`, `description`, `color`, `created_at`, `updated_at`) VALUES (8, 'Folk & Acoustic', 'folk-acoustic', 'Traditional regional ballads, unplugged guitars, and cultural heritage.', '#84CC16', '2026-10-21 08:13:44', '2026-10-21 08:13:44');

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

-- Dumping data for table `languages`
INSERT INTO `languages` (`id`, `name`, `code`, `type`, `created_at`, `updated_at`) VALUES (1, 'English', 'EN', 'english', '2026-10-21 08:13:44', '2026-10-21 08:13:44');
INSERT INTO `languages` (`id`, `name`, `code`, `type`, `created_at`, `updated_at`) VALUES (2, 'Hindi', 'HI', 'regional', '2026-10-21 08:13:44', '2026-10-21 08:13:44');
INSERT INTO `languages` (`id`, `name`, `code`, `type`, `created_at`, `updated_at`) VALUES (3, 'Tamil', 'TA', 'regional', '2026-10-21 08:13:44', '2026-10-21 08:13:44');
INSERT INTO `languages` (`id`, `name`, `code`, `type`, `created_at`, `updated_at`) VALUES (4, 'Telugu', 'TE', 'regional', '2026-10-21 08:13:44', '2026-10-21 08:13:44');
INSERT INTO `languages` (`id`, `name`, `code`, `type`, `created_at`, `updated_at`) VALUES (5, 'Punjabi', 'PA', 'regional', '2026-10-21 08:13:44', '2026-10-21 08:13:44');
INSERT INTO `languages` (`id`, `name`, `code`, `type`, `created_at`, `updated_at`) VALUES (6, 'Spanish', 'ES', 'regional', '2026-10-21 08:13:44', '2026-10-21 08:13:44');
INSERT INTO `languages` (`id`, `name`, `code`, `type`, `created_at`, `updated_at`) VALUES (7, 'French', 'FR', 'regional', '2026-10-21 08:13:44', '2026-10-21 08:13:44');
INSERT INTO `languages` (`id`, `name`, `code`, `type`, `created_at`, `updated_at`) VALUES (8, 'Korean', 'KO', 'regional', '2026-10-21 08:13:44', '2026-10-21 08:13:44');

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

-- Dumping data for table `years`
INSERT INTO `years` (`id`, `year`, `description`, `created_at`, `updated_at`) VALUES (1, 1990, 'Era of 1990 releases and greatest hits', '2026-10-21 08:13:44', '2026-10-21 08:13:44');
INSERT INTO `years` (`id`, `year`, `description`, `created_at`, `updated_at`) VALUES (2, 1998, 'Era of 1998 releases and greatest hits', '2026-10-21 08:13:44', '2026-10-21 08:13:44');
INSERT INTO `years` (`id`, `year`, `description`, `created_at`, `updated_at`) VALUES (3, 2005, 'Era of 2005 releases and greatest hits', '2026-10-21 08:13:45', '2026-10-21 08:13:45');
INSERT INTO `years` (`id`, `year`, `description`, `created_at`, `updated_at`) VALUES (4, 2013, 'Era of 2013 releases and greatest hits', '2026-10-21 08:13:45', '2026-10-21 08:13:45');
INSERT INTO `years` (`id`, `year`, `description`, `created_at`, `updated_at`) VALUES (5, 2018, 'Era of 2018 releases and greatest hits', '2026-10-21 08:13:45', '2026-10-21 08:13:45');
INSERT INTO `years` (`id`, `year`, `description`, `created_at`, `updated_at`) VALUES (6, 2020, 'Era of 2020 releases and greatest hits', '2026-10-21 08:13:45', '2026-10-21 08:13:45');
INSERT INTO `years` (`id`, `year`, `description`, `created_at`, `updated_at`) VALUES (7, 2022, 'Era of 2022 releases and greatest hits', '2026-10-21 08:13:45', '2026-10-21 08:13:45');
INSERT INTO `years` (`id`, `year`, `description`, `created_at`, `updated_at`) VALUES (8, 2024, 'Era of 2024 releases and greatest hits', '2026-10-21 08:13:45', '2026-10-21 08:13:45');
INSERT INTO `years` (`id`, `year`, `description`, `created_at`, `updated_at`) VALUES (9, 2025, 'Era of 2025 releases and greatest hits', '2026-10-21 08:13:45', '2026-10-21 08:13:45');
INSERT INTO `years` (`id`, `year`, `description`, `created_at`, `updated_at`) VALUES (10, 2026, 'Era of 2026 releases and greatest hits', '2026-10-21 08:13:45', '2026-10-21 08:13:45');

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

-- Dumping data for table `albums`
INSERT INTO `albums` (`id`, `title`, `slug`, `artist_id`, `genre_id`, `year_id`, `language_id`, `cover_image`, `description`, `release_year`, `created_at`, `updated_at`) VALUES (1, 'After Hours', 'after-hours', 1, 7, 6, 1, 'https://images.unsplash.com/photo-1614613535308-eb5fbd3d2c17?w=500&auto=format&fit=crop&q=80', 'Critically acclaimed synth-wave and dark R&B masterpiece by The Weeknd.', 2020, '2026-10-21 08:13:45', '2026-10-21 08:13:45');
INSERT INTO `albums` (`id`, `title`, `slug`, `artist_id`, `genre_id`, `year_id`, `language_id`, `cover_image`, `description`, `release_year`, `created_at`, `updated_at`) VALUES (2, 'Dil Se (Original Motion Picture)', 'dil-se', 2, 4, 2, 2, 'https://images.unsplash.com/photo-1492684223066-81342ee5ff30?w=500&auto=format&fit=crop&q=80', 'Timeless landmark soundtrack by A.R. Rahman exploring the seven shades of love.', 1998, '2026-10-21 08:13:45', '2026-10-21 08:13:45');
INSERT INTO `albums` (`id`, `title`, `slug`, `artist_id`, `genre_id`, `year_id`, `language_id`, `cover_image`, `description`, `release_year`, `created_at`, `updated_at`) VALUES (3, 'Future Nostalgia', 'future-nostalgia', 3, 1, 6, 1, 'https://images.unsplash.com/photo-1518609878373-06d740f60d8b?w=500&auto=format&fit=crop&q=80', 'Bright disco-funk and dance-pop studio album.', 2020, '2026-10-21 08:13:45', '2026-10-21 08:13:45');
INSERT INTO `albums` (`id`, `title`, `slug`, `artist_id`, `genre_id`, `year_id`, `language_id`, `cover_image`, `description`, `release_year`, `created_at`, `updated_at`) VALUES (4, 'G.O.A.T.', 'goat-album', 5, 3, 6, 5, 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?w=500&auto=format&fit=crop&q=80', 'Record-shattering Punjabi hip-hop album that charted worldwide.', 2020, '2026-10-21 08:13:45', '2026-10-21 08:13:45');
INSERT INTO `albums` (`id`, `title`, `slug`, `artist_id`, `genre_id`, `year_id`, `language_id`, `cover_image`, `description`, `release_year`, `created_at`, `updated_at`) VALUES (5, 'Random Access Memories', 'random-access-memories', 6, 6, 4, 7, 'https://images.unsplash.com/photo-1508700115892-45ecd05ae2ad?w=500&auto=format&fit=crop&q=80', 'A tribute to late-1970s and early-1980s American music by Daft Punk.', 2013, '2026-10-21 08:13:45', '2026-10-21 08:13:45');
INSERT INTO `albums` (`id`, `title`, `slug`, `artist_id`, `genre_id`, `year_id`, `language_id`, `cover_image`, `description`, `release_year`, `created_at`, `updated_at`) VALUES (6, 'Motomami Deluxe', 'motomami-deluxe', 8, 1, 7, 6, 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=500&auto=format&fit=crop&q=80', 'Experimental pop and avant-garde Spanish reggaeton masterwork.', 2022, '2026-10-21 08:13:45', '2026-10-21 08:13:45');
INSERT INTO `albums` (`id`, `title`, `slug`, `artist_id`, `genre_id`, `year_id`, `language_id`, `cover_image`, `description`, `release_year`, `created_at`, `updated_at`) VALUES (7, 'Midnight Melodies & Ragas', 'midnight-melodies', 7, 5, 10, 3, 'https://images.unsplash.com/photo-1470225620780-dba8ba36b745?w=500&auto=format&fit=crop&q=80', 'Fresh modern fusion of Carnatic vocal depth and ambient acoustic warmth.', 2026, '2026-10-21 08:13:45', '2026-10-21 08:13:45');

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

-- Dumping data for table `musics`
INSERT INTO `musics` (`id`, `title`, `slug`, `artist_id`, `album_id`, `genre_id`, `language_id`, `year_id`, `duration`, `audio_url`, `cover_image`, `description`, `lyrics`, `is_new`, `plays_count`, `created_at`, `updated_at`) VALUES (1, 'Blinding Lights (Midnight Echoes)', 'blinding-lights-midnight-echoes', 1, 1, 1, 1, 10, '3:22', 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3', 'https://images.unsplash.com/photo-1614613535308-eb5fbd3d2c17?w=500&auto=format&fit=crop&q=80', 'Electrifying 80s synth-wave single with neon drenched beats and soaring vocals.', 'I\'ve been on my own for long enough, maybe you can show me how to love, maybe...
I\'m running out of time, \'cause I can see the sun light up the sky.', 1, 12456, '2026-10-21 08:13:45', '2026-10-21 08:54:37');
INSERT INTO `musics` (`id`, `title`, `slug`, `artist_id`, `album_id`, `genre_id`, `language_id`, `year_id`, `duration`, `audio_url`, `cover_image`, `description`, `lyrics`, `is_new`, `plays_count`, `created_at`, `updated_at`) VALUES (2, 'Chaiyya Chaiyya (2026 Remaster)', 'chaiyya-chaiyya-remaster', 2, 2, 4, 2, 10, '6:54', 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-2.mp3', 'https://images.unsplash.com/photo-1492684223066-81342ee5ff30?w=500&auto=format&fit=crop&q=80', 'The ultimate Sufi-folk train rhythm remastered in Dolby Atmos audio by SOUND Group.', 'Jinke sar ho ishq ki chhaaon, paanv ke neeche jannat hogi...
Chal chhaiyya chhaiyya chhaiyya chhaiyya!', 1, 38920, '2026-10-21 08:13:45', '2026-10-21 08:13:45');
INSERT INTO `musics` (`id`, `title`, `slug`, `artist_id`, `album_id`, `genre_id`, `language_id`, `year_id`, `duration`, `audio_url`, `cover_image`, `description`, `lyrics`, `is_new`, `plays_count`, `created_at`, `updated_at`) VALUES (3, 'Levitating (Club Future Groove)', 'levitating-club-future-groove', 3, 3, 1, 1, 10, '3:23', 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-3.mp3', 'https://images.unsplash.com/photo-1518609878373-06d740f60d8b?w=500&auto=format&fit=crop&q=80', 'High octane space disco groove with irresistible basslines.', 'If you wanna run away with me, I know a galaxy and I can take you for a ride...
I had a premonition that we fell into a rhythm.', 1, 29400, '2026-10-21 08:13:45', '2026-10-21 08:13:45');
INSERT INTO `musics` (`id`, `title`, `slug`, `artist_id`, `album_id`, `genre_id`, `language_id`, `year_id`, `duration`, `audio_url`, `cover_image`, `description`, `lyrics`, `is_new`, `plays_count`, `created_at`, `updated_at`) VALUES (4, 'G.O.A.T. Anthem (Urban Mix)', 'goat-anthem-urban-mix', 5, 4, 3, 5, 10, '3:45', 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-4.mp3', 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?w=500&auto=format&fit=crop&q=80', 'Unapologetic Punjabi swag featuring hard-hitting 808s and folk dhol loops.', 'Ho jithe hath paa laye othe karde kamaal ni, jatt di chadhayi de taan dinde lok misaal ni!', 1, 45100, '2026-10-21 08:13:45', '2026-10-21 08:13:45');
INSERT INTO `musics` (`id`, `title`, `slug`, `artist_id`, `album_id`, `genre_id`, `language_id`, `year_id`, `duration`, `audio_url`, `cover_image`, `description`, `lyrics`, `is_new`, `plays_count`, `created_at`, `updated_at`) VALUES (5, 'Kannana Kanne (Acoustic Sunrise)', 'kannana-kanne-acoustic-sunrise', 7, 7, 5, 3, 10, '4:28', 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-5.mp3', 'https://images.unsplash.com/photo-1470225620780-dba8ba36b745?w=500&auto=format&fit=crop&q=80', 'Heart-melting regional Tamil ballad sung with deep emotional precision by Sid Sriram.', 'Kannana kanne kannana kanne en meedhu saaya vaa...
Ullukullae unnai naan aravanaikka vaa...', 1, 21800, '2026-10-21 08:13:45', '2026-10-21 08:13:45');
INSERT INTO `musics` (`id`, `title`, `slug`, `artist_id`, `album_id`, `genre_id`, `language_id`, `year_id`, `duration`, `audio_url`, `cover_image`, `description`, `lyrics`, `is_new`, `plays_count`, `created_at`, `updated_at`) VALUES (6, 'Kesariya (Eternal Flame)', 'kesariya-eternal-flame', 4, NULL, 4, 2, 7, '4:28', 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-8.mp3', 'https://images.unsplash.com/photo-1514525253161-7a46d19cd819?w=500&auto=format&fit=crop&q=80', 'Arijit Singh at his peak, delivering melodic romantic transcendence.', 'Kesariya tera ishq hai piya, rang jaaun jo main haath lagaun...', 0, 98400, '2026-10-21 08:13:45', '2026-10-21 08:13:45');
INSERT INTO `musics` (`id`, `title`, `slug`, `artist_id`, `album_id`, `genre_id`, `language_id`, `year_id`, `duration`, `audio_url`, `cover_image`, `description`, `lyrics`, `is_new`, `plays_count`, `created_at`, `updated_at`) VALUES (7, 'Get Lucky (French Touch Edition)', 'get-lucky-french-touch', 6, 5, 6, 7, 4, '4:08', 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-9.mp3', 'https://images.unsplash.com/photo-1508700115892-45ecd05ae2ad?w=500&auto=format&fit=crop&q=80', 'Funk guitar grooves meet vocoder harmonies in one of the most awarded dance anthems of the decade.', 'Like the legend of the phoenix, all ends with beginnings...', 0, 88100, '2026-10-21 08:13:45', '2026-10-21 08:13:45');
INSERT INTO `musics` (`id`, `title`, `slug`, `artist_id`, `album_id`, `genre_id`, `language_id`, `year_id`, `duration`, `audio_url`, `cover_image`, `description`, `lyrics`, `is_new`, `plays_count`, `created_at`, `updated_at`) VALUES (8, 'Saoko (Neon Fuego)', 'saoko-neon-fuego', 8, 6, 1, 6, 7, '2:17', 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-10.mp3', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=500&auto=format&fit=crop&q=80', 'High octane drums mixed with avant-garde jazz piano chords in Spanish regional fusion.', 'Chica, ¿qué dices? Saoko, papi, saoko! Cuando el caballo entra a Troya, tú te confías...', 0, 42000, '2026-10-21 08:13:45', '2026-10-21 08:13:45');

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

-- Dumping data for table `videos`
INSERT INTO `videos` (`id`, `title`, `slug`, `artist_id`, `album_id`, `genre_id`, `language_id`, `year_id`, `duration`, `video_url`, `thumbnail_image`, `description`, `is_new`, `views_count`, `created_at`, `updated_at`) VALUES (1, 'Blinding Lights - Official 4K Cinema Cut', 'blinding-lights-official-4k', 1, 1, 1, 1, 10, '4:20', 'https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4', 'https://images.unsplash.com/photo-1514525253161-7a46d19cd819?w=600&auto=format&fit=crop&q=80', 'High-speed Vegas night cruise in 4K HDR. Neo-noir cinematic visual storytelling.', 1, 54300, '2026-10-21 08:13:45', '2026-10-21 08:13:45');
INSERT INTO `videos` (`id`, `title`, `slug`, `artist_id`, `album_id`, `genre_id`, `language_id`, `year_id`, `duration`, `video_url`, `thumbnail_image`, `description`, `is_new`, `views_count`, `created_at`, `updated_at`) VALUES (2, 'Chaiyya Chaiyya - Live at Royal Albert Hall', 'chaiyya-chaiyya-live-royal-albert', 2, 2, 4, 2, 10, '7:15', 'https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ElephantsDream.mp4', 'https://images.unsplash.com/photo-1465847899084-d164df4dedc6?w=600&auto=format&fit=crop&q=80', 'A.R. Rahman conducts 80-piece orchestra with traditional dhol players in London.', 1, 78200, '2026-10-21 08:13:45', '2026-10-21 08:13:45');
INSERT INTO `videos` (`id`, `title`, `slug`, `artist_id`, `album_id`, `genre_id`, `language_id`, `year_id`, `duration`, `video_url`, `thumbnail_image`, `description`, `is_new`, `views_count`, `created_at`, `updated_at`) VALUES (3, 'Physical & Levitating - Stadium Visualizer', 'levitating-stadium-visualizer', 3, 3, 1, 1, 10, '3:50', 'https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerBlazes.mp4', 'https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?w=600&auto=format&fit=crop&q=80', 'Dazzling laser stage production filmed during Dua Lipa world stadium tour.', 1, 32400, '2026-10-21 08:13:45', '2026-10-21 08:13:45');
INSERT INTO `videos` (`id`, `title`, `slug`, `artist_id`, `album_id`, `genre_id`, `language_id`, `year_id`, `duration`, `video_url`, `thumbnail_image`, `description`, `is_new`, `views_count`, `created_at`, `updated_at`) VALUES (4, 'Born to Shine & G.O.A.T. - Live in Toronto', 'goat-live-toronto', 5, 4, 3, 5, 10, '5:10', 'https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerEscapes.mp4', 'https://images.unsplash.com/photo-1508700115892-45ecd05ae2ad?w=600&auto=format&fit=crop&q=80', 'Historical sold-out arena show featuring Punjabi folk fusion and electric crowd vibes.', 1, 61000, '2026-10-21 08:13:45', '2026-10-21 08:13:45');
INSERT INTO `videos` (`id`, `title`, `slug`, `artist_id`, `album_id`, `genre_id`, `language_id`, `year_id`, `duration`, `video_url`, `thumbnail_image`, `description`, `is_new`, `views_count`, `created_at`, `updated_at`) VALUES (5, 'Soul of Madras - Sid Sriram Unplugged', 'soul-of-madras-unplugged', 7, 7, 5, 3, 10, '4:45', 'https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerFun.mp4', 'https://images.unsplash.com/photo-1501386761578-eac5c94b800a?w=600&auto=format&fit=crop&q=80', 'Intimate acoustic session overlooking the Bay of Bengal at twilight.', 1, 28500, '2026-10-21 08:13:45', '2026-10-21 08:13:45');
INSERT INTO `videos` (`id`, `title`, `slug`, `artist_id`, `album_id`, `genre_id`, `language_id`, `year_id`, `duration`, `video_url`, `thumbnail_image`, `description`, `is_new`, `views_count`, `created_at`, `updated_at`) VALUES (6, 'Lose Yourself to Dance - Retro 70s Studio', 'lose-yourself-to-dance-retro', 6, 5, 6, 7, 4, '4:11', 'https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/TearsOfSteel.mp4', 'https://images.unsplash.com/photo-1470225620780-dba8ba36b745?w=600&auto=format&fit=crop&q=80', 'Sequined suits, pyramid risers, and Nile Rodgers signature Stratocaster rhythm.', 0, 92000, '2026-10-21 08:13:45', '2026-10-21 08:13:45');
INSERT INTO `videos` (`id`, `title`, `slug`, `artist_id`, `album_id`, `genre_id`, `language_id`, `year_id`, `duration`, `video_url`, `thumbnail_image`, `description`, `is_new`, `views_count`, `created_at`, `updated_at`) VALUES (7, 'Bizcochito - Moto Tour Visual Experience', 'bizcochito-moto-tour', 8, 6, 1, 6, 7, '3:12', 'https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/WeAreGoingOnBullrun.mp4', 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?w=600&auto=format&fit=crop&q=80', 'Viral choreography and avant-garde Spanish pop stage aesthetic.', 0, 47900, '2026-10-21 08:13:45', '2026-10-21 08:13:45');

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

-- Dumping data for table `reviews`
INSERT INTO `reviews` (`id`, `user_id`, `item_type`, `item_id`, `rating`, `review_text`, `created_at`, `updated_at`) VALUES (1, 2, 'music', 1, 5, 'VERIFIED MODIFICATION: John Doe updated this review with 5 stars for stellar synthwave beats!', '2026-10-21 08:13:45', '2026-10-21 08:54:37');
INSERT INTO `reviews` (`id`, `user_id`, `item_type`, `item_id`, `rating`, `review_text`, `created_at`, `updated_at`) VALUES (2, 3, 'music', 2, 5, 'A.R. Rahman\'s genius is unmatched! Hearing this remastered Dolby Atmos version brought tears to my eyes. The regional energy and Sufi poetry are timeless.', '2026-10-21 08:13:45', '2026-10-21 08:13:45');
INSERT INTO `reviews` (`id`, `user_id`, `item_type`, `item_id`, `rating`, `review_text`, `created_at`, `updated_at`) VALUES (3, 2, 'video', 1, 5, 'The cinematography in this video looks like a full cinema movie. Amazing dark aesthetic and flawless color grading!', '2026-10-21 08:13:45', '2026-10-21 08:13:45');
INSERT INTO `reviews` (`id`, `user_id`, `item_type`, `item_id`, `rating`, `review_text`, `created_at`, `updated_at`) VALUES (4, 3, 'video', 2, 5, 'The live orchestra energy is phenomenal! Huge salute to SOUND Group for hosting regional classics with such high fidelity video.', '2026-10-21 08:13:45', '2026-10-21 08:13:45');
INSERT INTO `reviews` (`id`, `user_id`, `item_type`, `item_id`, `rating`, `review_text`, `created_at`, `updated_at`) VALUES (5, 2, 'music', 3, 4, 'Super energetic pop anthem! Dua Lipa always delivers great club vibes.', '2026-10-21 08:13:45', '2026-10-21 08:13:45');
INSERT INTO `reviews` (`id`, `user_id`, `item_type`, `item_id`, `rating`, `review_text`, `created_at`, `updated_at`) VALUES (6, 3, 'music', 5, 5, 'Sid Sriram\'s voice hits straight in the heart. The Carnatic flourishes on acoustic guitar are pure gold.', '2026-10-21 08:13:45', '2026-10-21 08:13:45');

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

-- Dumping data for table `site_settings`
INSERT INTO `site_settings` (`id`, `key`, `value`, `description`, `created_at`, `updated_at`) VALUES (1, 'site_name', 'SOUND Group Entertainment', 'Site name', '2026-10-21 08:13:45', '2026-10-21 08:13:45');
INSERT INTO `site_settings` (`id`, `key`, `value`, `description`, `created_at`, `updated_at`) VALUES (2, 'site_tagline', 'Global & Regional Audio-Visual Entertainment Portal', 'Site tagline', '2026-10-21 08:13:45', '2026-10-21 08:13:45');
INSERT INTO `site_settings` (`id`, `key`, `value`, `description`, `created_at`, `updated_at`) VALUES (3, 'about_title', 'About SOUND Group Entertainment', 'About title', '2026-10-21 08:13:45', '2026-10-21 08:13:45');
INSERT INTO `site_settings` (`id`, `key`, `value`, `description`, `created_at`, `updated_at`) VALUES (4, 'about_description', 'SOUND Group is an international entertainment enterprise dedicated to celebrating musical and cinematic artistry across cultures. Our portal curates the finest collection of contemporary hits and historic gems in both Regional (Hindi, Tamil, Telugu, Punjabi, Spanish, French, Korean) and English languages. With state-of-the-art lossless audio streaming, 4K video playback, authentic community reviews, and deep categorization by Album, Artist, Year, Genre, and Language, SOUND Group empowers audiences worldwide to discover sound without borders.', 'About description', '2026-10-21 08:13:45', '2026-10-21 08:13:45');
INSERT INTO `site_settings` (`id`, `key`, `value`, `description`, `created_at`, `updated_at`) VALUES (5, 'contact_email', 'contact@soundgroup.com', 'Contact email', '2026-10-21 08:13:45', '2026-10-21 08:13:45');
INSERT INTO `site_settings` (`id`, `key`, `value`, `description`, `created_at`, `updated_at`) VALUES (6, 'contact_phone', '+1 (800) 555-SOUND', 'Contact phone', '2026-10-21 08:13:45', '2026-10-21 08:13:45');
INSERT INTO `site_settings` (`id`, `key`, `value`, `description`, `created_at`, `updated_at`) VALUES (7, 'contact_address', 'SOUND Group Entertainment Tower, 500 Melody Way, Suite 100, Los Angeles, CA 90028, USA', 'Contact address', '2026-10-21 08:13:45', '2026-10-21 08:13:45');
INSERT INTO `site_settings` (`id`, `key`, `value`, `description`, `created_at`, `updated_at`) VALUES (8, 'hero_headline', 'Feel the Beat. Experience the Vision.', 'Hero headline', '2026-10-21 08:13:45', '2026-10-21 08:13:45');
INSERT INTO `site_settings` (`id`, `key`, `value`, `description`, `created_at`, `updated_at`) VALUES (9, 'hero_subheadline', 'Stream new and legendary Music and Videos across Regional and English languages in stunning dark fidelity.', 'Hero subheadline', '2026-10-21 08:13:45', '2026-10-21 08:13:45');
INSERT INTO `site_settings` (`id`, `key`, `value`, `description`, `created_at`, `updated_at`) VALUES (10, 'announcement', '🔥 NEW ADDITIONS: Check out the latest 5 Songs & 5 Videos flashing with exclusive releases!', 'Announcement', '2026-10-21 08:13:45', '2026-10-21 08:13:45');
INSERT INTO `site_settings` (`id`, `key`, `value`, `description`, `created_at`, `updated_at`) VALUES (11, 'footer_text', '© 2026 SOUND Group Entertainment Inc. All Rights Reserved. Built with Laravel 11.', 'Footer text', '2026-10-21 08:13:45', '2026-10-21 08:13:45');

SET FOREIGN_KEY_CHECKS=1;
