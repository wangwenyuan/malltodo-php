CREATE TABLE `javatodo_integral_log` (
  `id` char(25) NOT NULL DEFAULT '',
  `uid` char(25) NOT NULL DEFAULT '',
  `admin_id` char(25) NOT NULL DEFAULT '',
  `integral` int(11) NOT NULL DEFAULT '0',
  `table_name` varchar(99) NOT NULL ,
  `row_id` char(25) NOT NULL DEFAULT '' ,
  `addtime` bigint(20) NOT NULL DEFAULT '0' ,
  `log` varchar(255) NOT NULL ,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4