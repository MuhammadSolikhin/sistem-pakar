-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- 
-- SCRIPT INI TELAH DIURUTKAN ULANG UNTUK MEMASTIKAN KETERGANTUNGAN FOREIGN KEY TERPENUHI
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for spk_ahp_rehan
CREATE DATABASE IF NOT EXISTS `spk_ahp_rehan` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `spk_ahp_rehan`;

-- ===================================================================
-- TAHAP 1: Tabel Tanpa Dependensi (Tabel Master)
-- ===================================================================

-- Dumping structure for table spk_ahp_rehan.users
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username_unique` (`username`),
  UNIQUE KEY `email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table spk_ahp_rehan.users: ~3 rows (approximately)
INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `full_name`, `role`, `created_at`) VALUES
	(1, 'admin', '$2y$10$nywflODYTcCswjxTV2eXw.QYib1tIKZW17.xfQ23Q8PEmN54pM/7G', 'admin@resto.com', 'Administrator', 'admin', '2025-08-28 09:02:58'),
	(2, 'budi', '$2y$10$JKWuzdo1sEz75VjYsyA/XekEt5qEH1AxDR6Q.jlgfmy3vNHiwaUxe', 'budi@example.com', 'Budi Susanto', 'user', '2025-08-28 09:02:58'),
	(3, 'khin', '$2y$10$p2swAayPjxc3vlDWBJE/ieo.i8R1r7n1Hml5QD/6I6SXCNTexDgmm', 'khin@gmail.com', 'Muhammad Solikhin', 'user', '2025-08-28 09:44:35');

