-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 15, 2019 at 09:19 PM
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
  `created_datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `visit` varchar(20) DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(1, 'CUSTOMERS', 0);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67869;

--
-- AUTO_INCREMENT for table `inspections`
--
ALTER TABLE `inspections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `plants`
--
ALTER TABLE `plants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `templates`
--
ALTER TABLE `templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `treeview`
--
ALTER TABLE `treeview`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=585;

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
