-- phpMyAdmin SQL Dump
-- version 4.0.10.14
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Dec 09, 2016 at 03:04 PM
-- Server version: 5.6.33
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `weopenco_eaglepro`
--

-- --------------------------------------------------------

--
-- Table structure for table `achieve_table`
--

CREATE TABLE IF NOT EXISTS `achieve_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  `month` varchar(100) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `insert_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `achieve_table`
--

INSERT INTO `achieve_table` (`id`, `company_id`, `post_id`, `month`, `year`, `total`, `status`, `insert_time`) VALUES
(1, NULL, 5, 'December', 2016, 500, NULL, '2016-12-09 19:49:37');

-- --------------------------------------------------------

--
-- Table structure for table `company_table`
--

CREATE TABLE IF NOT EXISTS `company_table` (
  `cmp_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `company_name` varchar(100) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `user_type` varchar(100) DEFAULT NULL,
  `regtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`cmp_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `company_table`
--

INSERT INTO `company_table` (`cmp_id`, `username`, `password`, `company_name`, `phone`, `address`, `user_type`, `regtime`) VALUES
(1, 'inquiry@taxiwala.biz', '202cb962ac59075b964b07152d234b70', 'Taxiwala', '880-9678774466\n', 'House-10(5th floor.)\nRoad-16/A, Gulshan-01\nDhaka-1212,Bangladesh', 'admin', '2016-12-07 00:23:34');

-- --------------------------------------------------------

--
-- Table structure for table `monitor_table`
--

CREATE TABLE IF NOT EXISTS `monitor_table` (
  `at_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `latitude` float DEFAULT NULL,
  `longitude` float DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `last_entry` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`at_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=76 ;

--
-- Dumping data for table `monitor_table`
--

INSERT INTO `monitor_table` (`at_id`, `company_id`, `user_id`, `latitude`, `longitude`, `address`, `last_entry`) VALUES
(1, 1, 3, 23.7506, 90.3859, '152 Bir Uttam Kazi Nuruzzaman Road', '2016-12-07 12:46:44'),
(2, 1, 8, 23.7383, 90.3679, '20 Sher-E-Bangla Road', '2016-12-10 06:25:43'),
(3, 1, 8, 23.7383, 90.3679, '20 Sher-E-Bangla Road', '2016-12-10 06:25:43'),
(4, 1, 8, 23.7383, 90.3679, '20 Sher-E-Bangla Road', '2016-12-10 06:25:43'),
(5, 1, 8, 23.7383, 90.3679, '20 Sher-E-Bangla Road', '2016-12-10 06:25:43'),
(6, 1, 8, 23.7383, 90.3679, '20 Sher-E-Bangla Road', '2016-12-10 06:25:43'),
(7, 1, 8, 23.7383, 90.3679, '20 Sher-E-Bangla Road', '2016-12-10 06:25:43'),
(8, 1, 8, 23.7383, 90.3679, '20 Sher-E-Bangla Road', '2016-12-10 06:25:43'),
(9, 1, 8, 23.7383, 90.3679, '20 Sher-E-Bangla Road', '2016-12-10 06:25:43'),
(10, 1, 8, 23.7383, 90.3679, '20 Sher-E-Bangla Road', '2016-12-10 06:25:43'),
(11, 1, 8, 23.7383, 90.3679, '20 Sher-E-Bangla Road', '2016-12-10 06:25:43'),
(12, 1, 8, 23.7383, 90.3679, '20 Sher-E-Bangla Road', '2016-12-10 06:25:43'),
(13, 1, 8, 23.7383, 90.3679, '20 Sher-E-Bangla Road', '2016-12-10 06:25:43'),
(14, 1, 8, 23.7383, 90.3679, '20 Sher-E-Bangla Road', '2016-12-10 06:25:43'),
(15, 1, 8, 23.7383, 90.3679, '20 Sher-E-Bangla Road', '2016-12-10 06:25:43'),
(16, 1, 8, 23.7383, 90.3679, '20 Sher-E-Bangla Road', '2016-12-10 06:25:43'),
(17, 1, 8, 23.7383, 90.3679, '20 Sher-E-Bangla Road', '2016-12-10 06:25:43'),
(18, 1, 8, 23.7383, 90.3679, '20 Sher-E-Bangla Road', '2016-12-10 06:25:43'),
(19, 1, 8, 23.7383, 90.3679, '20 Sher-E-Bangla Road', '2016-12-10 06:25:43'),
(20, 1, 8, 23.7383, 90.3679, '20 Sher-E-Bangla Road', '2016-12-10 06:25:43'),
(21, 1, 8, 23.7383, 90.3679, '20 Sher-E-Bangla Road', '2016-12-10 06:25:43'),
(22, 1, 8, 23.7383, 90.3679, '20 Sher-E-Bangla Road', '2016-12-10 06:25:43'),
(23, 1, 8, 23.7383, 90.3679, '20 Sher-E-Bangla Road', '2016-12-10 06:25:43'),
(24, 1, 8, 23.7383, 90.3679, '20 Sher-E-Bangla Road', '2016-12-10 06:25:43'),
(25, 1, 8, 23.7383, 90.3679, '20 Sher-E-Bangla Road', '2016-12-10 06:25:43'),
(26, 1, 8, 23.7383, 90.3679, '20 Sher-E-Bangla Road', '2016-12-10 06:25:43'),
(27, 1, 8, 23.7383, 90.3679, '20 Sher-E-Bangla Road', '2016-12-10 06:25:43'),
(28, 1, 8, 23.7383, 90.3679, '20 Sher-E-Bangla Road', '2016-12-10 06:25:43'),
(29, 1, 8, 23.7383, 90.3679, '20 Sher-E-Bangla Road', '2016-12-10 06:25:43'),
(30, 1, 8, 23.7383, 90.3679, '20 Sher-E-Bangla Road', '2016-12-10 06:25:43'),
(31, 1, 8, 23.7383, 90.3679, '20 Sher-E-Bangla Road', '2016-12-10 06:25:43'),
(32, 1, 8, 23.7383, 90.3679, '20 Sher-E-Bangla Road', '2016-12-10 06:25:43'),
(33, 1, 8, 23.7383, 90.3679, '20 Sher-E-Bangla Road', '2016-12-10 06:25:43'),
(34, 1, 8, 23.7383, 90.3679, '20 Sher-E-Bangla Road', '2016-12-10 06:25:43'),
(35, 1, 8, 23.7383, 90.3679, '20 Sher-E-Bangla Road', '2016-12-10 06:25:43'),
(36, 1, 8, 23.7383, 90.3679, '20 Sher-E-Bangla Road', '2016-12-10 06:25:43'),
(37, 1, 8, 23.7383, 90.3679, '20 Sher-E-Bangla Road', '2016-12-10 06:25:43'),
(38, 1, 8, 23.7383, 90.3679, '20 Sher-E-Bangla Road', '2016-12-10 06:25:43'),
(39, 1, 8, 23.7383, 90.3679, '20 Sher-E-Bangla Road', '2016-12-10 06:25:43'),
(40, 1, 8, 23.7383, 90.3679, '20 Sher-E-Bangla Road', '2016-12-10 06:25:43'),
(41, 1, 8, 23.7383, 90.3679, '20 Sher-E-Bangla Road', '2016-12-10 06:25:43'),
(75, 1, 9, 23.7383, 90.3679, '20 Sher-E-Bangla Road', '2016-12-10 06:51:57'),
(74, 1, 9, 23.7383, 90.3679, '20 Sher-E-Bangla Road', '2016-12-10 06:49:39'),
(73, 1, 9, 23.7383, 90.3679, '20 Sher-E-Bangla Road', '2016-12-10 06:49:35'),
(72, 1, 9, 23.7383, 90.3679, '20 Sher-E-Bangla Road', '2016-12-10 06:48:58'),
(71, 1, 9, 23.7383, 90.3679, '20 Sher-E-Bangla Road', '2016-12-10 06:47:47'),
(70, 1, 8, 23.7383, 90.3679, '20 Sher-E-Bangla Road', '2016-12-10 06:45:53'),
(69, 1, 8, 23.7383, 90.3679, '20 Sher-E-Bangla Road', '2016-12-10 06:43:53'),
(68, 1, 8, 23.7383, 90.3679, '20 Sher-E-Bangla Road', '2016-12-10 06:41:53'),
(67, 1, 8, 23.7383, 90.3677, '20 Sher-E-Bangla Road', '2016-12-10 06:41:51'),
(66, 1, 8, 23.7383, 90.3677, '20 Sher-E-Bangla Road', '2016-12-10 06:39:49'),
(65, 1, 8, 23.7383, 90.3679, '20 Sher-E-Bangla Road', '2016-12-10 06:34:15'),
(64, 1, 8, 23.7383, 90.3677, '20 Sher-E-Bangla Road', '2016-12-10 06:33:51'),
(63, 1, 8, 23.7383, 90.3679, '20 Sher-E-Bangla Road', '2016-12-10 06:28:01'),
(62, 1, 8, 23.7383, 90.3679, '20 Sher-E-Bangla Road', '2016-12-10 06:27:40'),
(61, 1, 8, 23.7383, 90.3679, '20 Sher-E-Bangla Road', '2016-12-10 06:26:10'),
(42, 1, 8, 23.7383, 90.3679, '20 Sher-E-Bangla Road', '2016-12-10 06:25:43'),
(43, 1, 8, 23.7383, 90.3679, '20 Sher-E-Bangla Road', '2016-12-10 06:25:43'),
(44, 1, 8, 23.7383, 90.3679, '20 Sher-E-Bangla Road', '2016-12-10 06:25:43'),
(45, 1, 8, 23.7383, 90.3679, '20 Sher-E-Bangla Road', '2016-12-10 06:25:43'),
(46, 1, 8, 23.7383, 90.3679, '20 Sher-E-Bangla Road', '2016-12-10 06:25:43'),
(47, 1, 8, 23.7383, 90.3679, '20 Sher-E-Bangla Road', '2016-12-10 06:25:43'),
(48, 1, 8, 23.7383, 90.3679, '20 Sher-E-Bangla Road', '2016-12-10 06:25:43'),
(49, 1, 8, 23.7383, 90.3679, '20 Sher-E-Bangla Road', '2016-12-10 06:25:43'),
(50, 1, 8, 23.7383, 90.3679, '20 Sher-E-Bangla Road', '2016-12-10 06:25:43'),
(51, 1, 8, 23.7383, 90.3679, '20 Sher-E-Bangla Road', '2016-12-10 06:25:43'),
(52, 1, 8, 23.7383, 90.3679, '20 Sher-E-Bangla Road', '2016-12-10 06:25:43'),
(53, 1, 8, 23.7383, 90.3679, '20 Sher-E-Bangla Road', '2016-12-10 06:25:43'),
(54, 1, 8, 23.7383, 90.3679, '20 Sher-E-Bangla Road', '2016-12-10 06:25:43'),
(55, 1, 8, 23.7383, 90.3679, '20 Sher-E-Bangla Road', '2016-12-10 06:25:43'),
(56, 1, 8, 23.7383, 90.3679, '20 Sher-E-Bangla Road', '2016-12-10 06:25:43'),
(57, 1, 8, 23.7383, 90.3679, '20 Sher-E-Bangla Road', '2016-12-10 06:25:43'),
(58, 1, 8, 23.7383, 90.3679, '20 Sher-E-Bangla Road', '2016-12-10 06:25:43'),
(59, 1, 8, 23.7383, 90.3679, '20 Sher-E-Bangla Road', '2016-12-10 06:25:43'),
(60, 1, 8, 23.7383, 90.3679, '20 Sher-E-Bangla Road', '2016-12-10 06:25:43');

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE IF NOT EXISTS `notice` (
  `nt_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `detail_msg` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `insert_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`nt_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`nt_id`, `company_id`, `subject`, `detail_msg`, `status`, `insert_time`) VALUES
