CREATE DATABASE IF NOT EXISTS `lwm_ris`
  /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */
  /*!80016 DEFAULT ENCRYPTION='N' */;
USE `lwm_ris`;

-- Table structure for table `lwm_contactmessages`
DROP TABLE IF EXISTS `lwm_contactmessages`;
CREATE TABLE `lwm_contactmessages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `submitted_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('pending','done','new') DEFAULT NULL,
  `mobile` int DEFAULT NULL,
  `waste_categories` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table `lwm_contactmessages`
LOCK TABLES `lwm_contactmessages` WRITE;
INSERT INTO `lwm_contactmessages` VALUES
  (1,'Priya Sharma','priya.sharma@example.com','Question about plastic recycling','Hello, I have a lot of type 5 plastic containers. Can I drop them off at the Makarpura GIDC center? Please let me know. Thanks!','2025-07-28 11:00:00','pending',NULL,NULL),
  (2,'Raj Patel','raj.p@example.com','E-Waste Collection Event Inquiry','I missed the e-waste collection event last month. When is the next one scheduled in the Gorwa area? Thank you.','2025-07-28 04:45:00','done',NULL,NULL),
  (3,'Anjali Mehta','anjali.m@example.com','Volunteering Opportunity','I am a college student and would love to volunteer for one of your cleanliness drives. Are there any upcoming opportunities in Vadodara?','2025-07-27 05:30:00','done',NULL,NULL),
  (4,'Vikram Singh','vikram.singh@example.com','Feedback on Website','Great initiative! The website is very informative. It would be helpful to have a map view for the recycling centers. Just a suggestion. Keep up the good work!','2025-07-26 15:15:00','done',NULL,NULL),
  (5,'Neha Desai','neha.d@example.com','Bulk Waste Disposal','Our housing society has a large amount of cardboard and paper waste. Do you offer a collection service for bulk amounts?','2025-07-28 11:20:00','pending',NULL,NULL),
  (20,'Ravi Patel','ravi.patel@example.com','E-Waste Pickup Request','I have old laptops, chargers, and a printer that need to be safely disposed of. Please let me know the pickup schedule.','2025-08-09 11:21:38','pending',2147483647,'["E-waste"]'),
  (21,'Meera Joshi','meera.joshi@example.com','Food Waste Composting','Our restaurant generates large quantities of food scraps daily. We are looking for a composting partner.','2025-08-09 11:29:33','pending',2147483647,'["Food Waste"]'),
  (22,'test','bayatoj893@misehub.com','zscs','sssssssssssssssssss','2025-08-09 11:40:34','pending',2147483647,'["Leather Waste"]');
UNLOCK TABLES;

-- Table structure for table `lwm_events`
DROP TABLE IF EXISTS `lwm_events`;
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table `lwm_events`
LOCK TABLES `lwm_events` WRITE;
INSERT INTO `lwm_events` VALUES
  (1,'Clean & Green Vadodara Drive','Join us for a city-wide cleanliness drive to make our public spaces cleaner. Gloves and bags will be provided...','2025-08-15 08:00:00','Sayaji Baug, Main Gate, Vadodara','1754330021_c2365ea220b308208f0b.jpg','2025-07-28 09:25:36','2025-08-09 11:10:14','0'),
  (2,'E-Waste Collection Camp','Safely dispose of your old electronics. We will be collecting old computers, phones, batteries, and other e-waste for responsible recycling.','2025-09-02 10:00:00','Kamati Baug, Near Planetarium, Vadodara','1754330509_998e2df6cd38e214dc8f.jpeg','2025-07-28 09:25:36','2025-08-09 03:21:18','0'),
  (3,'World Environment Day Seminar','A seminar featuring local environmental experts discussing the importance of waste segregation and its impact on our city.','2025-06-05 11:00:00','Auditorium, Faculty of Science, M.S. University, Vadodara','1754330036_3ea2e98fd45dbe4dc266.jpg','2025-07-28 09:25:36','2025-08-04 12:23:56','0'),
  (4,'Recycling Workshop for Kids','A fun and interactive workshop for children to learn about recycling through crafts and games. All materials will be provided.','2025-08-02 15:00:00','Bright Day School, Vasna Bhayli Road, Vadodara','1754330104_0c8d4f9c6d6de53acdc9.jpg','2025-07-28 09:25:36','2025-08-04 12:25:04','0'),
  (6,'Say No to Plastic Bags Campaign','An awareness campaign to promote the use of cloth and jute bags. Free reusable bags will be distributed.','2025-09-01 17:00:00','Inorbit Mall, Gorwa Road, Vadodara','1754330149_bb87f184e561e494cbca.jpg','2025-07-28 10:44:43','2025-08-04 12:25:49','0'),
  (12,'Riverfront Tree Plantation','Join hands in planting 500 saplings along the riverfront to combat urban heat and improve air quality.','2025-10-05 16:39:00','Sabarmati Riverfront, Ahmedabad','1754737782_80cd974e079c39ca68ec.jpg','2025-08-09 05:39:42','2025-08-09 05:39:42','0'),
  (13,'Solar Energy Awareness Fair','An exhibition showcasing solar energy products, workshops on installation, and subsidy guidance.','2025-11-12 16:40:00','Exhibition Ground, Race Course, Rajkot','1754737945_44e7bb9c945e0a6da796.jpg','2025-08-09 05:41:14','2025-08-09 05:42:25','0');
