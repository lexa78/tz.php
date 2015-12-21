-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 21, 2015 at 10:07 
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
  PRIMARY KEY (`id`),
  KEY `author_id` (`author_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tz_book`
--

INSERT INTO `tz_book` (`id`, `name`, `preview`, `date`, `created_at`, `updated_at`, `author_id`) VALUES
(7, 'Нос', 'KwbV-ftud4npmOuvdfaIr9HQ8QBVOtdD.jpg', 1450472400, 1450711641, 1450723399, 3),
(8, 'Сказка о золотой рыбке', 'WJbiulJGzzVlQ4pXdXJe9MGMbvGXdIEP.jpg', 1450904400, 1450714517, 1450718216, 1),
(9, 'Война и мир', 'SaiYt-wKJbctyS-jOdKsO3uv9ppWHONw.jpg', 1435352400, 1450714536, 1450719413, 2);

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
