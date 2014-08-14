-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 30, 2014 at 03:09 AM
-- Server version: 5.5.38-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `regis`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE IF NOT EXISTS `address` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `company_id` int(4) NOT NULL,
  `url` varchar(100) CHARACTER SET latin1 NOT NULL,
  `address` varchar(100) CHARACTER SET latin1 NOT NULL,
  `e-mail` varchar(50) CHARACTER SET latin1 NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `address` (`address`),
  KEY `FK_users_role_map` (`company_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=55 ;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `company_id`, `url`, `address`, `e-mail`, `active`) VALUES
(46, 7, 'http://www.regis24.de/impressum/', 'Regis24 GmbH , Zehdenicker Str. 21 , 10119 Berlin', 'info@regis24.de', 1),
(47, 8, 'http://www.savage-wear.com/impressum/index.html', 'Savage-Wear Pulkkinen &amp; Heim GbR, Gubener str. 29, 10243 Berlin', 'contact@savage-wear.com', 1),
(48, 8, 'http://www.savage-wear.com/impressum/index.html', 'Savage-Store, GrÃ¼nberger str. 16, 10243 berlin', 'contact@savage-wear.com', 1),
(49, 10, 'http://www.moebus-gruppe.de/impressum.html', 'Hansastr. 202, 13088 Berlin', 'info@moebus-gruppe.de', 1),
(50, 10, 'http://www.moebus-gruppe.de/impressum.html', 'Hansastr. 205, 13051 Berlin', 'info@moebus-gruppe.de', 1),
(52, 10, 'http://www.moebus-gruppe.de/impressum.html', 'Hansastr. 203, 13051 Berlin', 'info@moebus-gruppe.de', 1),
(53, 9, 'http://www.idealo.de/preisvergleich/AGB.html', 'idealo internet GmbH, \nZionskirchstra&szlig;e 73 A, \n10119 Berlin, Deutschland', 'mail@idealo.de', 1),
(54, 9, 'http://www.idealo.de/preisvergleich/AGB.html', 'Dr. Albrecht von Sonntag, Zionskirchstra&szlig;e 73 A, 10119 Berlin, Deutschland', 'mail@idealo.de', 1);

-- --------------------------------------------------------

--
-- Table structure for table `change`
--

CREATE TABLE IF NOT EXISTS `change` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `id_old_address` int(4) NOT NULL,
  `id_new_address` int(4) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_Change` (`id_old_address`),
  KEY `fk_Change_new` (`id_new_address`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `name`) VALUES
(9, 'idealo internet GmbH'),
(10, 'moebus-gruppe'),
(7, 'Regis24'),
(8, 'Savage-Wear');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `FK_users_role_map` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `change`
--
ALTER TABLE `change`
  ADD CONSTRAINT `fk_Change` FOREIGN KEY (`id_old_address`) REFERENCES `address` (`id`),
  ADD CONSTRAINT `fk_Change_new` FOREIGN KEY (`id_new_address`) REFERENCES `address` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
