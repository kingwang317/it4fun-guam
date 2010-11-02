CREATE TABLE `plu_ptt` (
`ptt_id` INT( 20 ) NOT NULL AUTO_INCREMENT ,
`kw_ids` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL ,
`ptt_bid` INT( 20 ) NOT NULL ,
`ptt_pid` INT( 20 ) NOT NULL ,
`ptt_title` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ,
`ptt_post_time` DATE NOT NULL ,
`ptt_track_time` DATE NOT NULL ,
`ptt_status` VARCHAR( 50 ) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ,
`ptt_cate` VARCHAR( 50 ) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ,
`ptt_rank` VARCHAR( 50 ) NOT NULL ,
`ModiTime` TIMESTAMP NOT NULL ,
PRIMARY KEY ( `ptt_id` )
) ENGINE = MYISAM ;
