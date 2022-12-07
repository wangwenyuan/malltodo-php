<?php
$table_columns = array(
    "id" => array("char", ""),
    "admin_id" => array("char", ""),
    "restaurant_id" => array("char", ""),
    "order_dish_category_id" => array("char", ""),
    "food_name" => array("varchar", ""),
    "sn" => array("varchar", ""),
    "pic" => array("varchar", ""),
    "detail" => array("mediumtext", ""),
    "create_time" => array("bigint", 0),
    "price" => array("decimal", 0),
    "original_price" => array("decimal", 0),
    "sku_item" => array("text", ""),
    "pics" => array("text", ""),
    "people_number" => array("varchar", ""),
    "is_shelves" => array("tinyint", 1),
    "is_examine" => array("tinyint", 0),
    "examine_time" => array("bigint", 0),
    "examine_admin_id" => array("char", ""),
    "no_pass_reason" => array("varchar", ""),
    "is_del" => array("tinyint", 0)
);