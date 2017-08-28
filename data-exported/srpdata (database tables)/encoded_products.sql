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
-- Table structure for table `encoded_products`
--

CREATE TABLE IF NOT EXISTS `encoded_products` (
`ID` int(11) NOT NULL,
  `PRODUCT` int(11) NOT NULL,
  `STORENAME` varchar(120) NOT NULL,
  `ADDRESS` varchar(210) NOT NULL,
  `LAT` double NOT NULL,
  `LNG` double NOT NULL,
  `POSTBY` int(11) NOT NULL,
  `PRICE` double NOT NULL,
  `DATECREATED` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DISABLED` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `encoded_products`
--

INSERT INTO `encoded_products` (`ID`, `PRODUCT`, `STORENAME`, `ADDRESS`, `LAT`, `LNG`, `POSTBY`, `PRICE`, `DATECREATED`, `DISABLED`) VALUES
(16, 16, 'MyStores', 'Guadalupe, Cebu City, Cebu, Philippines', 10.3156992, 123.88543660000005, 1, 1400, '2016-04-13 10:43:09', 0),
(19, 12, 'fsfsd', 'Guadalupe, Cebu City, Cebu, Philippines', 10.3156992, 123.88543660000005, 1, 541, '2016-03-22 15:02:48', 0),
(20, 20, 'Samsung', 'Buhang Taft North, Mandurriao, Iloilo City, Iloilo, Philippines', 10.7141404, 122.55108970000003, 1, 14100, '2016-03-22 17:14:32', 1),
(21, 20, 'Samsung', 'Buhang Taft North, Mandurriao, Iloilo City, Iloilo, Philippines', 10.7141404, 122.55108970000003, 1, 14001, '2016-03-23 01:18:45', 1),
(22, 20, 'Samsung', 'San Isidro, Jaro, Iloilo City, Iloilo, Philippines', 10.732483799999999, 122.54818169999999, 2, 14050, '2016-03-23 01:34:29', 0),
(23, 20, 'Samsung', 'Buhang Taft North, Mandurriao, Iloilo City, Iloilo, Philippines', 10.714171607946858, 122.55106832832098, 1, 13500, '2016-03-24 10:40:14', 1),
(24, 13, 'Samsung', 'Buhang Taft North, Mandurriao, Iloilo City, Iloilo, Philippines', 10.714510263036914, 122.5509063899517, 1, 123, '2016-03-24 10:51:38', 0),
(25, 20, 'Borjok Store', 'Barotac Nuevo, Iloilo, Philippines', 10.8891662, 122.69743549999998, 1, 12300, '2016-04-13 10:51:47', 0),
(26, 20, 'Borjok Store', 'Barotac Nuevo, Iloilo, Philippines', 10.8891659, 122.69743540000002, 1, 12000, '2016-03-24 11:53:19', 1),
(27, 24, 'asdasdd', 'Ungka, Jaro, Iloilo City, Iloilo, Philippines', 10.745093076023137, 122.53994822502136, 1, 300, '2016-04-06 04:01:17', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `encoded_products`
--
ALTER TABLE `encoded_products`
 ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `encoded_products`
--
ALTER TABLE `encoded_products`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
