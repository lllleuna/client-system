-- MySQL dump 10.13  Distrib 8.4.3, for Win64 (x86_64)
--
-- Host: localhost    Database: otc_mis
-- ------------------------------------------------------
-- Server version	8.4.3

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
-- Table structure for table `app_awards`
--

DROP TABLE IF EXISTS `app_awards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `app_awards` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `application_id` bigint unsigned NOT NULL,
  `entry_year` year NOT NULL,
  `awarding_body` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nature_of_award` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_received` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `app_awards_application_id_foreign` (`application_id`),
  CONSTRAINT `app_awards_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `applications` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_awards`
--

LOCK TABLES `app_awards` WRITE;
/*!40000 ALTER TABLE `app_awards` DISABLE KEYS */;
INSERT INTO `app_awards` VALUES (7,20,2025,'City Hall','Best in Math','2025-03-14','2025-03-19 13:05:05','2025-03-19 13:05:05'),(8,32,2025,'sdffghj','uhjgnb','2025-03-03','2025-03-23 04:51:58','2025-03-23 04:51:58');
/*!40000 ALTER TABLE `app_awards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_businesses`
--

DROP TABLE IF EXISTS `app_businesses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `app_businesses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `application_id` bigint unsigned NOT NULL,
  `entry_year` year NOT NULL,
  `type` enum('Proposed','Existing') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nature_of_business` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `starting_capital` decimal(15,2) DEFAULT NULL,
  `capital_to_date` decimal(15,2) DEFAULT NULL,
  `years_of_existence` int DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `app_businesses_application_id_foreign` (`application_id`),
  CONSTRAINT `app_businesses_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `applications` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_businesses`
--

