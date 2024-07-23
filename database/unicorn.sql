-- MySQL dump 10.13  Distrib 8.0.37, for Linux (x86_64)
--
-- Host: localhost    Database: unicorn
-- ------------------------------------------------------
-- Server version	8.0.37-0ubuntu0.20.04.3

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
INSERT INTO `countries` VALUES (1,'Kenya','KE','2024-06-14 09:22:17','2024-06-14 09:22:17',NULL),(2,'United States','US','2024-06-14 09:22:17','2024-06-14 09:22:17',NULL),(3,'United Kingdom','UK','2024-06-14 09:22:17','2024-06-14 09:22:17',NULL),(4,'India','IN','2024-06-14 09:22:17','2024-06-14 09:22:17',NULL),(5,'Canada','CA','2024-06-14 09:22:17','2024-06-14 09:22:17',NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `department_member`
--

LOCK TABLES `department_member` WRITE;
/*!40000 ALTER TABLE `department_member` DISABLE KEYS */;
INSERT INTO `department_member` VALUES (1,5,1,'2024-06-14 16:34:37','2024-06-14 16:34:37',NULL),(2,6,2,'2024-06-17 13:45:00','2024-06-17 13:45:00',NULL),(3,5,3,'2024-06-18 08:39:46','2024-06-18 08:39:46',NULL),(4,6,4,'2024-06-18 18:06:25','2024-06-18 18:06:25',NULL),(5,1,5,'2024-06-18 18:44:30','2024-06-18 18:44:30',NULL),(6,5,6,'2024-06-18 19:08:01','2024-06-18 19:08:01',NULL),(7,5,7,'2024-06-18 20:23:10','2024-06-18 20:23:10',NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `department_partner`
--

LOCK TABLES `department_partner` WRITE;
/*!40000 ALTER TABLE `department_partner` DISABLE KEYS */;
INSERT INTO `department_partner` VALUES (1,5,NULL,NULL,'2024-06-14 10:04:38','2024-06-14 10:04:38'),(2,5,NULL,NULL,'2024-06-14 10:04:40','2024-06-14 10:04:40'),(3,5,NULL,NULL,'2024-06-14 10:09:11','2024-06-14 10:09:11'),(4,5,NULL,NULL,'2024-06-14 10:13:29','2024-06-14 10:13:29'),(5,5,NULL,NULL,'2024-06-14 10:13:31','2024-06-14 10:13:31'),(6,1,NULL,NULL,'2024-06-14 10:27:42','2024-06-14 10:27:42'),(7,1,2,NULL,'2024-06-14 16:16:18','2024-06-14 16:16:18'),(8,5,NULL,NULL,'2024-06-14 16:17:15','2024-06-14 16:17:15'),(9,4,2,NULL,'2024-06-14 16:20:59','2024-06-14 16:20:59'),(10,5,2,NULL,'2024-06-14 16:26:38','2024-06-14 16:26:38'),(11,5,NULL,NULL,'2024-06-14 18:41:45','2024-06-14 18:41:45'),(12,5,NULL,NULL,'2024-06-14 18:45:19','2024-06-14 18:45:19'),(13,5,NULL,NULL,'2024-06-14 18:45:21','2024-06-14 18:45:21'),(14,4,2,NULL,'2024-06-14 18:50:14','2024-06-14 18:50:14'),(15,6,1,NULL,'2024-06-17 13:40:37','2024-06-17 13:40:37'),(16,5,NULL,NULL,'2024-06-18 07:48:22','2024-06-18 07:48:22'),(17,5,NULL,NULL,'2024-06-18 07:48:25','2024-06-18 07:48:25'),(18,6,5,NULL,'2024-06-18 13:21:07','2024-06-18 13:21:07'),(19,6,5,NULL,'2024-06-18 13:21:09','2024-06-18 13:21:09'),(20,5,1,NULL,'2024-06-18 18:36:52','2024-06-18 18:36:52'),(21,1,1,NULL,'2024-06-18 18:36:54','2024-06-18 18:36:54'),(22,3,1,NULL,'2024-06-18 18:36:55','2024-06-18 18:36:55'),(23,5,1,NULL,'2024-06-18 18:36:56','2024-06-18 18:36:56');
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departments`
--

LOCK TABLES `departments` WRITE;
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;
INSERT INTO `departments` VALUES (1,'Operations','operations@unicn.africa','Operations Team',1,'2024-06-14 09:58:29','2024-06-14 09:58:29',NULL),(2,'Sales','sales@unicn.africa','Sales Team',1,'2024-06-14 09:58:54','2024-06-14 09:58:54',NULL),(3,'Finance','finance@unicn.africa','Finance Team',1,'2024-06-14 09:59:30','2024-06-14 09:59:30',NULL),(4,'Production','production@unicn.africa','Production Team',1,'2024-06-14 09:59:56','2024-06-14 09:59:56',NULL),(5,'Consulting','consulting@unicn.africa','Consulting Team',1,'2024-06-14 10:03:02','2024-06-14 10:03:02',NULL),(6,'Design','design@unicn.africa','Design Team',1,'2024-06-17 13:39:19','2024-06-17 13:39:19',NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kpi_member`
--

LOCK TABLES `kpi_member` WRITE;
/*!40000 ALTER TABLE `kpi_member` DISABLE KEYS */;
INSERT INTO `kpi_member` VALUES (1,1,1,'2024-06-17 13:50:11','2024-06-17 13:50:11'),(2,1,2,'2024-06-17 13:50:11','2024-06-17 13:50:11'),(3,2,1,'2024-06-17 13:53:51','2024-06-17 13:53:51'),(4,2,2,'2024-06-17 13:53:51','2024-06-17 13:53:51'),(5,3,1,'2024-06-17 13:57:31','2024-06-17 13:57:31'),(6,3,2,'2024-06-17 13:57:31','2024-06-17 13:57:31'),(7,4,1,'2024-06-17 14:00:44','2024-06-17 14:00:44'),(8,4,2,'2024-06-17 14:00:44','2024-06-17 14:00:44'),(9,5,1,'2024-06-19 10:49:04','2024-06-19 10:49:04'),(10,5,2,'2024-06-19 10:49:04','2024-06-19 10:49:04'),(11,5,3,'2024-06-19 10:49:04','2024-06-19 10:49:04'),(12,5,4,'2024-06-19 10:49:04','2024-06-19 10:49:04'),(13,5,5,'2024-06-19 10:49:04','2024-06-19 10:49:04'),(14,5,6,'2024-06-19 10:49:04','2024-06-19 10:49:04'),(15,5,7,'2024-06-19 10:49:04','2024-06-19 10:49:04'),(16,6,1,'2024-06-19 10:50:17','2024-06-19 10:50:17'),(17,6,2,'2024-06-19 10:50:17','2024-06-19 10:50:17'),(18,6,3,'2024-06-19 10:50:17','2024-06-19 10:50:17'),(19,6,4,'2024-06-19 10:50:17','2024-06-19 10:50:17'),(20,6,5,'2024-06-19 10:50:17','2024-06-19 10:50:17'),(21,6,6,'2024-06-19 10:50:17','2024-06-19 10:50:17'),(22,6,7,'2024-06-19 10:50:17','2024-06-19 10:50:17'),(23,7,1,'2024-06-19 11:02:00','2024-06-19 11:02:00'),(24,7,2,'2024-06-19 11:02:00','2024-06-19 11:02:00'),(25,7,3,'2024-06-19 11:02:00','2024-06-19 11:02:00'),(26,7,4,'2024-06-19 11:02:00','2024-06-19 11:02:00'),(27,7,5,'2024-06-19 11:02:00','2024-06-19 11:02:00'),(28,7,6,'2024-06-19 11:02:00','2024-06-19 11:02:00'),(29,7,7,'2024-06-19 11:02:00','2024-06-19 11:02:00'),(30,8,1,'2024-06-19 11:02:27','2024-06-19 11:02:27'),(31,8,2,'2024-06-19 11:02:27','2024-06-19 11:02:27'),(32,8,3,'2024-06-19 11:02:27','2024-06-19 11:02:27'),(33,8,4,'2024-06-19 11:02:27','2024-06-19 11:02:27'),(34,8,5,'2024-06-19 11:02:27','2024-06-19 11:02:27'),(35,8,6,'2024-06-19 11:02:27','2024-06-19 11:02:27'),(36,8,7,'2024-06-19 11:02:27','2024-06-19 11:02:27'),(37,9,1,'2024-06-25 07:59:40','2024-06-25 07:59:40'),(38,9,2,'2024-06-25 07:59:40','2024-06-25 07:59:40'),(39,9,3,'2024-06-25 07:59:40','2024-06-25 07:59:40'),(40,9,4,'2024-06-25 07:59:40','2024-06-25 07:59:40'),(41,9,5,'2024-06-25 07:59:40','2024-06-25 07:59:40'),(42,9,6,'2024-06-25 07:59:40','2024-06-25 07:59:40'),(43,9,7,'2024-06-25 07:59:40','2024-06-25 07:59:40'),(44,10,1,'2024-06-25 08:47:07','2024-06-25 08:47:07'),(45,10,2,'2024-06-25 08:47:07','2024-06-25 08:47:07'),(46,10,3,'2024-06-25 08:47:07','2024-06-25 08:47:07'),(47,10,4,'2024-06-25 08:47:07','2024-06-25 08:47:07'),(48,10,5,'2024-06-25 08:47:07','2024-06-25 08:47:07'),(49,10,6,'2024-06-25 08:47:07','2024-06-25 08:47:07'),(50,10,7,'2024-06-25 08:47:07','2024-06-25 08:47:07'),(51,11,1,'2024-06-25 08:59:29','2024-06-25 08:59:29'),(52,11,2,'2024-06-25 08:59:29','2024-06-25 08:59:29'),(53,11,3,'2024-06-25 08:59:29','2024-06-25 08:59:29'),(54,11,4,'2024-06-25 08:59:29','2024-06-25 08:59:29'),(55,11,5,'2024-06-25 08:59:29','2024-06-25 08:59:29'),(56,11,6,'2024-06-25 08:59:29','2024-06-25 08:59:29'),(57,11,7,'2024-06-25 08:59:29','2024-06-25 08:59:29'),(58,12,1,'2024-06-25 09:13:33','2024-06-25 09:13:33'),(59,12,2,'2024-06-25 09:13:33','2024-06-25 09:13:33'),(60,12,3,'2024-06-25 09:13:33','2024-06-25 09:13:33'),(61,12,4,'2024-06-25 09:13:33','2024-06-25 09:13:33'),(62,12,5,'2024-06-25 09:13:33','2024-06-25 09:13:33'),(63,12,6,'2024-06-25 09:13:33','2024-06-25 09:13:33'),(64,12,7,'2024-06-25 09:13:33','2024-06-25 09:13:33');
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
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kpi_metric_members`
--

LOCK TABLES `kpi_metric_members` WRITE;
/*!40000 ALTER TABLE `kpi_metric_members` DISABLE KEYS */;
INSERT INTO `kpi_metric_members` VALUES (1,1,2,1000000,35714.29,'2024-06-17 13:52:50','2024-06-17 13:52:50',NULL),(2,2,2,3000,428.57,'2024-06-17 13:56:37','2024-06-17 13:56:37',NULL),(3,4,2,1200000,171428.57,'2024-06-17 14:03:51','2024-06-17 14:03:51',NULL),(4,5,2,110,3.93,'2024-06-17 14:22:15','2024-06-17 14:22:15',NULL),(5,6,2,1200000,171428.57,'2024-06-17 14:40:50','2024-06-17 14:40:50',NULL),(6,7,2,7000,1000.00,'2024-06-17 14:44:20','2024-06-17 14:44:20',NULL),(7,8,2,300,10.71,'2024-06-17 14:47:20','2024-06-17 14:47:20',NULL),(8,9,2,7,1.00,'2024-06-17 14:50:13','2024-06-17 14:50:13',NULL),(9,10,2,100,14.29,'2024-06-17 14:55:16','2024-06-17 14:55:16',NULL),(10,11,5,8000000,1142857.14,'2024-06-18 18:53:15','2024-06-18 18:53:15',NULL),(11,12,5,12000000,1714285.71,'2024-06-18 18:54:42','2024-06-18 18:54:42',NULL),(12,13,5,6000000,3000000.00,'2024-06-18 18:58:20','2024-06-18 18:58:20',NULL),(13,14,5,100,3.57,'2024-06-18 19:03:42','2024-06-18 19:03:42',NULL),(14,15,6,100,3.57,'2024-06-19 04:46:48','2024-06-19 04:46:48',NULL),(15,16,7,100,3.57,'2024-06-19 04:47:49','2024-06-19 04:47:49',NULL),(16,17,6,2400000,342857.14,'2024-06-19 04:55:49','2024-06-19 04:55:49',NULL),(17,19,1,28,1.04,'2024-06-19 11:08:08','2024-06-19 11:08:08',NULL),(18,20,1,14,2.33,'2024-06-19 11:09:02','2024-06-19 11:09:02',NULL),(19,21,1,2,1.00,'2024-06-19 11:11:42','2024-06-19 11:11:42',NULL),(20,22,1,21,3.50,'2024-06-19 11:13:27','2024-06-19 11:13:27',NULL),(21,23,1,12,6.00,'2024-06-19 11:16:08','2024-06-19 11:16:08',NULL),(22,24,1,3,1.50,'2024-06-19 11:17:09','2024-06-19 11:17:09',NULL),(23,25,1,12,6.00,'2024-06-19 11:23:48','2024-06-19 11:23:48',NULL),(24,26,1,21,3.50,'2024-06-19 11:25:31','2024-06-19 11:25:31',NULL),(25,27,1,280,10.37,'2024-06-19 11:27:56','2024-06-19 11:27:56',NULL),(26,29,1,840,31.11,'2024-06-19 11:35:01','2024-06-19 11:35:01',NULL),(27,30,1,28,4.67,'2024-06-19 11:36:32','2024-06-19 11:36:32',NULL),(28,31,1,90,3.33,'2024-06-19 11:37:37','2024-06-19 11:37:37',NULL),(29,32,1,2000,333.33,'2024-06-19 11:38:53','2024-06-19 11:38:53',NULL),(30,33,1,75000,37500.00,'2024-06-19 11:43:42','2024-06-19 11:43:42',NULL),(31,34,1,12,6.00,'2024-06-19 11:49:56','2024-06-19 11:49:56',NULL),(32,36,1,300000,150000.00,'2024-06-19 11:53:39','2024-06-19 11:53:39',NULL),(33,37,1,14000,2333.33,'2024-06-19 11:55:06','2024-06-19 11:55:06',NULL),(34,38,6,1000000,35714.29,'2024-06-20 07:32:00','2024-06-20 07:32:00',NULL),(35,39,7,1000000,142857.14,'2024-06-20 09:26:07','2024-06-20 09:26:07',NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kpi_metrics`
--

LOCK TABLES `kpi_metrics` WRITE;
/*!40000 ALTER TABLE `kpi_metrics` DISABLE KEYS */;
INSERT INTO `kpi_metrics` VALUES (1,3,'Sales by Category Design','KSH','1000000','weekly',1,35714.29,'70','0','30','40','60','2024-06-17 13:52:50','2024-06-17 13:52:50',NULL),(2,5,'Social Media Followers - IG','Numeric','3000','monthly',2,428.57,'70','0','30','40','60','2024-06-17 13:56:37','2024-06-17 13:56:37',NULL),(3,2,'Attendance','QTY','0','weekly',3,0.00,'70','0','30','40','60','2024-06-17 14:00:01','2024-06-17 14:00:01',NULL),(4,3,'Revenue Contribution','KSH','1200000','monthly',4,171428.57,'70','0','30','40','60','2024-06-17 14:03:51','2024-06-17 14:03:51',NULL),(5,2,'VJ Attendance','QTY','110','weekly',3,3.93,'70','0','30','40','60','2024-06-17 14:22:15','2024-06-17 14:22:15',NULL),(6,3,'Sales by Category Websites','KSH','1200000','monthly',1,171428.57,'70','0','30','40','60','2024-06-17 14:40:50','2024-06-17 14:40:50',NULL),(7,5,'Social Media LinkedIn','Numeric','7000','monthly',2,1000.00,'70','0','30','40','60','2024-06-17 14:44:20','2024-06-17 14:44:20',NULL),(8,2,'Design Tasks Per Week','QTY','300','weekly',3,10.71,'70','0','30','40','60','2024-06-17 14:47:20','2024-06-17 14:47:20',NULL),(9,2,'Performance Reviews','QTY','7','monthly',4,1.00,'100','0','30','70','90','2024-06-17 14:50:13','2024-06-17 14:50:13',NULL),(10,4,'Milestone Report','%','100','monthly',3,14.29,'70','0','30','40','60','2024-06-17 14:55:16','2024-06-17 14:55:16',NULL),(11,3,'Project Revenue Billing','KSH','8000000','monthly',1,1142857.14,'70','0','30','40','60','2024-06-18 18:53:15','2024-06-18 18:53:15',NULL),(12,3,'Retainer Revenue Billing','KSH','12000000','monthly',1,1714285.71,'70','0','30','40','60','2024-06-18 18:54:42','2024-06-18 18:54:42',NULL),(13,3,'Unicn Revenue Billing','KSH','6000000','quarterly',1,3000000.00,'70','0','30','40','60','2024-06-18 18:58:20','2024-06-18 18:58:20',NULL),(14,2,'Lynn Attendance','QTY','100','weekly',3,3.57,'70','0','30','40','60','2024-06-18 19:03:42','2024-06-18 19:03:42',NULL),(15,2,'Harriet Attendance','QTY','100','weekly',3,3.57,'70','0','30','40','60','2024-06-19 04:46:48','2024-06-19 04:46:48',NULL),(16,2,'Ngoni Attendance','QTY','100','weekly',3,3.57,'70','0','30','40','60','2024-06-19 04:47:49','2024-06-19 04:47:49',NULL),(17,3,'Revenue Contribution','KSH','2400000','monthly',4,342857.14,'70','0','30','40','60','2024-06-19 04:55:49','2024-06-19 04:55:49',NULL),(18,2,'Feature Updates','QTY','0','monthly',5,0.00,'52','0','1','2','51','2024-06-19 11:05:29','2024-06-19 11:05:29',NULL),(19,2,'Picha Tayari Bug Fixes','QTY','28','weekly',5,1.04,'70','0','30','40','60','2024-06-19 11:08:08','2024-06-19 11:08:08',NULL),(20,2,'Picha Tayari Feature Updates','QTY','14','monthly',5,2.33,'52','0','1','2','51','2024-06-19 11:09:02','2024-06-19 11:09:02',NULL),(21,2,'Picha Tayari v Release','QTY','2','quarterly',5,1.00,'70','0','39','40','69','2024-06-19 11:11:42','2024-06-19 11:11:42',NULL),(22,2,'Network Deployments','QTY','21','monthly',6,3.50,'70','0','30','40','60','2024-06-19 11:13:27','2024-06-19 11:13:27',NULL),(23,2,'WiAd Deployments','QTY','12','quarterly',6,6.00,'75','0','50','51','74','2024-06-19 11:16:08','2024-06-19 11:16:08',NULL),(24,2,'airFiber Deployments','QTY','3','quarterly',6,1.50,'70','0','30','40','60','2024-06-19 11:17:09','2024-06-19 11:17:09',NULL),(25,2,'Last Mile Connections','QTY','12','quarterly',6,6.00,'75','0','50','51','74','2024-06-19 11:23:48','2024-06-19 11:23:48',NULL),(26,2,'Security Infra Deployments','QTY','21','monthly',6,3.50,'70','0','30','40','60','2024-06-19 11:25:31','2024-06-19 11:25:31',NULL),(27,2,'Network & Security Support Tickets Closed','QTY','280','weekly',7,10.37,'70','0','39','40','69','2024-06-19 11:27:56','2024-06-19 11:27:56',NULL),(28,2,'Picha Tayari Support Tickets Closed','QTY','0','weekly',7,0.00,'70','0','39','40','69','2024-06-19 11:29:04','2024-06-19 11:29:04',NULL),(29,2,'WiAd Support Tickets Closed','QTY','840','weekly',7,31.11,'70','0','39','40','69','2024-06-19 11:35:01','2024-06-19 11:35:01',NULL),(30,2,'Web App Deployments','QTY','28','monthly',5,4.67,'70','0','39','40','69','2024-06-19 11:36:32','2024-06-19 11:36:32',NULL),(31,2,'Web App Support Tickets Closed','QTY','90','weekly',7,3.33,'70','0','39','40','69','2024-06-19 11:37:37','2024-06-19 11:37:37',NULL),(32,1,'Web Apps Closed','USD','2000','monthly',8,333.33,'70','0','39','40','69','2024-06-19 11:38:53','2024-06-19 11:38:53',NULL),(33,1,'WiAd Ad Revenue','USD','75000','quarterly',8,37500.00,'70','0','39','40','69','2024-06-19 11:43:42','2024-06-19 11:43:42',NULL),(34,2,'WiAd Locations','QTY','12','quarterly',8,6.00,'70','0','39','40','69','2024-06-19 11:49:56','2024-06-19 11:49:56',NULL),(35,2,'Picha Tayari Hospitals/Clinics Closed','QTY','0','quarterly',8,0.00,'70','0','39','40','69','2024-06-19 11:52:07','2024-06-19 11:52:07',NULL),(36,1,'Picha Tayari Revenue','USD','300000','quarterly',8,150000.00,'70','0','39','40','69','2024-06-19 11:53:39','2024-06-19 11:53:39',NULL),(37,1,'Web Apps Revenue','USD','14000','monthly',8,2333.33,'70','0','39','40','69','2024-06-19 11:55:06','2024-06-19 11:55:06',NULL),(38,3,'LXI Revenue','KSH','1000000','weekly',1,35714.29,'70','0','39','40','69','2024-06-20 07:32:00','2024-06-20 07:32:00',NULL),(39,3,'Revenue Contribution','KSH','1000000','monthly',4,142857.14,'70','0','30','40','60','2024-06-20 09:26:07','2024-06-20 09:26:07',NULL),(40,5,'Consumer Care Sales','Numeric','0','weekly',9,0.00,'70','0','30','40','60','2024-06-25 08:05:49','2024-06-25 08:05:49',NULL),(41,4,'Overall Equipment Effectiveness','%','0','weekly',10,0.00,'30','0','10','11','20','2024-06-25 08:48:47','2024-06-25 08:48:47',NULL),(42,4,'Attendance','%','0','weekly',10,0.00,'80','0','30','40','70','2024-06-25 08:51:58','2024-06-25 08:51:58',NULL),(43,4,'Task Completion Rate','%','0','weekly',10,0.00,'80','0','30','40','70','2024-06-25 08:53:20','2024-06-25 08:53:20',NULL),(44,7,'Department Reports','Unit','0','monthly',10,0.00,'80','0','30','40','70','2024-06-25 08:54:24','2024-06-25 08:54:24',NULL),(45,7,'Management Accounts','Unit','0','monthly',10,0.00,'80','0','30','40','70','2024-06-25 08:56:12','2024-06-25 08:56:12',NULL),(46,4,'Performance Reviews','%','0','quarterly',11,0.00,'80','0','30','40','70','2024-06-25 09:00:35','2024-06-25 09:00:35',NULL),(47,7,'Debtor Days','Unit','0','monthly',9,0.00,'90','0','30','40','80','2024-06-25 09:11:36','2024-06-25 09:11:36',NULL),(48,4,'Gross Profit Margin','%','0','monthly',9,0.00,'70','0','30','40','60','2024-06-25 09:12:48','2024-06-25 09:12:48',NULL),(49,4,'Customer Retention Rate','%','0','monthly',12,0.00,'70','0','30','40','60','2024-06-25 09:15:37','2024-06-25 09:15:37',NULL),(50,7,'Customer Complaints','Unit','0','weekly',12,0.00,'70','0','30','40','60','2024-06-25 09:16:41','2024-06-25 09:16:41',NULL),(51,3,'Animal Health Sales','KSH','0','weekly',9,0.00,'70','0','30','40','60','2024-06-27 13:50:34','2024-06-27 13:50:34',NULL),(52,3,'Disinfectant Sales','KSH','0','weekly',9,0.00,'70','0','30','40','60','2024-06-27 13:51:23','2024-06-27 13:51:23',NULL),(53,3,'Essentials Sales','KSH','0','weekly',9,0.00,'70','0','30','40','60','2024-06-27 13:52:02','2024-06-27 13:52:02',NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kpis`
--

LOCK TABLES `kpis` WRITE;
/*!40000 ALTER TABLE `kpis` DISABLE KEYS */;
INSERT INTO `kpis` VALUES (1,'Financial','2',1,'17th June 2024 to 31st December 2024','2024-06-17 13:50:11','2024-06-17 13:50:11',NULL),(2,'Customer','2',1,'17th June 2024 to 31st December 2024','2024-06-17 13:53:51','2024-06-17 13:53:51',NULL),(3,'Operations','2',1,'17th June 2024 to 31st December 2024','2024-06-17 13:57:31','2024-06-17 13:57:31',NULL),(4,'Learning & Growth','2',1,'17th June 2024 to 31st December 2024','2024-06-17 14:00:44','2024-06-17 14:00:44',NULL),(5,'Software Development','1',2,'19th June 2024 to 24th December 2024','2024-06-19 10:49:04','2024-06-19 10:49:04',NULL),(6,'Systems Deployments','1',2,'19th June 2024 to 24th December 2024','2024-06-19 10:50:17','2024-06-19 10:50:17',NULL),(7,'Support','1',2,'19th June 2024 to 24th December 2024','2024-06-19 11:02:00','2024-06-19 11:02:00',NULL),(8,'Sales','1',2,'19th June 2024 to 24th December 2024','2024-06-19 11:02:27','2024-06-19 11:02:27',NULL),(9,'Finance','4',5,'25th June 2024 to 30th June 2025','2024-06-25 07:59:40','2024-06-25 07:59:40',NULL),(10,'Operations','4',5,'25th June 2024 to 30th June 2025','2024-06-25 08:47:07','2024-06-25 08:47:07',NULL),(11,'Learning & Growth','4',5,'25th June 2024 to 30th June 2025','2024-06-25 08:59:29','2024-06-25 08:59:29',NULL),(12,'Customer','4',5,'25th June 2024 to 30th June 2025','2024-06-25 09:13:33','2024-06-25 09:13:33',NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `member_partner`
--

LOCK TABLES `member_partner` WRITE;
/*!40000 ALTER TABLE `member_partner` DISABLE KEYS */;
INSERT INTO `member_partner` VALUES (1,NULL,1,2,NULL,NULL,'2024-06-14 16:34:37','2024-06-14 16:34:37',NULL),(2,NULL,2,1,NULL,NULL,'2024-06-17 13:45:00','2024-06-17 13:45:00',NULL),(3,NULL,4,5,NULL,NULL,'2024-06-18 18:06:25','2024-06-18 18:06:25',NULL),(4,NULL,5,1,NULL,NULL,'2024-06-18 18:44:30','2024-06-18 18:44:30',NULL),(5,NULL,6,1,NULL,NULL,'2024-06-18 19:08:01','2024-06-18 19:08:01',NULL),(6,NULL,7,1,NULL,NULL,'2024-06-18 20:23:10','2024-06-18 20:23:10',NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `members`
--

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
INSERT INTO `members` VALUES (1,'Davies Kevin','info@shaeteq.com',NULL,NULL,NULL,9,NULL,1,'2024-06-14 16:34:37','2024-06-14 16:34:37',NULL),(2,'VJ Mabonga','vj@tactive.consulting',NULL,NULL,NULL,10,NULL,1,'2024-06-17 13:45:00','2024-06-17 13:45:00',NULL),(3,'Judith Mwangangi','judith@tactive.consulting',NULL,NULL,NULL,11,NULL,1,'2024-06-18 08:39:46','2024-06-18 08:39:46',NULL),(4,'Moses Hunja','moses@tactive.consulting',NULL,NULL,NULL,13,NULL,1,'2024-06-18 18:06:25','2024-06-18 18:06:25',NULL),(5,'Kangethe Lynn Wanjiru','lynn@tactive.consulting',NULL,NULL,NULL,14,NULL,1,'2024-06-18 18:44:30','2024-06-18 18:44:30',NULL),(6,'Harriet Kamau','harriet@tactive.consulting',NULL,NULL,NULL,15,NULL,1,'2024-06-18 19:08:01','2024-06-18 19:08:01',NULL),(7,'Ngoni Gurure','ngoni@tactive.consulting',NULL,NULL,NULL,16,NULL,1,'2024-06-18 20:23:10','2024-06-18 20:23:10',NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `metrics`
--

LOCK TABLES `metrics` WRITE;
/*!40000 ALTER TABLE `metrics` DISABLE KEYS */;
INSERT INTO `metrics` VALUES (1,'USD','Currency','2024-06-14 10:00:48','2024-06-14 10:00:48',NULL),(2,'QTY','Unit','2024-06-14 10:00:58','2024-06-14 10:00:58',NULL),(3,'KSH','Currency','2024-06-14 10:01:10','2024-06-14 10:01:10',NULL),(4,'%','Numeric','2024-06-17 13:11:40','2024-06-17 13:11:40',NULL),(5,'Numeric','Numeric','2024-06-17 13:11:53','2024-06-17 13:11:53',NULL),(6,'Ratio','Numeric','2024-06-17 13:12:28','2024-06-17 13:12:28',NULL),(7,'Unit','Unit','2024-06-17 13:13:31','2024-06-17 13:13:31',NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `partners`
--

LOCK TABLES `partners` WRITE;
/*!40000 ALTER TABLE `partners` DISABLE KEYS */;
INSERT INTO `partners` VALUES (1,'Tactive','The Werks, Hendred Road, Lavingtion, Tactive','+254707249001','kaye@tactive.consulting','tactive.consulting','https://app.unicn.africa/uploads/partners/logos/tactive-logo1718357147.png',1,'Marketing','A management consulting firm with focus on shaping SME growth.','undefined','$2y$10$eeVGq5ku6DVZZ37SYXArF.tPYhBm2eH3grRWPfkdOKTm3ioI/8/Za',1,5,'2024-06-14 09:25:48','2024-06-19 07:01:07',NULL),(2,'Shaeteq','Riverside Drive Swiss Cottages No.1','+254715813380','davies@shaeteq.com','shaeteq.com','https://app.unicn.africa/uploads/partners/logos/shaeteq-logo1718357408.png',1,'Technology','We are a Digital Systems Integrator and Design House focused on improving your efficiency','undefined','$2y$10$V2zIq6oHTCR2VoU2YDdise.V2dDBRREfORFjVDAuEQ1F2Jeq2RAFq',1,6,'2024-06-14 09:30:08','2024-06-14 16:26:37',NULL),(5,'Biodeal','P.O. BOX 32040-00600','+254202015228','biodeal@unicn.africa','biodeal.com','https://app.unicn.africa/uploads/partners/logos/biodeal-logo1718716368.png',1,'Healthcare','About Biodeal','undefined','$2y$10$YqnQL8k6v3J6nxDksVDeDe7iI2jvqdQbTr7i.735XOuvLyDSfMG2a',1,12,'2024-06-18 13:12:48','2024-06-20 08:54:22',NULL),(6,'Pakpro','Pinetree Plaza Kaburu Drive, Nairobi, Kenya','+254794864438','pakpro@unicn.africa','pakpro.co.ke','https://app.unicn.africa/uploads/partners/logos/pakpro-logo1718823506.jpeg',1,'Logistics','PAKPRO is the trading name of the Packaging Producer Responsibility Organisation Limited, formerly Kenya PET Recycling Company Limited-PETCO, a business member organisation to represent the industry’s joint effort to regulate post-consumer packaging','undefined','$2y$10$fJ1bQ37otwC6gbiOCKxVfOr7iMrpwm2peC2th1aVzwTtiYD/hxsDS',1,17,'2024-06-19 18:58:27','2024-06-19 18:58:27',NULL),(7,'Takataka ni mali','733 Maji Mazuri Rd, Lavington, Nairobi','+254115997586','ttnm@unicn.africa','takanimali.org','https://app.unicn.africa/uploads/partners/logos/takataka ni mali-logo1718824355.png',1,'Technology','Our impact strategy model is dedicated in moving Kenya towards a more circular economy for material supply security and increase competition, innovation, growth & job creation in waste management sector.','undefined','$2y$10$Vf6Rg6xbio9ui1v/mRB.EO2zCYnTKFmWXFxOtXZJWszXZqxUumOD2',1,18,'2024-06-19 19:12:35','2024-06-19 19:12:35',NULL),(8,'Ceramaji','8540 109 St NW #203, Edmonton, AB T6G 1E6, Canada','+254729664063','ceramaji@unicn.africa','ceramaji.com','https://app.unicn.africa/uploads/partners/logos/ceramaji-logo1718825437.jpeg',1,'Healthcare','Ceramic pot filters that are manufactured and distributed in Kenya.','undefined','$2y$10$T0OE3JxBhhIYJoy34/QfTO0GdR3ZPY5OjXmjA7Gp1T/4RDku2Af4S',1,19,'2024-06-19 19:30:37','2024-06-19 19:30:38',NULL),(9,'Adrian','Opp. Kikuyu-Junction, Adrian Group Center Nairobi, 00100 Kenya','+254701971818','adrian@unicn.africa','adriankenya.com','https://app.unicn.africa/uploads/partners/logos/adrian-logo1718826984.jpeg',1,'Technology','Leading provider of technology & EPC solutions (Engineering, Procurement, Construction) in E. Africa #EnablingInnovation','undefined','$2y$10$teX/gnrPRbPqzvtSwAXO3O3Qw4xMWDbfPAl52U5ZcCHhTXL.W.RKi',1,20,'2024-06-19 19:56:24','2024-06-19 19:56:24',NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `progress`
--

LOCK TABLES `progress` WRITE;
/*!40000 ALTER TABLE `progress` DISABLE KEYS */;
INSERT INTO `progress` VALUES (1,1,1,NULL,'Week 25','Tunza Social media Collateral',25000,35714.29,'2024-06-17 14:16:35','2024-06-17 14:16:35'),(2,2,2,NULL,'June IG Update','Instagram; Used paid ADs to increase followers',150,428.57,'2024-06-17 14:19:51','2024-06-17 14:19:51'),(3,4,5,NULL,'Week 25 Attendance','Full Attendance',5,3.93,'2024-06-17 14:25:13','2024-06-17 14:25:13'),(4,3,4,NULL,'June Revenue contribution','Awws Collateral, Tunza SM, GTG Branding, Tactive SM',120000,171428.57,'2024-06-17 14:31:38','2024-06-17 14:31:38'),(5,3,4,NULL,'June Revenue contribution','Awws Collateral, Tunza SM, GTG Branding, Tactive SM',120000,171428.57,'2024-06-17 14:31:40','2024-06-17 14:31:40'),(6,5,6,NULL,'June Update','Slow progress',50000,171428.57,'2024-06-17 15:06:21','2024-06-17 15:06:21'),(7,6,7,NULL,'June new Followers','200 new followers',200,1000.00,'2024-06-17 15:07:33','2024-06-17 15:07:33'),(8,7,8,NULL,'Week 25','One task a day',5,10.71,'2024-06-17 15:08:27','2024-06-17 15:08:27'),(9,9,10,NULL,'June Milestone reports','6 milestones done',50,14.29,'2024-06-17 15:09:43','2024-06-17 15:09:43'),(10,8,9,NULL,'Performance review','Review Done',1,1.00,'2024-06-17 15:12:08','2024-06-17 15:12:08'),(11,17,19,NULL,'Week 28 of 2024','Bug fix A',1,1.04,'2024-06-19 20:13:53','2024-06-19 20:13:53'),(12,18,20,NULL,'June 2024','Fracture Diagnosis',1,2.33,'2024-06-19 20:16:21','2024-06-19 20:16:21'),(13,19,21,NULL,'Q2 2024','v2 Release',1,1.00,'2024-06-19 20:19:08','2024-06-19 20:19:08'),(14,27,30,NULL,'June','Tunza Website Deployed',1,4.67,'2024-06-19 20:20:28','2024-06-19 20:20:28'),(15,20,22,NULL,'June 2024','Precise Healthcare & Joojoo Stores',2,3.50,'2024-06-19 20:22:59','2024-06-19 20:22:59'),(16,33,37,NULL,'June 2024','Tunza, SF & T21',2000,2333.33,'2024-06-19 20:31:27','2024-06-19 20:31:27'),(17,21,23,NULL,'June 2024','Strathmore & JKUAT Gate B',2,6.00,'2024-06-19 20:32:30','2024-06-19 20:32:30'),(18,32,36,NULL,'Q2 2024','Various Hospital License Fees',87310,150000.00,'2024-06-19 20:47:44','2024-06-19 20:47:44'),(19,22,24,NULL,'June 2024','North Eastern Kenya Backhauls',3,1.50,'2024-06-19 20:50:29','2024-06-19 20:50:29'),(20,23,25,NULL,'Q2','Various North Eastern WiAd site connections',4,6.00,'2024-06-19 20:53:14','2024-06-19 20:53:14'),(21,24,26,NULL,'June 2024','Precise Healthcare Greenhouse & Gigiri & joojoo Stores',3,3.50,'2024-06-19 20:55:34','2024-06-19 20:55:34'),(22,25,27,NULL,'June 2024','Closed Tickeets',10,10.37,'2024-06-19 20:56:51','2024-06-19 20:56:51'),(23,26,29,NULL,'June 2024','Closed Tickets',19,31.11,'2024-06-19 20:57:49','2024-06-19 20:57:49'),(24,28,31,NULL,'Week 28 of 2024','Closed Tickets',4,3.33,'2024-06-19 20:59:16','2024-06-19 20:59:16'),(25,29,32,NULL,'June 2024','Tunza SPA',300,333.33,'2024-06-19 21:00:57','2024-06-19 21:00:57'),(26,30,33,NULL,'Q2 2024','Ad Revenue',26125,37500.00,'2024-06-19 21:03:23','2024-06-19 21:03:23'),(27,31,34,NULL,'Q2 2024','New WiAd Locations',4,6.00,'2024-06-19 21:07:06','2024-06-19 21:07:06');
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `progress_chat`
--

LOCK TABLES `progress_chat` WRITE;
/*!40000 ALTER TABLE `progress_chat` DISABLE KEYS */;
INSERT INTO `progress_chat` VALUES (1,1,5,'Well done, let\'s ensure we produce MP4 videos','2024-06-17 14:24:41','2024-06-17 14:24:41'),(2,1,5,'Email me once you have created them','2024-06-17 14:27:52','2024-06-17 14:27:52');
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
INSERT INTO `progress_files` VALUES (1,11,'[\"ProgressUploads\\/Screenshot 2024-06-19 at 23.13.01.png\"]','2024-06-19 20:13:53','2024-06-19 20:13:53');
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `units`
--

LOCK TABLES `units` WRITE;
/*!40000 ALTER TABLE `units` DISABLE KEYS */;
INSERT INTO `units` VALUES (1,'Currency','number',NULL,'2024-06-14 10:00:24','2024-06-14 10:00:24'),(2,'Unit','integer',NULL,'2024-06-14 10:00:36','2024-06-14 10:00:36'),(3,'Numeric','number',NULL,'2024-06-17 13:11:13','2024-06-17 13:11:13');
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
INSERT INTO `user_roles` VALUES (1,'admin','2024-06-14 09:22:17','2024-06-14 09:22:17'),(2,'Member','2024-06-14 09:22:17','2024-06-14 09:22:17'),(3,'Partner','2024-06-14 09:22:17','2024-06-14 09:22:17'),(4,'Member_partner','2024-06-14 09:22:17','2024-06-14 09:22:17');
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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'John Doe','partner@gmail.com',NULL,NULL,'$2y$10$IyGCBnVSry.w1iigYRIYsesfXcFwHVmG0gv9l/UmGIu2w7RNY12e.',1,NULL,3,'2024-06-14 09:22:17','2024-06-14 09:22:17',NULL),(2,'Admin','admin@gmail.com',NULL,NULL,'$2y$10$j007TA5297WzOqzpGa.zr.e92kQ5hslnrlcITenVYpkwcyU4utRQq',1,NULL,1,'2024-06-14 09:22:17','2024-06-14 09:22:17',NULL),(3,'Kaye','kaye@unicn.africa',NULL,NULL,'$2y$10$/4NaoiJNDbfaH4qaOQUvvuvEJc02zmrB3JMkOm3WLJpHdfaw9Hkvu',1,NULL,1,'2024-06-14 09:22:17','2024-06-14 09:22:17',NULL),(4,'Judith','judith@unicn.africa',NULL,NULL,'$2y$10$52msNIzpfdZC2ud4/9AaDefU.GLP3o1O0np7SdRcDwClAPzClnFSi',1,NULL,1,'2024-06-14 09:22:17','2024-06-14 09:22:17',NULL),(5,'Tactive','kaye@tactive.consulting',NULL,NULL,'$2y$10$MhS1R3FIBp1mByzKWsMBZ.O2mEpcqY79gKaELJqQnUkqFIZR5Frr.',1,NULL,3,'2024-06-14 09:25:48','2024-06-14 09:25:48',NULL),(6,'Shaeteq','davies@shaeteq.com',NULL,NULL,'$2y$10$qSinBmw1t3eU6c4ioxgb3eUnl2HJvy8o2svAsSxopM9P.gI88E.nG',1,NULL,3,'2024-06-14 09:30:09','2024-06-14 09:30:09',NULL),(9,'Davies Kevin','info@shaeteq.com',NULL,NULL,'$2y$10$VuUondBS8g51Idyh4nzmB.saUu/k2bmDJo5ExAyvh9BtloVsPrQRS',1,NULL,2,'2024-06-14 16:34:37','2024-06-14 16:34:37',NULL),(10,'VJ Mabonga','vj@tactive.consulting',NULL,NULL,'$2y$10$8e9Yym8P/pA9YgsMDeuG8.11B/IHjXlNgXNIZ/9Upqvi2isUc6bWm',1,NULL,2,'2024-06-17 13:45:00','2024-06-17 13:45:00',NULL),(11,'Judith Mwangangi','judith@tactive.consulting',NULL,NULL,'$2y$10$i34D5KfqvYRAFORw7vY0aOQtxdAp2di5XdtouhxdQB7PzIsEj8CTy',1,NULL,2,'2024-06-18 08:39:46','2024-06-18 08:39:46',NULL),(12,'Biodeal','biodeal@unicn.africa',NULL,NULL,'$2y$10$e9CwCZf8PQWicxHa6IhlSObcZl7jhRnLiRlLFU8U54atDv3Wcdc0S',1,NULL,3,'2024-06-18 13:12:48','2024-06-18 13:12:48',NULL),(13,'Moses Hunja','moses@tactive.consulting',NULL,NULL,'$2y$10$vlN3ITDYNqbHxGqrgLcm6OJ5J5xkhY/yl37QddH/nssRo2xd1MXIi',1,NULL,2,'2024-06-18 18:06:25','2024-06-18 18:06:25',NULL),(14,'Kangethe Lynn Wanjiru','lynn@tactive.consulting',NULL,NULL,'$2y$10$q5ZpV20pvbUXNG3Bt9wwqOgVOhurrIS6jQE06Y9LbwOdmnqufm91u',1,NULL,2,'2024-06-18 18:44:30','2024-06-18 18:44:30',NULL),(15,'Harriet Kamau','harriet@tactive.consulting',NULL,NULL,'$2y$10$U8i0WmD8G71Bxg9Yu.T5cOGMTD.Xk1/aJfKZlVomGfpSwgmqpkPZO',1,NULL,2,'2024-06-18 19:08:01','2024-06-18 19:08:01',NULL),(16,'Ngoni Gurure','ngoni@tactive.consulting',NULL,NULL,'$2y$10$k.qCU/qZw53D1hflOyju/eqQx8znOb1CZGoHVDNtzy8mntuiJmIU2',1,NULL,2,'2024-06-18 20:23:10','2024-06-18 20:23:10',NULL),(17,'Pakpro','pakpro@unicn.africa',NULL,NULL,'$2y$10$bCBbA1SdHrNz0I2KMjyRUu.JBDJF1s62VV4gMb0vmlfQojF9vhtAG',1,NULL,3,'2024-06-19 18:58:27','2024-06-19 18:58:27',NULL),(18,'Takataka ni mali','ttnm@unicn.africa',NULL,NULL,'$2y$10$v05C44erikSqC0SukWBo1ODn2inFhl.G8Or2/B3e2aV2kKEILZOh6',1,NULL,3,'2024-06-19 19:12:35','2024-06-19 19:12:35',NULL),(19,'Ceramaji','ceramaji@unicn.africa',NULL,NULL,'$2y$10$0hQpQ8FIPVc2FDYlor7yHOr.gTpmsmwmXb1UK2BpZqELwhJrsUi7e',1,NULL,3,'2024-06-19 19:30:38','2024-06-19 19:30:38',NULL),(20,'Adrian','adrian@unicn.africa',NULL,NULL,'$2y$10$Y6.6htvYbUVRVZXH4l3x8ugpy5ZnQuvNw9h8OYSJOtuq8AtLs0BHi',1,NULL,3,'2024-06-19 19:56:24','2024-06-19 19:56:24',NULL);
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

-- Dump completed on 2024-07-23 11:43:14
