-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Jan 20, 2016 at 09:00 AM
-- Server version: 5.5.42
-- PHP Version: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `WBDAssignmentProper`
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `make` varchar(32) NOT NULL,
  `model` varchar(32) NOT NULL,
  `name` varchar(32) NOT NULL,
  `price` decimal(7,2) NOT NULL,
  `qtyAvailable` int(11) NOT NULL,
  `description` text NOT NULL,
  `tags` text NOT NULL,
  `warrantyID` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `make`, `model`, `name`, `price`, `qtyAvailable`, `description`, `tags`, `warrantyID`) VALUES
(1, 'Philips', '666', 'Philips 666', '666.66', 666, 'Philips 666 Cooker', 'White Goods, Cooker', 3),
(2, 'Philips', '888', 'Philips 888', '888.88', 888, 'Philips 888 Cooker', 'White Goods, Cooker', 3),
(3, 'Philips', '777', 'Philips 777', '777.77', 777, 'Philips 777 Cooker', 'White Goods, Cooker', 3),
(4, 'Zanussi', '867', 'Zanussi 867', '867.99', 867, 'Zanussi 867 Microwave', 'White Goods, Microwave', 2),
(5, 'Zanussi', '999', 'Zanussi 999', '999.99', 999, 'Zanussi 999 Washing Machine', 'White Goods, Washing Machine', 3),
(6, 'Zanussi', '999', 'Zanussi 999', '999.99', 999, 'Zanussi 999 Washing Machine', 'White Goods, Washing Machine', 3),
(7, 'Zanussi', '999', 'Zanussi 999', '999.99', 999, 'Zanussi 999 Washing Machine', 'White Goods, Washing Machine', 3),
(8, 'Zanussi', '999', 'Zanussi 999', '999.99', 999, 'Zanussi 999 Washing Machine', 'White Goods, Washing Machine', 3),
(9, 'Zanussi', '999', 'Zanussi 999', '999.99', 999, 'Zanussi 999 Washing Machine', 'White Goods, Washing Machine', 3),
(10, 'Zanussi', '999', 'Zanussi 999', '999.99', 999, 'Zanussi 999 Washing Machine', 'White Goods, Washing Machine', 3),
(11, 'Zanussi', '999', 'Zanussi 999', '999.99', 999, 'Zanussi 999 Washing Machine', 'White Goods, Washing Machine', 3),
(12, 'Zanussi', '999', 'Zanussi 999', '999.99', 999, 'Zanussi 999 Washing Machine', 'White Goods, Washing Machine', 3),
(13, 'Zanussi', '999', 'Zanussi 999', '999.99', 999, 'Zanussi 999 Washing Machine', 'White Goods, Washing Machine', 3),
(14, 'Zanussi', '999', 'Zanussi 999', '999.99', 999, 'Zanussi 999 Washing Machine', 'White Goods, Washing Machine', 3),
(15, 'Zanussi', '999', 'Zanussi 999', '999.99', 999, 'Zanussi 999 Washing Machine', 'White Goods, Washing Machine', 3),
(16, 'Zanussi', '999', 'Zanussi 999', '999.99', 999, 'Zanussi 999 Washing Machine', 'White Goods, Washing Machine', 3),
(17, 'Zanussi', '999', 'Zanussi 999', '999.99', 999, 'Zanussi 999 Washing Machine', 'White Goods, Washing Machine', 3),
(18, 'Zanussi', '999', 'Zanussi 999', '999.99', 999, 'Zanussi 999 Washing Machine', 'White Goods, Washing Machine', 3),
(19, 'Zanussi', '999', 'Zanussi 999', '999.99', 999, 'Zanussi 999 Washing Machine', 'White Goods, Washing Machine', 3),
(20, 'Darren', 'Howlett', 'Darren Howlett', '1.99', 1, 'Darren Howlett', 'White Goods, Microwave, Gardening Equipment, Strimmer', 3),
(21, 'Lesley', 'Evans', 'Lesley Evans', '2.99', 2, 'Lesley Evans', 'White Goods, Chest Freezer, Cooker, Dishwasher, Freezer, Fridge Freezer, Fridge, Microwave, Washing Machine, Gardening Equipment, Cultivator, Electric Tool, Hedge Trimmer, Lawn Mower, Manual Tools, Ride On Mower, Strimmer', 3);

-- --------------------------------------------------------

--
-- Table structure for table `productPhoto`
--

