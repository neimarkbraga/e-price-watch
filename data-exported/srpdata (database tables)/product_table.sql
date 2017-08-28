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
-- Table structure for table `product_table`
--

CREATE TABLE IF NOT EXISTS `product_table` (
`ID` int(11) NOT NULL,
  `NAME` varchar(60) NOT NULL,
  `DESCRIPTION` text NOT NULL,
  `DATECREATED` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `SRP` double NOT NULL,
  `CATEGORY` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `product_table`
--

INSERT INTO `product_table` (`ID`, `NAME`, `DESCRIPTION`, `DATECREATED`, `SRP`, `CATEGORY`) VALUES
(12, 'Dressed Chicken', 'chicken', '2016-03-15 08:34:55', 100, 27),
(13, 'asdasd', 'asdas', '2016-03-15 12:27:49', 213, 28),
(14, 'asd', 'asdsd', '2016-03-15 12:28:02', 122, 28),
(15, 'asd', 'asdsd', '2016-03-15 14:10:52', 21, 28),
(16, 'hehef', 'hohoasd', '2016-03-21 13:44:26', 2342, 53),
(20, 'iPhone 6', 'iPhone', '2016-03-22 17:13:21', 14000, 95),
(24, 'qwe', 'qwqwe', '2016-04-06 03:58:18', 234234, 27),
(31, 'asfasf', 'sdf', '2016-04-06 14:26:27', 2332, 27);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product_table`
--
ALTER TABLE `product_table`
 ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product_table`
--
ALTER TABLE `product_table`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
