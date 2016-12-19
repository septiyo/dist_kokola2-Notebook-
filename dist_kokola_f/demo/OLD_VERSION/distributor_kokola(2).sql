-- phpMyAdmin SQL Dump
-- version 4.4.14.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 11, 2016 at 10:03 AM
-- Server version: 5.5.25a
-- PHP Version: 5.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `distributor_kokola`
--

-- --------------------------------------------------------

--
-- Table structure for table `forecast`
--

CREATE TABLE IF NOT EXISTS `forecast` (
  `ID` int(10) NOT NULL,
  `TRIWULAN` varchar(100) DEFAULT NULL,
  `DIST` varchar(100) DEFAULT NULL,
  `TRI_BLN1` varchar(100) DEFAULT NULL,
  `TRI_BLN2` varchar(100) DEFAULT NULL,
  `TRI_BLN3` varchar(100) DEFAULT NULL,
  `P1_BLN1` varchar(100) DEFAULT NULL,
  `P2_BLN1` varchar(100) DEFAULT NULL,
  `P3_BLN1` varchar(100) DEFAULT NULL,
  `P4_BLN1` varchar(100) DEFAULT NULL,
  `P5_BLN1` varchar(100) DEFAULT NULL,
  `P1_BLN2` varchar(100) DEFAULT NULL,
  `P2_BLN2` varchar(100) DEFAULT NULL,
  `P3_BLN2` varchar(100) DEFAULT NULL,
  `P4_BLN2` varchar(100) DEFAULT NULL,
  `P5_BLN2` varchar(100) DEFAULT NULL,
  `P1_BLN3` varchar(100) DEFAULT NULL,
  `P2_BLN3` varchar(100) DEFAULT NULL,
  `P3_BLN3` varchar(100) DEFAULT NULL,
  `P4_BLN3` varchar(100) DEFAULT NULL,
  `P5_BLN3` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forecast`
--

INSERT INTO `forecast` (`ID`, `TRIWULAN`, `DIST`, `TRI_BLN1`, `TRI_BLN2`, `TRI_BLN3`, `P1_BLN1`, `P2_BLN1`, `P3_BLN1`, `P4_BLN1`, `P5_BLN1`, `P1_BLN2`, `P2_BLN2`, `P3_BLN2`, `P4_BLN2`, `P5_BLN2`, `P1_BLN3`, `P2_BLN3`, `P3_BLN3`, `P4_BLN3`, `P5_BLN3`) VALUES
(7, 'Jan-Feb-Mar', 'user1', '40', '20', '40', '0', '25', '25', '25', '25', '25', '25', '25', '15', '10', '25', '25', '20', '15', '15');

-- --------------------------------------------------------

--
-- Table structure for table `kj`
--

CREATE TABLE IF NOT EXISTS `kj` (
  `ID` int(10) NOT NULL,
  `TRIWULAN` varchar(100) DEFAULT NULL,
  `NAMA_DIST` varchar(100) DEFAULT NULL,
  `DAERAH` varchar(100) DEFAULT NULL,
  `NAMA_PRODUK` varchar(200) DEFAULT NULL,
  `HARGA` int(20) DEFAULT NULL,
  `BLN_AKHIR` int(200) DEFAULT NULL,
  `FORECAST` int(20) DEFAULT NULL,
  `TOTAL_VALUE` int(20) DEFAULT NULL,
  `TRI_BLN1` varchar(100) DEFAULT NULL,
  `TRI_BLN2` varchar(100) DEFAULT NULL,
  `TRI_BLN3` varchar(100) DEFAULT NULL,
  `P1_BLN1` varchar(100) DEFAULT NULL,
  `P2_BLN1` varchar(100) DEFAULT NULL,
  `P3_BLN1` varchar(100) DEFAULT NULL,
  `P4_BLN1` varchar(100) DEFAULT NULL,
  `P5_BLN1` varchar(100) DEFAULT NULL,
  `P1_BLN2` varchar(100) DEFAULT NULL,
  `P2_BLN2` varchar(100) DEFAULT NULL,
  `P3_BLN2` varchar(100) DEFAULT NULL,
  `P4_BLN2` varchar(100) DEFAULT NULL,
  `P5_BLN2` varchar(100) DEFAULT NULL,
  `P1_BLN3` varchar(100) DEFAULT NULL,
  `P2_BLN3` varchar(100) DEFAULT NULL,
  `P3_BLN3` varchar(100) DEFAULT NULL,
  `P4_BLN3` varchar(100) DEFAULT NULL,
  `P5_BLN3` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kj`
--

INSERT INTO `kj` (`ID`, `TRIWULAN`, `NAMA_DIST`, `DAERAH`, `NAMA_PRODUK`, `HARGA`, `BLN_AKHIR`, `FORECAST`, `TOTAL_VALUE`, `TRI_BLN1`, `TRI_BLN2`, `TRI_BLN3`, `P1_BLN1`, `P2_BLN1`, `P3_BLN1`, `P4_BLN1`, `P5_BLN1`, `P1_BLN2`, `P2_BLN2`, `P3_BLN2`, `P4_BLN2`, `P5_BLN2`, `P1_BLN3`, `P2_BLN3`, `P3_BLN3`, `P4_BLN3`, `P5_BLN3`) VALUES
(16, 'Jan-Feb-Mar', 'user1', NULL, 'Hai Crackers Sweet Corn 10gr/180', 46500, 12, 293, 13624500, 'round(117.2)', 'round(58.6)', 'round(117.2)', 'round(0)', 'round(29.3)', 'round(29.3)', 'round(29.3)', 'round(29.3)', 'round(14.65)', 'round(14.65)', 'round(14.65)', 'round(8.79)', 'round(5.86)', 'round(29.3)', 'round(29.3)', 'round(23.44)', 'round(17.58)', 'round(17.58)'),
(17, 'Jan-Feb-Mar', 'user1', NULL, 'Hai Crackers Seaweed  10gr/180', 46500, 0, 770, 35805000, 'round(308)', 'round(154)', 'round(308)', 'round(0)', 'round(77)', 'round(77)', 'round(77)', 'round(77)', 'round(38.5)', 'round(38.5)', 'round(38.5)', 'round(23.1)', 'round(15.4)', 'round(77)', 'round(77)', 'round(61.6)', 'round(46.2)', 'round(46.2)'),
(18, 'Jan-Feb-Mar', 'user1', NULL, 'Hai Crackers Cheese 10gr/180', 46500, 0, 882, 41013000, 'round(352.8)', 'round(176.4)', 'round(352.8)', 'round(0)', 'round(88.2)', 'round(88.2)', 'round(88.2)', 'round(88.2)', 'round(44.1)', 'round(44.1)', 'round(44.1)', 'round(26.46)', 'round(17.64)', 'round(88.2)', 'round(88.2)', 'round(70.56)', 'round(52.92)', 'round(52.92)'),
(19, 'Jan-Feb-Mar', 'user1', NULL, 'Kukis Kelapa 300gr/18 ', 46500, 0, 2079, 96673500, 'round(831.6)', 'round(415.8)', 'round(831.6)', 'round(0)', 'round(207.9)', 'round(207.9)', 'round(207.9)', 'round(207.9)', 'round(103.95)', 'round(103.95)', 'round(103.95)', 'round(62.37)', 'round(41.58)', 'round(207.9)', 'round(207.9)', 'round(166.32)', 'round(124.74)', 'round(124.74)');

-- --------------------------------------------------------

--
-- Table structure for table `m_produk`
--

CREATE TABLE IF NOT EXISTS `m_produk` (
  `ID` int(10) NOT NULL,
  `NAMA_PRODUK` varchar(200) DEFAULT NULL,
  `SATUAN` varchar(50) DEFAULT NULL,
  `HARGA` int(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_produk`
--

INSERT INTO `m_produk` (`ID`, `NAMA_PRODUK`, `SATUAN`, `HARGA`) VALUES
(1, 'Hai Crackers Sweet Corn 10gr/180', 'Dus', 46500),
(2, 'Hai Crackers Seaweed  10gr/180', 'Dus', 46500),
(3, 'Hai Crackers Cheese 10gr/180', 'Dus', 46500),
(4, 'Kukis Kelapa 300gr/18 ', 'Dus', 46500),
(5, 'Kukis Butter 300gr/18 ', 'Dus', 46500),
(6, 'Kukis Mochacino 300gr/18 ', 'Dus', NULL),
(7, 'Kukis Susu Vanila 300gr/18 ', 'Dus', NULL),
(8, 'Kukis White Coffee 300gr/18 ', 'Dus', NULL),
(9, 'Kukis Kelapa 100gr/30 ', 'Dus', NULL),
(10, 'Kukis Butter 100gr/30 ', 'Dus', NULL),
(11, 'Kukis Mochacino 100gr/30 ', 'Dus', NULL),
(12, 'Kukis Susu Vanila 100gr/30 ', 'Dus', NULL),
(13, 'Kukis White Coffee 100gr/30 ', 'Dus', NULL),
(14, 'Kukis Kelapa 13,9gr/120 ', 'Dus', NULL),
(15, 'Kukis Butter 13,9gr/120 ', 'Dus', NULL),
(16, 'Kukis Mochacino 13,9gr/120 ', 'Dus', NULL),
(17, 'Kukis Susu Vanila 13,9gr/120 ', 'Dus', NULL),
(18, 'Kukis White Coffee 13,9gr/120 ', 'Dus', NULL),
(19, 'Kukis Kelapa 70gr/60 ', 'Dus', NULL),
(20, 'Kukis Butter 70gr/60 ', 'Dus', NULL),
(21, 'Kukis Mochacino 70gr/60 ', 'Dus', NULL),
(22, 'Kukis Susu Vanila 70gr/60 ', 'Dus', NULL),
(23, 'Kukis White Coffee 70gr/60 ', 'Dus', NULL),
(24, 'Minis Kukis Kelapa 26gr/60 ', 'Dus', NULL),
(25, 'Minis Kukis Butter 26gr/60 ', 'Dus', NULL),
(26, 'Minis Kukis Susu Vanila 26gr/60 ', 'Dus', NULL),
(27, 'Kukis n Krim Strawberry 138gr/30 ', 'Dus', NULL),
(28, 'Kukis n Krim Strawberry 30gr/72 ', 'Dus', NULL),
(29, 'Majestic Popcorn Caramel 90gr/30 ', 'Dus', NULL),
(30, 'Majestic White Coffee 90gr/30 ', 'Dus', NULL),
(31, 'Majestic Mixberry 90gr/30 ', 'Dus', NULL),
(32, 'Malkist Susu 17gr/180 ', 'Dus', NULL),
(33, 'Montego Coklat 50gr/30', 'Dus', NULL),
(34, 'Montego Danish Butter 50gr/30', 'Dus', NULL),
(35, 'Montego Orange 50gr/30', 'Dus', NULL),
(36, 'Montego Coklat 17gr/120', 'Dus', NULL),
(37, 'Montego Danish Butter 17gr/120', 'Dus', NULL),
(38, 'Montego Orange 17gr/120', 'Dus', NULL),
(39, 'Montego FUN Double Chocochips 17gr/120', 'Dus', NULL),
(40, 'Montego Gold Choco Banana 90gr/24', 'Dus', NULL),
(41, 'Montego Gold Matcha 90gr/24', 'Dus', NULL),
(42, 'Montego Gold Double Choco 90gr/24', 'Dus', NULL),
(43, 'Majorico Choco Banana 43gr/60 ', 'Dus', NULL),
(44, 'Majorico Coklat 90gr/24', 'Dus', NULL),
(45, 'Majorico Vanila 90gr/24', 'Dus', NULL),
(46, 'Rosecream Coklat Anak Sekolah 260gr/10', 'Bal', NULL),
(47, 'Rosecream Lemon Anak Sekolah 260gr/10', 'Bal', NULL),
(48, 'Rosecream Durian Anak Sekolah 260gr/10', 'Bal', NULL),
(49, 'Rosecream Pineapple Anak Sekolah 260gr/10', 'Bal', NULL),
(50, 'Narita Rosecream Lemon 200gr/21', 'Dus', NULL),
(51, 'Narita Rosecream Coklat 200gr/21', 'Dus', NULL),
(52, 'Narita Rosecream Lemon 120gr/30', 'Dus', NULL),
(53, 'Narita Rosecream Coklat 120gr/30', 'Dus', NULL),
(54, 'Super Cream Bon Bon 210gr/21', 'Dus', NULL),
(55, 'Super Cream Pineapple 210gr/21', 'Dus', NULL),
(56, 'Super Cream Strawberry 210gr/21', 'Dus', NULL),
(57, 'Super Cream Orange 210gr/21', 'Dus', NULL),
(58, 'Delicious Durian 110gr/30', 'Dus', NULL),
(59, 'Delicious Kelapa 110gr/30', 'Dus', NULL),
(60, 'Unigold Marie Kelapa 30gr/60', 'Dus', NULL),
(61, 'Creamy Pineapple 200gr/18', 'Dus', NULL),
(62, 'Creamy Cocopandan 200gr/18', 'Dus', NULL),
(63, 'Shortbread Delight 250gr/18', 'Dus', NULL),
(64, 'Orange Delight 250gr/18', 'Dus', NULL),
(65, 'Choco Delight 250gr/18', 'Dus', NULL),
(66, 'Narita Marie Susu 150gr/24', 'Dus', NULL),
(67, 'Narita Marie Susu 150gr Roll/24', 'Dus', NULL),
(68, 'Marieta 100gr/30 ', 'Dus', NULL),
(69, 'Marie Susu Madu 180gr/24', 'Dus', NULL),
(70, 'Marie Susu Madu 100gr/36', 'Dus', NULL),
(71, 'Marie Susu Madu 12gr/120', 'Dus', NULL),
(72, 'Regi Banana 28,8gr/60', 'Dus', NULL),
(73, 'Choco Sandwich 150gr/24', 'Dus', NULL),
(74, 'Litel Maxx Chocochips 45gr/24', 'Dus', NULL),
(75, 'Litel Maxx Cheese 45gr/24', 'Dus', NULL),
(76, 'Litel Maxx Seaweed 45gr/24', 'Dus', NULL),
(77, 'Hai Berry Coklat 12gr/180', 'Dus', NULL),
(78, 'Strawberry Puff 250gr/18 ', 'Dus', NULL),
(79, 'Orange Puff 250gr/18 ', 'Dus', NULL),
(80, 'Coklat Puff 250gr/18 ', 'Dus', NULL),
(81, 'Blueberry Puff 250gr/18 ', 'Dus', NULL),
(82, 'Apple Puff 250gr/18 ', 'Dus', NULL),
(83, 'Strawberry Puff 85gr/30 ', 'Dus', NULL),
(84, 'Orange Puff 85gr/30 ', 'Dus', NULL),
(85, 'Coklat Puff 85gr/30 ', 'Dus', NULL),
(86, 'Blueberry Puff 85gr/30 ', 'Dus', NULL),
(87, 'Apple Puff 85gr/30 ', 'Dus', NULL),
(88, 'Wfr Stick Chiko Mini Coklat 11,25gr/180', 'Dus', NULL),
(89, 'Wfr Stick Chiko Mini Cocopandan 11,25gr/180', 'Dus', NULL),
(90, 'Wafer Stick Long n Long 11gr/120', 'Dus', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_dist`
--

CREATE TABLE IF NOT EXISTS `order_dist` (
  `ID` int(10) NOT NULL,
  `RID` varchar(50) DEFAULT NULL,
  `TGL` datetime DEFAULT NULL,
  `NAMA_DISTRIBUTOR` varchar(200) DEFAULT NULL,
  `NAMA_PRODUK` varchar(200) DEFAULT NULL,
  `TYPE_PRODUK` varchar(200) DEFAULT NULL,
  `STOCK` varchar(200) DEFAULT NULL,
  `ORDER` varchar(200) DEFAULT NULL,
  `TERIMA_TGL` datetime DEFAULT NULL,
  `CATATAN` text,
  `VALIDASI` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `ID` int(10) NOT NULL,
  `USER` varchar(20) DEFAULT NULL,
  `PASS` varchar(20) DEFAULT NULL,
  `HAK` varchar(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `USER`, `PASS`, `HAK`) VALUES
(1, 'septiyo', 'septiyo23', 'ADMIN'),
(2, 'user1', 'kokola', 'DISTRIBUTOR'),
(3, 'user2', 'kokola', 'DISTRIBUTOR');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `forecast`
--
ALTER TABLE `forecast`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `kj`
--
ALTER TABLE `kj`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `m_produk`
--
ALTER TABLE `m_produk`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `order_dist`
--
ALTER TABLE `order_dist`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `forecast`
--
ALTER TABLE `forecast`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `kj`
--
ALTER TABLE `kj`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `m_produk`
--
ALTER TABLE `m_produk`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=91;
--
-- AUTO_INCREMENT for table `order_dist`
--
ALTER TABLE `order_dist`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
