-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.18 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table socola_world.black_list
DROP TABLE IF EXISTS `black_list`;
CREATE TABLE IF NOT EXISTS `black_list` (
  `user_id` char(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.
-- Dumping structure for table socola_world.bot_remind_hashtag
DROP TABLE IF EXISTS `bot_remind_hashtag`;
CREATE TABLE IF NOT EXISTS `bot_remind_hashtag` (
  `user_id` char(50) COLLATE utf8_unicode_ci NOT NULL,
  `group_id` char(50) COLLATE utf8_unicode_ci NOT NULL,
  `bot` text COLLATE utf8_unicode_ci,
  `active` bit(1) NOT NULL DEFAULT b'0',
  `access_token` text COLLATE utf8_unicode_ci NOT NULL,
  `hashtag` text COLLATE utf8_unicode_ci,
  `messages` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`user_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.
-- Dumping structure for table socola_world.check_hashtag
DROP TABLE IF EXISTS `check_hashtag`;
CREATE TABLE IF NOT EXISTS `check_hashtag` (
  `post_id` char(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `user_id` char(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `time_point` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`post_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.
-- Dumping structure for table socola_world.group_insight
DROP TABLE IF EXISTS `group_insight`;
CREATE TABLE IF NOT EXISTS `group_insight` (
  `group_id` char(50) COLLATE utf8_unicode_ci NOT NULL,
  `update_time` char(50) COLLATE utf8_unicode_ci NOT NULL,
  `json` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`group_id`,`update_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.
-- Dumping structure for table socola_world.post_dont_care
DROP TABLE IF EXISTS `post_dont_care`;
CREATE TABLE IF NOT EXISTS `post_dont_care` (
  `user_id` char(50) COLLATE utf8_unicode_ci NOT NULL,
  `json` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.
-- Dumping structure for table socola_world.remind_hashtag
DROP TABLE IF EXISTS `remind_hashtag`;
CREATE TABLE IF NOT EXISTS `remind_hashtag` (
  `post_id` char(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.
-- Dumping structure for table socola_world.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` char(20) COLLATE utf8_unicode_ci NOT NULL,
  `user_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `access_token` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
