-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2016 at 04:49 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `srpdata`
--

-- --------------------------------------------------------

--
-- Table structure for table `price_history`
--

CREATE TABLE IF NOT EXISTS `price_history` (
`ID` int(11) NOT NULL,
  `ENCODED_ID` int(11) NOT NULL,
  `PRICE` double NOT NULL,
  `DATECREATED` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `price_history`
--

INSERT INTO `price_history` (`ID`, `ENCODED_ID`, `PRICE`, `DATECREATED`) VALUES
(1, 16, 900, '2016-04-13 10:09:20'),
(2, 16, 1200, '2016-04-13 10:10:04'),
(3, 16, 800, '2016-04-13 10:38:29'),
(5, 16, 1300, '2016-04-13 10:40:23'),
(7, 25, 14500, '2016-03-24 11:52:50'),
(8, 25, 15000, '2016-04-13 10:49:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `price_history`
--
ALTER TABLE `price_history`
 ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `price_history`
--
ALTER TABLE `price_history`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
