-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2023 at 03:23 AM
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
-- Database: `hydroponicsnft_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `acidity`
--

CREATE TABLE `acidity` (
  `id` int(11) NOT NULL,
  `sensor_name` varchar(12) NOT NULL DEFAULT 'Acidity',
  `cdate` datetime NOT NULL DEFAULT current_timestamp(),
  `readings` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `acidity`
--

INSERT INTO `acidity` (`id`, `sensor_name`, `cdate`, `readings`, `status`) VALUES
(5, 'Acidity', '2023-04-11 13:17:51', 8, 0);

--
-- Triggers `acidity`
--
DELIMITER $$
CREATE TRIGGER `insert acidity to notification` AFTER INSERT ON `acidity` FOR EACH ROW BEGIN
  IF NEW.readings > 7 THEN
    INSERT INTO notifications (sensor_name, cdate, readings, status) 
    VALUES (NEW.sensor_name, NEW.cdate, NEW.readings, NEW.status);
  END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insert_acidity to notification` AFTER INSERT ON `acidity` FOR EACH ROW BEGIN
  IF NEW.readings < 7 THEN
    INSERT INTO notifications (sensor_name, cdate, readings, status) 
    VALUES (NEW.sensor_name, NEW.cdate, NEW.readings, NEW.status);
  END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `electrical_conductivity`
--

CREATE TABLE `electrical_conductivity` (
  `id` int(11) NOT NULL,
  `sensor_name` varchar(12) NOT NULL DEFAULT 'Conductivity',
  `cdate` datetime NOT NULL DEFAULT current_timestamp(),
  `readings` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `electrical_conductivity`
--

INSERT INTO `electrical_conductivity` (`id`, `sensor_name`, `cdate`, `readings`, `status`) VALUES
(1, 'Conductivity', '2023-04-20 09:01:41', 200, 0),
(2, 'Conductivity', '2023-04-20 09:03:13', 200, 0),
(3, 'Conductivity', '2023-04-20 09:05:21', 600, 0);

--
-- Triggers `electrical_conductivity`
--
DELIMITER $$
CREATE TRIGGER `insert_dts_to_notifications` AFTER INSERT ON `electrical_conductivity` FOR EACH ROW BEGIN
  IF NEW.readings < 300 THEN
    INSERT INTO notifications (sensor_name, cdate, readings, status) 
    VALUES (NEW.sensor_name, NEW.cdate, NEW.readings, NEW.status);
  END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `insert_dtsolids_to_notifications` AFTER INSERT ON `electrical_conductivity` FOR EACH ROW BEGIN
  IF NEW.readings > 500 THEN
    INSERT INTO notifications (sensor_name, cdate, readings, status) 
    VALUES (NEW.sensor_name, NEW.cdate, NEW.readings, NEW.status);
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
  `sensor_name` varchar(12) NOT NULL,
  `cdate` datetime NOT NULL DEFAULT current_timestamp(),
  `readings` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `sensor_name`, `cdate`, `readings`, `status`) VALUES
(3, 'Acidity', '2023-04-11 13:17:51', 8, 0),
(4, 'Conductivity', '2023-04-20 09:03:13', 200, 0),
(5, 'Conductivity', '2023-04-20 09:05:21', 600, 0),
(6, 'temperature', '2023-04-20 09:11:47', 30, 0),
(7, 'Water Flow', '2023-04-20 09:17:10', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `temperature`
--

CREATE TABLE `temperature` (
  `id` int(11) NOT NULL,
  `sensor_name` varchar(12) NOT NULL DEFAULT 'temperature',
  `cdate` datetime NOT NULL DEFAULT current_timestamp(),
  `readings` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `temperature`
--

INSERT INTO `temperature` (`id`, `sensor_name`, `cdate`, `readings`, `status`) VALUES
(1, 'temperature', '2023-04-20 09:11:47', 30, 0);

--
-- Triggers `temperature`
--
DELIMITER $$
CREATE TRIGGER `insert_temp_to_notifications` AFTER INSERT ON `temperature` FOR EACH ROW BEGIN
  IF NEW.readings > 25 THEN
    INSERT INTO notifications (sensor_name, cdate, readings, status) 
    VALUES (NEW.sensor_name, NEW.cdate, NEW.readings, NEW.status);
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
  `password` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`) VALUES
(1, 'Jessie Conn Sam', 'jessiesam@gmail.com', '$2y$10$Nqq/y251QX2Ccvb1Ax7hUuMqQSkG3yRLCxN2KPdetnSP3oaXVH70a');

-- --------------------------------------------------------

--
-- Table structure for table `water_flow`
--

CREATE TABLE `water_flow` (
  `id` int(11) NOT NULL,
  `sensor_name` varchar(12) NOT NULL DEFAULT 'Water Flow',
  `cdate` datetime NOT NULL DEFAULT current_timestamp(),
  `readings` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `water_flow`
--

INSERT INTO `water_flow` (`id`, `sensor_name`, `cdate`, `readings`, `status`) VALUES
(1, 'Water Flow', '2023-04-20 09:15:51', 1, 0),
(2, 'Water Flow', '2023-04-20 09:17:10', 1, 0);

--
-- Triggers `water_flow`
--
DELIMITER $$
CREATE TRIGGER `insert_wf_to_notifications` AFTER INSERT ON `water_flow` FOR EACH ROW BEGIN
  IF NEW.readings < 2 THEN
    INSERT INTO notifications (sensor_name, cdate, readings, status) 
    VALUES (NEW.sensor_name, NEW.cdate, NEW.readings, NEW.status);
  END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `water_level`
--

CREATE TABLE `water_level` (
  `id` int(11) NOT NULL,
  `sensor_name` varchar(12) NOT NULL DEFAULT 'Water Level',
  `cdate` datetime NOT NULL DEFAULT current_timestamp(),
  `readings` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `water_level`
--

INSERT INTO `water_level` (`id`, `sensor_name`, `cdate`, `readings`, `status`) VALUES
(1, 'Water Level', '2023-04-06 16:26:57', 12, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acidity`
--
ALTER TABLE `acidity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `electrical_conductivity`
--
ALTER TABLE `electrical_conductivity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temperature`
--
ALTER TABLE `temperature`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `water_flow`
--
ALTER TABLE `water_flow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `water_level`
--
ALTER TABLE `water_level`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acidity`
--
ALTER TABLE `acidity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `electrical_conductivity`
--
ALTER TABLE `electrical_conductivity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `temperature`
--
ALTER TABLE `temperature`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `water_flow`
--
ALTER TABLE `water_flow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `water_level`
--
ALTER TABLE `water_level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
