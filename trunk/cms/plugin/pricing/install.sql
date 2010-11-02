-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- 主機: localhost
-- 建立日期: Jun 08, 2010, 03:20 PM
-- 伺服器版本: 5.0.51
-- PHP 版本: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- 資料庫: `yata_cms`
-- 

-- --------------------------------------------------------

-- 
-- 資料表格式： `plu_pricing`
-- 

DROP TABLE IF EXISTS `plu_pricing`;
CREATE TABLE IF NOT EXISTS `plu_pricing` (
  `postcode` int(11) NOT NULL,
  `pricing_date` date NOT NULL,
  `item` varchar(30) NOT NULL,
  `value` float NOT NULL,
  UNIQUE KEY `postcode` (`postcode`,`pricing_date`,`item`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- 列出以下資料庫的數據： `plu_pricing`
-- 

INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (1, '2010-05-01', 'taipeicity_building', 2);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (1, '2010-04-01', 'taipeicity_building', 3);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (1, '2010-05-01', 'taipeicity_apartment', 14);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (1, '2010-04-01', 'taipeicity_apartment', 15);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (1, '2010-01-01', 'taipeicity_building', 6);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (3, '2010-01-01', 'taipeicounty_building', 30);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (3, '2010-04-01', 'taipeicounty_apartment', 39);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (3, '2010-04-01', 'taipeicounty_building', 27);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (3, '2010-05-01', 'taipeicounty_apartment', 38);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (3, '2010-05-01', 'taipeicounty_building', 26);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (3, '2010-04-01', 'taipeicity_issue', 120);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (3, '2010-04-01', 'taipeicounty_issue', 60);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (3, '2010-05-01', 'taipeicity_issue', 70);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (3, '2010-05-01', 'taipeicounty_issue', 50);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (3, '2010-04-01', 'taipeicity_bidding', 200);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (3, '2010-04-01', 'taipeicounty_bidding', 60);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (3, '2010-05-01', 'taipeicity_bidding', 70);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (3, '2010-05-01', 'taipeicounty_bidding', 300);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (0, '2010-04-01', 'prosperity', 60);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (1, '2010-06-01', 'taipeicity_building', 15);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (1, '2010-03-01', 'taipeicity_building', 4);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (1, '2010-02-01', 'taipeicity_building', 5);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (1, '2010-06-01', 'taipeicity_apartment', 13);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (1, '2010-03-01', 'taipeicity_apartment', 16);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (1, '2010-02-01', 'taipeicity_apartment', 17);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (1, '2010-01-01', 'taipeicity_apartment', 18);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (1, '2009-12-01', 'taipeicity_building', 7);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (1, '2009-12-01', 'taipeicity_apartment', 19);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (1, '2009-11-01', 'taipeicity_building', 8);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (1, '2009-11-01', 'taipeicity_apartment', 20);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (1, '2009-10-01', 'taipeicity_building', 9);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (1, '2009-10-01', 'taipeicity_apartment', 21);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (1, '2009-09-01', 'taipeicity_building', 10);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (1, '2009-09-01', 'taipeicity_apartment', 22);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (1, '2009-08-01', 'taipeicity_building', 11);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (1, '2009-08-01', 'taipeicity_apartment', 23);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (1, '2009-07-01', 'taipeicity_building', 12);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (1, '2009-07-01', 'taipeicity_apartment', 24);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (1, '2010-05-01', 'taipeicity_issue', 70);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (1, '2010-04-01', 'taipeicity_issue', 120);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (1, '2010-05-01', 'taipeicity_bidding', 70);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (1, '2010-04-01', 'taipeicity_bidding', 200);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (3, '2010-06-01', 'taipeicounty_building', 25);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (3, '2010-06-01', 'taipeicounty_apartment', 37);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (3, '2010-03-01', 'taipeicounty_building', 28);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (3, '2010-03-01', 'taipeicounty_apartment', 40);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (3, '2010-02-01', 'taipeicounty_building', 29);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (3, '2010-02-01', 'taipeicounty_apartment', 41);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (3, '2010-01-01', 'taipeicounty_apartment', 42);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (3, '2009-12-01', 'taipeicounty_building', 31);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (3, '2009-12-01', 'taipeicounty_apartment', 43);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (3, '2009-11-01', 'taipeicounty_building', 32);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (3, '2009-11-01', 'taipeicounty_apartment', 44);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (3, '2009-10-01', 'taipeicounty_building', 33);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (3, '2009-10-01', 'taipeicounty_apartment', 45);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (3, '2009-09-01', 'taipeicounty_building', 34);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (3, '2009-09-01', 'taipeicounty_apartment', 46);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (3, '2009-08-01', 'taipeicounty_building', 35);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (3, '2009-08-01', 'taipeicounty_apartment', 47);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (3, '2009-07-01', 'taipeicounty_building', 36);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (3, '2009-07-01', 'taipeicounty_apartment', 48);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (0, '2009-10-01', 'leading', 500);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (0, '2010-01-01', 'leading', 1000);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (0, '2010-01-01', 'simultaneous', 100);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (0, '2010-01-01', 'prosperity', 50);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (0, '2010-05-01', 'auction_amount', 1200);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (0, '2010-04-01', 'leading', 1500);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (0, '2010-04-01', 'simultaneous', 200);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (0, '2010-06-05', 'auction_amount', 1500);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (0, '2009-10-01', 'simultaneous', 50);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (0, '2009-10-01', 'prosperity', 40);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (0, '2009-07-01', 'leading', 300);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (0, '2009-07-01', 'simultaneous', 20);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (0, '2009-07-01', 'prosperity', 30);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (0, '2010-04-01', 'leading_return', 5);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (0, '2010-04-01', 'simultaneous_return', 3);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (0, '2010-04-01', 'prosperity_return', 1);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (1, '2010-03-01', 'taipeicity_bidding', 30);
INSERT INTO `plu_pricing` (`postcode`, `pricing_date`, `item`, `value`) VALUES (0, '2010-04-01', 'auction_amount', 1500);

-- --------------------------------------------------------

-- 
-- 資料表格式： `plu_pricing_desc`
-- 

DROP TABLE IF EXISTS `plu_pricing_desc`;
CREATE TABLE IF NOT EXISTS `plu_pricing_desc` (
  `pricing_date` date NOT NULL,
  `item` varchar(30) NOT NULL,
  `memo` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- 列出以下資料庫的數據： `plu_pricing_desc`
-- 

INSERT INTO `plu_pricing_desc` VALUES ('2010-06-01', 'taipeicity_desc', '2');
INSERT INTO `plu_pricing_desc` VALUES ('2010-06-01', 'taipeicounty_desc', '3');
INSERT INTO `plu_pricing_desc` VALUES ('2010-06-01', 'issue_desc', '4');
INSERT INTO `plu_pricing_desc` VALUES ('2010-06-01', 'bidding_desc', '5');
INSERT INTO `plu_pricing_desc` VALUES ('2010-06-01', 'auction_amount_desc', '6');
INSERT INTO `plu_pricing_desc` VALUES ('2010-04-01', 'analysis_desc', '1');
