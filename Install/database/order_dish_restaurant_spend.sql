CREATE TABLE `javatodo_order_dish_restaurant_spend` (
  `id` char(25) NOT NULL DEFAULT '',
  `restaurant_id` char(25) NOT NULL DEFAULT '',
  `restaurant_uid` char(25) NOT NULL DEFAULT '',
  `money` decimal(10,2) NOT NULL DEFAULT '0.00',
  `invoice` varchar(99) NOT NULL DEFAULT '',
  `remarks` varchar(255) NOT NULL DEFAULT '',
  `addtime` bigint(20) NOT NULL DEFAULT '0',
  `spend_date` date NOT NULL DEFAULT '0000-00-00',
  `is_del` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4