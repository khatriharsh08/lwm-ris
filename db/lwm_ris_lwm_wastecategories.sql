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
-- Table structure for table `lwm_wastecategories`
--

DROP TABLE IF EXISTS `lwm_wastecategories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lwm_wastecategories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `description` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lwm_wastecategories`
--

LOCK TABLES `lwm_wastecategories` WRITE;
/*!40000 ALTER TABLE `lwm_wastecategories` DISABLE KEYS */;
INSERT INTO `lwm_wastecategories` VALUES (1,'Industrial Waste','Waste produced by industrial activities.\r\nCan include hazardous and non-hazardous waste depending on industry. ','2025-07-24 23:40:44','2025-07-27 06:47:00','1'),(2,'Municipal Solid Waste (MSW)','Everyday household or commercial waste like food scraps, paper, packaging, plastics.','2025-07-24 19:00:47','2025-08-01 08:50:46','1'),(3,'Wet Waste','Organic waste such as food scraps, vegetable peels, tea bags, eggshells.','2025-07-26 19:19:28','2025-08-01 08:54:35','0'),(4,'E-waste','Discarded electronic devices, like computers and smartphones, often containing hazardous materials.','2025-07-26 20:04:10','2025-07-26 20:45:04','0'),(5,'Hazardous Waste','Waste that poses a risk to human health or the environment due to its toxic, corrosive, flammable, or reactive nature.\r\nExamples: Industrial chemicals, solvents, pesticides, medical chemicals.','2025-07-27 07:32:48','2025-07-27 07:32:48','0'),(6,'Biomedical Waste (Biohazard Waste)','Waste generated from hospitals, clinics, and laboratories that may be infectious or contaminated.\r\nExamples: Used syringes, bandages, human tissues, laboratory cultures.','2025-07-27 07:33:08','2025-07-27 07:33:08','0'),(7,'Construction and Demolition (C&D) Waste','Debris generated during construction, renovation, or demolition of buildings.\r\nExamples: Concrete, bricks, wood, metal scraps, tiles.','2025-07-27 07:33:37','2025-07-27 07:33:37','0'),(8,'Plastic Waste','All types of plastic materials discarded after use, which can be recyclable or non-recyclable.\r\nExamples: Bottles, packaging materials, plastic bags, disposable cups.','2025-07-27 07:33:54','2025-07-27 07:33:54','0'),(9,'Glass Waste','Waste composed of discarded glass materials, which can often be recycled.\r\nExamples: Broken bottles, window glass, glass jars.','2025-07-27 08:21:08','2025-07-27 08:21:08','0'),(10,'abc','j ,,,,','2025-08-01 08:53:22','2025-08-01 08:54:38','1'),(11,'Harsh Khatri','ddddddddddd','2025-08-01 08:54:46','2025-08-01 08:54:46','0'),(12,'Harsh Khatri','dzzzzz','2025-08-01 08:55:17','2025-08-01 08:55:17','0');
/*!40000 ALTER TABLE `lwm_wastecategories` ENABLE KEYS */;
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
