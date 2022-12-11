CREATE TABLE `javatodo_order_dish_restaurant_category` (
  `id` char(25) NOT NULL DEFAULT '',
  `restaurant_id` char(25) NOT NULL DEFAULT '',
  `category_id` char(25) NOT NULL DEFAULT '',
  `is_hidden` int(11) NOT NULL,
  `sort` int(11) NOT NULL ,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4