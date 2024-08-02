-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 02, 2024 at 07:38 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chat`
--
CREATE DATABASE IF NOT EXISTS `chat` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `chat`;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `msg_id` int NOT NULL AUTO_INCREMENT,
  `incoming_msg_id` int NOT NULL,
  `outgoing_msg_id` int NOT NULL,
  `msg` varchar(10000) NOT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `message_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `message_status` int NOT NULL DEFAULT '1',
  `msg_type` enum('text','photo','both') NOT NULL DEFAULT 'text',
  PRIMARY KEY (`msg_id`)
) ENGINE=MyISAM AUTO_INCREMENT=128 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_id`, `incoming_msg_id`, `outgoing_msg_id`, `msg`, `file_path`, `message_time`, `message_status`, `msg_type`) VALUES
(127, 817944, 271565, 'uploads/66a12c32c3eb44.57227199.png', NULL, '2024-07-24 16:30:42', 1, ''),
(126, 817944, 271565, 'uploads/66a12c2ac7dc69.92047568.jpg', NULL, '2024-07-24 16:30:34', 1, ''),
(125, 817944, 271565, 'asdads', NULL, '2024-07-24 16:29:25', 1, 'text'),
(124, 706933, 271565, 'fdsdfs', NULL, '2024-07-24 16:20:09', 1, 'text'),
(123, 706933, 271565, 'dfsdsf', NULL, '2024-07-24 16:20:07', 1, 'text'),
(122, 706933, 271565, 'dsfdfsfds', NULL, '2024-07-24 16:20:06', 1, 'text'),
(121, 706933, 271565, 'dsffdsdfs', NULL, '2024-07-24 16:20:04', 1, 'text'),
(119, 817944, 271565, 'Hello', NULL, '2024-07-23 14:32:05', 1, 'text'),
(120, 706933, 271565, 'uploads/66a129b0300c14.34903275.png', NULL, '2024-07-24 16:20:00', 1, ''),
(118, 271565, 817944, 'Xyy', NULL, '2024-07-23 14:19:24', 1, 'text'),
(116, 271565, 817944, 'Hahqha', NULL, '2024-07-23 14:18:19', 1, 'text'),
(117, 817944, 271565, 'Haha', NULL, '2024-07-23 14:19:14', 1, 'text'),
(114, 706933, 817944, 'Hi', NULL, '2024-07-23 14:17:56', 1, 'text'),
(115, 706933, 817944, 'Hwhw', NULL, '2024-07-23 14:18:00', 1, 'text'),
(113, 271565, 271565, 'ads', NULL, '2024-07-22 16:09:30', 1, 'text'),
(112, 271565, 817944, 'asdasdsdasadasdasdasdasdasdasdasdasdasdsdasdaasdasd', NULL, '2024-07-22 14:18:12', 1, 'text'),
(111, 817944, 271565, 'as', NULL, '2024-07-21 17:33:27', 1, 'text'),
(110, 817944, 271565, 'uploads/669d462995a851.24555497.jpg', NULL, '2024-07-21 17:32:25', 1, ''),
(109, 817944, 271565, 'uploads/669d46230551a0.46234080.jpg', NULL, '2024-07-21 17:32:19', 1, ''),
(108, 706933, 271565, 'as', NULL, '2024-07-21 17:03:17', 1, 'text'),
(107, 817944, 271565, 'l\'\\;', NULL, '2024-07-21 16:30:01', 1, 'text'),
(106, 817944, 271565, 'ol', NULL, '2024-07-21 16:29:57', 1, 'text'),
(105, 817944, 271565, 'uploads/668ac6b545fee3.59238463.jpg', NULL, '2024-07-07 16:47:49', 1, ''),
(104, 817944, 271565, 'Hs', NULL, '2024-07-07 16:47:38', 1, 'text'),
(103, 817944, 271565, 'Shs', NULL, '2024-07-07 16:47:34', 1, 'text'),
(102, 817944, 271565, 'Hh', NULL, '2024-07-07 16:47:31', 1, 'text'),
(101, 271565, 817944, 'asd', NULL, '2024-07-07 15:03:13', 1, 'text'),
(100, 271565, 817944, 'zxc', NULL, '2024-07-07 15:02:52', 1, 'text'),
(99, 271565, 817944, 'xcvcvx', NULL, '2024-07-07 15:02:46', 1, 'text'),
(97, 271565, 817944, 'xcvvcx', NULL, '2024-07-07 15:02:21', 1, 'text'),
(98, 271565, 817944, 'xcvc', NULL, '2024-07-07 15:02:22', 1, 'text'),
(95, 817944, 271565, 'ssaasasdasdasdasdasd', NULL, '2024-07-07 14:58:41', 1, 'text'),
(96, 271565, 817944, 'cxcxvc', NULL, '2024-07-07 15:02:20', 1, 'text'),
(94, 817944, 271565, 'asasd', NULL, '2024-07-07 14:58:26', 1, 'text'),
(93, 937083, 271565, 'Telefon sban mir se hala ka pun', NULL, '2024-06-30 21:52:16', 1, 'text'),
(91, 937083, 271565, 'Hey', NULL, '2024-06-30 21:51:50', 1, 'text'),
(92, 271565, 937083, 'hahahahahahah kap nreqe se e fort koka', NULL, '2024-06-30 21:52:07', 1, 'text'),
(90, 271565, 937083, 'bro', NULL, '2024-06-30 21:51:47', 1, 'text'),
(89, 276501, 271565, 'uploads/6681ce807cc029.41060433.jpg', NULL, '2024-06-30 21:30:40', 1, ''),
(88, 271565, 276501, 'ss', NULL, '2024-06-30 21:30:36', 1, 'text'),
(87, 276501, 271565, 'aa', NULL, '2024-06-30 21:30:33', 1, 'text');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `expiration_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`id`, `user_id`, `token`, `expiration_time`) VALUES
(2, 1, '04efdc3bcea02a6dc925dcd7f0c14f7f3f6189b8b9c7a05da54347f3e4a7c31a', '2024-07-21 17:14:45'),
(3, 1, '7782b25469e98ca375ae22b38df87af1f23428bffc9c898e6da2d315e8743c37', '2024-07-21 17:17:46'),
(4, 1, '7f4447e9711fd9c02c0809ff17397c01375ad21a3e5c7048d925b5b8f06abb90', '2024-07-21 17:18:01'),
(5, 1, '461c51d2559949120e2f875b2e2d817b2093affe5923460291bc799acd0fe8d3', '2024-07-21 17:20:06'),
(6, 1, 'cc28f7137520cc70bd31e89e3e4e8732d49ae6a039e6b8fb68c37db8e29abba6', '2024-07-21 17:22:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `unique_id` int NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `img` varchar(400) NOT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `unique_id`, `fname`, `lname`, `email`, `password`, `img`, `status`) VALUES
(1, 271565, 'Taulant', 'Hoxhas', 'htaulant0@gmail.com', '$2y$10$D6YLBfMBWCzK13yrHxnzjeG/LwOHmYmnKGCmyP3PiBgJV7G7Tu0eq', 'images/1719756304Group 478@2x.png', 'Active now'),
(7, 706933, 'Gil', 'Ross', 'nosufowoso@mailinator.com', '$2y$10$wdAPF4NJrf7Z0802KafZFe2GkYjRVzzqBFvf0g75mi4QsMeDDNQTK', 'images/17214802561705090188950.jpg', 'Offline now'),
(6, 817944, 'tau', 'tau', 'tau@gmail.com', '$2y$10$Kiw5Zk/NLXeDFbqtj8Zwc.W/Avz73zrwdTsmuqPf6W8eh0FEawqp6', 'images/1720364032Screenshot 2024-07-07 164224.png', 'Offline now');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
