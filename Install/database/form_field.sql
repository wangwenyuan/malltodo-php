CREATE TABLE `javatodo_form_field` (
  `id` char(25) NOT NULL DEFAULT '',
  `form_id` char(25) NOT NULL DEFAULT '',
  `name` varchar(99) NOT NULL DEFAULT '',
  `field_name` varchar(25) NOT NULL DEFAULT '',
  `type` varchar(25) NOT NULL DEFAULT '',
  `is_in_list` tinyint(4) NOT NULL DEFAULT '0',
  `is_search` tinyint(4) NOT NULL DEFAULT '0',
  `addtime` bigint(20) NOT NULL,
  `modify_time` bigint(20) NOT NULL,
  `admin_id` char(25) NOT NULL,
  `uid` char(25) NOT NULL,
  `is_del` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `is_del` (`is_del`),
  KEY `is_del_2` (`is_del`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4