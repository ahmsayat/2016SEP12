-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Sep 11, 2016 at 11:56 PM
-- Server version: 5.5.42
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `news`
--
CREATE DATABASE IF NOT EXISTS `news` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `news`;

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `ID` bigint(20) unsigned NOT NULL,
  `title` varchar(333) COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(333) COLLATE utf8_unicode_ci NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  `author_email` varchar(63) COLLATE utf8_unicode_ci NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `PublishedBy` varchar(63) COLLATE utf8_unicode_ci NOT NULL,
  `Active` tinyint(1) unsigned NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`ID`, `title`, `photo`, `text`, `author_email`, `CreatedAt`, `PublishedBy`, `Active`) VALUES
(1, 'Trying out Apple’s fully wireless AirPods', 'https://tctechcrunch2011.files.wordpress.com/2016/09/img_8851.jpg?w=738', 'The AirPods were as close as we got to an honest-to-goodness hardware surprise at today’s big Apple event in San Francisco — though anyone who heard tell of the untimely demise of the headphone jack probably could have seen this coming. Pre-Beats, at least, headphones have traditionally been something of an afterthought for the company, as anyone whose ear canals have smarted from its first-generation earbuds will gladly tell you.\r\n\r\nThese new headphones feel a bit different in that respect — after all, if you’re going to do something as drastic as killing the headphone jack, you ought to offer up more of a consolation than an in-box dongle (the first, and hopefully last, time I’ll ever write that phrase).', 'Ahmsayat@gmail.com', '2016-09-11 21:05:41', '', 1),
(2, 'Pokémon Go becomes the fastest game to ever hit $500 million in revenue', 'https://tctechcrunch2011.files.wordpress.com/2016/08/pokemon-money.png?w=738', 'Pokémon Go has achieved a number of records since its debut – the most downloaded app in its first week ever and the fastest to reach 50 million installs on Google Play, for example – but now you can add one more to the list: the fastest game to reach $500 million in revenue. According to a new report from App Annie, Pokémon Go has now surpassed $500 million in worldwide customer spending across iOS and Android, and is on track to hit a billion in revenue by year-end.\r\n\r\nThe game reached the new milestone in just over 60 days, App Annie says.', 'Ahmsayat@gmail.com', '2016-09-11 21:07:58', '', 1),
(3, 'Playing around with the Apple Watch Series 2', 'https://tctechcrunch2011.files.wordpress.com/2016/09/img_8758.jpg?w=738', 'Maybe there’s a theme emerging here — behind-the-scenes tweaks while maintaining aesthetic consistency with past generations. Like the new iPhone, the Apple Watch Series 2 is pretty much aesthetically indistinguishable from its predecessor. Heck, even the new AirPods look nearly identical to the company’s EarPods, albeit with their wires snipped off.\r\n\r\nBut while the Series 2 (as the name, perhaps implies) doesn’t feel so much like a full refresh as it does an upgrade, there are some key differentiators here. The biggest, sadly, is one that we weren’t allowed to try out — apparently putting a swimming pool in the middle of the demo room at the Bill Graham Civic Auditorium just didn’t make logistical sense. So much for pulling out all the stops.\r\n\r\nThe waterproofing, which opens the wearable up to swim tracking, among other things, contained a key element that actually elicited an audible gasp from the crowd when the company showed it off: a speaker port that expels water from the device, which is something I really want to try out in person. Here’s hoping we find ourselves around a major body of water when we actually review the thing — I’m told San Francisco has a few.', 'Ahmsayat@gmail.com', '2016-09-11 21:08:20', '', 1),
(4, 'Test', 'http://[::1]//img/header.png', 'Test Test Test ', 'Ahmsayat@gmail.com', '2016-09-11 21:10:11', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `email`
--

DROP TABLE IF EXISTS `email`;
CREATE TABLE IF NOT EXISTS `email` (
  `ID` bigint(20) unsigned NOT NULL,
  `email` varchar(63) COLLATE utf8_unicode_ci NOT NULL,
  `verified` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0:no, 1:yes',
  `code` varchar(31) COLLATE utf8_unicode_ci NOT NULL COMMENT 'to verify the email',
  `CreatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Active` tinyint(1) unsigned NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `email`
--

INSERT INTO `email` (`ID`, `email`, `verified`, `code`, `CreatedAt`, `Active`) VALUES
(1, 'ahmsayat@gmail.com', 1, 'HeSZo4EVIYhb7X6Cy1WqmpUrdQxaz5R', '2016-09-11 21:04:02', 1),
(2, 'nagar@aucegypt.edu', 0, 'HeSZo4EVIYhB7X6Cy1WqmpUrDQxaZ5R', '2016-09-11 21:15:02', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `ID` bigint(20) unsigned NOT NULL,
  `username` varchar(31) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `salt` varchar(31) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(63) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(31) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(31) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(31) COLLATE utf8_unicode_ci NOT NULL,
  `gender` tinyint(1) unsigned DEFAULT NULL COMMENT '0:female, 1:male',
  `date_of_birth` date DEFAULT NULL,
  `country` varchar(99) COLLATE utf8_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'the dirctory for the user image',
  `about` text COLLATE utf8_unicode_ci,
  `CreatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdatedAt` timestamp NULL DEFAULT NULL,
  `UpdatedBy` varchar(63) COLLATE utf8_unicode_ci NOT NULL,
  `Active` tinyint(1) unsigned NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='the usedata data';

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `username`, `password`, `salt`, `email`, `phone`, `first_name`, `last_name`, `gender`, `date_of_birth`, `country`, `photo`, `about`, `CreatedAt`, `UpdatedAt`, `UpdatedBy`, `Active`) VALUES
(1, 'ahmsayat@gmail.com', '$2y$12$vUEl2ndOnUqJj3AOxkeSa.NRFblMUOEHv5GkippuZfiK2s.DG64eO', '', 'ahmsayat@gmail.com', NULL, 'Ahmed', 'Moussa', NULL, NULL, 'Egypt', NULL, NULL, '2016-09-11 21:04:33', NULL, '', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `email`
--
ALTER TABLE `email`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID` (`ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `email`
--
ALTER TABLE `email`
  MODIFY `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
