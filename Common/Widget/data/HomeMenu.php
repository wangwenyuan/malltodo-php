<?php

class HomeMenu
{

    public $parameter = array();

    public static function getValue($selfParameter, $bind_loop_list)
    {
        $object = array();
        $websiteId = TDSESSION("website_id");
        require_once './Common/MenuCache.php';
        $menu_list = MenuCache::getMenuList($websiteId);
        $object["menu_list"] = $menu_list;
        return $object;
    }
}