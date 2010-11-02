-- 
-- 資料表格式： `plu_member`
-- 

DROP TABLE IF EXISTS `plu_member`;
CREATE TABLE IF NOT EXISTS `plu_member` (
  `member_id` int(11) NOT NULL auto_increment,
  `group_id` int(11) NOT NULL,
  `account` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `sex` enum('男','女') NOT NULL,
  `birth` date NOT NULL,
  `tel` varchar(15) NOT NULL,
  `cellphone` varchar(15) NOT NULL,
  `email` varchar(80) NOT NULL,
  `addr` varchar(255) NOT NULL,
  `modiTime` datetime NOT NULL,
  PRIMARY KEY  (`member_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- 
-- 列出以下資料庫的數據： `plu_member`
-- 

INSERT INTO `plu_member` VALUES (1, 2, 'max', '簡偉倫', '4bdbdf66b1cd6e021f8143f8743dedff', '男', '1984-06-29', '', '0921-841-531', 'a@a.com', '', '2010-04-01 22:58:55');
INSERT INTO `plu_member` VALUES (2, 2, 'king', '王國連', '81dc9bdb52d04dc20036dbd8313ed055', '男', '0000-00-00', '', '', 'kingwang@msn.com', '', '2010-04-01 23:00:47');

-- 
-- 資料表格式： `plu_member_group`
-- 

DROP TABLE IF EXISTS `plu_member_group`;
CREATE TABLE IF NOT EXISTS `plu_member_group` (
  `group_id` int(11) NOT NULL auto_increment,
  `group_name` varchar(30) NOT NULL,
  `group_desc` varchar(255) NOT NULL,
  PRIMARY KEY  (`group_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- 
-- 列出以下資料庫的數據： `plu_member_group`
-- 

INSERT INTO `plu_member_group` VALUES (1, '普通會員', '一般會員');
INSERT INTO `plu_member_group` VALUES (2, 'VIP會員', '享受一般會員所沒有的優惠');
