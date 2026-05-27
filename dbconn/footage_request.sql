-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 30, 2022 at 02:06 AM
-- Server version: 10.3.35-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sarmicrosystems_comfortcalltracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `footage_request`
--

CREATE TABLE `footage_request` (
  `id` int(11) NOT NULL,
  `atmid` varchar(128) NOT NULL,
  `card_no` int(11) NOT NULL,
  `date_of_TXN` date NOT NULL,
  `time_of_TXN` time NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `nature_of_TXN` varchar(128) NOT NULL,
  `amount_of_TXN` float NOT NULL,
  `txn_no` int(11) NOT NULL,
  `complaint_no` int(11) NOT NULL,
  `complaint_date` date NOT NULL,
  `claim_date` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `footage_avail` varchar(20) DEFAULT NULL,
  `footage_filename` varchar(128) DEFAULT NULL,
  `footage_date` date DEFAULT NULL,
  `footage_start_time` time DEFAULT NULL,
  `footage_end_time` time DEFAULT NULL,
  `date_of_presrv` date DEFAULT NULL,
  `downlink` text DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `footage_receive_at` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `footage_request`
--
ALTER TABLE `footage_request`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `footage_request`
--
ALTER TABLE `footage_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
