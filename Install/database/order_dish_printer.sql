CREATE TABLE `javatodo_order_dish_printer` (
  `id` char(25) NOT NULL DEFAULT '',
  `restaurant_id` char(25) NOT NULL DEFAULT '',
  `type` varchar(25) NOT NULL ,
  `name` varchar(25) NOT NULL,
  `feie_user` varchar(32) NOT NULL,
  `feie_ukey` varchar(32) NOT NULL,
  `feie_sn` varchar(32) NOT NULL,
  `feie_key` varchar(32) NOT NULL,
  `feie_sim` varchar(32) NOT NULL,
  `is_del` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4