<?php
$table_columns = array(
    "id" => array("char", ""),
    "merchant_id" => array("char", ""),
    "service_name" => array("varchar", ""),
    "service" => array("varchar", ""),
    "is_experience" => array("tinyint", 0),
    "num" => array("int", 0),
    "unit" => array("varchar", ""),
    "addtime" => array("bigint", 0),
    "order_money" => array("decimal", 0.00),
    "discount" => array("decimal", 0.00),
    "all_money" => array("decimal", 0.00),
    "pay_type" => array("tinyint", 0),
    "pay_channel" => array("varchar", ""),
    "paytime" => array("bigint", 0),
    "paydate" => array("date", "0000-00-00"),
    "transaction_id" => array("varchar", ""),
    "status" => array("tinyint", 0)
);