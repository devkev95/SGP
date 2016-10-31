-- phpMyAdmin SQL Dump
-- version 4.4.13.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 01, 2016 at 06:31 PM
-- Server version: 5.6.31-0ubuntu0.15.10.1
-- PHP Version: 5.6.11-1ubuntu3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sgp_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `recoveryAccount`
--

CREATE TABLE IF NOT EXISTS `recoveryAccount` (
  `id` bigint(20) NOT NULL,
  `hash` varchar(50) NOT NULL,
  `user` varchar(75) NOT NULL,
  `expFecha` date NOT NULL,
  `usado` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `recoveryAccount`
--

INSERT INTO `recoveryAccount` (`id`, `hash`, `user`, `expFecha`, `usado`) VALUES
(4, 'cfd4bbb5a9a89d1dbf3270e253b2670df4db583b0c90d10ece', 'devkev95@gmail.com', '2016-10-02', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `recoveryAccount`
--
ALTER TABLE `recoveryAccount`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `recoveryAccount`
--
ALTER TABLE `recoveryAccount`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `recoveryAccount`
--
ALTER TABLE `recoveryAccount`
  ADD CONSTRAINT `recoveryAccount_ibfk_1` FOREIGN KEY (`user`) REFERENCES `usuario` (`email`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
