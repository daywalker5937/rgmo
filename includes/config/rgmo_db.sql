-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 29, 2023 at 03:44 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rgmo_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_client_form`
--

CREATE TABLE `tbl_client_form` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `service_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_role`
--

CREATE TABLE `tbl_role` (
  `role_id` int(2) NOT NULL,
  `role_name` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_role`
--

INSERT INTO `tbl_role` (`role_id`, `role_name`) VALUES
(1, 'admin'),
(2, 'client');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sidebar`
--

CREATE TABLE `tbl_sidebar` (
  `id` int(11) NOT NULL,
  `element_class` varchar(255) NOT NULL,
  `element_uri` varchar(255) NOT NULL,
  `element_text` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_sidebar`
--

INSERT INTO `tbl_sidebar` (`id`, `element_class`, `element_uri`, `element_text`) VALUES
(1, 'fas fa-tachometer-alt', '../dashboard/', 'Dashboard'),
(2, 'fas fa-map-marker', '../location/', 'Location'),
(3, 'fas fa-user', '../leaseholder/', 'Leaseholder'),
(4, 'fas fa-user', '../profile/', 'Profile'),
(5, 'fas fa-bolt', '../services/', 'Services'),
(6, 'fas fa-chart-bar', '../reports/', 'Reports'),
(7, 'fas fa-question-circle', '../about/', 'About');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_type_of_service`
--

CREATE TABLE `tbl_type_of_service` (
  `service_id` int(11) NOT NULL,
  `service_name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `price` int(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `availability_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_type_of_service`
--

INSERT INTO `tbl_type_of_service` (`service_id`, `service_name`, `location`, `price`, `description`, `availability_status`) VALUES
(1, 'Farm Lands', '', 0, '', 'Yes'),
(2, 'Staff Housing', '', 0, '', 'Yes'),
(3, 'Stalls and slots for canteen/cafeteria', '', 0, '', 'Yes'),
(4, 'Skim of palay', '', 0, '', 'Yes'),
(5, 'Biazon Hostel', '', 0, '', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_info`
--

CREATE TABLE `tbl_user_info` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact_number` int(11) NOT NULL,
  `sex` varchar(6) NOT NULL,
  `user_image` varchar(255) NOT NULL,
  `civil_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user_info`
--

INSERT INTO `tbl_user_info` (`user_id`, `first_name`, `last_name`, `middle_name`, `address`, `contact_number`, `sex`, `user_image`, `civil_status`) VALUES
(1, 'John Edward', 'Rosas', 'Sarabia', 'Antipolo City', 2147483647, 'Male', 'me.jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_login`
--

CREATE TABLE `tbl_user_login` (
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user_login`
--

INSERT INTO `tbl_user_login` (`email`, `password`, `user_id`) VALUES
('john@gmail.com', '$2y$10$yyklLdMmVgvbR9ULYvMLm.KnbraeadNspT3bqIZATFkTHpAmteCbC', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_role`
--

CREATE TABLE `tbl_user_role` (
  `user_id` int(11) NOT NULL,
  `role_id` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user_role`
--

INSERT INTO `tbl_user_role` (`user_id`, `role_id`) VALUES
(1, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_client_form`
--
ALTER TABLE `tbl_client_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_role`
--
ALTER TABLE `tbl_role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `tbl_sidebar`
--
ALTER TABLE `tbl_sidebar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_type_of_service`
--
ALTER TABLE `tbl_type_of_service`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `tbl_user_info`
--
ALTER TABLE `tbl_user_info`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_client_form`
--
ALTER TABLE `tbl_client_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_role`
--
ALTER TABLE `tbl_role`
  MODIFY `role_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_sidebar`
--
ALTER TABLE `tbl_sidebar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_type_of_service`
--
ALTER TABLE `tbl_type_of_service`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_user_info`
--
ALTER TABLE `tbl_user_info`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
