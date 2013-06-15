DROP TABLE IF EXISTS `coms_level`;

CREATE TABLE `coms_level` (
  `level` tinyint(4) NOT NULL,
  `description` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`level`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `coms_level` VALUES (1,'Administrator');

DROP TABLE IF EXISTS `coms_options`;

CREATE TABLE `coms_options` (
  `id` mediumint(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `description` varchar(255) DEFAULT NULL,
  `value` mediumtext,
  `level` tinyint(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `option_name` (`name`,`level`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `coms_options` VALUES (1,'coms_main','Common Option for CoMS','O:8:\"stdClass\":1:{s:7:\"version\";s:3:\"2.1\";}',0),(2,'coms-module','COMS Loaded Modules List','a:0:{}',0);

DROP TABLE IF EXISTS `coms_user`;

CREATE TABLE `coms_user` (
  `id` tinyint(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `username` varchar(30) NOT NULL DEFAULT '',
  `password` varchar(40) NOT NULL DEFAULT '',
  `level` tinyint(3) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`,`password`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `coms_user` VALUES (1,'Administrator','admin@website.net','admin','ac43724f16e9241d990427ab7c8f4228',1,1);
