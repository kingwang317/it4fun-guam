-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- 主機: localhost
-- 建立日期: Feb 02, 2010, 08:39 AM
-- 伺服器版本: 5.1.36
-- PHP 版本: 5.2.11

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- 資料表格式： `sys_config`
--

CREATE TABLE IF NOT EXISTS `sys_config` (
  `conf_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'config編號',
  `conf_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT 'config名稱',
  `conf_value` text COLLATE utf8_unicode_ci COMMENT 'config數值',
  PRIMARY KEY (`conf_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- 列出以下資料庫的數據： `sys_config`
--


-- --------------------------------------------------------

--
-- 資料表格式： `sys_privileges`
--

CREATE TABLE IF NOT EXISTS `sys_privileges` (
  `pri_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '身分權限編號',
  `pri_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '身分權限名稱',
  PRIMARY KEY (`pri_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 列出以下資料庫的數據： `sys_privileges`
--

INSERT INTO `sys_privileges` (`pri_id`, `pri_name`) VALUES
('general', '一般使用者'),
('admin', '管理者');

-- --------------------------------------------------------

--
-- 資料表格式： `sys_pri_func`
--

CREATE TABLE IF NOT EXISTS `sys_pri_func` (
  `pri_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '身分權限編號',
  `func_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '套件功能名稱',
  UNIQUE KEY `pri_id` (`pri_id`,`func_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 列出以下資料庫的數據： `sys_pri_func`
--

INSERT INTO `sys_pri_func` (`pri_id`, `func_name`) VALUES
('', 'announce'),
('', 'order'),
('', 'user_pri'),
('admin', 'cms_config'),
('admin', 'cms_content'),
('admin', 'sitemap'),
('admin', 'user_manager'),
('admin', 'user_pri'),
('admin', 'yata_exp'),
('admin', 'yata_news'),
('admin', 'yata_product'),
('admin', 'yata_sel');

-- --------------------------------------------------------

--
-- 資料表格式： `sys_user`
--

CREATE TABLE IF NOT EXISTS `sys_user` (
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `user_passwd` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `user_nickname` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_email` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `user_msnm` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_yim` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_skype` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pri_id` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_login_count` int(8) DEFAULT NULL,
  `user_login_time` int(11) DEFAULT NULL,
  `user_logout_time` int(11) DEFAULT NULL,
  `user_login_ip` varchar(18) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_public` set('user_url','user_msnm','user_yim','user_email','user_skype') COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_hidden` tinyint(1) NOT NULL DEFAULT '0',
  `login_type` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_pri` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'general' COMMENT '使用者權限',
  PRIMARY KEY (`user_id`),
  KEY `user_email` (`user_email`),
  KEY `pri_id` (`pri_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 列出以下資料庫的數據： `sys_user`
--

INSERT INTO `sys_user` (`user_id`, `user_passwd`, `user_nickname`, `user_email`, `user_msnm`, `user_yim`, `user_skype`, `pri_id`, `user_login_count`, `user_login_time`, `user_logout_time`, `user_login_ip`, `user_url`, `user_public`, `user_hidden`, `login_type`, `user_pri`) VALUES
('admin', 'fc5e038d38a57032085441e7fe7010b0', 'admin', 'admin@com.tw', NULL, NULL, NULL, '_admin', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 'test1'),
('awoo', '21232f297a57a5a743894a0e4a801fc3', 'AWOO 管理者', '', NULL, NULL, NULL, '_maintainer', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'DB', 'admin'),
('awoo_maintainer', '4bdbdf66b1cd6e021f8143f8743dedff', '超級維護者', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 'general'),
('chushiako', '1424a291c805d7a4697be6c4d315a73d', '竹下農機管理者', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 'admin'),
('yata', 'af6946752dd200471ee3f669ce9bbea9', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, 'admin');

-- --------------------------------------------------------

--
-- 資料表格式： `sys_user_group`
--

CREATE TABLE IF NOT EXISTS `sys_user_group` (
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `group_id` int(20) NOT NULL DEFAULT '0',
  KEY `user_id` (`user_id`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 列出以下資料庫的數據： `sys_user_group`
--


-- --------------------------------------------------------

--
-- 資料表格式： `sys_user_pri`
--

CREATE TABLE IF NOT EXISTS `sys_user_pri` (
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `pri_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`user_id`,`pri_id`),
  KEY `pri_id` (`pri_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 列出以下資料庫的數據： `sys_user_pri`
--

CREATE TABLE IF NOT EXISTS `sys_log` (
`log_id` INT( 50 ) NOT NULL AUTO_INCREMENT COMMENT '紀錄編號',
`func_id` VARCHAR( 50 ) NOT NULL COMMENT '功能名稱',
`row_id` INT( 50 ) NULL COMMENT '欄位編號',
`log_status` VARCHAR( 50 ) NOT NULL COMMENT '紀錄狀態',
`log_time` DATETIME NOT NULL COMMENT '紀錄時間',
`user_id` VARCHAR( 255 ) NOT NULL COMMENT '使用者編號',
PRIMARY KEY ( `log_id` )
) ENGINE = MYISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;