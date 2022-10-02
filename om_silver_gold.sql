-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2022 at 11:24 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `om_silver_gold`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `iCustomerID` int(11) NOT NULL,
  `vcName` varchar(150) NOT NULL,
  `iPhoneNumber` varchar(20) NOT NULL,
  `vcCity` varchar(150) NOT NULL,
  `iStatus` enum('0','1','2') NOT NULL DEFAULT '1' COMMENT '0=>Inactive\r\n1=>Active\r\n2=>Delete',
  `dtCreatedOn` datetime NOT NULL,
  `dtModifiedOn` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `iID` int(11) NOT NULL,
  `iProductID` enum('1','2') NOT NULL DEFAULT '1' COMMENT '1=>Gold\r\n2=>Silver',
  `dtInventoryDate` datetime NOT NULL,
  `iWeight` decimal(10,2) NOT NULL,
  `iType` enum('1','2') NOT NULL DEFAULT '1' COMMENT '1=>In\r\n2=>Out',
  `iCustomerID` int(11) NOT NULL,
  `iStatus` enum('0','1','2') NOT NULL DEFAULT '1' COMMENT '0=>Inactive\r\n1=>Active\r\n2=>Delete',
  `iTouch` decimal(10,2) DEFAULT NULL,
  `iInput` decimal(10,2) DEFAULT NULL,
  `iWastage` decimal(10,2) DEFAULT NULL,
  `iFinalGrams` decimal(10,2) DEFAULT NULL,
  `dtCreatedOn` datetime NOT NULL,
  `dtModifiedOn` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`iCustomerID`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`iID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `iCustomerID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `iID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
