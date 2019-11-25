-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 25, 2019 at 04:12 PM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bnb`
--

-- --------------------------------------------------------

--
-- Table structure for table `amneties`
--

DROP TABLE IF EXISTS `amneties`;
CREATE TABLE IF NOT EXISTS `amneties` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `amneties`
--

INSERT INTO `amneties` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Free Wi-Fi', NULL, NULL),
(2, 'Parking', NULL, NULL),
(3, 'Air conditioning', NULL, NULL),
(4, 'TV', NULL, NULL),
(5, 'Microwave', NULL, NULL),
(6, 'Washing machine', NULL, NULL),
(7, 'Dryer', NULL, NULL),
(8, 'Iron', NULL, NULL),
(9, 'Towels', NULL, NULL),
(10, 'Soap', NULL, NULL),
(11, 'Dishwasher', NULL, NULL),
(12, 'Toilet paper', NULL, NULL),
(13, 'Fridge', NULL, NULL),
(14, 'Stove', NULL, NULL),
(15, 'Smoke detector', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `amnety_listing`
--

DROP TABLE IF EXISTS `amnety_listing`;
CREATE TABLE IF NOT EXISTS `amnety_listing` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `listing_id` int(11) NOT NULL,
  `amnety_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `amnety_listing`
--

INSERT INTO `amnety_listing` (`id`, `listing_id`, `amnety_id`, `created_at`, `updated_at`) VALUES
(1, 5, 1, NULL, NULL),
(2, 5, 2, NULL, NULL),
(3, 5, 6, NULL, NULL),
(4, 6, 1, NULL, NULL),
(5, 6, 2, NULL, NULL),
(6, 7, 1, NULL, NULL),
(7, 7, 2, NULL, NULL),
(8, 8, 1, NULL, NULL),
(9, 8, 2, NULL, NULL),
(10, 8, 3, NULL, NULL),
(11, 8, 4, NULL, NULL),
(12, 8, 5, NULL, NULL),
(13, 9, 1, NULL, NULL),
(14, 9, 3, NULL, NULL),
(15, 9, 7, NULL, NULL),
(16, 9, 8, NULL, NULL),
(17, 10, 1, NULL, NULL),
(18, 10, 2, NULL, NULL),
(19, 10, 3, NULL, NULL),
(20, 10, 4, NULL, NULL),
(21, 10, 5, NULL, NULL),
(22, 10, 12, NULL, NULL),
(23, 11, 1, NULL, NULL),
(24, 11, 2, NULL, NULL),
(25, 11, 3, NULL, NULL),
(26, 11, 4, NULL, NULL),
(27, 11, 6, NULL, NULL),
(28, 12, 1, NULL, NULL),
(29, 12, 3, NULL, NULL),
(30, 12, 4, NULL, NULL),
(31, 12, 6, NULL, NULL),
(32, 12, 7, NULL, NULL),
(33, 13, 1, NULL, NULL),
(34, 13, 2, NULL, NULL),
(35, 13, 3, NULL, NULL),
(36, 13, 4, NULL, NULL),
(37, 13, 5, NULL, NULL),
(38, 13, 6, NULL, NULL),
(39, 14, 1, NULL, NULL),
(40, 14, 3, NULL, NULL),
(41, 14, 4, NULL, NULL),
(42, 14, 6, NULL, NULL),
(43, 14, 13, NULL, NULL),
(44, 15, 1, NULL, NULL),
(45, 15, 3, NULL, NULL),
(46, 15, 4, NULL, NULL),
(47, 15, 5, NULL, NULL),
(48, 15, 13, NULL, NULL),
(49, 16, 1, NULL, NULL),
(50, 16, 2, NULL, NULL),
(51, 16, 3, NULL, NULL),
(52, 16, 4, NULL, NULL),
(53, 16, 6, NULL, NULL),
(54, 16, 9, NULL, NULL),
(55, 16, 13, NULL, NULL),
(56, 17, 1, NULL, NULL),
(57, 17, 3, NULL, NULL),
(58, 17, 5, NULL, NULL),
(59, 12, 8, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `custom_notifications`
--

DROP TABLE IF EXISTS `custom_notifications`;
CREATE TABLE IF NOT EXISTS `custom_notifications` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `text` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `seen` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `custom_notifications`
--

INSERT INTO `custom_notifications` (`id`, `user_id`, `text`, `url`, `seen`, `created_at`, `updated_at`) VALUES
(5, 1, 'Your host has sent you a new message.', 'http://localhost/BnB/public/my-bookings/20', 1, '2019-09-14 07:36:56', '2019-09-14 07:37:21'),
(6, 2, 'You have recieved a new reservation for your listing \"TEST TEST yoyo\".', 'http://localhost/BnB/public/guestlist/22', 1, '2019-09-14 07:40:22', '2019-09-23 15:46:10'),
(7, 2, 'Your guest has has canceled the reservation #22', 'http://localhost/BnB/public/guestlist/22', 1, '2019-09-14 07:40:30', '2019-09-23 15:46:04'),
(8, 1, 'You have recieved a new reservation for your listing \"Apartment Dubrovnik 1\".', 'http://localhost/BnB/public/guestlist/24', 1, '2019-09-14 22:21:39', '2019-09-18 14:44:22'),
(9, 1, 'Your guest has has canceled the reservation #24', 'http://localhost/BnB/public/guestlist/24', 1, '2019-09-14 22:22:58', '2019-09-18 14:44:08'),
(10, 2, 'You have recieved a new reservation for your listing \"Dubrovnik 2\".', 'http://localhost/BnB/public/guestlist/25', 1, '2019-09-14 22:35:14', '2019-09-18 14:45:16'),
(11, 2, 'Your guest has has canceled the reservation #28', 'http://localhost/BnB/public/guestlist/28', 1, '2019-09-18 14:35:45', '2019-09-18 14:45:10'),
(12, 2, 'You have recieved a new reservation for your listing \"Apartment Old Town\".', 'http://localhost/BnB/public/guestlist/32', 1, '2019-09-23 17:09:57', '2019-09-23 17:10:13'),
(13, 1, 'Your host has sent you a new message.', 'http://localhost/BnB/public/my-bookings/32', 1, '2019-09-23 17:10:22', '2019-09-23 17:12:16'),
(14, 1, 'Your host has sent you a new message.', 'http://localhost/BnB/public/my-bookings/32', 1, '2019-09-23 17:12:03', '2019-09-23 17:12:17'),
(15, 2, 'You have recieved a new reservation for your listing \"Apartment Wall Street\".', 'http://localhost/BnB/public/guestlist/33', 1, '2019-09-23 17:13:54', '2019-09-23 17:15:07'),
(16, 1, 'Your host has sent you a new message.', 'http://localhost/BnB/public/my-bookings/33', 1, '2019-09-23 17:15:48', '2019-09-23 17:15:59'),
(17, 2, 'Your guest has left you a review for the reservation #33', 'http://localhost/BnB/public/guestlist/33', 1, '2019-09-23 17:16:46', '2019-09-23 17:17:02'),
(18, 2, 'You have recieved a new reservation for your listing \"Studio ART\".', 'http://localhost/BnB/public/guestlist/34', 1, '2019-09-24 19:09:04', '2019-09-24 19:10:06'),
(19, 2, 'You have recieved a new reservation for your listing \"Apartment Oxford\".', 'http://localhost/BnB/public/guestlist/35', 1, '2019-09-25 05:54:37', '2019-09-25 05:54:53'),
(20, 2, 'You have recieved a new reservation for your listing \"Apartment Oxford\".', 'http://localhost/BnB/public/guestlist/38', 1, '2019-09-25 06:32:50', '2019-09-25 06:33:26'),
(21, 2, 'Your guest has sent you a new message.', 'http://localhost/BnB/public/guestlist/38', 1, '2019-09-25 06:33:07', '2019-09-25 06:33:21'),
(22, 2, 'You have recieved a new reservation for your listing \"Apartment Wall Street\".', 'http://localhost/BnB/public/guestlist/40', 1, '2019-10-19 16:07:18', '2019-10-19 16:08:28'),
(23, 2, 'You have recieved a new reservation for your listing \"Apartment Wall Street\".', 'http://localhost/BnB/public/guestlist/37', 1, '2019-10-29 12:02:06', '2019-10-29 12:02:37'),
(24, 1, 'Your host has sent you a new message.', 'http://localhost/BnB/public/my-bookings/37', 1, '2019-10-29 12:02:51', '2019-10-29 12:03:01');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `listing_id` int(11) NOT NULL,
  `url` varchar(511) NOT NULL DEFAULT '',
  `thumbnail_url` varchar(511) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `listing_id`, `url`, `thumbnail_url`, `title`, `created_at`, `updated_at`) VALUES
