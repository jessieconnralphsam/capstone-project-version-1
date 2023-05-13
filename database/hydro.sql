-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2023 at 03:54 AM
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
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `acidity`
--

INSERT INTO `acidity` (`acid_id`, `sensor_name`, `acid_cdate`, `acid_readings`, `status`) VALUES
(1, 'Acidity', '2023-03-15 07:42:51', 5, 1),
(2, 'Acidity', '2023-03-15 08:11:47', 9, 1),
(3, 'Acidity', '2023-03-15 08:14:23', 2, 1),
(4, 'Acidity', '2023-03-15 08:14:41', 12, 1),
(5, 'Acidity', '2023-03-15 08:18:16', 10, 1),
(6, 'Acidity', '2023-03-15 08:19:30', 8, 1),
(7, 'Acidity', '2023-03-15 08:20:28', 8, 1),
(8, 'Acidity', '2023-03-15 08:24:48', 12, 1),
(9, 'Acidity', '2023-03-15 08:25:28', 9, 1),
(10, 'Acidity', '2023-03-15 08:33:34', 6, 1),
(11, 'Acidity', '2023-03-15 08:33:48', 5, 1);

--
-- Triggers `acidity`
--
DELIMITER $$
CREATE TRIGGER `insert_into_acidity_notif_table` AFTER INSERT ON `acidity` FOR EACH ROW BEGIN
  IF NEW.acid_readings > 6 THEN
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
(7, 'Acidity', '2023-03-15 08:25:28', 9, 1),
(8, 'Temperature', '2023-03-30 09:30:54', 30, 1),
(9, 'Conductivity', '2023-03-30 09:33:46', 1000, 1),
(10, 'waterflow', '2023-03-30 09:39:18', 0, 1),
(11, 'waterlevel', '2023-03-30 09:41:34', 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `temperature`
--

CREATE TABLE `temperature` (
  `temp_id` int(11) NOT NULL,
  `sensor_name` varchar(12) NOT NULL DEFAULT 'Temperature',
  `temp_cdate` datetime NOT NULL DEFAULT current_timestamp(),
  `temp_readings` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `temperature`
--

INSERT INTO `temperature` (`temp_id`, `sensor_name`, `temp_cdate`, `temp_readings`, `status`) VALUES
(1, 'Temperature', '2023-03-30 09:30:54', 30, 1);

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
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `total_dissolved_solids`
--

INSERT INTO `total_dissolved_solids` (`tds_id`, `sensor_name`, `tds_cdate`, `tds_readings`, `status`) VALUES
(1, 'Conductivity', '2023-03-30 09:06:30', 500, 1),
(2, 'Conductivity', '2023-03-30 09:33:46', 1000, 1);

--
-- Triggers `total_dissolved_solids`
--
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
-- Table structure for table `waterflow`
--

CREATE TABLE `waterflow` (
  `flow_id` int(11) NOT NULL,
  `sensor_name` varchar(12) NOT NULL DEFAULT 'waterflow',
  `flow_cdate` datetime NOT NULL DEFAULT current_timestamp(),
  `flow_readings` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `waterflow`
--

INSERT INTO `waterflow` (`flow_id`, `sensor_name`, `flow_cdate`, `flow_readings`, `status`) VALUES
(1, 'waterflow', '2023-03-30 09:39:18', 0, 1);

--
-- Triggers `waterflow`
--
DELIMITER $$
CREATE TRIGGER `insert_into_waterflow_notif_table` AFTER INSERT ON `waterflow` FOR EACH ROW BEGIN
  IF NEW.flow_readings = 0 THEN
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
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `waterlevel`
--

INSERT INTO `waterlevel` (`level_id`, `sensor_name`, `level_cdate`, `level_readings`, `status`) VALUES
(1, 'waterlevel', '2023-03-30 09:41:34', 10, 1);

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
  MODIFY `acid_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `temperature`
--
ALTER TABLE `temperature`
  MODIFY `temp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `total_dissolved_solids`
--
ALTER TABLE `total_dissolved_solids`
  MODIFY `tds_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `waterflow`
--
ALTER TABLE `waterflow`
  MODIFY `flow_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `waterlevel`
--
ALTER TABLE `waterlevel`
  MODIFY `level_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
