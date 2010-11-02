-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- 主機: localhost
-- 建立日期: May 10, 2010, 05:27 PM
-- 伺服器版本: 5.0.51
-- PHP 版本: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- 資料庫: `yata_cms`
-- 

-- --------------------------------------------------------

-- 
-- 資料表格式： `plu_mrtstation`
-- 

DROP TABLE IF EXISTS `plu_mrtstation`;
CREATE TABLE IF NOT EXISTS `plu_mrtstation` (
  `id` varchar(5) NOT NULL COMMENT '根據台北捷運局網站的編碼',
  `name` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- 列出以下資料庫的數據： `plu_mrtstation`
-- 

INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('019', '動物園站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('018', '木柵站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('017', '萬芳社區站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('016', '萬芳醫院站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('015', '辛亥站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('014', '麟光站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('013', '六張犁站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('012', '科技大樓站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('011', '大安站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('010', '忠孝復興站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('009', '南京東路站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('008', '中山國中站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('007', '松山機場站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('021', '大直站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('022', '劍南路站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('023', '西湖站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('024', '港墘站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('025', '文德站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('026', '內湖站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('027', '大湖公園站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('028', '葫洲站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('029', '東湖站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('030', '南港軟體園區站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('031', '南港展覽館站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('071', '淡水站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('070', '紅樹林站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('069', '竹圍站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('068', '關渡站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('067', '忠義站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('066', '復興崗站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('065', '新北投站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('064', '北投站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('063', '奇岩站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('062', '唭哩岸站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('061', '石牌站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('060', '明德站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('059', '芝山站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('058', '士林站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('057', '劍潭站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('056', '圓山站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('055', '民權西路站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('054', '雙連站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('053', '中山站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('051', '台北車站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('050', '台大醫院站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('042', '中正紀念堂站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('043', '小南門站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('041', '古亭站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('040', '台電大樓站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('039', '公館站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('038', '萬隆站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('037', '景美站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('036', '大坪林站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('035', '七張站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('034', '新店市公所站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('033', '新店站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('032', '小碧潭站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('045', '頂溪站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('046', '永安市場站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('047', '景安站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('048', '南勢角站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('097', '南港站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('096', '昆陽站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('095', '後山埤站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('094', '永春站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('093', '市政府站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('092', '國父紀念館站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('091', '忠孝敦化站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('010', '忠孝復興站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('089', '忠孝新生站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('088', '善導寺站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('051', '台北車站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('086', '西門站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('085', '龍山寺站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('084', '江子翠站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('083', '新埔站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('082', '板橋站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('081', '府中站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('080', '亞東醫院站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('079', '海山站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('078', '土城站');
INSERT INTO `plu_mrtstation` (`id`, `name`) VALUES ('077', '永寧站');

-- --------------------------------------------------------

-- 
-- 資料表格式： `plu_objects`
-- 

DROP TABLE IF EXISTS `plu_objects`;
CREATE TABLE IF NOT EXISTS `plu_objects` (
  `object_id` int(11) NOT NULL auto_increment,
  `publish_date` datetime NOT NULL COMMENT '預計公佈日期',
  `county` int(11) NOT NULL COMMENT '縣市',
  `district` int(11) NOT NULL COMMENT '行政區',
  `obj_addr` varchar(255) NOT NULL COMMENT '物件地址',
  `obj_type` enum('大樓／住家','大樓／住辦','大樓／套房','公寓／住家','公寓／一樓','公寓／別墅','商用／辦公','商用／廠辦','店面／透天','店面／一樓','透天／住家','透天／別墅','其他／車位') NOT NULL COMMENT '類型',
  `auction_inst` enum('台北法院','士林法院','板橋法院','金拍公司','行政執行處','其他機關') NOT NULL COMMENT '拍賣機關',
  `auction_no` varchar(30) NOT NULL COMMENT '案號',
  `auction_times` enum('1拍','2拍','3拍','應買','特拍') NOT NULL COMMENT '拍次',
  `auction_checked` enum('點交','部分點交','不點交') NOT NULL COMMENT '點交否',
  `auction_date` datetime NOT NULL COMMENT '開標日期',
  `auction_base_price` float NOT NULL COMMENT '拍賣底價',
  `margin` float NOT NULL COMMENT '保證金',
  `auction_result` enum('待標中','流標','停拍','撤回','拍定') NOT NULL COMMENT '開拍結果',
  `auction_price` float NOT NULL COMMENT '開拍結果金額',
  `auction_memo_price` float NOT NULL COMMENT '拍定單價;拍定價/總坪數',
  `unit_price` float NOT NULL COMMENT '拍定單價',
  `bank_name_1` varchar(30) NOT NULL COMMENT '他項權利-銀行',
  `bank_value_1` float NOT NULL COMMENT '他項權利-金額',
  `bank_name_2` varchar(30) NOT NULL,
  `bank_value_2` float NOT NULL,
  `bank_name_3` varchar(30) NOT NULL,
  `bank_value_3` float NOT NULL,
  `seal_date` date NOT NULL COMMENT '查封日期',
  `debtee` varchar(30) NOT NULL COMMENT '債權人',
  `memo` text NOT NULL COMMENT '筆錄',
  `mrtStation` int(11) NOT NULL COMMENT '捷運站',
  `community` varchar(30) NOT NULL COMMENT '社區名稱',
  `management_fee_type` enum('每月','每坪','每季') NOT NULL COMMENT '管理費付費種類',
  `management_fee` int(11) NOT NULL COMMENT '管理費',
  `rent_type` enum('每月','每坪') NOT NULL COMMENT '租金種類',
  `rent_fee` int(11) NOT NULL COMMENT '租金',
  `parking_type` enum('平面','機械') NOT NULL COMMENT '車位種類',
  `parking_fee` int(11) NOT NULL COMMENT '車位租金',
  `area_intro_desc` varchar(255) NOT NULL COMMENT '區域介紹說明',
  `quotations_addr_1` varchar(255) NOT NULL COMMENT '附近拍定行情地址1',
  `quotations_type_1` enum('大樓／住家','大樓／住辦','大樓／套房','公寓／住家','公寓／一樓','公寓／別墅','商用／辦公','商用／廠辦','店面／透天','店面／一樓','透天／住家','透天／別墅','其他／車位') NOT NULL COMMENT '類型',
  `quotations_date_1` date NOT NULL COMMENT '拍定日期',
  `quotations_times_1` enum('1拍','2拍','3拍','應買','特拍') NOT NULL COMMENT '拍次',
  `quotations_price_1` float NOT NULL COMMENT '拍定價金',
  `quotations_totalprice_1` float NOT NULL COMMENT '總坪數金額',
  `quotations_unitprice_1` float NOT NULL COMMENT '單價',
  `quotations_addr_2` varchar(255) NOT NULL COMMENT '附近拍定行情地址2',
  `quotations_type_2` enum('大樓／住家','大樓／住辦','大樓／套房','公寓／住家','公寓／一樓','公寓／別墅','商用／辦公','商用／廠辦','店面／透天','店面／一樓','透天／住家','透天／別墅','其他／車位') NOT NULL,
  `quotations_date_2` date NOT NULL,
  `quotations_times_2` enum('1拍','2拍','3拍','應買','特拍') NOT NULL,
  `quotations_price_2` float NOT NULL,
  `quotations_totalprice_2` float NOT NULL,
  `quotations_unitprice_2` float NOT NULL,
  `house_desc_1` varchar(255) NOT NULL COMMENT '即時房訊說明1',
  `house_desc_2` varchar(255) NOT NULL,
  `house_desc_3` varchar(255) NOT NULL,
  `court_url` varchar(255) NOT NULL COMMENT '法院拍賣公告網址',
  `curt_desc` varchar(255) NOT NULL COMMENT '網址說明',
  `structure_desc` varchar(255) NOT NULL COMMENT '物件圖片說明',
  `pic_desc_1` varchar(255) NOT NULL,
  `pic_desc_2` varchar(255) NOT NULL,
  `pic_desc_3` varchar(255) NOT NULL,
  `pic_desc_4` varchar(255) NOT NULL,
  `pic_desc_5` varchar(255) NOT NULL,
  `pic_desc_6` varchar(255) NOT NULL,
  `pic_desc_7` varchar(255) NOT NULL,
  `pic_desc_8` varchar(255) NOT NULL,
  `analysis_memo` text NOT NULL COMMENT '物件研析',
  `ModiTime` datetime NOT NULL,
  PRIMARY KEY  (`object_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- 
-- 列出以下資料庫的數據： `plu_objects`
-- 

INSERT INTO `plu_objects` (`object_id`, `publish_date`, `county`, `district`, `obj_addr`, `obj_type`, `auction_inst`, `auction_no`, `auction_times`, `auction_checked`, `auction_date`, `auction_base_price`, `margin`, `auction_result`, `auction_price`, `auction_memo_price`, `unit_price`, `bank_name_1`, `bank_value_1`, `bank_name_2`, `bank_value_2`, `bank_name_3`, `bank_value_3`, `seal_date`, `debtee`, `memo`, `mrtStation`, `community`, `management_fee_type`, `management_fee`, `rent_type`, `rent_fee`, `parking_type`, `parking_fee`, `area_intro_desc`, `quotations_addr_1`, `quotations_type_1`, `quotations_date_1`, `quotations_times_1`, `quotations_price_1`, `quotations_totalprice_1`, `quotations_unitprice_1`, `quotations_addr_2`, `quotations_type_2`, `quotations_date_2`, `quotations_times_2`, `quotations_price_2`, `quotations_totalprice_2`, `quotations_unitprice_2`, `house_desc_1`, `house_desc_2`, `house_desc_3`, `court_url`, `curt_desc`, `structure_desc`, `pic_desc_1`, `pic_desc_2`, `pic_desc_3`, `pic_desc_4`, `pic_desc_5`, `pic_desc_6`, `pic_desc_7`, `pic_desc_8`, `analysis_memo`, `ModiTime`) VALUES (1, '2010-05-01 00:00:00', 1, 108, '西藏路223號', '大樓／住家', '台北法院', 'A99101', '1拍', '點交', '2010-05-18 16:00:00', 700, 100, '待標中', 800, 800, 800, '富邦銀行', 200, '國泰世華', 100, '', 0, '2010-03-01', '李阿滿', '欠錢不還，工廠惡性倒閉', 85, '', '', 0, '', 0, '', 0, '蕭敬驣', '台北市萬華區中華路二路1號', '大樓／住家', '2010-02-01', '特拍', 1800, 2000, 2000, '台北市萬華區中華路二段31號', '公寓／住家', '2010-01-06', '2拍', 700, 700, 700, '吳克群', '盧廣仲', '陳綺貞', 'http://www.gov.tw/1234.html', '1234', '', '周杰倫', 'Deep Purple', 'The Calling', 'Vanessa', '', '', '', '', '測試', '2010-05-09 17:08:43');
INSERT INTO `plu_objects` (`object_id`, `publish_date`, `county`, `district`, `obj_addr`, `obj_type`, `auction_inst`, `auction_no`, `auction_times`, `auction_checked`, `auction_date`, `auction_base_price`, `margin`, `auction_result`, `auction_price`, `auction_memo_price`, `unit_price`, `bank_name_1`, `bank_value_1`, `bank_name_2`, `bank_value_2`, `bank_name_3`, `bank_value_3`, `seal_date`, `debtee`, `memo`, `mrtStation`, `community`, `management_fee_type`, `management_fee`, `rent_type`, `rent_fee`, `parking_type`, `parking_fee`, `area_intro_desc`, `quotations_addr_1`, `quotations_type_1`, `quotations_date_1`, `quotations_times_1`, `quotations_price_1`, `quotations_totalprice_1`, `quotations_unitprice_1`, `quotations_addr_2`, `quotations_type_2`, `quotations_date_2`, `quotations_times_2`, `quotations_price_2`, `quotations_totalprice_2`, `quotations_unitprice_2`, `house_desc_1`, `house_desc_2`, `house_desc_3`, `court_url`, `curt_desc`, `structure_desc`, `pic_desc_1`, `pic_desc_2`, `pic_desc_3`, `pic_desc_4`, `pic_desc_5`, `pic_desc_6`, `pic_desc_7`, `pic_desc_8`, `analysis_memo`, `ModiTime`) VALUES (2, '2010-05-11 00:00:00', 1, 105, '松仁路223號5樓', '大樓／住家', '台北法院', 'A97101', '1拍', '點交', '2010-05-19 15:00:00', 800, 100, '待標中', 500, 500, 1000, '', 0, '', 0, '', 0, '0000-00-00', '', '', 0, '', '', 0, '', 0, '', 0, '', '', '', '0000-00-00', '', 0, 0, 0, '', '', '0000-00-00', '', 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '測試2', '2010-05-09 17:53:48');
INSERT INTO `plu_objects` (`object_id`, `publish_date`, `county`, `district`, `obj_addr`, `obj_type`, `auction_inst`, `auction_no`, `auction_times`, `auction_checked`, `auction_date`, `auction_base_price`, `margin`, `auction_result`, `auction_price`, `auction_memo_price`, `unit_price`, `bank_name_1`, `bank_value_1`, `bank_name_2`, `bank_value_2`, `bank_name_3`, `bank_value_3`, `seal_date`, `debtee`, `memo`, `mrtStation`, `community`, `management_fee_type`, `management_fee`, `rent_type`, `rent_fee`, `parking_type`, `parking_fee`, `area_intro_desc`, `quotations_addr_1`, `quotations_type_1`, `quotations_date_1`, `quotations_times_1`, `quotations_price_1`, `quotations_totalprice_1`, `quotations_unitprice_1`, `quotations_addr_2`, `quotations_type_2`, `quotations_date_2`, `quotations_times_2`, `quotations_price_2`, `quotations_totalprice_2`, `quotations_unitprice_2`, `house_desc_1`, `house_desc_2`, `house_desc_3`, `court_url`, `curt_desc`, `structure_desc`, `pic_desc_1`, `pic_desc_2`, `pic_desc_3`, `pic_desc_4`, `pic_desc_5`, `pic_desc_6`, `pic_desc_7`, `pic_desc_8`, `analysis_memo`, `ModiTime`) VALUES (3, '2010-05-07 00:00:00', 1, 100, '愛國東路1號13樓', '公寓／住家', '台北法院', '98司戊50317甲', '2拍', '點交', '2010-05-27 09:00:00', 1000, 200, '待標中', 0, 0, 0, '', 0, '', 0, '', 0, '0000-00-00', '', '', 0, '', '', 0, '', 0, '', 0, '', '', '', '0000-00-00', '', 0, 0, 0, '', '', '0000-00-00', '', 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '此房可投資', '2010-05-11 01:01:35');

-- --------------------------------------------------------

-- 
-- 資料表格式： `plu_objects_household`
-- 

DROP TABLE IF EXISTS `plu_objects_household`;
CREATE TABLE IF NOT EXISTS `plu_objects_household` (
  `household_no` int(11) NOT NULL auto_increment COMMENT '戶號',
  `object_id` int(11) NOT NULL,
  `square_feet_result` enum('持分','全部') NOT NULL COMMENT '土地持有情況',
  `land_ping` float NOT NULL COMMENT '坪數',
  `tax` int(11) NOT NULL COMMENT '土地增值稅',
  `tax_value` float NOT NULL COMMENT '土地增值稅金額',
  `deadline` float NOT NULL COMMENT '完工年份',
  `structure` enum('SRC鋼骨','SRC鋼筋','RC鋼筋','加強磚造','其他') NOT NULL COMMENT '結構',
  `usage` enum('商業用','住家用','國民住宅','住商用','住工用','工業用','工商用','其他') NOT NULL COMMENT '用途',
  `total_area` float NOT NULL COMMENT '建物總坪數',
  `main_area` float NOT NULL COMMENT '主建物',
  `append_item_1` enum('陽台','平台','露台','騎樓','夾層','地下室','增建','公設','車位') NOT NULL COMMENT '附屬建物1',
  `append_area_1` float NOT NULL COMMENT '附屬建物1坪數',
  `append_item_2` enum('陽台','平台','露台','騎樓','夾層','地下室','增建','公設','車位') NOT NULL,
  `append_area_2` float NOT NULL,
  `append_item_3` enum('陽台','平台','露台','騎樓','夾層','地下室','增建','公設','車位') NOT NULL,
  `append_area_3` float NOT NULL,
  `append_item_4` enum('陽台','平台','露台','騎樓','夾層','地下室','增建','公設','車位') NOT NULL,
  `append_area_4` float NOT NULL,
  `append_item_5` enum('陽台','平台','露台','騎樓','夾層','地下室','增建','公設','車位') NOT NULL,
  `append_area_5` float NOT NULL,
  `append_item_6` enum('陽台','平台','露台','騎樓','夾層','地下室','增建','公設','車位') NOT NULL,
  `append_area_6` float NOT NULL,
  `append_item_7` varchar(30) NOT NULL,
  `append_area_7` float NOT NULL,
  PRIMARY KEY  (`household_no`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- 
-- 列出以下資料庫的數據： `plu_objects_household`
-- 

INSERT INTO `plu_objects_household` (`household_no`, `object_id`, `square_feet_result`, `land_ping`, `tax`, `tax_value`, `deadline`, `structure`, `usage`, `total_area`, `main_area`, `append_item_1`, `append_area_1`, `append_item_2`, `append_area_2`, `append_item_3`, `append_area_3`, `append_item_4`, `append_area_4`, `append_item_5`, `append_area_5`, `append_item_6`, `append_area_6`, `append_item_7`, `append_area_7`) VALUES (1, 1, '持分', 30, 1, 20, 20, '加強磚造', '住家用', 30, 30, '騎樓', 5, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `plu_objects_household` (`household_no`, `object_id`, `square_feet_result`, `land_ping`, `tax`, `tax_value`, `deadline`, `structure`, `usage`, `total_area`, `main_area`, `append_item_1`, `append_area_1`, `append_item_2`, `append_area_2`, `append_item_3`, `append_area_3`, `append_item_4`, `append_area_4`, `append_item_5`, `append_area_5`, `append_item_6`, `append_area_6`, `append_item_7`, `append_area_7`) VALUES (2, 2, '持分', 5, 0, 0, 10, '加強磚造', '住家用', 500, 400, '公設', 100, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);
INSERT INTO `plu_objects_household` (`household_no`, `object_id`, `square_feet_result`, `land_ping`, `tax`, `tax_value`, `deadline`, `structure`, `usage`, `total_area`, `main_area`, `append_item_1`, `append_area_1`, `append_item_2`, `append_area_2`, `append_item_3`, `append_area_3`, `append_item_4`, `append_area_4`, `append_item_5`, `append_area_5`, `append_item_6`, `append_area_6`, `append_item_7`, `append_area_7`) VALUES (3, 3, '持分', 100, 0, 0, 15, 'SRC鋼筋', '住家用', 0, 800, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0, '', 0);

-- --------------------------------------------------------

-- 
-- 資料表格式： `plu_objects_pic`
-- 

DROP TABLE IF EXISTS `plu_objects_pic`;
CREATE TABLE IF NOT EXISTS `plu_objects_pic` (
  `object_id` int(11) NOT NULL,
  `item` varchar(30) NOT NULL,
  `filename` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- 
-- 列出以下資料庫的數據： `plu_objects_pic`
-- 

INSERT INTO `plu_objects_pic` (`object_id`, `item`, `filename`) VALUES (1, 'area_intro', 'objects_1_area_intro.jpg');
INSERT INTO `plu_objects_pic` (`object_id`, `item`, `filename`) VALUES (1, 'quotations_pic_1', 'objects_1_quotations_pic_1.jpg');
INSERT INTO `plu_objects_pic` (`object_id`, `item`, `filename`) VALUES (1, 'quotations_pic_2', 'objects_1_quotations_pic_2.jpg');
INSERT INTO `plu_objects_pic` (`object_id`, `item`, `filename`) VALUES (1, 'house_pic_1', 'objects_1_house_pic_1.jpg');
INSERT INTO `plu_objects_pic` (`object_id`, `item`, `filename`) VALUES (1, 'house_pic_2', 'objects_1_house_pic_2.jpg');
INSERT INTO `plu_objects_pic` (`object_id`, `item`, `filename`) VALUES (1, 'house_pic_3', 'objects_1_house_pic_3.jpg');
INSERT INTO `plu_objects_pic` (`object_id`, `item`, `filename`) VALUES (1, 'structure_pic_1', 'objects_1_structure_pic_1.jpg');
INSERT INTO `plu_objects_pic` (`object_id`, `item`, `filename`) VALUES (1, 'structure_pic_2', 'objects_1_structure_pic_2.jpg');
INSERT INTO `plu_objects_pic` (`object_id`, `item`, `filename`) VALUES (1, 'structure_other_pic', 'objects_1_structure_other_pic.jpg');
INSERT INTO `plu_objects_pic` (`object_id`, `item`, `filename`) VALUES (1, 'pic_1', 'objects_1_pic_1.jpg');
INSERT INTO `plu_objects_pic` (`object_id`, `item`, `filename`) VALUES (1, 'pic_2', 'objects_1_pic_2.jpg');
INSERT INTO `plu_objects_pic` (`object_id`, `item`, `filename`) VALUES (1, 'pic_3', 'objects_1_pic_3.jpg');
INSERT INTO `plu_objects_pic` (`object_id`, `item`, `filename`) VALUES (1, 'pic_4', 'objects_1_pic_4.jpg');
ALTER TABLE `plu_objects` ADD `mrtLine` INT NOT NULL AFTER `memo` ;
ALTER TABLE `plu_objects` ADD `auction_result_memo` VARCHAR( 50 ) NOT NULL AFTER `auction_result` ;
ALTER TABLE `plu_objects` CHANGE `auction_memo_price` `announce_unit_price` FLOAT NOT NULL COMMENT '每坪單價;公告底價/建物總坪數' 
ALTER TABLE `plu_objects_household` CHANGE `append_item_1` `append_item_1` ENUM('陽台','平台','露台','騎樓','夾層','地下室','增建','屋頂突出物','公設','車位') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '附屬建物1', 
CHANGE `append_item_2` `append_item_2` ENUM('陽台','平台','露台','騎樓','夾層','地下室','增建','屋頂突出物','公設','車位') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, 
CHANGE `append_item_3` `append_item_3` ENUM('陽台','平台','露台','騎樓','夾層','地下室','增建','屋頂突出物','公設','車位') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, 
CHANGE `append_item_4` `append_item_4` ENUM('陽台','平台','露台','騎樓','夾層','地下室','增建','屋頂突出物','公設','車位') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, 
CHANGE `append_item_5` `append_item_5` ENUM('陽台','平台','露台','騎樓','夾層','地下室','增建','屋頂突出物','公設','車位') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, 
CHANGE `append_item_6` `append_item_6` ENUM('陽台','平台','露台','騎樓','夾層','地下室','增建','屋頂突出物','公設','車位') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL