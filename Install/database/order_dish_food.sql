CREATE TABLE `javatodo_order_dish_food` (
  `id` char(25) NOT NULL DEFAULT '',
  `admin_id` char(25) NOT NULL DEFAULT '',
  `restaurant_id` char(25) NOT NULL DEFAULT '',
  `order_dish_category_id` char(25) NOT NULL DEFAULT '' ,
  `food_name` varchar(255) NOT NULL DEFAULT '' ,
  `sn` varchar(25) NOT NULL ,
  `pic` varchar(255) NOT NULL DEFAULT '',
  `detail` mediumtext NOT NULL,
  `create_time` bigint(20) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `original_price` decimal(10,2) NOT NULL ,
  `sku_item` text NOT NULL ,
  `pics` text NOT NULL ,
  `people_number` varchar(25) NOT NULL ,
  `is_shelves` tinyint(4) NOT NULL DEFAULT '1' ,
  `is_examine` tinyint(4) NOT NULL ,
  `examine_time` bigint(20) NOT NULL ,
  `examine_admin_id` char(25) NOT NULL DEFAULT '' ,
  `no_pass_reason` varchar(255) NOT NULL ,
  `is_del` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4