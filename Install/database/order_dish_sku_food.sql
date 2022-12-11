CREATE TABLE `javatodo_order_dish_sku_food` (
  `id` char(25) NOT NULL DEFAULT '',
  `food_id` char(25) NOT NULL DEFAULT '' ,
  `restaurant_id` char(25) NOT NULL DEFAULT '',
  `sn` varchar(25) NOT NULL ,
  `sku` varchar(255) NOT NULL ,
  `price` decimal(10,2) NOT NULL ,
  `original_price` decimal(10,2) NOT NULL ,
  `pic` varchar(255) DEFAULT NULL ,
  `people_number` varchar(25) NOT NULL ,
  `is_shelves` tinyint(4) NOT NULL DEFAULT '1',
  `is_del` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4