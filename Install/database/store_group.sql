CREATE TABLE `javatodo_store_group` (
  `id` char(25) NOT NULL DEFAULT '',
  `name` varchar(99) NOT NULL,
  `is_del` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4