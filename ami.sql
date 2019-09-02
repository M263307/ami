-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 02, 2019 at 10:58 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.1.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ami`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `street_address_line_1` varchar(200) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(45) NOT NULL,
  `country` varchar(45) NOT NULL,
  `postal_code` varchar(10) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `visit` varchar(20) DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `street_address_line_1`, `city`, `state`, `country`, `postal_code`, `created_datetime`, `email`, `phone`, `visit`) VALUES
(1, 'cust1', 'cust1-address-line1', 'detroit', 'MI', 'USA', '48127', '2019-08-30 02:25:13', 'xyz@abc.org', '123-456-7890', 'No'),
(2, 'cust2', 'cust2-address-line1', 'detroit', 'MI', 'USA', '48127', '2019-08-30 02:25:13', 'xyz@abc.org', '123-456-7890', 'No'),
(3, 'cust3', 'cust3-address-line1', 'detroit', 'MI', 'USA', '48127', '2019-08-30 02:25:13', 'xyz@abc.org', '123-456-7890', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `inspections`
--

CREATE TABLE `inspections` (
  `id` int(11) NOT NULL,
  `inspector` varchar(100) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `plant_id` int(11) NOT NULL,
  `program` varchar(45) NOT NULL,
  `form_type` varchar(45) NOT NULL,
  `due_date` date NOT NULL,
  `status` varchar(20) NOT NULL,
  `form_uploaded` blob DEFAULT NULL,
  `created_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `inspections`
--

INSERT INTO `inspections` (`id`, `inspector`, `customer_id`, `plant_id`, `program`, `form_type`, `due_date`, `status`, `form_uploaded`, `created_datetime`) VALUES
(1, 'ins1', 2, 2, 'environmental', 'monthly', '2019-08-31', 'new', NULL, '2019-08-30 02:25:13'),
(2, 'ins1', 2, 2, 'environmental', 'monthly', '2019-07-31', 'completed', NULL, '2019-08-30 02:25:13'),
(3, 'ins1', 2, 2, 'environmental', 'monthly', '2019-06-30', 'completed', NULL, '2019-08-30 02:25:13'),
(4, 'ins2', 3, 3, 'health & safety', 'quarterly', '2019-08-31', 'new', NULL, '2019-08-30 02:25:13'),
(5, 'ins2', 3, 3, 'health & safety', 'quarterly', '2019-05-30', 'completed', NULL, '2019-08-30 02:25:13'),
(6, 'ins5', 3, 3, 'environmental', 'quarterly', '2019-08-31', 'new', NULL, '2019-08-30 02:25:13'),
(7, 'ins5', 3, 3, 'environmental', 'quarterly', '2019-05-30', 'completed', NULL, '2019-08-30 02:25:13');

-- --------------------------------------------------------

--
-- Table structure for table `plants`
--

CREATE TABLE `plants` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `street_address_line_1` varchar(200) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(45) NOT NULL,
  `country` varchar(45) NOT NULL,
  `postal_code` varchar(10) NOT NULL,
  `created_datetime` datetime NOT NULL,
  `customer_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `plants`
--

INSERT INTO `plants` (`id`, `name`, `street_address_line_1`, `city`, `state`, `country`, `postal_code`, `created_datetime`, `customer_id`) VALUES
(1, 'plant1', 'plant1-address-line1', 'detroit', 'MI', 'USA', '48127', '2019-08-30 02:25:13', 1),
(2, 'plant2', 'plant2-address-line1', 'detroit', 'MI', 'USA', '48127', '2019-08-30 02:25:13', 1),
(3, 'plant3', 'plant3-address-line1', 'detroit', 'MI', 'USA', '48127', '2019-08-30 02:25:13', 1),
(4, 'plant4', 'plant4-address-line1', 'detroit', 'MI', 'USA', '48127', '2019-08-30 02:25:13', 2),
(5, 'plant5', 'plant5-address-line1', 'detroit', 'MI', 'USA', '48127', '2019-08-30 02:25:13', 2),
(6, 'plant6', 'plant6-address-line1', 'detroit', 'MI', 'USA', '48127', '2019-08-30 02:25:13', 2),
(7, 'plant7', 'plant7-address-line1', 'detroit', 'MI', 'USA', '48127', '2019-08-30 02:25:13', 3),
(8, 'plant8', 'plant8-address-line1', 'detroit', 'MI', 'USA', '48127', '2019-08-30 02:25:13', 3),
(9, 'plant9', 'plant9-address-line1', 'detroit', 'MI', 'USA', '48127', '2019-08-30 02:25:13', 3),
(10, 'plant0', 'plant0-address-line1', 'detroit', 'MI', 'USA', '48127', '2019-08-30 02:25:13', 3);

-- --------------------------------------------------------

--
-- Table structure for table `templates`
--

CREATE TABLE `templates` (
  `id` int(11) NOT NULL,
  `form_type` varchar(45) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `plant_id` int(11) NOT NULL,
  `program` varchar(45) NOT NULL,
  `template_for_download` blob DEFAULT NULL,
  `created_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `templates`
