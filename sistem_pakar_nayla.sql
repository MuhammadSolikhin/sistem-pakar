-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for sistem_pakar_nayla
CREATE DATABASE IF NOT EXISTS `sistem_pakar_nayla` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `sistem_pakar_nayla`;

-- Dumping structure for table sistem_pakar_nayla.basis_pengetahuan
CREATE TABLE IF NOT EXISTS `basis_pengetahuan` (
  `id_aturan` int NOT NULL AUTO_INCREMENT,
  `kode_tingkat` varchar(5) NOT NULL,
  `kode_gejala` varchar(5) NOT NULL,
  `cf_pakar` decimal(3,2) NOT NULL,
  PRIMARY KEY (`id_aturan`),
  KEY `kode_tingkat` (`kode_tingkat`),
  KEY `kode_gejala` (`kode_gejala`),
  CONSTRAINT `basis_pengetahuan_ibfk_1` FOREIGN KEY (`kode_tingkat`) REFERENCES `tingkat_kecanduan` (`kode_tingkat`) ON DELETE CASCADE,
  CONSTRAINT `basis_pengetahuan_ibfk_2` FOREIGN KEY (`kode_gejala`) REFERENCES `gejala` (`kode_gejala`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table sistem_pakar_nayla.basis_pengetahuan: ~13 rows (approximately)
INSERT INTO `basis_pengetahuan` (`id_aturan`, `kode_tingkat`, `kode_gejala`, `cf_pakar`) VALUES
	(1, 'K02', 'G01', 0.60),
	(2, 'K02', 'G02', 0.70),
	(3, 'K02', 'G09', 0.50),
	(4, 'K02', 'G10', 0.60),
	(5, 'K03', 'G01', 0.70),
	(6, 'K03', 'G02', 0.80),
	(7, 'K03', 'G03', 0.60),
	(8, 'K03', 'G06', 0.70),
	(9, 'K03', 'G07', 0.80),
	(10, 'K04', 'G03', 0.90),
	(11, 'K04', 'G04', 0.80),
	(12, 'K04', 'G05', 0.90),
	(13, 'K04', 'G08', 1.00);

-- Dumping structure for table sistem_pakar_nayla.detail_konsultasi
CREATE TABLE IF NOT EXISTS `detail_konsultasi` (
  `id_detail` int NOT NULL AUTO_INCREMENT,
  `id_konsultasi` int NOT NULL,
  `kode_gejala` varchar(5) NOT NULL,
  `cf_user` decimal(3,2) NOT NULL,
  PRIMARY KEY (`id_detail`),
  KEY `id_konsultasi` (`id_konsultasi`),
  KEY `kode_gejala` (`kode_gejala`),
  CONSTRAINT `detail_konsultasi_ibfk_1` FOREIGN KEY (`id_konsultasi`) REFERENCES `konsultasi` (`id_konsultasi`) ON DELETE CASCADE,
  CONSTRAINT `detail_konsultasi_ibfk_2` FOREIGN KEY (`kode_gejala`) REFERENCES `gejala` (`kode_gejala`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table sistem_pakar_nayla.detail_konsultasi: ~5 rows (approximately)

-- Dumping structure for table sistem_pakar_nayla.gejala
CREATE TABLE IF NOT EXISTS `gejala` (
  `kode_gejala` varchar(5) NOT NULL,
  `nama_gejala` text NOT NULL,
  PRIMARY KEY (`kode_gejala`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table sistem_pakar_nayla.gejala: ~10 rows (approximately)
INSERT INTO `gejala` (`kode_gejala`, `nama_gejala`) VALUES
	('G01', 'Apakah Anda menghabiskan waktu bermain game lebih lama dari yang direncanakan?'),
	('G02', 'Apakah Anda sering mengabaikan tugas sekolah atau pekerjaan rumah demi bermain game?'),
	('G03', 'Apakah Anda merasa gelisah, mudah tersinggung, atau cemas ketika tidak bisa bermain game?'),
	('G04', 'Apakah Anda pernah berbohong kepada keluarga atau teman mengenai berapa lama waktu yang Anda habiskan untuk bermain game?'),
	('G05', 'Apakah Anda menggunakan game sebagai cara untuk melarikan diri dari masalah atau perasaan negatif (seperti rasa bersalah, cemas, atau depresi)?'),
	('G06', 'Apakah pola tidur Anda terganggu (misalnya, begadang atau tidur terlalu larut) karena bermain game?'),
	('G07', 'Apakah Anda kehilangan minat pada hobi atau aktivitas sosial lain yang sebelumnya Anda nikmati?'),
	('G08', 'Apakah Anda terus bermain game meskipun menyadari adanya konsekuensi negatif dalam kehidupan Anda (misalnya, nilai turun, konflik dengan keluarga)?'),
	('G09', 'Apakah Anda pernah gagal dalam upaya mengurangi waktu bermain game?'),
	('G10', 'Apakah Anda sering memikirkan tentang game (strategi, sesi berikutnya) bahkan ketika sedang tidak bermain?');

-- Dumping structure for table sistem_pakar_nayla.konsultasi
CREATE TABLE IF NOT EXISTS `konsultasi` (
  `id_konsultasi` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `tanggal_konsultasi` datetime NOT NULL,
  `hasil_kode_tingkat` varchar(5) DEFAULT NULL,
  `hasil_cf_final` decimal(5,4) DEFAULT NULL,
  PRIMARY KEY (`id_konsultasi`),
  KEY `id_user` (`id_user`),
  KEY `hasil_kode_tingkat` (`hasil_kode_tingkat`),
  CONSTRAINT `konsultasi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE,
  CONSTRAINT `konsultasi_ibfk_2` FOREIGN KEY (`hasil_kode_tingkat`) REFERENCES `tingkat_kecanduan` (`kode_tingkat`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table sistem_pakar_nayla.konsultasi: ~0 rows (approximately)

-- Dumping structure for table sistem_pakar_nayla.tingkat_kecanduan
CREATE TABLE IF NOT EXISTS `tingkat_kecanduan` (
  `kode_tingkat` varchar(5) NOT NULL,
  `nama_tingkat` varchar(100) NOT NULL,
  `deskripsi` text,
  `solusi` text,
  PRIMARY KEY (`kode_tingkat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table sistem_pakar_nayla.tingkat_kecanduan: ~4 rows (approximately)
INSERT INTO `tingkat_kecanduan` (`kode_tingkat`, `nama_tingkat`, `deskripsi`, `solusi`) VALUES
	('K01', 'Tidak Kecanduan', 'Anda tidak menunjukkan tanda-tanda kecanduan game online. Anda mampu mengontrol waktu bermain dan menyeimbangkannya dengan tanggung jawab lain.', 'Pertahankan kebiasaan baik ini. Jadikan game sebagai hiburan semata dan tetap prioritaskan kewajiban utama Anda.'),
	('K02', 'Kecanduan Ringan', 'Anda menunjukkan beberapa gejala awal kecanduan. Waktu bermain game mulai mengganggu beberapa aspek kehidupan, namun masih dalam taraf yang bisa dikendalikan.', 'Mulailah dengan menetapkan batas waktu bermain yang jelas (misalnya, 1-2 jam per hari). Cari hobi alternatif lain dan perbanyak interaksi sosial di dunia nyata.'),
	('K03', 'Kecanduan Sedang', 'Anda menunjukkan gejala kecanduan yang jelas. Game telah menjadi prioritas dan mulai menyebabkan masalah yang signifikan pada bidang akademik dan sosial.', 'Diskusikan masalah ini dengan orang yang Anda percaya (orang tua/guru BK). Buat jadwal harian yang terstruktur dan patuhi. Pertimbangkan untuk mengambil jeda total dari game selama beberapa minggu.'),
	('K04', 'Kecanduan Berat', 'Anda berada pada tingkat kecanduan yang serius. Kehidupan Anda didominasi oleh game, menyebabkan kerusakan signifikan pada kesehatan fisik, mental, akademik, dan hubungan sosial.', 'Segera cari bantuan profesional dari psikolog atau konselor. Dukungan dari keluarga sangat penting. Terapi perilaku kognitif (CBT) seringkali efektif untuk mengatasi kondisi ini.');

-- Dumping structure for table sistem_pakar_nayla.users
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','siswa') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table sistem_pakar_nayla.users: ~2 rows (approximately)
INSERT INTO `users` (`id_user`, `nama_lengkap`, `username`, `password`, `role`, `created_at`) VALUES
	(6, 'Administrator', 'admin', '$2y$10$DGwmw//o0yMyrWIjjY7Tye8GSe9m8L0CT.FIaL9HP0YgHV2NaOA3.', 'admin', '2025-09-01 13:40:16'),
	(7, 'Khin', 'khin', '$2y$10$V8lBtluDXKfaCSJkoHkWouf/RTsfxnh1TKmPy6t3xQQJRBUw0PS4K', 'siswa', '2025-09-03 06:36:29');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
