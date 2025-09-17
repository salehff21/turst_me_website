-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 05, 2024 at 09:47 PM
-- Server version: 8.0.27
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `website_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `Id_client` int NOT NULL AUTO_INCREMENT,
  `age_client` int NOT NULL,
  `Email_client` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `phone_client` int NOT NULL,
  `client_name` varchar(100) NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`Id_client`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`Id_client`, `age_client`, `Email_client`, `phone_client`, `client_name`, `password`) VALUES
(22, 27, 'na24@gmail.com', 2147483647, 'ندي النصيري', 'f1981e4bd8a0d6d8462016d2fc6276b3'),
(25, 18, 'layan@gmail.com', 2147483647, 'ليان القحطاني', 'f1981e4bd8a0d6d8462016d2fc6276b3'),
(26, 21, 'mona@gmail.com', 27362347, 'منى الصعيري', 'f1981e4bd8a0d6d8462016d2fc6276b3'),
(27, 20, 'ali@gmail.com', 5011704, 'علي', 'f1981e4bd8a0d6d8462016d2fc6276b3');

-- --------------------------------------------------------

--
-- Table structure for table `consultations`
--

DROP TABLE IF EXISTS `consultations`;
CREATE TABLE IF NOT EXISTS `consultations` (
  `Id_con` int NOT NULL AUTO_INCREMENT,
  `Type_con` varchar(100) NOT NULL,
  `Id_lawyer` int NOT NULL,
  `Id_client` int NOT NULL,
  `Accept` tinyint NOT NULL,
  `problem_description` varchar(200) NOT NULL,
  `files` text,
  `replay` text,
  PRIMARY KEY (`Id_con`),
  KEY `Id_lawyer` (`Id_lawyer`) USING BTREE,
  KEY `Id_client` (`Id_client`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `consultations`
--

INSERT INTO `consultations` (`Id_con`, `Type_con`, `Id_lawyer`, `Id_client`, `Accept`, `problem_description`, `files`, `replay`) VALUES
(48, 'جنائي', 13, 25, 1, 'السلام عليكم', 'uploads_files_con/6721544bd848a_Distributed_systems2024.pdf', 'السلام عليكم ورحمة الله وبركاته '),
(50, 'قانوني', 13, 22, 2, 'الموضوع: طلب تقديم استمارة محامي\r\n\r\nأتقدم إليكم بهذا الطلب لتقديم استمارة محامي وفقًا للإجراءات المعتمدة. أرجو تزويدي بالتفاصيل اللازمة والمستندات المطلوبة لإتمام هذه العملية.\r\n\r\nأشكركم على تعاونكم.', 'uploads_files_con/672a8fea85521_22.pdf', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `evaluation`
--

DROP TABLE IF EXISTS `evaluation`;
CREATE TABLE IF NOT EXISTS `evaluation` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `Id_client` int NOT NULL,
  `stute_Evaluation` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Id_lawyer` int NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `Id_client` (`Id_client`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `evaluation`
--

INSERT INTO `evaluation` (`Id`, `Id_client`, `stute_Evaluation`, `Id_lawyer`) VALUES
(14, 25, 'ممتاز', 13),
(15, 25, 'ممتاز', 13);

-- --------------------------------------------------------

--
-- Table structure for table `lawyer`
--

DROP TABLE IF EXISTS `lawyer`;
CREATE TABLE IF NOT EXISTS `lawyer` (
  `Id_lawyer` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Email` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `field_lawyer` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `phone` varchar(16) NOT NULL,
  `cv_lawyer` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`Id_lawyer`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `lawyer`
--

INSERT INTO `lawyer` (`Id_lawyer`, `Name`, `Email`, `password`, `field_lawyer`, `phone`, `cv_lawyer`) VALUES
(10, 'خالد الدخيل', 'khaled23@gmail.com', 'f1981e4bd8a0d6d8462016d2fc6276b3', 'محامي قضايا تجارية', '+966 58 066 4037', NULL),
(11, 'فهد العــسـاف', 'fahd23@gmail.com', 'f1981e4bd8a0d6d8462016d2fc6276b3', 'محامي قضايا تجارية', '+966 56 931 5993', NULL),
(12, 'شهد الخـثلان', 'shahd23@gmail.com', 'f1981e4bd8a0d6d8462016d2fc6276b3', 'محامي قضايا مدنية', '+966 58 391 2316', NULL),
(13, 'ساره التميـــــــــــمي', 'sara23@gmail.com', 'f1981e4bd8a0d6d8462016d2fc6276b3', 'مختصة قضايا شخصية', '+966 55 775 3690', 'uploads/67215520af6ec_Distrib22uted_systems2024.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(30) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `consultations`
--
ALTER TABLE `consultations`
  ADD CONSTRAINT `consultations_fk_lawyer` FOREIGN KEY (`Id_lawyer`) REFERENCES `lawyer` (`Id_lawyer`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `consultations_ibfk_1` FOREIGN KEY (`Id_lawyer`) REFERENCES `lawyer` (`Id_lawyer`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `consultations_ibfk_2` FOREIGN KEY (`Id_client`) REFERENCES `client` (`Id_client`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `evaluation`
--
ALTER TABLE `evaluation`
  ADD CONSTRAINT `evaluation_ibfk_1` FOREIGN KEY (`Id_client`) REFERENCES `client` (`Id_client`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
