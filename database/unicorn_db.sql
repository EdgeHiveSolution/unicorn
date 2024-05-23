-- MySQL dump 10.13  Distrib 8.0.36, for Linux (x86_64)
--
-- Host: localhost    Database: unicorn
-- ------------------------------------------------------
-- Server version	8.0.36-0ubuntu0.20.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `configurations`
--

DROP TABLE IF EXISTS `configurations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `configurations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configurations`
--

LOCK TABLES `configurations` WRITE;
/*!40000 ALTER TABLE `configurations` DISABLE KEYS */;
/*!40000 ALTER TABLE `configurations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `countries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `countries`
--

LOCK TABLES `countries` WRITE;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` VALUES (1,'Kenya','KE','2024-01-25 10:29:42','2024-01-25 10:29:42',NULL),(2,'United States','US','2024-01-25 10:29:42','2024-01-25 10:29:42',NULL),(3,'United Kingdom','UK','2024-01-25 10:29:42','2024-01-25 10:29:42',NULL),(4,'India','IN','2024-01-25 10:29:42','2024-01-25 10:29:42',NULL),(5,'Canada','CA','2024-01-25 10:29:42','2024-01-25 10:29:42',NULL);
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `department_member`
--

DROP TABLE IF EXISTS `department_member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `department_member` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `department_id` bigint unsigned DEFAULT NULL,
  `member_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `department_member_department_id_foreign` (`department_id`),
  KEY `department_member_member_id_foreign` (`member_id`),
  CONSTRAINT `department_member_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL,
  CONSTRAINT `department_member_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `department_member`
--

