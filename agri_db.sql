-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2024 at 09:28 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `agri_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(25) DEFAULT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `role` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `first_name`, `middle_name`, `last_name`, `email`, `role`) VALUES
(1, 'billyjay', 'billy123', 'Billy', NULL, 'Menguito', 'billy.watapampa@sample.com', 2),
(2, 'boloybay', 'boloy123', 'Boloy', '', 'Bayo', 'boloybay@sample.com', 2),
(3, 'kumalon', 'kum123', 'kumlay', '', 'kumlon', 'kumalon@sample.com', 2),
(4, 'jaero', 'naruto123', 'jaero', '', 'cabayot', 'jaerocabayot@sample.com', 2),
(5, 'ally123', 'ally123', 'Ally', '', 'Parcon', 'allyparcon@sample.com', 2);

-- --------------------------------------------------------

--
-- Table structure for table `barangay`
--

CREATE TABLE `barangay` (
  `id` int(11) NOT NULL,
  `barangay_name` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barangay`
--

INSERT INTO `barangay` (`id`, `barangay_name`) VALUES
(1, 'Lagao'),
(2, 'San Isidro'),
(3, 'Bula');

-- --------------------------------------------------------

--
-- Table structure for table `crops`
--

CREATE TABLE `crops` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `crops`
--

INSERT INTO `crops` (`id`, `name`) VALUES
(1, 'Corn'),
(2, 'Rice');

-- --------------------------------------------------------

--
-- Table structure for table `farmers`
--

CREATE TABLE `farmers` (
  `id` int(11) NOT NULL,
  `rsbsa_num` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(25) DEFAULT NULL,
  `last_name` varchar(50) NOT NULL,
  `contact_number` varchar(50) DEFAULT NULL,
  `area` double(5,1) NOT NULL,
  `crops` int(11) NOT NULL,
  `barangay` int(11) DEFAULT NULL,
  `role` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `farmers`
--

INSERT INTO `farmers` (`id`, `rsbsa_num`, `password`, `first_name`, `middle_name`, `last_name`, `contact_number`, `area`, `crops`, `barangay`, `role`) VALUES
(1, '000_0000_001', 'billy123', 'Billy Joe', NULL, 'Mengits', '092255336871', 2.1, 1, 1, 1),
(2, '000_0000_002', 'baymax123', 'Bay', NULL, 'Max', '092255336871', 5.0, 2, 2, 1),
(5, '000_0000_003', 'emman123', 'Emmanuel', '', 'Malagamba', '12345678910', 2.1, 1, 2, 1),
(6, '000_0000_004', 'yot123', 'Yot', '', 'Bay', '12345678910', 4.5, 2, 3, 1),
(7, '000_0000_005', '123', 'jaero', '', 'cabayot', '04040400404', 4.6, 2, 3, 1),
(8, '000_0000_006', '123', 'gemuel', '', 'catubig', '09070605121', 6.7, 2, 1, 1),
(9, '000_0000_007', '123', 'Allysa', '', 'Parcon', '09090909090', 9.9, 2, 2, 1),
(10, '000_0000_008', '123', 'lagkit', '', 'makapilit', '09870007851', 6.8, 1, 1, 1),
(11, '000_0000_009', '123', 'ungkoy', '', 'curacotdacot', '09125162393', 6.9, 2, 2, 1),
(12, '000_0000_010', '123', 'miling', '', 'pastil', '09601325637', 9.1, 1, 3, 1),
(13, '000_0000_011', '123', 'sheesh', '', 'falbon', '09837561907', 2.8, 2, 1, 1),
(14, '000_0000_012', '123', 'king', '', 'yasmin', '09005738415', 3.8, 1, 2, 1),
(15, '000_0000_013', '123', 'baby', '', 'sugar', '09561745859', 7.1, 2, 3, 1),
(16, '000_0000_014', '123', 'arji', '', 'dane', '09571827586', 1.1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `harvests`
--

CREATE TABLE `harvests` (
  `id` int(11) NOT NULL,
  `farmer` int(11) DEFAULT NULL,
  `crop` int(11) DEFAULT NULL,
  `date_harvested` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `harvests`
--

INSERT INTO `harvests` (`id`, `farmer`, `crop`, `date_harvested`) VALUES
(1, 1, 1, '2023-04-03 23:49:38'),
(2, 1, 1, '2023-05-10 23:49:38'),
(3, 1, 1, '2023-05-08 23:49:38'),
(4, 2, 2, '2024-01-02 23:49:38'),
(5, 1, 2, '2024-01-04 23:49:38'),
(6, 2, 2, '2024-02-13 23:49:38'),
(7, 1, 1, '2024-02-12 23:49:38'),
(8, 1, 1, '2024-02-29 23:49:38'),
(9, 1, 1, '2024-02-29 23:49:38'),
(10, 2, 2, '2024-03-20 23:49:38'),
(11, 1, 1, '2024-06-12 01:13:54'),
(12, 2, 2, '2023-03-08 01:22:23'),
(13, 7, 2, '2023-09-20 09:43:13'),
(14, 8, 2, '2024-10-15 09:49:50');

-- --------------------------------------------------------

--
-- Table structure for table `user_levels`
--

CREATE TABLE `user_levels` (
  `id` int(11) NOT NULL,
  `role` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_levels`
--

INSERT INTO `user_levels` (`id`, `role`) VALUES
(1, 'Farmer'),
(2, 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role` (`role`);

--
-- Indexes for table `barangay`
--
ALTER TABLE `barangay`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crops`
--
ALTER TABLE `crops`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `farmers`
--
ALTER TABLE `farmers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rsbsa_num` (`rsbsa_num`),
  ADD KEY `barangay` (`barangay`),
  ADD KEY `role` (`role`),
  ADD KEY `crops` (`crops`);

--
-- Indexes for table `harvests`
--
ALTER TABLE `harvests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `farmer` (`farmer`),
  ADD KEY `crop` (`crop`);

--
-- Indexes for table `user_levels`
--
ALTER TABLE `user_levels`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `barangay`
--
ALTER TABLE `barangay`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `crops`
--
ALTER TABLE `crops`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `farmers`
--
ALTER TABLE `farmers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `harvests`
--
ALTER TABLE `harvests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user_levels`
--
ALTER TABLE `user_levels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_ibfk_1` FOREIGN KEY (`role`) REFERENCES `user_levels` (`id`);

--
-- Constraints for table `farmers`
--
ALTER TABLE `farmers`
  ADD CONSTRAINT `farmers_ibfk_1` FOREIGN KEY (`barangay`) REFERENCES `barangay` (`id`),
  ADD CONSTRAINT `farmers_ibfk_2` FOREIGN KEY (`role`) REFERENCES `user_levels` (`id`),
  ADD CONSTRAINT `farmers_ibfk_3` FOREIGN KEY (`crops`) REFERENCES `crops` (`id`);

--
-- Constraints for table `harvests`
--
ALTER TABLE `harvests`
  ADD CONSTRAINT `harvests_ibfk_1` FOREIGN KEY (`farmer`) REFERENCES `farmers` (`id`),
  ADD CONSTRAINT `harvests_ibfk_2` FOREIGN KEY (`crop`) REFERENCES `crops` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
