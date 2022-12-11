CREATE TABLE `javatodo_coupon_user` (
  `id` char(25) NOT NULL DEFAULT '',
  `uid` char(25) NOT NULL DEFAULT '' ,
  `coupon_id` char(25) NOT NULL DEFAULT '' ,
  `add_time` bigint(20) NOT NULL DEFAULT '0' ,
  `use_time` bigint(20) NOT NULL DEFAULT '0' ,
  `code` varchar(10) NOT NULL DEFAULT '' ,
  `code_createtime` int(11) NOT NULL DEFAULT '0' ,
  `table_name` varchar(25) NOT NULL DEFAULT '' ,
  `row_id` char(25) NOT NULL DEFAULT '' ,
  `is_use` tinyint(4) NOT NULL DEFAULT '0' ,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4