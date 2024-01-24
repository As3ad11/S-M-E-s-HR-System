-- MySQL dump 10.13  Distrib 8.0.28, for Win64 (x86_64)
--
-- Host: localhost    Database: ehr
-- ------------------------------------------------------
-- Server version	8.0.28

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
-- Table structure for table `announcements`
--

DROP TABLE IF EXISTS `announcements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `announcements` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `announcement` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `announcements_FK` (`user_id`),
  CONSTRAINT `announcements_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `announcements`
--

LOCK TABLES `announcements` WRITE;
/*!40000 ALTER TABLE `announcements` DISABLE KEYS */;
INSERT INTO `announcements` VALUES (3,1,'How to apply leave','Check this link out https://www.makanmakan.com for more information','2022-04-28 07:31:22'),(6,1,'URGENT','PLEASE REGISTERR YOU ACCOUNT NOW!','2022-06-15 04:49:27');
/*!40000 ALTER TABLE `announcements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `covid_cases`
--

DROP TABLE IF EXISTS `covid_cases`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `covid_cases` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `covid_status` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `covid_cases_FK` (`user_id`),
  CONSTRAINT `covid_cases_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `covid_cases`
--

LOCK TABLES `covid_cases` WRITE;
/*!40000 ALTER TABLE `covid_cases` DISABLE KEYS */;
INSERT INTO `covid_cases` VALUES (3,'2022-05-16',1,2),(4,'2022-05-18',1,3),(5,'2022-05-18',9,2),(6,'2022-05-18',9,4),(10,'2022-06-15',12,4),(11,'2022-06-15',12,3),(12,'2022-06-15',12,4);
/*!40000 ALTER TABLE `covid_cases` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `covid_risk_statuses`
--

DROP TABLE IF EXISTS `covid_risk_statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `covid_risk_statuses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `report_flag` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `covid_risk_statuses`
--

LOCK TABLES `covid_risk_statuses` WRITE;
/*!40000 ALTER TABLE `covid_risk_statuses` DISABLE KEYS */;
INSERT INTO `covid_risk_statuses` VALUES (1,'Low Risk No Symptom',NULL),(2,'Low Risk With Symptom',1),(3,'Risky With No Symptom',1),(4,'Risky With High Symptom',1);
/*!40000 ALTER TABLE `covid_risk_statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `credit_categories`
--

DROP TABLE IF EXISTS `credit_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `credit_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `credit_categories`
--

LOCK TABLES `credit_categories` WRITE;
/*!40000 ALTER TABLE `credit_categories` DISABLE KEYS */;
INSERT INTO `credit_categories` VALUES (1,'Travel'),(2,'Tolls'),(3,'Gas');
/*!40000 ALTER TABLE `credit_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `departments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `manager_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `departments_FK` (`manager_id`),
  CONSTRAINT `departments_FK` FOREIGN KEY (`manager_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departments`
--

LOCK TABLES `departments` WRITE;
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;
INSERT INTO `departments` VALUES (1,'Human Resources',NULL),(3,'Management',NULL);
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
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `feeds`
--

DROP TABLE IF EXISTS `feeds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `feeds` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `location` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `time` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `feeds_FK` (`user_id`),
  CONSTRAINT `feeds_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feeds`
--

LOCK TABLES `feeds` WRITE;
/*!40000 ALTER TABLE `feeds` DISABLE KEYS */;
INSERT INTO `feeds` VALUES (1,1,'WFH & WFO Announcement','WFH & WFO Announcement for all our employee','Zoom Meeting','10am ~ 12pm','2022-04-28 08:11:52'),(4,1,'Annual meeting','byod','tower 1','1:45 pm','2022-05-18 08:03:20'),(5,1,'WFH & WFO Announcement','WFH & WFO Announcement for all our employee','Zoom Meeting','10am ~ 11am','2022-06-07 13:41:13'),(6,1,'Selamat Hari Raya!','Selamat Hari Raya Announcement for all our employee','Zoom Meeting','10am ~ 11am','2022-06-07 14:08:38'),(8,1,'Culpa voluptates aut','Velit excepturi fugisss','Enim obcaecati esse','Blanditiis doloremqu','2022-06-14 03:50:44');
/*!40000 ALTER TABLE `feeds` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `incomes`
--

DROP TABLE IF EXISTS `incomes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `incomes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `amount` float(20,2) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `incomes`
--

LOCK TABLES `incomes` WRITE;
/*!40000 ALTER TABLE `incomes` DISABLE KEYS */;
INSERT INTO `incomes` VALUES (1,7000.00,'2022-01-31 00:00:00'),(2,1000.00,'2022-05-31 00:00:00'),(3,4000.00,'2021-05-31 00:00:00'),(4,900.00,'2019-05-31 00:00:00'),(5,1098.00,'2015-05-31 00:00:00'),(6,2312.00,'2013-05-31 00:00:00'),(7,1000.00,'2022-08-31 00:00:00'),(8,2000.00,'2022-09-30 00:00:00'),(9,3500.00,'2022-09-14 00:00:00'),(10,10000.00,'2022-06-30 00:00:00'),(11,200.23,'2022-09-01 00:00:00'),(12,500.00,'2022-09-02 00:00:00');
/*!40000 ALTER TABLE `incomes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leave_categories`
--

DROP TABLE IF EXISTS `leave_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `leave_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leave_categories`
--

LOCK TABLES `leave_categories` WRITE;
/*!40000 ALTER TABLE `leave_categories` DISABLE KEYS */;
INSERT INTO `leave_categories` VALUES (1,'Mandatory Leave'),(2,'Annual Leave'),(3,'Medical Leave');
/*!40000 ALTER TABLE `leave_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `manager_employee`
--

DROP TABLE IF EXISTS `manager_employee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `manager_employee` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `manager_id` bigint unsigned DEFAULT NULL,
  `employee_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `manager_employee_FK` (`manager_id`),
  KEY `manager_employee_FK_1` (`employee_id`),
  CONSTRAINT `manager_employee_FK` FOREIGN KEY (`manager_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `manager_employee_FK_1` FOREIGN KEY (`employee_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `manager_employee`
--

LOCK TABLES `manager_employee` WRITE;
/*!40000 ALTER TABLE `manager_employee` DISABLE KEYS */;
/*!40000 ALTER TABLE `manager_employee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2014_10_12_200000_add_two_factor_columns_to_users_table',1),(4,'2019_08_19_000000_create_failed_jobs_table',1),(5,'2019_12_14_000001_create_personal_access_tokens_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` VALUES ('asaadg236@gmail.com','$2y$10$Ci4Fyff3KPg9cuiX8Wyn.ulr8Gr8lhPHVOaM09h82FI0c9uKSNOlm','2022-09-13 23:15:15'),('asaadgafar6@gmail.com','$2y$10$0T0saGBw51jDDf178PP7tuBLSx04GK6cVtFjgdWG8uy5Ltf257X2q','2022-09-14 07:41:50');
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
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
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
-- Table structure for table `personal_documents`
--

DROP TABLE IF EXISTS `personal_documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_documents` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `personal_documents_FK` (`user_id`),
  CONSTRAINT `personal_documents_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_documents`
--

LOCK TABLES `personal_documents` WRITE;
/*!40000 ALTER TABLE `personal_documents` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_education`
--

DROP TABLE IF EXISTS `personal_education`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_education` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `institution_name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_from` date DEFAULT NULL,
  `date_until` date DEFAULT NULL,
  `course` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `result` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `personal_education_FK` (`user_id`),
  CONSTRAINT `personal_education_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_education`
--

LOCK TABLES `personal_education` WRITE;
/*!40000 ALTER TABLE `personal_education` DISABLE KEYS */;
INSERT INTO `personal_education` VALUES (1,10,'UTM','2019-11-18','2022-04-18','It management','3.69'),(3,1,'Luke Underwood','2007-11-20','2005-01-17','Aut quaerat et tenets','Ut fugit sapiente d'),(4,1,'Shea Thompson','1983-08-07','2004-01-02','Nulla expedita dolor','Provident deserunt'),(6,12,'Malaya','2017-11-18','2020-12-05','Information Technology','3.56');
/*!40000 ALTER TABLE `personal_education` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_experiences`
--

DROP TABLE IF EXISTS `personal_experiences`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_experiences` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `company_name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_from` date DEFAULT NULL,
  `date_until` date DEFAULT NULL,
  `position` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jobscope` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `personal_experiences_FK` (`user_id`),
  CONSTRAINT `personal_experiences_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_experiences`
--

LOCK TABLES `personal_experiences` WRITE;
/*!40000 ALTER TABLE `personal_experiences` DISABLE KEYS */;
INSERT INTO `personal_experiences` VALUES (1,10,'TM','2021-12-12','2022-01-15','senior manager','IT services'),(2,1,'Acevedo Mcfarland Plc','2003-01-15','1995-03-04','Quaerat voluptatem n','Est dolorem aut expl'),(5,12,'EDA','2021-06-15','2022-02-28','UX deigner','deisgnig and efining the user requirements');
/*!40000 ALTER TABLE `personal_experiences` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_families`
--

DROP TABLE IF EXISTS `personal_families`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_families` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `relationship` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `emergency_flag` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `personal_families_FK` (`user_id`),
  CONSTRAINT `personal_families_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_families`
--

LOCK TABLES `personal_families` WRITE;
/*!40000 ALTER TABLE `personal_families` DISABLE KEYS */;
INSERT INTO `personal_families` VALUES (1,3,'Mikel Kastark','0129991111','mikel@example.com','2001-05-02','Sibling',1),(2,10,'asaad','01674985331','asaadgafar1212@gmail.com','1996-12-13','brother',1),(3,10,'abeer Ahmed','0164429884','abeer45@gmail.com','1999-12-01','sister',0),(5,1,'Baker Floyd','+1 (831) 153-1616','locaxi@mailinator.com','2008-09-05','Nobis est esse est e',1),(7,1,'Lani Estes','+1 (735) 887-7983','peraxew@mailinator.com','1989-11-16','Officia consequatur',1),(8,12,'Mutasim Salih','0238840238','m.salih3452gmail.com','1995-12-12','Brother',1);
/*!40000 ALTER TABLE `personal_families` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_galleries`
--

DROP TABLE IF EXISTS `personal_galleries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_galleries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `personal_galleries_FK` (`user_id`),
  CONSTRAINT `personal_galleries_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_galleries`
--

LOCK TABLES `personal_galleries` WRITE;
/*!40000 ALTER TABLE `personal_galleries` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_galleries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_profiles`
--

DROP TABLE IF EXISTS `personal_profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_profiles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `first_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `initial` char(2) COLLATE utf8mb4_general_ci NOT NULL,
  `about` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `join_date` date DEFAULT NULL,
  `position` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `profile_image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `personal_profiles_FK` (`user_id`),
  CONSTRAINT `personal_profiles_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_profiles`
--

LOCK TABLES `personal_profiles` WRITE;
/*!40000 ALTER TABLE `personal_profiles` DISABLE KEYS */;
INSERT INTO `personal_profiles` VALUES (1,1,'Super','Admin','SA','Let\'s goooo!','Kajang','0123332123','2022-05-03','Director','pexels-vitaliy-izonin-10368612-62829283a026c.jpg'),(2,3,'Jane','Doe','JD','Tonightttt! We are Young!!','Jawa','0123452313','2022-05-02','Manager','pexels-jasmin-chew-5990180-6282988006d5a.jpg'),(3,4,'Lewis','Hamiltoniah','LH',NULL,'Kajang','0123332123','2022-05-04','Executive','lewis-hamilton-mercedes-1-631db8e8bc1c1.jpg'),(4,5,'Neko','Mamushi','NM',NULL,'Kajang','0122222222','2022-05-03','Officer',NULL),(5,6,'Max','Verstappen','MV',NULL,'Kajang','0123332123','2022-05-02','Officer',NULL),(6,7,'Lando','Norris','LN',NULL,'Kajang','0123452313','2022-05-03','Officer','F1_LandoNorris_Bluesuit-631d50d518e94.jpg'),(7,8,'Pierre','Gasly','PG',NULL,'Kajang','0123332123','2022-05-02','Officer',NULL),(8,9,'Asem','Salih','AS','passionate employee','selnagor','0176614559','1997-12-01',NULL,NULL),(9,10,'Khalid','Aziz','KA','passionate employee','kl','0173594002','2022-05-05','intern','121212-62838b5c0de64.jpg'),(10,11,'John','Doe','JD','Fun','Kajang','0123456789','2022-06-01','Manager','man-629ed5f9b8bee.ico'),(11,12,'Asaad','Gafar','AG','Passionate employee','Bukit Jalil','0123456678','2022-12-05','user experience designer','mbappe-62a95ba1589ed.jpg'),(12,13,'ahmed','Mourad','AM','passionate employee','selnagor','0115478990','2022-09-14','intern',NULL),(13,14,'abdulrahman','aziz','AA','work','kl','0165489007','2022-09-13','hr employee',NULL),(14,16,'khalid','ahmed','KA','work','kl','01111111112','2022-09-14','intern',NULL);
/*!40000 ALTER TABLE `personal_profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_projects`
--

DROP TABLE IF EXISTS `personal_projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_projects` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_start` date DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  `status` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `personal_projects_FK` (`user_id`),
  CONSTRAINT `personal_projects_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_projects`
--

LOCK TABLES `personal_projects` WRITE;
/*!40000 ALTER TABLE `personal_projects` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_training_certs`
--

DROP TABLE IF EXISTS `personal_training_certs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_training_certs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `type` char(1) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '1',
  `date_start` date DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  `description` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_expired` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `personal_training_certs_FK` (`user_id`),
  CONSTRAINT `personal_training_certs_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_training_certs`
--

LOCK TABLES `personal_training_certs` WRITE;
/*!40000 ALTER TABLE `personal_training_certs` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_training_certs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `role_code` char(1) COLLATE utf8mb4_general_ci NOT NULL,
  `role_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `role_level` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'1','Admin',1),(2,'2','Employer',2),(3,'3','Manager',3),(4,'4','Employee',4);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_charts`
--

DROP TABLE IF EXISTS `user_charts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_charts` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `level` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_charts_FK` (`user_id`),
  CONSTRAINT `user_charts_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_charts`
--

LOCK TABLES `user_charts` WRITE;
/*!40000 ALTER TABLE `user_charts` DISABLE KEYS */;
INSERT INTO `user_charts` VALUES (1,1,1),(2,3,2),(6,7,3),(7,8,3),(9,5,3),(11,12,3),(12,NULL,NULL),(13,1,NULL),(14,NULL,NULL),(15,NULL,NULL),(16,NULL,NULL);
/*!40000 ALTER TABLE `user_charts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_covid_statuses`
--

DROP TABLE IF EXISTS `user_covid_statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_covid_statuses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `covid_status_id` bigint unsigned DEFAULT NULL,
  `conditions` text COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`id`),
  KEY `user_covid_statuses_FK` (`user_id`),
  KEY `user_covid_statuses_FK_1` (`covid_status_id`),
  CONSTRAINT `user_covid_statuses_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_covid_statuses_FK_1` FOREIGN KEY (`covid_status_id`) REFERENCES `covid_risk_statuses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_covid_statuses`
--

LOCK TABLES `user_covid_statuses` WRITE;
/*!40000 ALTER TABLE `user_covid_statuses` DISABLE KEYS */;
INSERT INTO `user_covid_statuses` VALUES (1,1,3,'Headache'),(2,3,1,NULL),(3,9,4,'covid'),(4,11,1,'Better'),(5,12,4,'bad');
/*!40000 ALTER TABLE `user_covid_statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_credits`
--

DROP TABLE IF EXISTS `user_credits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_credits` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `credit_id` bigint unsigned DEFAULT NULL,
  `amount` float(20,2) NOT NULL,
  `approved` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_credits_FK` (`user_id`),
  KEY `user_credits_FK_1` (`credit_id`),
  CONSTRAINT `user_credits_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_credits_FK_1` FOREIGN KEY (`credit_id`) REFERENCES `credit_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_credits`
--

LOCK TABLES `user_credits` WRITE;
/*!40000 ALTER TABLE `user_credits` DISABLE KEYS */;
INSERT INTO `user_credits` VALUES (1,3,1,300.00,1),(2,1,2,300.00,1),(3,1,1,300.00,1),(4,1,3,300.00,2),(5,11,2,300.00,1),(6,1,3,300.00,1),(7,5,2,300.00,1),(8,11,2,300.00,1),(9,11,1,300.00,1),(10,12,1,200.00,1),(11,14,2,150.00,1);
/*!40000 ALTER TABLE `user_credits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_departments`
--

DROP TABLE IF EXISTS `user_departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_departments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `department_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_departments_FK` (`user_id`),
  KEY `user_departments_FK_1` (`department_id`),
  CONSTRAINT `user_departments_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_departments_FK_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_departments`
--

LOCK TABLES `user_departments` WRITE;
/*!40000 ALTER TABLE `user_departments` DISABLE KEYS */;
INSERT INTO `user_departments` VALUES (1,1,3),(2,3,3),(3,4,1),(4,5,3),(5,6,1),(6,7,1),(7,8,3),(8,9,3),(9,10,1),(10,11,3),(11,12,1),(12,13,1),(13,14,1),(14,16,3);
/*!40000 ALTER TABLE `user_departments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_documents`
--

DROP TABLE IF EXISTS `user_documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_documents` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `document_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_documents_FK` (`user_id`),
  CONSTRAINT `user_documents_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_documents`
--

LOCK TABLES `user_documents` WRITE;
/*!40000 ALTER TABLE `user_documents` DISABLE KEYS */;
INSERT INTO `user_documents` VALUES (4,10,'turntin-62838cc43ca21.docx','2022-05-17 11:53:40'),(5,1,'payslip-template-6283c14c1343e.pdf','2022-05-17 15:37:48'),(6,1,'payslip-template-6283c4e26805f.html','2022-05-17 15:53:06'),(9,9,'121212-6284a26687bea.jpg','2022-05-18 07:38:14'),(11,12,'UCD Agile BOSCARD template V2-62a95d8f49ef5.docx','2022-06-15 04:18:23'),(12,1,'MilestoneReportTemplate-62a9fb0e7c9f1.pdf','2022-06-15 15:30:22'),(13,11,'coding-62a9fbca8aa8a.ico','2022-06-15 15:33:30'),(14,11,'man-62a9fda1baf4f.ico','2022-06-15 15:41:21'),(15,12,'Malaysian E-Commerce Ecosystem-62aa0263381d3.pdf','2022-06-15 16:01:39');
/*!40000 ALTER TABLE `user_documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_galleries`
--

DROP TABLE IF EXISTS `user_galleries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_galleries` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `photo_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_galleries_FK` (`user_id`),
  CONSTRAINT `user_galleries_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_galleries`
--

LOCK TABLES `user_galleries` WRITE;
/*!40000 ALTER TABLE `user_galleries` DISABLE KEYS */;
INSERT INTO `user_galleries` VALUES (2,1,'pexels-valeriia-miller-8525192-62828e1a6660b.jpg','2022-05-16 17:47:06'),(7,10,'buy-1-62838cdaa6091.jpg','2022-05-17 11:54:02'),(8,10,'image1-62838ce796b1f.png','2022-05-17 11:54:15'),(10,4,'lewis-hamilton-mercedes-1-631db8ce951de.jpg','2022-09-11 10:30:38');
/*!40000 ALTER TABLE `user_galleries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_identity_documents`
--

DROP TABLE IF EXISTS `user_identity_documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_identity_documents` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `document_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_identity_documents_FK` (`user_id`),
  CONSTRAINT `user_identity_documents_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_identity_documents`
--

LOCK TABLES `user_identity_documents` WRITE;
/*!40000 ALTER TABLE `user_identity_documents` DISABLE KEYS */;
INSERT INTO `user_identity_documents` VALUES (4,1,'Fugit nihil in maio','applications-62a1b3d443c44.ico','2022-06-09 08:48:20'),(6,12,'Passport','mbappe-62a95c043088a.jpg','2022-06-15 04:11:48');
/*!40000 ALTER TABLE `user_identity_documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_leave_balances`
--

DROP TABLE IF EXISTS `user_leave_balances`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_leave_balances` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `leave_id` bigint unsigned DEFAULT NULL,
  `balance` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_leave_balances_FK` (`user_id`),
  KEY `user_leave_balances_FK_1` (`leave_id`),
  CONSTRAINT `user_leave_balances_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_leave_balances_FK_1` FOREIGN KEY (`leave_id`) REFERENCES `leave_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_leave_balances`
--

LOCK TABLES `user_leave_balances` WRITE;
/*!40000 ALTER TABLE `user_leave_balances` DISABLE KEYS */;
INSERT INTO `user_leave_balances` VALUES (1,3,1,5),(2,4,2,23),(3,4,1,10),(4,3,2,23),(5,1,1,11),(6,11,1,15),(7,11,2,15),(8,5,1,15),(9,1,2,30),(10,12,2,24),(11,12,3,14);
/*!40000 ALTER TABLE `user_leave_balances` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_leaves`
--

DROP TABLE IF EXISTS `user_leaves`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_leaves` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `leave_category_id` bigint unsigned DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `count` int DEFAULT NULL,
  `status` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_leaves_FK` (`user_id`),
  KEY `user_leaves_FK_1` (`leave_category_id`),
  CONSTRAINT `user_leaves_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_leaves_FK_1` FOREIGN KEY (`leave_category_id`) REFERENCES `leave_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_leaves`
--

LOCK TABLES `user_leaves` WRITE;
/*!40000 ALTER TABLE `user_leaves` DISABLE KEYS */;
INSERT INTO `user_leaves` VALUES (1,3,2,'2022-05-18','2022-05-18',1,1),(4,3,2,'2022-05-27','2022-05-27',1,1),(5,10,3,'2022-05-17','2022-05-20',3,1),(6,9,3,'2022-05-18','2022-05-23',5,1),(7,8,2,'2022-06-16','2022-06-17',2,2),(8,11,2,'2011-08-05','2016-07-15',3,1),(9,9,2,'1978-10-25','2005-04-25',97,2),(10,12,2,'2022-06-20','2022-07-05',16,1),(11,12,2,'2022-06-17','2022-06-23',6,1),(12,1,1,'2022-06-16','2022-06-21',4,1);
/*!40000 ALTER TABLE `user_leaves` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_payslips`
--

DROP TABLE IF EXISTS `user_payslips`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_payslips` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `year` int DEFAULT NULL,
  `month` int DEFAULT NULL,
  `basic` float(20,2) DEFAULT NULL,
  `overtime` float(20,2) DEFAULT NULL,
  `commision` float(20,2) DEFAULT NULL,
  `epf` float(20,2) DEFAULT NULL,
  `socso` float(20,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_payslips_FK` (`user_id`),
  CONSTRAINT `user_payslips_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_payslips`
--

LOCK TABLES `user_payslips` WRITE;
/*!40000 ALTER TABLE `user_payslips` DISABLE KEYS */;
INSERT INTO `user_payslips` VALUES (1,1,2022,2,2000.00,200.00,3000.00,500.00,23.00),(2,3,2022,5,1500.00,2000.00,0.00,250.00,12.00),(3,9,2022,4,3000.00,250.00,120.00,NULL,NULL),(4,5,2022,1,1500.00,3000.00,0.00,60.00,10.00),(6,12,2022,9,3000.00,300.00,200.00,75.00,NULL),(7,12,2021,2,3000.00,300.00,200.00,75.00,NULL),(8,12,2021,6,2900.00,300.00,200.00,75.00,NULL),(9,12,2021,8,3000.00,900.00,200.00,75.00,NULL),(10,12,2019,8,3000.00,900.00,200.00,75.00,NULL),(11,12,2016,8,3000.00,900.00,200.00,75.00,NULL),(12,12,2016,8,3000.00,900.00,200.00,75.00,NULL),(13,12,2016,8,3000.00,900.00,200.00,75.00,NULL),(14,12,2016,8,3000.00,900.00,200.00,75.00,NULL),(15,12,2016,8,3000.00,900.00,200.00,75.00,NULL),(16,14,2022,8,4500.00,250.00,100.00,50.00,122.00),(17,13,2022,8,4000.00,140.00,50.00,75.00,100.00),(18,1,2021,3,4500.00,250.00,50.00,50.00,122.00),(19,10,2022,8,2500.00,232.00,23.00,150.00,111.00);
/*!40000 ALTER TABLE `user_payslips` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_projects`
--

DROP TABLE IF EXISTS `user_projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_projects` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `project_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `project_description` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_projects_FK` (`user_id`),
  CONSTRAINT `user_projects_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_projects`
--

LOCK TABLES `user_projects` WRITE;
/*!40000 ALTER TABLE `user_projects` DISABLE KEYS */;
INSERT INTO `user_projects` VALUES (1,1,'CCSS','Statementing','2022-05-31','2024-06-28','ONGOING'),(2,10,'Enhancing project monitoring tools','develop a new project monitoring tools','2021-04-15','2021-09-19','NEW'),(4,12,'Decision automation system','An Ai based system that assist project managers in the decision making process','2020-05-17','2020-10-20','NEW');
/*!40000 ALTER TABLE `user_projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_tasks`
--

DROP TABLE IF EXISTS `user_tasks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_tasks` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `task` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `assigned_id` int DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `user_tasks_FK` (`user_id`),
  CONSTRAINT `user_tasks_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_tasks`
--

LOCK TABLES `user_tasks` WRITE;
/*!40000 ALTER TABLE `user_tasks` DISABLE KEYS */;
INSERT INTO `user_tasks` VALUES (1,3,'Drive to Win Finale','2022-05-18','2022-05-22',1,'ON PROGRESS'),(2,9,'reach out to 120 marketing agents','2022-05-18','2022-05-18',NULL,'COMPLETED'),(3,11,'Makan','2022-06-14','2022-06-17',NULL,'COMPLETED'),(4,12,'Gather user requirements (EDD)','2022-06-15','2022-06-17',NULL,'COMPLETED'),(5,5,'Eat Food','2022-09-12','2022-09-30',NULL,'NEW'),(6,5,'Drink Water','2021-09-12','2022-09-30',NULL,'ON PROGRESS'),(7,10,'Watch over the customers','2022-09-13','2022-09-13',NULL,'NEW'),(8,14,'Watch over the customers','2022-09-14','2022-09-14',NULL,'NEW'),(9,13,'Watch over the customers','2022-09-14','2022-09-11',NULL,'NEW');
/*!40000 ALTER TABLE `user_tasks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_vaccinateds`
--

DROP TABLE IF EXISTS `user_vaccinateds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_vaccinateds` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `vaccination_id` bigint unsigned DEFAULT NULL,
  `vaccination_at` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_vaccinateds_FK` (`user_id`),
  KEY `user_vaccinateds_FK_1` (`vaccination_id`),
  CONSTRAINT `user_vaccinateds_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_vaccinateds_FK_1` FOREIGN KEY (`vaccination_id`) REFERENCES `vaccinated_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_vaccinateds`
--

LOCK TABLES `user_vaccinateds` WRITE;
/*!40000 ALTER TABLE `user_vaccinateds` DISABLE KEYS */;
INSERT INTO `user_vaccinateds` VALUES (1,1,1,'2022-06-14'),(2,3,2,'2022-06-14'),(3,12,2,'2022-06-15');
/*!40000 ALTER TABLE `user_vaccinateds` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '4',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin@example.com','1',NULL,'$2y$10$EKtC4pH1..uRk/PYhVmUZ.CvjKSjs8uvD6Wig/SIdamylyWbsNJBG',NULL,NULL,NULL,'2022-04-27 17:37:03','2022-04-27 19:54:04'),(3,'janedoe@example.com','3',NULL,'$2y$10$CHZBsmJbGBbyA1XkvOCi7u7ks/lduojYhMxBoQ6UGU0V9FVfRLCNa',NULL,NULL,NULL,'2022-05-15 14:07:58','2022-05-15 14:07:58'),(4,'lewishamilton@example.com','4',NULL,'$2y$10$JdLIapIdIru3Gxx/3tFwsO4iYFkJjc5.HdnKk7fyf0.zgI7o3CUy6',NULL,NULL,NULL,'2022-05-15 14:55:30','2022-09-11 02:35:11'),(5,'nekomamushi@example.com','4',NULL,'$2y$10$orMgrT0wEvnxjCzvqMeSsuxLDiBwueQB/jXT6ypEekZTrwu.SJ4Je',NULL,NULL,NULL,'2022-05-15 14:56:05','2022-05-15 14:56:05'),(6,'max@example.com','4',NULL,'$2y$10$vRnVdhtw0gH/hqIZTAt81uKmzfguKwBHxDua1Cpc2KpUosauX/Pay',NULL,NULL,NULL,'2022-05-15 14:56:31','2022-05-15 14:56:31'),(7,'landonorris@example.com','4',NULL,'$2y$10$pzPE9VEqYN2EmhItSZ4c6eaCX4Yt6jDBjGZV2YLBKCWedBCWzHXQS',NULL,NULL,NULL,'2022-05-15 14:57:00','2022-05-15 14:57:00'),(8,'pierregasly@example.com','4',NULL,'$2y$10$0tlIaUe24bXdDuupylcbcuJB.EHy/Q12.zup5XEQOKtptU2jaKOgu',NULL,NULL,NULL,'2022-05-15 14:57:31','2022-05-15 14:57:31'),(9,'asaadg236@gmail.com','4',NULL,'$2y$10$1FGo97.120QJSvzQEIWXQeDd3CYN2Mjwyd0E1dO0/KAuBEkZCD87m',NULL,NULL,NULL,'2022-05-15 19:25:04','2022-05-15 19:25:04'),(10,'khalid345@gmail.com','4',NULL,'$2y$10$D1Q39mYqH8sPqb4PCan9nuxFBRylcYHhJRHmD4/vieSJjXRWcw8pG',NULL,NULL,NULL,'2022-05-17 03:38:13','2022-05-17 03:38:13'),(11,'johndoe@example.com','4',NULL,'$2y$10$AZltv4WFbjXawXoMF6t2q.kazwaoKUMTmaHL75C9Q7FwCo3dW979a',NULL,NULL,'8a2yxjIEJNoTS4Vp0GOO15H5NowToTPlD13Qy0PhaJMjdaSx85smMTnP49eD','2022-05-17 03:41:03','2022-06-14 17:50:50'),(12,'asaadgafar1212@gmail.com','4',NULL,'$2y$10$itX6v8r60xywC.3hgoJJr.GNKMlKHjadve.udvZoZnSREOrRRdSkm',NULL,NULL,NULL,'2022-06-14 20:06:33','2022-06-14 20:06:33'),(13,'ahmed.morad005@gmail.com','4',NULL,'$2y$10$Hk/FOBC8W5ChCPkR8ToTUOHe/bcquVx9ZgVvNPjsqumvlyD25dW5.',NULL,NULL,NULL,'2022-09-13 22:46:53','2022-09-13 22:46:53'),(14,'abdulrahamn.113@gmail.com','4',NULL,'$2y$10$NQV5xu9E/v6dPO2Ro.rLFOXsRryqa3Uer/BYmMDWOxIiphW.Xtud.',NULL,NULL,NULL,'2022-09-13 22:48:25','2022-09-13 22:48:25'),(15,'assad@gmail.com','4',NULL,'$2y$10$V6Xj6BJA8.Wa6tKKBjwWb.oeQnZVMFvDSNrvhawPKfaKcZPaKP8Rq',NULL,NULL,NULL,'2022-09-14 07:30:03','2022-09-14 07:30:03'),(16,'asaadgafar6@gmail.com','4',NULL,'$2y$10$itYBRkInIe2ejTOK2PjE8uQSmfcYoT95jUvYcS4j9zHc5cKB8EvSS',NULL,NULL,NULL,'2022-09-14 07:40:15','2022-09-14 07:40:15');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vaccinated_categories`
--

DROP TABLE IF EXISTS `vaccinated_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vaccinated_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vaccinated_categories`
--

LOCK TABLES `vaccinated_categories` WRITE;
/*!40000 ALTER TABLE `vaccinated_categories` DISABLE KEYS */;
INSERT INTO `vaccinated_categories` VALUES (1,'Vaccinated'),(2,'Fully Vaccinated');
/*!40000 ALTER TABLE `vaccinated_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'ehr'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-09-14 23:42:55
