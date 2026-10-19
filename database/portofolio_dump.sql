-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: portofolio
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `certificates`
--

DROP TABLE IF EXISTS `certificates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `certificates` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `issuer` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'SERTIFIKASI KOMPETENSI',
  `link` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `certificates`
--

LOCK TABLES `certificates` WRITE;
/*!40000 ALTER TABLE `certificates` DISABLE KEYS */;
INSERT INTO `certificates` VALUES (1,'Junior Data Scientist','Dicoding Indonesia','2026','SERTIFIKASI KOMPETENSI',NULL,'certificates/ZQ1MRCgnnoZm4ztqIo7E2Qac5lj7S5l7ErlvSKzg.png','2026-09-01 20:12:46','2026-09-01 21:10:00'),(3,'Junior Data Scientist','SMK NEGERI 1 BANGSRI','2026','SERTIFIKASI KOMPETENSI',NULL,'certificates/IblGvs7Ag0RE4oVtRi17VNxV6JaSXe7sn582J463.png','2026-09-01 21:11:18','2026-09-01 21:11:18');
/*!40000 ALTER TABLE `certificates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `experiences`
--

DROP TABLE IF EXISTS `experiences`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `experiences` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL DEFAULT 'PENDIDIKAN',
  `title` varchar(255) NOT NULL,
  `organization` varchar(255) DEFAULT NULL,
  `period` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `experiences`
--

