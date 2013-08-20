
-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 20, 2013 at 01:22 PM
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
  `best_answer_id` int(11) NOT NULL,
  `answer_count` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=130 ;

--
-- Dumping data for table `asuult`
--

INSERT INTO `asuult` (`id`, `title`, `created_date`, `question`, `best_answer_id`, `answer_count`, `user_id`) VALUES
(125, 'sdfsdf', '2013-08-20 09:19:46', 'sdfsdfs', 0, 2, 3),
(127, 'test', '2013-08-20 09:20:55', 'sdjkfsl; jsdlf'' sfdk'' k''ds;f sjmdf sdlkf jsdjflk s;dfjlk jsldfjm lsdjfl sjdl;fj l;sdjfl ksdfl msdlkf', 0, 0, 4),
(128, 'qweqw', '2013-08-20 09:23:19', 'You''ve gone incognito. Pages you view in this window won''t appear in your browser history or search history, and they won''t leave other traces, like cookies, on your computer after you close all open incognito windows. Any files you ', 13130, 4, 4),
(129, 'slkjflskdj lk', '2013-08-20 10:23:18', 'sldkjfsldkm sdfksl;df, sdflk,df.', 13132, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `hariult`
--

CREATE TABLE IF NOT EXISTS `hariult` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `answer` mediumtext COLLATE utf8_bin NOT NULL,
  `created_date` datetime NOT NULL,
  `question_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=13140 ;

--
-- Dumping data for table `hariult`
--

INSERT INTO `hariult` (`id`, `answer`, `created_date`, `question_id`, `user_id`) VALUES
(13129, 'qweqweqw', '2013-08-20 09:37:13', 128, 4),
(13130, 'qweqweq', '2013-08-20 10:21:51', 128, 1),
(13132, 'sdasdasdasd', '2013-08-20 10:23:23', 129, 3),
(13133, 'asdasdasdasd', '2013-08-20 10:23:29', 128, 3),
(13134, 'fsdfsdfs sdfsdfsdf', '2013-08-20 10:40:12', 128, 3),
(13135, 'dfdfgdfgdfgd', '2013-08-20 10:40:31', 125, 3),
(13136, 'kjfsdlfkj sldkfj ''slkdjf ''lsdfj s''dfj sdl''kf smjdfl;ks dmfs', '2013-08-20 10:40:52', 125, 4),
(13139, ' asdasd asd asda sd ', '2013-08-20 12:14:01', 129, 4);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8_bin NOT NULL,
  `password` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=5 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `password`) VALUES
(1, 'test', '1'),
(2, 'bold', '2'),
(3, 'bat', '3'),
(4, 'dorj', '4');
