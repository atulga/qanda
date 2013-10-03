SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

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

CREATE TABLE IF NOT EXISTS `hariult` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `answer` mediumtext COLLATE utf8_bin NOT NULL,
  `created_date` datetime NOT NULL,
  `question_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=13140 ;

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8_bin NOT NULL,
  `password` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=5 ;

ALTER TABLE  `asuult` ADD  `user_id` INT NOT NULL AFTER  `answer_count`;

ALTER TABLE  `hariult` ADD  `user_id` INT NOT NULL AFTER  `question_id`;