(11, 0, '/listings/8/header.jpg', '', 'Apartment Dubrovnik 1', '2019-09-14 21:48:14', '2019-09-14 21:48:14'),
(18, 0, '/BnB/storage/app/public/listings/9/header.jpg', '', 'Dubrovnik 2', '2019-09-14 22:17:05', '2019-09-14 22:17:05'),
(21, 9, '/listings/9/bedroom_1569261665.jpg', '', 'Bedroom', '2019-09-23 16:01:05', '2019-09-23 16:01:05'),
(22, 9, '/listings/9/bedroom_1569261942.jpg', '', 'Bedroom', '2019-09-23 16:05:42', '2019-09-23 16:05:42'),
(23, 9, '/listings/9/kitchen_1569261956.jpg', '', 'Kitchen', '2019-09-23 16:05:56', '2019-09-23 16:05:56'),
(24, 8, '/listings/8/bedroom_1569262059.jpg', '', 'Bedroom', '2019-09-23 16:07:39', '2019-09-23 16:07:39'),
(25, 8, '/listings/8/living-room_1569262086.jpg', '', 'Living room', '2019-09-23 16:08:06', '2019-09-23 16:08:06'),
(26, 8, '/listings/8/bedroom_1569262110.jpg', '', 'Bedroom', '2019-09-23 16:08:30', '2019-09-23 16:08:30'),
(27, 8, '/listings/8/gardenpatio_1569262321.jpg', '', 'Garden/Patio', '2019-09-23 16:12:01', '2019-09-23 16:12:01'),
(28, 0, '/BnB/storage/app/public/listings/10/header.jpg', '', 'Apartment Old Town', '2019-09-23 16:20:39', '2019-09-23 16:20:39'),
(29, 10, '/listings/10/living-roombedroom_1569262871.jpg', '', 'Living room/Bedroom', '2019-09-23 16:21:11', '2019-09-23 16:21:11'),
(30, 10, '/listings/10/stairs_1569262882.jpg', '', 'Stairs', '2019-09-23 16:21:22', '2019-09-23 16:21:22'),
(31, 10, '/listings/10/living-roombedroom_1569262902.jpg', '', 'Living room/Bedroom', '2019-09-23 16:21:42', '2019-09-23 16:21:42'),
(32, 10, '/listings/10/kitchen_1569262915.jpg', '', 'Kitchen', '2019-09-23 16:21:55', '2019-09-23 16:21:55'),
(33, 0, '/BnB/storage/app/public/listings/11/header.jpg', '', 'Apartment Oxford', '2019-09-23 16:26:32', '2019-09-23 16:26:32'),
(34, 11, '/listings/11/living-room_1569263201.jpg', '', 'Living room', '2019-09-23 16:26:41', '2019-09-23 16:26:41'),
(36, 11, '/listings/11/kitchen_1569263226.jpg', '', 'Kitchen', '2019-09-23 16:27:06', '2019-09-23 16:27:06'),
(37, 11, '/listings/11/bathroom_1569263248.jpg', '', 'Bathroom', '2019-09-23 16:27:28', '2019-09-23 16:27:28'),
(38, 0, '/BnB/storage/app/public/listings/12/header.jpg', '', 'LCS Liverpool Street Apartments', '2019-09-23 16:32:51', '2019-09-23 16:32:51'),
(39, 12, '/listings/12/living-room_1569263581.jpg', '', 'Living room', '2019-09-23 16:33:01', '2019-09-23 16:33:01'),
(40, 12, '/listings/12/living-room_1569263589.jpg', '', 'Living room', '2019-09-23 16:33:09', '2019-09-23 16:33:09'),
(41, 12, '/listings/12/living-room_1569263600.jpg', '', 'Living room', '2019-09-23 16:33:20', '2019-09-23 16:33:20'),
(42, 12, '/listings/12/bathroom_1569263612.jpg', '', 'Bathroom', '2019-09-23 16:33:32', '2019-09-23 16:33:32'),
(43, 12, '/listings/12/bedroom_1569263620.jpg', '', 'Bedroom', '2019-09-23 16:33:40', '2019-09-23 16:33:40'),
(44, 0, '/BnB/storage/app/public/listings/13/header.jpg', '', 'Apartment Wall Street', '2019-09-23 16:40:04', '2019-09-23 16:40:04'),
(45, 13, '/listings/13/living-room_1569264012.jpg', '', 'Living room', '2019-09-23 16:40:12', '2019-09-23 16:40:12'),
(46, 13, '/listings/13/bedroom_1569264025.jpg', '', 'Bedroom', '2019-09-23 16:40:25', '2019-09-23 16:40:25'),
(47, 13, '/listings/13/bedroom_1569264033.jpg', '', 'Bedroom', '2019-09-23 16:40:33', '2019-09-23 16:40:33'),
(48, 13, '/listings/13/bathroom_1569264046.jpg', '', 'Bathroom', '2019-09-23 16:40:46', '2019-09-23 16:40:46'),
(49, 13, '/listings/13/kitchen_1569264058.jpg', '', 'Kitchen', '2019-09-23 16:40:58', '2019-09-23 16:40:58'),
(50, 0, '/BnB/storage/app/public/listings/14/header.jpg', '', 'Apartment Times Square', '2019-09-23 16:45:53', '2019-09-23 16:45:53'),
(51, 14, '/listings/14/living-room_1569264363.jpg', '', 'Living room', '2019-09-23 16:46:03', '2019-09-23 16:46:03'),
(52, 14, '/listings/14/bedroom_1569264371.jpg', '', 'Bedroom', '2019-09-23 16:46:11', '2019-09-23 16:46:11'),
(53, 14, '/listings/14/kitchen_1569264385.jpg', '', 'Kitchen', '2019-09-23 16:46:25', '2019-09-23 16:46:25'),
(54, 14, '/listings/14/living-room_1569264392.jpg', '', 'Living room', '2019-09-23 16:46:32', '2019-09-23 16:46:32'),
(55, 0, '/BnB/storage/app/public/listings/15/header.jpg', '', 'Studio ART', '2019-09-23 16:54:54', '2019-09-23 16:54:54'),
(56, 15, '/listings/15/living-room_1569264910.jpg', '', 'Living room', '2019-09-23 16:55:10', '2019-09-23 16:55:10'),
(57, 15, '/listings/15/bathroom_1569264925.jpg', '', 'Bathroom', '2019-09-23 16:55:25', '2019-09-23 16:55:25'),
(58, 15, '/listings/15/living-room_1569264934.jpg', '', 'Living room', '2019-09-23 16:55:34', '2019-09-23 16:55:34'),
(59, 15, '/listings/15/kitchen_1569264946.jpg', '', 'Kitchen', '2019-09-23 16:55:46', '2019-09-23 16:55:46'),
(60, 15, '/listings/15/studio_1569264957.jpg', '', 'Studio', '2019-09-23 16:55:57', '2019-09-23 16:55:57'),
(61, 0, '/BnB/storage/app/public/listings/16/header.jpg', '', 'Luxury Apartment Prokurative', '2019-09-23 17:00:07', '2019-09-23 17:00:07'),
(62, 16, '/listings/16/bedroom_1569265512.jpg', '', 'Bedroom', '2019-09-23 17:05:12', '2019-09-23 17:05:12'),
(63, 16, '/listings/16/living-room_1569265521.jpg', '', 'Living room', '2019-09-23 17:05:21', '2019-09-23 17:05:21'),
(64, 16, '/listings/16/bedroom_1569265529.jpg', '', 'Bedroom', '2019-09-23 17:05:29', '2019-09-23 17:05:29'),
(65, 16, '/listings/16/kitchen_1569265541.jpg', '', 'Kitchen', '2019-09-23 17:05:41', '2019-09-23 17:05:41'),
(66, 16, '/listings/16/bathroom_1569265553.jpg', '', 'Bathroom', '2019-09-23 17:05:53', '2019-09-23 17:05:53'),
(67, 0, '/BnB/storage/app/public/listings/17/header.jpg', '', 'apartman zagreb', '2019-09-25 06:01:17', '2019-09-25 06:01:17'),
(68, 17, '/listings/17/bedroom_1569398491.jpg', '', 'Bedroom', '2019-09-25 06:01:31', '2019-09-25 06:01:31'),
(69, 17, '/listings/17/living-room_1569398499.jpg', '', 'Living room', '2019-09-25 06:01:39', '2019-09-25 06:01:39');

