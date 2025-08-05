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
-- Table structure for table `lwm_contactmessages`
--

DROP TABLE IF EXISTS `lwm_contactmessages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lwm_contactmessages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `submitted_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('pending','done','new') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lwm_contactmessages`
--

LOCK TABLES `lwm_contactmessages` WRITE;
/*!40000 ALTER TABLE `lwm_contactmessages` DISABLE KEYS */;
INSERT INTO `lwm_contactmessages` VALUES (1,'Priya Sharma','priya.sharma@example.com','Question about plastic recycling','Hello, I have a lot of type 5 plastic containers. Can I drop them off at the Makarpura GIDC center? Please let me know. Thanks!','2025-07-28 11:00:00','pending'),(2,'Raj Patel','raj.p@example.com','E-Waste Collection Event Inquiry','I missed the e-waste collection event last month. When is the next one scheduled in the Gorwa area? Thank you.','2025-07-28 04:45:00','done'),(3,'Anjali Mehta','anjali.m@example.com','Volunteering Opportunity','I am a college student and would love to volunteer for one of your cleanliness drives. Are there any upcoming opportunities in Vadodara?','2025-07-27 05:30:00','pending'),(4,'Vikram Singh','vikram.singh@example.com','Feedback on Website','Great initiative! The website is very informative. It would be helpful to have a map view for the recycling centers. Just a suggestion. Keep up the good work!','2025-07-26 15:15:00','done'),(5,'Neha Desai','neha.d@example.com','Bulk Waste Disposal','Our housing society has a large amount of cardboard and paper waste. Do you offer a collection service for bulk amounts?','2025-07-28 11:20:00','pending'),(6,'Harsh Khatri','admin@email.com','zsc','book_clubsdagd c df g g gf gf gf   g f g','2025-07-28 12:28:29','done'),(7,'Harsh Khatri','admin@email.com','zsc','Harshzxcsc','2025-07-28 12:36:59','pending'),(8,'Harsh Khatrixcxfvdfv','admin@email.comz','zsc','Cssvsdvvvvvvvvvvvvvvvvvvvvvvvvv','2025-07-28 12:40:18','done'),(9,'Harsh zzzzzzzzzzzzzzzzzzzzzz','admin@email.comz','zsc','ZCCCCCCCCCCCCCCCCCCCCCCCCCCCCCCccc','2025-07-28 12:42:23','pending'),(10,'zzzzzzzzzzzzzzzz','user@123.h','K HARSH','K HARSHzzzzzzzzzzzzzzzzz','2025-07-28 12:44:33','pending'),(11,'dssd','User@123.h','K HARSH','zXxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx','2025-07-28 17:34:03','done'),(12,'tarun','User@123.t','J Tarun','okkkkkkkkkkkkkkkkkkkkkkkkkkkkkkk','2025-07-28 17:35:31','pending'),(13,'tarun','User@123.t','J Tarun','ddddddddddddddddddddddddd','2025-08-01 18:42:30','pending'),(14,'Today','t@t.t','new check','okkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkk','2025-08-03 13:52:01','pending'),(15,'Today','t@t.t','new check','aaaaaaaaaaaaaaadcsdcdcsdc','2025-08-03 13:58:43','done');
/*!40000 ALTER TABLE `lwm_contactmessages` ENABLE KEYS */;
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
