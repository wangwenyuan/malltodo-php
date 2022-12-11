CREATE TABLE `javatodo_order_dish_restaurant_food` (
  `id` char(25) NOT NULL DEFAULT '',
  `restaurant_id` char(25) NOT NULL DEFAULT '',
  `food_id` char(25) NOT NULL DEFAULT '',
  `sku_food_id` char(25) NOT NULL DEFAULT '',
  `sku` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `num` int(11) NOT NULL DEFAULT '0',
  `is_shelves` tinyint(4) NOT NULL,
  `printer_id` char(25) NOT NULL DEFAULT '' ,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4