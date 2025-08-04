-- Create the database
CREATE DATABASE IF NOT EXISTS lwm_ris;
USE lwm_ris;

-- Create table: lwm_user
CREATE TABLE IF NOT EXISTS lwm_user (
  id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  role VARCHAR(100),
  profile_photo TEXT,
  name VARCHAR(100),
  email VARCHAR(100),
  password TEXT,
  password_txt TEXT,
  created_at TIMESTAMP NULL DEFAULT NULL,
  updated_at TIMESTAMP NULL DEFAULT NULL
);

-- Insert data into lwm_user
INSERT INTO lwm_user (id, role, profile_photo, name, email, password, password_txt, created_at, updated_at) VALUES
(1, 'admin', 'profile.jpeg', 'Harsh', 'admin@email.com', NULL, 'admin123', '2025-07-22 15:49:51', NULL),
(2, 'admin', 'profile.jpeg', 'Tarun', 'admin@email.co', NULL, 'admin123', '2025-07-22 15:49:51', NULL);

-- Create table: lwm_wastecategories
CREATE TABLE IF NOT EXISTS lwm_wastecategories (
  id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  description TEXT,
  created_at TIMESTAMP NULL DEFAULT NULL,
  updated_at TIMESTAMP NULL DEFAULT NULL,
  is_deleted ENUM('0','1') NOT NULL DEFAULT '0'
);

-- Insert data into lwm_wastecategories
INSERT INTO lwm_wastecategories (id, name, description, created_at, updated_at, is_deleted) VALUES
(1, 'Industrial Waste', 'Waste produced by industrial activities.\r\nCan include hazardous and non-hazardous waste depending on industry.', '2025-07-25 05:10:44', '2025-07-27 01:41:35', '0'),
(2, 'Municipal Solid Waste (MSW)', 'Everyday household or commercial waste like food scraps, paper, packaging, plastics.', '2025-07-25 00:30:47', '2025-07-27 02:11:27', '0'),
(3, 'Wet Waste', 'Organic waste such as food scraps, vegetable peels, tea bags, eggshells.', '2025-07-27 00:49:28', '2025-07-27 01:31:38', '0'),
(4, 'E-waste', 'Discarded electronic devices, like computers and smartphones, often containing hazardous materials.', '2025-07-27 01:34:10', '2025-07-27 02:15:04', '0');


-- Create table: lwm_recyclingcenters
CREATE TABLE IF NOT EXISTS `lwm_recyclingcenters` (
  `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL,
  `address` VARCHAR(255) NOT NULL,
  `city` VARCHAR(100) NOT NULL,
  `state` VARCHAR(100) NOT NULL,
  `postal_code` VARCHAR(10) DEFAULT NULL,
  `phone_number` VARCHAR(20) DEFAULT NULL,
  `email` VARCHAR(255) DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_deleted` ENUM('0','1') NOT NULL DEFAULT '0'
);

-- Insert data into lwm_recyclingcenters
INSERT INTO `lwm_recyclingcenters` (`name`, `address`, `city`, `state`, `postal_code`, `phone_number`, `email`) VALUES
('Vadodara Enviro Channel Ltd.', 'Near Vadsar Bridge, GIDC', 'Vadodara', 'Gujarat', '390010', '+91-265-2647272', 'info@vecl.org'),
('Green Planet Recyclers', 'Plot 55, Makarpura GIDC', 'Vadodara', 'Gujarat', '390010', '+91-9876543210', 'contact@greenplanet.in'),
('E-Waste Solutions Hub', 'A-21, Gorwa Industrial Estate', 'Vadodara', 'Gujarat', '390016', '+91-8765432109', 'support@ewastehub.com'),
('Surat Paper Mill (Recycling Div.)', 'Hazira Industrial Area', 'Surat', 'Gujarat', '394270', '+91-261-2860123', 'recycle@suratpaper.com'),
('Ahmedabad Metal Recyclers', 'Narol Industrial Area', 'Ahmedabad', 'Gujarat', '382405', '+91-79-25731122', 'info@amr.co.in');


-- Create table: lwm_events
CREATE TABLE IF NOT EXISTS `lwm_events` (
  `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(255) NOT NULL,
  `description` TEXT DEFAULT NULL,
  `date` DATETIME NOT NULL,
  `venue` VARCHAR(255) NOT NULL,
  `poster_image` VARCHAR(255) DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_deleted` ENUM('0','1') NOT NULL DEFAULT '0'
);

-- Insert data into lwm_events
INSERT INTO `lwm_events` (`title`, `description`, `date`, `venue`, `poster_image`) VALUES
('Clean & Green Vadodara Drive', 'Join us for a city-wide cleanliness drive to make our public spaces cleaner. Gloves and bags will be provided.', '2025-08-15 08:00:00', 'Sayaji Baug, Main Gate, Vadodara', 'clean_drive_poster.jpg'),
('E-Waste Collection Camp', 'Safely dispose of your old electronics. We will be collecting old computers, phones, batteries, and other e-waste for responsible recycling.', '2025-07-01 10:00:00', 'Kamati Baug, Near Planetarium, Vadodara', 'ewaste_camp_2025.png'),
('World Environment Day Seminar', 'A seminar featuring local environmental experts discussing the importance of waste segregation and its impact on our city.', '2025-06-05 11:00:00', 'Auditorium, Faculty of Science, M.S. University, Vadodara', NULL),
('Recycling Workshop for Kids', 'A fun and interactive workshop for children to learn about recycling through crafts and games. All materials will be provided.', '2025-08-02 15:00:00', 'Bright Day School, Vasna Bhayli Road, Vadodara', 'kids_workshop.jpg'),
('Say No to Plastic Bags Campaign', 'An awareness campaign to promote the use of cloth and jute bags. Free reusable bags will be distributed.', '2025-09-01 17:00:00', 'Inorbit Mall, Gorwa Road, Vadodara', 'no_plastic_campaign.jpg');


-- Create table: lwm_contactmessages
CREATE TABLE IF NOT EXISTS `lwm_contactmessages` (
  `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `subject` VARCHAR(255) DEFAULT NULL,
  `message` TEXT NOT NULL,
  `status` ENUM('pending', 'done', 'new'),
  `submitted_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP
);

-- Insert data into lwm_contactmessages
INSERT INTO `lwm_contactmessages` (`name`, `email`, `subject`, `message`, `status`, `submitted_at`) VALUES
('Priya Sharma', 'priya.sharma@example.com', 'Question about plastic recycling', 'Hello, I have a lot of type 5 plastic containers. Can I drop them off at the Makarpura GIDC center? Please let me know. Thanks!', 'unread', '2025-07-28 16:30:00'),
('Raj Patel', 'raj.p@example.com', 'E-Waste Collection Event Inquiry', 'I missed the e-waste collection event last month. When is the next one scheduled in the Gorwa area? Thank you.', 'unread', '2025-07-28 10:15:00'),
('Anjali Mehta', 'anjali.m@example.com', 'Volunteering Opportunity', 'I am a college student and would love to volunteer for one of your cleanliness drives. Are there any upcoming opportunities in Vadodara?', 'read', '2025-07-27 11:00:00'),
('Vikram Singh', 'vikram.singh@example.com', 'Feedback on Website', 'Great initiative! The website is very informative. It would be helpful to have a map view for the recycling centers. Just a suggestion. Keep up the good work!', 'read', '2025-07-26 20:45:00'),
('Neha Desai', 'neha.d@example.com', 'Bulk Waste Disposal', 'Our housing society has a large amount of cardboard and paper waste. Do you offer a collection service for bulk amounts?', 'unread', '2025-07-28 16:50:00');