CREATE TABLE `productPhoto` (
  `id` int(11) NOT NULL,
  `fileName` varchar(255) NOT NULL,
  `fileType` varchar(64) NOT NULL,
  `fileSize` int(11) NOT NULL,
  `fileLocation` varchar(255) NOT NULL,
  `productPhotoName` varchar(255) NOT NULL,
  `masterPhoto` int(11) NOT NULL DEFAULT '0',
  `productID` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `productPhoto`
--

INSERT INTO `productPhoto` (`id`, `fileName`, `fileType`, `fileSize`, `fileLocation`, `productPhotoName`, `masterPhoto`, `productID`) VALUES
(1, 'beko_wmb71543w_wh_04.jpg', 'image/jpeg', 128322, '../pics/products/microwave/beko_wmb71543w_wh_04.jpg', 'Zanussi 867 Microwave', 1, 0),
(2, 'bosch_sms50t22gb_wh_01.jpg', 'image/jpeg', 54372, '../pics/products/chestFreezer/bosch_sms50t22gb_wh_01.jpg', 'Lesley Evans 21', 1, 0),
(3, 'bosch_sms50t22gb_wh_01.jpg', 'image/jpeg', 54372, '../pics/products/chestFreezer/bosch_sms50t22gb_wh_01.jpg', 'Lesley Evans 21', 1, 0),
(4, 'bosch_sms50t22gb_wh_01.jpg', 'image/jpeg', 54372, '../pics/products/chestFreezer/bosch_sms50t22gb_wh_01.jpg', 'Lesley Evans 21', 1, 0),
(5, 'bosch_sms50t22gb_wh_01.jpg', 'image/jpeg', 54372, '../pics/products/chestFreezer/bosch_sms50t22gb_wh_01.jpg', 'Lesley Evans 21', 1, 0),
(6, 'bosch_sms50t22gb_wh_01.jpg', 'image/jpeg', 54372, '../pics/products/chestFreezer/bosch_sms50t22gb_wh_01.jpg', 'Lesley Evans 21', 1, 0),
(7, 'bosch_sms50t22gb_wh_01.jpg', 'image/jpeg', 54372, '../pics/products/chestFreezer/bosch_sms50t22gb_wh_01.jpg', 'Lesley Evans 21', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `productWarranty`
--

CREATE TABLE `productWarranty` (
  `id` int(11) NOT NULL,
  `warrantyLength` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `productWarranty`
--

INSERT INTO `productWarranty` (`id`, `warrantyLength`) VALUES
(1, 0),
(2, 3),
(3, 6);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `title` varchar(16) NOT NULL,
  `forename` varchar(32) NOT NULL,
  `surname` varchar(32) NOT NULL,
  `firstLineAddress` varchar(64) NOT NULL,
  `secondLineAddress` varchar(64) NOT NULL,
  `town` varchar(64) NOT NULL,
  `county` varchar(64) NOT NULL,
  `postcode` varchar(8) NOT NULL,
  `phone` varchar(16) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `accessLevel` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `title`, `forename`, `surname`, `firstLineAddress`, `secondLineAddress`, `town`, `county`, `postcode`, `phone`, `email`, `password`, `accessLevel`) VALUES
(3, 'Mr', 'Darren', 'Howlett', '44 Lethaby Road', '', 'Barnstaple', 'Devon', 'EX32 7HQ', '01271593958', 'darrenhowlett@hotmail.com', '$2y$10$ikR4MErHwSoKUIKoG.4Q8eJoNSBodf62nOi.TxsofHVQlFwRTiW3a', 1),
(4, 'Mr', 'Darren', 'Howlett', '47 Lethaby Road', '', 'Exeter', 'Devon', 'EX32 7HQ', '07522840961', 'godisdjh@hotmail.com', '$2y$10$cBN5z9M6uHPKkAc1HIhmHu1TtIj0tt5KaqBgFy9gp4Xv8fqJcbiYu', 1);

-- --------------------------------------------------------

--
-- Table structure for table `userOrder`
--

CREATE TABLE `userOrder` (
  `id` int(11) NOT NULL,
  `orderNumber` int(11) NOT NULL,
  `orderDate` int(11) NOT NULL,
  `subTotal` decimal(7,2) NOT NULL,
  `vat` decimal(7,2) NOT NULL,
  `total` decimal(7,2) NOT NULL,
  `paymentType` varchar(32) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `userOrderLine`
--

CREATE TABLE `userOrderLine` (
  `id` int(11) NOT NULL,
  `qtyOrdered` int(11) NOT NULL,
  `orderLineTotal` decimal(7,2) NOT NULL,
  `orderID` int(11) NOT NULL,
  `productID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productPhoto`
--
ALTER TABLE `productPhoto`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productWarranty`
--
ALTER TABLE `productWarranty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userOrder`
--
ALTER TABLE `userOrder`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userOrderLine`
--
ALTER TABLE `userOrderLine`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `productPhoto`
--
ALTER TABLE `productPhoto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `productWarranty`
--
ALTER TABLE `productWarranty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `userOrder`
--
ALTER TABLE `userOrder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `userOrderLine`
--
ALTER TABLE `userOrderLine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