--

INSERT INTO `templates` (`id`, `form_type`, `customer_id`, `plant_id`, `program`, `template_for_download`, `created_datetime`) VALUES
(1, 'monthly', 1, 1, 'environmental', NULL, '2019-08-30 02:25:13'),
(2, 'quarterly', 1, 1, 'environmental', NULL, '2019-08-30 02:25:13'),
(3, 'monthly', 1, 2, 'environmental', NULL, '2019-08-30 02:25:13'),
(4, 'quarterly', 1, 2, 'environmental', NULL, '2019-08-30 02:25:13'),
(5, 'monthly', 1, 3, 'environmental', NULL, '2019-08-30 02:25:13'),
(6, 'quarterly', 1, 3, 'environmental', NULL, '2019-08-30 02:25:13'),
(7, 'monthly', 2, 4, 'environmental', NULL, '2019-08-30 02:25:13'),
(8, 'quarterly', 2, 4, 'environmental', NULL, '2019-08-30 02:25:13'),
(9, 'monthly', 2, 5, 'environmental', NULL, '2019-08-30 02:25:13'),
(10, 'quarterly', 2, 5, 'environmental', NULL, '2019-08-30 02:25:13'),
(11, 'monthly', 2, 6, 'environmental', NULL, '2019-08-30 02:25:13'),
(12, 'quarterly', 2, 6, 'environmental', NULL, '2019-08-30 02:25:13'),
(13, 'monthly', 3, 7, 'environmental', NULL, '2019-08-30 02:25:13'),
(14, 'quarterly', 3, 7, 'environmental', NULL, '2019-08-30 02:25:13'),
(15, 'monthly', 3, 8, 'environmental', NULL, '2019-08-30 02:25:13'),
(16, 'quarterly', 3, 8, 'environmental', NULL, '2019-08-30 02:25:13'),
(17, 'monthly', 3, 9, 'environmental', NULL, '2019-08-30 02:25:13'),
(18, 'quarterly', 3, 9, 'environmental', NULL, '2019-08-30 02:25:13'),
(19, 'monthly', 3, 10, 'environmental', NULL, '2019-08-30 02:25:13'),
(20, 'quarterly', 3, 10, 'environmental', NULL, '2019-08-30 02:25:13'),
(21, 'monthly', 1, 1, 'health & safety', NULL, '2019-08-30 02:25:13'),
(22, 'quarterly', 1, 1, 'health & safety', NULL, '2019-08-30 02:25:13'),
(23, 'monthly', 1, 2, 'health & safety', NULL, '2019-08-30 02:25:13'),
(24, 'quarterly', 1, 2, 'health & safety', NULL, '2019-08-30 02:25:13'),
(25, 'monthly', 1, 3, 'health & safety', NULL, '2019-08-30 02:25:13'),
(26, 'quarterly', 1, 3, 'health & safety', NULL, '2019-08-30 02:25:13'),
(27, 'monthly', 2, 4, 'health & safety', NULL, '2019-08-30 02:25:13'),
(28, 'quarterly', 2, 4, 'health & safety', NULL, '2019-08-30 02:25:13'),
(29, 'monthly', 2, 5, 'health & safety', NULL, '2019-08-30 02:25:13'),
(30, 'quarterly', 2, 5, 'health & safety', NULL, '2019-08-30 02:25:13'),
(31, 'monthly', 2, 6, 'health & safety', NULL, '2019-08-30 02:25:13'),
(32, 'quarterly', 2, 6, 'health & safety', NULL, '2019-08-30 02:25:13'),
(33, 'monthly', 3, 7, 'health & safety', NULL, '2019-08-30 02:25:13'),
(34, 'quarterly', 3, 7, 'health & safety', NULL, '2019-08-30 02:25:13'),
(35, 'monthly', 3, 8, 'health & safety', NULL, '2019-08-30 02:25:13'),
(36, 'quarterly', 3, 8, 'health & safety', NULL, '2019-08-30 02:25:13'),
(37, 'monthly', 3, 9, 'health & safety', NULL, '2019-08-30 02:25:13'),
(38, 'quarterly', 3, 9, 'health & safety', NULL, '2019-08-30 02:25:13'),
(39, 'monthly', 3, 10, 'health & safety', NULL, '2019-08-30 02:25:13'),
(40, 'quarterly', 3, 10, 'health & safety', NULL, '2019-08-30 02:25:13');