-- --------------------------------------------------------

--
-- Table structure for table `listings`
--

DROP TABLE IF EXISTS `listings`;
CREATE TABLE IF NOT EXISTS `listings` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_id` int(11) DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guests` bigint(20) UNSIGNED NOT NULL,
  `location_id` int(20) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `bedrooms` bigint(20) UNSIGNED NOT NULL,
  `beds` bigint(20) UNSIGNED NOT NULL,
  `bathrooms` bigint(20) UNSIGNED NOT NULL,
  `price` bigint(20) UNSIGNED NOT NULL,
  `check_in_from` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `check_in_to` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `check_out` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `visible` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `address` varchar(511) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `listings_user_id_index` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `listings`
--

INSERT INTO `listings` (`id`, `user_id`, `name`, `image_id`, `type`, `guests`, `location_id`, `description`, `bedrooms`, `beds`, `bathrooms`, `price`, `check_in_from`, `check_in_to`, `check_out`, `visible`, `created_at`, `updated_at`, `address`) VALUES
(8, 1, 'Apartment Dubrovnik 1', 11, NULL, 4, 1, 'Apartment is located in the center of Dubrovnik, in the part called Lapad.\r\nThe apartment is located in quiet neighborhood but is also very close to all necessary facilities ( Old town, beach, promenades, groceries shop, bank, cafes, restaurants, children playground, casino etc. ).\r\nGeneral Information\r\nApartment extends to 50 m2 ground floor of the house where there are two bedrooms, kitchen, dining room, living room, bathroom and 7m2 terrace.\r\nTotal number of persons: 4\r\nBABY cot- on request', 2, 1, 1, 90, '14:00', '00:00', '10:00', 1, '2019-09-14 21:48:13', '2019-10-29 12:00:05', 'Od Hladnice 3,'),
(9, 2, 'Dubrovnik 2', 18, NULL, 3, 1, 'Apartment is located in the center of Dubrovnik, in the part called Lapad.\r\nThe apartment is located in quiet neigborhood but is also very close to all necessary facilities ( Old town, beach, promenades, groceries shop, bank, cafes, restaurants, children playground, casino etc. ).\r\nGeneral Information\r\nApartment extends to 30 m2 ground floor of the house where there are two bedrooms, kitchen, dining room, living room, bathroom and 20m2 terrace.\r\nTotal number of persons: 4\r\nBABY cot- on request', 2, 1, 1, 60, '00:00', '00:00', '00:00', 1, '2019-09-14 22:17:05', '2019-09-23 15:59:10', 'Od Hladnice 3,'),
(10, 2, 'Apartment Old Town', 28, NULL, 4, 1, 'Located a 4-minute walk from Onofrio\'s Fountain in Dubrovnik, Apartment Old Town has accommodations with air conditioning and free WiFi.\r\n\r\nThe units come with hardwood floors and feature a fully equipped kitchen with a dishwasher, a dining area, a flat-screen TV with satellite channels, and a private bathroom with shower and a hairdryer. A fridge, an oven and stovetop are also available, as well as an electric tea pot.\r\n\r\nPopular points of interest near the apartment include Pile Gate, Orlando Column and Stradun. The nearest airport is Dubrovnik, 19.3 km from Apartment Old Town, and the property offers a paid airport shuttle service.\r\n\r\nOld Town is a great choice for travelers interested in architecture, history and atmosphere.', 2, 3, 1, 150, '15:00', '00:00', '09:00', 1, '2019-09-23 16:20:39', '2019-09-23 16:20:42', 'Old Town Dubrovnik'),
(11, 2, 'Apartment Oxford', 33, NULL, 4, 3, 'In the Westminster Borough district of London, close to Carnaby Street, Cosy, Cute 2 Bed Oxford Street Flat features free WiFi and a washing machine. The property is a 19-minute walk from Piccadilly Circus and 1.8 km from Queen\'s Theatre.\r\n\r\nThe apartment features 2 separate bedrooms, 1 bathroom, a fully equipped kitchen with a dining area and dishwasher, and a living room with a TV.\r\n\r\nPopular points of interest near the apartment include Oxford Street, Dominion Theatre and Piccadilly Theatre. The nearest airport is London City Airport, 16.1 km from Cosy, Cute 2 Bed Oxford Street Flat.\r\n\r\nWestminster Borough is a great choice for travelers interested in shopping, parks and city walks.', 2, 2, 1, 110, '12:00', '22:00', '12:00', 1, '2019-09-23 16:26:32', '2019-09-23 16:26:33', 'Oxford street N/A'),
(12, 2, 'LCS Liverpool Street Apartments', 38, NULL, 5, 3, 'Located in London, near Brick Lane, Sky Garden and Tower of London, LCS Liverpool Street Apartments features free WiFi.\r\n\r\nEach unit comes with a fully equipped kitchen with a dishwasher, a seating area with a sofa, a flat-screen TV, a washing machine, and a private bathroom with shower and a hairdryer. A microwave, a fridge and oven are also offered, as well as an electric tea pot.\r\n\r\nTower Bridge is 1.9 km from the apartment, while St Paul\'s Cathedral is 2.6 km from the property. The nearest airport is London City Airport, 9.7 km from LCS Liverpool Street Apartments.\r\n\r\nTower Hamlets is a great choice for travelers interested in atmosphere, convenient public transportation and tourist attractions.', 2, 1, 1, 130, '00:00', '00:00', '00:00', 1, '2019-09-23 16:32:51', '2019-10-19 16:03:22', 'Liverpool street 22'),
(13, 2, 'Apartment Wall Street', 44, NULL, 6, 5, 'Located in New York, a 20-minute walk from National September 11 Memorial & Museum and 1.9 km from One World Trade Center, Apartment Wall Street provides accommodations with free WiFi, air conditioning.\r\n\r\nThe units come with hardwood floors and feature a fully equipped kitchenette with a microwave, a flat-screen TV with cable channels, and a private bathroom with shower and a hairdryer.\r\n\r\nThe condo hotel offers a hot tub.\r\n\r\nA terrace can be found at Apartment Wall Street, along with a shared lounge.\r\n\r\nBrooklyn Bridge is 2.3 km from the accommodation, while Bloomingdales is 3.1 km away. The nearest airport is LaGuardia Airport, 17.7 km from Apartment Wall Street.\r\n\r\nWall Street - Financial District is a great choice for travelers interested in skyline views, architecture and tourist attractions.', 3, 3, 2, 200, '14:00', '00:00', '09:00', 1, '2019-09-23 16:40:04', '2019-09-25 05:55:42', 'Wall Street'),
(14, 2, 'Apartment Times Square', 50, NULL, 8, 5, 'In the Central New York City district of New York, close to Macy\'s,Apartment Times Square has free WiFi and a washing machine. The property is 1.9 km from Empire State Building and 1.9 km from New York Public Library.\r\n\r\nThe air-conditioned apartment is composed of 3 separate bedrooms, a living room, a fully equipped kitchen with a dishwasher and microwave, and 1 bathroom. A flat-screen TV with cable channels is offered.\r\n\r\nPopular points of interest near the apartment include Times Square, Madison Square Garden and Bryant Park. The nearest airport is LaGuardia, 16.1 km from 3 BEDROOMS 1 BATHROOM by Times Squa, and the property offers a paid airport shuttle service.', 3, 3, 1, 220, '16:00', '00:00', '12:00', 1, '2019-09-23 16:45:53', '2019-09-23 16:45:54', 'Times Square'),
(15, 2, 'Studio ART', 55, NULL, 2, 4, 'Located in the Split City Center of Split, 1.1 mi from Jezinac Beach and 1.3 mi from Kastelet Beach, Hot Spot Studio offers free WiFi, a shared lounge and air conditioning. The property has city views and is 2.2 mi from Bene Beach and 2.2 mi from Kasjuni Beach.\r\n\r\nThis apartment features 1 bedroom, a kitchen with a fridge and a stovetop, a flat-screen TV, a seating area and 1 bathroom with a shower.\r\n\r\nMladezi Park Stadium is 2.4 mi from the apartment, while Bacvice Beach is 0.9 mi from the property. The nearest airport is Split, 17 mi from Hot Spot Studio, and the property offers a free airport shuttle service.', 2, 2, 1, 95, '13:00', '00:00', '11:00', 1, '2019-09-23 16:54:54', '2019-09-23 16:54:55', 'Dioklecijanova ulica 21'),
(16, 2, 'Luxury Apartment Prokurative', 61, NULL, 5, 4, 'Located in the center of Split, 550 m from Diocletian\'s Palace and 2.5 mi from Znjan Beach, Luxury Apartment Prokurative offers air conditioning. It has sea views and free WiFi.\r\n\r\nThis apartment has 2 bedrooms, a kitchen, a flat-screen TV, a seating area and 2 bathrooms.\r\n\r\nRepublic Square - Prokurative is 161 m from the apartment, while Poljud Stadium is 1.1 mi away. Split Airport is 17 mi from the property.', 2, 2, 1, 180, '13:00', '00:00', '09:00', 1, '2019-09-23 17:00:07', '2019-09-23 17:00:08', 'Republic Square 1'),
(17, 1, 'apartman zagreb', 67, NULL, 6, 2, 'opis', 2, 3, 2, 50, '07:00', '20:00', '11:00', 1, '2019-09-25 06:01:17', '2019-09-25 06:01:23', 'yagreb123');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

