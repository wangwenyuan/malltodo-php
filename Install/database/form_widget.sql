CREATE TABLE `javatodo_form_widget` (
  `id` char(25) NOT NULL DEFAULT '',
  `name` varchar(99) NOT NULL,
  `detail` text NOT NULL ,
  `is_del` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `is_del` (`is_del`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4