LOCK TABLES `experiences` WRITE;
/*!40000 ALTER TABLE `experiences` DISABLE KEYS */;
INSERT INTO `experiences` VALUES (1,'ORGANISASI','Web Developer','Organisasi','2024 – 2026','masih berlangsung sampai sekarang','2026-09-01 20:12:46','2026-09-01 21:06:32'),(2,'PENDIDIKAN','SMK Negeri 1 Bangsri','Pengembangan Perangkat Lunak dan Gim','2024 – Sekarang','Fokus pada Pengembangan Perangkat Lunak, Pemrograman Web (Laravel, PHP, Tailwind CSS), dan Desain UI/UX.','2026-09-01 20:12:46','2026-09-01 21:06:23');
/*!40000 ALTER TABLE `experiences` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2024_10_01_000000_add_is_admin_to_users_table',1),(5,'2026_04_02_131641_create_projects_table',1),(6,'2026_09_02_000001_create_skills_table',2),(7,'2026_09_02_000002_create_experiences_table',2),(8,'2026_09_02_000003_create_certificates_table',2),(9,'2026_09_02_000004_create_messages_table',2),(10,'2026_09_02_000005_add_profile_fields_to_users_table',2),(11,'2026_09_02_000006_add_hero_bio_to_users_table',3),(12,'2026_09_02_000007_make_project_links_nullable',4);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projects` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `github_link` varchar(255) DEFAULT NULL,
  `demo_link` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` VALUES (8,'Website E Commerce Tote Bag Art Terra','Website Penjualan Tote Bag ramah lingkungan','https://github.com/adristynata/art-terra',NULL,'projects/hG68aWVMYewGF3F281sQsL8bXPo5rsTdprieS7hI.png','2026-09-01 21:05:27','2026-09-01 21:05:27'),(9,'Website PAUD Al Hidayah','Website ini berisi tentang informasi PAUD Al Hidayah Wedelan dan dilengkapi Sistem Laporan Perkembangan Anak Bulanan yang dapat dipantau secara real-time','https://github.com/adristynata/WEBSITE-PAUD-AL-HIDAYAH','https://paudalhidayah.sch.id/','projects/n4YqmEBqafXuNqEquKal58nmwVSRJLCbbchPRn6N.png','2026-10-15 08:31:23','2026-10-15 08:59:36');
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `skills`
--

DROP TABLE IF EXISTS `skills`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `skills` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL DEFAULT 'Beginner',
  `percentage` int(11) NOT NULL DEFAULT 70,
  `category` varchar(255) NOT NULL DEFAULT 'Frontend Development',
  `icon` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `skills`
--

LOCK TABLES `skills` WRITE;
/*!40000 ALTER TABLE `skills` DISABLE KEYS */;
INSERT INTO `skills` VALUES (1,'Laravel','Beginner',70,'Backend Development',NULL,'2026-09-01 20:12:46','2026-09-01 20:12:46'),(2,'HTML & CSS','Intermediate',85,'Frontend Development',NULL,'2026-09-01 20:12:46','2026-09-01 20:12:46'),(3,'Tailwind CSS','Beginner',70,'Frontend Development',NULL,'2026-09-01 20:12:46','2026-09-01 20:25:13'),(4,'JavaScript','Beginner',65,'Frontend Development',NULL,'2026-09-01 20:12:46','2026-09-01 20:12:46'),(5,'PHP','Beginner',70,'Backend Development',NULL,'2026-09-01 20:12:46','2026-09-01 20:12:46'),(6,'MySQL','Beginner',75,'Database',NULL,'2026-09-01 20:12:46','2026-09-01 20:12:46');
/*!40000 ALTER TABLE `skills` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_title` varchar(255) DEFAULT 'Web Developer',
  `hero_bio` text DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `education` varchar(255) DEFAULT 'Teknik Informatika / RPL',
  `focus` varchar(255) DEFAULT 'Web & Backend Dev',
  `phone` varchar(255) DEFAULT '+62 89639685566',
  `location` varchar(255) DEFAULT 'Jepara',
  `photo` varchar(255) DEFAULT 'images/foto-saya.jpg',
  `github_url` varchar(255) DEFAULT 'https://github.com',
  `linkedin_url` varchar(255) DEFAULT 'https://linkedin.com',
  `instagram_url` varchar(255) DEFAULT 'https://instagram.com',
  `whatsapp_url` varchar(255) DEFAULT 'https://wa.me/6289639685566',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Adristy Akiko Yukinata','test@example.com','2026-09-01 19:54:05',0,'$2y$12$GkAN6ESEE03Wg0Sgdj4hTeyKSIO1J8sAPb6yk81z4S.ApFghHja22','QX2UQhnFwM','2026-09-01 19:54:05','2026-10-16 07:29:27','Backend Developer',NULL,'Saya adalah seorang Junior Web Developer dan siswi Rekayasa Perangkat Lunak (RPL) di SMK Negeri 1 Bangsri yang memiliki ketertarikan mendalam pada teknologi pengembangan web modern dan desain antarmuka (UI/UX).\r\n\r\nDengan pengalaman menguasai framework Laravel, PHP, Tailwind CSS, dan MySQL, saya terbiasa membangun aplikasi web yang fungsional, responsif, serta berorientasi pada kode yang bersih (clean code).\r\n\r\nSaya percaya bahwa aplikasi perangkat lunak yang hebat tidak hanya dibangun dari struktur kode yang efisien, tetapi juga dari pengalaman pengguna (user experience) yang intuitif dan menyenangkan. Saat ini, saya fokus memperdalam keahlian backend web development dan selalu antusias untuk belajar teknologi baru serta berkolaborasi dalam proyek-proyek inovatif.','Teknik Informatika / RPL','Web & Backend Dev','+62 89639685566','Jepara','storage/profile/adristy_studio.png','https://github.com','https://linkedin.com','https://instagram.com','https://wa.me/6289639685566'),(2,'Adristy Akiko Yukinata','adristyakikoyukinata@gmail.com',NULL,1,'$2y$12$P1GgpsfkI7jccq3Hb3eueOUNI9On0fGCwMTRscLJiBnXDXrD3JsRa','HtYZrhtO9nZIqzp033IgvrnKKXDBXzaOi20nIPSIdTRFJE4F428UG5CvwfFr','2026-09-01 19:54:05','2026-10-16 07:28:50','Backend Developer','Saya adalah Junior Web Developer sekaligus Software Engineering dari SMK Negeri 1 Bangsri yang berfokus pada pengembangan web modern, responsif, dan berperforma tinggi.','Saya Adristy Akiko Yukinata seorang Junior Web Developer dan siswi Rekayasa Perangkat Lunak (RPL) di SMK Negeri 1 Bangsri yang memiliki ketertarikan mendalam pada teknologi pengembangan web modern dan desain antarmuka (UI/UX).\r\n\r\nDengan pengalaman menguasai framework Laravel, PHP, Tailwind CSS, dan MySQL, saya terbiasa membangun aplikasi web yang fungsional, responsif.','Pengembangan Perangkat Lunak dan Gim','Web & Backend Dev','+62 89639685566','Jepara','storage/profile/adristy_studio.png','https://github.com/adristynata','https://www.linkedin.com/in/adristy-akiko-yukinata-207b82373/','https://www.instagram.com/ristynott?igsi=ZThoMGdxc25nc21z','https://wa.me/+6289639685566'),(3,'Adristy Akiko Yukinata','backup_admin@portofolio.com',NULL,1,'$2y$12$WkbCe28eCZhFyCdIzgRx5umPvZRGCGtKVsO4mTzGxD3tqfezocA.q',NULL,'2026-09-02 06:30:04','2026-10-16 07:29:27','Backend Developer','Saya adalah Junior Web Developer sekaligus Software Engineering dari SMK Negeri 1 Bangsri yang berfokus pada pengembangan web modern, responsif, dan berperforma tinggi.',NULL,'Teknik Informatika / RPL','Web & Backend Dev','+62 89639685566','Jepara','storage/profile/adristy_studio.png','https://github.com','https://linkedin.com','https://instagram.com','https://wa.me/6289639685566');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-10-16 22:56:21