-- --------------------------------------------------------

--
-- Table structure for table `treeview`
--

CREATE TABLE `treeview` (
  `id` int(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `parent_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `treeview`
--

INSERT INTO `treeview` (`id`, `name`, `parent_id`) VALUES
(1, 'CUSTOMERS', 0),
(2, 'cust2', 1),
(3, 'plant2', 2),
(4, 'environmental', 3),
(5, 'monthly', 4),
(6, 'ins1', 5),
(7, 'plant2', 2),
(8, 'environmental', 7),
(9, 'monthly', 8),
(10, 'ins1', 9),
(11, 'plant2', 2),
(12, 'environmental', 11),
(13, 'monthly', 12),
(14, 'ins1', 13),
(307, 'cust1', 1),
(308, 'cust3', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `passcode` varchar(40) NOT NULL,
  `type` enum('A','P','I') NOT NULL,
  `status` varchar(1) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `phone` varchar(12) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `street_address_line_1` varchar(200) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(45) DEFAULT NULL,
  `country` varchar(45) DEFAULT NULL,
  `postal_code` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `passcode`, `type`, `status`, `first_name`, `last_name`, `phone`, `email`, `street_address_line_1`, `city`, `state`, `country`, `postal_code`) VALUES
(1, 'admin', 'admin', 'A', 'A', 'admin', 'admin', '123-456-7890', 'some@email.com', '', '', '', '', ''),
(2, 'pm1', 'pm1', 'P', 'A', 'pmname1', 'pmsurname1', '123-456-7890', 'pm1@email.com', '', '', '', '', ''),
(3, 'ins1', 'ins1', 'I', 'A', 'insname1', 'inssurname1', '123-456-7890', 'ins1@email.com', '', '', '', '', ''),
(4, 'ins2', 'ins2', 'I', 'A', 'insname2', 'inssurname2', '123-456-7890', 'ins2@email.com', '', '', '', '', ''),
(5, 'ins3', 'ins3', 'I', 'A', 'insname3', 'inssurname3', '123-456-7890', 'ins2@email.com', '', '', '', '', ''),
(6, 'ins4', 'ins4', 'I', 'A', 'insname4', 'inssurname4', '123-456-7890', 'ins2@email.com', '', '', '', '', ''),
(7, 'ins5', 'ins5', 'I', 'A', 'insname5', 'inssurname5', '123-456-7890', 'ins2@email.com', '', '', '', '', ''),
(8, 'ins6', 'ins6', 'I', 'A', 'insname6', 'inssurname6', '123-456-7890', 'ins2@email.com', '', '', '', '', ''),
(9, 'ins7', 'ins7', 'I', 'A', 'insname7', 'inssurname7', '123-456-7890', 'ins2@email.com', '', '', '', '', ''),
(10, 'ins8', 'ins8', 'I', 'A', 'insname8', 'inssurname8', '123-456-7890', 'ins2@email.com', '', '', '', '', ''),
(11, 'ins9', 'ins9', 'I', 'A', 'insname9', 'inssurname9', '123-456-7890', 'ins2@email.com', '', '', '', '', ''),
(12, 'ins0', 'ins0', 'I', 'A', 'insname0', 'inssurname0', '123-456-7890', 'ins2@email.com', '', '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inspections`
--
ALTER TABLE `inspections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `plant_id` (`plant_id`);

--
-- Indexes for table `plants`
--
ALTER TABLE `plants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `templates`
--
ALTER TABLE `templates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `plant_id` (`plant_id`);

--
-- Indexes for table `treeview`
--
ALTER TABLE `treeview`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=485;

--
-- AUTO_INCREMENT for table `inspections`
--
ALTER TABLE `inspections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `plants`
--
ALTER TABLE `plants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `templates`
--
ALTER TABLE `templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `treeview`
--
ALTER TABLE `treeview`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=465;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `inspections`
--
ALTER TABLE `inspections`
  ADD CONSTRAINT `inspections_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `inspections_ibfk_2` FOREIGN KEY (`plant_id`) REFERENCES `plants` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `plants`
--
ALTER TABLE `plants`
  ADD CONSTRAINT `plants_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `templates`
--
ALTER TABLE `templates`
  ADD CONSTRAINT `templates_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `templates_ibfk_2` FOREIGN KEY (`plant_id`) REFERENCES `plants` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
