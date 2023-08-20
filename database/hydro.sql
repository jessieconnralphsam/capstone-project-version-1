-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2023 at 04:18 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hydro`
--

-- --------------------------------------------------------

--
-- Table structure for table `acidity`
--

CREATE TABLE `acidity` (
  `acid_id` int(11) NOT NULL,
  `sensor_name` varchar(12) NOT NULL DEFAULT 'Acidity',
  `acid_cdate` datetime NOT NULL DEFAULT current_timestamp(),
  `acid_readings` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `acidity`
--

INSERT INTO `acidity` (`acid_id`, `sensor_name`, `acid_cdate`, `acid_readings`, `status`) VALUES
(29, 'Acidity', '2023-08-19 15:37:48', 4, 0),
(30, 'Acidity', '2023-08-19 15:37:58', 7, 0),
(31, 'Acidity', '2023-08-19 15:38:37', 4, 0),
(32, 'Acidity', '2023-08-19 15:38:50', 6, 0),
(33, 'Acidity', '2023-08-19 15:39:01', 4, 0),
(34, 'Acidity', '2023-08-19 15:42:12', 7, 0),
(35, 'Acidity', '2023-08-19 15:44:01', 9, 0),
(36, 'Acidity', '2023-08-19 15:50:10', 10, 0),
(37, 'Acidity', '2023-08-19 16:22:29', 2, 0),
(38, 'Acidity', '2023-08-19 16:24:32', 0, 0),
(39, 'Acidity', '2023-08-19 16:34:06', 7, 0),
(40, 'Acidity', '2023-08-19 16:35:27', 10, 0),
(41, 'Acidity', '2023-08-19 17:01:44', 7, 0),
(42, 'Acidity', '2023-08-19 17:24:36', 7, 0),
(43, 'Acidity', '2023-08-19 17:26:32', 7, 0),
(44, 'Acidity', '2023-08-19 17:27:54', 7, 0),
(45, 'Acidity', '2023-08-20 08:10:49', 9, 0),
(46, 'Acidity', '2023-08-20 08:11:48', 10, 0),
(47, 'Acidity', '2023-08-20 08:15:04', 10, 0),
(48, 'Acidity', '2023-08-20 08:26:57', 10, 0),
(49, 'Acidity', '2023-08-20 08:27:07', 10, 0),
(50, 'Acidity', '2023-08-20 08:27:37', 10, 0),
(51, 'Acidity', '2023-08-20 08:56:08', 7, 0),
(52, 'Acidity', '2023-08-20 08:56:34', 10, 0),
(53, 'Acidity', '2023-08-20 09:08:26', 10, 0),
(54, 'Acidity', '2023-08-20 09:08:55', 7, 0),
(55, 'Acidity', '2023-08-20 09:09:09', 7, 0);

--
-- Triggers `acidity`
--
DELIMITER $$
CREATE TRIGGER `insert_into_acidity_notif_table` AFTER INSERT ON `acidity` FOR EACH ROW BEGIN
  IF NEW.acid_readings > 7 THEN
    INSERT INTO notifications (notif_sname, cdate, readings, status) 
    VALUES (NEW.sensor_name, NEW.acid_cdate, NEW.acid_readings, NEW.status);
  END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insertdata_acid` AFTER INSERT ON `acidity` FOR EACH ROW BEGIN
  IF NEW.acid_readings < 7 THEN
    INSERT INTO notifications (notif_sname, cdate, readings, status) 
    VALUES (NEW.sensor_name, NEW.acid_cdate, NEW.acid_readings, NEW.status);
  END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `notif_sname` varchar(12) NOT NULL,
  `cdate` datetime NOT NULL,
  `readings` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `notif_sname`, `cdate`, `readings`, `status`) VALUES
