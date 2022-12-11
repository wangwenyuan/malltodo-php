CREATE TABLE `javatodo_workflow_nodes` (
  `id` char(25) NOT NULL,
  `workflow_id` char(25) NOT NULL,
  `title` varchar(99) NOT NULL,
  `description` varchar(255) NOT NULL,
  `type` varchar(25) NOT NULL,
  `level` tinyint(4) NOT NULL DEFAULT '0' ,
  `i` int(11) NOT NULL DEFAULT '0' ,
  `sub_id` char(25) NOT NULL,
  `parent_id` char(25) NOT NULL,
  `organization_user` text NOT NULL ,
  `auth` text NOT NULL ,
  `is_del` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4