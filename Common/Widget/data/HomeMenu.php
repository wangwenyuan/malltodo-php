<?php

class HomeMenu
{

    public $parameter = array();

    public function getValue($selfParameter, $bind_loop_list)
    {
        $object = new stdClass();
        $websiteId = TDSESSION("website_id");
        require_once dirname(dirname(dirname(__DIR__))) . '/Common/MenuCache.php';
        $menu_list = MenuCache::getMenuList($websiteId);
        $object->menu_list = $menu_list;
        return $object;
    }
}