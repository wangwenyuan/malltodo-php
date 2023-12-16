CREATE TABLE `javatodo_form_fields` (
  `id` char(25) NOT NULL DEFAULT '',
  `fid` char(25) NOT NULL DEFAULT '',
  `name` varchar(99) NOT NULL ,
  `field_name` varchar(25) NOT NULL ,
  `field_type` varchar(25) NOT NULL,
  `field_select` varchar(1000) NOT NULL,
  `field_value` varchar(1000) NOT NULL,
  `is_required` tinyint(4) NOT NULL DEFAULT '0',
  `is_search` tinyint(4) NOT NULL DEFAULT '0',
  `is_in_list` tinyint(4) NOT NULL DEFAULT '0' ,
  `verification` varchar(25) NOT NULL,
  `type` int(11) NOT NULL DEFAULT '2' ,
  `is_del` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4