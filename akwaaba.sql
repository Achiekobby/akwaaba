-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 31, 2023 at 10:07 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `akwaaba`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bill`
--

CREATE TABLE `tbl_bill` (
  `bid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `meter_number` varchar(255) DEFAULT NULL,
  `opening` varchar(255) DEFAULT NULL,
  `closing` varchar(255) DEFAULT NULL,
  `variance` varchar(255) DEFAULT NULL,
  `serial_number` varchar(255) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_bill`
--

INSERT INTO `tbl_bill` (`bid`, `pid`, `meter_number`, `opening`, `closing`, `variance`, `serial_number`, `quantity`, `created_at`) VALUES
(13, 12, '12', '30000', '50000', '20000', '12013342', '23452346', '2023-07-26 17:23:17'),
(14, 13, '7', '200000', '499995', '299995', '13013709', '234523453', '2023-07-26 18:58:20'),
(15, 9, '11', '343535', '353535', '10000', '9103734', '23245', '2023-07-26 19:10:33'),
(16, 9, '11', '343535', '353535', '10000', '9103734', '23245', '2023-07-26 19:20:35'),
(17, 14, '3', '104178518', '104232518', '54000', '14072755', '54000', '2023-07-26 19:28:12'),
(18, 15, '11', '28000', '10000', '-18000', '15074751', '18000', '2023-07-26 19:48:02'),
(19, 16, '3', '104178518', '104232518', '54000', '16104842', '54000', '2023-07-27 22:48:54'),
(20, 16, '3', '104178518', '104232518', '54000', '16104842', '54000', '2023-07-27 23:04:08'),
(21, 16, '3', '104178518', '104232518', '54000', '16104842', '54000', '2023-07-28 10:43:10'),
(22, 16, '3', '104178518', '104232518', '54000', '16104842', '54000', '2023-07-28 11:03:44'),
(23, 16, '3', '104178518', '104232518', '54000', '16104842', '54000', '2023-07-28 11:04:53'),
(24, 16, '3', '104178518', '104232518', '54000', '16104842', '54000', '2023-07-28 13:34:54'),
(25, 16, '3', '104178518', '104232518', '54000', '16104842', '54000', '2023-07-28 13:41:29'),
(26, 17, '16', '104178518', '104232518', '54000', '17121426', '54000', '2023-07-30 12:15:20'),
(27, 18, '17', '104178518', '104232518', '54000', '18122516', '54000', '2023-07-30 12:25:26'),
(28, 18, '17', '104178518', '104232518', '54000', '18122516', '54000', '2023-07-30 12:35:32'),
(29, 18, '17', '104178518', '104232518', '54000', '18122516', '54000', '2023-07-30 13:54:59'),
(30, 19, '25', '104178518', '104232518', '54000', '19015825', '54000', '2023-07-30 13:58:32'),
(31, 19, '25', '104178518', '104232518', '54000', '19015825', '54000', '2023-07-30 13:59:21'),
(32, 18, '17', '104178518', '104232518', '54000', '18122516', '54000', '2023-07-30 14:13:02'),
(33, 20, '24', '104178518', '104323519', '145001', '20021808', '54000', '2023-07-30 14:18:15'),
(34, 20, '24', '104178518', '104323519', '145001', '20021808', '54000', '2023-07-30 14:27:14'),
(35, 20, '24', '104178518', '104323519', '145001', '20021808', '54000', '2023-07-30 14:28:19'),
(36, 20, '24', '104178518', '104323519', '145001', '20021808', '54000', '2023-07-30 14:36:08'),
(37, 20, '24', '104178518', '104323519', '145001', '20021808', '54000', '2023-07-30 15:05:11'),
(38, 20, '24', '104178518', '104323519', '145001', '20021808', '54000', '2023-07-30 15:05:38'),
(39, 20, '24', '104178518', '104323519', '145001', '20021808', '54000', '2023-07-30 15:06:23'),
(40, 20, '24', '104178518', '104323519', '145001', '20021808', '54000', '2023-07-30 17:02:38'),
(41, 20, '24', '104178518', '104323519', '145001', '20021808', '54000', '2023-07-30 20:51:54'),
(42, 20, '24', '104178518', '104323518', '145000', '20021808', '54000', '2023-07-30 20:53:36'),
(43, 20, '24', '104178518', '104323518', '145000', '20021808', '54000', '2023-07-30 20:54:37'),
(44, 20, '24', '104178518', '104323518', '145000', '20021808', '54000', '2023-07-30 21:04:24'),
(45, 20, '24', '104178518', '104323518', '145000', '20021808', '54000', '2023-07-30 21:06:33');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brv`
--

