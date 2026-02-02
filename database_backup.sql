/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19-12.1.2-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: crm
-- ------------------------------------------------------
-- Server version	12.1.2-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*M!100616 SET @OLD_NOTE_VERBOSITY=@@NOTE_VERBOSITY, NOTE_VERBOSITY=0 */;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `fichajes`
--

DROP TABLE IF EXISTS `fichajes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `fichajes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `trabajador_id` bigint(20) unsigned NOT NULL,
  `obra_id` bigint(20) unsigned NOT NULL,
  `fecha` date NOT NULL,
  `hora_entrada` time NOT NULL,
  `hora_salida` time DEFAULT NULL,
  `horas_trabajadas` decimal(5,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fichajes_trabajador_id_foreign` (`trabajador_id`),
  KEY `fichajes_obra_id_foreign` (`obra_id`),
  CONSTRAINT `fichajes_obra_id_foreign` FOREIGN KEY (`obra_id`) REFERENCES `obras` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fichajes_trabajador_id_foreign` FOREIGN KEY (`trabajador_id`) REFERENCES `trabajadores` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fichajes`
--

LOCK TABLES `fichajes` WRITE;
/*!40000 ALTER TABLE `fichajes` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `fichajes` VALUES
(1,1,1,'2026-02-02','02:06:00','14:24:00',-12.31,'2026-02-02 01:06:45','2026-02-02 13:24:50'),
(2,2,2,'2026-02-02','15:22:09','22:22:09',7.00,'2026-02-02 01:55:32','2026-02-02 01:55:32'),
(3,2,2,'2026-02-01','17:47:12','02:47:12',9.00,'2026-02-02 01:55:32','2026-02-02 01:55:32'),
(4,2,2,'2026-01-31','01:05:36','10:05:36',9.00,'2026-02-02 01:55:32','2026-02-02 01:55:32'),
(5,2,2,'2026-01-30','17:44:10','23:44:10',6.00,'2026-02-02 01:55:32','2026-02-02 01:55:32'),
(6,3,3,'2026-02-02','13:26:10','19:26:10',6.00,'2026-02-02 01:55:32','2026-02-02 01:55:32'),
(7,3,3,'2026-02-01','08:37:47','14:37:47',6.00,'2026-02-02 01:55:32','2026-02-02 01:55:32'),
(8,3,3,'2026-01-31','04:45:07','13:45:07',9.00,'2026-02-02 01:55:32','2026-02-02 01:55:32'),
(9,3,3,'2026-01-30','10:03:08','17:03:08',7.00,'2026-02-02 01:55:32','2026-02-02 01:55:32'),
(10,4,5,'2026-02-02','03:04:35','10:04:35',7.00,'2026-02-02 01:55:32','2026-02-02 01:55:32'),
(11,4,5,'2026-02-01','17:12:35','01:12:35',8.00,'2026-02-02 01:55:32','2026-02-02 01:55:32'),
(12,4,5,'2026-01-31','16:34:31','22:34:31',6.00,'2026-02-02 01:55:32','2026-02-02 01:55:32'),
(13,4,5,'2026-01-30','01:58:38','10:58:38',9.00,'2026-02-02 01:55:32','2026-02-02 01:55:32'),
(14,4,5,'2026-01-29','02:40:51','08:40:51',6.00,'2026-02-02 01:55:32','2026-02-02 01:55:32'),
(15,4,5,'2026-01-28','07:00:12','13:00:12',6.00,'2026-02-02 01:55:32','2026-02-02 01:55:32'),
(16,5,5,'2026-02-02','18:48:48','03:48:48',9.00,'2026-02-02 01:55:32','2026-02-02 01:55:32'),
(17,5,5,'2026-02-01','16:29:52','00:29:52',8.00,'2026-02-02 01:55:32','2026-02-02 01:55:32'),
(18,5,5,'2026-01-31','00:52:04','06:52:04',6.00,'2026-02-02 01:55:32','2026-02-02 01:55:32'),
(19,5,5,'2026-01-30','18:42:51','00:42:51',6.00,'2026-02-02 01:55:32','2026-02-02 01:55:32'),
(20,5,5,'2026-01-29','15:14:41','23:14:41',8.00,'2026-02-02 01:55:32','2026-02-02 01:55:32'),
(21,6,4,'2026-02-02','23:35:28','05:35:28',6.00,'2026-02-02 01:55:32','2026-02-02 01:55:32'),
(22,6,4,'2026-02-01','08:37:29','17:37:29',9.00,'2026-02-02 01:55:32','2026-02-02 01:55:32'),
(23,6,4,'2026-01-31','15:36:28','22:36:28',7.00,'2026-02-02 01:55:32','2026-02-02 01:55:32'),
(24,6,4,'2026-01-30','07:52:24','14:52:24',7.00,'2026-02-02 01:55:32','2026-02-02 01:55:32'),
(25,7,2,'2026-02-02','20:46:03','04:46:03',8.00,'2026-02-02 01:55:32','2026-02-02 01:55:32'),
(26,7,2,'2026-02-01','16:02:14','22:02:14',6.00,'2026-02-02 01:55:32','2026-02-02 01:55:32'),
(27,7,2,'2026-01-31','17:05:13','23:05:13',6.00,'2026-02-02 01:55:32','2026-02-02 01:55:32'),
(28,7,2,'2026-01-30','04:05:46','10:05:46',6.00,'2026-02-02 01:55:32','2026-02-02 01:55:32'),
(29,8,3,'2026-02-02','20:48:49','05:48:49',9.00,'2026-02-02 01:55:32','2026-02-02 01:55:32'),
(30,8,3,'2026-02-01','06:57:35','15:57:35',9.00,'2026-02-02 01:55:32','2026-02-02 01:55:32'),
(31,8,3,'2026-01-31','04:33:03','11:33:03',7.00,'2026-02-02 01:55:32','2026-02-02 01:55:32'),
(32,8,3,'2026-01-30','13:13:26','20:13:26',7.00,'2026-02-02 01:55:32','2026-02-02 01:55:32'),
(33,9,2,'2026-02-02','08:01:26','15:01:26',7.00,'2026-02-02 01:55:32','2026-02-02 01:55:32'),
(34,9,2,'2026-02-01','02:16:08','08:16:08',6.00,'2026-02-02 01:55:32','2026-02-02 01:55:32'),
(35,9,2,'2026-01-31','00:39:29','06:39:29',6.00,'2026-02-02 01:55:32','2026-02-02 01:55:32'),
(36,7,1,'2026-02-02','14:24:00','14:24:00',-0.02,'2026-02-02 13:24:56','2026-02-02 13:24:57'),
(37,7,1,'2026-02-02','14:25:00','14:25:00',-0.01,'2026-02-02 13:25:31','2026-02-02 13:25:33'),
(38,7,1,'2026-02-02','14:25:00','14:25:00',-0.01,'2026-02-02 13:25:36','2026-02-02 13:25:39'),
(39,7,1,'2026-02-02','15:50:00',NULL,NULL,'2026-02-02 14:50:31','2026-02-02 14:50:31');
/*!40000 ALTER TABLE `fichajes` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `migrations` VALUES
(1,'0001_01_01_000000_create_users_table',1),
(2,'0001_01_01_000001_create_cache_table',1),
(3,'0001_01_01_000002_create_jobs_table',1),
(4,'2026_01_26_191013_create_productos_table',1),
(5,'2026_01_27_041119_create_trabajadores_table',1),
(6,'2026_01_27_041756_create_obras_table',1),
(7,'2026_01_27_042105_create_obra_trabajador_table',1),
(8,'2026_01_29_042703_create_fichajes_table',2),
(9,'2026_02_02_000000_add_columns_to_obra_trabajador_table',3);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `obra_trabajador`
--

DROP TABLE IF EXISTS `obra_trabajador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `obra_trabajador` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `obra_id` bigint(20) unsigned NOT NULL,
  `trabajador_id` bigint(20) unsigned NOT NULL,
  `fecha_asignacion` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `obra_trabajador_obra_id_foreign` (`obra_id`),
  KEY `obra_trabajador_trabajador_id_foreign` (`trabajador_id`),
  CONSTRAINT `obra_trabajador_obra_id_foreign` FOREIGN KEY (`obra_id`) REFERENCES `obras` (`id`) ON DELETE CASCADE,
  CONSTRAINT `obra_trabajador_trabajador_id_foreign` FOREIGN KEY (`trabajador_id`) REFERENCES `trabajadores` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `obra_trabajador`
--

LOCK TABLES `obra_trabajador` WRITE;
/*!40000 ALTER TABLE `obra_trabajador` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `obra_trabajador` VALUES
(1,'2026-02-02 01:39:46','2026-02-02 01:39:46',1,1,'2001-03-12',NULL),
(2,'2026-02-02 01:55:32','2026-02-02 01:55:32',4,2,'2025-12-03',NULL),
(3,'2026-02-02 01:55:32','2026-02-02 01:55:32',2,2,'2025-12-10',NULL),
(4,'2026-02-02 01:55:32','2026-02-02 01:55:32',5,3,'2025-12-29',NULL),
(5,'2026-02-02 01:55:32','2026-02-02 01:55:32',3,3,'2026-01-17',NULL),
(6,'2026-02-02 01:55:32','2026-02-02 01:55:32',2,4,'2026-01-10',NULL),
(7,'2026-02-02 01:55:32','2026-02-02 01:55:32',3,5,'2025-12-03',NULL),
(8,'2026-02-02 01:55:32','2026-02-02 01:55:32',4,5,'2026-01-06',NULL),
(9,'2026-02-02 01:55:32','2026-02-02 01:55:32',4,6,'2025-12-12',NULL),
(10,'2026-02-02 01:55:32','2026-02-02 01:55:32',3,6,'2025-12-11',NULL),
(11,'2026-02-02 01:55:32','2026-02-02 01:55:32',3,7,'2026-01-22',NULL),
(12,'2026-02-02 01:55:32','2026-02-02 01:55:32',3,8,'2026-01-26',NULL),
(13,'2026-02-02 01:55:32','2026-02-02 01:55:32',5,9,'2026-01-01',NULL);
/*!40000 ALTER TABLE `obra_trabajador` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `obras`
--

DROP TABLE IF EXISTS `obras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `obras` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date DEFAULT NULL,
  `estado` enum('en curso','finalizada','pausada') NOT NULL DEFAULT 'en curso',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `obras`
--

LOCK TABLES `obras` WRITE;
/*!40000 ALTER TABLE `obras` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `obras` VALUES
(1,'Don pollo hause','Calle lechuga','2999-12-03','3330-01-20','en curso','2026-02-02 00:11:43','2026-02-02 00:12:16',NULL),
(2,'Obra Eum Aut','Avinguda Perea, 1, 8º B','2025-10-13',NULL,'finalizada','2026-02-02 01:55:32','2026-02-02 01:55:32',NULL),
(3,'Obra Sint Deserunt','Camiño Raúl, 285, 1º B','2025-12-08',NULL,'pausada','2026-02-02 01:55:32','2026-02-02 01:55:32',NULL),
(4,'Obra Architecto Accusantium','Camiño Roca, 476, 2º D','2025-11-30',NULL,'finalizada','2026-02-02 01:55:32','2026-02-02 01:55:32',NULL),
(5,'Obra Expedita Omnis','Avinguda Laia, 7, 1º B','2025-11-09',NULL,'pausada','2026-02-02 01:55:32','2026-02-02 01:55:32',NULL);
/*!40000 ALTER TABLE `obras` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `productos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
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
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `sessions` VALUES
('8bMFjRJgItAXqoWDXubMcLjceHoWb9PmcPZgKEvB',NULL,'127.0.0.1','curl/8.18.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiajJPZkUwbDVoYVlocVBUSzJ3RXlHdFM2dkJ0QlpHeGNUVnRHdEFmSyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMSI7czo1OiJyb3V0ZSI7czoxMDoiYmllbnZlbmlkbyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1770045907),
('AsGcSn6SNX8zNfuXGOZzjcClbwbEpvbTSP4meAQu',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.108.2 Chrome/142.0.7444.235 Electron/39.2.7 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiUkV4bzFsaVY3bW1wckJBb3o3eXA1eldKYzlaRjcxNUxiM2ZZeE9mMSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTAwOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvbG9naW4/aWQ9N2NhMjlmZjktNDQ2Yi00NGEzLWJiOGMtZTk3NTQ0ZmQ4OGJmJnZzY29kZUJyb3dzZXJSZXFJZD0xNzcwMDQ3MTQ2NTk1IjtzOjU6InJvdXRlIjtzOjU6ImxvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1770047146),
('EY6l7v9RTwuixDbaXMnjPGchmuFZYdTFGMsDURO4',NULL,'127.0.0.1','curl/8.18.0','YToyOntzOjY6Il90b2tlbiI7czo0MDoiZzlRS09yM21FNWpkTWxFcFNSem93OGxXcmtsdjNOa0FlSFFaazl5UiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1770045158),
('fGs4FPSLkZsWSgZ1p6vgIlLray2yijfhXJSu1r9k',NULL,'127.0.0.1','curl/8.18.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoicmhseE1HekEzdjRzaG1iTWlwWTd6aVRtZlJ6eGFZNU5xOFkwUzczayI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMS9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1770045549),
('fSQhSQi4xxughrWZk30L4Qv2FYGN8gJfD1cwJd7D',NULL,'127.0.0.1','curl/8.18.0','YToyOntzOjY6Il90b2tlbiI7czo0MDoiTGlibjBSUm5DREE2ZWU1YVpLcFRNZEVaRDBlMEFWSVpFR2JncDZHciI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1770044971),
('fYl90gfwKLlKeQXq4ouRFx41xCUvE4qvephGshsm',NULL,'127.0.0.1','curl/8.18.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoia0VPbVZERjNDY3FoWXhOQlRaSTVLMkhaVzY4WmFUWjRoc3JrSFBBSyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMS9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1770046842),
('HgZwV9UkStopflqcNgjCurYhbnT79MvwhTyDgS4e',NULL,'127.0.0.1','curl/8.18.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiMUd2UlBYVVd5cmFNZWJaQm9OampDVzMxZmhSVmNrc0tVV2NjMjFHaiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1770047113),
('JomZagJ9QHaqQiD1n4mMAQF0YjsRBOaaTYXtW1dS',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.108.2 Chrome/142.0.7444.235 Electron/39.2.7 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiRjRBUEVLVjA2QWluYXRZZGpNWWNpMWIyUVRrT25NN3ZhS2h0NHJFRCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTAwOiJodHRwOi8vMTI3LjAuMC4xOjgwMDEvbG9naW4/aWQ9ZGY2YjBmNzMtZWE0NC00MzI5LWFjYmMtZTVmZTYwMmZlMzY4JnZzY29kZUJyb3dzZXJSZXFJZD0xNzcwMDQ0OTk5NzkwIjtzOjU6InJvdXRlIjtzOjU6ImxvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1770044999),
('lsI7FHSxZWAbQsdgSDZyW1YJCJ6lVZ17naWxQyFI',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64; rv:147.0) Gecko/20100101 Firefox/147.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoieGZKdElOMWNRRjdJbE9wdndUV2ZYUWZGaUxycG10TkJMT1RpUFlLRiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMS9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1770046684),
('MLiYjkLOx7F8DhNYVoRKnhoJe3ApAsnXcGw4FFes',NULL,'127.0.0.1','curl/8.18.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiVkt6MndhblJpMEx1eHVhN1FJaVg1TkF3cUF3NjkyOVVnSUNxRTJudCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMS9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1770046244),
('OfGEyJD4RRYAcwXZzEwAqMpF8Y5PzHJsrNH742Nl',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.108.2 Chrome/142.0.7444.235 Electron/39.2.7 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoibkxEZ0xhZG1NYktEcWEycVlrOFJZQ2llMkxGdnh2Mk95SVIwTXJocSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6OTU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMS8/aWQ9OGFmYjQ5ZmYtMWEyNS00OTkyLTg2NDUtYTE2ZTY1MDc1MjcyJnZzY29kZUJyb3dzZXJSZXFJZD0xNzcwMDQ1NTc1OTIwIjtzOjU6InJvdXRlIjtzOjEwOiJiaWVudmVuaWRvIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1770045575),
('SHSbVMt20MAFK4oBl5tADerdWcjLNtkZGqKY8iTY',1,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64; rv:147.0) Gecko/20100101 Firefox/147.0','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiQXNoNVBrNW90VVY1bzMwU2Y2TlRYWVNVQVF0RnI1SWx3UjRPRmlPNiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9maWNoYWplcy9jcmVhdGUiO3M6NToicm91dGUiO3M6MTU6ImZpY2hhamVzLmNyZWF0ZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czo0OiJhdXRoIjthOjE6e3M6MjE6InBhc3N3b3JkX2NvbmZpcm1lZF9hdCI7aToxNzcwMDQ3NDIzO319',1770047563),
('tKqg95MqXIQMA7putiNOeCWhifXNcePpnHjrIVlO',NULL,'127.0.0.1','curl/8.18.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiU2c2WDBKNDl4bVdPWFhobDJtaGVVVzRJY21JazFLTEZ2bmlJODhXWSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1770046844),
('ubHrSOfE1WZQ6FBSc6Z5d8Gf6mYewnH9RB0h2IY6',NULL,'127.0.0.1','curl/8.18.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoibG1tVzdsWHN2c09MMUxweHA4dG9nQTBNcmg1Q3NUMjRrTlY3Y2JlYyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMS9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1770045745),
('Uw1p6QeWiRm6KH98NKbXAXGWYuYENwjygyvyYrz3',NULL,'127.0.0.1','curl/8.18.0','YToyOntzOjY6Il90b2tlbiI7czo0MDoieWVmRzZpb2lxTEhsT0FtZ1RTaU15SERwYjc1aG56VTN5ckZ6cTRVMSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1770046846),
('VAadsrEk78OOdXntQyWvAAzG7oHZsKTQX2Vb5Ezw',NULL,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.108.2 Chrome/142.0.7444.235 Electron/39.2.7 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiZmg2VDF4bnVlMnVPVGxiSVBCVmhWeDRMaGkxRzRZZlVMVWFDSW9DRSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MTAwOiJodHRwOi8vMTI3LjAuMC4xOjgwMDEvbG9naW4/aWQ9NzQ5MzZkNDAtZTcwYy00Njg4LWEyYWItMzY3NDI3ZGRlYmMyJnZzY29kZUJyb3dzZXJSZXFJZD0xNzcwMDQ1NTYxNDkyIjtzOjU6InJvdXRlIjtzOjU6ImxvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1770045561),
('vtNDfvheavvFWKZfADJ54yriZrvqITj2NTNMIKV4',NULL,'127.0.0.1','curl/8.18.0','YTozOntzOjY6Il90b2tlbiI7czo0MDoiQXhNWmxWeDJLeGtvMDFWM0hIRnY4OExzSXA4ZWdidExDUTdHMzRMOSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMS9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1770045804);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `trabajadores`
--

DROP TABLE IF EXISTS `trabajadores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `trabajadores` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `dni` varchar(255) NOT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `puesto` varchar(255) NOT NULL,
  `salario_hora` decimal(8,2) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `trabajadores_dni_unique` (`dni`),
  UNIQUE KEY `trabajadores_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trabajadores`
--

LOCK TABLES `trabajadores` WRITE;
/*!40000 ALTER TABLE `trabajadores` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `trabajadores` VALUES
(1,'Juan','pepe','12312314A','1231231','PEPE@PEPE.COM','FRUTERO',50.00,1,'2026-02-02 00:08:35','2026-02-02 00:29:55',NULL),
(2,'Carla','Ozuna','23396283n','+34 933573636','palomino.vera@example.com','Albañil',22.73,1,'2026-02-02 01:55:32','2026-02-02 14:51:50',NULL),
(3,'Yeray','Pizarro','63462467p','922181447','orta.dario@example.org','Encargado',32.85,1,'2026-02-02 01:55:32','2026-02-02 01:55:32',NULL),
(4,'Raúl','Herrera','11862685q','962 45 1138','vballesteros@example.net','Electricista',20.36,1,'2026-02-02 01:55:32','2026-02-02 01:55:32',NULL),
(5,'Yaiza','Aragón','90864081x','928 37 2551','francisca02@example.net','Encargado',25.30,1,'2026-02-02 01:55:32','2026-02-02 01:55:32',NULL),
(6,'David','Rolón','99314994r','+34 907-670794','francisca.montanez@example.com','Albañil',20.54,1,'2026-02-02 01:55:32','2026-02-02 01:55:32',NULL),
(7,'Ana','Jurado','25989263x','949-02-0912','rodarte.jon@example.org','Albañil',16.68,1,'2026-02-02 01:55:32','2026-02-02 01:55:32',NULL),
(8,'Carolina','Flores','02250132s','+34 982-38-5491','iker48@example.org','Carpintero',14.37,1,'2026-02-02 01:55:32','2026-02-02 01:55:32',NULL),
(9,'Pablo','Ocasio','42844549i','+34 999 95 9365','soriano.nayara@example.org','Carpintero',23.01,1,'2026-02-02 01:55:32','2026-02-02 01:55:32',NULL);
/*!40000 ALTER TABLE `trabajadores` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `users` VALUES
(1,'José Luis Sánchez Gonzáez','luissanchezgonzale95@gmail.com',NULL,'$2y$12$NoUAmiveX4yW3qnmlcf51.ylFwV7fe1iaK53HRF7XlVIbqzklQ27y',NULL,'2026-02-01 19:19:23','2026-02-01 19:19:23'),
(2,'Luis','admin@example.com',NULL,'$2y$12$hN7h1dkgvcCWP6JB3P3Lf.aASaBIQ2tpj7fHrpuWcLjIu32TdfHdK',NULL,'2026-02-01 19:55:23','2026-02-01 19:55:23'),
(3,'Test User','test@example.com','2026-02-02 01:55:32','$2y$12$Q3NPXCuXsiCX1CIdFJxre.y05oKGqqQqgs6GIy7dqY0s9W7m6BSB6','3AHhQPMi5L','2026-02-02 01:55:32','2026-02-02 01:55:32');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
commit;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;

-- Dump completed on 2026-02-02 18:46:55