DROP TABLE IF EXISTS `locations`;
CREATE TABLE IF NOT EXISTS `locations` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `image` varchar(511) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `name`, `image`) VALUES
(1, 'Dubrovnik', 'https://www.dw.com/image/19094630_303.jpg'),
(2, 'Zagreb', 'https://s27412.pcdn.co/wp-content/uploads/2017/05/ZAGREB_shutterstock_495515356.jpg'),
(3, 'London', 'https://img.theculturetrip.com/768x432/wp-content/uploads/2017/01/aerial-panoramic-cityscape-view-of-london-and-the-river-thames-england-united-kingdom-shutterstock_551334580.jpg'),
(4, 'Split', 'https://afar-production.imgix.net/uploads/syndication/holland_americas/images/qjliteZuiU/original_ESY-001010681crop.jpg?w=1440&h=523&fit=crop'),
(5, 'New York', 'https://static.independent.co.uk/s3fs-public/thumbnails/image/2018/01/31/09/new-york-main-image.jpg?w968h681');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `text` text,
  `user_id` int(11) DEFAULT NULL,
  `reservation_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `text`, `user_id`, `reservation_id`, `created_at`, `updated_at`) VALUES
(1, 'Bok bok ja bih tu spavao\n', 1, 2, NULL, NULL),
(2, 'ciji si ti mali', 2, 2, NULL, NULL),
(3, 'od staroga matijica matijic', 1, 2, NULL, NULL),
(4, 'YOYO ŠTA IMA BRALE', 1, 16, '2019-09-07 10:36:05', '2019-09-07 10:36:05'),
(5, 'Hej?!?!?', 1, 16, '2019-09-07 11:07:03', '2019-09-07 11:07:03'),
(6, 'A DAJ SE JAVI PLZ', 1, 16, '2019-09-07 11:07:16', '2019-09-07 11:07:16'),
(7, 'jebat cu te kad dodjes :)', 2, 16, '2019-09-07 11:23:14', '2019-09-07 11:23:14'),
(8, 'jebat cu te kad dodjes :)', 2, 16, '2019-09-07 11:38:52', '2019-09-07 11:38:52'),
(9, 'braleee', 1, 18, '2019-09-07 12:43:10', '2019-09-07 12:43:10'),
(10, 'halo', 2, 18, '2019-09-07 12:46:40', '2019-09-07 12:46:40'),
(11, 'dsds', 1, 19, '2019-09-07 12:57:06', '2019-09-07 12:57:06'),
(12, 'Test maila', 1, 16, '2019-09-08 09:17:37', '2019-09-08 09:17:37'),
(13, 'e sad to kao radi', 1, 16, '2019-09-08 09:23:05', '2019-09-08 09:23:05'),
(14, 'AAAAAA', 1, 16, '2019-09-08 09:26:50', '2019-09-08 09:26:50'),
(15, 'hejhejjj', 1, 16, '2019-09-08 09:29:29', '2019-09-08 09:29:29'),
(16, 'SUP', 1, 20, '2019-09-08 09:30:15', '2019-09-08 09:30:15'),
(17, 'hejhejjj', 1, 16, '2019-09-11 17:04:14', '2019-09-11 17:04:14'),
(18, 'hejhejjj', 1, 16, '2019-09-11 17:04:45', '2019-09-11 17:04:45'),
(19, 'heejjjjjjj', 1, 16, '2019-09-11 17:21:23', '2019-09-11 17:21:23'),
(20, 'oukej', 2, 16, '2019-09-11 17:37:20', '2019-09-11 17:37:20'),
(21, 'asdasd', 1, 21, '2019-09-12 17:44:06', '2019-09-12 17:44:06'),
(22, 'sawdsfsdf', 2, 20, '2019-09-14 07:36:55', '2019-09-14 07:36:55'),
(23, 'hhh', 1, 22, '2019-09-14 07:38:03', '2019-09-14 07:38:03'),
(24, 'Pozdrav, \r\nRadujem se dolasku u Dubrovnik! :)\r\nLijep pozdrav,\r\nToni Matijic', 2, 24, '2019-09-14 22:19:27', '2019-09-14 22:19:27'),
(25, 'Pozdrav', 1, 25, '2019-09-14 22:34:17', '2019-09-14 22:34:17'),
(26, 'ed', 1, 28, '2019-09-18 14:35:37', '2019-09-18 14:35:37'),
(27, 'Hi,\r\nI look forward meeting you and would love to stay in your beautiful apartment.\r\nCan you please tell me what is the best way to get from the airport to your apartment?\r\nBest regards,\r\nToni', 1, 32, '2019-09-23 17:08:32', '2019-09-23 17:08:32'),
(28, 'Dear Toni,', 2, 32, '2019-09-23 17:10:22', '2019-09-23 17:10:22'),
(29, 'Dear Toni, First of all thank you for booking Apartment Old Town. Best and fastest way to get from the airport is by Uber/Taxi. If you have any questions feel free to ask ;). Looking forward meeting you. Best regards', 2, 32, '2019-09-23 17:12:03', '2019-09-23 17:12:03'),
(30, 'Hi, I would like to book your beautiful apartment. Thanks!', 1, 33, '2019-09-23 17:13:12', '2019-09-23 17:13:12'),
(31, 'Dear Toni, Thank you for booking apartment Wall Street. If you have any questions feel free to ask ;). Looking forward meeting you. Best regards, Apartment Wall Street', 2, 33, '2019-09-23 17:15:48', '2019-09-23 17:15:48'),
(32, 'Hi, \r\nLooking forward visiting beautiful Split and staying in your apartment!\r\nBest regards,\r\nToni', 1, 34, '2019-09-24 19:08:21', '2019-09-24 19:08:21'),
(33, 'pozdrav', 1, 35, '2019-09-25 05:52:49', '2019-09-25 05:52:49'),
(34, 'dds', 1, 37, '2019-09-25 05:58:05', '2019-09-25 05:58:05'),
(35, 'dssdsdsd', 1, 38, '2019-09-25 06:32:16', '2019-09-25 06:32:16'),
(36, 'jdjjfjr', 1, 38, '2019-09-25 06:33:07', '2019-09-25 06:33:07'),
(37, 'hello me wanna stay', 1, 40, '2019-10-19 16:06:11', '2019-10-19 16:06:11'),
(38, 'jhaahahhahaha hvala', 2, 37, '2019-10-29 12:02:51', '2019-10-29 12:02:51');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_30_185737_create_listings_table', 1),
(4, '2019_09_01_154912_amneties', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prices`
--

