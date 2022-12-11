CREATE TABLE `javatodo_order_dish_restaurant_admin_auth` (
  `id` char(25) NOT NULL DEFAULT '',
  `restaurant_id` char(25) NOT NULL DEFAULT '',
  `restaurant_group_id` char(25) NOT NULL DEFAULT '',
  `m` varchar(20) NOT NULL DEFAULT '' ,
  `c` varchar(20) NOT NULL DEFAULT '' ,
  `a` varchar(20) NOT NULL DEFAULT '' ,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4