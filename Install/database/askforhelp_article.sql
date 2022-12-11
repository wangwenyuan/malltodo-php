CREATE TABLE `javatodo_askforhelp_article` (
  `id` char(25) NOT NULL DEFAULT '',
  `admin_id` char(25) NOT NULL DEFAULT '',
  `uid` char(25) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL,
  `detail` text NOT NULL,
  `addtime` bigint(20) NOT NULL,
  `tags` varchar(255) NOT NULL DEFAULT '',
  `is_del` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `admin_id` (`admin_id`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4