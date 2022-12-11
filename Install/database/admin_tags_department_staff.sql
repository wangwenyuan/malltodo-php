CREATE TABLE `javatodo_admin_tags_department_staff` (
  `id` char(25) NOT NULL DEFAULT '',
  `admin_tags_id` char(25) NOT NULL,
  `type` varchar(25) NOT NULL ,
  `department_staff_id` char(25) NOT NULL,
  `is_del` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `type` (`type`),
  KEY `department_staff_id` (`department_staff_id`),
  KEY `admin_tags_id` (`admin_tags_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4