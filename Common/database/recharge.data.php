<?php
$table_columns = array(
    "id" => array("char", ""),
    "uid" => array("char", ""),
    "re_order_sn" => array("varchar", ""),
    "money" => array("decimal", 0.00),
    "pay_money" => array("decimal", 0),
    "addtime" => array("bigint", 0),
    "pay_time" => array("bigint", 0),
    "transaction_id" => array("varchar", ""),
    "pay_type" => array("tinyint", 0),
    "paydate" => array("date", "0000-00-00"),
    "coupon_way" => array("tinyint", 0),
    "coupon_user_id" => array("char", ""),
    "coupon_name" => array("varchar", ""),
    "coupon_reduce_money" => array("decimal", 0.00),
    "coupon_rebate_money" => array("decimal", 0.00),
    "coupon_rebate_integral" => array("int", 0),
    "coupon_rebate_status" => array("tinyint", 0),
    "status" => array("tinyint", 0)
);