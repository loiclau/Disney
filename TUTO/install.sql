CREATE USER 'iamroot'@'localhost' IDENTIFIED BY 'iamroot';
GRANT ALL PRIVILEGES ON * . * TO 'iamroot'@'localhost';
FLUSH PRIVILEGES;

CREATE DATABASE ocpoo;

CREATE TABLE IF NOT EXISTS `personnages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) DEFAULT NULL,
  `forcePerso` int(11) DEFAULT NULL,
  `degats` int(11) DEFAULT NULL,
  `niveau` int(11) DEFAULT NULL,
  `experience` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nom` (`nom`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `personnagestp1` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8_general_ci NOT NULL,
  `degats` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `lvl` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `exp` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `force` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `nom` (`nom`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `personnagestp2` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8_general_ci NOT NULL,
  `degats` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `lvl` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `exp` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `force` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `timeEndormi` int(10) unsigned NOT NULL DEFAULT '0',
  `type` enum('magicien','guerrier') COLLATE utf8_general_ci NOT NULL,
  `atout` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `nom` (`nom`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
