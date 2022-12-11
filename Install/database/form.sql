CREATE TABLE `javatodo_form` (
  `id` char(25) NOT NULL DEFAULT '',
  `name` varchar(99) NOT NULL ,
  `detail` text NOT NULL ,
  `fields_sort` text NOT NULL ,
  `is_del` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `is_del` (`is_del`),
  KEY `is_del_2` (`is_del`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4