CREATE TABLE `tbl_brv` (
  `brvid` int(11) NOT NULL,
  `brvcategory` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_brv`
--

INSERT INTO `tbl_brv` (`brvid`, `brvcategory`) VALUES
(15, 'BRV 54000');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_consignor`
--

CREATE TABLE `tbl_consignor` (
  `conid` int(11) NOT NULL,
  `consignor` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `city` varchar(200) NOT NULL,
  `contact` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_consignor`
--

INSERT INTO `tbl_consignor` (`conid`, `consignor`, `address`, `city`, `contact`, `email`) VALUES
(1, 'RHODEL IT CONSULT', 'P.O. BOX 13322', 'TEMA', '+23313456789', 'info@rhodelit.com'),
(2, 'AKWAABA OIL REFINERY', 'P.O. BOX 13322', 'TEMA', '+233231465789', 'akwaabalinkgh@gmail.com'),
(4, 'MCDAN', 'P.O. BOX 13322', 'KUMASI', '+233557700916', 'info@mccdan.com'),
(5, 'GOIL', 'P.O. BOX 13322', 'BOLGA', '+233235698785', 'goil@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `cusid` int(11) NOT NULL,
  `customer` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `city` varchar(200) NOT NULL,
  `contact` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`cusid`, `customer`, `address`, `city`, `contact`, `email`) VALUES
(7, 'GB OIL LIMITED ', 'ACCRA NORTH', 'ACCRA', '10123456789', 'gb@gmail.com'),
(9, 'JP TRUSTEES LTD', 'TEMA EAST', 'TEMA', '40123456789', 'jp@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_meter`
--

CREATE TABLE `tbl_meter` (
  `metid` int(11) NOT NULL,
  `meter` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_meter`
--

INSERT INTO `tbl_meter` (`metid`, `meter`) VALUES
(16, 'Meter 1'),
(17, 'Meter 2'),
(18, 'Meter 3'),
(19, 'Meter 4'),
(20, 'Meter 5'),
(21, 'Meter 6'),
(22, 'Meter 7'),
(23, 'Meter 8'),
(24, 'Meter 9'),
(25, 'Meter 10');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `pid` int(11) NOT NULL,
  `product` varchar(200) NOT NULL,
  `category` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `volume` varchar(200) NOT NULL,
  `opening` varchar(255) DEFAULT NULL,
  `closing` varchar(255) DEFAULT NULL,
  `unit_number` varchar(255) DEFAULT NULL,
  `meter` varchar(255) DEFAULT NULL,
  `destination` varchar(255) DEFAULT NULL,
  `driver` varchar(255) DEFAULT NULL,
  `truck_header_number` varchar(255) DEFAULT NULL,
  `truck_trailer_number` varchar(255) DEFAULT NULL,
  `customer` varchar(255) DEFAULT NULL,
  `order_type` varchar(255) NOT NULL DEFAULT 'Domestic',
  `created_at` datetime NOT NULL,
  `barcode` varchar(255) DEFAULT NULL,
  `consignor` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`pid`, `product`, `category`, `description`, `volume`, `opening`, `closing`, `unit_number`, `meter`, `destination`, `driver`, `truck_header_number`, `truck_trailer_number`, `customer`, `order_type`, `created_at`, `barcode`, `consignor`) VALUES
(9, 'Test Product', '15', 'Testing', '23245', '343535', '353535', '123456', '24', 'Accra', 'Jane Doe', 'AS-3434-55', 'BV-34566-56', '7', 'Domestic', '2023-07-24 00:37:34', '9103734', '1'),
(16, 'RFO', '15', 'RFO', '54000', '104178518', '104232518', '#', '20', 'VALCO', 'THOMAS ASANTE', 'AS 8604-14', 'AS 8604-14', '7', 'Domestic', '2023-07-27 22:48:42', '16104842', '2'),
(17, 'RFO', '15', 'RFO', '54000', '104178518', '104232518', '#', '16', 'TEMA', 'THOMAS ASANTE', 'AS-8604-14', 'AS-8604-14', '7', 'Domestic', '2023-07-30 12:14:26', '17121426', '2'),
(18, 'NAPHTHA', '15', 'NAPHTHA', '54000', '104178518', '104232518', '#', '17', 'HO', 'THOMAS ASANTE', 'AS-8604-14', 'AS-8604-14', '7', 'Domestic', '2023-07-30 12:25:16', '18122516', '2'),
(19, 'AGO', '15', 'AGO', '54000', '104178518', '104232518', '#', '25', 'KOKOMLEMLE', 'THOMAS ASNATE OHENE', 'AS-8604-14', 'AS-8604-14', '7', 'Domestic', '2023-07-30 13:58:25', '19015825', '2'),
(20, 'NAPHTHA', '15', 'NAPHTHA', '54000', '104178518', '104323518', '#', '24', 'TEMA', 'DELALI', 'AS-8604-14', 'AS-8604-14', '9', 'Domestic', '2023-07-30 14:18:08', '20021808', '2');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_productlist`
--

CREATE TABLE `tbl_productlist` (
  `prolid` int(11) NOT NULL,
  `productlist` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_productlist`
--

INSERT INTO `tbl_productlist` (`prolid`, `productlist`) VALUES
(1, 'RFO'),
(2, 'AGO'),
(3, 'NAPHTHA');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `userid` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `useremail` varchar(200) NOT NULL,
  `userpassword` varchar(200) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`userid`, `username`, `useremail`, `userpassword`, `role`) VALUES
(1, 'admin', 'admin@example.com', '12345', 'Admin'),
(2, 'user', 'user@gmail.com', '123', 'User'),
(16, 'test', 'test@gmail.com', '123', 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_bill`
--
ALTER TABLE `tbl_bill`
  ADD PRIMARY KEY (`bid`);

--
-- Indexes for table `tbl_brv`
--
ALTER TABLE `tbl_brv`
  ADD PRIMARY KEY (`brvid`);

--
-- Indexes for table `tbl_consignor`
--
ALTER TABLE `tbl_consignor`
  ADD PRIMARY KEY (`conid`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`cusid`);

--
-- Indexes for table `tbl_meter`
--
ALTER TABLE `tbl_meter`
  ADD PRIMARY KEY (`metid`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `tbl_productlist`
--
ALTER TABLE `tbl_productlist`
  ADD PRIMARY KEY (`prolid`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_bill`
--
ALTER TABLE `tbl_bill`
  MODIFY `bid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `tbl_brv`
--
ALTER TABLE `tbl_brv`
  MODIFY `brvid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_consignor`
--
ALTER TABLE `tbl_consignor`
  MODIFY `conid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `cusid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_meter`
--
ALTER TABLE `tbl_meter`
  MODIFY `metid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_productlist`
--
ALTER TABLE `tbl_productlist`
  MODIFY `prolid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
