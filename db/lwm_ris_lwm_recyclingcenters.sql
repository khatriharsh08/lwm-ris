-- MySQL dump 10.13  Distrib 8.0.42, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: lwm_ris
-- ------------------------------------------------------
-- Server version	9.3.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `lwm_recyclingcenters`
--

DROP TABLE IF EXISTS `lwm_recyclingcenters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lwm_recyclingcenters` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `postal_code` varchar(10) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lwm_recyclingcenters`
--

LOCK TABLES `lwm_recyclingcenters` WRITE;
/*!40000 ALTER TABLE `lwm_recyclingcenters` DISABLE KEYS */;
INSERT INTO `lwm_recyclingcenters` VALUES (1,'Vadodara Enviro Channel Ltd.','Near Vadsar Bridge, GIDC','Vadodara','Gujarat','390010','+91-265-2647272','info@vecl.org','2025-07-28 05:24:14','2025-08-01 09:09:27','0'),(2,'Green Planet Recyclers','Plot 55, Makarpura GIDC','Vadodara','Gujarat','390010','+91-9876543210','contact@greenplanet.in','2025-07-28 05:24:14','2025-07-28 05:24:14','0'),(3,'E-Waste Solutions Hub','A-21, Gorwa Industrial Estate','Vadodara','Gujarat','390016','+91-8765432109','support@ewastehub.com','2025-07-28 05:24:14','2025-07-28 05:24:14','0'),(4,'Surat Paper Mill (Recycling Div.)','Hazira Industrial Area','Surat','Gujarat','394270','+91-261-2860123','recycle@suratpaper.com','2025-07-28 05:24:14','2025-07-28 05:24:14','0'),(5,'Ahmedabad Metal Recyclers','Narol Industrial Area','Ahmedabad','Gujarat','382405','+91-79-25731122','info@amr.co.in','2025-07-28 05:24:14','2025-07-28 05:24:14','0');
/*!40000 ALTER TABLE `lwm_recyclingcenters` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-08-05 21:05:51
