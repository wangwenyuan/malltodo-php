<?php

class BaseTDController extends TDCONTROLLER
{

    public function _td_init()
    {
        get_home_website_id();
    }

    public function homePage($type)
    {
        $where = array();
        $where[CATEGORY::$type] = array(
            "eq",
            $type
        );
        $where[CATEGORY::$is_del] = array(
            "eq",
            0
        );
        $info = MU(CATEGORY::$_table_name)->where($where)
            ->order(CATEGORY::$id . " asc")
            ->find();
        if ($info == null) {
            return;
        } else {
            TDREDIRECT(TDU("Index/Index/category", array(
                "id" => $info[CATEGORY::$id]
            )));
            return;
        }
    }
}