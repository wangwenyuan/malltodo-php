CREATE TABLE `javatodo_order_dish_restaurant_food_stock` (
  `id` char(25) NOT NULL DEFAULT '',
  `stock_sn` varchar(25) NOT NULL DEFAULT '',
  `type` tinyint(4) NOT NULL DEFAULT '1' ,
  `food_id` char(25) NOT NULL DEFAULT '',
  `food_name` varchar(255) NOT NULL DEFAULT '',
  `sku_food_id` char(25) NOT NULL DEFAULT '',
  `sku` varchar(255) NOT NULL DEFAULT '',
  `num` int(11) NOT NULL DEFAULT '0',
  `addtime` bigint(20) NOT NULL DEFAULT '0',
  `remark` varchar(255) NOT NULL DEFAULT '',
  `admin_id` char(25) NOT NULL,
  `restaurant_id` char(25) NOT NULL DEFAULT '',
  `restaurant_uid` char(25) NOT NULL DEFAULT '',
  `return_order_id` char(25) NOT NULL DEFAULT '' ,
  `is_del` tinyint(4) NOT NULL ,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4