DROP TABLE IF EXISTS `prices`;
CREATE TABLE IF NOT EXISTS `prices` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `listing_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prices`
--

INSERT INTO `prices` (`id`, `start`, `end`, `listing_id`, `price`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, '2019-09-01', '2019-09-30', 6, '1000.00', '2019-09-02 17:45:53', '2019-09-02 17:45:53', NULL),
(4, '2019-09-20', '2019-10-31', 9, '102.00', '2019-09-14 23:52:23', '2019-09-14 23:52:23', NULL),
(5, '2019-12-01', '2020-01-31', 9, '65.00', '2019-09-14 23:53:51', '2019-09-14 23:53:51', NULL),
(6, '2019-10-01', '2019-10-31', 8, '105.00', '2019-09-23 16:08:53', '2019-09-23 16:08:53', NULL),
(7, '2020-01-01', '2020-01-31', 11, '170.00', '2019-09-23 16:27:42', '2019-09-23 16:27:42', NULL),
(8, '2019-11-01', '2019-11-30', 12, '150.00', '2019-09-23 16:33:52', '2019-09-23 16:33:52', NULL),
(9, '2019-12-01', '2020-02-29', 13, '220.00', '2019-09-23 16:41:15', '2019-09-23 16:41:15', NULL),
(10, '2020-02-01', '2020-04-30', 14, '250.00', '2019-09-23 16:46:46', '2019-09-23 16:46:46', NULL),
(11, '2020-06-01', '2020-08-31', 15, '115.00', '2019-09-23 16:56:16', '2019-09-23 16:56:16', NULL),
(12, '2020-06-01', '2020-08-31', 16, '250.00', '2019-09-23 17:06:12', '2019-09-23 17:06:12', NULL),
(13, '2019-10-01', '2020-05-31', 16, '100.00', '2019-09-23 17:06:28', '2019-09-23 17:06:28', NULL),
(14, '2019-11-01', '2019-12-01', 13, '100.00', '2019-09-25 05:56:03', '2019-09-25 05:56:03', NULL),
(15, '2019-12-04', '2020-01-08', 13, '500.00', '2019-09-25 05:56:44', '2019-09-25 05:57:12', '2019-09-25 05:57:12'),
(16, '2019-12-25', '2020-01-06', 13, '400.00', '2019-09-25 05:57:43', '2019-09-25 05:57:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
CREATE TABLE IF NOT EXISTS `reservations` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `listing_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `paid` tinyint(1) NOT NULL DEFAULT '0',
  `guests` int(11) DEFAULT NULL,
  `owner_reservation` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'Da je lakse pratit, iako znamo po USER ID',
  `price` decimal(12,2) NOT NULL,
  `paypal_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `listing_id`, `user_id`, `start`, `end`, `paid`, `guests`, `owner_reservation`, `price`, `paypal_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(28, 9, 1, '2019-10-14', '2019-10-17', 0, 2, 0, '408.00', NULL, '2019-09-18 14:35:37', '2019-09-23 15:33:48', '2019-09-18 14:35:48'),
(29, 9, 2, '2019-09-11', '2019-09-25', 1, NULL, 1, '0.00', NULL, '2019-09-23 15:55:42', '2019-09-23 15:55:42', NULL),
(30, 8, 1, '2019-12-01', '2019-12-31', 1, NULL, 1, '0.00', NULL, '2019-09-23 16:09:04', '2019-09-23 16:09:04', NULL),
(31, 11, 2, '2019-10-16', '2019-10-24', 1, NULL, 1, '0.00', NULL, '2019-09-23 16:27:56', '2019-09-23 16:27:56', NULL),
(32, 10, 1, '2019-09-23', '2019-09-26', 1, 2, 0, '600.00', NULL, '2019-09-23 17:08:32', '2019-09-23 17:09:57', NULL),
(33, 13, 1, '2019-09-03', '2019-09-04', 1, 3, 0, '400.00', NULL, '2019-09-23 17:13:12', '2019-09-23 17:13:54', NULL),
(34, 15, 1, '2019-10-15', '2019-10-17', 1, 2, 0, '285.00', NULL, '2019-09-24 19:08:21', '2019-09-24 19:09:04', NULL),
(35, 11, 1, '2019-10-08', '2019-10-11', 1, 2, 0, '440.00', NULL, '2019-09-25 05:52:49', '2019-09-25 05:54:37', NULL),
(36, 13, 2, '2019-10-03', '2019-10-10', 1, NULL, 1, '0.00', NULL, '2019-09-25 05:56:14', '2019-09-25 05:56:14', NULL),
(37, 13, 1, '2019-12-27', '2019-12-31', 1, 2, 0, '1100.00', NULL, '2019-09-25 05:58:05', '2019-10-29 12:02:05', NULL),
(38, 11, 1, '2019-09-19', '2019-09-21', 1, 2, 0, '330.00', NULL, '2019-09-25 06:32:16', '2019-09-25 06:32:50', NULL),
(39, 12, 2, '2019-11-08', '2019-11-12', 1, NULL, 1, '0.00', NULL, '2019-10-19 16:03:49', '2019-10-19 16:03:49', NULL),
(40, 13, 1, '2019-11-10', '2019-11-15', 1, 2, 0, '600.00', NULL, '2019-10-19 16:06:11', '2019-10-19 16:07:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `text` text,
  `stars` int(11) NOT NULL DEFAULT '3',
  `reservation_id` int(11) NOT NULL,
  `listing_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `text`, `stars`, `reservation_id`, `listing_id`, `created_at`, `updated_at`) VALUES
(2, 'SUPER!ODLICNO123123', 3, 16, 5, '2019-09-08 09:56:45', '2019-09-08 09:56:45'),
(3, 'Apartment was perfect as described! Amazing host and location. Everything was close by. Highly recommending this apartment!! ;)', 5, 33, 13, '2019-09-23 17:16:48', '2019-09-23 17:16:48');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Toni Kupac', 'tmatijic@gmail.com', NULL, '$2y$12$HU5py5uGY2e76dEMoEpJAeiY8wJ9omYLToUsE0Z6xRdCq6rOtb/f.', NULL, '2019-08-30 16:03:51', '2019-08-30 16:03:51'),
(2, 'Toni Host', 'tmatijicbnb@gmail.com', NULL, '$2y$10$mbfddl70ZlWXQirrkC0EkeFzzRrpM/sgx6IF.xI1DEP58VAStF.7.', NULL, '2019-09-01 11:26:25', '2019-09-01 11:26:25');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
