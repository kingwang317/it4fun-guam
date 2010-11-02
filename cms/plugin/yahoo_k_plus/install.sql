CREATE TABLE IF NOT EXISTS `plu_yahoo_kplus` (
  `kp_id` int(20) NOT NULL AUTO_INCREMENT,
  `kw_ids` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `q_id` VARCHAR(50) NOT NULL,
  `kp_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `kp_post_time` date NOT NULL,
  `kp_status` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `kp_cate` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `kp_rank` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ModiTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `kp_track_time` date NOT NULL,
  PRIMARY KEY (`kp_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;
CREATE TABLE IF NOT EXISTS `plu_blog` (
  `blog_id` int(20) NOT NULL AUTO_INCREMENT,
  `kw_ids` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `blog_url` varchar(255) NOT NULL,
  `blog_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `blog_post_time` date NOT NULL,
  `blog_status` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `blog_cate` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `blog_rank` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ModiTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`blog_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;
CREATE TABLE IF NOT EXISTS `plu_plurk` (
  `plurk_id` int(20) NOT NULL AUTO_INCREMENT,
  `kw_ids` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `plurk_url` varchar(255) NOT NULL,
  `plurk_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `plurk_post_time` date NOT NULL,
  `plurk_status` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `plurk_cate` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `plurk_rank` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ModiTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`plurk_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;
CREATE TABLE IF NOT EXISTS `plu_keywords` (
`kw_id` INT( 20 ) NOT NULL AUTO_INCREMENT ,
`kw_content` VARCHAR( 50 ) NOT NULL ,
`com_id` INT( 20 ) NULL ,
PRIMARY KEY ( `kw_id` )
) ENGINE = MYISAM ;
