DROP TABLE IF EXISTS `plu_product_category`;
CREATE TABLE IF NOT EXISTS `plu_product_category` (
  `cate_id` int(20) NOT NULL auto_increment,
  `cate_name` varchar(255) collate utf8_unicode_ci default NULL,
  `cate_content` text collate utf8_unicode_ci,
  `cate_order` int(11) NOT NULL,
  `parent_id` int(20) NOT NULL default '-1',
  PRIMARY KEY  (`cate_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- 
-- 列出以下資料庫的數據： `plu_product_category`
-- 

INSERT INTO `plu_product_category` VALUES (1, '遊戲', '', 0, -1);
INSERT INTO `plu_product_category` VALUES (2, '傢俱', '', 0, -1);
INSERT INTO `plu_product_category` VALUES (3, '服飾', '', 0, -1);
INSERT INTO `plu_product_category` VALUES (4, 'PSP', '', 0, 1);
INSERT INTO `plu_product_category` VALUES (5, '床', '各式各樣的床具', 0, 2);
INSERT INTO `plu_product_category` VALUES (6, '沙發', '各式各樣的沙發', 0, 2);
INSERT INTO `plu_product_category` VALUES (7, '男裝', '男生的衣服', 0, 3);
INSERT INTO `plu_product_category` VALUES (8, '女裝', '女生的衣服', 0, 3);

DROP TABLE IF EXISTS `plu_product`;
CREATE TABLE IF NOT EXISTS `plu_product` (
  `prod_id` int(20) NOT NULL auto_increment,
  `cate_id` int(20) NOT NULL,
  `name` varchar(255) collate utf8_unicode_ci default NULL,
  `prod_number` varchar(255) collate utf8_unicode_ci default NULL,
  `content` text collate utf8_unicode_ci,
  `img_name` varchar(255) collate utf8_unicode_ci default NULL,
  `img_desc` varchar(255) collate utf8_unicode_ci default NULL,
  `display` tinyint(1) default NULL,
  `promotion` tinyint(1) default NULL,
  `price` float default NULL,
  `prom_price` float default NULL,
  `meta_title` varchar(255) collate utf8_unicode_ci default NULL,
  `meta_keyword` text collate utf8_unicode_ci,
  `meta_desc` text collate utf8_unicode_ci,
  `ModiTime` datetime NOT NULL COMMENT '修改時間',
  `PublishDate` datetime NOT NULL COMMENT '發佈時間',
  PRIMARY KEY  (`prod_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;
