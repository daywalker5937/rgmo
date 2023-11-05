-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2023 at 05:26 PM
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
  `date` date DEFAULT NULL,
  `service_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_client_form`
--

INSERT INTO `tbl_client_form` (`id`, `client_id`, `status`, `date`, `service_id`) VALUES
(16, 22, 'Client Payment', '2023-11-01', 5);

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
-- Table structure for table `tbl_payments`
--

CREATE TABLE `tbl_payments` (
  `payment_id` int(11) NOT NULL,
  `service_price` int(255) NOT NULL,
  `total_paid` int(255) NOT NULL,
  `due_date` date NOT NULL,
  `form_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_payments`
--

INSERT INTO `tbl_payments` (`payment_id`, `service_price`, `total_paid`, `due_date`, `form_id`) VALUES
(12, 400000, 400000, '0000-00-00', 16);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment_logs`
--

CREATE TABLE `tbl_payment_logs` (
  `logs_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `payment` int(255) NOT NULL,
  `payment_balance` int(255) DEFAULT NULL,
  `payment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_payment_logs`
--

INSERT INTO `tbl_payment_logs` (`logs_id`, `client_id`, `payment`, `payment_balance`, `payment_id`) VALUES
(14, 22, 2000, 398000, 12),
(15, 22, 3000, 395000, 12),
(16, 22, 395000, 0, 12);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_role`
--

CREATE TABLE `tbl_role` (
  `role_id` int(2) NOT NULL,
  `role_name` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_role`
--

INSERT INTO `tbl_role` (`role_id`, `role_name`) VALUES
(1, 'admin'),
(2, 'client'),
(3, 'pending');

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
(3, 'fas fa-user', '../tenants/', 'Tenants'),
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
  `description` mediumtext NOT NULL,
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
(5, 'Ondoy Housing', 'Antipolo', 400000, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry/\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has s', 'no', 'housing2.jpg', 2),
(6, 'Cherry Housing', 'Teresa', 100000, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry/\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has s', 'yes', 'housing3.jpg', 2),
(7, 'Abuyod Housing', 'Teresa', 800000, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry/\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has s', 'yes', 'housing4.jpg', 2),
(8, 'Coffee Stall', 'Manila', 5000, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry/\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has s', 'no', 'stall1.jpg', 3),
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
  `contact_number` varchar(11) NOT NULL,
  `sex` varchar(6) NOT NULL,
  `user_image` varchar(255) NOT NULL,
  `civil_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user_info`
--

INSERT INTO `tbl_user_info` (`user_id`, `first_name`, `last_name`, `middle_name`, `address`, `contact_number`, `sex`, `user_image`, `civil_status`) VALUES
(10, 'Mary Grace', 'Ortega', 'Waiñu', 'Isabela', '09898484684', 'Female', '302253-Nezuko-Cute-Kimetsu-no-Yaiba-4K.jpg', 'Single'),
(15, 'Jenny', 'Kim', 'Klein', 'South Korea', '09849849878', 'Female', '309932978_1112414036315316_7836836705751840661_n.jpg', 'Single'),
(16, 'Admin', 'Account', 'User', 'Isabela', '09589684526', 'Male', '', 'Single'),
(17, 'Lisa', 'Manoban', 'La', 'South Korea', '09846489448', '', '', 'Single'),
(18, 'Jose', 'Rizal', 'Protacio', 'Cavite', '09848998648', 'Male', 'Igloo_outside.jpg', 'Divorced'),
(20, 'Juan', 'Dela Cruz', 'De', 'Manila', '09549848488', 'Male', 'sample 1.png', 'Single'),
(21, 'Gorgonio', 'Magalpoc', 'Palo', 'Intramuros', '09849848978', 'Male', 'sample 6.png', 'Married'),
(22, 'Stephen', 'Curry', 'Wardell', 'USA', '09849878979', 'Male', 'sample 2.png', 'Married'),
(23, 'Frank', 'Stein', 'N', 'Europe', '09849879878', 'Male', 'sample 4.png', 'Married');

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
('marygrace@gmail.com', '$2y$10$QMMTVXNn1SdEs4UMnj.Z9O.B3pu3NNeRMrwh5rE7wvqa/uxGARzKa', 10),
('jenny@gmail.com', '$2y$10$xhH4l8MxAdoXbkdbKH/luOt1gy.OSkASfwpC0a3iBRcQwSdFtA2u6', 15),
('admin@gmail.com', '$2y$10$KmLrgQ6MHq5shnzDlsqWduZI7P2vTDhXIoCh0igZVH8FwL9fJJXeO', 16),
('lisa@gmail.com', '', 17),
('jose@gmail.com', '$2y$10$LSfjCXU8gwTD0w2xv8x7I.veZ1ItxV/Yvu9u0zgFlXUSeZ.Lv/7Gy', 18),
('juan@gmail.com', '$2y$10$k7SbwSVvLiPIJ4OuMMh20uSZ5WEC84qktE/CYleqkSqhuCrHgWME.', 20),
('edwardsarabia.11@gmail.com', '$2y$10$WqEkdP5iNQkhJlg8mHLcNupTUTqxmaE7LZ/itz12H8tjaUGlIb93m', 21),
('curry@gmail.com', '$2y$10$PRHmPByS1geYvB.ZeBInr.VZwAVGNceeuP9S6KxYxjms9L8r5r5Ke', 22),
('frank@gmail.com', '$2y$10$U2ajgy6UW/.DfKBxWiQytegXD8RxYQBCS4/c3rmI91WZbVQCMpM8O', 23);

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
(10, 2),
(15, 2),
(16, 1),
(18, 3),
(20, 2),
(21, 2),
(22, 2),
(23, 3);

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
-- Indexes for table `tbl_payments`
--
ALTER TABLE `tbl_payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `tbl_payment_logs`
--
ALTER TABLE `tbl_payment_logs`
  ADD PRIMARY KEY (`logs_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_list_of_service`
--
ALTER TABLE `tbl_list_of_service`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_payments`
--
ALTER TABLE `tbl_payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_payment_logs`
--
ALTER TABLE `tbl_payment_logs`
  MODIFY `logs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_role`
--
ALTER TABLE `tbl_role`
  MODIFY `role_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
