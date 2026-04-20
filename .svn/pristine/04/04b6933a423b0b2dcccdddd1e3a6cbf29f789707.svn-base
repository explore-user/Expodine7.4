-- phpMyAdmin SQL Dump
-- version 4.0.10.20
-- https://www.phpmyadmin.net
--
-- Host: db-edreport.c4vthhpseomg.us-east-2.rds.amazonaws.com:3306
-- Generation Time: Nov 08, 2022 at 05:03 AM
-- Server version: 5.7.38-log
-- PHP Version: 7.0.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `urban_piper_main`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_data`
--

CREATE TABLE IF NOT EXISTS `tbl_user_data` (
  `tu_id` int(11) NOT NULL AUTO_INCREMENT,
  `tu_user` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tu_code` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tu_database` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tu_store_id` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tu_status` char(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`tu_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_user_data`
--

INSERT INTO `tbl_user_data` (`tu_id`, `tu_user`, `tu_code`, `tu_database`, `tu_store_id`, `tu_status`) VALUES
(1, 'test', 'test', 'urban_test', 'exp_t', 'Y'),
(2, 'hotbox@expodine.com', 'hotbox@123', 'urban_hotbox', 'hotbox1', 'Y'),
(3, 'shap@expodine.com1', 'shap@1231', 'urban_shap1', 'shap11', 'N'),
(4, 'koco@expodine.com', 'koco@123', 'urban_koco', 'koco1', 'Y'),
(5, 'beirut@expodine.com', 'beirut@123', 'urban_beirut', 'beirut1', 'Y');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
