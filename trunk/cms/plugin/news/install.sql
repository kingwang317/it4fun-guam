CREATE TABLE IF NOT EXISTS `plu_news` (
  `news_id` int(20) NOT NULL auto_increment,
  `cate_id` int(20) NOT NULL,
  `caption` varchar(255) collate utf8_unicode_ci default NULL,
  `content` text collate utf8_unicode_ci,
  `img_name` varchar(255) collate utf8_unicode_ci default NULL,
  `img_desc` varchar(255) collate utf8_unicode_ci default NULL,
  `movie_name` varchar(255) collate utf8_unicode_ci default NULL,
  `movie_desc` varchar(255) collate utf8_unicode_ci default NULL,
  `meta_title` varchar(255) collate utf8_unicode_ci default NULL,
  `meta_keyword` text collate utf8_unicode_ci,
  `meta_desc` text collate utf8_unicode_ci,
  `ModiTime` datetime NOT NULL COMMENT '修改時間',
  `PublishDate` datetime NOT NULL COMMENT '發佈時間',
  PRIMARY KEY  (`news_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

CREATE TABLE IF NOT EXISTS `plu_news_category` (
  `cate_id` int(20) NOT NULL AUTO_INCREMENT,
  `cate_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cate_content` text COLLATE utf8_unicode_ci,
  `parent_id` int(20) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`cate_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;