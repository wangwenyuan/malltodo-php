CREATE TABLE `javatodo_order_dish_restaurant` (
  `id` char(25) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL ,
  `tel` varchar(25) NOT NULL ,
  `leader` varchar(25) NOT NULL ,
  `mobile` varchar(25) NOT NULL ,
  `lng` double NOT NULL,
  `lat` double NOT NULL,
  `address` varchar(255) NOT NULL ,
  `mch_id` varchar(99) NOT NULL DEFAULT '' ,
  `is_del` tinyint(4) NOT NULL DEFAULT '0' ,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4