CREATE TABLE IF NOT EXISTS `#__jshopping_products_to_categories` (
  `id` int(11) NOT NULL,
  `message` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `message_type` int(11) NOT NULL,
  PRIMARY KEY (`product_id`,`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;