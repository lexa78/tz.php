-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 22, 2015 at 04:55 
-- Server version: 5.5.41-log
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tz_php`
--

-- --------------------------------------------------------

--
-- Table structure for table `tz_author`
--

CREATE TABLE IF NOT EXISTS `tz_author` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tz_author`
--

INSERT INTO `tz_author` (`id`, `first_name`, `last_name`) VALUES
(1, 'Александр Сергеевич', 'Пушкин'),
(2, 'Лев Николаевич', 'Толстой'),
(3, 'Николай Васильевич', 'Гоголь');

-- --------------------------------------------------------

--
-- Table structure for table `tz_book`
--

CREATE TABLE IF NOT EXISTS `tz_book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `preview` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `after_date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `author_id` (`author_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Dumping data for table `tz_book`
--

INSERT INTO `tz_book` (`id`, `name`, `preview`, `date`, `created_at`, `updated_at`, `author_id`, `after_date`) VALUES
(7, 'Нос', 'KwbV-ftud4npmOuvdfaIr9HQ8QBVOtdD.jpg', 1450645200, 1450711641, 1450790991, 3, NULL),
(8, 'Сказка о золотой рыбке', 'WJbiulJGzzVlQ4pXdXJe9MGMbvGXdIEP.jpg', 1450645200, 1450714517, 1450791820, 1, NULL),
(9, 'Война и мир', 'SaiYt-wKJbctyS-jOdKsO3uv9ppWHONw.jpg', 1435352400, 1450714536, 1450719413, 2, NULL),
(10, 'Сказка о золотой рыбке и старухе и корыте', 'VJ46LgayFjdQI0Csr7fjo0KcDxP7wxgI.JPG', 1449003600, 1450779759, 1450791698, 1, NULL),
(11, 'Нос, ухо и рот', '_IUTSWR2U_Mfnh9eHiq66LZbHWNYx21k.jpg', 1440018000, 1450788325, 1450788515, 3, NULL),
(12, 'Мертвые души', 'yqimIfXUMLC2FWkc46p4xXtuRHVwTM2C.jpg', 1450558800, 1450788633, 1450790976, 3, NULL),
(13, 'Анна Каренина', 'hOIHQTreUg-jW9YZTlZkE5i1JlW5NpYN.jpg', 1446411600, 1450790515, 1450790618, 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tz_migration`
--

CREATE TABLE IF NOT EXISTS `tz_migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tz_migration`
--

INSERT INTO `tz_migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1450695707),
('m151221_103453_create_tables', 1450697364);

-- --------------------------------------------------------

--
-- Table structure for table `tz_user`
--

CREATE TABLE IF NOT EXISTS `tz_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tz_user`
--

INSERT INTO `tz_user` (`id`, `username`, `password`, `auth_key`, `token`, `email`) VALUES
(1, 'test', '$2y$13$PkGGRWJbK4S2oZC3v5yvmOEGfGRlNsyth6dcwJGjkGjB4geiADFoK', 'xVyU5fg2yIo1xVrIRKJgS_gVpeUWPFF9', '5oTno3Bc_2vJUvwhEj9d5fZZgFpZup1h_1450721424', 'test@t.r'),
(2, 'test1', '$2y$13$QTIv9bofTR8NIfD1LpKzrO5g95T1MqkKcZ5QLuCVj44aISoqtqQtm', 'mk0tjGCQTixzVvkBaMAbwFFcFvr786o2', 'mmGWDxxWBbld4PCVXNY6U_mP_rahxgq0_1450721748', 'test@t.ro');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tz_book`
--
ALTER TABLE `tz_book`
  ADD CONSTRAINT `author_id` FOREIGN KEY (`author_id`) REFERENCES `tz_author` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
