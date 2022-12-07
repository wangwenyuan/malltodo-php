<?php
$table_columns = array(
    "id" => array("char", ""),
    "restaurant_id" => array("char", ""),
    "restaurant_uid" => array("char", ""),
    "money" => array("decimal", 0.00),
    "invoice" => array("varchar", ""),
    "remarks" => array("varchar", ""),
    "addtime" => array("bigint", 0),
    "spend_date" => array("date", "0000-00-00"),
    "is_del" => array("tinyint", 0)
);