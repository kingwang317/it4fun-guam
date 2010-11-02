DROP TABLE IF EXISTS `plu_document`;
CREATE TABLE IF NOT EXISTS `plu_document` (
  `doc_id` int(11) NOT NULL auto_increment,
  `caption` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `PublishDate` date NOT NULL,
  `doc_desc` text NOT NULL,
  `cate_id` int(11) NOT NULL,
  `modiTime` datetime NOT NULL,
  PRIMARY KEY  (`doc_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- 資料表格式： `plu_document_category`
-- 

DROP TABLE IF EXISTS `plu_document_category`;
CREATE TABLE IF NOT EXISTS `plu_document_category` (
  `cate_id` int(11) NOT NULL auto_increment,
  `cate_name` varchar(20) NOT NULL,
  `cate_desc` varchar(255) NOT NULL,
  PRIMARY KEY  (`cate_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- 
-- 列出以下資料庫的數據： `plu_document_category`
-- 

INSERT INTO `plu_document_category` VALUES (1, 'Word', '一般可以編輯的範本');
INSERT INTO `plu_document_category` VALUES (2, 'PDF', '一般不可編輯的文書資料');
