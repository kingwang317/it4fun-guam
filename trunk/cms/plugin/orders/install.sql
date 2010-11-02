
-- 
-- 資料表格式： `plu_orders`
-- 

DROP TABLE IF EXISTS `plu_orders`;
CREATE TABLE IF NOT EXISTS `plu_orders` (
  `order_id` int(11) NOT NULL auto_increment,
  `order_number` varchar(15) NOT NULL COMMENT '訂單編號',
  `member_id` int(11) NOT NULL,
  `payment_type` enum('轉帳','信用卡') NOT NULL,
  `delivery_type` enum('宅急便','超商取貨') NOT NULL,
  `order_date` date NOT NULL,
  `delivery_fees` float NOT NULL COMMENT '運費',
  `commission` float NOT NULL COMMENT '手續費',
  `order_name` varchar(10) NOT NULL,
  `order_tel` varchar(15) NOT NULL,
  `order_cellphone` varchar(15) NOT NULL,
  `order_mail` varchar(255) NOT NULL,
  `order_addr` varchar(255) NOT NULL,
  `receiver_name` varchar(10) NOT NULL,
  `receiver_tel` varchar(15) NOT NULL,
  `receiver_cellphone` varchar(15) NOT NULL,
  `receiver_mail` varchar(255) NOT NULL,
  `receiver_addr` varchar(255) NOT NULL,
  `payment_status` tinyint(1) NOT NULL,
  `recorded_status` tinyint(1) NOT NULL,
  `delivery_status` tinyint(1) NOT NULL,
  `delivery_date` date NOT NULL,
  `total_amount` double NOT NULL COMMENT '總金額',
  `memo` text NOT NULL,
  `modiTime` datetime NOT NULL,
  PRIMARY KEY  (`order_id`),
  UNIQUE KEY `order_number` (`order_number`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- 資料表格式： `plu_orders_detail`
-- 

DROP TABLE IF EXISTS `plu_orders_detail`;
CREATE TABLE IF NOT EXISTS `plu_orders_detail` (
  `order_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `unit_price` float NOT NULL COMMENT '購買單價'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

