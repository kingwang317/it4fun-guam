CREATE TABLE IF NOT EXISTS `plu_contact` (
  `con_id` int(20) NOT NULL AUTO_INCREMENT COMMENT '表單編號A',
  `Ccate_id` int(20) NOT NULL COMMENT '表單分類',
  `con_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT '聯絡表單' COMMENT '表單主題',
  `con_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '聯絡姓名',
  `con_phone` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '聯絡電話',
  `con_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '聯絡郵件',
  `con_ip` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '聯絡IP',
  `con_content` text COLLATE utf8_unicode_ci COMMENT '表單內容',
  `con_reply` text COLLATE utf8_unicode_ci COMMENT '表單回覆',
  `con_time` datetime NOT NULL COMMENT '建立時間',
  `con_reply_time` datetime NOT NULL COMMENT '回覆時間',
  PRIMARY KEY (`con_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

INSERT INTO `plu_contact` (`con_id`, `Ccate_id`, `con_title`, `con_name`, `con_phone`, `con_email`, `con_ip`, `con_content`, `con_reply`, `con_time`, `con_reply_time`) VALUES
(1, 1, '聯絡表單test1', 'test1', '0911111111', 'kingwang317@gmail.com', '111.111.111.111', 'test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1', NULL, '2010-03-24 17:07:08', '0000-00-00 00:00:00'),
(2, 2, '聯絡表單test2', 'test2', '0922222222', 'kingwang317@gmail.com', '222.222.222.222', 'test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2', 'test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2', '2010-03-23 17:07:57', '2010-03-31 17:07:59'),
(3, 1, '聯絡表單test1', 'test1', '0911111111', 'kingwang317@gmail.com', '111.111.111.111', 'test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1test1', NULL, '2010-03-24 17:07:08', '0000-00-00 00:00:00'),
(4, 2, '聯絡表單test2', 'test2', '0922222222', 'kingwang317@gmail.com', '222.222.222.222', 'test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2', 'test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2test2', '2010-03-23 17:07:57', '2010-03-31 17:07:59');

CREATE TABLE IF NOT EXISTS `plu_contact_category` (
  `Ccate_id` int(20) NOT NULL AUTO_INCREMENT,
  `Ccate_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Ccate_content` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`Ccate_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

INSERT INTO `plu_contact_category` (`Ccate_id`, `Ccate_name`, `Ccate_content`) VALUES
(1, 'test1', 'test1'),
(2, 'test2', 'test2');