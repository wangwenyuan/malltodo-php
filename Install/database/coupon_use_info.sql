CREATE TABLE `javatodo_coupon_use_info` (
  `id` char(25) NOT NULL DEFAULT '',
  `coupon_user_id` char(25) NOT NULL DEFAULT '',
  `log` text ,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4