(1, 1, 'Notice Headline', 'Unfortunately, sometimes itâ€™s just not possible to provide the standard two weeks notice. Your employer will appreciate as much notice as you are able to give, so do let him or her know as soon as you are sure you will be leaving.', 1, '2016-12-07 13:12:12');

-- --------------------------------------------------------

--
-- Table structure for table `order_table`
--

CREATE TABLE IF NOT EXISTS `order_table` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) DEFAULT NULL,
  `salesman_id` int(11) DEFAULT NULL,
  `salesman_id_extra` int(11) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `nid` varchar(100) DEFAULT NULL,
  `pickup_date` varchar(255) DEFAULT NULL,
  `pickup_location` varchar(255) DEFAULT NULL,
  `service_type` varchar(255) DEFAULT NULL,
  `service_name` varchar(255) DEFAULT NULL,
  `drop_off_date` varchar(255) DEFAULT NULL,
  `drop_off_location` varchar(255) DEFAULT NULL,
  `vehicle_type` varchar(255) DEFAULT NULL,
  `service_price` varchar(100) DEFAULT NULL,
  `month` varchar(20) DEFAULT NULL,
  `year` varchar(20) DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `order_placed_at` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `regtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `order_table`
--

INSERT INTO `order_table` (`order_id`, `company_id`, `salesman_id`, `salesman_id_extra`, `customer_name`, `phone`, `address`, `nid`, `pickup_date`, `pickup_location`, `service_type`, `service_name`, `drop_off_date`, `drop_off_location`, `vehicle_type`, `service_price`, `month`, `year`, `latitude`, `longitude`, `order_placed_at`, `status`, `regtime`) VALUES
(1, 1, 5, 8, 'Test Customer', '123', 'Mirpur Dhaka', '123654789', '10/12/2016', 'Rampura', ' 1', 'Test Service (Dhaka City) ', '22/12/2016', 'Mirpur -1', NULL, '500', 'December', '2016', '23.7505782', '90.3859083', '152 Bir Uttam Kazi Nuruzzaman Road', 1, '2016-12-09 19:47:43'),
(2, 1, 5, 8, 'Test2', '123', 'Dhaka', '123654', '10/12/2016', 'Dhaka2', ' 2', 'Holiday Package (Dhaka City) ', '31/12/2016', 'Dhaka4', NULL, '3698', 'December', '2016', '23.7383498', '90.3678843', '20 Sher-E-Bangla Road', 0, '2016-12-09 19:47:46');

-- --------------------------------------------------------

--
-- Table structure for table `post_table`
--

CREATE TABLE IF NOT EXISTS `post_table` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) DEFAULT NULL,
  `post_title` varchar(255) DEFAULT NULL,
  `boss_id` varchar(100) DEFAULT NULL,
  `area` varchar(100) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `year` varchar(20) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `regtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `post_table`
