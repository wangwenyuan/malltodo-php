CREATE TABLE `javatodo_order_dish_seat_area` (
  `id` char(25) NOT NULL DEFAULT '',
  `restaurant_id` char(25) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL,
  `type` tinyint(4) NOT NULL ,
  `is_del` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4