CREATE TABLE `javatodo_order_dish_seat` (
  `id` char(25) NOT NULL DEFAULT '',
  `restaurant_id` char(25) NOT NULL DEFAULT '',
  `seat_area_id` char(25) NOT NULL DEFAULT '',
  `name` varchar(32) NOT NULL,
  `people_number` tinyint(4) DEFAULT '1' ,
  `is_use` tinyint(4) NOT NULL ,
  `now_people_num` int(11) NOT NULL ,
  `usetime` bigint(20) NOT NULL DEFAULT '0' ,
  `is_pay` tinyint(4) NOT NULL DEFAULT '0' ,
  `is_del` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4