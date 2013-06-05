<?php

/**
 * @Project NUKEVIET 3.0
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2010 VINADES.,JSC. All rights reserved
 * @Createdate 7-17-2010 14:43
 */

if(!defined('NV_IS_FILE_MODULES'))
	die('Stop!!!');

$sql_drop_module = array();

$sql_drop_module[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_album`";
$sql_drop_module[] = "DROP TABLE IF EXISTS `" . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_picture`";

$sql_create_module = $sql_drop_module;

// Album
$sql_create_module[] = "CREATE TABLE `" . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_album` (
  `albumid` int(11) NOT NULL AUTO_INCREMENT,
  `weight` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) DEFAULT '',
  `description` varchar(255) DEFAULT '',
  `createddate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `num_photo` int(11) NOT NULL DEFAULT '0',
  `path_img` varchar(255) NOT NULL DEFAULT '',
  `num_view` int(11) NOT NULL DEFAULT '0',
  `alias` text NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`albumid`),
  KEY `Name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8";

// Picture
$sql_create_module[] = "CREATE TABLE `" . $db_config['prefix'] . "_" . $lang . "_" . $module_data . "_picture` (
  `pictureid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT '',
  `path` varchar(255) NOT NULL DEFAULT '',
  `description` text,
  `numview` int(11) NOT NULL DEFAULT '0',
  `thumb_name` varchar(255) DEFAULT '',
  `albumid` int(11) NOT NULL DEFAULT '0',
  `weight` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pictureid`),
  KEY `Name` (`name`),
  KEY `albumid` (`albumid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8";

?>