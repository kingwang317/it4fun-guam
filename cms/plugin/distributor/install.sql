CREATE TABLE IF NOT EXISTS `plu_distributor` (
  `dist_id` int(20) NOT NULL auto_increment,
  `place_id` int(20) NOT NULL,
  `dist_name` varchar(255) collate utf8_unicode_ci default NULL,
  `dist_url` varchar(255) collate utf8_unicode_ci default NULL,
  `dist_phone` varchar(255) collate utf8_unicode_ci default NULL,
  `dist_address` text collate utf8_unicode_ci default NULL,
  `img_name` varchar(255) collate utf8_unicode_ci default NULL,
  `img_desc` varchar(255) collate utf8_unicode_ci default NULL,
  `ModiTime` datetime NOT NULL COMMENT '修改時間',
  `PublishDate` datetime NOT NULL COMMENT '發佈時間',
  PRIMARY KEY  (`dist_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `plu_dist_place` (
  `place_id` int(20) NOT NULL AUTO_INCREMENT,
  `place_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `place_content` text COLLATE utf8_unicode_ci,
  `parent_id` int(20) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`place_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;