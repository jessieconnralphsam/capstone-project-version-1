-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2023 at 12:24 PM
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
-- Database: `hydroponics_nft`
--

-- --------------------------------------------------------

--
-- Table structure for table `acidity`
--

CREATE TABLE `acidity` (
  `id` int(11) NOT NULL,
  `cdate` datetime NOT NULL,
  `acidity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `acidity`
--

INSERT INTO `acidity` (`id`, `cdate`, `acidity`) VALUES
(1, '2023-02-17 03:36:28', 6),
(2, '2023-02-17 03:36:40', 3),
(3, '2023-02-17 03:36:49', 8),
(4, '2023-02-17 03:36:58', 12),
(5, '2023-02-17 03:37:08', 4),
(6, '2023-02-17 03:37:18', 7),
(7, '2023-02-17 03:37:28', 10),
(8, '2023-02-17 03:41:56', 7),
(9, '2023-02-17 03:43:38', 2),
(10, '2023-02-17 03:46:52', 7),
(11, '2023-02-17 04:04:33', 6),
(12, '2023-02-17 08:58:17', 7),
(13, '2023-02-17 09:00:38', 3),
(14, '2023-02-19 12:20:45', 12),
(15, '2023-03-27 07:08:49', 7),
(16, '2023-03-27 07:09:41', 10),
(17, '2023-03-27 07:10:42', 8),
(18, '2023-03-27 07:14:00', 9),
(19, '2023-03-27 07:19:05', 12),
(20, '2023-03-27 07:20:39', 12),
(21, '2023-03-27 07:24:02', 10),
(22, '2023-03-27 07:24:42', 10),
(23, '2023-03-27 07:25:52', 7),
(24, '2023-03-27 07:37:29', 12),
(25, '2023-03-27 07:42:51', 9),
(26, '2023-03-27 07:53:47', 7),
(27, '2023-03-27 07:54:02', 6);

-- --------------------------------------------------------

--
-- Table structure for table `ectemp`
--

CREATE TABLE `ectemp` (
  `id` int(11) NOT NULL,
  `cdate` datetime NOT NULL DEFAULT current_timestamp(),
  `EC` int(11) NOT NULL,
  `Temperature` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ectemp`
--

INSERT INTO `ectemp` (`id`, `cdate`, `EC`, `Temperature`) VALUES
(16, '2023-02-16 15:36:23', 40, 10),
(21, '2023-02-16 18:36:28', 10, 50),
(22, '2023-02-16 18:39:29', 20, 30),
(23, '2023-02-16 18:48:46', 60, 30),
(24, '2023-02-16 18:49:49', 10, 10),
(25, '2023-02-16 18:50:49', 40, 50),
(26, '2023-02-16 18:51:45', 20, 10),
(27, '2023-02-16 18:52:10', 60, 40),
(28, '2023-02-16 18:53:16', 10, 30),
(29, '2023-02-16 18:54:23', 40, 50),
(30, '2023-02-16 18:55:07', 20, 60),
(31, '2023-02-16 19:00:24', 40, 30),
(32, '2023-02-16 19:03:22', 10, 50),
(33, '2023-02-16 19:31:49', 40, 50),
(34, '2023-02-16 20:27:47', 40, 50),
(35, '2023-02-16 20:28:03', 20, 10),
(36, '2023-02-16 20:32:01', 60, 60),
(37, '2023-02-16 20:33:15', 40, 10),
(38, '2023-02-16 20:35:15', 20, 30),
(39, '2023-02-16 20:39:48', 40, 20),
(40, '2023-02-16 20:47:09', 10, 20),
(41, '2023-02-16 20:49:42', 10, 30),
(42, '2023-02-17 11:41:14', 20, 20),
(43, '2023-02-19 19:21:57', 40, 0),
(44, '2023-02-19 19:22:27', 40, 30),
(45, '2023-03-27 07:02:51', 500, 55),
(46, '2023-03-27 07:14:14', 1000, 60),
(47, '2023-03-27 07:26:55', 300, 60),
(48, '2023-03-27 07:27:23', 301, 30),
(49, '2023-03-27 07:28:33', 200, 50),
(50, '2023-03-27 07:28:59', 800, 60),
(51, '2023-03-27 07:29:17', 900, 60),
(52, '2023-03-27 07:34:50', 500, 30),
(53, '2023-03-29 13:03:10', 20, 50),
(54, '2023-03-29 13:04:12', 0, 0),
(55, '2023-03-29 13:05:40', 40, 20);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `text` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `cdate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `text`, `status`, `cdate`) VALUES
(26, 'Sample Notif', 1, '2023-04-04 17:26:52'),
(27, 'awww', 1, '2023-04-04 17:26:52'),
(28, 'qweee', 1, '2023-04-04 17:26:52'),
(29, 'not normal', 1, '2023-04-04 17:26:52'),
(30, 'not normal', 1, '2023-04-04 17:26:52'),
(31, 'not normal', 1, '2023-04-04 17:26:52'),
(32, 'not normal', 1, '2023-04-04 17:27:19'),
(33, 'not normal', 1, '2023-04-04 17:40:47'),
(34, 'not normal', 1, '2023-04-04 17:41:35'),
(35, 'not normal', 1, '2023-04-04 17:45:13'),
(36, 'not normal', 1, '2023-04-04 17:47:09'),
(37, 'not normal', 1, '2023-04-04 17:49:17'),
(38, 'not normal', 1, '2023-04-04 17:51:17'),
(39, 'not normal', 1, '2023-04-04 17:52:31'),
(40, 'not normal', 1, '2023-04-04 17:53:27'),
(41, 'not normal', 1, '2023-04-04 17:55:22'),
(42, 'not normal', 1, '2023-04-04 17:56:51'),
(43, 'not normal', 1, '2023-04-04 17:57:30'),
(44, 'not normal', 1, '2023-04-04 17:59:37'),
(45, 'not normal', 1, '2023-04-04 18:00:53'),
(46, 'not normal', 1, '2023-04-04 18:05:49');

-- --------------------------------------------------------

--
-- Table structure for table `watermetrics`
--

CREATE TABLE `watermetrics` (
  `id` int(11) NOT NULL,
  `cdate` datetime NOT NULL DEFAULT current_timestamp(),
  `waterflow` int(11) NOT NULL,
  `waterlevel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `watermetrics`
--

INSERT INTO `watermetrics` (`id`, `cdate`, `waterflow`, `waterlevel`) VALUES
(3, '2023-03-29 11:00:37', 5, 10),
(4, '2023-03-29 11:01:06', 14, 25),
(5, '2023-03-29 11:01:39', 90, 8),
(6, '2023-03-29 11:01:59', 99, 13),
(7, '2023-03-29 11:02:41', 80, 7),
(8, '2023-03-29 11:02:41', 100, 2),
(9, '2023-03-29 11:03:12', 23, 5),
(10, '2023-03-29 11:03:33', 10, 2),
(11, '2023-03-29 11:12:00', 100, 3),
(12, '2023-03-29 11:15:41', 75, 15),
(13, '2023-03-29 11:17:18', 65, 20),
(14, '2023-03-29 11:37:00', 10, 10),
(15, '2023-03-29 12:23:27', 10, 25),
(16, '2023-03-29 12:31:40', 60, 12),
(17, '2023-03-29 12:32:11', 65, 12),
(18, '2023-03-29 17:22:02', 90, 15);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acidity`
--
ALTER TABLE `acidity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ectemp`
--
ALTER TABLE `ectemp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `watermetrics`
--
ALTER TABLE `watermetrics`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acidity`
--
ALTER TABLE `acidity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `ectemp`
--
ALTER TABLE `ectemp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `watermetrics`
--
ALTER TABLE `watermetrics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
