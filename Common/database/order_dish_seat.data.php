<?php
$table_columns = array(
    "id" => array("char", ""),
    "restaurant_id" => array("char", ""),
    "seat_area_id" => array("char", ""),
    "name" => array("varchar", ""),
    "people_number" => array("tinyint", 1),
    "is_use" => array("tinyint", 0),
    "now_people_num" => array("int", 0),
    "usetime" => array("bigint", 0),
    "is_pay" => array("tinyint", 0),
    "is_del" => array("tinyint", 0)
);