-- Dumping structure for table spk_ahp_rehan.criteria
CREATE TABLE IF NOT EXISTS `criteria` (
  `criterion_id` int NOT NULL AUTO_INCREMENT,
  `criterion_name` varchar(50) NOT NULL,
  `description` text,
  PRIMARY KEY (`criterion_id`),
  UNIQUE KEY `criterion_name_unique` (`criterion_name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table spk_ahp_rehan.criteria: ~5 rows (approximately)
INSERT INTO `criteria` (`criterion_id`, `criterion_name`, `description`) VALUES
	(1, 'Rasa Makanan', 'Kualitas dan kelezatan cita rasa dari menu yang disajikan.'),
	(2, 'Harga', 'Tingkat harga dan kesesuaiannya dengan porsi serta kualitas makanan.'),
	(3, 'Pelayanan', 'Kualitas layanan yang diberikan oleh staf, termasuk kecepatan dan keramahan.'),
	(4, 'Suasana', 'Kenyamanan, kebersihan, dan desain dari tempat makan.'),
	(5, 'Jarak', 'Kedekatan lokasi restoran dari titik acuan pengguna.');

-- ===================================================================
-- TAHAP 2: Tabel yang bergantung pada Tabel Master
-- ===================================================================

-- Dumping structure for table spk_ahp_rehan.restaurants
CREATE TABLE IF NOT EXISTS `restaurants` (
  `restaurant_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `latitude` decimal(10,8) NOT NULL,
  `longitude` decimal(11,8) NOT NULL,
  `description` text,
  `gmaps_url` varchar(512) DEFAULT NULL,
  `price_range` enum('Murah','Sedang','Mahal') DEFAULT NULL,
  `opening_hours` varchar(100) DEFAULT NULL,
  `contact_phone` varchar(20) DEFAULT NULL,
  `added_by` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`restaurant_id`),
  KEY `added_by` (`added_by`),
  CONSTRAINT `restaurants_ibfk_1` FOREIGN KEY (`added_by`) REFERENCES `users` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table spk_ahp_rehan.restaurants: ~10 rows (approximately)
INSERT INTO `restaurants` (`restaurant_id`, `name`, `address`, `latitude`, `longitude`, `description`, `gmaps_url`, `price_range`, `opening_hours`, `contact_phone`, `added_by`, `created_at`) VALUES
	(1, 'Warung Pasta Depok', 'Jl. Margonda Raya No. 518, Pondok Cina, Beji, Kota Depok', -6.36681000, 106.83227400, 'Menyajikan aneka pasta dan hidangan Italia dengan harga mahasiswa.', NULL, 'Sedang', NULL, NULL, 1, '2025-08-28 14:26:39'),
	(2, 'Saung Talaga', 'Jl. K.H.M. Usman No. 168, Kukusan, Beji, Kota Depok', -6.36398300, 106.80521400, 'Restoran keluarga dengan konsep saung di atas danau, menyajikan masakan Sunda.', NULL, 'Sedang', NULL, NULL, 1, '2025-08-28 14:26:39'),
	(3, 'Soto Bu Tjondro', 'Jl. Siliwangi No. 1, Pancoran Mas, Kota Depok', -6.40244800, 106.82512100, 'Soto khas Solo yang legendaris dengan kuah bening dan aneka lauk.', NULL, 'Murah', NULL, NULL, 1, '2025-08-28 14:26:39'),
	(4, 'Mang Kabayan Depok', 'Jl. Margonda Raya No. 488, Pondok Cina, Beji, Kota Depok', -6.36611200, 106.83204900, 'Restoran Sunda dengan menu andalan Ikan Gurame dan suasana pedesaan.', NULL, 'Mahal', NULL, NULL, 1, '2025-08-28 14:26:39'),
	(5, 'Milan Pizzeria Cafe', 'Jl. Margonda Raya No. 514, Beji, Kota Depok', -6.36709800, 106.83238600, 'Kafe populer yang menyajikan pizza tipis, pasta, dan kopi.', NULL, 'Sedang', NULL, NULL, 1, '2025-08-28 14:26:39'),
	(6, 'Bakso Hitam Pak Bewok', 'Jl. H. Asmawi No. 109, Beji, Kota Depok', -6.37664360, 106.80634840, 'Bakso unik berwarna hitam dari kluwek dengan rasa yang khas dan gurih.', 'https://www.google.co.id/maps/place/Bakso+Item+Bewok/@-6.3766436,106.8063484,13.62z/data=!4m6!3m5!1s0x2e69ec0421d1f617:0x2a06fb01c49695ab!8m2!3d-6.3756932!4d106.8252213!16s%2Fg%2F11c0pz2j_4?entry=ttu&g_ep=EgoyMDI1MDgyNS4wIKXMDSoASAFQAw%3D%3D', 'Murah', NULL, NULL, 1, '2025-08-28 14:26:39'),
	(7, 'Gudeg Yu Djum Depok', 'Jl. Kartini Raya No. 22, Pancoran Mas, Kota Depok', -6.40183300, 106.82133500, 'Cabang asli dari Gudeg Yu Djum Yogyakarta, menyajikan gudeg kering otentik.', NULL, 'Sedang', NULL, NULL, 1, '2025-08-28 14:26:39'),
	(8, 'Kimung', 'Jl. Margonda Raya No. 453A, Pondok Cina, Beji, Kota Depok', -6.36440200, 106.83177800, 'Kedai kopi dan roti bakar kekinian yang selalu ramai oleh anak muda.', NULL, 'Murah', NULL, NULL, 1, '2025-08-28 14:26:39'),
	(9, 'Daebak Fan Cafe', 'Jl. Margonda Raya No. 27, Pancoran Mas, Kota Depok', -6.38875600, 106.82914100, 'Kafe bertema K-Pop yang menyajikan makanan ringan dan minuman khas Korea.', NULL, 'Sedang', NULL, NULL, 1, '2025-08-28 14:26:39'),
	(10, 'Kayu Manis', 'Jl. K.H.M. Usman Raya No. 6, Kukusan, Beji, Kota Depok', -6.36214500, 106.80665400, 'Restoran yang cocok untuk acara besar dengan menu masakan Indonesia yang beragam.', NULL, 'Mahal', NULL, NULL, 1, '2025-08-28 14:26:39');

-- Dumping structure for table spk_ahp_rehan.recommendation_history
CREATE TABLE IF NOT EXISTS `recommendation_history` (
  `history_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`history_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `recommendation_history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table spk_ahp_rehan.recommendation_history: ~5 rows (approximately)
INSERT INTO `recommendation_history` (`history_id`, `user_id`, `created_at`) VALUES
	(2, 2, '2025-08-28 14:56:38'),
	(3, 2, '2025-08-28 15:22:40'),
	(4, 2, '2025-08-28 15:27:05'),
	(5, 2, '2025-08-28 15:34:28'),
	(6, 3, '2025-08-28 15:41:16');

-- Dumping structure for table spk_ahp_rehan.user_preferences
CREATE TABLE IF NOT EXISTS `user_preferences` (
  `preference_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `criterion1_id` int NOT NULL,
  `criterion2_id` int NOT NULL,
  `weight` float NOT NULL COMMENT 'Nilai perbandingan dari skala Saaty (1-9)',
  PRIMARY KEY (`preference_id`),
  UNIQUE KEY `user_criteria_pair_unique` (`user_id`,`criterion1_id`,`criterion2_id`),
  KEY `criterion1_id` (`criterion1_id`),
  KEY `criterion2_id` (`criterion2_id`),
  CONSTRAINT `user_preferences_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_preferences_ibfk_2` FOREIGN KEY (`criterion1_id`) REFERENCES `criteria` (`criterion_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_preferences_ibfk_3` FOREIGN KEY (`criterion2_id`) REFERENCES `criteria` (`criterion_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table spk_ahp_rehan.user_preferences: ~20 rows (approximately)
INSERT INTO `user_preferences` (`preference_id`, `user_id`, `criterion1_id`, `criterion2_id`, `weight`) VALUES
	(11, 2, 1, 2, 3),
	(12, 2, 1, 3, 5),
	(13, 2, 1, 4, 7),
	(14, 2, 5, 1, 4),
	(15, 2, 2, 3, 3),
	(16, 2, 2, 4, 5),
	(17, 2, 2, 5, 7),
	(18, 2, 3, 4, 2),
	(19, 2, 3, 5, 4),
	(20, 2, 4, 5, 3),
	(21, 3, 2, 1, 3),
	(22, 3, 1, 3, 5),
	(23, 3, 4, 1, 3),
	(24, 3, 1, 5, 3),
	(25, 3, 2, 3, 3),
	(26, 3, 2, 4, 3),
	(27, 3, 5, 2, 4),
	(28, 3, 3, 4, 5),
	(29, 3, 5, 3, 2),
	(30, 3, 4, 5, 2);

-- ===================================================================
-- TAHAP 3: Tabel yang bergantung pada Tahap 2
-- ===================================================================

-- Dumping structure for table spk_ahp_rehan.alternative_scores
CREATE TABLE IF NOT EXISTS `alternative_scores` (
  `score_id` int NOT NULL AUTO_INCREMENT,
  `restaurant_id` int NOT NULL,
  `criterion_id` int NOT NULL,
  `score` int NOT NULL COMMENT 'Nilai/skor dari 1-5',
  PRIMARY KEY (`score_id`),
  UNIQUE KEY `restaurant_criterion_unique` (`restaurant_id`,`criterion_id`),
  KEY `criterion_id` (`criterion_id`),
  CONSTRAINT `alternative_scores_ibfk_1` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`restaurant_id`) ON DELETE CASCADE,
  CONSTRAINT `alternative_scores_ibfk_2` FOREIGN KEY (`criterion_id`) REFERENCES `criteria` (`criterion_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=136 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table spk_ahp_rehan.alternative_scores: ~50 rows (approximately)
INSERT INTO `alternative_scores` (`score_id`, `restaurant_id`, `criterion_id`, `score`) VALUES
	(46, 1, 1, 4),
	(47, 1, 2, 4),
	(48, 1, 3, 3),
	(49, 1, 4, 4),
	(50, 2, 1, 4),
	(51, 2, 2, 3),
	(52, 2, 3, 4),
	(53, 2, 4, 5),
	(54, 3, 1, 5),
	(55, 3, 2, 5),
	(56, 3, 3, 3),
	(57, 3, 4, 2),
	(58, 4, 1, 4),
	(59, 4, 2, 2),
	(60, 4, 3, 4),
	(61, 4, 4, 4),
	(62, 5, 1, 4),
	(63, 5, 2, 3),
	(64, 5, 3, 3),
	(65, 5, 4, 4),
	(66, 6, 1, 5),
	(67, 6, 2, 5),
	(68, 6, 3, 3),
	(69, 6, 4, 2),
	(70, 7, 1, 5),
	(71, 7, 2, 3),
	(72, 7, 3, 3),
	(73, 7, 4, 3),
	(74, 8, 1, 3),
	(75, 8, 2, 5),
	(76, 8, 3, 3),
	(77, 8, 4, 4),
	(78, 9, 1, 3),
	(79, 9, 2, 3),
	(80, 9, 3, 4),
	(81, 9, 4, 4),
	(82, 10, 1, 4),
	(83, 10, 2, 2),
	(84, 10, 3, 4),
	(85, 10, 4, 5),
	(90, 6, 5, 4),
	(95, 9, 5, 1),
	(100, 7, 5, 2),
	(105, 10, 5, 3),
	(110, 8, 5, 4),
	(115, 4, 5, 2),
	(120, 5, 5, 4),
	(125, 2, 5, 5),
	(130, 3, 5, 3),
	(135, 1, 5, 5);

-- Dumping structure for table spk_ahp_rehan.restaurant_photos
CREATE TABLE IF NOT EXISTS `restaurant_photos` (
  `photo_id` int NOT NULL AUTO_INCREMENT,
  `restaurant_id` int NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `caption` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`photo_id`),
  KEY `restaurant_id` (`restaurant_id`),
  CONSTRAINT `restaurant_photos_ibfk_1` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`restaurant_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table spk_ahp_rehan.restaurant_photos: ~0 rows (approximately)

-- Dumping structure for table spk_ahp_rehan.history_details
CREATE TABLE IF NOT EXISTS `history_details` (
  `detail_id` int NOT NULL AUTO_INCREMENT,
  `history_id` int NOT NULL,
  `restaurant_id` int NOT NULL,
  `final_score` double NOT NULL,
  `rank` int NOT NULL,
  PRIMARY KEY (`detail_id`),
  KEY `history_id` (`history_id`),
  KEY `restaurant_id` (`restaurant_id`),
  CONSTRAINT `history_details_ibfk_1` FOREIGN KEY (`history_id`) REFERENCES `recommendation_history` (`history_id`) ON DELETE CASCADE,
  CONSTRAINT `history_details_ibfk_2` FOREIGN KEY (`restaurant_id`) REFERENCES `restaurants` (`restaurant_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table spk_ahp_rehan.history_details: ~50 rows (approximately)
INSERT INTO `history_details` (`detail_id`, `history_id`, `restaurant_id`, `final_score`, `rank`) VALUES
	(11, 2, 3, 3.852018728035497, 1),
	(12, 2, 6, 3.852018728035497, 2),
	(13, 2, 7, 3.3821024965654094, 3),
	(14, 2, 1, 3.370716520774544, 4),
	(15, 2, 2, 3.294236637150929, 5),
	(16, 2, 8, 3.283098865637575, 6),
	(17, 2, 5, 3.0976425653664483, 7),
	(18, 2, 10, 3.021162681742833, 8),
	(19, 2, 4, 2.9449310023967294, 9),
	(20, 2, 9, 2.857313347259761, 10),
	(21, 3, 3, 3.852018728035497, 1),
	(22, 3, 6, 3.852018728035497, 2),
	(23, 3, 7, 3.3821024965654094, 3),
	(24, 3, 1, 3.370716520774544, 4),
	(25, 3, 2, 3.294236637150929, 5),
	(26, 3, 8, 3.283098865637575, 6),
	(27, 3, 5, 3.0976425653664483, 7),
	(28, 3, 10, 3.021162681742833, 8),
	(29, 3, 4, 2.9449310023967294, 9),
	(30, 3, 9, 2.857313347259761, 10),
	(31, 4, 3, 3.852018728035497, 1),
	(32, 4, 6, 3.852018728035497, 2),
	(33, 4, 7, 3.3821024965654094, 3),
	(34, 4, 1, 3.370716520774544, 4),
	(35, 4, 2, 3.294236637150929, 5),
	(36, 4, 8, 3.283098865637575, 6),
	(37, 4, 5, 3.0976425653664483, 7),
	(38, 4, 10, 3.021162681742833, 8),
	(39, 4, 4, 2.9449310023967294, 9),
	(40, 4, 9, 2.857313347259761, 10),
	(41, 5, 3, 3.852018728035497, 1),
	(42, 5, 6, 3.852018728035497, 2),
	(43, 5, 7, 3.3821024965654094, 3),
	(44, 5, 1, 3.370716520774544, 4),
	(45, 5, 2, 3.294236637150929, 5),
	(46, 5, 8, 3.283098865637575, 6),
	(47, 5, 5, 3.0976425653664483, 7),
	(48, 5, 10, 3.021162681742833, 8),
	(49, 5, 4, 2.9449310023967294, 9),
	(50, 5, 9, 2.857313347259761, 10),
	(51, 6, 3, 3.3058589729243697, 1),
	(52, 6, 6, 3.3058589729243697, 2),
	(53, 6, 2, 3.2858627703535457, 3),
	(54, 6, 8, 3.2084844765698226, 4),
	(55, 6, 1, 3.1961233882750304, 5),
	(56, 6, 10, 3.0508876341897193, 6),
	(57, 6, 7, 3.0098355002884776, 7),
	(58, 6, 5, 2.961148252111204, 8),
	(59, 6, 9, 2.889321922792749, 9),
	(60, 6, 4, 2.876960834497958, 10);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;