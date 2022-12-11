CREATE TABLE `javatodo_admin_tags` (
  `id` char(25) NOT NULL DEFAULT '',
  `tagname` varchar(99) NOT NULL ,
  `description` varchar(255) NOT NULL ,
  `is_del` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4