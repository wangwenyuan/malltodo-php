CREATE TABLE `javatodo_order_dish_seat_package` (
  `id` char(25) NOT NULL DEFAULT '',
  `restaurant_id` char(25) NOT NULL DEFAULT '',
  `order_sn` varchar(99) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `addtime` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4