UNLOCK TABLES;

-- Table structure for table `lwm_recyclingcenters`
DROP TABLE IF EXISTS `lwm_recyclingcenters`;
CREATE TABLE `lwm_recyclingcenters` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `postal_code` varchar(10) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `waste_categories` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table `lwm_recyclingcenters`
LOCK TABLES `lwm_recyclingcenters` WRITE;
INSERT INTO `lwm_recyclingcenters` VALUES
  (1,'Vadodara Enviro Channel Ltd.','Near Vadsar Bridge, GIDC','Vadodara','Gujarat','390010','2652647272','info@vecl.org','Battery Waste','2025-07-28 05:24:14','2025-08-09 04:56:36','0'),
  (2,'Green Planet Recyclers','Plot 55, Makarpura GIDC','Vadodara','Gujarat','390010','9876543210','contact@greenplanet.in','Battery Waste','2025-07-28 05:24:14','2025-08-09 10:13:05','0'),
  (3,'E-Waste Solutions Hub','A-21, Gorwa Industrial Estate','Vadodara','Gujarat','390016','8765432109','support@ewastehub.com','Battery Waste','2025-07-28 05:24:14','2025-08-09 10:13:05','0'),
  (4,'Surat Paper Mill (Recycling Div.)','Hazira Industrial Area','Surat','Gujarat','394270','2612860123','recycle@suratpaper.com','Battery Waste','2025-07-28 05:24:14','2025-08-09 10:13:05','0'),
  (5,'Ahmedabad Metal Recyclers','Narol Industrial Area','Ahmedabad','Gujarat','382405','7925731122','info@amr.co.in','Battery Waste','2025-07-28 05:24:14','2025-08-09 10:13:05','0'),
  (9,'EcoGreen Wet Waste Solutions','Plot 5, Industrial Area, Banashankari','Bengaluru','Karnataka','560085','8024567890','contact@ecogreenblr.in','Wet Waste','2025-08-09 10:04:05','2025-08-09 10:13:05','0'),
  (10,'Chennai Textile Recycling Hub','15B, Apparel Park, Irungattukottai','Chennai','Tamil Nadu','600103','4426789012','info@textilerecyclechennai.in','Textile Waste','2025-08-09 10:04:05','2025-08-09 10:13:05','0'),
  (11,'Kolkata Rubber Recovery Plant','Sector V, Salt Lake','Kolkata','West Bengal','700091','3345678901','support@rubberkolkata.in','Rubber Waste','2025-08-09 10:04:05','2025-08-09 10:13:05','0'),
  (12,'Pune Plastic Recyclers','Plot 42, MIDC, Chakan','Pune','Maharashtra','410501','2027654321','plastic@puneplastics.in','Plastic Waste','2025-08-09 10:04:05','2025-08-09 10:13:05','0'),
  (13,'Jaipur Paper & Cardboard Recycling','Industrial Area, Sitapura','Jaipur','Rajasthan','302022','1412789012','paper@jaipurcardboard.in','Paper and Cardboard Waste','2025-08-09 10:04:05','2025-08-09 10:13:05','0'),
  (14,'Nagpur Packaging Waste Center','Hingna Industrial Estate','Nagpur','Maharashtra','440016','7122456789','packaging@nagpurcenter.in','Packaging Waste','2025-08-09 10:04:05','2025-08-09 10:13:05','0'),
  (15,'Vizag Oil & Grease Disposal Unit','Gajuwaka Industrial Area','Visakhapatnam','Andhra Pradesh','530026','8912765432','oil@vizagrecycle.in','Oil and Grease Waste','2025-08-09 10:04:05','2025-08-09 10:13:05','0'),
  (16,'Lucknow MSW Management Facility','Transport Nagar Industrial Area','Lucknow','Uttar Pradesh','226012','5222456789','msw@lucknowfacility.in','Municipal Solid Waste (MSW)','2025-08-09 10:04:05','2025-08-09 10:13:05','0'),
  (17,'Ranchi Mining Waste Recovery Plant','Kanke Industrial Zone','Ranchi','Jharkhand','834008','6512765432','mining@ranchirecovery.in','Mining Waste','2025-08-09 10:04:05','2025-08-09 10:13:05','0'),
  (18,'Coimbatore Metal Scrap Yard','SIDCO Industrial Estate','Coimbatore','Tamil Nadu','641021','4222456789','metal@coimbatorescrap.in','Metal Scrap Waste','2025-08-09 10:04:05','2025-08-09 10:13:05','0'),
  (19,'Kanpur Leather Recycling Facility','Jajmau Leather Complex','Kanpur','Uttar Pradesh','208010','5122567890','leather@kanpurfacility.in','Leather Waste','2025-08-09 10:04:05','2025-08-09 10:13:05','0'),
  (20,'Bhiwandi Industrial Waste Plant','Anjurphata Industrial Area','Bhiwandi','Maharashtra','421302','2522276543','industrial@bhiwandiwaste.in','Industrial Waste','2025-08-09 10:04:05','2025-08-09 10:13:05','0'),
  (21,'Bhopal Household Hazardous Waste Center','Govindpura Industrial Area','Bhopal','Madhya Pradesh','462023','7552789012','hhw@bhopalcenter.in','Household Hazardous Waste','2025-08-09 10:04:05','2025-08-09 10:13:05','0'),
  (22,'Delhi Hazardous Waste Facility','Okhla Industrial Area','New Delhi','Delhi','110020','1127654321','hazardous@delhicenter.in','Hazardous Waste','2025-08-09 10:04:05','2025-08-09 10:13:05','0'),
  (23,'Guwahati Green Waste Composting Unit','Bamunimaidan Industrial Estate','Guwahati','Assam','781021','3612456789','green@guwahatirecycle.in','Green Waste','2025-08-09 10:04:05','2025-08-09 10:13:05','0'),
  (24,'Patna Glass Recycling Plant','Fatuha Industrial Area','Patna','Bihar','803201','6122789012','glass@patnarecycle.in','Glass Waste','2025-08-09 10:04:05','2025-08-09 10:13:05','0'),
  (25,'Mysuru Food Waste Processing Center','Hebbal Industrial Area','Mysuru','Karnataka','570016','8214456789','food@mysurufacility.in','Food Waste','2025-08-09 10:04:05','2025-08-09 10:13:05','0'),
  (26,'Hyderabad E-Waste Collection Hub','Kukatpally Industrial Estate','Hyderabad','Telangana','500072','4027654321','ewaste@hyderabadhub.in','E-waste','2025-08-09 10:04:05','2025-08-09 10:13:05','0'),
  (27,'Indore C&D Waste Management Plant','Sanwer Road Industrial Area','Indore','Madhya Pradesh','452015','7312456789','cdwaste@indoreplant.in','Construction and Demolition (C&D) Waste','2025-08-09 10:04:05','2025-08-09 10:13:05','0'),
  (28,'Surat Battery Recycling Facility','Plot 12, Sachin GIDC','Surat','Gujarat','394230','9876543210','battery@suratfacility.in','Battery Waste','2025-08-09 04:40:57','2025-08-09 10:11:28','0');
