<?php
$table_columns = array(
    "id" => array("char", ""),
    "workflow_id" => array("char", ""),
    "title" => array("varchar", ""),
    "description" => array("varchar", ""),
    "type" => array("varchar", ""),
    "level" => array("tinyint", 0),
    "i" => array("int", 0),
    "sub_id" => array("char", ""),
    "parent_id" => array("char", ""),
    "organization_user" => array("text", ""),
    "auth" => array("text", ""),
    "is_del" => array("tinyint", 0)
);