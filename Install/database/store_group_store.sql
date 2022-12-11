CREATE TABLE `javatodo_store_group_store` (
  `id` char(25) NOT NULL DEFAULT '',
  `group_id` char(25) NOT NULL DEFAULT '',
  `store_id` char(25) NOT NULL DEFAULT '',
  `is_del` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4