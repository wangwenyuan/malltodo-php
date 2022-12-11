CREATE TABLE `javatodo_form_widget_field` (
  `id` char(25) NOT NULL,
  `form_widget_id` char(25) NOT NULL,
  `name` varchar(99) NOT NULL ,
  `type` varchar(25) NOT NULL ,
  `detail` varchar(99) NOT NULL ,
  `is_must` tinyint(4) NOT NULL DEFAULT '0' ,
  `is_print` tinyint(4) NOT NULL DEFAULT '0' ,
  `extend` text NOT NULL ,
  `is_del` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `is_del` (`is_del`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4