UNLOCK TABLES;

-- Table structure for table `lwm_user`
DROP TABLE IF EXISTS `lwm_user`;
CREATE TABLE `lwm_user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `role` varchar(100) DEFAULT NULL,
  `profile_photo` text,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` text,
  `password_txt` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table `lwm_user`
LOCK TABLES `lwm_user` WRITE;
INSERT INTO `lwm_user` VALUES
  (1,'admin','1753896572_5d5e315e9d37adce4552.jpeg','Harsh Khatri','admin@email.com','$2y$10$Mv.u5l9mM5k/KYIMorjxw.6gWyhqxQ0CGACLupdbVrUGcY3f6uiGm','admin123','2025-07-22 10:19:51','2025-08-11 08:48:07'),
  (2,'admin','1754923099_aef0ab0d87c5bac958c8.jpg','Tarun','admin@email.co','$2y$10$Mv.u5l9mM5k/KYIMorjxw.6gWyhqxQ0CGACLupdbVrUGcY3f6uiGm','admin123','2025-07-22 10:19:51','2025-08-11 09:08:19');
UNLOCK TABLES;

-- Table structure for table `lwm_wastecategories`
DROP TABLE IF EXISTS `lwm_wastecategories`;
CREATE TABLE `lwm_wastecategories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `description` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table `lwm_wastecategories`
LOCK TABLES `lwm_wastecategories` WRITE;
INSERT INTO `lwm_wastecategories` VALUES
  (1,'Industrial Waste','Waste produced by industrial activities.\r\nCan include hazardous and non-hazardous waste depending on industry. ','2025-07-24 23:40:44','2025-07-27 06:47:00','0'),
  (2,'Municipal Solid Waste (MSW)','Everyday household or commercial waste like food scraps, paper, packaging, plastics.','2025-07-24 19:00:47','2025-08-01 08:50:46','0'),
  (3,'Wet Waste','Organic waste such as food scraps, vegetable peels, tea bags, eggshells.','2025-07-26 19:19:28','2025-08-01 08:54:35','0'),
  (4,'E-waste','Discarded electronic devices, like computers and smartphones, often containing hazardous materials.','2025-07-26 20:04:10','2025-07-26 20:45:04','0'),
  (5,'Hazardous Waste','Waste that poses a risk to human health or the environment due to its toxic, corrosive, flammable, or reactive nature.\r\nExamples: Industrial chemicals, solvents, pesticides, medical chemicals.','2025-07-27 07:32:48','2025-07-27 07:32:48','0'),
  (6,'Biomedical Waste (Biohazard Waste)','Waste generated from hospitals, clinics, and laboratories that may be infectious or contaminated.\r\nExamples: Used syringes, bandages, human tissues, laboratory cultures.','2025-07-27 07:33:08','2025-07-27 07:33:08','0'),
  (7,'Construction and Demolition (C&D) Waste','Debris generated during construction, renovation, or demolition of buildings.\r\nExamples: Concrete, bricks, wood, metal scraps, tiles.','2025-07-27 07:33:37','2025-07-27 07:33:37','0'),
  (8,'Plastic Waste','All types of plastic materials discarded after use, which can be recyclable or non-recyclable.\r\nExamples: Bottles, packaging materials, plastic bags, disposable cups.','2025-07-27 07:33:54','2025-07-27 07:33:54','0'),
  (9,'Glass Waste','Waste composed of discarded glass materials, which can often be recycled.\r\nExamples: Broken bottles, window glass, glass jars.','2025-07-27 08:21:08','2025-08-09 04:01:00','0'),
  (14,'Agricultural Waste','Organic and inorganic residues from farming and livestock activities. Examples: Crop stalks, husks, manure, pesticide containers.','2025-08-09 04:35:00','2025-08-09 04:35:00','0'),
  (15,'Food Waste','Edible and inedible food materials discarded from households, restaurants, and markets. Examples: Leftovers, spoiled produce, bakery waste.','2025-08-09 04:36:00','2025-08-09 04:36:00','0'),
  (16,'Textile Waste','Discarded fabrics, clothing, and textile scraps from households or manufacturing. Examples: Old garments, fabric offcuts, carpets.','2025-08-09 04:37:00','2025-08-09 04:37:00','0'),
  (17,'Paper and Cardboard Waste','Paper products and packaging discarded after use. Examples: Newspapers, office paper, corrugated boxes, magazines.','2025-08-09 04:38:00','2025-08-09 04:38:00','0'),
  (18,'Rubber Waste','Discarded rubber products from manufacturing or use. Examples: Old tires, rubber mats, conveyor belts.','2025-08-09 04:39:00','2025-08-09 04:39:00','0'),
  (19,'Metal Scrap Waste','Discarded metal pieces from manufacturing, repairs, or demolition. Examples: Aluminum cans, copper wires, steel rods.','2025-08-09 04:40:00','2025-08-09 04:40:00','0'),
  (20,'Green Waste','Biodegradable garden and park waste. Examples: Grass clippings, leaves, branches, hedge trimmings.','2025-08-09 04:41:00','2025-08-09 04:41:00','0'),
  (21,'Leather Waste','Discarded leather scraps from manufacturing or post-consumer products. Examples: Shoe offcuts, old handbags, furniture leather.','2025-08-09 04:42:00','2025-08-09 04:42:00','0'),
  (22,'Packaging Waste','All forms of used packaging materials from products. Examples: Styrofoam, bubble wrap, cartons, plastic wrappers.','2025-08-09 04:43:00','2025-08-09 04:43:00','0'),
  (23,'Household Hazardous Waste','Common domestic products that contain harmful chemicals. Examples: Paints, cleaning agents, pesticides, motor oils.','2025-08-09 04:44:00','2025-08-09 04:44:00','0'),
  (24,'Mining Waste','Residues and by-products from mining operations. Examples: Overburden, tailings, slag.','2025-08-09 04:12:20','2025-08-09 04:12:20','0'),
  (25,'Oil and Grease Waste','Waste oils, lubricants, and grease from vehicles, machinery, and industrial processes. Examples: Engine oil, hydraulic fluid, cooking grease.','2025-08-09 04:12:48','2025-08-09 04:12:48','0');
UNLOCK TABLES;

-- Restore session variables
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-08-15 20:09:26
