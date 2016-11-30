-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2016 at 12:38 AM
-- Server version: 5.7.9
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `db_online_reporting_dc_v2`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_client_sector_category`
--

DROP TABLE IF EXISTS `tbl_client_sector_category`;
CREATE TABLE IF NOT EXISTS `tbl_client_sector_category` (
  `tbl_client_sector_categoryId` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` text NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `display` set('Yes','No') NOT NULL DEFAULT 'Yes',
  PRIMARY KEY (`tbl_client_sector_categoryId`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_client_sector_category`
--

INSERT INTO `tbl_client_sector_category` (`tbl_client_sector_categoryId`, `full_name`, `date_created`, `display`) VALUES
(1, 'Government', '2016-03-23 08:50:15', 'Yes'),
(2, 'Commerce', '2016-03-23 08:50:15', 'Yes'),
(3, 'Education', '2016-03-23 08:50:15', 'Yes'),
(4, 'Agriculture', '2016-03-23 08:50:15', 'Yes'),
(5, 'Health', '2016-03-23 08:50:15', 'Yes'),
(6, 'Not Classified', '2016-03-23 08:50:15', 'Yes');
