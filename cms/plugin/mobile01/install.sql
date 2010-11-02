CREATE TABLE `plu_mobile01` (
`m01_id` INT( 20 ) NOT NULL AUTO_INCREMENT ,
`kw_ids` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL ,
`m01_url` VARCHAR( 255 ) NOT NULL ,
`m01_title` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ,
`m01_post_time` DATE NOT NULL ,
`m01_track_time` DATE NOT NULL ,
`m01_status` VARCHAR( 50 ) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ,
`m01_cate` VARCHAR( 50 ) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ,
`m01_rank` VARCHAR( 50 ) NOT NULL ,
`ModiTime` TIMESTAMP NOT NULL ,
PRIMARY KEY ( `m01_id` )
) ENGINE = MYISAM ;
