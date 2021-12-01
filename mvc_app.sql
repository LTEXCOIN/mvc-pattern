-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 27, 2021 at 03:28 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mvc_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `datatable`
--

DROP TABLE IF EXISTS `datatable`;
CREATE TABLE IF NOT EXISTS `datatable` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `amount` int(10) NOT NULL,
  `buyer` varchar(255) NOT NULL,
  `receipt_id` varchar(20) NOT NULL,
  `items` varchar(255) NOT NULL,
  `buyer_email` varchar(50) NOT NULL,
  `buyer_ip` varchar(20) DEFAULT NULL,
  `note` text NOT NULL,
  `city` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `hash_key` varchar(255) DEFAULT NULL,
  `entry_at` date DEFAULT NULL,
  `entry_by` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `datatable`
--

INSERT INTO `datatable` (`id`, `amount`, `buyer`, `receipt_id`, `items`, `buyer_email`, `buyer_ip`, `note`, `city`, `phone`, `hash_key`, `entry_at`, `entry_by`) VALUES
(1, 520, 'Ariful Islam', 'jllKJDOIU', '[\"first\",\"second\",\"third\"]', 'arif@gmail.com', '::1', 'This is text', 'Dhaka', '808001750840217', '708e05e27449dafc653ae537901ff9200f1ddd4dd89bdd9f9ac10f93c9dd7a84c4c51dc8e840b2846c03796ce7481bd26a3e2775fba4cce5cf170eeb98adebe8', '2021-03-27', 11),
(2, 520, 'Ariful Islam', 'jllKJDOIU', '[\"first\",\"second\",\"third\"]', 'arif@gmail.com', '::1', 'This is text', 'Dhaka', '8080808001750840217', '708e05e27449dafc653ae537901ff9200f1ddd4dd89bdd9f9ac10f93c9dd7a84c4c51dc8e840b2846c03796ce7481bd26a3e2775fba4cce5cf170eeb98adebe8', '2021-03-27', 12),
(3, 520, 'Ariful Islam', 'jllKJDOIU', '[\"first\",\"second\",\"third\"]', 'arif@gmail.com', '::1', 'This is text', 'Dhaka', '8001750840217', '708e05e27449dafc653ae537901ff9200f1ddd4dd89bdd9f9ac10f93c9dd7a84c4c51dc8e840b2846c03796ce7481bd26a3e2775fba4cce5cf170eeb98adebe8', '2021-03-27', 11),
(4, 520, 'Ariful Islam', 'jllKJDOIU', '[\"first\",\"second\",\"third\"]', 'arif@gmail.com', '::1', 'This is text', 'Dhaka', '808001750840217', '708e05e27449dafc653ae537901ff9200f1ddd4dd89bdd9f9ac10f93c9dd7a84c4c51dc8e840b2846c03796ce7481bd26a3e2775fba4cce5cf170eeb98adebe8', '2021-03-27', 12);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
