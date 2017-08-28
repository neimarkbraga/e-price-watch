-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2017 at 08:38 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `srpdata`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_us`
--

CREATE TABLE `about_us` (
  `ID` int(11) NOT NULL,
  `DESCRIPTION` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `about_us`
--

INSERT INTO `about_us` (`ID`, `DESCRIPTION`) VALUES
(1, 'aaksdas\r\ndasda\r\nsdas\r\nd\r\nasd\r\nasd');

-- --------------------------------------------------------

--
-- Table structure for table `admin_account`
--

CREATE TABLE `admin_account` (
  `ID` int(11) NOT NULL,
  `USERNAME` varchar(30) NOT NULL,
  `PASSWORD` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_account`
--

INSERT INTO `admin_account` (`ID`, `USERNAME`, `PASSWORD`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `ID` int(11) NOT NULL,
  `EMAIL` text NOT NULL,
  `ADDRESS` text NOT NULL,
  `CONTACT` text NOT NULL,
  `FACEBOOK` text NOT NULL,
  `INSTAGRAM` text NOT NULL,
  `TWITTER` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`ID`, `EMAIL`, `ADDRESS`, `CONTACT`, `FACEBOOK`, `INSTAGRAM`, `TWITTER`) VALUES
(1, 'consumerguide2016@gmail.com', 'Lapaz, Iloilo City, Philippines', '0975676122, 0912345678', 'E-PriceWatch', 'E-PriceWatch', 'E-PriceWatch');

-- --------------------------------------------------------

--
-- Table structure for table `encoded_products`
--

CREATE TABLE `encoded_products` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Table structure for table `price_history`
--

CREATE TABLE `price_history` (
  `ID` int(11) NOT NULL,
  `ENCODED_ID` int(11) NOT NULL,
  `PRICE` double NOT NULL,
  `DATECREATED` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(30) NOT NULL,
  `DESCRIPTION` text NOT NULL,
  `CONSTANT` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`ID`, `NAME`, `DESCRIPTION`, `CONSTANT`) VALUES
(27, 'Poultry', 'poultry', 0),
(28, 'Seafoods', 'seafoods', 0),
(53, 'Pizza', 'I love pizza', 0),
(77, 'Health & Beauty', 'For appearnace and health products', 0),
(92, 'Box', 'Boxes', 0),
(95, 'Gadget', 'I love Gadgets!', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_table`
--

CREATE TABLE `product_table` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(60) NOT NULL,
  `DESCRIPTION` text NOT NULL,
  `DATECREATED` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `SRP` double NOT NULL,
  `CATEGORY` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Table structure for table `user_account`
--

CREATE TABLE `user_account` (
  `ID` int(11) NOT NULL,
  `USERNAME` varchar(30) NOT NULL,
  `PASSWORD` varchar(30) NOT NULL,
  `NAME` varchar(60) NOT NULL,
  `EMAIL` varchar(60) NOT NULL,
  `DATECREATED` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_account`
--

INSERT INTO `user_account` (`ID`, `USERNAME`, `PASSWORD`, `NAME`, `EMAIL`, `DATECREATED`) VALUES
(1, 'neimark', 'admin123', 'Neimark', 'neimarkbraga@gmail.com', '2016-03-15 12:34:53'),
(2, 'member', 'member', 'Member', 'email@yahoo.com', '2016-03-23 01:33:02'),
(3, 'asd', 'W3EnpVLCmx', 'asd', 'asdas@asd', '2016-03-23 17:03:08'),
(14, 'neimark1', 'xpjXQ8sjda', 'MyName', 'neimarkbraga11@gmail.com', '2016-03-23 17:42:57'),
(15, 'Nicole', '89tjCSoYHX', 'Nicole Braga', 'braganicole96@yahoo.com', '2016-03-24 13:04:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_us`
--
ALTER TABLE `about_us`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `admin_account`
--
ALTER TABLE `admin_account`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `encoded_products`
--
ALTER TABLE `encoded_products`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `price_history`
--
ALTER TABLE `price_history`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `product_table`
--
ALTER TABLE `product_table`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user_account`
--
ALTER TABLE `user_account`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_us`
--
ALTER TABLE `about_us`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `admin_account`
--
ALTER TABLE `admin_account`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `encoded_products`
--
ALTER TABLE `encoded_products`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `price_history`
--
ALTER TABLE `price_history`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;
--
-- AUTO_INCREMENT for table `product_table`
--
ALTER TABLE `product_table`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `user_account`
--
ALTER TABLE `user_account`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
