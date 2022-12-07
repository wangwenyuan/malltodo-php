<?php

class BindData
{

    public static function bind($dom, $bind_loop_list)
    {
        $object = array();
        $category = $dom->category;
        $javatodo_bind_param_key = "javatodo-bind-param";
        $bind_param = $dom->$javatodo_bind_param_key;
        if ($category == "home_menu_pc" || $category == "home_menu_mobile" || $category == "home_bottom_menu_pc" || $category == "home_bottom_menu_mobile") {
            require_once __DIR__ . "/Widget/data/HomeMenu.php";
            $object = HomeMenu::getValue($bind_param, $bind_loop_list);
        }

        return $object;
    }
}