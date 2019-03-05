-- phpMyAdmin SQL Dump
-- version 4.2.9
-- http://www.phpmyadmin.net
--
-- Host: putter.vuw.leidenuniv.nl:3306
-- Generation Time: Feb 16, 2018 at 09:10 AM
-- Server version: 5.5.58-log
-- PHP Version: 5.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `takesfw`
--

-- --------------------------------------------------------

--
-- Table structure for table `methods`
--

CREATE TABLE IF NOT EXISTS `methods` (
  `methodId` int(11) NOT NULL,
  `methodName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `methods`
--

INSERT INTO `methods` (`methodId`, `methodName`) VALUES
(10, 'GameCard1'),
(20, 'Wallet0'),
(30, 'InstantBankTransfer1'),
(40, 'GameCard3'),
(50, 'InstantBankTransfer2'),
(60, 'InstantBankTransfer3'),
(61, 'InstantBankTransfer5'),
(80, 'InstantBankTransfer6'),
(90, 'GameCard4'),
(100, 'GameCard5'),
(110, 'InstantBankTransfer7'),
(120, 'InstantBankTransfer8'),
(130, 'Wallet1'),
(131, 'CreditCard1'),
(132, 'CreditCard2'),
(133, 'CreditCard3'),
(134, 'CreditCard4'),
(135, 'CreditCard5'),
(136, 'CreditCard6'),
(137, 'CreditCard7'),
(138, 'CreditCard8'),
(139, 'BankTransfer1'),
(140, 'BankTransfer2'),
(141, 'CreditCard9'),
(142, 'CreditCard10'),
(143, 'CreditCard11'),
(145, 'BankTransfer4'),
(170, 'BankTransfer8'),
(205, 'BankTransfer10'),
(1000, 'MobilePhoneSMS1'),
(1010, 'MobilePhoneCall'),
(2000, 'LandlinePhone'),
(2010, 'MobilePhoneSMS2'),
(2050, 'MobilePhoneSMS2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `methods`
--
ALTER TABLE `methods`
 ADD PRIMARY KEY (`methodId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
