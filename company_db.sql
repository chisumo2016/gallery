-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2016 at 01:47 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `company_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
`id` int(11) NOT NULL,
  `photo_id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `body` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `myguests`
--

CREATE TABLE IF NOT EXISTS `myguests` (
`ID` int(6) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `myguests`
--

INSERT INTO `myguests` (`ID`, `firstname`, `lastname`, `email`, `reg_date`) VALUES
(2, 'Bertha', 'D', 'john@gmail.com', '2016-01-14 11:24:48'),
(4, 'Bundallla', 'Chisum2', 'john@gmail.com', '2016-01-14 14:39:51');

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE IF NOT EXISTS `photos` (
`id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `caption` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `filename` varchar(255) NOT NULL,
  `alternate_text` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `size` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id`, `title`, `caption`, `description`, `filename`, `alternate_text`, `type`, `size`) VALUES
(12, 'Lorem ipsum', 'Tanzania', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias labore, deserunt repudiandae obcaecati odit! Et incidunt consequuntur rem, facere eius repudiandae eum, nisi distinctio amet repellat dolor error quis. Sint?                      \r\n                                                            \r\n                             ', 'images-6.jpg', 'Lorem ipsum ', 'image/jpeg', 21886),
(13, 'Good car ', '', '', 'images-11.jpg', '', 'image/jpeg', 27916);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `user_image` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `first_name`, `last_name`, `user_image`) VALUES
(5, 'beatrice', 'Bertha123', 'John', 'Blair', 'images-3.jpg'),
(6, 'Whatever', 'Bertha123', 'John', 'Blair', ''),
(9, 'Taza12', 'Mariamu12', 'Tanzania', 'Tanzania', ''),
(11, ' Bujara', 'Bundalla123', 'Johson', 'Bujara', ''),
(12, ' Buja00', 'Bunda123', 'Johson', 'Juma', ''),
(13, ' Buja00', 'Bunda123', 'Johson', 'Juma', ''),
(14, ' Buja00', 'Bunda123', 'Johson', 'Juma', ''),
(15, ' Buja00', 'Bunda123', 'Johson', 'Aisha', ''),
(16, ' Buja00', 'Bunda123', 'Johson', 'Aisha', ''),
(17, ' Buja00', 'Bunda123', 'Johson', 'Aisha', ''),
(18, 'Dada', '', '', '', ''),
(19, 'Dada', '', '', '', ''),
(20, '', '', '', '', ''),
(21, '', '', '', '', ''),
(22, '', '', '', '', ''),
(23, 'hhhhhhhhh', '', '', '', ''),
(24, 'Mndima', '123', 'Fue', 'ndani', '');

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE IF NOT EXISTS `visitors` (
`ID` int(11) NOT NULL,
  `visitor_ip` varchar(32) DEFAULT NULL,
  `visitor_browser` varchar(255) DEFAULT NULL,
  `visitor_hour` smallint(2) NOT NULL DEFAULT '0',
  `visitor_minute` smallint(2) NOT NULL DEFAULT '0',
  `visitor_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `visitor_day` smallint(2) NOT NULL,
  `visitor_month` smallint(2) NOT NULL,
  `visitor_year` smallint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
 ADD PRIMARY KEY (`id`), ADD KEY `photo_id` (`photo_id`);

--
-- Indexes for table `myguests`
--
ALTER TABLE `myguests`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
 ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `myguests`
--
ALTER TABLE `myguests`
MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