--

INSERT INTO `post_table` (`post_id`, `company_id`, `post_title`, `boss_id`, `area`, `user_id`, `year`, `status`, `regtime`) VALUES
(1, NULL, 'head', '0', 'Area 1', 2, '2016', 1, '2016-12-07 01:48:15'),
(3, NULL, 'manager', '1', '', 6, '2016', 1, '2016-12-07 01:49:07'),
(4, NULL, 'supervisor', '3', '', 7, '2016', 1, '2016-12-07 01:49:22'),
(5, NULL, 'sales_officer', '4', '', 8, '2016', 1, '2016-12-07 01:49:36'),
(6, NULL, 'sales_officer', '4', '', 9, '2016', 1, '2016-12-09 19:46:20');

-- --------------------------------------------------------

--
-- Table structure for table `service_table`
--

CREATE TABLE IF NOT EXISTS `service_table` (
  `service_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) DEFAULT NULL,
  `service_name` varchar(255) DEFAULT NULL,
  `service_price` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `regtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`service_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `service_table`
--

INSERT INTO `service_table` (`service_id`, `company_id`, `service_name`, `service_price`, `status`, `regtime`) VALUES
(1, NULL, 'Test Service (Dhaka City)', 500, 1, '2016-12-07 01:50:26'),
(2, NULL, 'Holiday Package (Dhaka City)', 1200, 1, '2016-12-07 01:50:49');

-- --------------------------------------------------------

--
-- Table structure for table `target_table`
--

CREATE TABLE IF NOT EXISTS `target_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  `month` varchar(100) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `year` varchar(20) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `insert_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `target_table`
--

INSERT INTO `target_table` (`id`, `company_id`, `post_id`, `month`, `amount`, `year`, `status`, `insert_time`) VALUES
(1, NULL, 3, 'December', 50000, '2016', NULL, '2016-12-07 01:50:02'),
(2, NULL, 4, 'December', 60000, '2016', NULL, '2016-12-07 01:51:22'),
(3, NULL, 5, 'December', 70000, '2016', NULL, '2016-12-07 01:51:57');

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE IF NOT EXISTS `user_table` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `designation` varchar(100) DEFAULT NULL,
  `cmp_id` int(11) DEFAULT NULL,
  `dateofbirth` date DEFAULT NULL,
  `imageref` varchar(255) DEFAULT NULL,
  `blood_group` varchar(100) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `user_type` varchar(100) DEFAULT NULL,
  `assigned_status` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `regtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`user_id`, `username`, `password`, `full_name`, `designation`, `cmp_id`, `dateofbirth`, `imageref`, `blood_group`, `phone`, `user_type`, `assigned_status`, `status`, `regtime`) VALUES
