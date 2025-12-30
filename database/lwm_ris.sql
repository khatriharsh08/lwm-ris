-- ============================================================
-- LWM-RIS Database Schema
-- Local Waste Management & Recycling Information System
-- ============================================================

CREATE DATABASE IF NOT EXISTS `lwm_ris`;
USE `lwm_ris`;

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ============================================================
-- Admin Users Table
-- ============================================================
DROP TABLE IF EXISTS `lwm_user`;
CREATE TABLE `lwm_user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `role` varchar(100) DEFAULT NULL,
  `is_master` enum('0','1') NOT NULL DEFAULT '0',
  `profile_photo` text,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` text,
  `password_txt` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Default Admin Users
INSERT INTO `lwm_user` (`role`, `is_master`, `name`, `email`, `password`, `password_txt`, `created_at`) VALUES
('admin', '1', 'Master Admin', 'master@lwmris.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'password', NOW()),
('admin', '0', 'Admin User', 'admin@lwmris.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'password', NOW());

-- ============================================================
-- Waste Categories Table
-- ============================================================
DROP TABLE IF EXISTS `lwm_wastecategories`;
CREATE TABLE `lwm_wastecategories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `description` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Sample Waste Categories
INSERT INTO `lwm_wastecategories` (`name`, `description`, `created_at`) VALUES
('Dry Waste', 'Includes paper, cardboard, plastic bottles, metal cans, glass containers, and other recyclable materials.', NOW()),
('Wet Waste', 'Biodegradable waste including food scraps, vegetable peels, fruit remains, and organic materials.', NOW()),
('Hazardous Waste', 'Dangerous materials including batteries, e-waste, chemicals, medical waste, and pesticides.', NOW());

-- ============================================================
-- Recycling Centers Table
-- ============================================================
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ============================================================
-- Events & Seminars Table
-- ============================================================
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ============================================================
-- Contact Messages Table
-- ============================================================
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
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ============================================================
-- Activity Logs Table
-- ============================================================
DROP TABLE IF EXISTS `lwm_activity_logs`;
CREATE TABLE `lwm_activity_logs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `action` enum('create','update','delete','status_change') NOT NULL,
  `module` varchar(50) NOT NULL,
  `record_id` int DEFAULT NULL,
  `record_title` varchar(255) DEFAULT NULL,
  `old_values` text,
  `new_values` text,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ============================================================
-- Password Reset Tokens Table
-- ============================================================
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `token` (`token`),
  KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ============================================================
-- Migrations Table (CodeIgniter)
-- ============================================================
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `class` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `namespace` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `time` int NOT NULL,
  `batch` int unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

SET FOREIGN_KEY_CHECKS = 1;
