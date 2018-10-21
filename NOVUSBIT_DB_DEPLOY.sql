# ************************************************************
# Sequel Pro SQL dump
# Version 4004
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: localhost (MySQL 5.5.25)
# Database: novusbit
# Generation Time: 2013-07-28 15:21:15 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table author
# ------------------------------------------------------------

CREATE TABLE `author` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `registered` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_registered` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT '1',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `ban_reason` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `new_password_key` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `new_password_requested` datetime DEFAULT NULL,
  `new_email` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `new_email_key` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `last_ip` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `uniq_user` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table author_author
# ------------------------------------------------------------

CREATE TABLE `author_author` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `author_id` int(11) unsigned DEFAULT NULL,
  `author2_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UQ_56dabea0f160661625cee5fb259cd201cf90b52d` (`author2_id`,`author_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table author_autologin
# ------------------------------------------------------------

CREATE TABLE `author_autologin` (
  `key_id` char(32) COLLATE utf8_bin NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`key_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;



# Dump of table author_bits
# ------------------------------------------------------------

CREATE TABLE `author_bits` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `author_id` int(11) unsigned DEFAULT NULL,
  `bits_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UQ_2640862edafc81d9ead7e7882b70bdbb8b076e3a` (`author_id`,`bits_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table author_novus
# ------------------------------------------------------------

CREATE TABLE `author_novus` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `novus_id` int(11) unsigned DEFAULT NULL,
  `author_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UQ_6683540d4d9ccdc0f0854bbcc7526d1998515ba1` (`author_id`,`novus_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table author_profiles
# ------------------------------------------------------------

CREATE TABLE `author_profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `country` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;



# Dump of table author_user
# ------------------------------------------------------------

CREATE TABLE `author_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `author_id` int(11) unsigned DEFAULT NULL,
  `user_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UQ_5a52f4b65cac954a34dfbbf7a3f4ad0642ca2226` (`author_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table bit_likes
# ------------------------------------------------------------

CREATE TABLE `bit_likes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `novus_id` tinyint(3) unsigned DEFAULT NULL,
  `bit_id` int(11) unsigned DEFAULT NULL,
  `author_id` tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `one_like_each` (`author_id`,`bit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table bit_spam
# ------------------------------------------------------------

CREATE TABLE `bit_spam` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `novus_id` tinyint(3) unsigned DEFAULT NULL,
  `bit_id` int(11) unsigned DEFAULT NULL,
  `author_id` tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_spam` (`author_id`,`bit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table bits
# ------------------------------------------------------------

CREATE TABLE `bits` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `body` text COLLATE utf8_unicode_ci,
  `dateposted` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table bits_novus
# ------------------------------------------------------------

CREATE TABLE `bits_novus` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `number` tinyint(3) unsigned DEFAULT NULL,
  `novus_id` int(11) unsigned DEFAULT NULL,
  `bits_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UQ_d7b4f2ae15a30e54c3116f182d247c89eabf2318` (`bits_id`,`novus_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table broadcasting
# ------------------------------------------------------------

CREATE TABLE `broadcasting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `story_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `last_typed` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table ci_sessions
# ------------------------------------------------------------

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `ip_address` varchar(16) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;



# Dump of table facebook_friends_cache
# ------------------------------------------------------------

CREATE TABLE `facebook_friends_cache` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_fb_id` bigint(20) NOT NULL,
  `friend_fb_id` bigint(20) NOT NULL,
  `friend_name` varchar(100) COLLATE utf8_bin NOT NULL,
  `invited` varchar(1) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_fb_id` (`user_fb_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;



# Dump of table feedback
# ------------------------------------------------------------

CREATE TABLE `feedback` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `resolution` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `uri` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `resolved` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table login_attempts
# ------------------------------------------------------------

CREATE TABLE `login_attempts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(40) COLLATE utf8_bin NOT NULL,
  `login` varchar(50) COLLATE utf8_bin NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;



# Dump of table notice
# ------------------------------------------------------------

CREATE TABLE `notice` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `to_author` tinyint(3) unsigned NOT NULL,
  `novus_id` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `notice_combo` (`novus_id`,`to_author`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table novus
# ------------------------------------------------------------

CREATE TABLE `novus` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `sandbox` text COLLATE utf8_unicode_ci,
  `dateposted` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cover_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `category_id` tinyint(3) unsigned DEFAULT '1',
  `type_id` tinyint(3) unsigned DEFAULT '1',
  `last_bit_count` int(11) DEFAULT '0',
  `views` mediumint(11) DEFAULT '0',
  `end` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'N',
  `restricted` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table novus_appreciations
# ------------------------------------------------------------

CREATE TABLE `novus_appreciations` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `novus_id` tinyint(3) unsigned DEFAULT NULL,
  `author_id` tinyint(3) unsigned DEFAULT NULL,
  `dateposted` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_bit_count` tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `appr_uniq` (`novus_id`,`author_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table novus_category
# ------------------------------------------------------------

CREATE TABLE `novus_category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` varchar(1) COLLATE utf8_unicode_ci DEFAULT 'Y',
  `priority` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table novus_tag
# ------------------------------------------------------------

CREATE TABLE `novus_tag` (
  `id` int(11) DEFAULT NULL,
  `novus_id` int(11) DEFAULT NULL,
  `tag_id` int(11) DEFAULT NULL,
  UNIQUE KEY `UQ_8e5027a139b8a785e6f696dd0e01ba57105fb1af` (`novus_id`,`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table novus_type
# ------------------------------------------------------------

CREATE TABLE `novus_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table sessions
# ------------------------------------------------------------

CREATE TABLE `sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(50) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



# Dump of table tag
# ------------------------------------------------------------

CREATE TABLE `tag` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table user
# ------------------------------------------------------------

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(100) DEFAULT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table visibility
# ------------------------------------------------------------

CREATE TABLE `visibility` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `author` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



DROP TABLE IF EXISTS `novus_category`;

CREATE TABLE `novus_category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` varchar(1) COLLATE utf8_unicode_ci DEFAULT 'Y',
  `priority` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `novus_category` WRITE;
/*!40000 ALTER TABLE `novus_category` DISABLE KEYS */;

INSERT INTO `novus_category` (`id`, `title`, `active`, `priority`)
VALUES
	(1,'Drama','Y',1),
	(2,'Romance','Y',2),
	(3,'Fantasy','Y',5),
	(17,'Horror','Y',8),
	(18,'Humor','Y',4),
	(21,'Poetry','Y',7),
	(22,'Science Fiction','Y',9),
	(25,'Essay','Y',11),
	(28,'Travel & Events','Y',10),
	(31,'Philosophy','Y',12),
	(33,'Mystery','Y',3),
	(34,'Children','Y',6);

/*!40000 ALTER TABLE `novus_category` ENABLE KEYS */;
UNLOCK TABLES;



# Dump of table novus_type
# ------------------------------------------------------------

CREATE TABLE `novus_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `novus_type` WRITE;
/*!40000 ALTER TABLE `novus_type` DISABLE KEYS */;

INSERT INTO `novus_type` (`id`, `title`, `description`)
VALUES
	(1,'Classic Novus','<svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" version=\"1.1\" id=\"Layer_1\" x=\"0px\" y=\"0px\" width=\"100px\" height=\"100px\" viewBox=\"0 0 100 100\" enable-background=\"new 0 0 100 100\" xml:space=\"preserve\">\n<g>\n	<path d=\"M64.008,72.381c4.002-3.149,12.23-11.582,15.089-21.179c-6.511-8.01-33.912-42.187-40.238-50.08   C38.212,8.613,31.63,24.377,20.21,29.646c-5.247,2.56-10.477,4.156-12.467,4.721l39.077,47.32   C51.235,80.263,59.958,75.56,64.008,72.381z\"></path>\n	<g>\n		<g>\n			<path d=\"M90.405,75.352c-6.5,3.781-13.381,7.281-20.674,9.929c-8.632,3.134-19.05,6.681-22.386,7.664v5.127     l43.046-15.479L90.405,75.352z\"></path>\n			<polygon points=\"6.891,35.865 6.891,50.088 45.703,97.945 45.736,82.902    \"></polygon>\n		</g>\n		<path d=\"M88.717,70.42c-5.018,3.936-11.386,7.921-18.278,11.363c-6.521,3.266-20.879,7.668-23.093,8.339v1.144    c3.686-1.09,13.036-3.898,21.237-7.013c9.104-3.457,22.12-11.628,22.12-11.628L88.717,70.42z\"></path>\n	</g>\n	<path d=\"M80.877,50.835l-0.114,0.403c-2.851,10.142-11.25,18.858-15.762,22.409   c-4.225,3.319-13.009,8.054-17.655,9.561v2.168c6.53-2.034,15.656-6.36,20.721-9.922c8.699-6.128,17.195-14.63,22.419-22.404   l0.047,0.036C84.648,46.442,51.938,9.001,49.818,6.309c-0.719,1.357-1.368,2.265-2.422,2.887   c10.832,13.508,28.598,35.647,33.217,41.314L80.877,50.835z\"></path>\n	<path d=\"M87.321,59.925c0,0-11.588,12.1-18.328,16.846c-5.696,4.008-14.5,7.942-21.647,10.168v1.498   c0.692-0.212,1.838-0.566,3.268-1.021c5.266-1.677,14.41-4.722,19.106-7.072c9.305-4.648,17.623-10.274,22.834-15.386   c0.054-0.053,0.106-0.106,0.161-0.16L87.321,59.925z\"></path>\n</g>\n</svg><br>\nThis is the type where no artificial challenges or limitations apply. The only think you have to do is to write an interesing and inspired bit.'),
	(2,'Hourglass','<svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" version=\"1.1\" id=\"Layer_1\" x=\"0px\" y=\"0px\" width=\"100px\" height=\"100px\" viewBox=\"0 0 100 100\" enable-background=\"new 0 0 100 100\" xml:space=\"preserve\">\n<path d=\"M2642.125,860.772H2653c6.627,0,12-5.373,12-12v-6c0-6.627-5.373-12-12-12h-268.667c-6.628,0-12,5.373-12,12  v6c0,6.627,5.372,12,12,12h16.458c3.079,25.7,16.801,111.143,65.382,140.795c-51.51,31.44-63.829,125.593-65.827,144.757h-16.013  c-6.628,0-12,5.373-12,12v6c0,6.627,5.372,12,12,12H2653c6.627,0,12-5.373,12-12v-6c0-6.627-5.373-12-12-12h-10.43  c-1.998-19.164-14.317-113.316-65.827-144.757C2625.324,971.915,2639.046,886.473,2642.125,860.772z M2540.113,989.812l0.032,11.755  l-0.032,11.755c27.759,0.076,49.712,22.431,65.249,66.444c9.703,27.487,13.733,55.407,15.054,66.558H2422.5  c1.32-11.15,5.351-39.07,15.054-66.558c15.537-44.014,37.49-66.368,65.249-66.444l-0.032-11.755l0.032-11.755  c-27.759-0.076-49.712-22.431-65.249-66.444c-8.706-24.663-12.843-49.661-14.556-62.596h196.92  c-1.713,12.935-5.85,37.933-14.556,62.596C2589.825,967.382,2567.872,989.736,2540.113,989.812z\"></path>\n<g>\n	<path d=\"M2439,1134.805c0,0,32.016-52.412,82.008-52.412s76.992,52.412,76.992,52.412H2439z\"></path>\n</g>\n<g>\n	<path d=\"M2456.887,944.14h129.143c0,0-12.029,40.665-66.363,40.665   C2474.093,984.805,2456.887,944.14,2456.887,944.14z\"></path>\n</g>\n<g>\n	<circle cx=\"2521.49\" cy=\"998.17\" r=\"7.482\"></circle>\n</g>\n<g>\n	<circle cx=\"2521.49\" cy=\"1021.355\" r=\"7.482\"></circle>\n</g>\n<g>\n	<circle cx=\"2521.49\" cy=\"1044.541\" r=\"7.482\"></circle>\n</g>\n<g>\n	<circle cx=\"2521.49\" cy=\"1067.727\" r=\"7.482\"></circle>\n</g>\n<path d=\"M80.833,11.498h2.886c1.76,0,3.185-1.426,3.185-3.185V6.722c0-1.759-1.425-3.185-3.185-3.185H12.428  c-1.759,0-3.185,1.426-3.185,3.185v1.592c0,1.758,1.425,3.185,3.185,3.185h4.367c0.817,6.819,4.458,29.491,17.349,37.36  C20.476,57.2,17.207,82.185,16.677,87.27h-4.249c-1.759,0-3.185,1.425-3.185,3.185v1.593c0,1.757,1.425,3.183,3.185,3.183h71.291  c1.76,0,3.185-1.426,3.185-3.183v-1.593c0-1.76-1.425-3.185-3.185-3.185h-2.767c-0.531-5.085-3.799-30.069-17.468-38.411  C76.375,40.989,80.017,18.317,80.833,11.498z M53.764,45.738l0.01,3.12l-0.01,3.119c7.367,0.02,13.192,5.952,17.314,17.632  c2.576,7.294,3.645,14.702,3.994,17.66H22.556c0.351-2.958,1.419-10.366,3.994-17.66c4.123-11.68,9.948-17.612,17.314-17.632  l-0.009-3.119l0.009-3.12c-7.366-0.02-13.191-5.951-17.314-17.631c-2.31-6.544-3.408-13.177-3.862-16.609h52.255  c-0.457,3.432-1.553,10.065-3.864,16.609C66.956,39.787,61.131,45.718,53.764,45.738z\"></path>\n<g>\n	<path d=\"M26.934,84.212c0,0,8.496-13.906,21.761-13.906c13.265,0,20.43,13.906,20.43,13.906H26.934z\"></path>\n</g>\n<g>\n	<path d=\"M31.68,33.619h34.268c0,0-3.191,10.791-17.609,10.791C36.246,44.41,31.68,33.619,31.68,33.619z\"></path>\n</g>\n<g>\n	<circle cx=\"48.823\" cy=\"47.956\" r=\"1.986\"></circle>\n</g>\n<g>\n	<circle  cx=\"48.823\" cy=\"54.109\" r=\"1.986\"></circle>\n</g>\n<g>\n	<circle  cx=\"48.823\" cy=\"60.261\" r=\"1.986\"></circle>\n</g>\n<g>\n	<circle  cx=\"48.823\" cy=\"66.414\" r=\"1.986\"></circle>\n</g>\n</svg><br>When the clock is ticking, things are getting more exciting. Write your bit in 2 minutes!'),
	(3,'Laconism','<svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" version=\"1.1\" id=\"Layer_1\" x=\"0px\" y=\"0px\" width=\"100px\" height=\"100px\" viewBox=\"0 0 100 100\" enable-background=\"new 0 0 100 100\" xml:space=\"preserve\">\n<path fill-rule=\"evenodd\" clip-rule=\"evenodd\" d=\"M35.432,40.914c-2.412,3.681-3.116,6.35-4.674,9.529l9.936,3.555l-12.232,2.37  l-8.977,43.05C27.242,88.538,30.8,78.47,46.293,68.144l-1.298-2.918c-0.979-0.675-1.619-1.801-1.619-3.078  c0-2.062,1.672-3.731,3.733-3.731c2.06,0,3.732,2.062,3.732,3.731s-0.67,2.37-1.649,3.045l12.693,8.533l-0.965-8.5  c3.803-3.247,6.215-8.079,6.215-13.468c0-9.777-7.929-17.705-17.707-17.705C43.757,34.053,37.846,37.232,35.432,40.914z\"></path>\n<path fill-rule=\"evenodd\" clip-rule=\"evenodd\" d=\"M50.538,0.583c-23.178,0-32.408,9.643-42.063,24.586l16.128,7.758  c7.193-6.249,15.955-9.238,25.455-8.737c2.144-0.013,4.014,0.245,6.08,0.843c16.683,3.791,28.346,18.873,27.907,35.958  C103.65,34.627,82.012,0.583,50.538,0.583z\"></path>\n<path fill-rule=\"evenodd\" clip-rule=\"evenodd\" d=\"M76.858,40.791c2.948,4.377,4.913,9.475,5.574,14.978l-13.725-4.466  c0-0.464-0.004-0.94-0.004-1.434c0-2.357-0.595-4.845-1.729-7.181L76.858,40.791z\"></path>\n<path fill-rule=\"evenodd\" clip-rule=\"evenodd\" d=\"M44.85,32.923c-3.496,0.818-6.651,2.387-8.918,4.309L27.8,32.565  c4.021-3.04,8.736-5.216,13.864-6.245L44.85,32.923z\"></path>\n<path fill-rule=\"evenodd\" clip-rule=\"evenodd\" d=\"M54.235,26.143c4.166,0.713,8.077,2.176,11.585,4.25l-5.072,5.098  c-2.148-1.463-4.697-2.517-7.604-2.956L54.235,26.143z\"></path>\n</svg><br>Sometimes saying less has more meaning. Write your bit but have in mind the word limit!'),
	(4,'Short sight','<svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" version=\"1.0\" x=\"0px\" y=\"0px\" width=\"100px\" height=\"100px\" viewBox=\"0 0 100 100\" overflow=\"\" enable-background=\"new 0 0 100 100\" xml:space=\"preserve\">\n    <path d=\"M94.419,44.665c-0.27,0-0.531,0.041-0.791,0.081c-2.384-8.15-9.896-14.108-18.814-14.108 c-7.178,0-13.439,3.871-16.855,9.626c-2.285-1.521-5.025-2.411-7.973-2.411c-2.94,0-5.669,0.882-7.947,2.393 c-3.42-5.744-9.676-9.608-16.846-9.608c-8.919,0-16.436,5.958-18.811,14.108c-0.264-0.041-0.524-0.081-0.797-0.081 C2.501,44.665,0,47.162,0,50.246s2.501,5.581,5.584,5.581c0.273,0,0.533-0.041,0.797-0.083c2.375,8.152,9.892,14.109,18.811,14.109 c10.831,0,19.607-8.776,19.607-19.607c0-0.629-0.036-1.253-0.093-1.872c1.2-1.619,3.107-2.684,5.279-2.684 c2.19,0,4.117,1.083,5.309,2.725c-0.052,0.605-0.089,1.212-0.089,1.831c0,10.831,8.776,19.607,19.608,19.607 c8.919,0,16.431-5.957,18.814-14.109c0.26,0.042,0.521,0.083,0.791,0.083c3.085,0,5.581-2.497,5.581-5.581 S97.504,44.665,94.419,44.665z M83.847,51.335c-2.083,2.278-5.697,3.454-9.503,2.742c-5.291-0.996-8.885-5.231-8.019-9.465 c0.874-4.233,5.864-6.86,11.155-5.869c2.652,0.493,4.869,1.798,6.324,3.514c2.363,2.428,3.521,6.088,2.746,9.888 c-1.22,5.931-6.658,9.907-12.145,8.879c-0.471-0.086-0.899-0.249-1.339-0.405c4.983,0.182,9.628-3.557,10.741-8.99 C83.829,51.534,83.829,51.438,83.847,51.335z M33.782,51.335c-2.083,2.278-5.694,3.454-9.501,2.742 c-5.292-0.996-8.887-5.231-8.017-9.465c0.87-4.233,5.861-6.86,11.156-5.869c2.652,0.493,4.868,1.798,6.32,3.514 c2.367,2.428,3.522,6.088,2.745,9.888c-1.216,5.931-6.657,9.907-12.145,8.879c-0.468-0.086-0.894-0.249-1.338-0.405 c4.986,0.182,9.627-3.557,10.742-8.99C33.766,51.534,33.766,51.438,33.782,51.335z\"></path>\n</svg><br>A novus might have 100 bits. You just get to see the last one. Can you write a bit that fits well with all the rest, judging just by the last one? '),
	(5,'Cloud Nine','<svg xmlns:x=\"http://ns.adobe.com/Extensibility/1.0/\" xmlns:i=\"http://ns.adobe.com/AdobeIllustrator/10.0/\" xmlns:graph=\"http://ns.adobe.com/Graphs/1.0/\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" version=\"1.1\" x=\"0px\" y=\"0px\" width=\"100px\" height=\"100px\" viewBox=\"0 0 100 100\" enable-background=\"new 0 0 100 100\" xml:space=\"preserve\">\n<metadata>\n	<sfw xmlns=\"http://ns.adobe.com/SaveForWeb/1.0/\">\n		<slices></slices>\n		<slicesourcebounds y=\"-8242\" x=\"-8141\" width=\"16383\" height=\"16383\" bottomleftorigin=\"true\"></slicesourcebounds>\n		<optimizationsettings></optimizationsettings>\n	</sfw>\n</metadata>\n\n<g id=\"Your_Icon\">\n	\n	<path  d=\"M-64.926,35.111l2.658-8.62l8.613,9.937C-57.427,36.685-64.926,35.111-64.926,35.111z\"></path>\n	<g>\n		<path  d=\"M61.176,42.064c-1.24,0.595-1.771,2.091-1.172,3.332c0.599,1.244,2.084,1.771,3.332,1.175    c1.24-0.595,1.771-2.088,1.168-3.332C63.913,41.999,62.424,41.469,61.176,42.064z\"></path>\n		\n			<rect x=\"41.743\" y=\"41.36\" transform=\"matrix(-0.4318 -0.9019 0.9019 -0.4318 22.9083 116.5563)\" fill=\"#000000\" width=\"12.842\" height=\"19.405\"></rect>\n		<path d=\"M75.586,38.793c-3.332-6.304-9.953-10.605-17.58-10.605c-4.28,0-8.24,1.353-11.482,3.653    c-2.463-2.269-5.751-3.653-9.365-3.653c-6.516,0-11.979,4.508-13.447,10.573C18.205,39.658,14,44.44,14,50.203    c0,6.404,5.193,11.594,11.598,11.594c0.812,0,1.598-0.083,2.361-0.242C29.658,68.691,36.066,74,43.722,74    c5.139,0,9.715-2.395,12.687-6.127c0.526,0.04,1.061,0.068,1.598,0.068c5.503,0,10.483-2.239,14.082-5.853    c0.465,0.058,0.934,0.087,1.414,0.087c6.509,0,11.784-5.276,11.784-11.785C85.286,44.596,81.1,39.781,75.586,38.793z     M65.42,55.064L39.561,67.44l-9.549-19.949l25.863-12.376l9.975,4.32l2.924,6.112L65.42,55.064z\"></path>\n	</g>\n</g>\n</svg><br> Do you know what\'s a keyword or tag cloud? The 6 most frequent keywords of all bits are presented to you. Can you write your bit and use all of them?'),
	(6,'Prose worm','<svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" version=\"1.1\" id=\"Layer_1\" x=\"0px\" y=\"0px\" width=\"100px\" height=\"100px\" viewBox=\"0 0 100 52\" enable-background=\"new 0 0 100 52\" xml:space=\"preserve\">\n<path fill=\"none\" d=\"M47.807,33.138c0.008-0.009,0.016-0.019,0.024-0.026c-0.009,0.007-0.018,0.015-0.026,0.023  C47.805,33.136,47.806,33.137,47.807,33.138z\"></path>\n<path fill=\"none\" d=\"M53.048,49.8c-0.274-0.071-0.545-0.152-0.815-0.232c-0.002,0.001-0.005,0.003-0.007,0.003  C52.485,49.648,52.76,49.726,53.048,49.8z\"></path>\n<path fill=\"none\" d=\"M36.33,35.501h-0.004c0.204,0.522,0.496,1.114,0.783,1.651h0.013C36.838,36.612,36.574,36.062,36.33,35.501z\"></path>\n<path  d=\"M37.108,37.152c0.291,0.544,0.577,1.029,0.758,1.332c-0.263-0.436-0.508-0.882-0.746-1.332H37.108z\"></path>\n<path  d=\"M38.062,38.804h0.006c-0.048-0.079-0.1-0.152-0.147-0.231C38.008,38.717,38.062,38.804,38.062,38.804z\"></path>\n<path  d=\"M51.812,49.445c-0.631-0.197-1.249-0.424-1.856-0.669c-0.003,0.002-0.007,0.003-0.009,0.004  C50.007,48.805,50.728,49.104,51.812,49.445z\"></path>\n<path d=\"M52.226,49.57c0.002,0,0.005-0.002,0.007-0.003c-0.106-0.03-0.213-0.057-0.318-0.091  C52.016,49.509,52.12,49.541,52.226,49.57z\"></path>\n<path  d=\"M74.458,0.955H59.321c-1.307,0-2.591,0.1-3.845,0.293c-0.273,0.042-0.541,0.101-0.811,0.151  c4.646,2.666,8.469,6.605,10.987,11.343h1.238h8.346c7.322,0,13.257,5.937,13.257,13.259c0,7.321-5.936,13.258-13.257,13.258h-9.516  h-1.958h-1.905h-0.006h-3.171c-3.305,0-6.324-1.212-8.646-3.212c0,0-0.003,0.003-0.003,0.003c0-0.002-0.001-0.002-0.002-0.003  c-0.494-0.414-0.886-0.802-1.206-1.148c-0.7-0.764-1.011-1.303-1.011-1.303c0.001-0.002,0.002-0.002,0.002-0.003  c-0.001-0.001-0.002-0.002-0.002-0.003c-1.505-2.15-2.389-4.766-2.389-7.589c0-2.746,0.834-5.296,2.263-7.413  c0.041-0.06,0.086-0.117,0.127-0.176c-1.736-1.473-3.978-2.367-6.429-2.367h-5.041c-1.325,3.052-2.067,6.416-2.067,9.956  c0,3.538,0.737,6.903,2.061,9.955c0.244,0.561,0.509,1.111,0.792,1.651c0.237,0.45,0.482,0.896,0.746,1.332  c0.02,0.033,0.036,0.059,0.054,0.088c0.047,0.079,0.099,0.152,0.147,0.231c2.792,4.463,6.948,7.98,11.888,9.973  c0.608,0.245,1.226,0.472,1.856,0.669c0.034,0.011,0.068,0.022,0.103,0.031c0.105,0.034,0.212,0.061,0.318,0.091  c0.27,0.08,0.541,0.161,0.815,0.232c0.004,0,0.006,0.002,0.01,0.003c2,0.513,4.096,0.787,6.254,0.787h15.137  c13.832,0,25.044-11.213,25.044-25.044C99.502,12.169,88.29,0.955,74.458,0.955z\"></path>\n<path d=\"M25.542,51.045h15.137c1.308,0,2.592-0.101,3.846-0.294c0.273-0.042,0.542-0.1,0.811-0.151  c-4.646-2.665-8.47-6.604-10.987-11.342H33.11h-8.346c-7.322,0-13.257-5.936-13.257-13.259c0-7.322,5.935-13.257,13.257-13.257  h9.516h1.957h1.905h0.007h3.17c3.304,0,6.323,1.212,8.645,3.212l0.002-0.003c0.001,0.001,0.001,0.002,0.002,0.003  c0.495,0.413,0.887,0.801,1.206,1.148c0.701,0.762,1.011,1.302,1.011,1.302c0,0.001-0.001,0.002-0.002,0.003  c0.001,0,0.002,0.001,0.003,0.003c1.505,2.15,2.39,4.766,2.39,7.588c0,2.746-0.835,5.297-2.264,7.412  c-0.041,0.062-0.085,0.118-0.127,0.176c1.736,1.474,3.979,2.369,6.429,2.369h5.042c1.324-3.053,2.065-6.417,2.065-9.957  c0-3.539-0.737-6.903-2.061-9.955c-0.244-0.561-0.509-1.111-0.792-1.651c-0.237-0.451-0.482-0.898-0.746-1.332  c-0.02-0.033-0.036-0.06-0.053-0.089c-0.048-0.078-0.099-0.153-0.147-0.23c-2.792-4.463-6.949-7.981-11.888-9.973  c-0.608-0.245-1.226-0.471-1.856-0.67c-0.034-0.011-0.068-0.021-0.103-0.032c-0.105-0.032-0.212-0.059-0.318-0.089  c-0.27-0.081-0.541-0.162-0.816-0.232c-0.004-0.001-0.006-0.001-0.009-0.002c-2-0.515-4.095-0.788-6.255-0.788H25.542  c-13.832,0-25.044,11.212-25.044,25.044C0.498,39.832,11.71,51.045,25.542,51.045z\"></path>\n<path  d=\"M53.058,49.803c-0.003-0.001-0.006-0.003-0.01-0.003C53.052,49.8,53.055,49.802,53.058,49.803z\"></path>\n<path  d=\"M51.812,49.445c0.034,0.011,0.068,0.022,0.103,0.031C51.881,49.468,51.847,49.456,51.812,49.445z\"></path>\n<path  d=\"M47.805,33.141c0,0,0.311,0.539,1.011,1.303c0.005-0.006,0.01-0.012,0.016-0.015  c-0.369-0.407-0.709-0.84-1.025-1.291C47.807,33.139,47.806,33.139,47.805,33.141z\"></path>\n<path d=\"M37.92,38.572c-0.018-0.029-0.034-0.055-0.054-0.088C37.885,38.514,37.902,38.542,37.92,38.572z\"></path>\n<path  d=\"M48.832,34.429c-0.006,0.003-0.011,0.009-0.016,0.015c0.319,0.347,0.711,0.734,1.206,1.148  c0.001-0.002,0.002-0.003,0.002-0.003C49.604,35.227,49.204,34.84,48.832,34.429z\"></path>\n<path  d=\"M50.027,35.592c0.001-0.003,0.004-0.006,0.012-0.015c-0.004,0.004-0.01,0.008-0.015,0.012  C50.025,35.589,50.026,35.59,50.027,35.592z\"></path>\n<rect x=\"50.022\" y=\"35.59\"  width=\"0.004\" height=\"0.004\"></rect>\n</svg><br>So simple, yet challenging: Your bit must start with the last word .. of the last bit. Do you take the challenge?'),
	(7,'Irriversable','<svg xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\" version=\"1.1\" id=\"Your_Icon\" x=\"0px\" y=\"0px\" width=\"100px\" height=\"100px\" viewBox=\"0 0 100 100\" enable-background=\"new 0 0 100 100\" xml:space=\"preserve\">\n<path d=\"M99.474,56.936C97.956,81.244,75.806,100,50.509,100C22.904,100,0.526,77.624,0.526,50.019C0.526,22.378,22.904,0,50.509,0  c14.305,0,27.172,6.018,36.215,15.64l7.748-7.75l1.189,29.874L65.786,36.54l7.787-7.785c-5.695-6.232-13.912-10.124-23.064-10.124  c-17.334,0-31.352,14.055-31.352,31.388c0,17.332,14.018,31.387,31.352,31.387c14.99,0,27.459-10.486,30.631-24.47H99.474z\"></path>\n</svg><br>How about instead of appending each bit at the end of the story...Each bit will be placed on top of all other? There you have it, a reversed story! ');

/*!40000 ALTER TABLE `novus_type` ENABLE KEYS */;
UNLOCK TABLES;

INSERT INTO `author` (`id`, `first_name`, `last_name`, `registered`, `date_registered`, `picture`, `username`, `password`, `email`, `activated`, `banned`, `ban_reason`, `new_password_key`, `new_password_requested`, `new_email`, `new_email_key`, `last_ip`, `last_login`, `created`, `modified`)
VALUES
	(1,NULL,NULL,NULL,NULL,NULL,X'61646D696E',X'243261243038245648764C6646707861562E6F6664454670473141746536626A76506A7837637050385046435A542E33644F4342744D6C437A505453',X'68656C6C6F406E6F7675736269742E636F6D',1,0,NULL,NULL,NULL,NULL,NULL,X'322E38352E31372E313035','2013-07-28 19:44:05','2013-07-28 19:42:53','2013-07-28 19:44:05');


INSERT INTO `tag` (`id`, `title`)
VALUES
	(1,'novusbit');
	
	
/*!40000 ALTER TABLE `author` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
