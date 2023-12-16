CREATE TABLE `javatodo_form` (
  `id` char(25) NOT NULL DEFAULT '',
  `name` varchar(99) NOT NULL ,
  `table_name` varchar(25) NOT NULL,
  `detail` text NOT NULL,
  `is_del` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4