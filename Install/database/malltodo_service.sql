CREATE TABLE `javatodo_malltodo_service` (
  `id` char(25) NOT NULL DEFAULT '',
  `name` varchar(99) NOT NULL ,
  `smalltext` varchar(255) NOT NULL DEFAULT '' ,
  `service` varchar(25) NOT NULL ,
  `price` decimal(10,2) NOT NULL DEFAULT '0.00' ,
  `is_experience` tinyint(4) NOT NULL DEFAULT '0' ,
  `num` int(11) NOT NULL DEFAULT '0' ,
  `unit` varchar(5) NOT NULL ,
  `pic` varchar(255) NOT NULL,
  `detail` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4