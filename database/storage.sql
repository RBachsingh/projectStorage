-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2024 at 10:33 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `storage`
--
CREATE DATABASE IF NOT EXISTS `storage` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `storage`;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20231208085554', '2023-12-08 09:56:04', 137),
('DoctrineMigrations\\Version20231214092246', '2023-12-14 10:23:23', 268),
('DoctrineMigrations\\Version20231215091839', '2023-12-15 10:18:56', 451),
('DoctrineMigrations\\Version20231218155408', '2023-12-18 16:54:24', 309),
('DoctrineMigrations\\Version20240102122247', '2024-01-02 13:22:59', 109),
('DoctrineMigrations\\Version20240105111520', '2024-01-05 12:15:33', 12),
('DoctrineMigrations\\Version20240109143715', '2024-01-09 15:37:36', 136),
('DoctrineMigrations\\Version20240110120407', '2024-01-10 13:04:26', 102),
('DoctrineMigrations\\Version20240110121356', '2024-01-10 13:14:11', 183),
('DoctrineMigrations\\Version20240125111314', '2024-01-25 13:25:09', 20),
('DoctrineMigrations\\Version20240205155602', '2024-02-05 16:56:10', 131);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `categories` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `amount` bigint(20) NOT NULL,
  `purchasing_value` decimal(10,2) NOT NULL,
  `sales_value` decimal(10,2) NOT NULL,
  `alert_value` int(11) NOT NULL,
  `creation_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `categories`, `description`, `amount`, `purchasing_value`, `sales_value`, `alert_value`, `creation_date`) VALUES
(15, 'Start sticker', 'stickers', 'dit is een demo item.', 3, 1.00, 1.10, 1, '2024-01-10 00:00:00'),
(17, 'Stop Stickers', 'stickers', 'dit is een demo item', 3, 1.00, 1.10, 1, '2024-01-14 13:32:43'),
(22, 'telpo', 'terminals', '360', 20, 150.00, 195.00, 1, '2024-01-23 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `items_reservation_item`
--

DROP TABLE IF EXISTS `items_reservation_item`;
CREATE TABLE `items_reservation_item` (
  `items_id` int(11) NOT NULL,
  `reservation_item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `creation_time` datetime NOT NULL,
  `last_update` datetime NOT NULL,
  `status` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id`, `comment`, `creation_time`, `last_update`, `status`, `user_id`) VALUES
(1, ':D', '2024-01-12 11:03:51', '2024-01-12 11:03:51', 'Not Ready', 1),
(2, 'D:', '2024-01-17 15:40:00', '2023-01-15 13:36:00', 'Not Ready', 1),
(5, ':DD', '2024-01-24 00:00:00', '2024-01-24 00:00:00', 'Ready', 1);

-- --------------------------------------------------------

--
-- Table structure for table `reservation_comment`
--

DROP TABLE IF EXISTS `reservation_comment`;
CREATE TABLE `reservation_comment` (
  `id` int(11) NOT NULL,
  `comment` longtext NOT NULL,
  `time` datetime NOT NULL,
  `reservation_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservation_item`
--

DROP TABLE IF EXISTS `reservation_item`;
CREATE TABLE `reservation_item` (
  `id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `reservation_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservation_reservation_item`
--

DROP TABLE IF EXISTS `reservation_reservation_item`;
CREATE TABLE `reservation_reservation_item` (
  `reservation_id` int(11) NOT NULL,
  `reservation_item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`roles`)),
  `password` varchar(255) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `l_name` varchar(255) NOT NULL,
  `last_notification_id` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `f_name`, `l_name`, `last_notification_id`) VALUES
(1, 'j.cleanadmin@hotmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$e7IdAaNWw91X8GCrZOPbZuEaxgb7jUjwjS7nVzan785zsO4K3XKaq', 'Jack', 'Clean', '1'),
(2, 'c@hotmail.com', '[\"ROLE_USER\"]', '$2y$13$KoVZUl7EbyVVYuY9eeICouUfmB/aZk6LydsqC93ay3r5IEgcC7SL2', 'a', 'b', '2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items_reservation_item`
--
ALTER TABLE `items_reservation_item`
  ADD PRIMARY KEY (`items_id`,`reservation_item_id`),
  ADD KEY `IDX_6C6C330E6BB0AE84` (`items_id`),
  ADD KEY `IDX_6C6C330E75FAE9DB` (`reservation_item_id`);

--
-- Indexes for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_42C84955A76ED395` (`user_id`);

--
-- Indexes for table `reservation_comment`
--
ALTER TABLE `reservation_comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F3E1E9E9B83297E7` (`reservation_id`);

--
-- Indexes for table `reservation_item`
--
ALTER TABLE `reservation_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_922E876B83297E7` (`reservation_id`);

--
-- Indexes for table `reservation_reservation_item`
--
ALTER TABLE `reservation_reservation_item`
  ADD PRIMARY KEY (`reservation_id`,`reservation_item_id`),
  ADD KEY `IDX_67D01FEB83297E7` (`reservation_id`),
  ADD KEY `IDX_67D01FE75FAE9DB` (`reservation_item_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `reservation_comment`
--
ALTER TABLE `reservation_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservation_item`
--
ALTER TABLE `reservation_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `items_reservation_item`
--
ALTER TABLE `items_reservation_item`
  ADD CONSTRAINT `FK_6C6C330E6BB0AE84` FOREIGN KEY (`items_id`) REFERENCES `items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_6C6C330E75FAE9DB` FOREIGN KEY (`reservation_item_id`) REFERENCES `reservation_item` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `FK_42C84955A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `reservation_comment`
--
ALTER TABLE `reservation_comment`
  ADD CONSTRAINT `FK_F3E1E9E9B83297E7` FOREIGN KEY (`reservation_id`) REFERENCES `reservation` (`id`);

--
-- Constraints for table `reservation_item`
--
ALTER TABLE `reservation_item`
  ADD CONSTRAINT `FK_922E876B83297E7` FOREIGN KEY (`reservation_id`) REFERENCES `reservation` (`id`);

--
-- Constraints for table `reservation_reservation_item`
--
ALTER TABLE `reservation_reservation_item`
  ADD CONSTRAINT `FK_67D01FE75FAE9DB` FOREIGN KEY (`reservation_item_id`) REFERENCES `reservation_item` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_67D01FEB83297E7` FOREIGN KEY (`reservation_id`) REFERENCES `reservation` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
