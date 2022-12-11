CREATE TABLE `javatodo_department` (
  `id` char(25) NOT NULL DEFAULT '',
  `pid` char(25) NOT NULL DEFAULT '',
  `name` varchar(50) NOT NULL DEFAULT '',
  `pids` text,
  `subids` text,
  `sort` int(11) NOT NULL DEFAULT '0' ,
  `is_del` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4