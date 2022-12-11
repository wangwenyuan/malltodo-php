CREATE TABLE `javatodo_askforhelp_document` (
  `id` char(25) NOT NULL DEFAULT '',
  `admin_id` char(25) NOT NULL DEFAULT '',
  `language` varchar(25) NOT NULL DEFAULT '',
  `framework` varchar(25) NOT NULL DEFAULT '',
  `chapter` varchar(25) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL,
  `detail` text NOT NULL,
  `addtime` bigint(20) NOT NULL,
  `is_del` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `language` (`language`),
  KEY `framework` (`framework`),
  KEY `chapter` (`chapter`),
  KEY `title` (`title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4