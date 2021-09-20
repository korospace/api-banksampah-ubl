-- MariaDB dump 10.19  Distrib 10.4.20-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: banksampah
-- ------------------------------------------------------
-- Server version	10.4.20-MariaDB

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
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2021-09-18-224710','App\\Database\\Migrations\\Nasabah','default','App',1632126662,1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nasabah`
--

DROP TABLE IF EXISTS `nasabah`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nasabah` (
  `id` varchar(20) NOT NULL,
  `id_nasabah` varchar(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(40) NOT NULL,
  `notelp` varchar(12) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `tgl_lahir` varchar(20) NOT NULL DEFAULT '03-oktober-2000',
  `kelamin` enum('laki-laki','perempuan') NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `is_verify` enum('yes','no') NOT NULL DEFAULT 'no',
  `otp` varchar(6) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_nasabah` (`id_nasabah`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nasabah`
--

LOCK TABLES `nasabah` WRITE;
/*!40000 ALTER TABLE `nasabah` DISABLE KEYS */;
INSERT INTO `nasabah` VALUES ('614851d2750c0','020400001','cstrwahid@gmail.com','korokun123','$2y$10$lcvp9U0DQt0c89gY5941/Ohw/JumeVPVEQs5kqulxlyEtQqq4Y4.a','koro ganteng aja','085255352493','cendana residence blok b1 no2, serua, ciputat','03-oktober-2000','laki-laki','eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6IjYxNDg1MWQyNzUwYzAiLCJpZF9uYXNhYmFoIjoiMDIwNDAwMDAxIiwiZXhwaXJlZCI6MTYzMjEzNTMyMn0.1tcYVT9uYSDRbehJqSdU1gQ1glQvyczGPeZ-xgaP9SQ','yes',NULL,'2021-09-20 09:18:10'),('61485ec2c4691','060400002','elkoro424@gmail.com','elkoro123','$2y$10$.XSbRq9PWSvCDR8eqQ2tpObFhnF6ng/65/oE5OX1RoifWyuoUXSie','koro ganteng uyy','085255352499','cendana residence blok b1 no2, serua, ciputat','03-oktober-2000','laki-laki','eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6IjYxNDg1ZWMyYzQ2OTEiLCJpZF9uYXNhYmFoIjoiMDYwNDAwMDAyIiwiZXhwaXJlZCI6MTYzMjEzNjU4NH0.eMf3Bqmsv-IyxGpnMBilEJx6yJj6kVeXARoSPGUQy4U','yes',NULL,'2021-09-20 10:13:23');
/*!40000 ALTER TABLE `nasabah` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-09-20 17:30:59
