-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 28, 2018 at 12:40 PM
-- Server version: 5.6.38
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cryptokl_main`
--
CREATE DATABASE IF NOT EXISTS `cryptokl_local` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `cryptokl_local`;

-- --------------------------------------------------------

--
-- Table structure for table `predictions_all_types`
--

DROP TABLE IF EXISTS `predictions_all_types`;
CREATE TABLE IF NOT EXISTS `predictions_all_types` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `predictionName` text COLLATE utf8_unicode_ci NOT NULL,
  `predictionDays` int(3) NOT NULL,
  `coinSymbol` text COLLATE utf8_unicode_ci NOT NULL,
  `currencySymbol` text COLLATE utf8_unicode_ci NOT NULL,
  `currentPrice` float(10,2) NOT NULL,
  `predictedPrice` float(10,2) NOT NULL,
  `percentageDifference` float(10,2) NOT NULL,
  `reason` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'when user made pred',
  `expires` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'calculated property from class',
  `processed` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'ran logic against it',
  `closest_coin_tracking_id` int(11) NOT NULL COMMENT 'id of the closest coin record',
  `compare_price` int(11) NOT NULL COMMENT 'price of the closest record',
  `prediction_succeeded` tinyint(1) NOT NULL COMMENT 'if the prediction was successful becomes 1',
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `predictor_timing_limitations`
--

DROP TABLE IF EXISTS `predictor_timing_limitations`;
CREATE TABLE IF NOT EXISTS `predictor_timing_limitations` (
  `userId` int(11) NOT NULL,
  `pred1` datetime NOT NULL COMMENT 'this is When the prediction type is available',
  `pred3` datetime NOT NULL,
  `pred7` datetime NOT NULL,
  `pred14` datetime NOT NULL,
  `pred30` datetime NOT NULL,
  `pred90` datetime NOT NULL,
  UNIQUE KEY `pred` (`userId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `price_tracking_btc`
--

DROP TABLE IF EXISTS `price_tracking_btc`;
CREATE TABLE IF NOT EXISTS `price_tracking_btc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `FROMSYMBOL` text COLLATE utf8_unicode_ci NOT NULL,
  `TOSYMBOL` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'currenc symbol',
  `PRICE` float(10,2) NOT NULL,
  `LASTUPDATE` int(11) NOT NULL COMMENT 'timestamp?',
  `LASTVOLUME` float(4,3) NOT NULL,
  `LASTVOLUMETO` float(10,2) NOT NULL,
  `LASTTRADEID` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'assuming there id',
  `VOLUMEDAY` float(10,2) NOT NULL,
  `VOLUMEDAYTO` float(13,2) NOT NULL,
  `VOLUME24HOUR` bigint(20) NOT NULL,
  `VOLUME24HOURTO` bigint(20) NOT NULL,
  `OPENDAY` float(10,2) NOT NULL,
  `HIGHDAY` float(10,2) NOT NULL,
  `LOWDAY` float(10,2) NOT NULL,
  `OPEN24HOUR` float(10,2) NOT NULL,
  `HIGH24HOUR` float(10,2) NOT NULL,
  `LOW24HOUR` float(10,2) NOT NULL,
  `LASTMARKET` text COLLATE utf8_unicode_ci NOT NULL,
  `CHANGE24HOUR` float(10,2) NOT NULL,
  `CHANGEPCT24HOUR` decimal(5,2) NOT NULL,
  `CHANGEDAY` float(10,2) NOT NULL,
  `CHANGEPCTDAY` float(10,2) NOT NULL,
  `SUPPLY` bigint(20) NOT NULL,
  `MKTCAP` bigint(20) NOT NULL,
  `TOTALVOLUME24H` float(10,2) NOT NULL,
  `TOTALVOLUME24HTO` float(13,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11272 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `active` enum('Active','DeActive') NOT NULL DEFAULT 'DeActive',
  `login_type` varchar(255) DEFAULT NULL,
  `salt` bigint(20) NOT NULL DEFAULT '0',
  `created` bigint(20) NOT NULL DEFAULT '0',
  `isDeleted` tinyint(1) NOT NULL DEFAULT '0',
  `hashVerificationToken` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_crypto_score`
--

DROP TABLE IF EXISTS `user_crypto_score`;
CREATE TABLE IF NOT EXISTS `user_crypto_score` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `cryptoScore` int(11) NOT NULL DEFAULT '400' COMMENT 'initial attempt at crypto or klout score',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

DROP TABLE IF EXISTS `user_info`;
CREATE TABLE IF NOT EXISTS `user_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `first_name` text COLLATE utf8_unicode_ci NOT NULL,
  `last_name` text COLLATE utf8_unicode_ci NOT NULL,
  `locale` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `picture` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