(48, 'waterlevel', '2023-08-19 15:37:48', 3, 1),
(49, 'Acidity', '2023-08-19 15:37:48', 4, 1),
(50, 'Conductivity', '2023-08-19 15:37:48', 5, 1),
(51, 'waterlevel', '2023-08-19 15:37:58', 5, 1),
(52, 'Conductivity', '2023-08-19 15:37:58', 9, 1),
(53, 'Acidity', '2023-08-19 15:38:37', 4, 1),
(54, 'Conductivity', '2023-08-19 15:38:38', 6, 1),
(55, 'Temperature', '2023-08-19 15:38:38', 78, 1),
(56, 'Acidity', '2023-08-19 15:38:50', 6, 1),
(57, 'Conductivity', '2023-08-19 15:38:50', 8, 1),
(58, 'Temperature', '2023-08-19 15:38:50', 90, 1),
(59, 'Acidity', '2023-08-19 15:39:01', 4, 1),
(60, 'Conductivity', '2023-08-19 15:39:01', 5, 1),
(61, 'Temperature', '2023-08-19 15:39:01', 67, 1),
(62, 'waterlevel', '2023-08-19 15:42:12', 6, 1),
(63, 'Conductivity', '2023-08-19 15:42:12', 8, 1),
(64, 'waterflow', '2023-08-19 15:44:01', 0, 1),
(65, 'waterlevel', '2023-08-19 15:44:01', 0, 1),
(66, 'Acidity', '2023-08-19 15:44:01', 9, 1),
(67, 'Conductivity', '2023-08-19 15:44:01', 1000, 1),
(68, 'Temperature', '2023-08-19 15:44:01', 78, 1),
(69, 'waterflow', '2023-08-19 15:50:10', 0, 1),
(70, 'waterlevel', '2023-08-19 15:50:10', 9, 1),
(71, 'Acidity', '2023-08-19 15:50:10', 10, 1),
(72, 'Conductivity', '2023-08-19 15:50:10', 950, 1),
(73, 'Temperature', '2023-08-19 15:50:11', 30, 1),
(74, 'waterlevel', '2023-08-19 16:22:28', 2, 1),
(75, 'Acidity', '2023-08-19 16:22:29', 2, 1),
(76, 'Conductivity', '2023-08-19 16:22:29', 2, 1),
(77, 'waterflow', '2023-08-19 16:24:32', 0, 1),
(78, 'waterlevel', '2023-08-19 16:24:32', 0, 1),
(79, 'Acidity', '2023-08-19 16:24:32', 0, 1),
(80, 'Conductivity', '2023-08-19 16:24:32', 0, 1),
(81, 'waterlevel', '2023-08-19 16:34:06', 10, 1),
(82, 'Conductivity', '2023-08-19 16:34:06', 0, 1),
(83, 'waterlevel', '2023-08-19 16:35:26', 7, 1),
(84, 'Acidity', '2023-08-19 16:35:27', 10, 1),
(85, 'Temperature', '2023-08-19 16:35:27', 89, 1),
(86, 'waterflow', '2023-08-19 17:24:35', 0, 1),
(87, 'Conductivity', '2023-08-19 17:26:32', 1000, 1),
(88, 'waterlevel', '2023-08-19 17:27:54', 0, 1),
(89, 'Conductivity', '2023-08-19 17:27:54', 1000, 1),
(90, 'Acidity', '2023-08-20 08:10:49', 9, 1),
(91, 'Conductivity', '2023-08-20 08:10:49', 1000, 1),
(92, 'waterlevel', '2023-08-20 08:11:48', 0, 1),
(93, 'Acidity', '2023-08-20 08:11:48', 10, 1),
(94, 'Conductivity', '2023-08-20 08:11:48', 1000, 1),
(95, 'Acidity', '2023-08-20 08:15:04', 10, 1),
(96, 'Conductivity', '2023-08-20 08:15:04', 1000, 1),
(97, 'Acidity', '2023-08-20 08:26:57', 10, 1),
(98, 'Conductivity', '2023-08-20 08:26:57', 1000, 1),
(99, 'Acidity', '2023-08-20 08:27:07', 10, 1),
(100, 'Conductivity', '2023-08-20 08:27:07', 1000, 1),
(101, 'waterlevel', '2023-08-20 08:27:37', 0, 1),
(102, 'Acidity', '2023-08-20 08:27:37', 10, 1),
(103, 'Conductivity', '2023-08-20 08:27:37', 1000, 1),
(104, 'waterlevel', '2023-08-20 08:56:08', 0, 1),
(105, 'Conductivity', '2023-08-20 08:56:08', 1000, 1),
(106, 'waterlevel', '2023-08-20 08:56:34', 0, 1),
(107, 'Acidity', '2023-08-20 08:56:34', 10, 1),
(108, 'Conductivity', '2023-08-20 08:56:34', 800, 1),
(109, 'waterlevel', '2023-08-20 09:08:26', 0, 1),
(110, 'Acidity', '2023-08-20 09:08:26', 10, 1),
(111, 'Conductivity', '2023-08-20 09:08:26', 1000, 1),
(112, 'Conductivity', '2023-08-20 09:08:55', 800, 1),
(113, 'waterlevel', '2023-08-20 09:09:09', 0, 1),
(114, 'Conductivity', '2023-08-20 09:09:10', 1000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `temperature`
--

CREATE TABLE `temperature` (
  `temp_id` int(11) NOT NULL,
  `sensor_name` varchar(12) NOT NULL DEFAULT 'Temperature',
  `temp_cdate` datetime NOT NULL DEFAULT current_timestamp(),
  `temp_readings` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `temperature`
--

INSERT INTO `temperature` (`temp_id`, `sensor_name`, `temp_cdate`, `temp_readings`, `status`) VALUES
(22, 'Temperature', '2023-08-19 15:37:48', 6, 0),
(23, 'Temperature', '2023-08-19 15:37:58', 12, 0),
(24, 'Temperature', '2023-08-19 15:38:38', 78, 0),
(25, 'Temperature', '2023-08-19 15:38:50', 90, 0),
(26, 'Temperature', '2023-08-19 15:39:01', 67, 0),
(27, 'Temperature', '2023-08-19 15:42:12', 9, 0),
(28, 'Temperature', '2023-08-19 15:44:01', 78, 0),
(29, 'Temperature', '2023-08-19 15:50:11', 30, 0),
(30, 'Temperature', '2023-08-19 16:22:29', 2, 0),
(31, 'Temperature', '2023-08-19 16:24:32', 6, 0),
(32, 'Temperature', '2023-08-19 16:34:06', 0, 0),
(33, 'Temperature', '2023-08-19 16:35:27', 89, 0),
(34, 'Temperature', '2023-08-19 17:01:44', 25, 0),
(35, 'Temperature', '2023-08-19 17:24:36', 24, 0),
(36, 'Temperature', '2023-08-19 17:26:32', 25, 0),
(37, 'Temperature', '2023-08-19 17:27:55', 25, 0),
(38, 'Temperature', '2023-08-20 08:10:50', 25, 0),
(39, 'Temperature', '2023-08-20 08:11:48', 25, 0),
(40, 'Temperature', '2023-08-20 08:15:04', 25, 0),
(41, 'Temperature', '2023-08-20 08:26:57', 25, 0),
(42, 'Temperature', '2023-08-20 08:27:08', 25, 0),
(43, 'Temperature', '2023-08-20 08:27:37', 20, 0),
(44, 'Temperature', '2023-08-20 08:56:08', 25, 0),
(45, 'Temperature', '2023-08-20 08:56:34', 25, 0),
(46, 'Temperature', '2023-08-20 09:08:26', 25, 0),
(47, 'Temperature', '2023-08-20 09:08:55', 2, 0),
(48, 'Temperature', '2023-08-20 09:09:10', 2, 0);

--
-- Triggers `temperature`
--
DELIMITER $$
CREATE TRIGGER `insert_temp_into_notif_table` AFTER INSERT ON `temperature` FOR EACH ROW BEGIN
  IF NEW.temp_readings > 25 THEN
    INSERT INTO notifications (notif_sname, cdate, readings, status) 
    VALUES (NEW.sensor_name, NEW.temp_cdate, NEW.temp_readings, NEW.status);
  END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `total_dissolved_solids`
--

CREATE TABLE `total_dissolved_solids` (
  `tds_id` int(11) NOT NULL,
  `sensor_name` varchar(12) NOT NULL DEFAULT 'Conductivity',
  `tds_cdate` datetime NOT NULL DEFAULT current_timestamp(),
  `tds_readings` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `total_dissolved_solids`
--

INSERT INTO `total_dissolved_solids` (`tds_id`, `sensor_name`, `tds_cdate`, `tds_readings`, `status`) VALUES
(7, 'Conductivity', '2023-08-19 15:37:48', 5, 1),
(8, 'Conductivity', '2023-08-19 15:37:58', 9, 1),
(9, 'Conductivity', '2023-08-19 15:38:38', 6, 1),
(10, 'Conductivity', '2023-08-19 15:38:50', 8, 1),
(11, 'Conductivity', '2023-08-19 15:39:01', 5, 1),
(12, 'Conductivity', '2023-08-19 15:42:12', 8, 1),
(13, 'Conductivity', '2023-08-19 15:44:01', 1000, 1),
(14, 'Conductivity', '2023-08-19 15:50:10', 950, 0),
(15, 'Conductivity', '2023-08-19 16:22:29', 2, 0),
(16, 'Conductivity', '2023-08-19 16:24:32', 0, 0),
(17, 'Conductivity', '2023-08-19 16:34:06', 0, 0),
(18, 'Conductivity', '2023-08-19 16:35:27', 400, 0),
(19, 'Conductivity', '2023-08-19 17:01:44', 450, 0),
(20, 'Conductivity', '2023-08-19 17:24:36', 500, 0),
(21, 'Conductivity', '2023-08-19 17:26:32', 1000, 0),
(22, 'Conductivity', '2023-08-19 17:27:54', 1000, 0),
(23, 'Conductivity', '2023-08-20 08:10:49', 1000, 0),
(24, 'Conductivity', '2023-08-20 08:11:48', 1000, 0),
(25, 'Conductivity', '2023-08-20 08:15:04', 1000, 0),
(26, 'Conductivity', '2023-08-20 08:26:57', 1000, 0),
(27, 'Conductivity', '2023-08-20 08:27:07', 1000, 0),
(28, 'Conductivity', '2023-08-20 08:27:37', 1000, 0),
(29, 'Conductivity', '2023-08-20 08:56:08', 1000, 0),
(30, 'Conductivity', '2023-08-20 08:56:34', 800, 0),
(31, 'Conductivity', '2023-08-20 09:08:26', 1000, 0),
(32, 'Conductivity', '2023-08-20 09:08:55', 800, 0),
(33, 'Conductivity', '2023-08-20 09:09:10', 1000, 0);

--
-- Triggers `total_dissolved_solids`
--
DELIMITER $$
CREATE TRIGGER `insert_into_tds` AFTER INSERT ON `total_dissolved_solids` FOR EACH ROW BEGIN
  IF NEW.tds_readings < 300 THEN
    INSERT INTO notifications (notif_sname, cdate, readings, status) 
    VALUES (NEW.sensor_name, NEW.tds_cdate, NEW.tds_readings, NEW.status);
  END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insert_into_tds_notif_table` AFTER INSERT ON `total_dissolved_solids` FOR EACH ROW BEGIN
  IF NEW.tds_readings > 500 THEN
    INSERT INTO notifications (notif_sname, cdate, readings, status) 
    VALUES (NEW.sensor_name, NEW.tds_cdate, NEW.tds_readings, NEW.status);
  END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`) VALUES
(1, 'Jessie Conn Ralph M. Sam', 'jessiesam@gmail.com', '$2y$10$Nqq/y251QX2Ccvb1Ax7hUuMqQSkG3yRLCxN2KPdetnSP3oaXVH70a');

-- --------------------------------------------------------

--
-- Table structure for table `waterflow`
--

CREATE TABLE `waterflow` (
  `flow_id` int(11) NOT NULL,
  `sensor_name` varchar(12) NOT NULL DEFAULT 'waterflow',
  `flow_cdate` datetime NOT NULL DEFAULT current_timestamp(),
  `flow_readings` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `waterflow`
--

INSERT INTO `waterflow` (`flow_id`, `sensor_name`, `flow_cdate`, `flow_readings`, `status`) VALUES
(11, 'waterflow', '2023-08-19 15:37:47', 2, 1),
(12, 'waterflow', '2023-08-19 15:37:58', 4, 1),
(13, 'waterflow', '2023-08-19 15:38:37', 10, 1),
(14, 'waterflow', '2023-08-19 15:38:50', 23, 1),
(15, 'waterflow', '2023-08-19 15:39:01', 2, 1),
(16, 'waterflow', '2023-08-19 15:42:12', 5, 1),
(17, 'waterflow', '2023-08-19 15:44:01', 0, 1),
(18, 'waterflow', '2023-08-19 15:50:10', 0, 0),
(19, 'waterflow', '2023-08-19 16:22:28', 2, 0),
(20, 'waterflow', '2023-08-19 16:24:32', 0, 0),
(21, 'waterflow', '2023-08-19 16:34:06', 7, 0),
(22, 'waterflow', '2023-08-19 16:35:26', 4, 0),
(23, 'waterflow', '2023-08-19 17:01:44', 4, 0),
(24, 'waterflow', '2023-08-19 17:24:35', 0, 0),
(25, 'waterflow', '2023-08-19 17:26:32', 14, 0),
(26, 'waterflow', '2023-08-19 17:27:54', 7, 0),
(27, 'waterflow', '2023-08-20 08:10:49', 4, 0),
(28, 'waterflow', '2023-08-20 08:11:48', 4, 0),
(29, 'waterflow', '2023-08-20 08:15:04', 2, 0),
(30, 'waterflow', '2023-08-20 08:26:57', 2, 0),
(31, 'waterflow', '2023-08-20 08:27:07', 4, 0),
(32, 'waterflow', '2023-08-20 08:27:36', 4, 0),
(33, 'waterflow', '2023-08-20 08:56:08', 4, 0),
(34, 'waterflow', '2023-08-20 08:56:34', 4, 0),
(35, 'waterflow', '2023-08-20 09:08:26', 4, 0),
(36, 'waterflow', '2023-08-20 09:08:55', 2, 0),
(37, 'waterflow', '2023-08-20 09:09:09', 4, 0);

--
-- Triggers `waterflow`
--
DELIMITER $$
CREATE TRIGGER `insert_into_waterflow_notif_table` AFTER INSERT ON `waterflow` FOR EACH ROW BEGIN
  IF NEW.flow_readings <= 1 THEN
    INSERT INTO notifications (notif_sname, cdate, readings, status) 
    VALUES (NEW.sensor_name, NEW.flow_cdate, NEW.flow_readings, NEW.status);
  END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `waterlevel`
--

CREATE TABLE `waterlevel` (
  `level_id` int(11) NOT NULL,
  `sensor_name` varchar(12) NOT NULL DEFAULT 'waterlevel',
  `level_cdate` datetime NOT NULL DEFAULT current_timestamp(),
  `level_readings` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `waterlevel`
--

INSERT INTO `waterlevel` (`level_id`, `sensor_name`, `level_cdate`, `level_readings`, `status`) VALUES
(11, 'waterlevel', '2023-08-19 15:37:48', 3, 1),
(12, 'waterlevel', '2023-08-19 15:37:58', 5, 1),
(13, 'waterlevel', '2023-08-19 15:38:37', 13, 1),
(14, 'waterlevel', '2023-08-19 15:38:50', 34, 1),
(15, 'waterlevel', '2023-08-19 15:39:01', 12, 1),
(16, 'waterlevel', '2023-08-19 15:42:12', 6, 1),
(17, 'waterlevel', '2023-08-19 15:44:01', 0, 1),
(18, 'waterlevel', '2023-08-19 15:50:10', 9, 0),
(19, 'waterlevel', '2023-08-19 16:22:28', 2, 0),
(20, 'waterlevel', '2023-08-19 16:24:32', 0, 0),
(21, 'waterlevel', '2023-08-19 16:34:06', 10, 0),
(22, 'waterlevel', '2023-08-19 16:35:26', 7, 0),
(23, 'waterlevel', '2023-08-19 17:01:44', 30, 0),
(24, 'waterlevel', '2023-08-19 17:24:35', 15, 0),
(25, 'waterlevel', '2023-08-19 17:26:32', 13, 0),
(26, 'waterlevel', '2023-08-19 17:27:54', 0, 0),
(27, 'waterlevel', '2023-08-20 08:10:49', 12, 0),
(28, 'waterlevel', '2023-08-20 08:11:48', 0, 0),
(29, 'waterlevel', '2023-08-20 08:15:04', 12, 0),
(30, 'waterlevel', '2023-08-20 08:26:57', 12, 0),
(31, 'waterlevel', '2023-08-20 08:27:07', 12, 0),
(32, 'waterlevel', '2023-08-20 08:27:37', 0, 0),
(33, 'waterlevel', '2023-08-20 08:56:08', 0, 0),
(34, 'waterlevel', '2023-08-20 08:56:34', 0, 0),
(35, 'waterlevel', '2023-08-20 09:08:26', 0, 0),
(36, 'waterlevel', '2023-08-20 09:08:55', 12, 0),
(37, 'waterlevel', '2023-08-20 09:09:09', 0, 0);

--
-- Triggers `waterlevel`
--
DELIMITER $$
CREATE TRIGGER `insert_into_level_notif_table` AFTER INSERT ON `waterlevel` FOR EACH ROW BEGIN
  IF NEW.level_readings <= 10 THEN
    INSERT INTO notifications (notif_sname, cdate, readings, status) 
    VALUES (NEW.sensor_name, NEW.level_cdate, NEW.level_readings, NEW.status);
  END IF;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acidity`
--
ALTER TABLE `acidity`
  ADD PRIMARY KEY (`acid_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temperature`
--
ALTER TABLE `temperature`
  ADD PRIMARY KEY (`temp_id`);

--
-- Indexes for table `total_dissolved_solids`
--
ALTER TABLE `total_dissolved_solids`
  ADD PRIMARY KEY (`tds_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `waterflow`
--
ALTER TABLE `waterflow`
  ADD PRIMARY KEY (`flow_id`);

--
-- Indexes for table `waterlevel`
--
ALTER TABLE `waterlevel`
  ADD PRIMARY KEY (`level_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acidity`
--
ALTER TABLE `acidity`
  MODIFY `acid_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `temperature`
--
ALTER TABLE `temperature`
  MODIFY `temp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `total_dissolved_solids`
--
ALTER TABLE `total_dissolved_solids`
  MODIFY `tds_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `waterflow`
--
ALTER TABLE `waterflow`
  MODIFY `flow_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `waterlevel`
--
ALTER TABLE `waterlevel`
  MODIFY `level_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