(2, 'taufiqur', '202cb962ac59075b964b07152d234b70', 'Taufiqur Rahman', 'head', 1, '1970-12-30', 'salesman_pic/taufiqur.jpg', 'B+', '01738260476', 'head', 1, 0, '2016-12-07 01:48:15'),
(8, 'test', '202cb962ac59075b964b07152d234b70', 'test', 'sales_officer', 1, '1979-12-23', 'salesman_pic/test.png', 'O+', '987564', 'sales_officer', 1, 0, '2016-12-07 01:49:36'),
(7, 'test_supervisor', '202cb962ac59075b964b07152d234b70', 'test_supervisor', 'supervisor', 1, '1980-12-23', 'salesman_pic/test_supervisor.png', 'B+', '7895462', 'supervisor', 1, 0, '2016-12-07 01:49:22'),
(6, 'test_manager', '202cb962ac59075b964b07152d234b70', 'Test Manager', 'manager', 1, '2016-12-31', 'salesman_pic/test_manager.png', 'A-', '321456', 'manager', 1, 0, '2016-12-07 01:49:07'),
(9, 'bappy', '202cb962ac59075b964b07152d234b70', 'Bappy', 'sales_officer', 1, '2016-12-31', 'salesman_pic/bappy.', 'AB+', '123', 'sales_officer', 1, 0, '2016-12-09 19:46:20');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
