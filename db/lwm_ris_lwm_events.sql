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
-- Table structure for table `lwm_events`
--

DROP TABLE IF EXISTS `lwm_events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lwm_events` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text,
  `date` datetime NOT NULL,
  `venue` varchar(255) NOT NULL,
  `poster_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lwm_events`
--

LOCK TABLES `lwm_events` WRITE;
/*!40000 ALTER TABLE `lwm_events` DISABLE KEYS */;
INSERT INTO `lwm_events` VALUES (1,'Clean & Green Vadodara Drive','Join us for a city-wide cleanliness drive to make our public spaces cleaner. Gloves and bags will be provided.','2025-08-15 08:00:00','Sayaji Baug, Main Gate, Vadodara','1754330021_c2365ea220b308208f0b.jpg','2025-07-28 09:25:36','2025-08-04 12:23:41','0'),(2,'E-Waste Collection Camp','Safely dispose of your old electronics. We will be collecting old computers, phones, batteries, and other e-waste for responsible recycling.','2025-07-01 10:00:00','Kamati Baug, Near Planetarium, Vadodara','1754330509_998e2df6cd38e214dc8f.jpeg','2025-07-28 09:25:36','2025-08-04 12:31:49','0'),(3,'World Environment Day Seminar','A seminar featuring local environmental experts discussing the importance of waste segregation and its impact on our city.','2025-06-05 11:00:00','Auditorium, Faculty of Science, M.S. University, Vadodara','1754330036_3ea2e98fd45dbe4dc266.jpg','2025-07-28 09:25:36','2025-08-04 12:23:56','0'),(4,'Recycling Workshop for Kids','A fun and interactive workshop for children to learn about recycling through crafts and games. All materials will be provided.','2025-08-02 15:00:00','Bright Day School, Vasna Bhayli Road, Vadodara','1754330104_0c8d4f9c6d6de53acdc9.jpg','2025-07-28 09:25:36','2025-08-04 12:25:04','0'),(6,'Say No to Plastic Bags Campaign','An awareness campaign to promote the use of cloth and jute bags. Free reusable bags will be distributed.','2025-09-01 17:00:00','Inorbit Mall, Gorwa Road, Vadodara','1754330149_bb87f184e561e494cbca.jpg','2025-07-28 10:44:43','2025-08-04 12:25:49','0'),(7,'Clean & Green Vadodara Drivexxxxxxxxxxxxxx','d','2025-08-02 21:23:00','zvdvs','1753699792_ee37bea44f02324b1e7f.png','2025-07-28 05:19:52','2025-07-28 05:19:52','0'),(8,'Clean & Green Vadodara Drivexxxxxxxxxxxxxx','zsc','2025-08-02 21:25:00','zvdvs','1753699896_22c3cff5e79c4fe5e2b4.png','2025-07-28 05:21:36','2025-07-28 13:30:43','1');
/*!40000 ALTER TABLE `lwm_events` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-08-05 21:05:52
