-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2015 at 01:17 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `book`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `activate` tinyint(1) NOT NULL,
  `time_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `time_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `activate` tinyint(1) NOT NULL,
  `time_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `time_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `image` varchar(200) NOT NULL,
  `category_id` int(11) NOT NULL,
  `description` mediumblob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `activate`, `time_create`, `time_update`, `image`, `category_id`, `description`) VALUES
(1, 'harry', 500, 1, '2015-07-31 08:00:39', '2015-07-31 08:00:39', 'product_harry', 0, 0x546865206c6f7264206f66207468652072696e67),
(2, 'lord', 600, 1, '2015-07-31 08:00:39', '2015-07-31 08:00:39', 'product_lord', 0, 0x686172727920706f74746572),
(3, 'fsfds', 1564654, 1, '2015-08-03 10:00:57', '2015-08-03 10:00:57', 'product_fsfds', 0, 0x6661646173646173646173),
(4, 'Vuong', 456416, 2, '2015-08-03 10:04:09', '2015-08-03 10:04:09', 'product_Vuong', 0, 0x667364616577657765),
(5, 'Vuong', 456416, 2, '2015-08-03 10:05:09', '2015-08-03 10:05:09', 'product_Vuong', 0, 0x667364616577657765);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `activate` tinyint(1) NOT NULL,
  `time_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `time_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `image` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=88 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `activate`, `time_create`, `time_update`, `image`, `email`, `password`) VALUES
(78, 'quangyeu', 1, '2015-08-03 06:39:54', '2015-08-03 09:09:00', 'avatar_quangyeu', 'hoangthuthao24@gmail.com', 'thaoyeu'),
(82, 'Nga', 1, '2015-08-03 07:09:24', '2015-08-03 09:06:50', 'avatar_Nga', 'hoangthuthao24@gmail.com', 'quangyeu'),
(84, 'Dinh', 1, '2015-08-03 07:10:10', '2015-08-03 07:10:10', 'avatar_Dinh', '', '12345'),
(85, 'Quan', 1, '2015-08-03 07:21:11', '2015-08-03 07:21:11', 'avatar_Quan', 'hoangthuthao24@gmail.com', 'quangyeu'),
(87, 'Lan', 0, '2015-08-03 07:44:03', '2015-08-03 07:44:03', 'avatar_Lan', 'hoangthuthao24@gmail.com', 'quangyeu');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
