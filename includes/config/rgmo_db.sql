-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2023 at 09:10 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

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
-- Table structure for table `tbl_list_of_service`
--

CREATE TABLE `tbl_list_of_service` (
  `service_id` int(11) NOT NULL,
  `service_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_list_of_service`
--

INSERT INTO `tbl_list_of_service` (`service_id`, `service_name`) VALUES
(1, 'Farm Lands'),
(2, 'Staff Housing'),
(3, 'Stalls and Slots for Canteen/Cafeteria'),
(4, 'Skim of Palay'),
(5, 'Biazon Hostel');

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
  `type_id` int(11) NOT NULL,
  `type_name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `price` int(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `availability_status` varchar(50) NOT NULL,
  `service_image` varchar(255) NOT NULL,
  `service_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_type_of_service`
--

INSERT INTO `tbl_type_of_service` (`type_id`, `type_name`, `location`, `price`, `description`, `availability_status`, `service_image`, `service_id`) VALUES
(1, 'Isabela Farm', 'Isabela', 500000, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry/\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has s', 'yes', 'farm1.jpg', 1),
(2, 'Cagayan Farm', 'Cagayan', 2000000, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry/\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has s', 'yes', 'farm2.jpg', 1),
(3, 'Ilocos Farm', 'Ilocos Norte', 1200000, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry/\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has s', 'yes', 'farm3.jpg', 1),
(4, 'Camella Housing', 'Cavite', 300000, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry/\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has s', 'yes', 'housing1.jpg', 2),
(5, 'Ondoy Housing', 'Antipolo', 400000, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry/\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has s', 'yes', 'housing2.jpg', 2),
(6, 'Cherry Housing', 'Teresa', 100000, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry/\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has s', 'yes', 'housing3.jpg', 2),
(7, 'Abuyod Housing', 'Teresa', 800000, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry/\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has s', 'yes', 'housing4.jpg', 2),
(8, 'Coffee Stall', 'Manila', 5000, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry/\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has s', 'yes', 'stall1.jpg', 3),
(9, 'Pizza Stall', 'Makati', 4000, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry/\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has s', 'yes', 'stall2.jpg', 3),
(10, 'Isabela Rice Field', 'Isabela', 800000, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry/\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has s', 'yes', 'palay1.jpg', 4),
(11, 'Cagayan Rice Field', 'Cagayan', 900000, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry/\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has s', 'yes', 'palay2.jpg', 4),
(12, 'Transylvania Room', 'Cubao', 500000, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry/\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has s', 'yes', 'luxury1.jpg', 5);

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
(1, 'John Edward', 'Rosas', 'Sarabia', 'Antipolo City', 2147483647, 'Male', 'me.jpg', 'Single'),
(2, 'Mary Grace', 'Ortega', 'Wañia', 'Isabela', 2147483647, 'Female', '302253-Nezuko-Cute-Kimetsu-no-Yaiba-4K.jpg', 'Single');

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
('john@gmail.com', '$2y$10$yyklLdMmVgvbR9ULYvMLm.KnbraeadNspT3bqIZATFkTHpAmteCbC', 1),
('marygrace@gmail.com', '$2y$10$cmIGZkITB0VYLi0nrSBgv.uBxvyP7hs5Z.Cw4jjVCxRXnSsqgwlTO', 2);

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
(1, 2),
(2, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_client_form`
--
ALTER TABLE `tbl_client_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_list_of_service`
--
ALTER TABLE `tbl_list_of_service`
  ADD PRIMARY KEY (`service_id`);

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
  ADD PRIMARY KEY (`type_id`);

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
-- AUTO_INCREMENT for table `tbl_list_of_service`
--
ALTER TABLE `tbl_list_of_service`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_user_info`
--
ALTER TABLE `tbl_user_info`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
