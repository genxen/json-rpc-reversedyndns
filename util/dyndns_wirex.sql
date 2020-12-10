-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 28, 2020 at 07:50 AM
-- Server version: 5.6.42
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dyndns_wirex`
--

-- --------------------------------------------------------

--
-- Table structure for table `msisdnIndex`
--

CREATE TABLE IF NOT EXISTS `msisdnIndex` (
  `id` int(11) NOT NULL,
  `iccid` varchar(30) NOT NULL,
  `msisdn` varchar(20) NOT NULL,
  `customer` text
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `msisdnIndex`
--

INSERT INTO `msisdnIndex` (`id`, `iccid`, `msisdn`, `customer`) VALUES
(8, '8933209517036730725', '556127784', 'TEST FABRICE'),
(10, '8933209516027350659', '761867434', 'KLATENCOR2 EU PA:KLATENCOR'),
(11, '8933209517036729966', '667009909', 'KLATENCOR1 EU PA:KLATENCOR2'),
(15, '8933209515019524420', '669004967', 'KLA04 EU PA:KLATENCOR_POC'),
(16, '8933209516025039528', '761485788', 'KLA03 EU PA:KLATENCOR_POC'),
(18, '8933209514015722971', '666424754', 'KLA05 US PA:KLATENCOR_POC'),
(19, '8933209515019524412', '668992882', 'Test GN'),
(20, 'TEST_SIP_1', '986877477', 'ASTERISK');

-- --------------------------------------------------------

--
-- Table structure for table `wirexID`
--

CREATE TABLE IF NOT EXISTS `wirexID` (
  `id` int(11) NOT NULL,
  `iccid` varchar(30) NOT NULL,
  `ip_addr` text NOT NULL,
  `last_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=8736 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wirexID`
--

INSERT INTO `wirexID` (`id`, `iccid`, `ip_addr`, `last_modified`) VALUES
(18, '8933209516027350659', '10.2.0.34', '2019-08-22 13:49:37'),
(19, '8933209517036729966', '10.2.0.35', '2019-05-27 03:33:53'),
(22, '8933209516025039528', '10.6.0.37', '2019-05-09 07:55:55'),
(23, '8933209515019524420', '10.2.0.35', '2019-05-24 08:20:53'),
(175, '8933209515019524412', '10.3.0.44', '2019-05-24 07:04:39'),
(176, '8933209514015722971', '10.2.0.38', '2019-07-29 23:19:23'),
(8735, 'TEST_SIP_1', '192.168.200.159', '2019-08-21 14:59:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `msisdnIndex`
--
ALTER TABLE `msisdnIndex`
  ADD PRIMARY KEY (`id`),
  ADD KEY `msisdn` (`msisdn`),
  ADD KEY `iccid` (`iccid`);

--
-- Indexes for table `wirexID`
--
ALTER TABLE `wirexID`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `iccid` (`iccid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `msisdnIndex`
--
ALTER TABLE `msisdnIndex`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `wirexID`
--
ALTER TABLE `wirexID`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8736;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `wirexID`
--
ALTER TABLE `wirexID`
  ADD CONSTRAINT `FK_Iccid` FOREIGN KEY (`iccid`) REFERENCES `msisdnIndex` (`iccid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