LOCK TABLES `app_businesses` WRITE;
/*!40000 ALTER TABLE `app_businesses` DISABLE KEYS */;
INSERT INTO `app_businesses` VALUES (2,32,2025,'Proposed','nature',500000.00,50000.00,1,NULL,NULL,'2025-03-23 04:51:58','2025-03-23 04:51:58');
/*!40000 ALTER TABLE `app_businesses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_cetos`
--

DROP TABLE IF EXISTS `app_cetos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `app_cetos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `application_id` bigint unsigned NOT NULL,
  `entry_year` year NOT NULL,
  `members_with` int DEFAULT NULL,
  `members_without` int DEFAULT NULL,
  `total` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `app_cetos_application_id_foreign` (`application_id`),
  CONSTRAINT `app_cetos_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `applications` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_cetos`
--

LOCK TABLES `app_cetos` WRITE;
/*!40000 ALTER TABLE `app_cetos` DISABLE KEYS */;
INSERT INTO `app_cetos` VALUES (1,13,2025,1,2,3,'2025-03-19 11:41:42','2025-03-19 11:41:42'),(8,20,2025,2,1,3,'2025-03-19 13:05:05','2025-03-19 13:05:05'),(9,22,2025,5,0,5,'2025-03-19 19:15:16','2025-03-19 19:15:16'),(10,32,2025,324356,0,2,'2025-03-23 04:51:58','2025-03-23 04:51:58');
/*!40000 ALTER TABLE `app_cetos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_finances`
--

DROP TABLE IF EXISTS `app_finances`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `app_finances` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `application_id` bigint unsigned NOT NULL,
  `entry_year` year NOT NULL,
  `current_assets` decimal(15,2) DEFAULT NULL,
  `noncurrent_assets` decimal(15,2) DEFAULT NULL,
  `total_assets` decimal(15,2) DEFAULT NULL,
  `coop_type` enum('Micro','Small','Medium','Large') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `liabilities` decimal(15,2) DEFAULT NULL,
  `members_equity` decimal(15,2) DEFAULT NULL,
  `total_gross_revenues` decimal(15,2) DEFAULT NULL,
  `total_expenses` decimal(15,2) DEFAULT NULL,
  `net_surplus` decimal(15,2) DEFAULT NULL,
  `initial_auth_capital_share` decimal(15,2) DEFAULT NULL,
  `present_auth_capital_share` decimal(15,2) DEFAULT NULL,
  `subscribed_capital_share` decimal(15,2) DEFAULT NULL,
  `paid_up_capital` decimal(15,2) DEFAULT NULL,
  `capital_build_up_scheme` decimal(15,2) DEFAULT NULL,
  `general_reserve_fund` decimal(15,2) DEFAULT NULL,
  `education_training_fund` decimal(15,2) DEFAULT NULL,
  `community_dev_fund` decimal(15,2) DEFAULT NULL,
  `optional_fund` decimal(15,2) DEFAULT NULL,
  `share_capital_interest` decimal(15,2) DEFAULT NULL,
  `patronage_refund` decimal(15,2) DEFAULT NULL,
  `others` decimal(15,2) DEFAULT NULL,
  `total` decimal(15,2) DEFAULT NULL,
  `deficit_from_financial_aspect` decimal(15,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `app_finances_application_id_foreign` (`application_id`),
  CONSTRAINT `app_finances_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `applications` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_finances`
--

LOCK TABLES `app_finances` WRITE;
/*!40000 ALTER TABLE `app_finances` DISABLE KEYS */;
INSERT INTO `app_finances` VALUES (1,20,2025,13500.00,0.00,13500.00,'Micro',100000.00,3000.00,10500.00,100000.00,-89500.00,0.00,0.00,0.00,3000.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,-89500.00,89500.00,'2025-03-19 13:05:05','2025-03-19 13:05:05'),(2,21,2025,0.00,0.00,0.00,'Micro',0.00,NULL,0.00,0.00,0.00,0.00,0.00,0.00,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,'2025-03-19 18:42:26','2025-03-19 18:42:26'),(3,22,2025,12500.00,0.00,12500.00,'Micro',100000.00,2500.00,10000.00,100000.00,-90000.00,0.00,0.00,0.00,2500.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,-90000.00,90000.00,'2025-03-19 19:15:16','2025-03-19 19:15:16'),(4,23,2025,0.00,0.00,0.00,'Micro',0.00,NULL,0.00,0.00,0.00,0.00,0.00,0.00,NULL,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,'2025-03-22 06:55:41','2025-03-22 06:55:41'),(5,24,2025,1000.00,0.00,1000.00,'Micro',0.00,1000.00,0.00,0.00,0.00,0.00,0.00,0.00,1000.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,'2025-03-22 20:32:50','2025-03-22 20:32:50');
/*!40000 ALTER TABLE `app_finances` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_franchises`
--

DROP TABLE IF EXISTS `app_franchises`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `app_franchises` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `application_id` bigint unsigned NOT NULL,
  `entry_year` year NOT NULL,
  `route` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cpc_case_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_of_franchise` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mode_of_service` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_of_unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `validity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `app_franchises_application_id_foreign` (`application_id`),
  CONSTRAINT `app_franchises_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `applications` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_franchises`
--

LOCK TABLES `app_franchises` WRITE;
/*!40000 ALTER TABLE `app_franchises` DISABLE KEYS */;
INSERT INTO `app_franchises` VALUES (5,13,2025,'Makati City - Taguig','LTFRB0012-983-21109',NULL,NULL,'PUJ TRADITIONAL','2026-02-12',NULL,'2025-03-19 11:41:42','2025-03-19 11:41:42'),(6,13,2025,'Pateros - Taguig','LTFRB0012-983-211',NULL,NULL,'UV EXPRESS TRADITIONAL','2028-12-12',NULL,'2025-03-19 11:41:42','2025-03-19 11:41:42'),(37,20,2025,'Manila - Pasig','LTFRB8553109',NULL,NULL,'VAN (TOURIST)','2026-09-15',NULL,'2025-03-19 13:05:05','2025-03-19 13:05:05'),(38,20,2025,'Makati City - Taguig City','LTFRB0012-983-211',NULL,NULL,'PUJ TRADITIONAL','2026-12-02',NULL,'2025-03-19 13:05:05','2025-03-19 13:05:05'),(39,20,2025,'Makati City - Pasig','LTFRB0012-983-211',NULL,NULL,'PUJ TRADITIONAL','2026-10-20',NULL,'2025-03-19 13:05:05','2025-03-19 13:05:05'),(40,20,2025,'Makati City - Taguig','LTFRB032-983-21109',NULL,NULL,'PUJ TRADITIONAL','2026-02-02',NULL,'2025-03-19 13:05:05','2025-03-19 13:05:05'),(41,20,2025,'Makati City - Taguig','LTFRB032-983-21109',NULL,NULL,'PUJ TRADITIONAL','2026-02-02',NULL,'2025-03-19 13:05:05','2025-03-19 13:05:05'),(42,22,2025,'Pateros - Pateros','LTFRB5732960',NULL,NULL,'VAN (TOURIST)','2027-12-25',NULL,'2025-03-19 19:15:16','2025-03-19 19:15:16'),(43,22,2025,'Guadalupe - Taft','LTFRB-41231',NULL,NULL,'BUS','2027-11-22',NULL,'2025-03-19 19:15:16','2025-03-19 19:15:16'),(44,22,2025,'Guadalupe - North Ave','LTFRB-41232',NULL,NULL,'BUS','2027-05-06',NULL,'2025-03-19 19:15:16','2025-03-19 19:15:16'),(45,22,2025,'Guadalupe - Pasay','LTFRB-41233',NULL,NULL,'PUJ TRADITIONAL','2026-01-01',NULL,'2025-03-19 19:15:16','2025-03-19 19:15:16'),(46,24,2025,'Antipolo - Antipolo','LTFRB1943118',NULL,NULL,'TRUCK','2025-11-28',NULL,'2025-03-22 20:32:50','2025-03-22 20:32:50'),(47,24,2025,'Makati - Taguig City','LTFRB0012-983-211',NULL,NULL,'PUJ TRADITIONAL','2025-04-03',NULL,'2025-03-22 20:32:50','2025-03-22 20:32:50'),(56,32,2025,'makati - kjniuhknkj','59545',NULL,NULL,'PUJ TRADITIONAL','2025-03-19',NULL,'2025-03-23 04:51:58','2025-03-23 04:51:58'),(57,32,2025,'wadfg - dxfcgvhb','59545',NULL,NULL,'VAN (TOURIST)','2025-03-26',NULL,'2025-03-23 04:51:58','2025-03-23 04:51:58');
/*!40000 ALTER TABLE `app_franchises` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_general_info`
--

DROP TABLE IF EXISTS `app_general_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `app_general_info` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `application_id` bigint unsigned NOT NULL,
  `entry_year` year NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `accreditation_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cda_registration_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cda_registration_date` date DEFAULT NULL,
  `common_bond_membership` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `membership_fee` int DEFAULT '0',
  `area` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `region` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `province` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `barangay` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employer_sss_reg_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employer_pagibig_reg_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employer_philhealth_reg_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sss_enrolled` tinyint(1) DEFAULT NULL,
  `pagibig_enrolled` tinyint(1) DEFAULT NULL,
  `philhealth_enrolled` tinyint(1) DEFAULT NULL,
  `bir_tin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bir_tax_exemption_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `validity` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `app_general_info_application_id_foreign` (`application_id`),
  CONSTRAINT `app_general_info_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `applications` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_general_info`
--

LOCK TABLES `app_general_info` WRITE;
/*!40000 ALTER TABLE `app_general_info` DISABLE KEYS */;
INSERT INTO `app_general_info` VALUES (6,13,2025,'Schultz-Rogahn Cooperative','LLC',NULL,'T-30042618','1974-09-12','et',1230,'Lemke Overpass','Hawaii','Lake Eldon','Rhode Island','Chelsea Fall','74101 Fanny Cliff\nCarmelview, NJ 17635-5412','stamm.kaitlin@example.com','1-970-827-6776',NULL,NULL,NULL,4,4,3,NULL,NULL,NULL,'2025-03-19 11:41:42','2025-03-19 11:41:42'),(13,20,2025,'McDermott-Terry',NULL,NULL,'T-56465564','2023-02-21','One type',400,NULL,NULL,NULL,NULL,NULL,'123B Asd','edythe.goldner@example.net','639568969801','SS-423223421','PG-23423231','PH-234452200',3,4,3,'TN-000291232','EX-0232022',NULL,'2025-03-19 13:05:05','2025-03-19 13:05:05'),(14,22,2025,'Quitzon-Nader','Inc',NULL,'T-77796238','1984-09-22','soluta',520,'Littel Terrace','Alaska','Lake Wilhelm','Montana','Kshlerin Club','836 Lauriane ForgesAricland, NM 74460-4481','emanuel92@example.com','639875498756','SSS-12341234','P-12341234','PH-12341234',5,5,5,'TN-12341234','EX-12341234',NULL,'2025-03-19 19:15:16','2025-03-19 19:15:16'),(15,23,2025,'Johns, Schultz and Conroy','Inc',NULL,'T-41067673','1975-09-19','Residential',500,'Jacobson Groves','Florida','Makati City','Montana','Rahsaan Well','12650 O\'Conner PassagePort Bernice, CA 94025','hemmerich@example.com','(929) 818-5167','1231','132','123132131',0,0,0,'N/A','N/A',NULL,'2025-03-22 06:55:40','2025-03-22 15:10:05'),(16,24,2025,'Hermiston, O\'Keefe and McClure',NULL,NULL,'T-35938882','2024-02-24','Associational',458,'luzon','130000000',NULL,NULL,'137602015','123 Block Street','zemlak.kyleigh@example.com','639528754558','12-2342234-2','1254-8965-9896','12-666666599-2',4,4,3,'123-456-456-412','EXMP-34242-2347',NULL,'2025-03-22 20:32:50','2025-03-22 20:32:50'),(21,32,2025,'Tara Cooperative',NULL,NULL,'T-00056422','2025-03-21','Residential',0,'luzon','020000000','N/A','025000000','021510018','143 Lawton','john.hoho@gmail.com','639520350481','12-2322323-1','1215-2121-2121','12-121211199-2',2,2,2,'121-121-564-234','EXMP-45697-2324',NULL,'2025-03-23 04:51:58','2025-03-23 13:13:02');
/*!40000 ALTER TABLE `app_general_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_governance`
--

DROP TABLE IF EXISTS `app_governance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `app_governance` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `application_id` bigint unsigned NOT NULL,
  `entry_year` year NOT NULL,
  `role_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `middle_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `suffix` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `term_start` date DEFAULT NULL,
  `term_end` date DEFAULT NULL,
  `mobile_number` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `app_governance_application_id_foreign` (`application_id`),
  CONSTRAINT `app_governance_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `applications` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_governance`
--

LOCK TABLES `app_governance` WRITE;
/*!40000 ALTER TABLE `app_governance` DISABLE KEYS */;
INSERT INTO `app_governance` VALUES (3,13,2025,'Chairperson','Carlos',NULL,'Antonio',NULL,'2023-01-20','2026-11-25','639879856489','carlos@gmail.com','2025-03-19 11:41:42','2025-03-19 11:41:42'),(16,20,2025,'Chairperson','test name','Villaroya','test naem',NULL,'2020-12-09','2025-12-09','639896589874','test123@gmail.com','2025-03-19 13:05:05','2025-03-19 13:05:05'),(17,20,2025,'Vice Chairperson','12test',NULL,'12test',NULL,'2025-03-22','2026-03-22','639875412451','123test@gmail.com','2025-03-19 13:05:05','2025-03-19 13:05:05'),(18,21,2025,'Board Member','Dylan','Nickolas','Sauer',NULL,'2020-05-18','2022-05-18','725-372-8740','evert45@example.org','2025-03-19 18:42:26','2025-03-19 18:42:26'),(19,22,2025,'Vice Chairperson','Irving','Alisha','Boyer',NULL,'2023-06-01','2028-06-01','639879654123','cleve39@example.net','2025-03-19 19:15:16','2025-03-19 19:15:16'),(20,22,2025,'Chairperson','Chair1','Chair1','Chair1',NULL,'2024-10-25','2025-10-25','639875987654','chair1@gmail.com','2025-03-19 19:15:16','2025-03-19 19:15:16'),(21,23,2025,'Board Member','Nicole','Kaden','Shields',NULL,'2024-10-24','2025-10-24','864.269.9679','elockman@example.org','2025-03-22 06:55:41','2025-03-22 06:55:41'),(22,24,2025,'Board Secretary','Madisen','Tod','VonRueden',NULL,'2023-07-21','2027-07-21','639521002158','eddie.mante@example.org','2025-03-22 20:32:50','2025-03-22 20:32:50'),(23,24,2025,'GAD Committee Member','Leunamme Rose','Villaroya','Atutubo',NULL,'2025-03-27','2025-04-02','639954278144','GDFGHD@gmail.com','2025-03-22 20:32:50','2025-03-22 20:32:50'),(29,32,2025,'GAD Committee Secretary','Leunamme Rose','sdfgh','sdfghkjhgf',NULL,'2025-04-02','2025-04-02','639856420236','asdfg@gmail.com','2025-03-23 04:51:58','2025-03-23 04:51:58');
/*!40000 ALTER TABLE `app_governance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_grants`
--

DROP TABLE IF EXISTS `app_grants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `app_grants` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `application_id` bigint unsigned NOT NULL,
  `entry_year` year NOT NULL,
  `date_acquired` date DEFAULT NULL,
  `amount` decimal(15,2) DEFAULT NULL,
  `source` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `app_grants_application_id_foreign` (`application_id`),
  CONSTRAINT `app_grants_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `applications` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_grants`
--

LOCK TABLES `app_grants` WRITE;
/*!40000 ALTER TABLE `app_grants` DISABLE KEYS */;
INSERT INTO `app_grants` VALUES (16,20,2025,'2023-12-09',100000.00,'ABC Company',NULL,'2025-03-19 13:05:05','2025-03-19 13:05:05'),(17,20,2025,'2025-03-19',205000.00,'XYZ Inc.',NULL,'2025-03-19 13:05:05','2025-03-19 13:05:05'),(18,20,2025,'2025-03-19',50500.00,'ASD Corporation',NULL,'2025-03-19 13:05:05','2025-03-19 13:05:05'),(19,22,2025,'2025-01-05',200000.00,'City Hall ng Makati',NULL,'2025-03-19 19:15:16','2025-03-19 19:15:16'),(20,32,2025,'2025-03-18',52300.00,'wertyu','dfghjk','2025-03-23 04:51:58','2025-03-23 04:51:58');
/*!40000 ALTER TABLE `app_grants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_loans`
--

DROP TABLE IF EXISTS `app_loans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `app_loans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `application_id` bigint unsigned NOT NULL,
  `entry_year` year NOT NULL,
  `financing_institution` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acquired_at` date DEFAULT NULL,
  `amount` decimal(15,2) DEFAULT NULL,
  `utilization` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `app_loans_application_id_foreign` (`application_id`),
  CONSTRAINT `app_loans_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `applications` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_loans`
--

LOCK TABLES `app_loans` WRITE;
/*!40000 ALTER TABLE `app_loans` DISABLE KEYS */;
INSERT INTO `app_loans` VALUES (3,13,2025,'Borer, Kemmer and Murazik','1986-07-04',416364.39,'Est rerum sint maiores est natus.','Suscipit illum rem quam quam nemo maiores recusandae.','2025-03-19 11:41:42','2025-03-19 11:41:42'),(16,20,2025,'METROBANK','2023-03-05',50000.00,'Units Modernization',NULL,'2025-03-19 13:05:05','2025-03-19 13:05:05'),(17,20,2025,'METROBANK','2025-01-02',100000.00,'Re-Lending to Members',NULL,'2025-03-19 13:05:05','2025-03-19 13:05:05'),(18,21,2025,'Reilly Ltd','1995-06-13',38600.05,'Nulla consequuntur maiores rerum.','Ad corrupti velit possimus aspernatur.','2025-03-19 18:42:26','2025-03-19 18:42:26'),(19,22,2025,'DBP','2025-01-20',100000.00,'Unit Buying',NULL,'2025-03-19 19:15:16','2025-03-19 19:15:16'),(20,32,2025,'swdfghjk','2025-03-05',1234567.00,'dfghj','dfghm','2025-03-23 04:51:58','2025-03-23 04:51:58');
/*!40000 ALTER TABLE `app_loans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_trainings_list`
--

DROP TABLE IF EXISTS `app_trainings_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `app_trainings_list` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `application_id` bigint unsigned NOT NULL,
  `entry_year` year NOT NULL,
  `title_of_training` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_of_attendees` int NOT NULL DEFAULT '0',
  `total_fund` decimal(12,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `app_trainings_list_application_id_foreign` (`application_id`),
  CONSTRAINT `app_trainings_list_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `applications` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_trainings_list`
--

LOCK TABLES `app_trainings_list` WRITE;
/*!40000 ALTER TABLE `app_trainings_list` DISABLE KEYS */;
INSERT INTO `app_trainings_list` VALUES (2,32,2025,'kjhrtgh',324356,254364757.00,'2025-03-23 04:51:58','2025-03-23 04:51:58');
/*!40000 ALTER TABLE `app_trainings_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_units`
--

DROP TABLE IF EXISTS `app_units`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `app_units` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `application_id` bigint unsigned NOT NULL,
  `entry_year` year NOT NULL,
  `mode_of_service` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_of_unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cooperatively_owned` int DEFAULT '0',
  `individually_owned` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `app_units_application_id_foreign` (`application_id`),
  CONSTRAINT `app_units_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `applications` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_units`
--

LOCK TABLES `app_units` WRITE;
/*!40000 ALTER TABLE `app_units` DISABLE KEYS */;
INSERT INTO `app_units` VALUES (5,13,2025,NULL,'PUJ TRADITIONAL',1,0,'2025-03-19 11:41:42','2025-03-19 11:41:42'),(6,13,2025,NULL,'UV EXPRESS TRADITIONAL',1,0,'2025-03-19 11:41:42','2025-03-19 11:41:42'),(19,20,2025,NULL,'VAN (TOURIST)',1,0,'2025-03-19 13:05:05','2025-03-19 13:05:05'),(20,20,2025,NULL,'PUJ TRADITIONAL',2,2,'2025-03-19 13:05:05','2025-03-19 13:05:05'),(21,22,2025,NULL,'VAN (TOURIST)',0,1,'2025-03-19 19:15:16','2025-03-19 19:15:16'),(22,22,2025,NULL,'BUS',2,0,'2025-03-19 19:15:16','2025-03-19 19:15:16'),(23,22,2025,NULL,'PUJ TRADITIONAL',0,1,'2025-03-19 19:15:16','2025-03-19 19:15:16'),(24,24,2025,NULL,'TRUCK',1,0,'2025-03-22 20:32:50','2025-03-22 20:32:50'),(25,24,2025,NULL,'PUJ TRADITIONAL',1,0,'2025-03-22 20:32:50','2025-03-22 20:32:50'),(34,32,2025,NULL,'PUJ TRADITIONAL',1,0,'2025-03-23 04:51:58','2025-03-23 04:51:58'),(35,32,2025,NULL,'VAN (TOURIST)',0,1,'2025-03-23 04:51:58','2025-03-23 04:51:58');
/*!40000 ALTER TABLE `app_units` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `application_status_histories`
--

DROP TABLE IF EXISTS `application_status_histories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `application_status_histories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `application_id` bigint unsigned NOT NULL,
  `status` enum('new','saved','evaluated','approved','rejected','needs_info','released') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci,
  `updated_by` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `application_status_histories_application_id_foreign` (`application_id`),
  KEY `application_status_histories_updated_by_foreign` (`updated_by`),
  CONSTRAINT `application_status_histories_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `applications` (`id`) ON DELETE CASCADE,
  CONSTRAINT `application_status_histories_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `application_status_histories`
--

LOCK TABLES `application_status_histories` WRITE;
/*!40000 ALTER TABLE `application_status_histories` DISABLE KEYS */;
INSERT INTO `application_status_histories` VALUES (1,13,'saved',NULL,7,'2025-03-19 17:47:16','2025-03-19 17:47:16'),(2,13,'evaluated',NULL,7,'2025-03-19 17:47:40','2025-03-19 17:47:40'),(3,13,'needs_info','o',7,'2025-03-19 17:51:30','2025-03-19 17:51:30'),(4,20,'saved','ok',1,'2025-03-19 18:13:01','2025-03-19 18:13:01'),(5,20,'evaluated','ok na to',1,'2025-03-19 18:30:58','2025-03-19 18:30:58'),(6,22,'saved','Okay',7,'2025-03-19 23:57:19','2025-03-19 23:57:19'),(7,22,'saved','Ask for supporting documents.\r\n- Financial Statement\r\n- CDA Certificate',7,'2025-03-20 00:08:35','2025-03-20 00:08:35'),(8,22,'evaluated','Asked for supporting documents.\r\n- Financial Statement\r\n- CDA Certificate\r\n\r\nDone.',7,'2025-03-20 00:09:20','2025-03-20 00:09:20'),(12,22,'approved','ok ok',7,'2025-03-20 11:35:00','2025-03-20 11:35:00'),(13,21,'saved','- Email TC for additional Document\r\n- Has Discrepancy',7,'2025-03-21 04:05:29','2025-03-21 04:05:29'),(14,20,'approved','okay',7,'2025-03-21 04:07:50','2025-03-21 04:07:50'),(15,21,'saved','- Email TC for additional Document\r\n- Has Discrepancy',7,'2025-03-22 14:14:18','2025-03-22 14:14:18'),(16,21,'saved','- Email TC for additional Document\r\n- Has Discrepancy',7,'2025-03-22 14:28:12','2025-03-22 14:28:12'),(17,21,'saved','test 10:32',7,'2025-03-22 14:32:13','2025-03-22 14:32:13'),(18,21,'saved','test 10:35',7,'2025-03-22 14:35:41','2025-03-22 14:35:41'),(19,21,'saved','test 10:35',7,'2025-03-22 14:37:57','2025-03-22 14:37:57'),(20,21,'saved','test 10:35',7,'2025-03-22 14:39:13','2025-03-22 14:39:13'),(21,21,'saved','test 10:35',7,'2025-03-22 14:39:30','2025-03-22 14:39:30'),(22,21,'saved','test 10:43',7,'2025-03-22 14:43:53','2025-03-22 14:43:53'),(23,21,'saved','test 10:43',7,'2025-03-22 14:48:21','2025-03-22 14:48:21'),(24,21,'saved','qweqweqe',7,'2025-03-22 14:48:58','2025-03-22 14:48:58'),(25,23,'saved','test 10:58',7,'2025-03-22 14:58:21','2025-03-22 14:58:21'),(26,23,'saved','test 10:58',7,'2025-03-22 15:06:17','2025-03-22 15:06:17'),(27,23,'saved','test 10:58',7,'2025-03-22 15:07:25','2025-03-22 15:07:25'),(28,23,'saved','test 10:58',7,'2025-03-22 15:09:01','2025-03-22 15:09:01'),(29,23,'saved','test 10:58',7,'2025-03-22 15:09:54','2025-03-22 15:09:54'),(30,23,'evaluated','test 10:58',7,'2025-03-22 15:10:05','2025-03-22 15:10:05'),(31,23,'approved','ok',7,'2025-03-22 15:10:31','2025-03-22 15:10:31'),(32,32,'saved','ok',1,'2025-03-23 13:13:02','2025-03-23 13:13:02'),(33,32,'saved','ok',1,'2025-03-23 13:13:14','2025-03-23 13:13:14'),(34,32,'evaluated','ok',1,'2025-03-23 13:13:24','2025-03-23 13:13:24'),(35,32,'approved','okay',7,'2025-03-23 13:14:18','2025-03-23 13:14:18'),(36,23,'released','asdf',7,'2025-03-23 13:53:44','2025-03-23 13:53:44'),(37,23,'released','fn',7,'2025-03-23 13:54:30','2025-03-23 13:54:30'),(38,20,'approved','sdfghnm',7,'2025-03-23 14:59:12','2025-03-23 14:59:12'),(39,20,'approved','sdfghnm',7,'2025-03-23 14:59:47','2025-03-23 14:59:47');
/*!40000 ALTER TABLE `application_status_histories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `applications`
--

DROP TABLE IF EXISTS `applications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `applications` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint NOT NULL,
  `tc_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cda_reg_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cda_reg_date` date NOT NULL,
  `area` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `region` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `province` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city_municipality` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barangay` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('new','saved','evaluated','approved','rejected','needs_info','released') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `evaluated_by` bigint unsigned DEFAULT NULL,
  `approved_by` bigint unsigned DEFAULT NULL,
  `application_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `file_upload` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci,
  `release_message` text COLLATE utf8mb4_unicode_ci,
  `consent` tinyint(1) NOT NULL DEFAULT '0',
  `oath` tinyint(1) DEFAULT '0',
  `reference_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `applications_evaluated_by_foreign` (`evaluated_by`),
  KEY `applications_approved_by_foreign` (`approved_by`),
  CONSTRAINT `applications_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `applications_evaluated_by_foreign` FOREIGN KEY (`evaluated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `applications`
--

LOCK TABLES `applications` WRITE;
/*!40000 ALTER TABLE `applications` DISABLE KEYS */;
INSERT INTO `applications` VALUES (13,2,'Schultz-Rogahn Cooperative','T-30042618','2022-02-02','luzon','010000000','012800000','012817000','012817016','83 Block 4','needs_info',7,7,'accreditation','2025-03-19 11:41:42','2025-03-19 17:51:30','uploads/hVDpvnQoqLNWv3fHv9Tqw5eHxVV6W9Bs7bHCCAuQ.jpg',NULL,NULL,1,1,'APP-000013'),(20,3,'McDermott-Terry','T-56465564','2023-12-20','luzon','010000000','012800000','012801000','012801001','123 blok','evaluated',1,7,'accreditation','2025-03-19 13:05:05','2025-03-20 08:49:55','uploads/jZnomfsKGqGoAU6X7uavqL0f8N0i934WZxP4dLzx.png',NULL,NULL,1,1,'APP-000020'),(21,4,'Pfannerstill, Farrell and Mills','T-83129986','2020-12-20','visayas','080000000','086000000','082614000','082614012','123 xcvb','saved',7,NULL,'accreditation','2025-03-19 18:42:26','2025-03-21 04:05:29','uploads/stWKlmVlPBh6uy7qqtndcjKiMnpBerboaAAgphGF.png','oks',NULL,1,1,'APP-000021'),(22,6,'Quitzon-Nader','T-77796238','2024-12-02','luzon','130000000',NULL,'137602000','137602009','123 xcvb','released',7,7,'accreditation','2025-03-19 19:15:16','2025-03-20 11:42:57','uploads/hRaDzqwHBRP0fvjgEoRDQCoMymaYhpeFNDDspka4.pdf',NULL,'okokokok ooo',1,1,'APP-000022'),(23,7,'Johns, Schultz and Conroy','T-41067673','2025-03-20','luzon','020000000','020900000','021510000','021510017','83 Block 4 Extension West Rembo','released',7,7,'accreditation','2025-03-22 06:55:40','2025-03-23 13:54:30','uploads/fsMHWNCWS8D9sMx8D52nHLXJZ1epekwGehOQhafp.png',NULL,'fn',1,1,'APP-000023'),(24,11,'Hermiston, O\'Keefe and McClure','T-35938882','2024-06-29','luzon','130000000',NULL,'137602000','137602015','83 Block 4 Extension West Rembo','new',NULL,NULL,'accreditation','2025-03-22 20:32:50','2025-03-22 20:32:50','uploads/oMtfT2DSB9TYiHxbcoqBnYHlxANvopPws2q9UQt8.pdf','3 23 2025, 12:33',NULL,1,1,'APP-000024'),(32,42,'Tara Cooperative','T-00056422','2025-03-20','luzon','020000000','025000000','021510000','021510018','45678ghjk','released',1,7,'accreditation','2025-03-23 04:51:58','2025-03-23 13:26:28','uploads/GKlE8nf6s4JIWLymef3xZVdoe9Jtwqld3jDxkEm2.jpg',NULL,'dfg',1,1,'APP-000032'),(34,42,'Tara Cooperative','T-00056422','2025-03-21','area','region','province','city','barangay','143 Lawton','new',NULL,NULL,'CGS Renewal','2025-03-24 11:17:03','2025-03-24 11:17:03','uploads/fqiNZMtCZGHIgks2qNV2RbTXzFr9VNhU63ruYnUg.pdf',NULL,NULL,1,1,'RNW-491760');
/*!40000 ALTER TABLE `applications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `backup_histories`
--

DROP TABLE IF EXISTS `backup_histories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `backup_histories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `backup_histories_created_by_foreign` (`created_by`),
  CONSTRAINT `backup_histories_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `backup_histories`
--

LOCK TABLES `backup_histories` WRITE;
/*!40000 ALTER TABLE `backup_histories` DISABLE KEYS */;
/*!40000 ALTER TABLE `backup_histories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `businesses`
--

DROP TABLE IF EXISTS `businesses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `businesses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `accreditation_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entry_year` year NOT NULL,
  `type` enum('Proposed','Existing') COLLATE utf8mb4_unicode_ci NOT NULL,
  `nature_of_business` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `starting_capital` decimal(15,2) NOT NULL,
  `capital_to_date` decimal(15,2) NOT NULL,
  `years_of_existence` int NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `businesses_accreditation_no_foreign` (`accreditation_no`),
  CONSTRAINT `businesses_accreditation_no_foreign` FOREIGN KEY (`accreditation_no`) REFERENCES `general_info` (`accreditation_no`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `businesses`
--

LOCK TABLES `businesses` WRITE;
/*!40000 ALTER TABLE `businesses` DISABLE KEYS */;
INSERT INTO `businesses` VALUES (1,'2001-170843',2007,'Proposed','Schmitt, Frami and Auer',634492.10,2863329.60,18,'Inactive','Enim numquam mollitia impedit corporis.','2025-03-19 08:04:16','2025-03-19 08:04:16'),(2,'2009-235166',2001,'Existing','Schuppe, Rolfson and Price',811345.22,928145.36,6,'Inactive','Eos fugit consequatur quo officia.','2025-03-19 08:04:16','2025-03-19 08:04:16'),(3,'2006-854073',1987,'Existing','Beahan LLC',378052.00,1892088.62,4,'Suspended','Facere necessitatibus qui nemo ipsum eius eligendi eaque sed.','2025-03-19 08:04:16','2025-03-19 08:04:16'),(4,'2012-780778',1973,'Existing','Bednar Group',824027.96,2671467.86,48,'Suspended','Repudiandae doloribus amet ut quidem laborum.','2025-03-19 08:04:17','2025-03-19 08:04:17'),(5,'2005-440858',2002,'Proposed','Champlin-Jakubowski',126157.59,4821686.36,7,'Inactive','Voluptate exercitationem qui rem harum occaecati earum debitis.','2025-03-19 08:04:17','2025-03-19 08:04:17'),(6,'2011-198739',1972,'Proposed','Greenholt, VonRueden and Aufderhar',871789.50,3428179.96,40,'Active','Dolorem iusto quasi labore expedita.','2025-03-19 08:04:17','2025-03-19 08:04:17'),(7,'2004-352799',2011,'Existing','Baumbach-Kris',793282.29,4279411.72,19,'Active','Qui laboriosam voluptatem mollitia eos commodi dolore omnis accusantium.','2025-03-19 08:04:17','2025-03-19 08:04:17'),(8,'2019-121166',2003,'Proposed','Carter Ltd',841119.59,1429436.42,49,'Inactive','Sed excepturi doloremque vitae praesentium totam.','2025-03-19 08:04:17','2025-03-19 08:04:17'),(9,'2005-868967',1994,'Proposed','Denesik, Ledner and Ortiz',664540.80,2428455.05,13,'Inactive','Ut neque vitae ut quia fugiat ratione.','2025-03-19 08:04:18','2025-03-19 08:04:18'),(10,'2020-587898',1996,'Proposed','West LLC',795742.40,1022467.14,1,'Inactive','Sed et vel minima dolorem.','2025-03-19 08:04:18','2025-03-19 08:04:18');
/*!40000 ALTER TABLE `businesses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` VALUES ('login-attempts:john.ho@gmail.com','i:2;',1742846544),('login-attempts:john.ho@gmail.com:timer','i:1742846544;',1742846544),('login-attempts:john.hoho@gmail.com','i:1;',1742832742),('login-attempts:john.hoho@gmail.com:timer','i:1742832742;',1742832742);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
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
-- Table structure for table `cetos`
--

DROP TABLE IF EXISTS `cetos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cetos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `accreditation_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entry_year` year NOT NULL,
  `members_with` int NOT NULL,
  `members_without` int NOT NULL,
  `total` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cetos_accreditation_no_foreign` (`accreditation_no`),
  CONSTRAINT `cetos_accreditation_no_foreign` FOREIGN KEY (`accreditation_no`) REFERENCES `general_info` (`accreditation_no`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cetos`
--

LOCK TABLES `cetos` WRITE;
/*!40000 ALTER TABLE `cetos` DISABLE KEYS */;
INSERT INTO `cetos` VALUES (1,'2001-170843',1992,184,157,341,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(2,'2009-235166',1976,324,102,426,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(3,'2006-854073',2018,223,94,317,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(4,'2012-780778',2011,188,102,290,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(5,'2005-440858',2013,345,288,633,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(6,'2011-198739',2001,76,269,345,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(7,'2004-352799',2010,241,126,367,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(8,'2019-121166',1972,348,211,559,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(9,'2005-868967',1994,448,192,640,'2025-03-19 08:04:18','2025-03-19 08:04:18'),(10,'2020-587898',1988,413,255,668,'2025-03-19 08:04:18','2025-03-19 08:04:18');
/*!40000 ALTER TABLE `cetos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cgs`
--

DROP TABLE IF EXISTS `cgs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cgs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `accreditation_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entry_year` year NOT NULL,
  `cgs_number` int NOT NULL,
  `issuance_date` date NOT NULL,
  `expiration_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cgs_accreditation_no_foreign` (`accreditation_no`),
  CONSTRAINT `cgs_accreditation_no_foreign` FOREIGN KEY (`accreditation_no`) REFERENCES `general_info` (`accreditation_no`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cgs`
--

LOCK TABLES `cgs` WRITE;
/*!40000 ALTER TABLE `cgs` DISABLE KEYS */;
INSERT INTO `cgs` VALUES (1,'2001-170843',1993,3100,'2007-07-31','2008-07-31','2025-03-19 08:04:16','2025-03-19 08:04:16'),(2,'2009-235166',2012,4421,'2023-06-08','2024-06-08','2025-03-19 08:04:16','2025-03-19 08:04:16'),(3,'2006-854073',1983,7960,'1995-04-16','1996-04-16','2025-03-19 08:04:16','2025-03-19 08:04:16'),(4,'2012-780778',2019,6525,'2022-09-17','2023-09-17','2025-03-19 08:04:16','2025-03-19 08:04:16'),(5,'2005-440858',1992,1870,'2005-10-27','2006-10-27','2025-03-19 08:04:17','2025-03-19 08:04:17'),(6,'2011-198739',2003,1647,'2010-04-10','2011-04-10','2025-03-19 08:04:17','2025-03-19 08:04:17'),(7,'2004-352799',2013,6591,'1991-05-22','1992-05-22','2025-03-19 08:04:17','2025-03-19 08:04:17'),(8,'2019-121166',1994,2320,'1972-01-06','1973-01-06','2025-03-19 08:04:17','2025-03-19 08:04:17'),(9,'2005-868967',1977,1577,'2019-05-10','2020-05-10','2025-03-19 08:04:18','2025-03-19 08:04:18'),(10,'2020-587898',2013,6994,'2015-11-14','2016-11-14','2025-03-19 08:04:18','2025-03-19 08:04:18');
/*!40000 ALTER TABLE `cgs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `change_items`
--

DROP TABLE IF EXISTS `change_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `change_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `edit_request_id` bigint unsigned NOT NULL,
  `column_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `old_value` text COLLATE utf8mb4_unicode_ci,
  `new_value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `change_items_edit_request_id_column_name_index` (`edit_request_id`,`column_name`),
  CONSTRAINT `change_items_edit_request_id_foreign` FOREIGN KEY (`edit_request_id`) REFERENCES `edit_requests` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `change_items`
--

LOCK TABLES `change_items` WRITE;
/*!40000 ALTER TABLE `change_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `change_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coop_businesses`
--

DROP TABLE IF EXISTS `coop_businesses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `coop_businesses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `externaluser_id` bigint unsigned NOT NULL,
  `type` enum('Proposed','Existing') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nature_of_business` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `starting_capital` decimal(15,2) DEFAULT NULL,
  `capital_to_date` decimal(15,2) DEFAULT NULL,
  `years_of_existence` int DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `coop_businesses_externaluser_id_foreign` (`externaluser_id`),
  CONSTRAINT `coop_businesses_externaluser_id_foreign` FOREIGN KEY (`externaluser_id`) REFERENCES `externalusers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coop_businesses`
--

LOCK TABLES `coop_businesses` WRITE;
/*!40000 ALTER TABLE `coop_businesses` DISABLE KEYS */;
INSERT INTO `coop_businesses` VALUES (1,20,'Existing','quidem',370899.39,1402288.95,2,'Inactive','Accusantium et autem incidunt repellat eos odio.','2025-03-19 08:04:41','2025-03-19 08:04:41'),(2,12,'Existing','debitis',381304.16,454085.46,15,'Active','Quis et consequatur consequatur vel.','2025-03-19 08:04:41','2025-03-19 08:04:41'),(3,11,'Existing','consequatur',310376.34,1560086.31,32,'Inactive','Quis accusantium illum possimus at quia.','2025-03-19 08:04:41','2025-03-19 08:04:41'),(4,15,'Proposed','minus',484443.63,3784825.32,32,'Inactive','Atque nemo soluta quia non dolores nemo.','2025-03-19 08:04:41','2025-03-19 08:04:41'),(5,13,'Proposed','qui',242988.96,1860129.19,9,'Active','Quis laboriosam velit quia hic.','2025-03-19 08:04:41','2025-03-19 08:04:41'),(6,15,'Proposed','numquam',472902.37,1299898.43,19,'On-going Operations','Quis qui odio voluptates eligendi.','2025-03-19 08:04:41','2025-03-19 08:04:41'),(7,2,'Existing','dolores',84101.54,4363895.93,20,'On-going Operations','Aut molestiae in odio sed.','2025-03-19 08:04:41','2025-03-19 08:04:41'),(8,13,'Existing','quas',49326.66,3224760.38,14,'On-going Operations','Corrupti ea perspiciatis et.','2025-03-19 08:04:41','2025-03-19 08:04:41'),(10,42,'Proposed','nature',500000.00,50000.00,1,NULL,'remarks status','2025-03-23 03:40:30','2025-03-23 03:40:30');
/*!40000 ALTER TABLE `coop_businesses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coop_cetos`
--

DROP TABLE IF EXISTS `coop_cetos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `coop_cetos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `externaluser_id` bigint unsigned NOT NULL,
  `members_with` int DEFAULT NULL,
  `members_without` int DEFAULT NULL,
  `total` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `coop_cetos_externaluser_id_foreign` (`externaluser_id`),
  CONSTRAINT `coop_cetos_externaluser_id_foreign` FOREIGN KEY (`externaluser_id`) REFERENCES `externalusers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coop_cetos`
--

LOCK TABLES `coop_cetos` WRITE;
/*!40000 ALTER TABLE `coop_cetos` DISABLE KEYS */;
INSERT INTO `coop_cetos` VALUES (1,14,18,1,19,'2025-03-19 08:04:41','2025-03-19 08:04:41'),(2,4,9,3,12,'2025-03-19 08:04:41','2025-03-19 08:04:41'),(3,2,14,2,16,'2025-03-19 08:04:41','2025-03-19 08:04:41'),(4,5,13,2,15,'2025-03-19 08:04:41','2025-03-19 08:04:41'),(5,7,18,5,23,'2025-03-19 08:04:41','2025-03-19 08:04:41'),(6,18,17,2,19,'2025-03-19 08:04:41','2025-03-19 08:04:41'),(7,20,5,4,9,'2025-03-19 08:04:41','2025-03-19 08:04:41'),(8,20,2,3,5,'2025-03-19 08:04:41','2025-03-19 08:04:41'),(9,5,3,3,6,'2025-03-19 08:04:41','2025-03-19 08:04:41'),(10,3,8,4,12,'2025-03-19 08:04:41','2025-03-19 08:04:41');
/*!40000 ALTER TABLE `coop_cetos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coop_finances`
--

DROP TABLE IF EXISTS `coop_finances`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `coop_finances` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `externaluser_id` bigint unsigned NOT NULL,
  `current_assets` decimal(15,2) DEFAULT NULL,
  `noncurrent_assets` decimal(15,2) DEFAULT NULL,
  `total_assets` decimal(15,2) DEFAULT NULL,
  `coop_type` enum('Micro','Small','Medium','Large') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `liabilities` decimal(15,2) DEFAULT NULL,
  `members_equity` decimal(15,2) DEFAULT NULL,
  `total_gross_revenues` decimal(15,2) DEFAULT NULL,
  `total_expenses` decimal(15,2) DEFAULT NULL,
  `net_surplus` decimal(15,2) DEFAULT NULL,
  `initial_auth_capital_share` decimal(15,2) DEFAULT NULL,
  `present_auth_capital_share` decimal(15,2) DEFAULT NULL,
  `subscribed_capital_share` decimal(15,2) DEFAULT NULL,
  `paid_up_capital` decimal(15,2) DEFAULT NULL,
  `capital_build_up_scheme` decimal(15,2) DEFAULT NULL,
  `general_reserve_fund` decimal(15,2) DEFAULT NULL,
  `education_training_fund` decimal(15,2) DEFAULT NULL,
  `community_dev_fund` decimal(15,2) DEFAULT NULL,
  `optional_fund` decimal(15,2) DEFAULT NULL,
  `share_capital_interest` decimal(15,2) DEFAULT NULL,
  `patronage_refund` decimal(15,2) DEFAULT NULL,
  `others` decimal(15,2) DEFAULT NULL,
  `total` decimal(15,2) DEFAULT NULL,
  `deficit_from_financial_aspect` decimal(15,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `coop_finances_externaluser_id_foreign` (`externaluser_id`),
  CONSTRAINT `coop_finances_externaluser_id_foreign` FOREIGN KEY (`externaluser_id`) REFERENCES `externalusers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coop_finances`
--

LOCK TABLES `coop_finances` WRITE;
/*!40000 ALTER TABLE `coop_finances` DISABLE KEYS */;
INSERT INTO `coop_finances` VALUES (1,14,4972767.12,811519.81,128084.81,'Large',451767.99,416350.15,760453.56,1855147.15,46781.14,379379.98,312480.93,14755.38,257677.14,47787.46,39800.06,6206.01,3625.09,8850.46,8725.05,6134.74,1066.64,54977.22,2839.57,'2025-03-19 08:04:41','2025-03-19 08:04:41'),(2,7,3813783.19,4759038.52,3233974.59,'Small',420770.87,952115.43,2369788.86,1102144.42,365954.62,264686.99,467527.10,406006.80,127731.18,129798.52,46582.93,4748.82,5925.88,8605.67,3342.68,15052.20,12362.69,64325.45,6952.14,'2025-03-19 08:04:41','2025-03-19 08:04:41'),(3,6,3868182.01,438497.80,4400495.30,'Small',17920.29,898286.96,4368553.70,805475.13,208521.83,323382.77,954685.52,81832.78,373173.65,105852.36,8745.59,15138.29,15818.87,9967.02,3047.79,13357.17,9295.46,11650.00,8101.84,'2025-03-19 08:04:41','2025-03-19 08:04:41'),(4,15,1194533.09,3038198.61,3105204.82,'Large',181042.30,836736.46,1130018.96,741825.98,39678.78,135613.04,572256.75,358060.43,295634.89,21383.48,39594.90,7726.48,9497.95,12286.83,12332.15,8282.68,13436.98,54482.09,9201.18,'2025-03-19 08:04:41','2025-03-19 08:04:41'),(5,17,165920.63,2581987.13,2641600.39,'Medium',133747.84,983308.88,2442961.58,1264016.21,467054.86,89829.30,349183.02,101431.44,177264.53,134223.50,48170.59,5127.61,18248.86,13707.82,17828.75,12739.25,10112.74,61071.63,9541.51,'2025-03-19 08:04:41','2025-03-19 08:04:41'),(6,9,1589288.23,4904138.58,489753.24,'Large',290419.31,631999.17,3522455.82,609437.34,121070.18,131767.74,758063.47,105760.57,95544.64,122979.30,24551.56,1179.53,16591.29,19960.17,2678.88,13396.51,4107.81,9198.28,4645.51,'2025-03-19 08:04:41','2025-03-19 08:04:41'),(7,13,3399020.40,1341802.30,4919562.45,'Micro',267112.57,685228.32,4612603.28,1082611.97,127126.76,407766.24,139156.54,192822.26,130626.17,151261.79,49325.19,15705.94,11701.21,1736.75,14338.25,2635.56,1202.24,57162.49,9106.68,'2025-03-19 08:04:41','2025-03-19 08:04:41'),(8,17,1456941.35,3015345.61,8508468.92,'Micro',297419.19,401860.87,4768929.06,1333954.62,372773.22,477876.50,460249.33,232429.94,149350.33,51021.02,15419.72,10031.22,13636.78,12759.80,16486.83,9769.75,11570.06,72611.63,3157.50,'2025-03-19 08:04:41','2025-03-19 08:04:41'),(9,8,1888168.66,1739043.41,8252106.40,'Medium',411581.16,81177.65,276154.48,1772497.02,301596.33,299013.55,891453.21,6271.66,160647.91,77485.55,31845.48,18009.08,13754.91,10006.69,8823.48,2438.84,7743.48,38818.46,4653.94,'2025-03-19 08:04:41','2025-03-19 08:04:41'),(10,3,2708821.88,4803729.38,9945705.89,'Micro',398864.23,699319.95,2458408.58,688462.15,38121.50,98104.06,731934.96,409638.00,370558.42,154805.38,45051.72,6802.24,6435.46,5040.94,13338.65,1619.08,15086.81,29472.82,5117.97,'2025-03-19 08:04:41','2025-03-19 08:04:41');
/*!40000 ALTER TABLE `coop_finances` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coop_franchises`
--

DROP TABLE IF EXISTS `coop_franchises`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `coop_franchises` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `externaluser_id` bigint unsigned NOT NULL,
  `route` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cpc_case_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_of_franchise` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mode_of_service` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_of_unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `validity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `coop_franchises_externaluser_id_foreign` (`externaluser_id`),
  CONSTRAINT `coop_franchises_externaluser_id_foreign` FOREIGN KEY (`externaluser_id`) REFERENCES `externalusers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coop_franchises`
--

LOCK TABLES `coop_franchises` WRITE;
/*!40000 ALTER TABLE `coop_franchises` DISABLE KEYS */;
INSERT INTO `coop_franchises` VALUES (1,8,'53613 Jaskolski Ports\nHipolitotown, IL 66319','e705978b-ba6f-3d3d-a09f-453921c20cdd','One-Type','PUJ Service','Bus','2024-11-21','Labore facilis id dolore id dolorum.','2025-03-19 08:04:41','2025-03-19 08:04:41'),(2,3,'425 Schumm Courts Suite 421\nLizziefort, CO 90497','00fd8b30-567d-35b8-800a-d7e21b7a2905','One-Type','UV Express Service','C1 Euro','2004-01-31','Molestiae perferendis asperiores ratione ut maiores amet.','2025-03-19 08:04:41','2025-03-19 08:04:41'),(3,5,'89304 Deven Road\nTremblayside, SD 89596','16042817-63f0-30df-ab2e-655a0dcf28cf','One-Type','PUB Service','C1 Euro','1982-09-20','Facilis nam quidem aut qui accusantium.','2025-03-19 08:04:41','2025-03-19 08:04:41'),(4,6,'187 Champlin Gardens Suite 060\nNew Kathleenshire, OK 57631-1010','b9524a39-8544-3474-8bc4-17e1cf47daa9','One-Type','UV Express Service','Electric','1972-08-04','Fuga aut alias dolores totam recusandae voluptates nisi.','2025-03-19 08:04:41','2025-03-19 08:04:41'),(5,2,'859 Abshire Pine\nSouth Rodgerchester, MN 89923-9394','44782501-5a1d-35ae-a081-7eefe930c4ff','One-Type','Tricycle/MCH Service','Bus','2004-01-30','Fugit a et distinctio in est molestias delectus corporis.','2025-03-19 08:04:41','2025-03-19 08:04:41'),(6,15,'39987 Chanel Lock\nNorth Ricardoton, HI 76643-2127','ee5fcec0-3c1e-3b59-aaa8-7b6653ee7e43','One-Type','PUJ Service','Electric','2002-02-12','Consequatur ex est quis quas qui cupiditate doloribus.','2025-03-19 08:04:41','2025-03-19 08:04:41'),(7,16,'32680 Joesph Shores\nPort Thaddeus, VA 94228','19ff113f-13b0-3c52-b09e-b8831b7da79a','One-Type','Tourist Service','Traditional','1974-09-02','Et ut architecto eius laborum ullam ut.','2025-03-19 08:04:41','2025-03-19 08:04:41'),(8,14,'31491 Deontae Groves Apt. 309\nWest Tyra, ND 21380','f1d13a5f-8fb0-34cb-beb1-6492cc708b9b','One-Type','Tricycle/MCH Service','C1 Euro','1991-09-27','Sunt nobis sed corporis.','2025-03-19 08:04:41','2025-03-19 08:04:41'),(9,9,'944 Jerde Islands Suite 199\nLake Joeyview, MA 65555','9af876f1-2958-346e-b015-a1dcfd401878','One-Type','Mini-Bus Service','Bus','1992-10-15','Esse ullam autem debitis assumenda facere.','2025-03-19 08:04:41','2025-03-19 08:04:41'),(10,18,'187 Marilyne Point Apt. 872\nTomasbury, WY 97389-1271','7a03153c-bd51-360d-a8b1-de2a288c5513','One-Type','Tricycle/MCH Service','Bus','1986-10-17','Voluptatem reiciendis expedita pariatur qui.','2025-03-19 08:04:41','2025-03-19 08:04:41'),(11,11,'7421 Elijah Hills Suite 332\nWest Vilmatown, AK 35739-1544','159ba864-f462-38f0-8ba9-00b9fe968768','One-Type','Mini-Bus Service','Traditional','1993-08-10','Consectetur sit quis et.','2025-03-19 08:04:41','2025-03-19 08:04:41'),(12,18,'902 Wilkinson Court Suite 923\nCeceliashire, NE 39329-6688','3f04f6f7-1804-32db-a240-d1ddc37f9eb0','One-Type','PUB Service','Bus','2019-08-17','Repudiandae repellat vel velit dolorem ullam est quae.','2025-03-19 08:04:41','2025-03-19 08:04:41'),(13,20,'9914 Julio Wells Apt. 051\nJarredfurt, NJ 45693-5000','50b93d97-7343-3653-8c53-d2465d240ad8','One-Type','UV Express Service','Bus','1989-10-05','Non accusamus nesciunt magni rerum soluta non temporibus.','2025-03-19 08:04:41','2025-03-19 08:04:41'),(14,1,'5091 Veronica Inlet\nSouth Eliasview, NJ 96222-7183','f581915a-2a6c-3d6c-b417-8272db3d4b81','One-Type','Tourist Service','C1 Euro','2002-07-19','Neque ut nihil ut.','2025-03-19 08:04:41','2025-03-19 08:04:41'),(15,2,'77528 Trantow Summit\nSouth Caterina, IL 60433','d0a58614-2189-3b15-a0ab-d6ad39ada865','One-Type','Tricycle/MCH Service','Traditional','2013-10-04','Pariatur impedit ut eos facilis.','2025-03-19 08:04:41','2025-03-19 08:04:41'),(16,15,'14850 Joany Plains\nLuisamouth, ID 03366-7492','ee1be64a-3b22-30d6-8e7a-36ea50166bbd','One-Type','PUB Service','Bus','2000-01-14','Quaerat ab error ab minima.','2025-03-19 08:04:41','2025-03-19 08:04:41'),(17,12,'8817 Fay Streets\nBoyerborough, DE 36805-7706','d3cf0250-5064-3fcb-8b49-3a10f48f186a','One-Type','UV Express Service','C1 Euro','2018-07-25','Molestias molestiae mollitia repudiandae veritatis modi eos.','2025-03-19 08:04:41','2025-03-19 08:04:41'),(18,15,'42291 Dibbert Corners\nClarissaton, ND 75080-8315','6cc4110e-ed2e-3f85-9b3a-19389e700e09','One-Type','Tourist Service','Bus','2025-01-16','Enim fugit impedit sit est consequatur.','2025-03-19 08:04:41','2025-03-19 08:04:41'),(19,7,'273 Clement Court Suite 588\nWest Oletaville, TN 14236','a1e4c38d-68d3-3155-aee6-b5377e35e608','One-Type','PUJ Service','Traditional','2021-01-12','Sint pariatur nihil atque sed amet.','2025-03-19 08:04:41','2025-03-19 08:04:41'),(20,18,'5424 Alene Square Apt. 567\nNew Westley, AL 15127','70a61562-b235-369e-9937-2eb0bc448039','One-Type','UV Express Service','Bus','1988-02-12','Ut harum quis iusto vel eveniet vel.','2025-03-19 08:04:41','2025-03-19 08:04:41');
/*!40000 ALTER TABLE `coop_franchises` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coop_grants_and_donations`
--

DROP TABLE IF EXISTS `coop_grants_and_donations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `coop_grants_and_donations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `externaluser_id` bigint unsigned NOT NULL,
  `date_acquired` date DEFAULT NULL,
  `amount` decimal(15,2) DEFAULT NULL,
  `source` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `coop_grants_and_donations_externaluser_id_foreign` (`externaluser_id`),
  CONSTRAINT `coop_grants_and_donations_externaluser_id_foreign` FOREIGN KEY (`externaluser_id`) REFERENCES `externalusers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coop_grants_and_donations`
--

LOCK TABLES `coop_grants_and_donations` WRITE;
/*!40000 ALTER TABLE `coop_grants_and_donations` DISABLE KEYS */;
INSERT INTO `coop_grants_and_donations` VALUES (1,3,'2023-12-09',100000.00,'ABC Company',NULL,'2025-03-19 12:43:47','2025-03-19 12:43:47'),(2,3,'2025-03-19',205000.00,'XYZ Inc.',NULL,'2025-03-19 12:44:33','2025-03-19 12:44:33'),(3,3,'2025-03-19',50500.00,'ASD Corporation',NULL,'2025-03-19 12:45:24','2025-03-19 12:45:24'),(4,6,'2025-01-05',200000.00,'City Hall ng Makati',NULL,'2025-03-19 19:08:55','2025-03-19 19:08:55'),(5,42,'2025-03-18',52300.00,'wertyu','dfghjk','2025-03-23 04:35:01','2025-03-23 04:35:01');
/*!40000 ALTER TABLE `coop_grants_and_donations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coop_info`
--

DROP TABLE IF EXISTS `coop_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `coop_info` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `externaluser_id` bigint unsigned NOT NULL,
  `short_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cda_registration_date` date DEFAULT NULL,
  `common_bond_membership` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `membership_fee` int DEFAULT '0',
  `area` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `region` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `province` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `barangay` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employer_sss_reg_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employer_pagibig_reg_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employer_philhealth_reg_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bir_tin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bir_tax_exemption_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bir_validity` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `total_sss_enrolled` int NOT NULL DEFAULT '0',
  `total_pagibig_enrolled` int NOT NULL DEFAULT '0',
  `total_philhealth_enrolled` int NOT NULL DEFAULT '0',
  `driver_probationary_male` int DEFAULT NULL,
  `driver_probationary_female` int DEFAULT NULL,
  `driver_regular_male` int DEFAULT NULL,
  `driver_regular_female` int DEFAULT NULL,
  `operator_probationary_male` int DEFAULT NULL,
  `operator_probationary_female` int DEFAULT NULL,
  `operator_regular_male` int DEFAULT NULL,
  `operator_regular_female` int DEFAULT NULL,
  `allied_probationary_male` int DEFAULT NULL,
  `allied_probationary_female` int DEFAULT NULL,
  `allied_regular_male` int DEFAULT NULL,
  `allied_regular_female` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `coop_info_email_unique` (`email`),
  KEY `coop_info_externaluser_id_foreign` (`externaluser_id`),
  CONSTRAINT `coop_info_externaluser_id_foreign` FOREIGN KEY (`externaluser_id`) REFERENCES `externalusers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coop_info`
--

LOCK TABLES `coop_info` WRITE;
/*!40000 ALTER TABLE `coop_info` DISABLE KEYS */;
INSERT INTO `coop_info` VALUES (1,13,'and Sons','2001-10-25','nostrum',9834,'Bartoletti Pass','Kansas','West Eugenia','Kansas','General Crescent','887 Cassin Neck Suite 266\nSamville, AR 60201-7974','trystan.shields@example.net','360-488-6663',NULL,NULL,NULL,NULL,NULL,NULL,'2025-03-19 08:04:41','2025-03-19 08:04:41',0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,14,'LLC','2013-11-04','illum',9316,'Graham Point','Montana','Kossfurt','Tennessee','Blick Loaf','4000 Pfannerstill Plain\nMaxineland, WV 64403-7336','ebauch@example.org','925.392.0439',NULL,NULL,NULL,NULL,NULL,NULL,'2025-03-19 08:04:41','2025-03-19 08:04:41',0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,5,'PLC','2020-03-30','accusantium',1235,'Stark Via','Tennessee','Ratkemouth','Montana','Tito Spurs','834 Fredrick Ramp Apt. 381\nDarestad, ND 24546-8138','cormier.obie@example.net','(310) 686-7930',NULL,NULL,NULL,NULL,NULL,NULL,'2025-03-19 08:04:41','2025-03-19 08:04:41',0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,6,'Inc','1984-09-22','soluta',520,'Littel Terrace','Alaska','Lake Wilhelm','Montana','Kshlerin Club','836 Lauriane ForgesAricland, NM 74460-4481','emanuel92@example.com','639875498756','SSS-12341234','P-12341234','PH-12341234','TN-12341234','EX-12341234','2026-10-20','2025-03-19 08:04:41','2025-03-19 19:07:39',5,5,5,0,1,0,0,0,0,1,0,0,0,0,1),(5,7,'Inc','1975-09-19','est',188,'Jacobson Groves','Florida','West Eliseside','Montana','Rahsaan Well','12650 O\'Conner Passage\nPort Bernice, CA 94025','coconner@example.com','(929) 818-5167',NULL,NULL,NULL,NULL,NULL,NULL,'2025-03-19 08:04:41','2025-03-19 08:04:41',0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(6,6,'Ltd','1977-07-07','qui',4535,'Kreiger Key','Iowa','Port Freda','Texas','Stanton Estate','623 Annabelle Neck Suite 872\nLake Elwyn, KS 39458','lskiles@example.com','+1-559-454-6859',NULL,NULL,NULL,NULL,NULL,NULL,'2025-03-19 08:04:41','2025-03-19 08:04:41',0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(7,2,'LLC','1974-09-12','et',1230,'Lemke Overpass','Hawaii','Lake Eldon','Rhode Island','Chelsea Fall','74101 Fanny Cliff\nCarmelview, NJ 17635-5412','xhyatt@example.net','1-970-827-6776',NULL,NULL,NULL,NULL,NULL,NULL,'2025-03-19 08:04:41','2025-03-19 11:36:35',4,4,3,0,0,0,1,0,0,1,1,0,0,0,0),(8,6,'LLC','2020-09-24','accusantium',1360,'Maximillia Rue','Utah','North Marvinside','Nebraska','Torphy Run','2655 Toy Course Suite 834\nKianchester, MN 71199','stracke.jaren@example.net','1-313-908-9849',NULL,NULL,NULL,NULL,NULL,NULL,'2025-03-19 08:04:41','2025-03-19 08:04:41',0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(9,1,'and Sons','1981-12-19','at',1452,'Brannon Radial','Ohio','Alexandraview','Wyoming','Lisette Common','1108 Rath Bypass Apt. 364\nNew Lupebury, KY 25642-3761','torey97@example.net','+16202857853',NULL,NULL,NULL,NULL,NULL,NULL,'2025-03-19 08:04:41','2025-03-19 08:07:18',1,1,0,0,0,0,0,0,0,0,0,0,1,0,0),(10,20,'PLC','1972-01-22','numquam',6617,'Metz Gardens','Tennessee','Schowalterberg','Connecticut','Stephen Mews','885 Macejkovic Grove\nPort Golden, KS 33445-5510','alittle@example.net','+1-608-344-4151',NULL,NULL,NULL,NULL,NULL,NULL,'2025-03-19 08:04:41','2025-03-19 08:04:41',0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(11,3,NULL,'2023-02-21','One type',400,NULL,NULL,NULL,NULL,NULL,'123B Asd','edythe.goldner@example.net','639568969801','SS-423223421','PG-23423231','PH-234452200','TN-000291232','EX-0232022','2025-03-22','2025-03-19 12:28:09','2025-03-19 12:48:43',3,4,3,0,0,0,0,0,1,1,0,0,0,1,0),(12,4,NULL,'2025-03-14','Residential',50,NULL,NULL,NULL,NULL,NULL,'jhgj','valentin08@example.com','639858965478','12312','45345321','88769','878687','86786876','2025-12-02','2025-03-22 08:44:32','2025-03-22 08:45:57',1,1,1,0,1,0,0,0,0,0,0,0,0,0,0),(13,11,NULL,'2024-02-24','Associational',458,NULL,NULL,NULL,NULL,NULL,'123 Block Street','zemlak.kyleigh@example.com','639528754558','12-2342234-2','1254-8965-9896','12-666666599-2','123-456-456-412','EXMP-34242-2347','2026-10-23','2025-03-22 20:04:50','2025-03-22 20:15:03',4,4,3,0,0,0,0,0,0,0,1,0,0,0,1),(14,42,NULL,'2025-03-21','Occupational',0,NULL,NULL,NULL,NULL,NULL,'143 Lawton','jj.hoo@gmail.com','639520350481','12-2322323-1','1215-2121-2121','12-121211199-2','121-121-564-234','EXMP-45697-2324','2025-04-03','2025-03-23 02:03:37','2025-03-23 04:32:04',2,2,2,0,0,0,0,0,1,0,0,0,0,0,0);
/*!40000 ALTER TABLE `coop_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coop_loans`
--

DROP TABLE IF EXISTS `coop_loans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `coop_loans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `externaluser_id` bigint unsigned NOT NULL,
  `financing_institution` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `acquired_at` date DEFAULT NULL,
  `amount` decimal(15,2) DEFAULT NULL,
  `utilization` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `coop_loans_externaluser_id_foreign` (`externaluser_id`),
  CONSTRAINT `coop_loans_externaluser_id_foreign` FOREIGN KEY (`externaluser_id`) REFERENCES `externalusers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coop_loans`
--

LOCK TABLES `coop_loans` WRITE;
/*!40000 ALTER TABLE `coop_loans` DISABLE KEYS */;
INSERT INTO `coop_loans` VALUES (1,2,'Borer, Kemmer and Murazik','1986-07-04',416364.39,'Est rerum sint maiores est natus.','Suscipit illum rem quam quam nemo maiores recusandae.','2025-03-19 08:04:41','2025-03-19 08:04:41'),(2,19,'Bogan-Mohr','1989-03-28',733823.74,'Magni harum ullam mollitia laudantium quos deserunt.','Fugiat excepturi ipsam minima quas culpa.','2025-03-19 08:04:41','2025-03-19 08:04:41'),(3,19,'Kshlerin-O\'Reilly','2007-08-17',754342.90,'Et incidunt itaque assumenda debitis minus.','Qui quasi qui nisi exercitationem.','2025-03-19 08:04:41','2025-03-19 08:04:41'),(4,9,'Deckow Group','2007-10-29',595537.96,'Eos facilis sequi est sint eveniet deserunt laborum.','Ut est aut quod a ut.','2025-03-19 08:04:41','2025-03-19 08:04:41'),(5,15,'Gislason, Schimmel and Carroll','1985-10-27',660247.33,'At consequatur quo deleniti aut sit.','Eos sit id nesciunt non.','2025-03-19 08:04:41','2025-03-19 08:04:41'),(6,10,'Morissette, Champlin and Koch','1978-11-04',145421.69,'Culpa expedita esse voluptatibus.','Et voluptatem debitis dolore reprehenderit ad explicabo cupiditate.','2025-03-19 08:04:41','2025-03-19 08:04:41'),(7,4,'Reilly Ltd','1995-06-13',38600.05,'Nulla consequuntur maiores rerum.','Ad corrupti velit possimus aspernatur.','2025-03-19 08:04:41','2025-03-19 08:04:41'),(8,9,'Hirthe PLC','1991-12-10',838146.46,'Qui et quae est molestias fuga.','Reiciendis ut quaerat dignissimos quasi quia quo voluptatibus libero.','2025-03-19 08:04:41','2025-03-19 08:04:41'),(9,18,'Frami-Cummerata','2010-11-21',966176.38,'Voluptatem praesentium delectus iusto.','Qui rerum voluptas nihil praesentium quam ipsum.','2025-03-19 08:04:41','2025-03-19 08:04:41'),(10,13,'Stanton-Stanton','2022-12-07',530374.95,'Consequuntur est quod aut consequatur dolor cupiditate cupiditate.','Natus ut magni provident in fugit.','2025-03-19 08:04:41','2025-03-19 08:04:41'),(11,3,'METROBANK','2023-03-05',50000.00,'Units Modernization',NULL,'2025-03-19 12:46:32','2025-03-19 12:46:32'),(12,3,'METROBANK','2025-01-02',100000.00,'Re-Lending to Members',NULL,'2025-03-19 12:47:15','2025-03-19 12:47:15'),(13,6,'DBP','2025-01-20',100000.00,'Unit Buying',NULL,'2025-03-19 19:11:13','2025-03-19 19:11:13'),(14,42,'swdfghjk','2025-03-05',1234567.00,'dfghj','dfghm','2025-03-23 04:37:03','2025-03-23 04:37:03');
/*!40000 ALTER TABLE `coop_loans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coop_units`
--

DROP TABLE IF EXISTS `coop_units`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `coop_units` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `externaluser_id` bigint unsigned NOT NULL,
  `mode_of_service` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_of_unit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cooperatively_owned` int DEFAULT '0',
  `individually_owned` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `coop_units_externaluser_id_foreign` (`externaluser_id`),
  CONSTRAINT `coop_units_externaluser_id_foreign` FOREIGN KEY (`externaluser_id`) REFERENCES `externalusers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coop_units`
--

LOCK TABLES `coop_units` WRITE;
/*!40000 ALTER TABLE `coop_units` DISABLE KEYS */;
/*!40000 ALTER TABLE `coop_units` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coopawards`
--

DROP TABLE IF EXISTS `coopawards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `coopawards` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `externaluser_id` bigint unsigned NOT NULL,
  `awarding_body` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nature_of_award` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_received` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `coopawards_externaluser_id_foreign` (`externaluser_id`),
  CONSTRAINT `coopawards_externaluser_id_foreign` FOREIGN KEY (`externaluser_id`) REFERENCES `externalusers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coopawards`
--

LOCK TABLES `coopawards` WRITE;
/*!40000 ALTER TABLE `coopawards` DISABLE KEYS */;
INSERT INTO `coopawards` VALUES (1,3,'City Hall','Best in Math','2025-03-14','2025-03-19 12:50:05','2025-03-19 12:50:05'),(2,42,'sdffghj','uhjgnb','2025-03-03','2025-03-23 04:42:31','2025-03-23 04:42:31');
/*!40000 ALTER TABLE `coopawards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cooptrainings`
--

DROP TABLE IF EXISTS `cooptrainings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cooptrainings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `externaluser_id` bigint unsigned NOT NULL,
  `title_of_training` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `no_of_attendees` int DEFAULT NULL,
  `total_members` int DEFAULT NULL,
  `total_fund` decimal(15,2) DEFAULT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cooptrainings_externaluser_id_foreign` (`externaluser_id`),
  CONSTRAINT `cooptrainings_externaluser_id_foreign` FOREIGN KEY (`externaluser_id`) REFERENCES `externalusers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cooptrainings`
--

LOCK TABLES `cooptrainings` WRITE;
/*!40000 ALTER TABLE `cooptrainings` DISABLE KEYS */;
INSERT INTO `cooptrainings` VALUES (2,2,'Fleet Management','2025-03-19','2025-03-21',1,2,100.00,NULL,'2025-03-19 10:44:11','2025-03-19 10:44:11'),(3,3,'Fleet Management','2025-03-21','2025-03-24',2,3,10500.00,NULL,'2025-03-19 12:49:23','2025-03-19 12:49:23'),(4,6,'Fleet Management','2025-03-19','2025-03-19',5,3,10000.00,NULL,'2025-03-19 19:12:36','2025-03-19 19:12:36'),(5,42,'kjhrtgh','2025-03-19','2025-04-04',324356,1,254364757.00,'gvnbv','2025-03-23 04:40:46','2025-03-23 04:40:46');
/*!40000 ALTER TABLE `cooptrainings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coopunits`
--

DROP TABLE IF EXISTS `coopunits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `coopunits` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `externaluser_id` bigint unsigned NOT NULL,
  `owned_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plate_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mv_file_no` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `engine_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `chassis_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ltfrb_case_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_granted` date DEFAULT NULL,
  `date_of_expiry` date DEFAULT NULL,
  `origin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `via` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `destination` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `member_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `coopunits_externaluser_id_foreign` (`externaluser_id`),
  CONSTRAINT `coopunits_externaluser_id_foreign` FOREIGN KEY (`externaluser_id`) REFERENCES `externalusers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coopunits`
--

LOCK TABLES `coopunits` WRITE;
/*!40000 ALTER TABLE `coopunits` DISABLE KEYS */;
INSERT INTO `coopunits` VALUES (1,20,'individual','TAXI','496-7224','461340665235723','ENG4430201','CHS3194360','LTFRB8941231','2021-03-29','2029-04-11','Pasig','Quirino Highway','Taguig','2025-03-19 08:04:41','2025-03-19 08:04:41','16'),(2,10,'coop','PUJ TRADITIONAL','491-7138','718706953942440','ENG2859514','CHS7587530','LTFRB5615967','2020-05-14','2030-03-04','Taguig','Quirino Highway','Makati','2025-03-19 08:04:41','2025-03-19 08:04:41',NULL),(3,29,'coop','MCH','310-3884','582422411254991','ENG4011455','CHS0479688','LTFRB9878916','2020-04-26','2030-01-06','Quezon City','NLEX Harbor Link','Malabon','2025-03-19 08:04:41','2025-03-19 08:04:41',NULL),(4,6,'individual','VAN (TOURIST)','302-7620','106193104866989','ENG2993531','CHS8891199','LTFRB5732960','2022-02-18','2027-12-25','Pateros','Marikina–Infanta Highway','Pateros','2025-03-19 08:04:41','2025-03-19 18:57:44','27'),(5,16,'coop','COASTER (TOURIST)','082-1681','455318583084081','ENG3374107','CHS4480313','LTFRB0386883','2022-07-18','2027-08-22','Malabon','Magsaysay Boulevard','Makati','2025-03-19 08:04:41','2025-03-19 08:04:41',NULL),(6,19,'individual','SHUTTLE','611-6467','059018611876862','ENG1269698','CHS5839982','LTFRB9356890','2021-12-07','2025-12-23','Pateros','Quirino Highway','Pasig','2025-03-19 08:04:41','2025-03-19 08:04:41',NULL),(7,3,'coop','VAN (TOURIST)','891-3555','657299650717113','ENG0661901','CHS0535760','LTFRB8553109','2023-11-13','2026-09-15','Manila','Magsaysay Boulevard','Pasig','2025-03-19 08:04:41','2025-03-19 08:04:41',NULL),(8,29,'individual','MPUV C3 SOLAR','430-9032','360770358404119','ENG8137649','CHS4478756','LTFRB2298517','2020-11-24','2030-02-08','Pateros','Magsaysay Boulevard','Pateros','2025-03-19 08:04:41','2025-03-19 08:04:41',NULL),(9,35,'coop','Bus','369-4371','184628780161851','ENG7726486','CHS0440110','LTFRB8261164','2021-11-04','2030-02-26','Taguig','Quirino Highway','Pasig','2025-03-19 08:04:41','2025-03-19 08:04:41',NULL),(10,17,'coop','TRUCK','589-4725','328139640600557','ENG0059047','CHS8232077','LTFRB0881239','2022-04-29','2026-01-31','Makati','Magsaysay Boulevard','Pasig','2025-03-19 08:04:41','2025-03-19 08:04:41',NULL),(11,9,'coop','COASTER (TOURIST)','040-7765','788800667021652','ENG2999546','CHS5612727','LTFRB1240153','2024-09-24','2025-06-14','Makati','Service Rd','Manila','2025-03-19 08:04:41','2025-03-19 08:04:41',NULL),(12,1,'coop','MPUV C3 EURO','929-8055','851420110690684','ENG8325800','CHS4611679','LTFRB0125424','2022-11-25','2029-08-21','Pasig','Magsaysay Boulevard','Taguig','2025-03-19 08:04:41','2025-03-19 08:04:41',NULL),(13,35,'individual','TOURIST','127-9997','773221255340022','ENG4407350','CHS7953269','LTFRB4097471','2021-05-17','2027-12-16','Antipolo','Quirino Highway','Quezon City','2025-03-19 08:04:41','2025-03-19 08:04:41',NULL),(14,10,'individual','TAXI','070-3848','587372927747645','ENG3675697','CHS2180454','LTFRB0629253','2024-03-19','2026-12-30','Antipolo','Jose P. Rizal Avenue','Pasig','2025-03-19 08:04:41','2025-03-19 08:04:41','8'),(15,33,'individual','MPUV C3 EURO','605-9400','684654730044321','ENG0967488','CHS7107947','LTFRB6612876','2023-01-23','2028-12-19','Pasig','Commonwealth Avenue','Manila','2025-03-19 08:04:41','2025-03-19 08:04:41',NULL),(16,11,'coop','TRUCK','184-8891','767219323689451','ENG4615903','CHS7504469','LTFRB1943118','2021-11-28','2025-11-28','Antipolo','Magsaysay Boulevard','Antipolo','2025-03-19 08:04:41','2025-03-19 08:04:41',NULL),(17,5,'coop','COASTER (TOURIST)','073-4456','415416606878768','ENG9397477','CHS2848907','LTFRB4687479','2024-03-18','2026-08-08','Manila','Jose P. Rizal Avenue','Pateros','2025-03-19 08:04:41','2025-03-19 08:04:41',NULL),(18,30,'coop','UV EXPRESS TRADITIONAL','426-0066','110104134702589','ENG5324110','CHS4996513','LTFRB7368153','2023-04-09','2026-08-02','Pasig','Magsaysay Boulevard','Cavite','2025-03-19 08:04:41','2025-03-19 08:04:41',NULL),(19,38,'individual','MPUV C4 MODERNIZED','786-4240','356065997186523','ENG7743412','CHS8604591','LTFRB0114662','2020-12-06','2026-10-22','Makati','Marikina–Infanta Highway','Antipolo','2025-03-19 08:04:41','2025-03-19 08:04:41',NULL),(20,23,'individual','VAN (TOURIST)','771-5610','712966241698685','ENG7265760','CHS2037827','LTFRB8584709','2025-03-01','2028-04-08','Manila','Jose P. Rizal Avenue','Quezon City','2025-03-19 08:04:41','2025-03-19 08:04:41',NULL),(21,2,'coop','PUJ TRADITIONAL','ABX-0231','MV003-21100345','EN-0023442','CH-1230102','LTFRB0012-983-21109','2022-12-20','2026-02-12','Makati City','JP Rizal','Taguig','2025-03-19 09:46:22','2025-03-19 09:46:22',NULL),(22,2,'coop','UV EXPRESS TRADITIONAL','ABX-0236','MV00123-2112','EN-2123421','CH-123555','LTFRB0012-983-211','2022-12-12','2028-12-12','Pateros','Service Rd','Taguig','2025-03-19 11:38:00','2025-03-19 11:38:00',NULL),(23,3,'coop','PUJ TRADITIONAL','ACV-0231','MV00123-211007','EN-212342','CH-1230102','LTFRB0012-983-211','2024-12-02','2026-12-02','Makati City','Service Rd','Taguig City','2025-03-19 12:32:25','2025-03-19 12:32:25',NULL),(24,3,'coop','PUJ TRADITIONAL','ABX-0230','MV00123-211','EN-0023442','CH-1230104','LTFRB0012-983-211','2025-03-10','2026-10-20','Makati City','JP Rizal','Pasig','2025-03-19 12:33:49','2025-03-19 12:33:49',NULL),(25,3,'individual','PUJ TRADITIONAL','ABX-0237','MV00123-2110','EN-212356','CH-1230100','LTFRB032-983-21109','2025-03-07','2026-02-02','Makati City','Service Rd','Taguig','2025-03-19 12:51:35','2025-03-19 12:51:35','19'),(26,3,'individual','PUJ TRADITIONAL','ABX-0289','MV0012810','EN-8356','CH-1280','LTFRB032-983-21109','2025-03-07','2026-02-02','Makati City','Service Rd','Taguig','2025-03-19 12:51:53','2025-03-19 12:51:53','19'),(27,6,'coop','BUS','AB-41231','MV-41231','EN-41231','CH-41231','LTFRB-41231','2025-03-13','2027-11-22','Guadalupe','EDSA','Taft','2025-03-19 18:54:17','2025-03-19 18:54:17',NULL),(28,6,'coop','BUS','AB-41232','MV-41232','EN-41232','CH-41232','LTFRB-41232','2025-03-13','2027-05-06','Guadalupe','EDSA','North Ave','2025-03-19 18:55:28','2025-03-19 18:55:28',NULL),(29,6,'individual','PUJ TRADITIONAL','AB-41233','MV-41233','EN-41233','CH-41233','LTFRB-41233','2025-01-07','2026-01-01','Guadalupe','EDSA','Pasay','2025-03-19 18:57:14','2025-03-19 18:57:14','26'),(30,11,'coop','PUJ TRADITIONAL','ABX-0231','MV0345','EN-212356','CH-1230102','LTFRB0012-983-211','2025-03-07','2025-04-03','Makati','Service Rd','Taguig City','2025-03-22 20:08:05','2025-03-22 20:08:05',NULL),(31,42,'coop','PUJ TRADITIONAL','7658hk','525252','9525','5696','59545','2002-12-12','2025-03-19','makati','jihi','kjniuhknkj','2025-03-23 04:27:11','2025-03-23 04:27:11',NULL),(32,42,'individual','VAN (TOURIST)','345','8552','32698','3456','59545','2025-02-25','2025-03-26','wadfg','sdfghj','dxfcgvhb','2025-03-23 04:29:05','2025-03-23 04:29:05','31');
/*!40000 ALTER TABLE `coopunits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `edit_requests`
--

DROP TABLE IF EXISTS `edit_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `edit_requests` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `reference_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `table_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `accreditation_no` bigint unsigned NOT NULL,
  `status` enum('pending','approved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `editor_id` bigint unsigned NOT NULL,
  `edited_at` timestamp NOT NULL,
  `editor_remarks` text COLLATE utf8mb4_unicode_ci,
  `approver_id` bigint unsigned DEFAULT NULL,
  `reviewed_at` timestamp NULL DEFAULT NULL,
  `approver_remarks` text COLLATE utf8mb4_unicode_ci,
  `file_upload` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `edit_requests_editor_id_foreign` (`editor_id`),
  KEY `edit_requests_approver_id_foreign` (`approver_id`),
  KEY `edit_requests_table_name_reference_no_status_index` (`table_name`,`reference_no`,`status`),
  CONSTRAINT `edit_requests_approver_id_foreign` FOREIGN KEY (`approver_id`) REFERENCES `users` (`id`),
  CONSTRAINT `edit_requests_editor_id_foreign` FOREIGN KEY (`editor_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `edit_requests`
--

LOCK TABLES `edit_requests` WRITE;
/*!40000 ALTER TABLE `edit_requests` DISABLE KEYS */;
/*!40000 ALTER TABLE `edit_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employment`
--

DROP TABLE IF EXISTS `employment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `employment` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `accreditation_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entry_year` year NOT NULL,
  `drivers_probationary_male` int NOT NULL DEFAULT '0',
  `drivers_probationary_female` int NOT NULL DEFAULT '0',
  `drivers_regular_male` int NOT NULL DEFAULT '0',
  `drivers_regular_female` int NOT NULL DEFAULT '0',
  `management_probationary_male` int NOT NULL DEFAULT '0',
  `management_probationary_female` int NOT NULL DEFAULT '0',
  `management_regular_male` int NOT NULL DEFAULT '0',
  `management_regular_female` int NOT NULL DEFAULT '0',
  `allied_probationary_male` int NOT NULL DEFAULT '0',
  `allied_probationary_female` int NOT NULL DEFAULT '0',
  `allied_regular_male` int NOT NULL DEFAULT '0',
  `allied_regular_female` int NOT NULL DEFAULT '0',
  `total_employees` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `employment_accreditation_no_foreign` (`accreditation_no`),
  CONSTRAINT `employment_accreditation_no_foreign` FOREIGN KEY (`accreditation_no`) REFERENCES `general_info` (`accreditation_no`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employment`
--

LOCK TABLES `employment` WRITE;
/*!40000 ALTER TABLE `employment` DISABLE KEYS */;
INSERT INTO `employment` VALUES (1,'2001-170843',2011,45,41,20,7,10,9,29,22,5,15,9,3,215,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(2,'2001-170843',1971,44,44,40,35,12,0,29,34,21,22,29,22,332,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(3,'2001-170843',2012,26,2,52,57,6,4,4,15,3,29,33,43,274,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(4,'2009-235166',2016,13,22,70,11,0,16,37,3,16,3,39,16,246,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(5,'2009-235166',2010,30,48,72,55,7,5,39,8,30,11,18,31,354,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(6,'2009-235166',1982,21,14,52,85,10,20,14,10,9,23,8,3,269,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(7,'2006-854073',1994,5,21,79,55,12,19,22,39,18,19,4,42,335,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(8,'2006-854073',2014,40,38,76,97,13,5,36,11,15,27,9,47,414,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(9,'2006-854073',1975,4,17,25,53,18,13,32,40,22,12,47,18,301,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(10,'2012-780778',1981,47,14,97,1,5,0,5,13,26,15,39,10,272,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(11,'2012-780778',2006,29,22,39,36,7,13,36,9,21,16,12,13,253,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(12,'2012-780778',1993,40,25,50,17,12,15,1,37,28,23,41,45,334,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(13,'2005-440858',2000,6,17,41,95,13,11,24,30,4,8,45,48,342,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(14,'2005-440858',1980,9,29,46,87,12,4,39,37,29,11,6,6,315,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(15,'2005-440858',2024,34,6,84,46,8,1,18,11,4,22,30,48,312,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(16,'2011-198739',2010,19,50,47,10,11,12,17,16,7,6,26,33,254,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(17,'2011-198739',1998,42,20,33,24,10,17,6,35,23,24,2,45,281,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(18,'2011-198739',1994,16,14,22,9,18,7,7,5,20,13,21,12,164,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(19,'2004-352799',1979,49,48,2,32,12,13,28,37,16,23,17,13,290,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(20,'2004-352799',1997,28,9,38,41,19,18,20,1,24,16,39,46,299,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(21,'2004-352799',1996,2,41,57,76,6,20,19,27,17,14,7,50,336,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(22,'2019-121166',1998,25,29,74,21,7,13,20,19,9,10,48,36,311,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(23,'2019-121166',1970,30,50,45,18,19,5,25,4,24,15,23,21,279,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(24,'2019-121166',1970,45,43,68,32,14,7,0,29,19,24,15,34,330,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(25,'2005-868967',2005,4,43,40,34,8,14,32,11,21,8,17,42,274,'2025-03-19 08:04:18','2025-03-19 08:04:18'),(26,'2005-868967',1984,9,32,28,43,2,3,0,32,11,11,13,40,224,'2025-03-19 08:04:18','2025-03-19 08:04:18'),(27,'2005-868967',2010,38,36,69,59,6,15,20,29,11,24,25,45,377,'2025-03-19 08:04:18','2025-03-19 08:04:18'),(28,'2020-587898',1993,15,35,7,18,16,19,29,20,19,27,40,33,278,'2025-03-19 08:04:18','2025-03-19 08:04:18'),(29,'2020-587898',1990,9,30,13,59,8,6,32,36,18,2,19,48,280,'2025-03-19 08:04:18','2025-03-19 08:04:18'),(30,'2020-587898',2015,27,46,31,16,18,13,38,35,8,3,37,23,295,'2025-03-19 08:04:18','2025-03-19 08:04:18');
/*!40000 ALTER TABLE `employment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `externalusers`
--

DROP TABLE IF EXISTS `externalusers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `externalusers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `accreditation_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cda_reg_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tc_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `chair_fname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `chair_mname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `chair_lname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `chair_suffix` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pending_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verification_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `contact_no_verified_at` timestamp NULL DEFAULT NULL,
  `google_code_verified_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `externalusers_contact_no_unique` (`contact_no`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `externalusers`
--

LOCK TABLES `externalusers` WRITE;
/*!40000 ALTER TABLE `externalusers` DISABLE KEYS */;
INSERT INTO `externalusers` VALUES (1,'New','T-49449535','Miller-Ferry','Luisa','Tiana','Wisoky',NULL,'605-472-3391','National ID','5R0MSKJ49O0Y','odessa.kovacek@example.net',NULL,NULL,'$2y$12$r2CPtfeCGNbBvJPgeETI.ORjaJ.6vl3XsEVvrx2XGbm/L9RbtlcKW','2025-03-19 08:02:37','2025-03-19 08:05:28','2025-03-19 08:05:28',NULL,NULL),(2,'New','T-30042618','Schultz-Rogahn','Uriah','Melany','Mohr',NULL,'+1.678.434.9333','National ID','0MX7O3J67I31','stamm.kaitlin@example.com',NULL,NULL,'$2y$12$J86xy49I08CXz.tTZ26CdOCm9XPxzmVwQ3a54U6viyq/jQW1JSl0G','2025-03-19 08:02:37','2025-03-19 08:10:08','2025-03-19 08:10:08',NULL,NULL),(3,'New','T-56465564','McDermott-Terry','Garrett','Wiley','Kuphal','DDS','639568969801','Driver\'s License','1OC4JUQK9Q3Z','edythe.goldner@example.net',NULL,NULL,'$2y$12$JwFUoO5FvVah.tFnRsjPpOVHIVZhHo7uwjchwUZjh22a/CaKAz2Si','2025-03-19 08:02:37','2025-03-19 12:37:41','2025-03-19 12:26:30',NULL,NULL),(4,'New','T-83129986','Pfannerstill, Farrell and Mills','Maurine',NULL,'Purdy',NULL,'639858965478','Driver\'s License','9HSXY5UZEK09','valentin08@example.com',NULL,NULL,'$2y$12$TDbI7fPtRcI5kbE//oP04O9pUQxOc7jwAxsnWMyw3RQLCeCoUVOWS','2025-03-19 08:02:37','2025-03-22 08:45:57','2025-03-19 18:40:50',NULL,NULL),(5,'New','T-35203527','Larkin, Parker and Dickens','Sydney',NULL,'Ledner','II','(458) 746-9482','Passport','UDDQDO67UO4K','clay.miller@example.org',NULL,NULL,'$2y$12$aGlaUiFb5hFASDnkP8tj4uVzPw4JXlE83IJbXMP7k4lMFxy2NiHua','2025-03-19 08:02:37','2025-03-19 08:02:37',NULL,NULL,NULL),(6,'Active','T-77796238','Quitzon-Nader','Ansley','Irving','Halvorson',NULL,'639875498756','National ID','HNYGGNLO5OBV','emanuel92@example.com',NULL,NULL,'$2y$12$H/xFGzHwxOLty/PnQkCCIO8rI5AlwXwqhkWyyk2cKyNkSbPCfYc4q','2025-03-19 08:02:37','2025-03-19 18:59:39','2025-03-19 18:46:43',NULL,NULL),(7,'Active','T-41067673','Johns, Schultz and Conroy','Skylar','Sidney','Kohler',NULL,'580-864-6088','Driver\'s License','UFXJJPTQJJZK','hemmerich@example.com',NULL,NULL,'$2y$12$Pqo74WkVgWfZUCuyv2Hn6.DnXt.pgF5tmFlCfbMOgkjLS8ipzvF72','2025-03-19 08:02:37','2025-03-23 13:54:30','2025-03-22 06:53:09',NULL,NULL),(8,'New','T-20100447','Erdman, Kessler and Prohaska','Katrine','Lurline','Reynolds',NULL,'1-364-596-8650','Passport','36KQZUMJFXJG','lsporer@example.net',NULL,NULL,'$2y$12$z9RATUanuYSjdaTAy.rtCuirdeommiZcb/SnB.ibhsdoRr5eHfzey','2025-03-19 08:02:37','2025-03-20 19:47:27','2025-03-20 19:47:27',NULL,NULL),(9,'New','T-37410951','Yundt PLC','Araceli','Timmy','Ryan','DDS','401.759.7567','Driver\'s License','THKTG2G88TQH','btillman@example.net',NULL,NULL,'$2y$12$FwnpAW2vRkiqaLuTdCp/sOmnsfNlN/6Cy.51bI81AlNd3kUdD5EXO','2025-03-19 08:02:37','2025-03-22 05:14:07','2025-03-22 05:14:07',NULL,NULL),(10,'New','T-95172398','Koch Ltd','Wava',NULL,'Gaylord',NULL,'1-562-426-0233','Driver\'s License','JHKDFX35PCSZ','zoe.ledner@example.com',NULL,NULL,'$2y$12$hyt9dGXVJk.I9sTC7miLIOjEkxGSRmHex280ALHWy41lbf8VFoExC','2025-03-19 08:02:37','2025-03-19 08:02:37',NULL,NULL,NULL),(11,'New','T-35938882','Hermiston, O\'Keefe and McClure','Marcus',NULL,'Flatley','Sr.','639528754558','Passport','BB0YW0EF8B72','zemlak.kyleigh@example.com',NULL,NULL,'$2y$12$L2ub.YVrRrnL54G4eGCE3O7GMriFD62EfSMq98WS4yqGLt5t2a95.','2025-03-19 08:04:03','2025-03-22 22:22:31','2025-03-22 19:17:52',NULL,NULL),(12,'New','T-66416796','Block-Mante','Adelle',NULL,'Mann',NULL,'+1.832.894.5604','Passport','1SN27J9ULZOI','ymosciski@example.org',NULL,NULL,'$2y$12$BPchQY3xlOO4tGq8SwsdQORaXiy6H5auZd3bpNEROqT0n1oCthjIW','2025-03-19 08:04:03','2025-03-19 08:04:03',NULL,NULL,NULL),(13,'New','T-62976432','Gutkowski, Bogisich and Feil','Dessie',NULL,'Erdman','V','484.368.4600','Driver\'s License','9WP0OE4G9T08','ymedhurst@example.org',NULL,NULL,'$2y$12$EeRqXelsmWRfhQWGtEbHAexl6TgtToqjDI59nSjF6XYBzrZbEWZBK','2025-03-19 08:04:03','2025-03-19 08:04:03',NULL,NULL,NULL),(14,'New','T-56392604','McDermott-Labadie','Enrico','Ramona','Collier',NULL,'+1-830-266-6886','Passport','FX6OHU0RG7VR','sschinner@example.net',NULL,NULL,'$2y$12$O18KEQg9nvpfcjpM2i33dOEDys7GPj8nlocLmr1zh40LI15oD.P66','2025-03-19 08:04:03','2025-03-20 04:49:19','2025-03-20 04:49:19',NULL,NULL),(15,'New','T-96409939','Lind-Koepp','Wanda','Mireya','Renner','MD','551-432-9313','National ID','4MFL8BTQ8HNJ','rudolph81@example.com',NULL,NULL,'$2y$12$rKWBnENqe4L5DzbRK.gBeOjNAZgL8.eVwlKxv2rxJQ0DFoEg6rhw2','2025-03-19 08:04:03','2025-03-19 08:04:03',NULL,NULL,NULL),(16,'New','T-56066916','Bauch, Prosacco and Fisher','Misty','Meaghan','Osinski',NULL,'+1-805-218-7673','Driver\'s License','F7V3A5RODI2J','fschowalter@example.net',NULL,NULL,'$2y$12$56eHgTboEpsKoy/h5yEbQOjHGBNkH77vAVi8RVeQoEfnyIffGqFY6','2025-03-19 08:04:03','2025-03-19 08:04:03',NULL,NULL,NULL),(17,'New','T-64611295','Schmeler-Reinger','Isaiah','Valentin','Gutmann','MD','910.527.6763','Driver\'s License','KFQS2UN8TTWM','lswaniawski@example.com',NULL,NULL,'$2y$12$HnbadxcUTtZyxQz99SmGq.3sDOI0VG1Or0lDHBszQrWF3fW/4vyOC','2025-03-19 08:04:03','2025-03-19 08:04:03',NULL,NULL,NULL),(18,'New','T-75378769','Koelpin-Bechtelar','Rupert',NULL,'Dibbert',NULL,'1-262-630-3761','Driver\'s License','AOBZTVLSW50Q','ttowne@example.net',NULL,NULL,'$2y$12$ZSK2m.RcpHE6yzLBk9w2JORoxnbboXBhP9kK/R9msiABRwweRP0JO','2025-03-19 08:04:03','2025-03-19 08:04:03',NULL,NULL,NULL),(19,'New','T-13023024','Kuhn, Boyle and Ebert','Arnoldo',NULL,'Ritchie','IV','916.896.7826','Passport','LCRTTU7BHU0R','hand.luther@example.net',NULL,NULL,'$2y$12$L6d7phopkfdg1jDxuN1zJeltzLwtNM9WL/y16hlg7ecea30d/f29W','2025-03-19 08:04:03','2025-03-19 08:04:03',NULL,NULL,NULL),(20,'New','T-96604534','Gusikowski-Windler','Jazmin','Luna','Halvorson',NULL,'+1.678.204.8896','Driver\'s License','Y84QLFJT3YE9','freynolds@example.com',NULL,NULL,'$2y$12$aiNuxeztmF/4cAJUpRRhROFZKW2co.aZ9Wur9ZW2bO6dXw.H/.fi.','2025-03-19 08:04:03','2025-03-19 08:04:03',NULL,NULL,NULL),(21,'Active','T-29588142','O\'Reilly PLC','Ila',NULL,'Wilkinson','Sr.','+1.959.614.9559','National ID','MAE4JATGG4BS','angus.breitenberg@example.com',NULL,NULL,'$2y$12$Bez2svWTWLmGzoVKd9VkOOg1t1NgLFplse5z2Wuy.z9H8kpqdY322','2025-03-19 08:04:21','2025-03-19 08:04:21',NULL,NULL,NULL),(22,'Active','T-49930266','Koss-Hoppe','Maria',NULL,'Schroeder',NULL,'930-900-3044','Driver\'s License','H7FKJALYUYIJ','kaela.labadie@example.org',NULL,NULL,'$2y$12$ekTXWIGEnhwsddy4xTRxlev8l6lu2upsFT04p.mitPD1yfn.hs7GO','2025-03-19 08:04:21','2025-03-19 08:04:21',NULL,NULL,NULL),(23,'Active','T-93975564','McLaughlin and Sons','Maximo','Travon','Kuhlman','DDS','986-218-5753','National ID','3ZM511IX4V0Z','mfadel@example.net',NULL,NULL,'$2y$12$PXQbYsJAS59E8Dkp9MPC1.4dQ8ahaOvBtDsABjNpzK6jQnpAqBe86','2025-03-19 08:04:21','2025-03-19 08:04:21',NULL,NULL,NULL),(24,'Active','T-69716885','Nitzsche LLC','Rocio','Sherman','Fritsch',NULL,'(947) 690-1237','Driver\'s License','4DCA0MDC2TNM','benjamin.bashirian@example.com',NULL,NULL,'$2y$12$VnQXW1GAAZliLN5dmB3QIecH.Ffd/QEGTb/zkXUoN9ImzNBLfjXga','2025-03-19 08:04:21','2025-03-19 08:04:21',NULL,NULL,NULL),(25,'Active','T-49930266','Cummings, Runolfsdottir and Mayer','Armani','Dominic','Stoltenberg',NULL,'217.584.4935','National ID','2ZTBVHK1365D','kaela.labadie@example.org',NULL,NULL,'$2y$12$n3du9jVLAAWGNm1TnUMO/uddhtbYJmV3.N51F793dNx2GlCpYZxCa','2025-03-19 08:04:21','2025-03-19 08:04:21',NULL,NULL,NULL),(26,'Active','T-13662653','Grimes Group','Pat','Tomas','Harber',NULL,'+1 (727) 351-5279','Passport','AAEZWRPWINXS','krolfson@example.com',NULL,NULL,'$2y$12$RqwWdnhuZbFgcLTgo3Ls1u3/DYVDxOqUH2PrJhLweKp.hkWsMgEYS','2025-03-19 08:04:21','2025-03-19 08:04:21',NULL,NULL,NULL),(27,'Active','T-12248111','Kuhlman, Huel and Abbott','Marion',NULL,'Marks',NULL,'279-789-8827','National ID','LDVGWSIQJTGX','cleora.frami@example.org',NULL,NULL,'$2y$12$D.27Vh2JLFA/g5.WmPTecONYiiCbiZqjuLzpwPEsjZWUpkMz9N6dW','2025-03-19 08:04:21','2025-03-19 08:04:21',NULL,NULL,NULL),(28,'Active','T-12248111','Pagac Group','Katrine','Janiya','Crooks',NULL,'+1-229-209-1143','National ID','PUNBDOBQEORM','cleora.frami@example.org',NULL,NULL,'$2y$12$LWlwkgDh/RqZWBP/3NyX9uR44StbGpxL2YzZWUfn.kVPrf7Kqs7X2','2025-03-19 08:04:21','2025-03-19 08:04:21',NULL,NULL,NULL),(29,'Active','T-17354065','Rolfson, Tillman and Bahringer','Casimer',NULL,'Homenick','MD','872-994-9090','National ID','G3WZ5N1ILY04','mathilde.mante@example.com',NULL,NULL,'$2y$12$IJ940lEwHqsXcwajlbXMQ.Za5LJep0Y9BXqpeiRwNzc4g4.lXE0QO','2025-03-19 08:04:21','2025-03-19 08:04:21',NULL,NULL,NULL),(30,'Active','T-49930266','Kuphal Group','Otilia','Willow','Smith','MD','1-539-602-0382','National ID','33I84B8TTD1Q','kaela.labadie@example.org',NULL,NULL,'$2y$12$BvE7Th4vC87o6syiO4dHxu8.aegUPSlaj2B5GXFdMwbTzAj7CpS36','2025-03-19 08:04:21','2025-03-19 08:04:21',NULL,NULL,NULL),(31,'Active','T-93975564','Stroman, Doyle and Haley','Dakota','Alex','Brown','Sr.','+1 (651) 922-2319','Passport','SAR7ACP9AWHG','mfadel@example.net',NULL,NULL,'$2y$12$JYwNZxa0WOuIhA7hWSfhS.3MZy5QStKyu0//UFCPU6UE0kLWHMYEm','2025-03-19 08:04:27','2025-03-19 08:04:27',NULL,NULL,NULL),(32,'Active','T-21032846','Brown Ltd','Shad','Nedra','White','DDS','+1-307-904-8923','Driver\'s License','8H95P7EP1GGI','boyd25@example.org',NULL,NULL,'$2y$12$.AeT/Lfr7DZP/TgeDVTWvO3Dhlx7YzbHpZNhG.ajZn2/sLx7fHbYy','2025-03-19 08:04:27','2025-03-19 08:04:27',NULL,NULL,NULL),(33,'Active','T-49930266','Emmerich Ltd','Lynn',NULL,'Schultz','MD','+1-916-295-5017','National ID','RSMQ8BZ0983Q','kaela.labadie@example.org',NULL,NULL,'$2y$12$Ksy8NofXycwdXT2PfieFFucLVHZfocA6FI4hlWZ6KrYtsJk0Vk/oa','2025-03-19 08:04:27','2025-03-19 08:04:27',NULL,NULL,NULL),(34,'Active','T-29588142','Wehner, Sporer and Rempel','Luciano','Mario','Cruickshank',NULL,'(610) 290-6540','Passport','WZOSTXH8DBFL','angus.breitenberg@example.com',NULL,NULL,'$2y$12$LwPQxRgPpff01sjsfPQZvu0iFSO7ZninB9b8k21Ir0qbxFaVlxR.a','2025-03-19 08:04:27','2025-03-19 08:04:27',NULL,NULL,NULL),(35,'Active','T-21032846','Paucek, Cummings and Kuhn','Merl','Keira','Hermiston','IV','(775) 288-2808','National ID','KND03X96CKNS','boyd25@example.org',NULL,NULL,'$2y$12$.Hu6KkDzyqlhCgU2nkyxAOPF3UEQtkM6jnGkr44kFq4g8LH9pFIou','2025-03-19 08:04:27','2025-03-19 08:04:27',NULL,NULL,NULL),(36,'Active','T-12248111','Schultz-Graham','Emiliano',NULL,'Lueilwitz',NULL,'1-820-979-5366','Driver\'s License','WCVMOSZ1PB8L','cleora.frami@example.org',NULL,NULL,'$2y$12$crS62pAL4cGhdcvkvLqvPurBtcHmV320Xpo0qb8wx0ej6YXkj.K/y','2025-03-19 08:04:27','2025-03-19 08:04:27',NULL,NULL,NULL),(37,'Active','T-13662653','Adams-Rosenbaum','Camden',NULL,'Russel',NULL,'+1 (320) 547-8132','Driver\'s License','LY8QYF8QI8HE','krolfson@example.com',NULL,NULL,'$2y$12$zb5FbZYBvK3nMw81xj0JpeBlmFJ3fXAQ5dvnBs0RzjZUU.Eeoh8P.','2025-03-19 08:04:27','2025-03-19 08:04:27',NULL,NULL,NULL),(38,'Active','T-98454492','Wiza and Sons','Ramiro','Gracie','Pollich',NULL,'1-520-464-1036','Passport','E9CBVND2ZDSS','cordell65@example.net',NULL,NULL,'$2y$12$5cPiTH6ujwRv58UY6tIL4egorz91M9tlModR74U4t/S9gVtcHjyFq','2025-03-19 08:04:27','2025-03-19 08:04:27',NULL,NULL,NULL),(39,'Active','T-21032846','Mante-Predovic','Dayne','Freddie','Bartoletti',NULL,'1-573-948-3554','Driver\'s License','W7JE5SBXH9GP','boyd25@example.org',NULL,NULL,'$2y$12$mYvXt9F7LwsLTXYnByUzGeZgQaDDlIRuoAbdHxWlsKNkLUWOmAEOC','2025-03-19 08:04:27','2025-03-19 08:04:27',NULL,NULL,NULL),(40,'Active','T-12248111','Spinka Ltd','Kathlyn','Holden','Schiller',NULL,'+1 (215) 883-5370','Driver\'s License','SEIJRFLNZAK1','cleora.frami@example.org',NULL,NULL,'$2y$12$n23lgIwChG2n.5ocMsRUG.pe8VqSiptAFfSzhPu6QGKI72HZtJKqq','2025-03-19 08:04:27','2025-03-19 08:04:27',NULL,NULL,NULL),(41,'New','T-00056421','Tulay Sakay Cooperative','John Adrian','De Guzman','Sanchez',NULL,'9520350482','passport','P00296021','ja.sanchez@gmail.com',NULL,NULL,'$2y$12$3JK9UjgO5imkZPpjTPlQBeOTJc.u2JFchSHaO2DmXUiT81k/Xsbou','2025-03-22 23:39:20','2025-03-22 23:41:06','2025-03-22 23:39:50',NULL,NULL),(42,'Active','T-00056422','Tara Cooperative','John John',NULL,'Ho',NULL,'639520350481','passport','P00296022','john.ho@gmail.com',NULL,NULL,'$2y$12$0i04I8jUB01THf10Av1otu2ZKTykFCuDtgyAdZlQ3Vg2Yhfc7vwNm','2025-03-23 02:03:37','2025-03-23 13:26:28','2025-03-23 02:18:13',NULL,NULL);
/*!40000 ALTER TABLE `externalusers` ENABLE KEYS */;
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
-- Table structure for table `finances`
--

DROP TABLE IF EXISTS `finances`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `finances` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `accreditation_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entry_year` year NOT NULL,
  `current_assets` decimal(15,2) NOT NULL,
  `noncurrent_assets` decimal(15,2) NOT NULL,
  `total_assets` decimal(15,2) NOT NULL,
  `coop_type` enum('Micro','Small','Medium','Large') COLLATE utf8mb4_unicode_ci NOT NULL,
  `liabilities` decimal(15,2) NOT NULL,
  `members_equity` decimal(15,2) NOT NULL,
  `total_gross_revenues` decimal(15,2) NOT NULL,
  `total_expenses` decimal(15,2) NOT NULL,
  `net_surplus` decimal(15,2) NOT NULL,
  `initial_auth_capital_share` decimal(15,2) NOT NULL,
  `present_auth_capital_share` decimal(15,2) NOT NULL,
  `subscribed_capital_share` decimal(15,2) NOT NULL,
  `paid_up_capital` decimal(15,2) NOT NULL,
  `capital_build_up_scheme` decimal(15,2) NOT NULL,
  `general_reserve_fund` decimal(15,2) NOT NULL,
  `education_training_fund` decimal(15,2) NOT NULL,
  `community_dev_fund` decimal(15,2) NOT NULL,
  `optional_fund` decimal(15,2) NOT NULL,
  `share_capital_interest` decimal(15,2) NOT NULL,
  `patronage_refund` decimal(15,2) NOT NULL,
  `others` decimal(15,2) NOT NULL,
  `total` decimal(15,2) NOT NULL,
  `deficit_from_financial_aspect` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `finances_accreditation_no_foreign` (`accreditation_no`),
  CONSTRAINT `finances_accreditation_no_foreign` FOREIGN KEY (`accreditation_no`) REFERENCES `general_info` (`accreditation_no`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `finances`
--

LOCK TABLES `finances` WRITE;
/*!40000 ALTER TABLE `finances` DISABLE KEYS */;
INSERT INTO `finances` VALUES (1,'2001-170843',2015,4258054.60,7877640.39,12135694.99,'Small',4003949.68,8131745.31,5142357.45,457541.93,4684815.52,7915730.38,10244925.04,262922.00,731637.75,72551.35,1405444.66,468481.55,234240.78,234240.78,936963.10,936963.10,468481.55,4684815.52,0.00,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(2,'2001-170843',1973,455293.35,4554432.15,5009725.50,'Micro',1877025.22,3132700.28,3844331.28,2650285.78,1194045.50,1224852.67,4773761.57,1142601.13,1914213.44,110435.50,358213.65,119404.55,59702.28,59702.28,238809.10,238809.10,119404.55,1194045.50,0.00,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(3,'2009-235166',1996,282217.86,4198173.17,4480391.03,'Small',356900.92,4123490.11,2088080.29,5286404.53,-3198324.24,7424397.75,10915128.35,4581672.57,1001285.14,107916.74,-959497.27,-319832.42,-159916.21,-159916.21,-639664.85,-639664.85,-319832.42,-3198324.24,0.00,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(4,'2009-235166',1996,1664264.72,5470586.94,7134851.66,'Large',3481628.77,3653222.89,4583041.13,2564416.52,2018624.61,4153689.13,4887852.93,4174475.84,3289720.94,176632.19,605587.38,201862.46,100931.23,100931.23,403724.92,403724.92,201862.46,2018624.61,0.00,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(5,'2006-854073',2022,838376.83,5138480.78,5976857.61,'Small',1072430.51,4904427.10,862053.03,7163378.76,-6301325.73,9924662.73,14166267.35,327486.97,1410782.50,107494.51,-1890397.72,-630132.57,-315066.29,-315066.29,-1260265.15,-1260265.15,-630132.57,-6301325.73,0.00,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(6,'2006-854073',2004,3742938.08,5760645.42,9503583.50,'Micro',3667502.63,5836080.87,9190926.94,5946014.08,3244912.86,7142280.15,8200371.60,374516.42,1352899.49,151530.95,973473.86,324491.29,162245.64,162245.64,648982.57,648982.57,324491.29,3244912.86,0.00,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(7,'2012-780778',2000,3103797.40,3154886.57,6258683.97,'Large',4143563.20,2115120.77,6716303.72,4709451.34,2006852.38,7157352.28,8239051.91,2005230.87,4357145.40,189553.09,602055.71,200685.24,100342.62,100342.62,401370.48,401370.48,200685.24,2006852.38,0.00,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(8,'2012-780778',1992,585735.50,5022813.22,5608548.72,'Micro',2944807.39,2663741.33,1678147.56,4961784.00,-3283636.44,1856805.29,4898652.10,552153.77,3598080.19,51418.66,-985090.93,-328363.64,-164181.82,-164181.82,-656727.29,-656727.29,-328363.64,-3283636.44,0.00,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(9,'2005-440858',1984,686108.21,1275478.85,1961587.06,'Small',3041852.14,-1080265.08,4289644.43,811262.87,3478381.56,6222156.30,8523108.73,3435293.08,4337872.52,94623.27,1043514.47,347838.16,173919.08,173919.08,695676.31,695676.31,347838.16,3478381.56,0.00,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(10,'2005-440858',2020,2573941.05,2133791.53,4707732.58,'Micro',1441680.19,3266052.39,2653405.12,8892173.62,-6238768.50,5790656.23,7527109.88,1982908.85,1133086.82,69414.10,-1871630.55,-623876.85,-311938.43,-311938.43,-1247753.70,-1247753.70,-623876.85,-6238768.50,0.00,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(11,'2011-198739',1972,1382117.39,8003607.94,9385725.33,'Medium',65487.01,9320238.32,6916880.17,1107907.88,5808972.29,2680390.11,3768733.64,2929068.11,1679603.11,14467.91,1742691.69,580897.23,290448.61,290448.61,1161794.46,1161794.46,580897.23,5808972.29,0.00,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(12,'2011-198739',1979,1477869.30,826367.05,2304236.35,'Small',738778.45,1565457.90,3973489.90,7856584.96,-3883095.06,1620629.07,3458856.35,3402233.95,2560495.99,159732.94,-1164928.52,-388309.51,-194154.75,-194154.75,-776619.01,-776619.01,-388309.51,-3883095.06,0.00,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(13,'2004-352799',1988,3174090.65,3191571.54,6365662.19,'Small',2966203.89,3399458.30,1316397.33,780787.30,535610.03,7738737.97,8484555.87,626678.76,3987611.78,74239.00,160683.01,53561.00,26780.50,26780.50,107122.01,107122.01,53561.00,535610.03,0.00,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(14,'2004-352799',1971,1593743.66,3953148.18,5546891.84,'Small',4118053.81,1428838.03,6724713.60,5525062.20,1199651.40,8281938.61,9764774.73,1846503.81,2173038.71,37712.76,359895.42,119965.14,59982.57,59982.57,239930.28,239930.28,119965.14,1199651.40,0.00,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(15,'2019-121166',2003,2371875.00,2419750.79,4791625.79,'Medium',242825.50,4548800.29,224815.85,1801761.41,-1576945.56,7394902.20,11607183.37,1296151.37,3716521.69,30433.57,-473083.67,-157694.56,-78847.28,-78847.28,-315389.11,-315389.11,-157694.56,-1576945.56,0.00,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(16,'2019-121166',1986,2264573.49,4594790.13,6859363.62,'Micro',1559846.91,5299516.71,6377485.22,558589.85,5818895.37,9296323.87,14158196.71,3055048.64,4161711.42,66532.25,1745668.61,581889.54,290944.77,290944.77,1163779.07,1163779.07,581889.54,5818895.37,0.00,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(17,'2005-868967',1978,3894606.94,8420429.71,12315036.65,'Large',531042.13,11783994.52,3184465.14,5901925.05,-2717459.91,699894.99,2071682.35,1288504.99,1459274.51,193400.70,-815237.97,-271745.99,-135873.00,-135873.00,-543491.98,-543491.98,-271745.99,-2717459.91,0.00,'2025-03-19 08:04:18','2025-03-19 08:04:18'),(18,'2005-868967',2000,1131952.78,9046637.89,10178590.67,'Medium',1987329.21,8191261.46,3395778.50,7659367.13,-4263588.63,5230496.28,6294297.67,4242064.84,3227105.16,88316.61,-1279076.59,-426358.86,-213179.43,-213179.43,-852717.73,-852717.73,-426358.86,-4263588.63,0.00,'2025-03-19 08:04:18','2025-03-19 08:04:18'),(19,'2020-587898',2016,4885933.21,2694590.60,7580523.81,'Small',1308357.78,6272166.03,8815819.57,5487257.34,3328562.23,4660339.08,5644599.23,5898121.24,1459831.12,68281.68,998568.67,332856.22,166428.11,166428.11,665712.45,665712.45,332856.22,3328562.23,0.00,'2025-03-19 08:04:18','2025-03-19 08:04:18'),(20,'2020-587898',1972,3457410.76,8246447.18,11703857.94,'Micro',4293850.14,7410007.80,3643666.49,6793557.59,-3149891.10,8514551.12,9131901.00,6889072.47,231071.18,198246.20,-944967.33,-314989.11,-157494.56,-157494.56,-629978.22,-629978.22,-314989.11,-3149891.10,0.00,'2025-03-19 08:04:18','2025-03-19 08:04:18');
/*!40000 ALTER TABLE `finances` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `franchises`
--

DROP TABLE IF EXISTS `franchises`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `franchises` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `accreditation_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entry_year` year NOT NULL,
  `route` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cpc_case_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_of_franchise` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mode_of_service` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_of_unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `validity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `franchises_accreditation_no_foreign` (`accreditation_no`),
  CONSTRAINT `franchises_accreditation_no_foreign` FOREIGN KEY (`accreditation_no`) REFERENCES `general_info` (`accreditation_no`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `franchises`
--

LOCK TABLES `franchises` WRITE;
/*!40000 ALTER TABLE `franchises` DISABLE KEYS */;
INSERT INTO `franchises` VALUES (1,'2001-170843',2024,'McCullough Orchard','CPC-9617623','Cooperative','On-Demand','Jeepney','1977-09-25','Quo culpa enim hic incidunt doloremque hic accusamus.','2025-03-19 08:04:16','2025-03-19 08:04:16'),(2,'2001-170843',1983,'Ward Mount','CPC-8838939','Cooperative','Fixed Route','Jeepney','1973-08-17','Recusandae dicta a consequatur alias et beatae qui.','2025-03-19 08:04:16','2025-03-19 08:04:16'),(3,'2009-235166',2015,'Keanu Bridge','CPC-0939519','Individual','Fixed Route','Jeepney','2016-09-05',NULL,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(4,'2009-235166',2002,'Clare Trail','CPC-7757430','Corporation','Fixed Route','Taxi','2008-03-20','Laudantium atque sunt sapiente quo accusamus.','2025-03-19 08:04:16','2025-03-19 08:04:16'),(5,'2006-854073',1996,'Turcotte Lock','CPC-7610691','Corporation','Fixed Route','Jeepney','2004-11-25','Rerum incidunt voluptates sint dolor accusantium praesentium aut aliquam.','2025-03-19 08:04:16','2025-03-19 08:04:16'),(6,'2006-854073',2024,'Halle Haven','CPC-2264359','Cooperative','On-Demand','Taxi','1973-05-02','Molestiae dolorem unde laborum non maxime.','2025-03-19 08:04:16','2025-03-19 08:04:16'),(7,'2012-780778',1998,'Annabelle Union','CPC-1464892','Individual','Shuttle','UV Express','2017-01-20',NULL,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(8,'2012-780778',1978,'Boyer Keys','CPC-2765282','Corporation','Fixed Route','Taxi','2016-11-28','Aliquam praesentium totam nostrum voluptatibus qui dolores.','2025-03-19 08:04:16','2025-03-19 08:04:16'),(9,'2005-440858',2008,'Linnea Plains','CPC-2313892','Corporation','Shuttle','Jeepney','2012-04-10',NULL,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(10,'2005-440858',1995,'Giovanna Fall','CPC-8654122','Cooperative','On-Demand','Jeepney','1999-06-16',NULL,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(11,'2011-198739',2022,'Wehner Turnpike','CPC-3390088','Individual','On-Demand','Taxi','2024-02-25',NULL,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(12,'2011-198739',1970,'Moises Walk','CPC-2941323','Individual','Fixed Route','Bus','1980-07-15',NULL,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(13,'2004-352799',2002,'Viola Extensions','CPC-5619251','Cooperative','Fixed Route','Taxi','1983-09-11','Optio aut ut velit omnis.','2025-03-19 08:04:17','2025-03-19 08:04:17'),(14,'2004-352799',2003,'Reinger Locks','CPC-0550214','Individual','Shuttle','Bus','2018-05-30','Ipsum in ipsam fugiat delectus.','2025-03-19 08:04:17','2025-03-19 08:04:17'),(15,'2019-121166',2008,'Grant Corner','CPC-5814794','Corporation','On-Demand','Bus','1980-05-27','Enim culpa animi illo dolores porro.','2025-03-19 08:04:17','2025-03-19 08:04:17'),(16,'2019-121166',2014,'Cronin Spur','CPC-2057183','Corporation','Fixed Route','UV Express','1992-08-30','Ut qui aut numquam possimus tempora nihil.','2025-03-19 08:04:17','2025-03-19 08:04:17'),(17,'2005-868967',1986,'Holden Square','CPC-4173610','Cooperative','Shuttle','Jeepney','2015-11-21',NULL,'2025-03-19 08:04:18','2025-03-19 08:04:18'),(18,'2005-868967',2022,'Corkery Neck','CPC-8929739','Corporation','On-Demand','Taxi','1972-05-17','Reprehenderit nostrum dolor qui ut.','2025-03-19 08:04:18','2025-03-19 08:04:18'),(19,'2020-587898',1995,'Boehm Haven','CPC-6847356','Cooperative','Fixed Route','Taxi','1987-10-22',NULL,'2025-03-19 08:04:18','2025-03-19 08:04:18'),(20,'2020-587898',1984,'Wilkinson Parkways','CPC-9709754','Corporation','Fixed Route','UV Express','1973-08-03','Ab rerum vitae quasi architecto.','2025-03-19 08:04:18','2025-03-19 08:04:18');
/*!40000 ALTER TABLE `franchises` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `general_info`
--

DROP TABLE IF EXISTS `general_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `general_info` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `application_id` bigint unsigned DEFAULT NULL,
  `accreditation_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `accreditation_certificate_filename` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `validity_date` date DEFAULT NULL,
  `cgs_filename` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `accreditation_date` date NOT NULL,
  `accreditation_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cda_registration_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cda_registration_date` date NOT NULL,
  `common_bond_membership` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `membership_fee` int NOT NULL DEFAULT '0',
  `area` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `region` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `province` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `barangay` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `business_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_mid_initial` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_suffix` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employer_sss_reg_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employer_pagibig_reg_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employer_philhealth_reg_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bir_tin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bir_tax_exemption_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `general_info_email_unique` (`email`),
  UNIQUE KEY `general_info_accreditation_no_unique` (`accreditation_no`),
  KEY `general_info_application_id_foreign` (`application_id`),
  CONSTRAINT `general_info_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `applications` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `general_info`
--

LOCK TABLES `general_info` WRITE;
/*!40000 ALTER TABLE `general_info` DISABLE KEYS */;
INSERT INTO `general_info` VALUES (1,NULL,'2001-170843',NULL,NULL,NULL,NULL,'Bernhard-Huel Cooperative','Dibbert-Bashirian Coop','2024-07-05','Provisional','T-21032846','2018-05-11','Institutional',432,'02','130000000','097332000','043400000','137607041','194 Block 1','boyd25@example.org','637105416467','Charlene','Thompson','Swift','IV','7698330069','3770-5908-3865','25-455397169-4','255-218-543','0KU52I2','2025-03-19 08:04:15','2025-03-19 08:04:15'),(2,NULL,'2009-235166',NULL,NULL,NULL,NULL,'Keebler, Beatty and McClure Cooperative','Weimann Coop','2025-01-19','Provisional','T-49930266','2022-02-15','Associational',418,'01','130000000','072217000','063000000','141102004','314 Block 5','kaela.labadie@example.org','639722321602','Shea','Thompson','Kunze','II','6708581537','3899-5705-3126','22-741432064-6','148-044-926','P2CCFE8IC','2025-03-19 08:04:15','2025-03-19 08:04:15'),(3,NULL,'2006-854073',NULL,NULL,NULL,NULL,'Wuckert, McCullough and Green Cooperative','Huels, Coop','2023-07-12','Provisional','T-93975564','2021-11-28','Institutional',320,'01','120000000','104305000','133900000','112402019','961 Block 1','mfadel@example.net','639148994063','Bailee','Abbott','Franecki',NULL,'8451911812','7385-5417-8200','65-610086204-3','183-793-947','3OR97','2025-03-19 08:04:15','2025-03-19 08:04:15'),(4,NULL,'2012-780778',NULL,NULL,NULL,NULL,'Zboncak, Prosacco and Johnston Cooperative','Feil-Morar Coop','2024-03-13','Provisional','T-69716885','2020-05-14','Others',444,'01','140000000','063031000','112400000','112402019','224 Block 6','benjamin.bashirian@example.com','631940654621','Mckenna','Crooks','Jones','Jr.','1750538760','6771-7083-4839','38-945529934-3','131-353-112','CNT3V','2025-03-19 08:04:15','2025-03-19 08:04:15'),(5,NULL,'2005-440858',NULL,NULL,NULL,NULL,'Barton, Crist and Murphy Cooperative','Ondricka-Jast Coop','2024-12-04','Full','T-12248111','2024-07-22','Associational',237,'03','120000000','137600000','043400000','072217012','259 Block 4','cleora.frami@example.org','633520429926','Guy','Herzog','Tromp','Jr.','7048270669','3359-1683-5935','72-324455684-1','302-335-874','5PJICTALCB','2025-03-19 08:04:15','2025-03-19 08:04:15'),(6,NULL,'2011-198739',NULL,NULL,NULL,NULL,'Padberg and Sons Cooperative','Medhurst, Coop','2024-01-01','Full','T-86043994','2023-07-26','Others',277,'02','030000000','063031000','035400000','072217012','307 Block 7','danny.torphy@example.com','633417526642','Ezra','O\'Kon','Hessel',NULL,'1462796335','8500-6337-1094','01-511100583-2','796-357-968','KWPYLS97','2025-03-19 08:04:15','2025-03-19 08:04:15'),(7,NULL,'2004-352799',NULL,NULL,NULL,NULL,'Block, Leannon and Yundt Cooperative','Kautzer, Coop','2024-03-31','Provisional','T-29588142','2022-01-03','Institutional',104,'03','020000000','104305000','041000000','141102004','126 Block 3','angus.breitenberg@example.com','634540711653','Tiara','Leffler','Bode',NULL,'2654438713','2600-1338-2747','91-020919605-2','974-449-184','CMVEESCW','2025-03-19 08:04:15','2025-03-19 08:04:15'),(8,NULL,'2019-121166',NULL,NULL,NULL,NULL,'Bruen, Schoen and McDermott Cooperative','Reichel, Coop','2021-10-23','Full','T-13662653','2017-05-09','Others',485,'02','160000000','137600000','035400000','072217012','291 Block 2','krolfson@example.com','635168374485','Judy','Hettinger','Blick',NULL,'3647046446','2606-1614-4092','44-665571408-9','081-533-092','L2LEOR13','2025-03-19 08:04:15','2025-03-19 08:04:15'),(9,NULL,'2005-868967',NULL,NULL,NULL,NULL,'Bartell and Sons Cooperative','Franecki Coop','2020-06-08','Provisional','T-17354065','2016-01-10','Residential',178,'03','090000000','104305000','101300000','112402019','669 Block 9','mathilde.mante@example.com','639577003448','Nathan','Crooks','Bogan',NULL,'2818238106','3111-4484-4312','23-458598269-0','039-889-177','HAUMVFUMG','2025-03-19 08:04:15','2025-03-19 08:04:15'),(10,NULL,'2020-587898',NULL,NULL,NULL,NULL,'Bartell LLC Cooperative','Dooley-Ernser Coop','2025-02-19','Provisional','T-98454492','2024-11-28','Institutional',353,'03','010000000','141102000','112400000','137607041','344 Block 9','cordell65@example.net','633256143018','Elvie','Dickinson','Haag',NULL,'1632072602','6437-5291-1168','84-136239723-4','571-414-073','XSN61','2025-03-19 08:04:15','2025-03-19 08:04:15'),(11,NULL,'2025-642835','active','accreditation_20250320_194257.pdf','2026-04-02','cgs_20250320_194257.pdf','Quitzon-Nader',NULL,'2025-03-20',NULL,'T-77796238','1984-09-22','soluta',520,'Littel Terrace','Alaska','Lake Wilhelm','Montana','Kshlerin Club','836 Lauriane ForgesAricland, NM 74460-4481','emanuel92@example.com','639875498756','test','test','test','test','SSS-12341234','P-12341234','PH-12341234','TN-12341234','EX-12341234','2025-03-20 11:35:00','2025-03-20 11:42:57'),(12,NULL,'2025-363923','active','accreditation_20250323_215429.png','2025-12-23','cgs_20250323_215429.png','Johns, Schultz and Conroy',NULL,'2025-03-22',NULL,'T-41067673','1975-09-19','Residential',500,'Jacobson Groves','Florida','Makati City','Montana','Rahsaan Well','12650 O\'Conner PassagePort Bernice, CA 94025','hemmerich@example.com','(929) 818-5167','test','test','test','test','1231','132','123132131','N/A','N/A','2025-03-22 15:10:31','2025-03-23 13:54:30'),(13,32,'2025-436804','active','accreditation_20250323_212626.png','2025-03-26','cgs_20250323_212626.png','Tara Cooperative',NULL,'2025-03-23',NULL,'T-00056422','2025-03-21','Residential',0,'luzon','020000000','N/A','025000000','021510018','143 Lawton','john.hoho@gmail.com','639520350481','test','test','test','test','12-2322323-1','1215-2121-2121','12-121211199-2','121-121-564-234','EXMP-45697-2324','2025-03-23 13:14:18','2025-03-23 13:26:27');
/*!40000 ALTER TABLE `general_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `governance`
--

DROP TABLE IF EXISTS `governance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `governance` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `accreditation_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entry_year` year NOT NULL,
  `role_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `suffix` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `term_start` date NOT NULL,
  `term_end` date DEFAULT NULL,
  `mobile_number` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `governance_email_unique` (`email`),
  KEY `governance_accreditation_no_foreign` (`accreditation_no`),
  CONSTRAINT `governance_accreditation_no_foreign` FOREIGN KEY (`accreditation_no`) REFERENCES `general_info` (`accreditation_no`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `governance`
--

LOCK TABLES `governance` WRITE;
/*!40000 ALTER TABLE `governance` DISABLE KEYS */;
INSERT INTO `governance` VALUES (1,'2001-170843',2011,'Chairperson','Kaci','Adaline','Blick','III','2023-10-21',NULL,'0926152754','windler.hilda@example.com','2025-03-19 08:04:16','2025-03-19 08:04:16'),(2,'2001-170843',2018,'Secretary','Skylar',NULL,'Raynor',NULL,'2014-04-14','2027-10-10','0916973496','hamill.lilliana@example.com','2025-03-19 08:04:16','2025-03-19 08:04:16'),(3,'2001-170843',2016,'Chairperson','Helga','Julia','Lynch','Sr.','2021-07-06',NULL,'0969222793','vbailey@example.org','2025-03-19 08:04:16','2025-03-19 08:04:16'),(4,'2009-235166',2010,'Secretary','Elisabeth',NULL,'Stehr',NULL,'2002-07-17','2023-02-12','0985584229','damien.sporer@example.net','2025-03-19 08:04:16','2025-03-19 08:04:16'),(5,'2009-235166',2023,'Treasurer','Sunny','Jewel','Nikolaus','Jr.','2013-08-24','2015-09-14','0907053103','bahringer.fausto@example.net','2025-03-19 08:04:16','2025-03-19 08:04:16'),(6,'2009-235166',2019,'Vice Chairperson','Halie','Izaiah','Aufderhar',NULL,'1989-04-20','2030-02-21','0995876273','vhintz@example.com','2025-03-19 08:04:16','2025-03-19 08:04:16'),(7,'2006-854073',1993,'Vice Chairperson','Luna',NULL,'Stiedemann',NULL,'2011-03-08','2011-10-16','0960373877','grosenbaum@example.org','2025-03-19 08:04:16','2025-03-19 08:04:16'),(8,'2006-854073',1991,'Chairperson','Afton','Verda','Williamson','III','2018-06-13','2028-09-25','0914281309','schowalter.pearlie@example.org','2025-03-19 08:04:16','2025-03-19 08:04:16'),(9,'2006-854073',2009,'Chairperson','Hildegard','Allan','Zieme','III','1980-10-31','1995-09-14','0903588766','bsenger@example.com','2025-03-19 08:04:16','2025-03-19 08:04:16'),(10,'2012-780778',2016,'Vice Chairperson','Gwen',NULL,'Williamson',NULL,'2008-09-02','2012-05-18','0909993628','emmitt79@example.com','2025-03-19 08:04:16','2025-03-19 08:04:16'),(11,'2012-780778',1971,'Treasurer','Ruby','Shaylee','Thiel','Jr.','1976-12-15','2028-02-22','0917889782','reese59@example.net','2025-03-19 08:04:16','2025-03-19 08:04:16'),(12,'2012-780778',1996,'Chairperson','Nikki','Meagan','West',NULL,'2001-03-13','2015-09-17','0908821429','myrtis.dickinson@example.net','2025-03-19 08:04:16','2025-03-19 08:04:16'),(13,'2005-440858',1976,'Vice Chairperson','Kirstin',NULL,'Adams',NULL,'2002-10-30',NULL,'0959692238','cassandra.tremblay@example.org','2025-03-19 08:04:17','2025-03-19 08:04:17'),(14,'2005-440858',1974,'Vice Chairperson','Lonnie',NULL,'Roob','III','2016-11-29',NULL,'0984193142','keagan18@example.com','2025-03-19 08:04:17','2025-03-19 08:04:17'),(15,'2005-440858',1993,'Secretary','Aniyah',NULL,'O\'Reilly',NULL,'1983-04-17',NULL,'0914706000','ltowne@example.net','2025-03-19 08:04:17','2025-03-19 08:04:17'),(16,'2011-198739',1981,'Treasurer','Kaitlyn',NULL,'Roberts',NULL,'1982-09-15',NULL,'0926048157','emerald.medhurst@example.com','2025-03-19 08:04:17','2025-03-19 08:04:17'),(17,'2011-198739',2021,'Chairperson','Cecilia','Florencio','Goldner',NULL,'1973-02-20',NULL,'0926263294','justen.crooks@example.com','2025-03-19 08:04:17','2025-03-19 08:04:17'),(18,'2011-198739',1994,'Secretary','Jamel','Daphney','Batz',NULL,'2021-12-09',NULL,'0983585187','nrenner@example.net','2025-03-19 08:04:17','2025-03-19 08:04:17'),(19,'2004-352799',1971,'Treasurer','Jordi',NULL,'Grant',NULL,'2001-09-22','2020-02-04','0994521584','larkin.mireille@example.net','2025-03-19 08:04:17','2025-03-19 08:04:17'),(20,'2004-352799',1981,'Treasurer','Zelma',NULL,'Hirthe','Jr.','2009-03-23','2010-09-14','0949983895','gdicki@example.org','2025-03-19 08:04:17','2025-03-19 08:04:17'),(21,'2004-352799',2022,'Chairperson','Lelah',NULL,'Kilback',NULL,'1995-05-15',NULL,'0912036494','theodore.stracke@example.org','2025-03-19 08:04:17','2025-03-19 08:04:17'),(22,'2019-121166',1975,'Vice Chairperson','Magnus','Cleta','Bartoletti',NULL,'1996-08-29','1999-07-21','0941057334','gina05@example.org','2025-03-19 08:04:17','2025-03-19 08:04:17'),(23,'2019-121166',1982,'Secretary','Camilla','Mozell','Eichmann','III','1999-01-28','2000-10-04','0963562323','nyah.nikolaus@example.com','2025-03-19 08:04:17','2025-03-19 08:04:17'),(24,'2019-121166',1982,'Chairperson','Edd',NULL,'Lueilwitz','Jr.','1994-07-08','2019-10-04','0942286784','vleannon@example.com','2025-03-19 08:04:17','2025-03-19 08:04:17'),(25,'2005-868967',2010,'Vice Chairperson','Garett','Jacey','Brown',NULL,'1987-09-26','2027-09-30','0965817963','vhansen@example.com','2025-03-19 08:04:18','2025-03-19 08:04:18'),(26,'2005-868967',2022,'Chairperson','Lina',NULL,'Kertzmann','Jr.','1996-05-14','2004-09-20','0910925290','reinger.hillard@example.org','2025-03-19 08:04:18','2025-03-19 08:04:18'),(27,'2005-868967',1994,'Treasurer','Samantha',NULL,'Johnson','Sr.','2001-11-27',NULL,'0972382574','dmueller@example.com','2025-03-19 08:04:18','2025-03-19 08:04:18'),(28,'2020-587898',1973,'Treasurer','Oral',NULL,'Stroman',NULL,'2012-01-22',NULL,'0951949438','chad73@example.org','2025-03-19 08:04:18','2025-03-19 08:04:18'),(29,'2020-587898',2018,'Chairperson','Leora','Wyatt','Keebler',NULL,'2006-05-02',NULL,'0996031845','ova.little@example.net','2025-03-19 08:04:18','2025-03-19 08:04:18'),(30,'2020-587898',1992,'Secretary','Stephen','Cedrick','Donnelly',NULL,'2022-08-29',NULL,'0957778228','elynch@example.com','2025-03-19 08:04:18','2025-03-19 08:04:18');
/*!40000 ALTER TABLE `governance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `governance_list`
--

DROP TABLE IF EXISTS `governance_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `governance_list` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `externaluser_id` bigint unsigned NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `middlename` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sex` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `start_term` date DEFAULT NULL,
  `end_term` date DEFAULT NULL,
  `address` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sss_enrolled` tinyint(1) DEFAULT NULL,
  `pagibig_enrolled` tinyint(1) DEFAULT NULL,
  `philhealth_enrolled` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `governance_list_externaluser_id_foreign` (`externaluser_id`),
  CONSTRAINT `governance_list_externaluser_id_foreign` FOREIGN KEY (`externaluser_id`) REFERENCES `externalusers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `governance_list`
--

LOCK TABLES `governance_list` WRITE;
/*!40000 ALTER TABLE `governance_list` DISABLE KEYS */;
INSERT INTO `governance_list` VALUES (1,11,'Madisen','Tod','VonRueden','Female','Board Secretary','eddie.mante@example.org','639521002158','2007-03-08','2023-07-21','2027-07-21','83 Block 4 Extension West Rembo',1,1,0,'2025-03-19 08:04:41','2025-03-22 20:15:03'),(2,8,'Lonny','Sabrina','Schimmel','Female','Board Secretary','fmitchell@example.com','432.794.8907','2003-04-07','2024-03-31','2025-03-31',NULL,NULL,NULL,NULL,'2025-03-19 08:04:41','2025-03-19 08:04:41'),(3,7,'Nicole','Kaden','Shields','Female','Board Member','elockman@example.org','864.269.9679','2002-05-10','2024-10-24','2025-10-24',NULL,NULL,NULL,NULL,'2025-03-19 08:04:41','2025-03-19 08:04:41'),(4,6,'Irving','Alisha','Boyer','Female','Vice Chairperson','cleve39@example.net','639879654123','1985-05-13','2023-06-01','2028-06-01','1234 asdf',1,1,1,'2025-03-19 08:04:41','2025-03-19 19:07:39'),(5,4,'Dylan','Nickolas','Sauer','Female','Board Member','evert45@example.org','725-372-8740','2007-04-05','2020-05-18','2022-05-18',NULL,NULL,NULL,NULL,'2025-03-19 08:04:41','2025-03-19 08:04:41'),(6,1,'Marta','Jessyca','Crooks','Male','Board Secretary','llewellyn90@example.net','423.877.5977','2013-11-18','2020-10-21','2022-10-21',NULL,NULL,NULL,NULL,'2025-03-19 08:04:41','2025-03-19 08:04:41'),(7,13,'Oleta','Ada','Kessler','Female','Board Member','xwindler@example.com','(458) 940-7656','1970-09-18','2024-03-22','2026-03-22',NULL,NULL,NULL,NULL,'2025-03-19 08:04:41','2025-03-19 08:04:41'),(8,20,'Warren','Brook','Kerluke','Female','Board Secretary','zhamill@example.net','1-458-617-5095','1994-08-19','2021-07-21','2025-07-21',NULL,NULL,NULL,NULL,'2025-03-19 08:04:41','2025-03-19 08:04:41'),(9,10,'Jake','Theresa','Crist','Female','Board Member','shanon.ernser@example.net','1-774-795-7985','1998-11-09','2020-03-24','2025-03-24',NULL,NULL,NULL,NULL,'2025-03-19 08:04:41','2025-03-19 08:04:41'),(10,13,'Lindsey','Nannie','Shanahan','Male','General Manager','eebert@example.net','(361) 953-2003','2000-09-16','2022-12-27','2026-12-27',NULL,NULL,NULL,NULL,'2025-03-19 08:04:41','2025-03-19 08:04:41'),(11,2,'Carlos',NULL,'Antonio','Male','Chairperson','carlos@gmail.com','639879856489','2007-01-12','2023-01-20','2026-11-25','536bh',1,1,1,'2025-03-19 11:36:35','2025-03-19 11:36:35'),(12,3,'test name','Villaroya','test naem','Female','Chairperson','test123@gmail.com','639896589874','1989-12-01','2020-12-09','2025-12-09','83 Block 4 Extension West Rembo',1,1,1,'2025-03-19 12:40:32','2025-03-19 12:40:32'),(13,3,'12test',NULL,'12test','Male','Vice Chairperson','123test@gmail.com','639875412451','2003-07-01','2025-03-22','2026-03-22','125 jdjdj',0,1,0,'2025-03-19 12:42:27','2025-03-19 12:42:27'),(14,6,'Chair1','Chair1','Chair1','Male','Chairperson','chair1@gmail.com','639875987654','1977-06-08','2024-10-25','2025-10-25','123 asdsd',1,1,1,'2025-03-19 19:07:04','2025-03-19 19:07:04'),(15,11,'Leunamme Rose','Villaroya','Atutubo','Female','GAD Committee Member','GDFGHD@gmail.com','639954278144','2007-02-28','2025-03-27','2025-04-02','83 Block 4 Extension West Rembo',1,1,1,'2025-03-22 20:14:33','2025-03-22 20:14:33'),(16,42,'Leunamme Rose','sdfgh','sdfghkjhgf','Female','GAD Committee Secretary','asdfg@gmail.com','639856420236','2007-03-09','2025-04-02','2025-04-02','ert456',1,1,1,'2025-03-23 04:32:04','2025-03-23 04:32:04');
/*!40000 ALTER TABLE `governance_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grants_donations`
--

DROP TABLE IF EXISTS `grants_donations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `grants_donations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `accreditation_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entry_year` year NOT NULL,
  `acquired_at` date NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `source` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `grants_donations_accreditation_no_foreign` (`accreditation_no`),
  CONSTRAINT `grants_donations_accreditation_no_foreign` FOREIGN KEY (`accreditation_no`) REFERENCES `general_info` (`accreditation_no`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grants_donations`
--

LOCK TABLES `grants_donations` WRITE;
/*!40000 ALTER TABLE `grants_donations` DISABLE KEYS */;
INSERT INTO `grants_donations` VALUES (1,'2001-170843',1993,'2020-08-08',384981.48,'Lebsack, Anderson and Lowe','Ullam qui est voluptatem quibusdam.','2025-03-19 08:04:16','2025-03-19 08:04:16'),(2,'2001-170843',2016,'2024-12-27',364634.45,'Luettgen PLC','Eos voluptatem perspiciatis tempora.','2025-03-19 08:04:16','2025-03-19 08:04:16'),(3,'2009-235166',1978,'2021-10-16',175938.64,'Adams Group','Quaerat esse molestias minima nostrum eligendi ut quidem.','2025-03-19 08:04:16','2025-03-19 08:04:16'),(4,'2009-235166',2000,'2022-04-19',414761.32,'Deckow Group','Necessitatibus laudantium nihil deleniti cupiditate.','2025-03-19 08:04:16','2025-03-19 08:04:16'),(5,'2006-854073',1975,'2021-10-27',436140.00,'Armstrong, Hermiston and Wolf','Velit tempora ipsam qui deserunt.','2025-03-19 08:04:16','2025-03-19 08:04:16'),(6,'2006-854073',1977,'2021-12-17',327400.03,'Wintheiser, Maggio and Schiller','Molestias dolores laborum quam sint doloremque et.','2025-03-19 08:04:16','2025-03-19 08:04:16'),(7,'2012-780778',2004,'2021-05-04',127567.04,'Marks PLC','Sed qui aut facere omnis.','2025-03-19 08:04:17','2025-03-19 08:04:17'),(8,'2012-780778',1983,'2024-05-03',81032.46,'Legros LLC','Optio ea consequatur debitis quo iure pariatur repellendus.','2025-03-19 08:04:17','2025-03-19 08:04:17'),(9,'2005-440858',1973,'2023-07-18',242017.01,'Bruen-McGlynn','Et ad amet amet.','2025-03-19 08:04:17','2025-03-19 08:04:17'),(10,'2005-440858',1974,'2023-02-24',97858.52,'Leuschke-Huel','Nemo qui eum iure maiores cum nemo odio mollitia.','2025-03-19 08:04:17','2025-03-19 08:04:17'),(11,'2011-198739',2014,'2023-11-24',93943.00,'Jaskolski, Medhurst and Tremblay','Accusantium quos qui placeat.','2025-03-19 08:04:17','2025-03-19 08:04:17'),(12,'2011-198739',1999,'2023-04-30',359927.60,'Berge, Welch and Kunze','Id fuga assumenda non perferendis rerum atque.','2025-03-19 08:04:17','2025-03-19 08:04:17'),(13,'2004-352799',1972,'2021-04-17',235756.38,'Jerde-Boehm','Fugit earum beatae qui eos pariatur consequuntur.','2025-03-19 08:04:17','2025-03-19 08:04:17'),(14,'2004-352799',2015,'2023-08-29',464238.16,'Waters, Treutel and Olson','Perferendis et enim tenetur et deserunt.','2025-03-19 08:04:17','2025-03-19 08:04:17'),(15,'2019-121166',1990,'2024-12-17',57663.97,'Braun-Johnston','Recusandae tempore vel eveniet.','2025-03-19 08:04:17','2025-03-19 08:04:17'),(16,'2019-121166',2002,'2022-04-26',42699.58,'Legros, O\'Connell and Langosh','Autem voluptatem excepturi vitae et.','2025-03-19 08:04:17','2025-03-19 08:04:17'),(17,'2005-868967',1996,'2023-11-18',6777.69,'Schumm-Purdy','Totam porro consequatur et ut nam corrupti vel nulla.','2025-03-19 08:04:18','2025-03-19 08:04:18'),(18,'2005-868967',2024,'2023-01-15',78771.26,'Collins, Kertzmann and Kunde','Commodi quo doloremque officia et saepe fugiat optio id.','2025-03-19 08:04:18','2025-03-19 08:04:18'),(19,'2020-587898',2002,'2023-10-06',70446.48,'Nienow-Shanahan','Modi voluptatum facilis ipsum dignissimos molestias.','2025-03-19 08:04:18','2025-03-19 08:04:18'),(20,'2020-587898',2000,'2020-12-09',71233.52,'Wintheiser, Hickle and Dickinson','Incidunt provident inventore quibusdam harum aut delectus laboriosam.','2025-03-19 08:04:18','2025-03-19 08:04:18');
/*!40000 ALTER TABLE `grants_donations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
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
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
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
-- Table structure for table `loans`
--

DROP TABLE IF EXISTS `loans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `loans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `accreditation_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entry_year` year NOT NULL,
  `financing_institution` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `acquired_at` date NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `utilization` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `loans_accreditation_no_foreign` (`accreditation_no`),
  CONSTRAINT `loans_accreditation_no_foreign` FOREIGN KEY (`accreditation_no`) REFERENCES `general_info` (`accreditation_no`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loans`
--

LOCK TABLES `loans` WRITE;
/*!40000 ALTER TABLE `loans` DISABLE KEYS */;
INSERT INTO `loans` VALUES (1,'2001-170843',1984,'Lehner, Bode and Bins','2022-10-15',231825.98,'Vehicle Acquisition','Minus natus officia id impedit.','2025-03-19 08:04:16','2025-03-19 08:04:16'),(2,'2001-170843',2008,'Hoeger, Rempel and Quitzon','2020-09-29',3066215.93,'Vehicle Acquisition','Esse asperiores voluptas facilis atque cumque magnam.','2025-03-19 08:04:16','2025-03-19 08:04:16'),(3,'2009-235166',2019,'Kris-Olson','2015-07-22',526014.20,'Vehicle Acquisition','Dolore voluptatem quibusdam quaerat ullam omnis sequi sed et.','2025-03-19 08:04:16','2025-03-19 08:04:16'),(4,'2009-235166',1977,'Welch-Jerde','2016-06-16',748873.02,'Office Expansion','Iste nihil pariatur qui quia aut eos.','2025-03-19 08:04:16','2025-03-19 08:04:16'),(5,'2006-854073',2015,'Parisian, Schimmel and Hayes','2016-02-07',70441.22,'Technology Upgrade','Qui dolorum consequuntur sit maxime officia ea neque.','2025-03-19 08:04:16','2025-03-19 08:04:16'),(6,'2006-854073',1997,'Davis, Nicolas and Bruen','2024-03-30',1388223.13,'Technology Upgrade','Quas illo laudantium atque saepe et porro.','2025-03-19 08:04:16','2025-03-19 08:04:16'),(7,'2012-780778',1988,'O\'Keefe PLC','2019-06-13',1015759.01,'Technology Upgrade','Voluptas in rerum quia dolore fugit.','2025-03-19 08:04:17','2025-03-19 08:04:17'),(8,'2012-780778',1997,'Roberts and Sons','2024-10-24',1834026.77,'Business Capital','Impedit eaque minus vero odit non autem.','2025-03-19 08:04:17','2025-03-19 08:04:17'),(9,'2005-440858',1996,'Rogahn and Sons','2020-02-12',881560.77,'Vehicle Acquisition','Quaerat autem quibusdam et aut aspernatur qui.','2025-03-19 08:04:17','2025-03-19 08:04:17'),(10,'2005-440858',2022,'White, Pollich and Brown','2023-06-22',1829987.45,'Vehicle Acquisition','Voluptas voluptatum voluptate asperiores.','2025-03-19 08:04:17','2025-03-19 08:04:17'),(11,'2011-198739',1979,'Kuhn-Medhurst','2015-12-17',1746126.45,'Technology Upgrade','Sint sunt sunt nulla nemo laboriosam.','2025-03-19 08:04:17','2025-03-19 08:04:17'),(12,'2011-198739',2001,'Reilly-Murray','2016-08-30',3258634.27,'Vehicle Acquisition','Hic et est doloribus nisi.','2025-03-19 08:04:17','2025-03-19 08:04:17'),(13,'2004-352799',2006,'Labadie LLC','2021-11-17',4800670.65,'Business Capital','Eum modi natus necessitatibus ut nisi omnis.','2025-03-19 08:04:17','2025-03-19 08:04:17'),(14,'2004-352799',1981,'Lebsack, Reichel and Romaguera','2024-08-13',2619728.50,'Technology Upgrade','Excepturi ducimus ad sunt nam ut.','2025-03-19 08:04:17','2025-03-19 08:04:17'),(15,'2019-121166',2005,'Oberbrunner Group','2018-07-18',2574433.85,'Business Capital','Molestiae iure omnis vitae architecto.','2025-03-19 08:04:17','2025-03-19 08:04:17'),(16,'2019-121166',2023,'Schoen-Hammes','2022-03-21',3842708.41,'Technology Upgrade','Non voluptas non ipsam similique ut autem eaque ipsa.','2025-03-19 08:04:17','2025-03-19 08:04:17'),(17,'2005-868967',1990,'Quitzon-Murray','2016-09-01',4655960.02,'Business Capital','Quibusdam et suscipit quia et dolor et.','2025-03-19 08:04:18','2025-03-19 08:04:18'),(18,'2005-868967',1977,'Murray-Adams','2016-08-04',2565301.41,'Vehicle Acquisition','Molestiae libero quas cum quis saepe cumque consectetur.','2025-03-19 08:04:18','2025-03-19 08:04:18'),(19,'2020-587898',2014,'Hickle Group','2016-04-02',1204207.82,'Vehicle Acquisition','Sint nesciunt velit et tenetur corrupti corporis.','2025-03-19 08:04:18','2025-03-19 08:04:18'),(20,'2020-587898',2019,'Jacobs-Kutch','2019-07-10',1848056.00,'Vehicle Acquisition','Provident totam quos ex sed.','2025-03-19 08:04:18','2025-03-19 08:04:18');
/*!40000 ALTER TABLE `loans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `members_masterlist`
--

DROP TABLE IF EXISTS `members_masterlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `members_masterlist` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `externaluser_id` bigint unsigned NOT NULL,
  `share_capital` decimal(15,2) DEFAULT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `middlename` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sex` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employment_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `joined_date` date DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `sss_enrolled` tinyint(1) NOT NULL DEFAULT '0',
  `pagibig_enrolled` tinyint(1) NOT NULL DEFAULT '0',
  `philhealth_enrolled` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `members_masterlist_externaluser_id_foreign` (`externaluser_id`),
  CONSTRAINT `members_masterlist_externaluser_id_foreign` FOREIGN KEY (`externaluser_id`) REFERENCES `externalusers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `members_masterlist`
--

LOCK TABLES `members_masterlist` WRITE;
/*!40000 ALTER TABLE `members_masterlist` DISABLE KEYS */;
INSERT INTO `members_masterlist` VALUES (1,7,NULL,'Dock','Harber','Bayer','Male','Operator',NULL,'christopher53@example.net','346.652.1918','2020-04-21',NULL,NULL,'2025-03-19 08:04:41','2025-03-19 08:04:41',0,0,0),(2,9,NULL,'Andreane','Steuber','Medhurst','Male','Operator',NULL,'rose.dooley@example.org','272-434-6242','1983-10-07',NULL,NULL,'2025-03-19 08:04:41','2025-03-19 08:04:41',0,0,0),(3,16,NULL,'Ashlynn','Treutel','Smith','Female','Operator',NULL,'heidenreich.jay@example.com','+1 (626) 216-4051','2021-11-05',NULL,NULL,'2025-03-19 08:04:41','2025-03-19 08:04:41',0,0,0),(4,5,NULL,'Turner','Goldner','Hackett','Male','Operator',NULL,'vicenta.marks@example.net','+1-707-291-4118','1982-10-12',NULL,NULL,'2025-03-19 08:04:41','2025-03-19 08:04:41',0,0,0),(5,13,NULL,'Lilyan','Bernhard','Gislason','Female','Driver',NULL,'lonie79@example.com','1-414-487-4349','2018-11-09',NULL,NULL,'2025-03-19 08:04:41','2025-03-19 08:04:41',0,0,0),(6,3,2000.00,'Noble','DuBuque','Lebsack','Male','Operator','Regular','afadel@example.org','639094278144','1993-01-07','2025-03-13','83 Block 4 Extension West Rembo','2025-03-19 08:04:41','2025-03-19 12:28:09',1,1,1),(7,15,NULL,'Deven','Paucek','Bernier','Female','Others',NULL,'uschultz@example.com','+15647720727','1982-01-27',NULL,NULL,'2025-03-19 08:04:41','2025-03-19 08:04:41',0,0,0),(8,10,NULL,'Athena','Gottlieb','Gibson','Female','Allied Workers',NULL,'bmcdermott@example.org','248-403-3759','1988-11-21',NULL,NULL,'2025-03-19 08:04:41','2025-03-19 08:04:41',0,0,0),(9,5,NULL,'Verdie','Walter','Vandervort','Female','Others',NULL,'darby.armstrong@example.com','+1-878-823-2920','1978-05-07',NULL,NULL,'2025-03-19 08:04:41','2025-03-19 08:04:41',0,0,0),(10,17,NULL,'Savanah','Quigley','Purdy','Male','Operator',NULL,'twest@example.com','223.963.5984','1983-01-08',NULL,NULL,'2025-03-19 08:04:41','2025-03-19 08:04:41',0,0,0),(11,8,NULL,'Pierce','Tremblay','Gislason','Female','Others',NULL,'imelda69@example.com','+1-417-363-8426','1993-11-11',NULL,NULL,'2025-03-19 08:04:41','2025-03-19 08:04:41',0,0,0),(12,16,NULL,'Jacky','Jast','Jacobi','Male','Driver',NULL,'verner.eichmann@example.net','+1-603-913-4190','2023-07-23',NULL,NULL,'2025-03-19 08:04:41','2025-03-19 08:04:41',0,0,0),(13,10,NULL,'Vance','Volkman','Larkin','Male','Driver',NULL,'mollie.zemlak@example.com','+1-640-807-0910','1982-10-30',NULL,NULL,'2025-03-19 08:04:41','2025-03-19 08:04:41',0,0,0),(14,17,NULL,'Cassidy','Cormier','Mohr','Male','Operator',NULL,'mabelle.yost@example.org','+15162245380','1985-06-19',NULL,NULL,'2025-03-19 08:04:41','2025-03-19 08:04:41',0,0,0),(15,14,NULL,'Mathias','Balistreri','Kessler','Female','Driver',NULL,'herzog.mossie@example.org','860.508.6713','1997-12-13',NULL,NULL,'2025-03-19 08:04:41','2025-03-19 08:04:41',0,0,0),(16,20,NULL,'Anjali','Goldner','Howe','Male','Driver',NULL,'lamont.okeefe@example.com','(972) 528-0516','2005-11-11',NULL,NULL,'2025-03-19 08:04:41','2025-03-19 08:04:41',0,0,0),(17,4,200.00,'Felicia','Brown','Gorczany','Female','Driver','Probationary','larry14@example.com','639858562985','2007-03-09','2025-03-15','98','2025-03-19 08:04:41','2025-03-22 08:44:32',1,1,1),(18,15,NULL,'Lavern','Schamberger','Rutherford','Female','Allied Workers',NULL,'izabella.swift@example.net','+1-283-362-3965','1994-08-14',NULL,NULL,'2025-03-19 08:04:41','2025-03-19 08:04:41',0,0,0),(19,3,500.00,'Emmalee','Hegmann','Quitzon','Male','Allied','Regular','shirley.murazik@example.com','639458976255','1993-07-06','2023-03-03','83 Block 4 Extension West Rembo','2025-03-19 08:04:41','2025-03-19 12:31:06',0,0,1),(20,16,NULL,'Myra','Grimes','Larson','Female','Driver',NULL,'connie.gulgowski@example.com','1-402-889-1524','2023-03-11',NULL,NULL,'2025-03-19 08:04:41','2025-03-19 08:04:41',0,0,0),(21,1,500.00,'Leunamme Rose','Villaroya','Atutubo','Female','Allied','Probationary','leunammerosev.atutubo@gmail.com','639054278144','2002-12-12','2022-02-02','83 Block 4 Extension West Rembo','2025-03-19 08:07:18','2025-03-19 08:07:18',1,1,0),(22,2,500.00,'Leunamme Rose','Villaroya','Atutubo','Female','Driver','Regular','justi@gmail.com','639054278144','2007-03-02','2022-12-12','83 Block 4 Extension West Rembo','2025-03-19 10:42:16','2025-03-19 10:42:16',1,1,0),(23,2,1000.00,'thea','t','thea','Female','Operator','Regular','thea@gmail.com','639548798564','1999-05-04','2000-02-03','83 Block 4 Extension West Rembo','2025-03-19 10:43:20','2025-03-19 10:43:20',1,1,1),(24,2,500.00,'John',NULL,'Michael','Male','Operator','Regular','john@gmail.com','639568974587','2001-04-05','2019-11-04','kskksk','2025-03-19 11:34:31','2025-03-19 11:34:31',1,1,1),(25,3,500.00,'rty','Villaroya','rty','Female','Operator','Probationary','rty@gmail.com','639598745895','2000-02-02','2008-02-22','83 Block 4 Extension West Rembo','2025-03-19 12:48:43','2025-03-19 12:48:43',1,1,0),(26,6,500.00,'Test1',NULL,'Test1','Female','Driver','Probationary','test1@gmail.com','639256487898','2007-03-14','2025-03-19','12   qwer','2025-03-19 18:48:16','2025-03-19 19:00:29',1,1,1),(27,6,1500.00,'Test2',NULL,'Test2','Male','Operator','Regular','test2@gmail.com','639568795471','1999-01-05','2024-05-02','123 asdfa','2025-03-19 18:49:37','2025-03-19 18:49:37',1,1,1),(28,6,500.00,'test3',NULL,'test3','Female','Allied','Regular','test3@gmail.com','639568790471','2004-06-20','2025-03-15','1234 gfhdfj','2025-03-19 18:50:25','2025-03-19 18:50:25',1,1,1),(29,11,500.00,'Leunamme Rose','Villaroya','Atutubo','Female','Allied','Regular','leuna123@gmail.com','639054278144','2007-03-22','2025-03-23','83 Block 4 Extension West Rembo','2025-03-22 20:04:50','2025-03-22 20:04:50',1,1,1),(30,11,500.00,'Rose',NULL,'Atutubo','Female','Operator','Regular','leuna1234@gmail.com','639054278155','2007-03-09','2025-03-23','83 Block 4 Extension West Rembo','2025-03-22 20:06:48','2025-03-22 20:07:03',1,1,1),(31,42,200.00,'Leunamme Rose',NULL,'Atutubo','Female','Operator','Probationary','leuna@von.net','639874521569','2004-02-17','2025-02-17','131 sdgs','2025-03-23 04:09:16','2025-03-23 04:09:16',1,1,1);
/*!40000 ALTER TABLE `members_masterlist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `membership`
--

DROP TABLE IF EXISTS `membership`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `membership` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `accreditation_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entry_year` year NOT NULL,
  `driver_male` int NOT NULL DEFAULT '0',
  `driver_female` int NOT NULL DEFAULT '0',
  `operator_investor_male` int NOT NULL DEFAULT '0',
  `operator_investor_female` int NOT NULL DEFAULT '0',
  `allied_workers_male` int NOT NULL DEFAULT '0',
  `allied_workers_female` int NOT NULL DEFAULT '0',
  `other_member_male` int NOT NULL DEFAULT '0',
  `other_member_female` int NOT NULL DEFAULT '0',
  `number_of_pwd` int NOT NULL DEFAULT '0',
  `number_of_senior` int NOT NULL DEFAULT '0',
  `total_members` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `membership_accreditation_no_foreign` (`accreditation_no`),
  CONSTRAINT `membership_accreditation_no_foreign` FOREIGN KEY (`accreditation_no`) REFERENCES `general_info` (`accreditation_no`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=301 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `membership`
--

LOCK TABLES `membership` WRITE;
/*!40000 ALTER TABLE `membership` DISABLE KEYS */;
INSERT INTO `membership` VALUES (1,'2001-170843',1993,79,95,21,11,13,18,12,4,8,1,253,'2025-03-19 08:04:15','2025-03-19 08:04:15'),(2,'2001-170843',1985,91,60,14,5,5,33,17,5,0,7,230,'2025-03-19 08:04:15','2025-03-19 08:04:15'),(3,'2001-170843',2007,58,75,28,49,23,38,12,5,6,6,288,'2025-03-19 08:04:15','2025-03-19 08:04:15'),(4,'2001-170843',2020,33,57,29,35,29,42,15,3,0,11,243,'2025-03-19 08:04:15','2025-03-19 08:04:15'),(5,'2001-170843',2022,42,47,14,33,4,44,6,17,2,11,207,'2025-03-19 08:04:15','2025-03-19 08:04:15'),(6,'2001-170843',2020,36,85,36,33,43,24,12,4,5,6,273,'2025-03-19 08:04:15','2025-03-19 08:04:15'),(7,'2001-170843',2002,77,47,34,18,13,50,23,24,10,7,286,'2025-03-19 08:04:15','2025-03-19 08:04:15'),(8,'2001-170843',1991,86,42,6,5,39,6,5,18,4,8,207,'2025-03-19 08:04:15','2025-03-19 08:04:15'),(9,'2001-170843',2011,38,87,20,10,35,48,18,29,5,13,285,'2025-03-19 08:04:15','2025-03-19 08:04:15'),(10,'2001-170843',2015,96,2,45,16,50,3,4,30,5,11,246,'2025-03-19 08:04:15','2025-03-19 08:04:15'),(11,'2001-170843',1991,31,53,28,7,2,15,10,2,9,13,148,'2025-03-19 08:04:15','2025-03-19 08:04:15'),(12,'2001-170843',2020,23,20,9,42,21,36,24,26,6,11,201,'2025-03-19 08:04:15','2025-03-19 08:04:15'),(13,'2001-170843',1993,57,4,21,45,26,32,13,3,2,6,201,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(14,'2001-170843',2003,21,41,38,16,2,16,17,11,1,13,162,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(15,'2001-170843',1981,69,46,42,9,9,46,11,8,9,11,240,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(16,'2001-170843',2016,16,37,0,1,9,27,28,8,1,10,126,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(17,'2001-170843',2010,6,25,4,26,11,6,0,6,5,8,84,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(18,'2001-170843',2022,31,96,25,16,37,34,16,4,5,8,259,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(19,'2001-170843',1987,90,90,5,13,24,37,3,28,5,14,290,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(20,'2001-170843',2015,6,52,26,27,7,18,16,4,10,15,156,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(21,'2001-170843',2008,38,25,15,37,17,11,29,27,7,11,199,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(22,'2001-170843',2002,36,47,24,6,29,18,30,16,9,1,206,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(23,'2001-170843',1972,84,11,46,37,39,18,29,20,0,13,284,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(24,'2001-170843',1993,47,77,41,30,32,45,12,11,7,3,295,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(25,'2001-170843',1990,89,88,31,21,12,37,29,7,0,8,314,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(26,'2001-170843',1985,11,86,12,0,41,3,3,13,0,4,169,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(27,'2001-170843',1984,38,73,46,0,23,17,4,30,3,0,231,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(28,'2001-170843',2023,20,64,1,19,23,34,14,23,9,3,198,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(29,'2001-170843',1980,33,33,30,6,10,29,4,8,4,15,153,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(30,'2001-170843',2013,97,2,15,2,36,19,24,16,9,10,211,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(31,'2009-235166',1988,1,95,10,41,9,17,29,24,7,11,226,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(32,'2009-235166',2003,72,75,6,28,33,33,8,27,6,0,282,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(33,'2009-235166',2016,49,98,23,49,4,30,19,15,5,8,287,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(34,'2009-235166',1993,96,92,38,47,37,36,14,3,5,3,363,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(35,'2009-235166',1999,18,70,40,40,2,49,28,22,6,0,269,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(36,'2009-235166',1987,68,88,22,17,44,46,11,28,2,5,324,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(37,'2009-235166',1980,69,93,16,31,9,28,17,10,8,9,273,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(38,'2009-235166',1986,3,67,14,33,40,5,8,11,7,10,181,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(39,'2009-235166',2019,35,50,20,6,29,8,28,10,4,11,186,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(40,'2009-235166',2023,88,97,8,26,40,26,16,2,3,4,303,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(41,'2009-235166',2011,85,86,42,41,48,26,17,16,9,8,361,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(42,'2009-235166',1982,3,84,8,12,40,25,17,3,2,15,192,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(43,'2009-235166',2010,47,38,6,35,22,25,7,12,5,9,192,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(44,'2009-235166',1981,62,35,23,10,39,16,26,30,4,8,241,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(45,'2009-235166',1994,98,85,5,23,32,3,1,6,7,4,253,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(46,'2009-235166',2012,9,95,26,33,23,36,23,2,7,2,247,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(47,'2009-235166',2011,14,77,9,23,4,5,30,4,10,14,166,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(48,'2009-235166',1997,39,98,37,0,27,26,5,0,5,8,232,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(49,'2009-235166',1998,58,57,14,35,43,43,12,25,10,1,287,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(50,'2009-235166',2016,4,81,10,28,42,44,28,11,6,7,248,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(51,'2009-235166',1974,27,29,22,15,29,27,17,20,5,7,186,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(52,'2009-235166',1993,98,68,42,0,36,4,26,14,0,10,288,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(53,'2009-235166',2011,33,77,21,11,21,38,25,24,3,6,250,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(54,'2009-235166',1985,55,65,22,17,4,26,1,2,0,3,192,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(55,'2009-235166',1970,64,97,42,13,20,14,6,12,5,14,268,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(56,'2009-235166',1980,5,31,43,43,11,35,0,30,8,11,198,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(57,'2009-235166',2015,12,19,41,23,35,10,20,0,3,12,160,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(58,'2009-235166',2007,25,95,25,45,0,39,12,2,9,12,243,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(59,'2009-235166',1985,7,65,33,42,28,10,15,25,1,0,225,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(60,'2009-235166',1996,90,75,21,34,41,48,3,1,8,9,313,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(61,'2006-854073',2002,7,62,38,6,23,32,16,29,0,11,213,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(62,'2006-854073',1988,55,55,30,31,22,6,27,12,5,1,238,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(63,'2006-854073',1970,86,13,24,1,19,22,3,30,1,4,198,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(64,'2006-854073',1993,28,87,12,27,49,30,4,15,6,7,252,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(65,'2006-854073',2020,5,83,20,9,4,20,12,26,1,15,179,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(66,'2006-854073',2019,87,42,42,37,11,12,15,0,2,8,246,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(67,'2006-854073',2000,78,51,7,39,12,12,27,2,10,9,228,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(68,'2006-854073',2022,78,4,8,48,49,25,15,30,4,7,257,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(69,'2006-854073',1979,5,18,28,5,4,7,6,10,5,7,83,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(70,'2006-854073',1973,1,56,4,38,44,26,29,2,9,9,200,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(71,'2006-854073',1991,0,5,17,45,45,2,20,26,4,0,160,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(72,'2006-854073',1990,83,24,27,44,28,31,30,16,0,13,283,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(73,'2006-854073',1986,22,62,21,34,40,41,11,7,6,4,238,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(74,'2006-854073',2005,68,7,34,25,4,47,30,2,8,15,217,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(75,'2006-854073',1997,31,72,34,20,29,13,21,6,2,3,226,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(76,'2006-854073',1975,34,61,18,34,42,11,9,11,1,1,220,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(77,'2006-854073',1983,81,61,47,38,7,44,26,0,2,7,304,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(78,'2006-854073',2002,76,50,37,19,37,28,3,22,10,2,272,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(79,'2006-854073',2008,57,83,47,24,11,34,19,30,9,3,305,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(80,'2006-854073',2004,32,4,37,29,42,47,16,6,10,1,213,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(81,'2006-854073',1997,57,16,26,30,3,21,0,8,10,4,161,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(82,'2006-854073',1994,70,97,23,37,43,11,20,12,6,2,313,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(83,'2006-854073',2021,20,96,21,16,4,20,8,3,4,3,188,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(84,'2006-854073',2021,8,91,18,15,5,13,26,19,6,4,195,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(85,'2006-854073',1994,7,76,18,15,0,36,1,14,3,5,167,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(86,'2006-854073',1983,60,39,2,18,8,13,11,11,9,7,162,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(87,'2006-854073',1972,44,71,8,44,3,42,12,17,3,8,241,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(88,'2006-854073',1981,62,22,49,27,23,49,20,18,6,6,270,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(89,'2006-854073',1975,42,46,37,22,11,33,7,21,3,1,219,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(90,'2006-854073',2013,100,48,33,44,27,0,14,3,5,14,269,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(91,'2012-780778',2009,9,14,4,47,31,16,23,29,1,12,173,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(92,'2012-780778',1987,42,26,25,40,46,29,17,24,2,14,249,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(93,'2012-780778',1994,61,90,17,50,21,23,2,11,2,12,275,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(94,'2012-780778',2019,93,78,31,0,50,17,20,19,2,8,308,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(95,'2012-780778',1976,55,21,50,5,38,8,5,19,8,14,201,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(96,'2012-780778',2018,60,89,38,38,36,11,25,26,7,6,323,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(97,'2012-780778',1994,81,3,20,8,12,22,12,3,1,13,161,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(98,'2012-780778',2022,45,55,36,6,23,25,21,20,4,10,231,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(99,'2012-780778',2004,63,82,38,6,17,17,8,23,7,6,254,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(100,'2012-780778',1996,72,7,18,38,36,18,25,4,7,7,218,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(101,'2012-780778',2008,75,23,31,49,22,33,16,22,2,15,271,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(102,'2012-780778',1995,96,91,13,34,27,23,27,11,4,11,322,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(103,'2012-780778',2000,17,83,14,13,26,13,10,27,3,4,203,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(104,'2012-780778',1979,32,31,23,26,34,8,11,22,2,10,187,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(105,'2012-780778',2002,25,48,32,41,38,49,10,25,2,0,268,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(106,'2012-780778',1983,84,33,21,16,24,33,6,3,3,7,220,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(107,'2012-780778',1971,18,66,24,22,8,39,18,29,1,6,224,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(108,'2012-780778',2019,31,31,29,2,18,37,5,23,4,15,176,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(109,'2012-780778',1982,81,2,50,2,7,4,19,28,0,10,193,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(110,'2012-780778',1997,49,76,18,41,38,32,18,30,10,4,302,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(111,'2012-780778',2015,18,86,14,24,40,24,17,13,0,8,236,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(112,'2012-780778',1995,55,46,25,3,35,10,16,19,10,14,209,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(113,'2012-780778',2021,23,92,13,33,15,46,23,19,5,1,264,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(114,'2012-780778',2002,97,23,44,7,9,10,14,12,9,6,216,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(115,'2012-780778',1994,14,40,4,35,16,39,27,4,3,2,179,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(116,'2012-780778',2019,53,2,8,33,40,2,20,2,9,11,160,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(117,'2012-780778',1975,1,53,49,14,36,29,5,16,8,7,203,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(118,'2012-780778',1971,49,42,28,22,11,17,1,9,10,12,179,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(119,'2012-780778',2001,4,45,16,17,18,38,8,27,6,11,173,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(120,'2012-780778',1990,54,7,48,6,45,11,2,12,10,10,185,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(121,'2005-440858',2014,0,82,15,26,18,22,13,9,0,5,185,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(122,'2005-440858',1973,51,89,5,35,38,11,8,25,1,5,262,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(123,'2005-440858',2012,79,38,49,33,18,29,13,20,5,7,279,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(124,'2005-440858',2006,51,72,25,46,7,36,8,13,3,0,258,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(125,'2005-440858',2012,23,52,34,18,1,32,22,28,7,6,210,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(126,'2005-440858',2021,51,71,17,50,41,0,19,1,3,11,250,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(127,'2005-440858',1998,0,9,43,40,45,40,0,30,1,5,207,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(128,'2005-440858',2006,16,53,9,29,27,35,24,18,2,7,211,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(129,'2005-440858',1994,95,8,38,25,13,7,8,15,5,5,209,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(130,'2005-440858',1992,56,17,1,21,12,28,21,17,7,7,173,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(131,'2005-440858',1998,61,19,47,10,19,19,29,23,8,11,227,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(132,'2005-440858',2004,81,40,39,21,10,35,4,19,8,14,249,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(133,'2005-440858',1979,37,52,20,36,13,28,21,22,3,11,229,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(134,'2005-440858',1979,76,84,50,4,34,35,9,2,5,9,294,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(135,'2005-440858',2018,50,99,15,3,43,9,2,11,3,2,232,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(136,'2005-440858',1975,96,97,37,34,31,0,30,16,10,12,341,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(137,'2005-440858',2009,43,13,14,30,23,23,21,12,6,14,179,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(138,'2005-440858',2021,64,95,30,3,4,5,1,5,8,3,207,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(139,'2005-440858',1997,84,56,43,39,36,37,19,19,4,3,333,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(140,'2005-440858',2005,69,57,22,47,3,10,20,1,8,11,229,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(141,'2005-440858',1975,18,54,23,49,39,38,27,4,4,2,252,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(142,'2005-440858',1986,43,14,31,46,2,22,11,19,4,13,188,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(143,'2005-440858',1974,6,11,50,15,20,33,28,9,4,10,172,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(144,'2005-440858',1989,40,61,11,43,27,11,28,18,6,2,239,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(145,'2005-440858',1986,42,85,24,15,25,25,19,10,5,5,245,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(146,'2005-440858',2017,75,100,43,48,43,42,15,27,7,11,393,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(147,'2005-440858',1975,84,16,11,20,46,19,25,2,8,1,223,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(148,'2005-440858',1987,47,86,25,46,26,25,15,6,5,10,276,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(149,'2005-440858',2021,53,9,7,8,0,43,20,8,9,6,148,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(150,'2005-440858',2018,27,0,26,5,11,11,23,5,3,9,108,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(151,'2011-198739',2017,44,17,14,39,5,19,28,27,6,0,193,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(152,'2011-198739',2022,95,56,1,31,25,26,1,4,6,12,239,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(153,'2011-198739',2016,81,96,26,6,46,48,12,12,1,5,327,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(154,'2011-198739',1980,33,46,21,0,29,39,18,17,9,8,203,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(155,'2011-198739',2015,44,91,46,10,36,4,10,12,0,13,253,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(156,'2011-198739',1977,83,2,38,39,9,40,27,12,9,9,250,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(157,'2011-198739',1996,65,63,29,12,42,20,18,7,7,8,256,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(158,'2011-198739',1995,37,80,21,17,50,19,21,30,9,9,275,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(159,'2011-198739',1978,75,5,33,46,33,49,18,16,2,4,275,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(160,'2011-198739',1978,95,72,42,39,12,15,6,0,0,7,281,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(161,'2011-198739',2014,73,29,27,30,13,49,4,11,6,7,236,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(162,'2011-198739',1977,99,52,14,30,49,16,7,20,6,8,287,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(163,'2011-198739',2007,14,25,33,14,18,40,30,15,0,14,189,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(164,'2011-198739',1990,35,80,42,49,25,15,9,12,4,0,267,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(165,'2011-198739',2003,14,24,35,41,38,47,0,11,4,13,210,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(166,'2011-198739',1985,30,100,40,1,49,45,2,28,4,2,295,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(167,'2011-198739',2003,43,27,33,25,8,6,0,19,5,9,161,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(168,'2011-198739',1998,48,100,2,11,19,6,24,24,0,6,234,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(169,'2011-198739',1993,91,99,10,30,7,23,6,22,8,8,288,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(170,'2011-198739',1976,83,100,17,8,21,25,30,29,8,12,313,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(171,'2011-198739',1984,46,26,16,50,47,43,26,21,4,15,275,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(172,'2011-198739',2012,22,11,23,32,2,29,21,29,2,13,169,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(173,'2011-198739',2023,84,97,6,45,37,33,20,24,0,14,346,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(174,'2011-198739',1987,13,55,20,34,13,23,4,4,2,13,166,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(175,'2011-198739',1998,88,18,32,24,48,11,22,9,3,6,252,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(176,'2011-198739',2024,13,64,32,3,41,25,0,27,5,0,205,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(177,'2011-198739',1983,81,32,34,43,11,17,26,8,4,3,252,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(178,'2011-198739',1986,56,45,7,23,43,45,18,24,2,0,261,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(179,'2011-198739',1984,75,14,0,48,28,17,21,18,5,5,221,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(180,'2011-198739',1998,83,20,8,6,46,43,23,6,0,13,235,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(181,'2004-352799',1982,92,63,15,7,20,39,15,17,9,13,268,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(182,'2004-352799',2007,93,58,47,28,28,18,28,13,2,12,313,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(183,'2004-352799',1976,7,6,0,2,25,3,10,25,1,7,78,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(184,'2004-352799',2004,28,27,23,9,31,25,11,9,0,10,163,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(185,'2004-352799',2008,45,85,17,43,10,2,27,14,9,5,243,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(186,'2004-352799',2022,60,55,9,4,11,13,9,3,2,11,164,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(187,'2004-352799',1998,9,53,25,16,45,16,5,26,3,11,195,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(188,'2004-352799',2012,7,29,18,45,1,15,3,13,3,7,131,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(189,'2004-352799',1970,60,0,1,7,9,23,29,4,2,11,133,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(190,'2004-352799',1970,88,75,19,13,40,11,27,7,3,4,280,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(191,'2004-352799',1996,30,43,26,22,22,4,18,12,7,3,177,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(192,'2004-352799',1976,11,3,41,29,50,8,7,3,2,1,152,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(193,'2004-352799',2004,12,99,2,40,21,34,10,24,10,10,242,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(194,'2004-352799',2015,4,92,43,15,34,15,0,19,10,12,222,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(195,'2004-352799',2018,25,55,32,40,28,1,20,10,6,11,211,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(196,'2004-352799',1982,9,55,44,18,6,20,13,3,5,3,168,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(197,'2004-352799',2024,7,22,1,27,21,23,24,16,6,0,141,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(198,'2004-352799',1989,16,4,46,9,1,9,13,14,6,14,112,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(199,'2004-352799',1990,75,90,40,4,15,24,14,29,8,12,291,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(200,'2004-352799',1991,89,92,22,29,39,39,13,14,9,11,337,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(201,'2004-352799',1982,82,85,18,18,35,1,14,16,5,3,269,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(202,'2004-352799',2023,90,80,7,47,16,49,19,15,4,5,323,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(203,'2004-352799',2024,0,66,17,18,12,7,16,28,9,7,164,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(204,'2004-352799',2012,95,95,28,38,3,32,29,5,1,3,325,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(205,'2004-352799',2015,15,26,6,10,47,43,7,12,4,8,166,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(206,'2004-352799',2005,11,60,18,40,25,18,29,25,3,6,226,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(207,'2004-352799',1998,30,13,10,26,39,34,24,4,9,1,180,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(208,'2004-352799',1992,23,40,44,36,5,21,19,30,4,9,218,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(209,'2004-352799',1985,25,55,43,5,19,40,26,26,6,1,239,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(210,'2004-352799',1978,15,68,30,11,25,29,10,6,2,13,194,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(211,'2019-121166',2019,8,31,48,12,32,43,23,13,4,6,210,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(212,'2019-121166',1979,82,92,20,8,39,21,21,12,3,5,295,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(213,'2019-121166',2019,88,58,4,4,39,41,6,28,7,12,268,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(214,'2019-121166',2007,6,71,3,44,46,21,21,27,8,13,239,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(215,'2019-121166',1994,87,15,15,14,36,43,14,26,9,0,250,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(216,'2019-121166',1980,57,57,30,32,34,43,13,3,5,12,269,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(217,'2019-121166',1999,6,64,11,34,48,20,26,0,7,15,209,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(218,'2019-121166',1974,34,90,32,25,47,10,28,26,0,15,292,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(219,'2019-121166',1999,99,48,46,22,33,14,17,6,9,12,285,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(220,'2019-121166',2011,54,9,4,15,47,45,15,23,10,3,212,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(221,'2019-121166',1972,17,82,6,17,11,3,28,3,8,1,167,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(222,'2019-121166',1974,51,9,38,24,8,47,25,5,5,12,207,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(223,'2019-121166',2020,61,25,13,39,42,27,26,4,0,7,237,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(224,'2019-121166',1978,12,56,8,42,5,40,28,18,3,11,209,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(225,'2019-121166',1979,74,25,10,48,2,33,28,1,8,15,221,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(226,'2019-121166',2009,95,63,2,24,43,45,4,18,3,8,294,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(227,'2019-121166',1999,96,25,32,4,16,2,19,21,1,12,215,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(228,'2019-121166',1983,96,84,28,43,37,45,27,2,1,9,362,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(229,'2019-121166',1979,28,58,0,13,43,0,0,13,7,5,155,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(230,'2019-121166',1985,75,84,25,50,0,22,11,19,5,2,286,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(231,'2019-121166',2009,23,17,24,11,44,16,13,29,3,8,177,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(232,'2019-121166',1996,9,19,4,24,10,8,16,26,8,5,116,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(233,'2019-121166',1996,51,28,2,32,19,0,8,22,0,0,162,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(234,'2019-121166',1986,82,19,18,30,39,38,10,4,3,2,240,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(235,'2019-121166',1990,73,78,36,31,41,17,23,2,1,8,301,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(236,'2019-121166',2002,69,27,36,32,19,32,7,27,10,12,249,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(237,'2019-121166',1973,94,43,2,35,16,23,0,29,1,7,242,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(238,'2019-121166',1986,74,90,2,9,18,21,11,5,1,8,230,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(239,'2019-121166',2005,88,2,10,40,40,6,7,29,0,11,222,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(240,'2019-121166',1988,41,11,7,21,39,5,20,0,0,11,144,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(241,'2005-868967',2020,26,21,47,16,13,44,13,8,2,3,188,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(242,'2005-868967',1971,28,44,25,2,39,37,15,25,7,10,215,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(243,'2005-868967',1974,72,25,4,27,18,37,9,21,10,2,213,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(244,'2005-868967',1977,39,5,5,38,5,41,27,12,2,6,172,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(245,'2005-868967',1976,95,43,22,11,10,30,27,19,0,2,257,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(246,'2005-868967',2008,20,70,42,37,35,11,11,25,4,10,251,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(247,'2005-868967',1980,58,1,40,34,22,40,6,13,5,1,214,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(248,'2005-868967',2014,17,20,5,16,20,14,16,4,1,6,112,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(249,'2005-868967',1989,95,71,18,26,16,23,15,16,0,0,280,'2025-03-19 08:04:18','2025-03-19 08:04:18'),(250,'2005-868967',1992,35,2,38,49,50,0,5,1,4,12,180,'2025-03-19 08:04:18','2025-03-19 08:04:18'),(251,'2005-868967',2007,92,39,40,44,37,26,12,16,5,14,306,'2025-03-19 08:04:18','2025-03-19 08:04:18'),(252,'2005-868967',1993,51,39,22,39,44,18,13,7,2,5,233,'2025-03-19 08:04:18','2025-03-19 08:04:18'),(253,'2005-868967',2012,73,53,20,10,5,24,26,7,2,7,218,'2025-03-19 08:04:18','2025-03-19 08:04:18'),(254,'2005-868967',2014,15,87,12,20,22,50,26,15,3,10,247,'2025-03-19 08:04:18','2025-03-19 08:04:18'),(255,'2005-868967',2003,18,100,29,7,35,18,12,3,4,5,222,'2025-03-19 08:04:18','2025-03-19 08:04:18'),(256,'2005-868967',1982,35,30,1,42,11,1,28,21,5,13,169,'2025-03-19 08:04:18','2025-03-19 08:04:18'),(257,'2005-868967',2001,15,7,13,4,34,23,2,20,6,11,118,'2025-03-19 08:04:18','2025-03-19 08:04:18'),(258,'2005-868967',2023,6,23,49,28,17,6,29,15,8,4,173,'2025-03-19 08:04:18','2025-03-19 08:04:18'),(259,'2005-868967',2021,91,3,14,0,34,45,25,14,3,15,226,'2025-03-19 08:04:18','2025-03-19 08:04:18'),(260,'2005-868967',2009,88,24,5,19,17,46,14,27,5,15,240,'2025-03-19 08:04:18','2025-03-19 08:04:18'),(261,'2005-868967',1983,37,85,13,3,34,42,14,26,7,11,254,'2025-03-19 08:04:18','2025-03-19 08:04:18'),(262,'2005-868967',2013,43,85,45,44,38,9,7,24,2,5,295,'2025-03-19 08:04:18','2025-03-19 08:04:18'),(263,'2005-868967',2019,53,44,23,19,34,41,1,8,4,13,223,'2025-03-19 08:04:18','2025-03-19 08:04:18'),(264,'2005-868967',2006,76,32,19,10,39,9,5,18,10,11,208,'2025-03-19 08:04:18','2025-03-19 08:04:18'),(265,'2005-868967',2013,96,34,2,31,12,23,30,28,5,7,256,'2025-03-19 08:04:18','2025-03-19 08:04:18'),(266,'2005-868967',2014,71,38,42,16,1,35,22,11,6,6,236,'2025-03-19 08:04:18','2025-03-19 08:04:18'),(267,'2005-868967',2021,17,71,27,40,9,10,12,22,10,14,208,'2025-03-19 08:04:18','2025-03-19 08:04:18'),(268,'2005-868967',1993,22,44,2,19,17,43,1,7,8,12,155,'2025-03-19 08:04:18','2025-03-19 08:04:18'),(269,'2005-868967',2020,69,77,20,42,41,22,27,26,2,7,324,'2025-03-19 08:04:18','2025-03-19 08:04:18'),(270,'2005-868967',1995,19,41,18,42,6,38,21,0,3,10,185,'2025-03-19 08:04:18','2025-03-19 08:04:18'),(271,'2020-587898',2003,40,93,20,32,48,33,27,3,4,9,296,'2025-03-19 08:04:18','2025-03-19 08:04:18'),(272,'2020-587898',1999,35,84,27,18,27,33,3,0,2,9,227,'2025-03-19 08:04:18','2025-03-19 08:04:18'),(273,'2020-587898',1978,56,66,25,10,42,8,25,4,8,3,236,'2025-03-19 08:04:18','2025-03-19 08:04:18'),(274,'2020-587898',2018,56,49,20,43,9,30,7,3,10,15,217,'2025-03-19 08:04:18','2025-03-19 08:04:18'),(275,'2020-587898',2011,50,49,44,22,49,6,18,10,4,8,248,'2025-03-19 08:04:18','2025-03-19 08:04:18'),(276,'2020-587898',2004,37,100,30,16,8,18,0,26,1,8,235,'2025-03-19 08:04:18','2025-03-19 08:04:18'),(277,'2020-587898',2007,47,98,34,5,33,33,9,5,10,1,264,'2025-03-19 08:04:18','2025-03-19 08:04:18'),(278,'2020-587898',1978,79,91,17,31,21,26,3,10,4,14,278,'2025-03-19 08:04:18','2025-03-19 08:04:18'),(279,'2020-587898',1974,71,94,3,40,17,34,5,10,0,1,274,'2025-03-19 08:04:18','2025-03-19 08:04:18'),(280,'2020-587898',2015,5,10,46,38,20,9,24,29,4,10,181,'2025-03-19 08:04:18','2025-03-19 08:04:18'),(281,'2020-587898',1997,12,18,3,22,18,30,25,25,5,11,153,'2025-03-19 08:04:18','2025-03-19 08:04:18'),(282,'2020-587898',1972,67,10,10,29,33,26,12,9,1,14,196,'2025-03-19 08:04:18','2025-03-19 08:04:18'),(283,'2020-587898',2004,42,66,13,34,31,45,8,24,6,6,263,'2025-03-19 08:04:18','2025-03-19 08:04:18'),(284,'2020-587898',2007,59,22,42,19,0,41,25,6,4,14,214,'2025-03-19 08:04:18','2025-03-19 08:04:18'),(285,'2020-587898',2003,72,35,15,44,12,6,23,11,8,11,218,'2025-03-19 08:04:18','2025-03-19 08:04:18'),(286,'2020-587898',2023,71,10,50,28,15,49,17,0,8,12,240,'2025-03-19 08:04:18','2025-03-19 08:04:18'),(287,'2020-587898',2017,43,88,7,10,8,39,28,11,9,12,234,'2025-03-19 08:04:18','2025-03-19 08:04:18'),(288,'2020-587898',2020,71,26,39,43,2,24,14,13,8,11,232,'2025-03-19 08:04:18','2025-03-19 08:04:18'),(289,'2020-587898',2009,42,61,30,34,39,1,22,7,1,11,236,'2025-03-19 08:04:18','2025-03-19 08:04:18'),(290,'2020-587898',1974,9,3,0,23,35,26,7,2,2,2,105,'2025-03-19 08:04:18','2025-03-19 08:04:18'),(291,'2020-587898',1979,44,71,31,22,28,41,13,4,9,4,254,'2025-03-19 08:04:18','2025-03-19 08:04:18'),(292,'2020-587898',2024,50,89,46,11,5,10,22,24,5,1,257,'2025-03-19 08:04:18','2025-03-19 08:04:18'),(293,'2020-587898',1982,64,51,14,5,50,9,6,26,3,12,225,'2025-03-19 08:04:18','2025-03-19 08:04:18'),(294,'2020-587898',1978,54,71,43,36,48,22,8,9,1,0,291,'2025-03-19 08:04:18','2025-03-19 08:04:18'),(295,'2020-587898',2025,81,34,37,11,26,12,15,14,10,2,230,'2025-03-19 08:04:18','2025-03-19 08:04:18'),(296,'2020-587898',2016,97,56,12,48,5,1,10,19,8,15,248,'2025-03-19 08:04:18','2025-03-19 08:04:18'),(297,'2020-587898',1986,38,27,0,44,19,28,26,15,5,12,197,'2025-03-19 08:04:18','2025-03-19 08:04:18'),(298,'2020-587898',1979,34,38,2,32,26,0,6,25,9,14,163,'2025-03-19 08:04:18','2025-03-19 08:04:18'),(299,'2020-587898',1986,79,20,32,18,31,48,24,10,6,15,262,'2025-03-19 08:04:18','2025-03-19 08:04:18'),(300,'2020-587898',2010,74,27,6,4,33,46,25,29,4,5,244,'2025-03-19 08:04:18','2025-03-19 08:04:18');
/*!40000 ALTER TABLE `membership` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2024_12_03_181535_create_applications_table',1),(5,'2024_12_04_092411_create_externalusers_table',1),(6,'2025_01_29_063251_create_general_info_table',1),(7,'2025_02_09_070730_add_email_verified_at_to_externalusers',1),(8,'2025_02_18_123236_add_fields_to_applications',1),(9,'2025_02_18_125512_add_message_and_consent_to_applications',1),(10,'2025_02_26_064751_update_externalusers_table',1),(11,'2025_02_26_162118_add_id_type_and_id_number_to_externalusers_table',1),(12,'2025_03_01_023140_add_verification_columns_to_externalusers_table',1),(13,'2025_03_02_032400_modify_status_column_in_applications_table',1),(14,'2025_03_02_032750_create_application_status_histories',1),(15,'2025_03_02_152918_update_enum_status_in_application_status_histories',1),(16,'2025_03_04_034433_create_backup_histories_table',1),(17,'2025_03_07_123017_add_password_changed_to_users_table',1),(18,'2025_03_07_141044_add_mobile_number_to_users_table',1),(19,'2025_03_07_170024_create_edit_requests_table',1),(20,'2025_03_07_173629_create_change_items_table',1),(21,'2025_03_09_052120_add_application_type_to_applications_table',1),(22,'2025_03_09_100213_create_cooperative_information',2),(23,'2025_03_09_103842_create_record_management',2),(24,'2025_03_10_165208_add_joined_date_and_address_to_members_masterlist',2),(25,'2025_03_11_020647_add_enrollment_fields_to_members_masterlist',2),(26,'2025_03_11_020858_add_enrollment_totals_to_generalinfo',2),(27,'2025_03_11_031419_add_bir_validity_to_coop_info_table',2),(28,'2025_03_11_055749_add_pending_email_to_externalusers',2),(29,'2025_03_11_074202_create_coopunits_table',2),(30,'2025_03_11_080350_add_owned_by_to_coopunits_table',2),(31,'2025_03_12_110611_add_government_details_to_governance_list',2),(32,'2025_03_17_102300_add_employment_type_to_members_masterlist_table',2),(33,'2025_03_17_103922_add_driver_and_operator_columns_to_coop_info_table',2),(34,'2025_03_18_145050_add_share_capital_to_members_masterlist_table',2),(35,'2025_03_18_150324_create_coop_grants_and_donations_table',2),(36,'2025_03_18_180614_create_trainings_table',2),(37,'2025_03_18_190633_create_awards_table',2),(38,'2025_03_19_183608_add_total_members_to_cooptrainings_table',3),(39,'2025_03_19_185958_add_oath_to_applications_table',4),(40,'2025_03_19_194907_create_app_grants_table',5),(41,'2025_03_19_195154_create_app_awards_table',5),(42,'2025_03_20_020523_add_evaluated_and_approved_by_to_applications_table',6),(43,'2025_03_20_180552_add_columns_to_general_infos_table',7),(44,'2025_03_20_181840_add_validity_date_to_general_info_table',8),(45,'2025_03_20_182427_add_release_message_to_applications_table',9),(46,'2025_03_22_222350_add_validity_to_app_general_info_table',10),(47,'2025_03_23_013921_create_report_histories_table',11),(48,'2025_03_23_014428_create_report_histories_table',12),(49,'2025_03_23_115336_create_app_trainings_list_table',13),(50,'2025_03_23_225309_add_application_id_to_general_info_table',14);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `report_histories`
--

DROP TABLE IF EXISTS `report_histories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `report_histories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `report_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `region` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `format` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_id` bigint unsigned NOT NULL,
  `generated_at` timestamp NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `report_histories_admin_id_foreign` (`admin_id`),
  CONSTRAINT `report_histories_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `report_histories`
--

LOCK TABLES `report_histories` WRITE;
/*!40000 ALTER TABLE `report_histories` DISABLE KEYS */;
INSERT INTO `report_histories` VALUES (18,'accredited','2025',NULL,'pdf','accredited_2025_20250323_152613.pdf',1,'2025-03-23 07:26:16','2025-03-23 07:26:16','2025-03-23 07:26:16');
/*!40000 ALTER TABLE `report_histories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `scholarships`
--

DROP TABLE IF EXISTS `scholarships`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `scholarships` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `accreditation_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entry_year` year NOT NULL,
  `course_taken` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `beneficiary` int NOT NULL DEFAULT '0',
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `scholarships_accreditation_no_foreign` (`accreditation_no`),
  CONSTRAINT `scholarships_accreditation_no_foreign` FOREIGN KEY (`accreditation_no`) REFERENCES `general_info` (`accreditation_no`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `scholarships`
--

LOCK TABLES `scholarships` WRITE;
/*!40000 ALTER TABLE `scholarships` DISABLE KEYS */;
INSERT INTO `scholarships` VALUES (1,'2001-170843',2015,'Education',20,'Quam sed velit non fugiat impedit.','2025-03-19 08:04:16','2025-03-19 08:04:16'),(2,'2001-170843',2007,'Business Administration',68,'Qui aperiam temporibus numquam dolores excepturi totam.','2025-03-19 08:04:16','2025-03-19 08:04:16'),(3,'2009-235166',1973,'Education',92,'Autem impedit beatae sint voluptatem rerum repudiandae.','2025-03-19 08:04:16','2025-03-19 08:04:16'),(4,'2009-235166',1992,'Social Work',40,'Pariatur aut eum eum et aperiam magnam autem.','2025-03-19 08:04:16','2025-03-19 08:04:16'),(5,'2006-854073',2021,'Engineering',24,'Fugiat omnis qui nostrum est cupiditate adipisci.','2025-03-19 08:04:16','2025-03-19 08:04:16'),(6,'2006-854073',2025,'Information Technology',47,'Est modi ut ducimus ut blanditiis.','2025-03-19 08:04:16','2025-03-19 08:04:16'),(7,'2012-780778',2015,'Nursing',37,'Aut officiis dolorem a sint quo velit sunt.','2025-03-19 08:04:17','2025-03-19 08:04:17'),(8,'2012-780778',1998,'Social Work',49,'Ipsa fuga velit sit rerum voluptas dolores.','2025-03-19 08:04:17','2025-03-19 08:04:17'),(9,'2005-440858',1988,'Education',70,'Dolores quaerat tempora occaecati quo at qui rerum.','2025-03-19 08:04:17','2025-03-19 08:04:17'),(10,'2005-440858',1970,'Engineering',35,'Unde nihil laudantium reiciendis deserunt.','2025-03-19 08:04:17','2025-03-19 08:04:17'),(11,'2011-198739',1971,'Information Technology',78,'Quo reprehenderit accusantium delectus totam et saepe debitis autem.','2025-03-19 08:04:17','2025-03-19 08:04:17'),(12,'2011-198739',2005,'Engineering',8,'Ea ut provident velit quam.','2025-03-19 08:04:17','2025-03-19 08:04:17'),(13,'2004-352799',1992,'Business Administration',30,'Explicabo quidem minus voluptas voluptate.','2025-03-19 08:04:17','2025-03-19 08:04:17'),(14,'2004-352799',1990,'Accountancy',53,'Praesentium enim placeat nihil iure ut voluptas.','2025-03-19 08:04:17','2025-03-19 08:04:17'),(15,'2019-121166',2024,'Information Technology',90,'Aut atque rerum cumque iure.','2025-03-19 08:04:17','2025-03-19 08:04:17'),(16,'2019-121166',2015,'Social Work',46,'Sit cum eligendi alias repellat.','2025-03-19 08:04:17','2025-03-19 08:04:17'),(17,'2005-868967',2006,'Education',80,'Sit pariatur qui mollitia iusto.','2025-03-19 08:04:18','2025-03-19 08:04:18'),(18,'2005-868967',1982,'Accountancy',35,'Nesciunt ea tempore hic.','2025-03-19 08:04:18','2025-03-19 08:04:18'),(19,'2020-587898',1970,'Nursing',84,'Sapiente ipsam animi qui et similique quis.','2025-03-19 08:04:18','2025-03-19 08:04:18'),(20,'2020-587898',1985,'Engineering',8,'Rerum perferendis error ipsum minus qui.','2025-03-19 08:04:18','2025-03-19 08:04:18');
/*!40000 ALTER TABLE `scholarships` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
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
INSERT INTO `sessions` VALUES ('6MeiXZEqcgVnu9vCOYPv9wMhvbS1AR8i4guXeFVx',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQzJnNGQ4dUdKOG15UTdFMjBPc0VHQ29CNEFEd1FRWmpXc2pxdHh4YiI7czoyMjoiUEhQREVCVUdCQVJfU1RBQ0tfREFUQSI7YTowOnt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHA6Ly9vdGNfbWlzLmNvbTo4MDAxIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1742845432),('E8elRdnPBaAUfLJpjLHQs5RcLj2NHD6GqErpIm86',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiRVdOVUJTQ05CM3hTWWdEanhTMGl3Q1NWcEJYU0ZrS1VhQmdPbDhRbyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHA6Ly9vdGNfbWlzLmNvbTo4MDAyIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1742962886),('inK7lHnHQ7mWoO1CW3kIVKqsd8OaO88PI5no4N44',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiV0VnMG5xb0FDYmwxU0lmTWJiOVlzY0ZUb1NQejJNYkZ0VU5EU3d4aCI7czoyMjoiUEhQREVCVUdCQVJfU1RBQ0tfREFUQSI7YTowOnt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjM6Imh0dHA6Ly9vdGNfbWlzLmNvbTo4MDAxIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1742845432),('kve5i3USugkAdDnzqwO1JmIilaNHnxjo3OX8A1cu',41,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiYUNVb2tSdWxzZTVXVXFRNENhdnNpWlI4ZWo3RDFPSmo0cE1JMGhyciI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyODoiaHR0cDovL290Y19taXMuY29tOjgwMDIvZGFzaCI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjQ5OiJodHRwOi8vb3RjX21pcy5jb206ODAwMi9teWluZm9ybWF0aW9uL2dlbmVyYWxpbmZvIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NDE7fQ==',1742846625),('ZV1Eux2jHlYX0h49gHYe6MKU5kqpJYR38PU0OeHy',42,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoibWFhWXdzR05qazF6ZWRGT0pVdWJCaE5jYWUwZUJTcms1aU0yNmtyRiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDY6Imh0dHA6Ly9vdGNfbWlzLmNvbTo4MDAyL290Y3NlcnZpY2VzL2Nnc3JlbmV3YWwiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo0Mjt9',1742844334);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trainings_seminars`
--

DROP TABLE IF EXISTS `trainings_seminars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `trainings_seminars` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `accreditation_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entry_year` year NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `no_of_attendees` int NOT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trainings_seminars_accreditation_no_foreign` (`accreditation_no`),
  CONSTRAINT `trainings_seminars_accreditation_no_foreign` FOREIGN KEY (`accreditation_no`) REFERENCES `general_info` (`accreditation_no`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trainings_seminars`
--

LOCK TABLES `trainings_seminars` WRITE;
/*!40000 ALTER TABLE `trainings_seminars` DISABLE KEYS */;
INSERT INTO `trainings_seminars` VALUES (1,'2001-170843',1987,'Molestias autem dolores sed libero.','1972-12-15','2010-02-10',85,'Exercitationem itaque et at inventore.','2025-03-19 08:04:16','2025-03-19 08:04:16'),(2,'2001-170843',1994,'Vero quo harum nihil vel.','2015-09-22','2016-02-19',83,'Non quos asperiores unde et praesentium veniam.','2025-03-19 08:04:16','2025-03-19 08:04:16'),(3,'2009-235166',1992,'Facilis non recusandae vero aliquam officiis ut.','1980-09-03','2011-01-19',76,'Sint unde odit tenetur aliquid.','2025-03-19 08:04:16','2025-03-19 08:04:16'),(4,'2009-235166',1996,'Tempora beatae molestias labore laboriosam.','2011-01-29','2023-09-07',79,'Sint aut libero iste quam et.','2025-03-19 08:04:16','2025-03-19 08:04:16'),(5,'2006-854073',2010,'Voluptas voluptatem nulla beatae sed.','1989-11-06','1995-05-26',96,'Natus quidem dolor enim qui.','2025-03-19 08:04:16','2025-03-19 08:04:16'),(6,'2006-854073',1997,'Quod voluptatem fugit eveniet sit corrupti corporis et.','2014-04-29','2022-06-08',43,'Modi quia dolores inventore deleniti.','2025-03-19 08:04:16','2025-03-19 08:04:16'),(7,'2012-780778',1985,'Nulla est suscipit blanditiis nam necessitatibus veritatis quaerat.','2009-05-20','2021-12-02',85,'Itaque rem et impedit repudiandae distinctio accusantium.','2025-03-19 08:04:17','2025-03-19 08:04:17'),(8,'2012-780778',1975,'Quibusdam consequuntur facilis eum sed laborum.','1986-08-01','2021-03-07',99,'Sed maiores nobis et ab et corrupti nihil.','2025-03-19 08:04:17','2025-03-19 08:04:17'),(9,'2005-440858',1972,'Ipsa totam culpa alias amet dolor minus.','1995-07-11','2013-09-22',37,'Nemo dolorum aut autem animi aut.','2025-03-19 08:04:17','2025-03-19 08:04:17'),(10,'2005-440858',2010,'Qui quia enim omnis iste id nisi.','2018-08-30','2022-05-09',36,'Quaerat et ea rerum quaerat.','2025-03-19 08:04:17','2025-03-19 08:04:17'),(11,'2011-198739',2021,'Sed voluptatem amet aliquam neque.','1987-03-28','2024-10-26',71,'Qui vel consequatur ut repudiandae pariatur necessitatibus odio.','2025-03-19 08:04:17','2025-03-19 08:04:17'),(12,'2011-198739',2022,'Sit quibusdam harum architecto laboriosam tempora distinctio.','2015-01-29','2016-02-03',100,'Modi laboriosam explicabo ad similique non molestiae sed.','2025-03-19 08:04:17','2025-03-19 08:04:17'),(13,'2004-352799',2004,'Est tempore qui et non quae ab.','1989-04-12','2003-01-04',5,'Vero sed esse modi aut ea mollitia ut.','2025-03-19 08:04:17','2025-03-19 08:04:17'),(14,'2004-352799',1977,'Quia omnis fugiat nam cumque ut libero mollitia nobis.','2020-07-05','2021-09-12',22,'Cumque velit at corrupti eum.','2025-03-19 08:04:17','2025-03-19 08:04:17'),(15,'2019-121166',1981,'Enim dicta voluptatum qui officia.','2020-12-21','2023-09-15',88,'Qui vitae voluptas rem aperiam quisquam at dolor.','2025-03-19 08:04:17','2025-03-19 08:04:17'),(16,'2019-121166',1985,'Facere nobis sunt ullam earum officia magnam vero reprehenderit.','2000-05-21','2019-03-08',32,'Et earum quia molestiae ut numquam.','2025-03-19 08:04:17','2025-03-19 08:04:17'),(17,'2005-868967',1983,'Debitis est nihil repellendus officia neque culpa modi.','2010-04-19','2014-12-20',47,'Temporibus id sapiente quo similique ullam delectus et.','2025-03-19 08:04:18','2025-03-19 08:04:18'),(18,'2005-868967',1993,'Ducimus omnis saepe asperiores ducimus placeat consequatur qui.','2024-12-02','2025-01-24',59,'Voluptatem consequatur suscipit ut fuga.','2025-03-19 08:04:18','2025-03-19 08:04:18'),(19,'2020-587898',1995,'Consequatur a doloribus ducimus optio ea.','2019-03-06','2022-07-13',72,'Dignissimos optio possimus est et distinctio.','2025-03-19 08:04:18','2025-03-19 08:04:18'),(20,'2020-587898',2001,'Aut et temporibus aliquam rerum hic consequuntur.','1983-03-30','1987-02-03',8,'Et aut dolor quisquam sint possimus maiores.','2025-03-19 08:04:18','2025-03-19 08:04:18');
/*!40000 ALTER TABLE `trainings_seminars` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `units`
--

DROP TABLE IF EXISTS `units`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `units` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `accreditation_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entry_year` year NOT NULL,
  `mode_of_service` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_of_unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cooperatively_owned` int NOT NULL DEFAULT '0',
  `individually_owned` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `units_accreditation_no_foreign` (`accreditation_no`),
  CONSTRAINT `units_accreditation_no_foreign` FOREIGN KEY (`accreditation_no`) REFERENCES `general_info` (`accreditation_no`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `units`
--

LOCK TABLES `units` WRITE;
/*!40000 ALTER TABLE `units` DISABLE KEYS */;
INSERT INTO `units` VALUES (1,'2001-170843',1973,'Demand Responsive','Jeepney',3,79,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(2,'2001-170843',2014,'Fixed Route','Jeepney',91,40,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(3,'2009-235166',2022,'Fixed Route','Bus',53,81,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(4,'2009-235166',2006,'Demand Responsive','Jeepney',59,68,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(5,'2006-854073',2021,'Point-to-Point','Jeepney',47,88,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(6,'2006-854073',1982,'Fixed Route','Jeepney',98,96,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(7,'2012-780778',1992,'Fixed Route','Van',95,32,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(8,'2012-780778',2016,'Point-to-Point','Bus',57,47,'2025-03-19 08:04:16','2025-03-19 08:04:16'),(9,'2005-440858',2000,'Point-to-Point','Van',58,54,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(10,'2005-440858',2002,'Point-to-Point','Van',37,83,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(11,'2011-198739',1996,'Fixed Route','Bus',70,11,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(12,'2011-198739',1989,'Point-to-Point','Jeepney',14,0,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(13,'2004-352799',1990,'Point-to-Point','Tricycle',87,0,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(14,'2004-352799',1974,'Fixed Route','Tricycle',61,76,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(15,'2019-121166',1980,'Fixed Route','Tricycle',54,85,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(16,'2019-121166',1997,'Point-to-Point','Jeepney',77,54,'2025-03-19 08:04:17','2025-03-19 08:04:17'),(17,'2005-868967',1981,'Point-to-Point','Jeepney',50,62,'2025-03-19 08:04:18','2025-03-19 08:04:18'),(18,'2005-868967',1973,'Point-to-Point','Van',56,59,'2025-03-19 08:04:18','2025-03-19 08:04:18'),(19,'2020-587898',1973,'Point-to-Point','Van',72,99,'2025-03-19 08:04:18','2025-03-19 08:04:18'),(20,'2020-587898',1985,'Point-to-Point','Bus',80,14,'2025-03-19 08:04:18','2025-03-19 08:04:18');
/*!40000 ALTER TABLE `units` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middlename` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `suffix` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `division` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_id_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_changed` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `mobile_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_employee_id_no_unique` (`employee_id_no`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Brown',NULL,'Gorczany',NULL,'OD','Officer 1','503257735','alexander32@example.net','2025-03-19 17:52:37','$2y$12$ngVnmljcfDtmV0fKLbVSJuQTGVpZ4LmKZhFKCx4rF5NJ2eFdsLMsm',1,NULL,'2025-03-19 08:04:15','2025-03-19 17:52:51','633218477489'),(2,'Brayan',NULL,'Lesch',NULL,'AFD','Officer 1','810043680','lorine30@example.org',NULL,'$2y$12$ReBEDBfnSiDDPt6iRkoV2Of08iihXvcvmZJFC6DHj99U7m49taaNC',0,NULL,'2025-03-19 08:04:15','2025-03-19 08:04:15','633261147694'),(3,'Palma',NULL,'Kuvalis',NULL,'AFD','Admin','068709221','hoyt06@example.org',NULL,'$2y$12$ReBEDBfnSiDDPt6iRkoV2Of08iihXvcvmZJFC6DHj99U7m49taaNC',0,NULL,'2025-03-19 08:04:15','2025-03-19 08:04:15','631355691141'),(4,'Keira',NULL,'Hermiston',NULL,'OD','Officer 1','376886369','pfannerstill.elyse@example.org',NULL,'$2y$12$ReBEDBfnSiDDPt6iRkoV2Of08iihXvcvmZJFC6DHj99U7m49taaNC',0,NULL,'2025-03-19 08:04:15','2025-03-19 08:04:15','630059087404'),(5,'Kathryne',NULL,'Hessel',NULL,'OD','Officer 1','748692932','lhayes@example.org',NULL,'$2y$12$ReBEDBfnSiDDPt6iRkoV2Of08iihXvcvmZJFC6DHj99U7m49taaNC',0,NULL,'2025-03-19 08:04:15','2025-03-19 08:04:15','636164801283'),(6,'Nat',NULL,'Osinski',NULL,'AFD','Officer 2','180060046','prippin@example.org',NULL,'$2y$12$ReBEDBfnSiDDPt6iRkoV2Of08iihXvcvmZJFC6DHj99U7m49taaNC',0,NULL,'2025-03-19 08:04:15','2025-03-19 08:04:15','636998216955'),(7,'Dayana',NULL,'Romaguera',NULL,'OED','Admin','745204286','royce.ziemann@example.net','2025-03-19 13:12:35','$2y$12$BYbcGl65LAPq4JyARiQSU.J8LCOOTEXvUK9M1vTgAaHPUuL/GmSLy',1,NULL,'2025-03-19 08:04:15','2025-03-19 13:12:51','636765395257'),(8,'Delilah',NULL,'Morar',NULL,'PED','Officer 1','218383957','pfeffer.andreane@example.org',NULL,'$2y$12$ReBEDBfnSiDDPt6iRkoV2Of08iihXvcvmZJFC6DHj99U7m49taaNC',0,NULL,'2025-03-19 08:04:15','2025-03-19 08:04:15','636057128043'),(9,'Natalie',NULL,'Roberts',NULL,'PED','Officer 1','738766741','oma85@example.net',NULL,'$2y$12$ReBEDBfnSiDDPt6iRkoV2Of08iihXvcvmZJFC6DHj99U7m49taaNC',0,NULL,'2025-03-19 08:04:15','2025-03-19 08:04:15','636967281660'),(10,'Ashley',NULL,'Hegmann',NULL,'OED','Officer 1','059949434','jacey58@example.net',NULL,'$2y$12$ReBEDBfnSiDDPt6iRkoV2Of08iihXvcvmZJFC6DHj99U7m49taaNC',0,NULL,'2025-03-19 08:04:15','2025-03-19 08:04:15','636632501562');
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

-- Dump completed on 2025-03-26 12:25:02
