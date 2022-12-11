CREATE TABLE `javatodo_malltodo_merchant_service` (
  `id` char(25) NOT NULL DEFAULT '',
  `merchant_id` char(25) NOT NULL ,
  `service` varchar(99) NOT NULL ,
  `end_time` bigint(20) NOT NULL ,
  `is_open` tinyint(4) NOT NULL DEFAULT '1' ,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4