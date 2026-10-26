<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ExportDatabaseBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:export-sql {--file=database/sound_group_backup.sql}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export full database schema and data as a MySQL-compatible SQL backup file';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filePath = base_path($this->option('file'));
        $this->info("Exporting database to: {$filePath}...");

        $tables = [
            'users',
            'password_reset_tokens',
            'sessions',
            'artists',
            'genres',
            'languages',
            'years',
            'albums',
            'musics',
            'videos',
            'reviews',
            'site_settings',
        ];

        $sql = "-- ==========================================================\n";
        $sql .= "-- SOUND Group Entertainment Portal Database Backup\n";
        $sql .= "-- Generated: " . date('Y-m-d H:i:s') . "\n";
        $sql .= "-- Compatible with MySQL 5.7+, MySQL 8.0+, MariaDB & SQLite\n";
        $sql .= "-- ==========================================================\n\n";
        $sql .= "SET FOREIGN_KEY_CHECKS=0;\n\n";

        foreach ($tables as $table) {
            if (!Schema::hasTable($table)) {
                continue;
            }

            $sql .= "-- --------------------------------------------------------\n";
            $sql .= "-- Table structure for table `{$table}`\n";
            $sql .= "-- --------------------------------------------------------\n";
            $sql .= "DROP TABLE IF EXISTS `{$table}`;\n";

            // Generate MySQL CREATE TABLE statements
            $createTableSql = match ($table) {
                'users' => "CREATE TABLE `users` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;\n\n",
                'artists' => "CREATE TABLE `artists` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL UNIQUE,
  `bio` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;\n\n",
                'genres' => "CREATE TABLE `genres` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL UNIQUE,
  `slug` varchar(255) NOT NULL UNIQUE,
  `description` text DEFAULT NULL,
  `color` varchar(255) DEFAULT '#10B981',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;\n\n",
                'languages' => "CREATE TABLE `languages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL UNIQUE,
  `code` varchar(10) NOT NULL,
  `type` enum('english','regional') NOT NULL DEFAULT 'regional',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;\n\n",
                'years' => "CREATE TABLE `years` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `year` int(11) NOT NULL UNIQUE,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;\n\n",
                'albums' => "CREATE TABLE `albums` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;\n\n",
                'musics' => "CREATE TABLE `musics` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;\n\n",
                'videos' => "CREATE TABLE `videos` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;\n\n",
                'reviews' => "CREATE TABLE `reviews` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;\n\n",
                'site_settings' => "CREATE TABLE `site_settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL UNIQUE,
  `value` text DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;\n\n",
                default => "-- Generic table {$table}\n\n",
            };

            $sql .= $createTableSql;

            // Fetch rows
            $rows = DB::table($table)->get();
            if ($rows->count() > 0) {
                $sql .= "-- Dumping data for table `{$table}`\n";
                foreach ($rows as $row) {
                    $rowArray = (array) $row;
                    $columns = array_keys($rowArray);
                    $values = array_map(function ($val) {
                        if (is_null($val)) return 'NULL';
                        if (is_bool($val)) return $val ? '1' : '0';
                        if (is_numeric($val)) return (string) $val;
                        return "'" . addslashes((string) $val) . "'";
                    }, array_values($rowArray));

                    $sql .= "INSERT INTO `{$table}` (`" . implode('`, `', $columns) . "`) VALUES (" . implode(', ', $values) . ");\n";
                }
                $sql .= "\n";
            }
        }

        $sql .= "SET FOREIGN_KEY_CHECKS=1;\n";

        file_put_contents($filePath, $sql);
        $this->info("Backup exported successfully to {$filePath} (" . number_format(filesize($filePath)) . " bytes).");
        return Command::SUCCESS;
    }
}
