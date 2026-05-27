-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 29, 2022 at 02:24 AM
-- Server version: 10.3.34-MariaDB
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `esurv`
--

-- --------------------------------------------------------

--
-- Table structure for table `esurv_po`
--

CREATE TABLE `esurv_po` (
  `id` int(11) NOT NULL,
  `po_number` varchar(50) NOT NULL,
  `po_date` date NOT NULL,
  `client` varchar(50) NOT NULL,
  `proj_name` varchar(60) NOT NULL,
  `expected_completion_date` date NOT NULL,
  `penalty` double NOT NULL,
  `monthly_charges` double NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `esurv_po_sites`
--

CREATE TABLE `esurv_po_sites` (
  `id` int(11) NOT NULL,
  `po_id` int(11) NOT NULL,
  `site_name` varchar(100) NOT NULL,
  `completion_date` date NOT NULL,
  `start_date` date NOT NULL,
  `total_penalty` float NOT NULL,
  `no_of_week_extended` int(11) NOT NULL,
  `client_approved_by` varchar(50) NOT NULL,
  `vendor_approved_by` varchar(50) NOT NULL,
  `is_complete_approved_vendor` int(11) NOT NULL DEFAULT 0 COMMENT 'vendor''s id',
  `approved_by_client` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `esurv_po`
--
ALTER TABLE `esurv_po`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `esurv_po_sites`
--
ALTER TABLE `esurv_po_sites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `esurv_po_sites_ibfk_1` (`po_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `esurv_po`
--
ALTER TABLE `esurv_po`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `esurv_po_sites`
--
ALTER TABLE `esurv_po_sites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `esurv_po_sites`
--
ALTER TABLE `esurv_po_sites`
  ADD CONSTRAINT `esurv_po_sites_ibfk_1` FOREIGN KEY (`po_id`) REFERENCES `esurv_po` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
