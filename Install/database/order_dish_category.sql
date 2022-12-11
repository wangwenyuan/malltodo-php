CREATE TABLE `javatodo_order_dish_category` (
  `id` char(25) NOT NULL DEFAULT '',
  `name` varchar(25) NOT NULL ,
  `alias_name` varchar(99) NOT NULL ,
  `sn` varchar(25) NOT NULL ,
  `restaurant_id` char(25) NOT NULL DEFAULT '' ,
  `is_hidden` tinyint(4) NOT NULL DEFAULT '0' ,
  `is_del` int(11) NOT NULL DEFAULT '0' ,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4