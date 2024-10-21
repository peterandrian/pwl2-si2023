-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.32-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for db_laravel11
CREATE DATABASE IF NOT EXISTS `db_laravel11` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `db_laravel11`;

-- Dumping structure for table db_laravel11.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_laravel11.cache: ~0 rows (approximately)

-- Dumping structure for table db_laravel11.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_laravel11.cache_locks: ~0 rows (approximately)

-- Dumping structure for table db_laravel11.category_product
CREATE TABLE IF NOT EXISTS `category_product` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_category_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_laravel11.category_product: ~1 rows (approximately)
INSERT INTO `category_product` (`id`, `product_category_name`, `created_at`, `updated_at`) VALUES
	(1, 'bumbu dapur', '2024-09-11 13:57:40', '2024-09-11 13:57:41');

-- Dumping structure for table db_laravel11.detail_transaksi_penjualan
CREATE TABLE IF NOT EXISTS `detail_transaksi_penjualan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_transaksi_penjualan` int(11) DEFAULT NULL,
  `id_product` int(11) DEFAULT NULL,
  `jumlah_pembelian` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `id transaksi` (`id_transaksi_penjualan`),
  KEY `id product` (`id_product`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_laravel11.detail_transaksi_penjualan: ~7 rows (approximately)
INSERT INTO `detail_transaksi_penjualan` (`id`, `id_transaksi_penjualan`, `id_product`, `jumlah_pembelian`, `created_at`, `updated_at`) VALUES
	(1, 1, 2, 4, '2024-10-16 12:05:38', '2024-10-16 12:05:39'),
	(2, 1, 4, 4, '2024-10-16 12:12:37', '2024-10-16 12:12:38'),
	(3, 2, 2, 1, '2024-10-16 15:25:08', '2024-10-16 15:25:09'),
	(11, 8, 2, 2, '2024-10-18 06:39:39', '2024-10-18 06:39:39'),
	(12, 8, 5, 3, '2024-10-18 06:39:39', '2024-10-18 06:39:39'),
	(13, 10, 2, 2, NULL, NULL),
	(14, 11, 5, 3, NULL, NULL);

-- Dumping structure for table db_laravel11.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_laravel11.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table db_laravel11.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_laravel11.jobs: ~0 rows (approximately)

-- Dumping structure for table db_laravel11.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_laravel11.job_batches: ~0 rows (approximately)

-- Dumping structure for table db_laravel11.kasir
CREATE TABLE IF NOT EXISTS `kasir` (
  `id` int(11) DEFAULT NULL,
  `nama_kasir` text DEFAULT NULL,
  `email_kasir` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_laravel11.kasir: ~2 rows (approximately)
INSERT INTO `kasir` (`id`, `nama_kasir`, `email_kasir`) VALUES
	(1, 'john', 'john@gmail.com'),
	(2, 'karen', 'karen@gmail.com');

-- Dumping structure for table db_laravel11.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_laravel11.migrations: ~4 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2024_09_11_122927_create_products_table', 1);

-- Dumping structure for table db_laravel11.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_laravel11.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table db_laravel11.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_category_id` bigint(20) unsigned DEFAULT NULL,
  `id_supplier` int(11) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` bigint(20) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_product_category_id_index` (`product_category_id`),
  KEY `id_supplier` (`id_supplier`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_laravel11.products: ~3 rows (approximately)
INSERT INTO `products` (`id`, `product_category_id`, `id_supplier`, `image`, `title`, `description`, `price`, `stock`, `created_at`, `updated_at`) VALUES
	(2, 1, 1, 'E7FXgUhW7AKVt740UN7cnUFbYZLBEnHVNNgqutew.jpg', 'teh manis', '<p>teh manis indofood</p>', 15000, 1, '2024-09-25 06:46:40', '2024-10-18 06:53:11'),
	(4, 1, 1, '20Ocadj8jQbDJNfJ1IHB5eSk1V5IW6xbsddngpEl.png', 'bawang', '<p>bawang enak per kilo</p>', 25000, 5, '2024-10-02 06:42:55', '2024-10-17 11:11:40'),
	(5, 1, 1, 'QkSbkpTcJi7uJbe4TkM6ZaEnPH58t7Ex0cfuyTC6.jpg', 'nugget', '<p>nugget mentah</p>', 34000, 0, '2024-10-18 06:38:19', '2024-10-18 06:54:11');

-- Dumping structure for table db_laravel11.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_laravel11.sessions: ~4 rows (approximately)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('A8BfnM03pPO9MFrLfNYtvmPo5PTwemsUxDDCK60M', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUjRINnJZc0didVdPeGJERm5pdXJxNDlrVURFS215N3hwczN4MXEzaCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC90cmFuc2FjdGlvbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1729194118),
	('ggj29VVaAmVyn4qVGQbs71jClpHOLETgM370A9dY', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZzM5Uk1VUGswNHM5UlVDMzd2c1l5UktrSldFVUxSdHFXMlVtb2szWSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC90cmFuc2FjdGlvbi9jcmVhdGUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1729101369),
	('iQLUv2mpWNiHvTeL4dedxirdGdoKh5uSGf3erMGK', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQUg0TmlaZUh3QlJTVkFLSE9XVFVVSnRDZzNRaEdONFFHYmx1MEFsdCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC90cmFuc2FjdGlvbi9jcmVhdGUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1729111343),
	('l6jEz53tVfl6NJwpiVGd8a3wGsyUUZfbCac0YUFC', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidUc2V0FlSDdZM2hXanlvQnhybk9SVEpVNjFnV1laTVhBZjFENnlpcSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9kdWN0cy81L2VkaXQiO319', 1729259695);

-- Dumping structure for table db_laravel11.suppliers
CREATE TABLE IF NOT EXISTS `suppliers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(255) NOT NULL,
  `pic_supplier` varchar(255) NOT NULL,
  `alamat_supplier` text DEFAULT NULL,
  `no_hp_pic_supplier` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_laravel11.suppliers: ~1 rows (approximately)
INSERT INTO `suppliers` (`id`, `supplier_name`, `pic_supplier`, `alamat_supplier`, `no_hp_pic_supplier`, `created_at`, `updated_at`) VALUES
	(1, 'PT Indofood', 'John Doe', 'tes', '012 5555', '2024-09-12 09:37:47', '2024-09-12 09:37:48');

-- Dumping structure for table db_laravel11.transaksi_penjualan
CREATE TABLE IF NOT EXISTS `transaksi_penjualan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kasir` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_laravel11.transaksi_penjualan: ~5 rows (approximately)
INSERT INTO `transaksi_penjualan` (`id`, `id_kasir`, `created_at`, `updated_at`) VALUES
	(1, 1, '2024-10-16 12:02:52', '2024-10-16 12:02:53'),
	(2, 2, '2024-10-16 15:25:23', '2024-10-16 15:25:24'),
	(8, 1, '2024-10-18 06:39:39', '2024-10-18 06:39:39'),
	(10, 2, '2024-10-18 06:53:11', '2024-10-18 06:53:11'),
	(11, 1, '2024-10-18 06:54:11', '2024-10-18 06:54:11');

-- Dumping structure for table db_laravel11.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_laravel11.users: ~0 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
