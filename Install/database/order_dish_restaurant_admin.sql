CREATE TABLE `javatodo_order_dish_restaurant_admin` (
  `id` char(25) NOT NULL DEFAULT '' ,
  `restaurant_id` char(25) NOT NULL DEFAULT '',
  `mobile` varchar(25) NOT NULL DEFAULT '' ,
  `username` varchar(99) NOT NULL DEFAULT '' ,
  `password` char(32) NOT NULL DEFAULT '' ,
  `hader_img` varchar(255) NOT NULL DEFAULT '',
  `restaurant_group_id` char(25) NOT NULL DEFAULT '' ,
  `is_master` tinyint(4) NOT NULL ,
  `apptoken` varchar(99) DEFAULT '',
  `is_del` tinyint(4) NOT NULL DEFAULT '0' ,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4