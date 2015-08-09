-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 10, 2015 at 01:58 AM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `activate`, `time_create`, `time_update`) VALUES
(1, 'England', 2, '2015-08-06 08:37:55', '2015-08-07 02:37:19'),
(2, 'American', 2, '2015-08-06 08:38:06', '2015-08-07 02:38:35'),
(3, 'France', 1, '2015-08-06 08:42:56', '2015-08-06 08:42:56'),
(4, 'VietNam', 0, '2015-08-06 08:43:28', '2015-08-06 08:43:28'),
(5, 'ThaiLand', 2, '2015-08-07 02:11:11', '2015-08-07 02:38:47'),
(6, 'Japan', 2, '2015-08-07 03:07:57', '2015-08-07 03:07:57');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `activate`, `time_create`, `time_update`, `image`, `category_id`, `description`) VALUES
(1, 'GameofThrone', 500, 1, '2015-07-31 08:00:39', '2015-08-07 03:37:01', 'product_GameofThrone', 3, 0x4b686f6e6720686179),
(2, 'GonewiththeWind', 600, 1, '2015-07-31 08:00:39', '2015-08-06 08:12:11', 'product_GonewiththeWind', 2, 0x48617920),
(4, 'HarryPotter', 1255852112, 0, '2015-08-05 08:50:28', '2015-08-07 03:18:26', 'product_HarryPotter', 1, 0x486179),
(5, 'KinhVanHoa', 26516, 0, '2015-08-05 08:50:43', '2015-08-07 03:38:28', 'product_KinhVanHoa', 4, 0x486179),
(6, 'SherlockHomles', 1500000, 1, '2015-08-05 08:56:33', '2015-08-07 03:13:30', 'product_SherlockHomles', 3, 0x486179),
(7, 'KhongGiaDinh', 20200, 1, '2015-08-05 09:11:54', '2015-08-07 03:16:19', 'product_KhongGiaDinh', 4, 0x486179),
(8, 'Nicolas1', 156489, 0, '2015-08-05 09:12:20', '2015-08-07 04:31:25', 'product_Nicolas1', 3, 0x48617920),
(13, 'TuoiThoDuDoi', 12489222, 0, '2015-08-06 10:18:14', '2015-08-07 03:37:50', 'product_TuoiThoDuDoi', 4, 0x56696574204e616d),
(14, 'Nang Trong Vuon', 12589545, 1, '2015-08-07 07:18:16', '2015-08-07 07:18:16', 'product_Nang Trong Vuon', 4, 0x5468616368204c616d);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `activate`, `time_create`, `time_update`, `image`, `email`, `password`) VALUES
(1, 'HoangVanAnh', 2, '2015-08-03 07:09:24', '2015-08-07 03:31:57', 'avatar_HoangVanAnh', 'hoangthuthao24@gmail.com', 'quangyeu'),
(2, 'ThanhLoan123', 1, '2015-08-03 07:44:03', '2015-08-06 08:53:41', 'avatar_ThanhLoan123', 'hoangthuthao24@gmail.com', 'quangyeu'),
(4, 'HaNoi12345', 1, '2015-08-04 03:25:27', '2015-08-06 03:36:38', 'avatar_HaNoi12345', 'hoangthuthao24@gmail.com', '12345678'),
(5, 'TrangBooHam', 1, '2015-08-06 03:48:09', '2015-08-06 08:49:21', 'avatar_TrangBooHam', 'hoangthuthao24@gmail.com', 'quangyeu'),
(7, 'GameOfThrone', 1, '2015-08-06 06:23:30', '2015-08-06 06:50:52', 'avatar_GameOfThrone', 'hoangthuthao24@gmail.com', 'quangyeu'),
(8, 'HarryPotterNo1', 1, '2015-08-06 06:24:16', '2015-08-06 07:00:47', 'avatar_HarryPotterNo1', 'hoangthuthao24@gmail.com', 'quangyeu'),
(9, 'TheLordOfTheRing547', 1, '2015-08-06 06:24:36', '2015-08-06 09:39:14', 'avatar_TheLordOfTheRing547', 'hoangthuthao24@gmail.com', 'quangyeu'),
(10, 'TheHungerGame', 1, '2015-08-06 06:25:02', '2015-08-06 06:44:36', 'avatar_TheHungerGame', 'hoangthuthao24@gmail.com', 'quangyeu');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