LOCK TABLES `department_member` WRITE;
/*!40000 ALTER TABLE `department_member` DISABLE KEYS */;
INSERT INTO `department_member` VALUES (1,1,1,'2024-01-25 13:28:36','2024-01-25 13:28:36',NULL),(2,1,2,'2024-02-16 11:30:31','2024-02-16 11:30:31',NULL),(3,2,3,'2024-02-16 11:32:14','2024-02-16 11:32:14',NULL);
/*!40000 ALTER TABLE `department_member` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `department_partner`
--

DROP TABLE IF EXISTS `department_partner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `department_partner` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `department_id` bigint unsigned DEFAULT NULL,
  `partner_id` bigint unsigned DEFAULT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `department_partner_department_id_foreign` (`department_id`),
  KEY `department_partner_partner_id_foreign` (`partner_id`),
  CONSTRAINT `department_partner_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL,
  CONSTRAINT `department_partner_partner_id_foreign` FOREIGN KEY (`partner_id`) REFERENCES `partners` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `department_partner`
--

LOCK TABLES `department_partner` WRITE;
/*!40000 ALTER TABLE `department_partner` DISABLE KEYS */;
INSERT INTO `department_partner` VALUES (1,1,1,'leader','2024-01-25 13:46:28','2024-01-25 13:46:28'),(2,1,2,NULL,'2024-02-15 14:19:36','2024-02-15 14:19:36'),(3,1,3,NULL,'2024-02-16 11:27:03','2024-02-16 11:27:03'),(4,2,3,NULL,'2024-02-16 11:29:04','2024-02-16 11:29:04');
/*!40000 ALTER TABLE `department_partner` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `departments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `about` longtext COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `departments_name_unique` (`name`),
  UNIQUE KEY `departments_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departments`
--

LOCK TABLES `departments` WRITE;
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;
INSERT INTO `departments` VALUES (1,'Production','production@gmail.com','Advertising',1,'2024-01-25 13:26:21','2024-01-25 13:26:21',NULL),(2,'Sales','sales@sales.com','Sales Department',1,'2024-02-16 11:28:25','2024-02-16 11:28:25',NULL),(3,'Marketing','marketing@marketing.com','Marketing Team',1,'2024-02-16 13:57:08','2024-02-16 13:57:08',NULL);
/*!40000 ALTER TABLE `departments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
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
-- Table structure for table `kpi_member`
--

DROP TABLE IF EXISTS `kpi_member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kpi_member` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kpi_id` bigint unsigned DEFAULT NULL,
  `member_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kpi_member_kpi_id_foreign` (`kpi_id`),
  KEY `kpi_member_member_id_foreign` (`member_id`),
  CONSTRAINT `kpi_member_kpi_id_foreign` FOREIGN KEY (`kpi_id`) REFERENCES `kpis` (`id`) ON DELETE SET NULL,
  CONSTRAINT `kpi_member_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kpi_member`
--

LOCK TABLES `kpi_member` WRITE;
/*!40000 ALTER TABLE `kpi_member` DISABLE KEYS */;
INSERT INTO `kpi_member` VALUES (1,1,1,'2024-01-25 13:50:55','2024-01-25 13:50:55'),(2,2,1,'2024-02-16 11:40:04','2024-02-16 11:40:04'),(3,2,2,'2024-02-16 11:40:04','2024-02-16 11:40:04'),(4,2,3,'2024-02-16 11:40:04','2024-02-16 11:40:04'),(5,3,1,'2024-02-19 14:57:56','2024-02-19 14:57:56'),(6,3,2,'2024-02-19 14:57:56','2024-02-19 14:57:56'),(7,3,3,'2024-02-19 14:57:56','2024-02-19 14:57:56'),(8,4,1,'2024-02-19 15:25:24','2024-02-19 15:25:24'),(9,4,2,'2024-02-19 15:25:24','2024-02-19 15:25:24'),(10,4,3,'2024-02-19 15:25:24','2024-02-19 15:25:24');
/*!40000 ALTER TABLE `kpi_member` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kpi_metric_members`
--

DROP TABLE IF EXISTS `kpi_metric_members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kpi_metric_members` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kpi_metric_id` bigint unsigned DEFAULT NULL,
  `member_id` bigint unsigned DEFAULT NULL,
  `target` double NOT NULL,
  `timely_value` double(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kpi_metric_members_kpi_metric_id_foreign` (`kpi_metric_id`),
  KEY `kpi_metric_members_member_id_foreign` (`member_id`),
  CONSTRAINT `kpi_metric_members_kpi_metric_id_foreign` FOREIGN KEY (`kpi_metric_id`) REFERENCES `kpi_metrics` (`id`) ON DELETE SET NULL,
  CONSTRAINT `kpi_metric_members_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kpi_metric_members`
--

LOCK TABLES `kpi_metric_members` WRITE;
/*!40000 ALTER TABLE `kpi_metric_members` DISABLE KEYS */;
INSERT INTO `kpi_metric_members` VALUES (1,1,1,200000,22222.22,'2024-01-25 13:51:42','2024-01-25 13:51:42',NULL),(2,3,3,200000,15384.62,'2024-02-16 11:41:38','2024-02-16 11:41:38',NULL),(3,3,2,300000,23076.92,'2024-02-16 11:41:38','2024-02-16 11:41:38',NULL),(4,4,2,10,2.50,'2024-02-19 15:28:51','2024-02-19 15:28:51',NULL),(5,4,3,10,2.50,'2024-02-19 15:28:51','2024-02-19 15:28:51',NULL);
/*!40000 ALTER TABLE `kpi_metric_members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kpi_metrics`
--

DROP TABLE IF EXISTS `kpi_metrics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kpi_metrics` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `metric_id` bigint unsigned DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `response_period` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kpi_id` bigint unsigned NOT NULL,
  `timely_value` double(10,2) DEFAULT NULL,
  `on_track_value` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `off_track_min` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `off_track_max` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `at_risk_min` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `at_risk_max` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kpi_metrics_kpi_id_foreign` (`kpi_id`),
  KEY `kpi_metrics_metric_id_foreign` (`metric_id`),
  CONSTRAINT `kpi_metrics_kpi_id_foreign` FOREIGN KEY (`kpi_id`) REFERENCES `kpis` (`id`) ON DELETE CASCADE,
  CONSTRAINT `kpi_metrics_metric_id_foreign` FOREIGN KEY (`metric_id`) REFERENCES `metrics` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kpi_metrics`
--

LOCK TABLES `kpi_metrics` WRITE;
/*!40000 ALTER TABLE `kpi_metrics` DISABLE KEYS */;
INSERT INTO `kpi_metrics` VALUES (1,1,'Phone Sales','sales count','200000','weekly',1,22222.22,'80','0','39','40','79','2024-01-25 13:51:42','2024-01-25 13:51:42',NULL),(2,1,'Hardware Sales','sales count','0','weekly',2,0.00,'70','0','30','40','60','2024-02-16 11:40:54','2024-02-16 11:40:54',NULL),(3,1,'Phone New Sales','sales count','500000','weekly',2,38461.54,'70','0','30','40','60','2024-02-16 11:41:38','2024-02-16 11:41:38',NULL),(4,1,'Patents','sales count','20','weekly',4,5.00,'70','0','30','40','60','2024-02-19 15:28:51','2024-02-19 15:28:51',NULL);
/*!40000 ALTER TABLE `kpi_metrics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kpi_owners`
--

DROP TABLE IF EXISTS `kpi_owners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kpi_owners` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kpi_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kpi_owners_kpi_id_foreign` (`kpi_id`),
  CONSTRAINT `kpi_owners_kpi_id_foreign` FOREIGN KEY (`kpi_id`) REFERENCES `kpis` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kpi_owners`
--

LOCK TABLES `kpi_owners` WRITE;
/*!40000 ALTER TABLE `kpi_owners` DISABLE KEYS */;
/*!40000 ALTER TABLE `kpi_owners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kpis`
--

DROP TABLE IF EXISTS `kpis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kpis` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kpiOwner_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `partner_id` bigint unsigned NOT NULL,
  `review_period_range` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kpis_partner_id_foreign` (`partner_id`),
  CONSTRAINT `kpis_partner_id_foreign` FOREIGN KEY (`partner_id`) REFERENCES `partners` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kpis`
--

LOCK TABLES `kpis` WRITE;
/*!40000 ALTER TABLE `kpis` DISABLE KEYS */;
INSERT INTO `kpis` VALUES (1,'Hardware Sales','1',1,'30th January 2024 to 30th March 2024','2024-01-25 13:50:55','2024-01-25 13:50:55',NULL),(2,'Sales above 500000','3',3,'16th February 2024 to 16th May 2024','2024-02-16 11:40:04','2024-02-16 11:40:04',NULL),(3,'Production','2',3,'1st March 2024 to 1st December 2024','2024-02-19 14:57:56','2024-02-19 14:57:56',NULL),(4,'Innovation','2',3,'29th February 2024 to 30th March 2024','2024-02-19 15:25:24','2024-02-19 15:25:24',NULL);
/*!40000 ALTER TABLE `kpis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `member_partner`
--

DROP TABLE IF EXISTS `member_partner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `member_partner` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `department_id` bigint unsigned DEFAULT NULL,
  `member_id` bigint unsigned NOT NULL,
  `partner_id` bigint unsigned NOT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kpi_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `member_partner_department_id_foreign` (`department_id`),
  KEY `member_partner_member_id_foreign` (`member_id`),
  KEY `member_partner_partner_id_foreign` (`partner_id`),
  KEY `member_partner_kpi_id_foreign` (`kpi_id`),
  CONSTRAINT `member_partner_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`),
  CONSTRAINT `member_partner_kpi_id_foreign` FOREIGN KEY (`kpi_id`) REFERENCES `kpis` (`id`),
  CONSTRAINT `member_partner_member_id_foreign` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`),
  CONSTRAINT `member_partner_partner_id_foreign` FOREIGN KEY (`partner_id`) REFERENCES `partners` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `member_partner`
--

LOCK TABLES `member_partner` WRITE;
/*!40000 ALTER TABLE `member_partner` DISABLE KEYS */;
INSERT INTO `member_partner` VALUES (1,NULL,1,1,'leader',NULL,'2024-01-25 13:46:29','2024-01-25 13:46:29',NULL),(2,NULL,2,3,NULL,NULL,'2024-02-16 11:30:31','2024-02-16 11:30:31',NULL),(3,NULL,3,3,NULL,NULL,'2024-02-16 11:32:14','2024-02-16 11:32:14',NULL);
/*!40000 ALTER TABLE `member_partner` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `members` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `user_role_id` bigint unsigned DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `members_user_id_foreign` (`user_id`),
  KEY `members_user_role_id_foreign` (`user_role_id`),
  CONSTRAINT `members_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `members_user_role_id_foreign` FOREIGN KEY (`user_role_id`) REFERENCES `user_roles` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `members`
--

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
INSERT INTO `members` VALUES (1,'Felix Owino','felixowino868@gmail.com',NULL,NULL,NULL,3,NULL,1,'2024-01-25 13:28:36','2024-01-25 13:28:36',NULL),(2,'Daniel Kamau','edungugi20@gmail.com',NULL,NULL,NULL,7,NULL,1,'2024-02-16 11:30:31','2024-02-16 11:30:31',NULL),(3,'Samuel Karanja','edungugi10@gmail.com',NULL,NULL,NULL,8,NULL,1,'2024-02-16 11:32:14','2024-02-16 11:32:14',NULL);
/*!40000 ALTER TABLE `members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `metrics`
--

DROP TABLE IF EXISTS `metrics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `metrics` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `metrics_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `metrics`
--

LOCK TABLES `metrics` WRITE;
/*!40000 ALTER TABLE `metrics` DISABLE KEYS */;
INSERT INTO `metrics` VALUES (1,'sales count','Currency','2024-01-25 13:50:11','2024-01-25 13:50:11',NULL);
/*!40000 ALTER TABLE `metrics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2013_10_12_084800_create_user_roles_table',1),(2,'2014_10_12_000000_create_users_table',1),(3,'2014_10_12_100000_create_password_reset_tokens_table',1),(4,'2014_10_12_100000_create_password_resets_table',1),(5,'2019_08_19_000000_create_failed_jobs_table',1),(6,'2019_12_14_000001_create_personal_access_tokens_table',1),(7,'2023_06_10_180939_create_types_table',1),(8,'2023_06_10_182020_create_countries_table',1),(9,'2023_06_11_140251_create_partners_table',1),(10,'2023_06_11_144532_create_departments_table',1),(11,'2023_06_13_165723_create_members_table',1),(12,'2023_06_13_175714_create_configurations_table',1),(13,'2023_06_17_072528_create_metrics_table',1),(14,'2023_07_09_171749_create_trackings_table',1),(15,'2023_07_10_174044_create_kpis_table',1),(16,'2023_07_10_174058_create_kpi_metrics_table',1),(17,'2023_07_11_063143_create_department_partner_table',1),(18,'2023_07_11_063237_create_department_member_table',1),(19,'2023_07_11_063357_create_member_partner_table',1),(20,'2023_07_23_045618_create_kpi_owners_table',1),(21,'2023_07_24_184741_create_units_table',1),(22,'2023_07_28_121812_create_kpi_metric_members_table',1),(23,'2023_08_01_111812_create_progress_table',1),(24,'2023_09_05_082642_create_kpi_member_table',1),(25,'2023_09_25_115142_create_progress_files_table',1),(26,'2023_09_26_083658_create_progress_chat_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `partners`
--

DROP TABLE IF EXISTS `partners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `partners` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `website` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_id` bigint unsigned NOT NULL,
  `business_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `documents` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `user_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `partners_phone_unique` (`phone`),
  UNIQUE KEY `partners_email_unique` (`email`),
  KEY `partners_country_id_foreign` (`country_id`),
  KEY `partners_user_id_foreign` (`user_id`),
  CONSTRAINT `partners_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`),
  CONSTRAINT `partners_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `partners`
--

LOCK TABLES `partners` WRITE;
/*!40000 ALTER TABLE `partners` DISABLE KEYS */;
INSERT INTO `partners` VALUES (1,'ReelAnalalytics Limited','74639','+254717960820','alicx00@gmail.com','reelanalytics@gmail.com','https://tactiv.techtribeinnovations.com/uploads/partners/logos/reelanalalytics limited-logo1706190387.png',1,'Software','Software only','undefined','$2y$10$oFUTH5UZ2IbSdb63NfPRVedOVl4bWVoaCmo29Np9lbWOPszepq9v2',1,4,'2024-01-25 13:46:27','2024-01-25 13:46:27',NULL),(2,'Rahul Test','Address One','0753000888','rahul@clifford.co.ke','www.addsdsd.com',NULL,1,'Technology','ddddd','undefined','$2y$10$vVGHWz4kRwoC8fHS1GA7fe0y/YyTLGIXkuyNedGk8RKG6ZKQ6BKlW',1,5,'2024-02-15 14:16:26','2024-02-15 14:19:36',NULL),(3,'ABC Solutions','5th Floor Hazina Towers','0701293484','edgehivesol@gmail.com',NULL,NULL,1,'IT','IT Solutions & Services','undefined','$2y$10$mQ8gJIMasNuNc5TyyTbO3u7W6RPS8uo8SEuAgnVzonGg/mm6gudtu',1,6,'2024-02-16 11:24:47','2024-02-16 11:27:03',NULL);
/*!40000 ALTER TABLE `partners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `progress`
--

DROP TABLE IF EXISTS `progress`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `progress` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kpi_metric_member_id` bigint unsigned DEFAULT NULL,
  `kpi_metric_id` bigint unsigned DEFAULT NULL,
  `kpi_id` bigint unsigned DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `current_value` double NOT NULL,
  `target_value` double(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `progress_kpi_metric_member_id_foreign` (`kpi_metric_member_id`),
  KEY `progress_kpi_metric_id_foreign` (`kpi_metric_id`),
  KEY `progress_kpi_id_foreign` (`kpi_id`),
  CONSTRAINT `progress_kpi_id_foreign` FOREIGN KEY (`kpi_id`) REFERENCES `kpis` (`id`) ON DELETE SET NULL,
  CONSTRAINT `progress_kpi_metric_id_foreign` FOREIGN KEY (`kpi_metric_id`) REFERENCES `kpi_metrics` (`id`) ON DELETE SET NULL,
  CONSTRAINT `progress_kpi_metric_member_id_foreign` FOREIGN KEY (`kpi_metric_member_id`) REFERENCES `kpi_metric_members` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `progress`
--

LOCK TABLES `progress` WRITE;
/*!40000 ALTER TABLE `progress` DISABLE KEYS */;
INSERT INTO `progress` VALUES (1,1,1,NULL,'First Update','Hi , this is my first update',4000,22222.22,'2024-01-25 13:53:38','2024-01-25 13:53:38'),(2,3,3,NULL,'New Progress','Test',10000,23076.92,'2024-02-16 12:27:36','2024-02-16 12:27:36'),(3,3,3,NULL,'Safaricom Sale','Ywa',20000,23076.92,'2024-02-19 15:45:09','2024-02-19 15:45:09');
/*!40000 ALTER TABLE `progress` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `progress_chat`
--

DROP TABLE IF EXISTS `progress_chat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `progress_chat` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `progress_id` bigint unsigned NOT NULL,
  `sender_id` bigint unsigned NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `progress_chat_progress_id_foreign` (`progress_id`),
  KEY `progress_chat_sender_id_foreign` (`sender_id`),
  CONSTRAINT `progress_chat_progress_id_foreign` FOREIGN KEY (`progress_id`) REFERENCES `progress` (`id`) ON DELETE CASCADE,
  CONSTRAINT `progress_chat_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `progress_chat`
--

LOCK TABLES `progress_chat` WRITE;
/*!40000 ALTER TABLE `progress_chat` DISABLE KEYS */;
INSERT INTO `progress_chat` VALUES (1,2,7,'Test','2024-02-16 12:27:58','2024-02-16 12:27:58');
/*!40000 ALTER TABLE `progress_chat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `progress_files`
--

DROP TABLE IF EXISTS `progress_files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `progress_files` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `progress_id` bigint unsigned NOT NULL,
  `file_paths` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `progress_files_progress_id_foreign` (`progress_id`),
  CONSTRAINT `progress_files_progress_id_foreign` FOREIGN KEY (`progress_id`) REFERENCES `progress` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `progress_files`
--

LOCK TABLES `progress_files` WRITE;
/*!40000 ALTER TABLE `progress_files` DISABLE KEYS */;
INSERT INTO `progress_files` VALUES (1,1,'[\"ProgressUploads\\/Capture1.PNG\"]','2024-01-25 13:53:38','2024-01-25 13:53:38');
/*!40000 ALTER TABLE `progress_files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trackings`
--

DROP TABLE IF EXISTS `trackings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trackings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trackings`
--

LOCK TABLES `trackings` WRITE;
/*!40000 ALTER TABLE `trackings` DISABLE KEYS */;
/*!40000 ALTER TABLE `trackings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `types`
--

DROP TABLE IF EXISTS `types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `types`
--

LOCK TABLES `types` WRITE;
/*!40000 ALTER TABLE `types` DISABLE KEYS */;
/*!40000 ALTER TABLE `types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `units`
--

DROP TABLE IF EXISTS `units`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `units` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `metric_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `units_metric_id_foreign` (`metric_id`),
  CONSTRAINT `units_metric_id_foreign` FOREIGN KEY (`metric_id`) REFERENCES `metrics` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `units`
--

LOCK TABLES `units` WRITE;
/*!40000 ALTER TABLE `units` DISABLE KEYS */;
INSERT INTO `units` VALUES (1,'Currency','integer',NULL,'2024-01-25 13:49:51','2024-01-25 13:49:51'),(2,'Count','integer',NULL,'2024-02-15 20:27:16','2024-02-15 20:27:16');
/*!40000 ALTER TABLE `units` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_roles`
--

DROP TABLE IF EXISTS `user_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_roles`
--

LOCK TABLES `user_roles` WRITE;
/*!40000 ALTER TABLE `user_roles` DISABLE KEYS */;
INSERT INTO `user_roles` VALUES (1,'admin','2024-01-25 10:29:42','2024-01-25 10:29:42'),(2,'Member','2024-01-25 10:29:42','2024-01-25 10:29:42'),(3,'Partner','2024-01-25 10:29:42','2024-01-25 10:29:42'),(4,'Member_partner','2024-01-25 10:29:42','2024-01-25 10:29:42');
/*!40000 ALTER TABLE `user_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_role_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_user_role_id_foreign` (`user_role_id`),
  CONSTRAINT `users_user_role_id_foreign` FOREIGN KEY (`user_role_id`) REFERENCES `user_roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'John Doe','partner@gmail.com',NULL,NULL,'$2y$10$P/cIW2rtw6GflPqQgeycpu9KMeQFQ7A5bVUI5lx93O5bOQPXjgMUO',1,NULL,3,'2024-01-25 10:29:42','2024-01-25 10:29:42',NULL),(2,'Admin','admin@gmail.com',NULL,NULL,'$2y$10$tCjfCrvejec5bHpJUJeVjuZxFJQPH/mtvCMl4qdUIqGjojT3wnSW2',1,NULL,1,'2024-01-25 10:29:42','2024-01-25 10:29:42',NULL),(3,'Felix Owino','felixowino868@gmail.com',NULL,NULL,'$2y$10$P1CAt2pizZ6M6L/kiUT4Pu8GpDEuTgkHwVCMwTWWQocxsilf0Gth.',1,NULL,2,'2024-01-25 13:28:36','2024-01-25 13:28:36',NULL),(4,'ReelAnalalytics Limited','alicx00@gmail.com',NULL,NULL,'$2y$10$lmC9Wzvw665gJw/bRMAwz.Q97uxp/W/p1XKLgJ58m/UCtHC12mtei',1,NULL,3,'2024-01-25 13:46:27','2024-01-25 13:46:27',NULL),(5,'Rahul Test','rahul@clifford.co.ke',NULL,NULL,'$2y$10$Wa80SyAFlpKHojAnyLt0P.LziBpiYuYwkzRK7mVKRABrLXaouTjWu',1,NULL,3,'2024-02-15 14:16:26','2024-02-15 14:16:26',NULL),(6,'ABC Solutions','edgehivesol@gmail.com',NULL,NULL,'$2y$10$XDJ3TDUWHKDl1po4PCEcGeumYcBy56EWGL8w9undP4ySjKyehxnQq',1,NULL,3,'2024-02-16 11:24:47','2024-02-16 11:39:12',NULL),(7,'Daniel Kamau','edungugi20@gmail.com',NULL,NULL,'$2y$10$UTscitIayyjnLNWZk3nC..aD28QMjpL2.VE1tmaPYN4mZoPOD3uDu',1,NULL,2,'2024-02-16 11:30:31','2024-02-16 11:30:31',NULL),(8,'Samuel Karanja','edungugi10@gmail.com',NULL,NULL,'$2y$10$Xs.WeZKUa9U4tMzxH0zxmereWcNX5gQtQ/v0pSUlIM3pxaJn.0sU2',1,NULL,2,'2024-02-16 11:32:14','2024-02-16 11:32:14',NULL);
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

-- Dump completed on 2024-05-23 14:59:44
