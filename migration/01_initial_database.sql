-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 19, 2013 at 06:29 PM
-- Server version: 5.5.31
-- PHP Version: 5.3.10-1ubuntu3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `qanda_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `asuult`
--

CREATE TABLE IF NOT EXISTS `asuult` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text COLLATE utf8_bin NOT NULL,
  `created_date` datetime NOT NULL,
  `question` mediumtext COLLATE utf8_bin NOT NULL,
  `name` text COLLATE utf8_bin NOT NULL,
  `best_answer_id` int(11) NOT NULL,
  `answer_count` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=122 ;

--
-- Dumping data for table `asuult`
--

INSERT INTO `asuult` (`id`, `title`, `created_date`, `question`, `name`, `best_answer_id`, `answer_count`) VALUES
(103, 'fsdfsdf', '2013-08-14 12:15:44', 'sdfsdfsd\r\n1\r\n2\r\n3\r\n4', 'atu 3', 165, 3),
(105, 'zasaw', '2013-08-14 13:22:27', 'An array in PHP is actually an ordered map. A map is a type that associates values to keys. This type is optimized for several different uses; it can be treated as an array, list (vector), hash table (an implementation of a map), dictionary', '91', 0, 1),
(114, '321', '2013-08-16 07:08:25', '123\r\n123\r\n123', '123', 0, 6),
(115, 'test', '2013-08-19 10:52:29', 'test', 'test', 0, 1),
(116, 'test', '2013-08-19 10:58:14', '123 fgh', 'test man', 13057, 3);

-- --------------------------------------------------------

--
-- Table structure for table `hariult`
--

CREATE TABLE IF NOT EXISTS `hariult` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `answer` mediumtext COLLATE utf8_bin NOT NULL,
  `name` text COLLATE utf8_bin NOT NULL,
  `created_date` datetime NOT NULL,
  `question_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=13126 ;

--
-- Dumping data for table `hariult`
--

INSERT INTO `hariult` (`id`, `answer`, `name`, `created_date`, `question_id`) VALUES
(163, 'sdfsdfs', 'atu 3', '2013-08-14 12:15:48', 103),
(165, 'fgf dfg dfg ', 'atu 3', '2013-08-14 12:15:54', 103),
(229, 'adasda', '555555555', '2013-08-16 11:04:52', 114),
(230, 'dsfsdf', '555555555', '2013-08-16 11:05:15', 114),
(231, '1231\r\n123123', '112', '2013-08-16 11:05:21', 114);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8_bin NOT NULL,
  `password` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `password`) VALUES
(1, '1', '1'),
(2, '2', '2');
