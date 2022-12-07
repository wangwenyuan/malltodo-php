<?php

class MenuCache
{

    public static $home_menu = array(
        "Index/Index/index" => "首页",
        "Index/News/index" => "新闻中心",
        "Index/Product/index" => "产品中心",
        "Index/Brief/index" => "公司简介",
        "Index/Business/index" => "业务范围",
        "Index/Case/index" => "应用案例",
        "Index/Album/index" => "公司相册",
        "Index/Message/index" => "客户留言",
        "Index/Job/index" => "人力招聘",
        "Index/ContactUs/index" => "联系我们",
        "Index/Category/index" => "其他栏目"
    );

    public static function init($website_id)
    {
        $where = array();
        $where[CATEGORY::$website_id] = array(
            "eq",
            $website_id
        );
        $count = MU(CATEGORY::$_table_name)->where($where)->count();
        if ($count == 0) {
            foreach (self::$home_menu as $key => $val) {
                $data = array();
                $data[CATEGORY::$category_name] = self::$home_menu[$key];
                $data[CATEGORY::$type] = $key;
                $data[CATEGORY::$pid] = 0;
                $data[CATEGORY::$website_id] = $website_id;
                MU(CATEGORY::$_table_name)->data($data)->add();
            }
        }
    }

    public static function create($website_id)
    {
        self::init($website_id);
        $list = array();
        $top = array();
        $top["id"] = 0;
        $top["pId"] = - 1;
        $top["name"] = "网站栏目（下方栏目可拖拽变更排序）--0";
        $top["open"] = true;
        $top["drag"] = true;
        $top["childOuter"] = false;
        $top["type"] = "Index/Category/index";
        $top["is_hidden"] = 0;
        $top["url"] = "";
        array_push($list, $top);

        $where = array();
        $where[CATEGORY::$is_del] = array(
            "eq",
            0
        );
        $where[CATEGORY::$website_id] = array(
            "eq",
            $website_id
        );
        $menu_list = MU(CATEGORY::$_table_name)->where($where)
            ->order(CATEGORY::$sort . " asc, " . CATEGORY::$id . " asc")
            ->select();
        for ($i = 0; $i < count($menu_list); $i = $i + 1) {
            $object = array();
            $object["id"] = $menu_list[$i][CATEGORY::$id];
            $object["pId"] = $menu_list[$i][CATEGORY::$pid];
            $object["name"] = $menu_list[$i][CATEGORY::$category_name] . "--" . $menu_list[$i][CATEGORY::$id];
            $object["open"] = true;
            $object["drag"] = true;
            $object["childOuter"] = false;
            $object["type"] = $menu_list[$i][CATEGORY::$type];
            $object["is_hidden"] = $menu_list[$i][CATEGORY::$is_hidden];
            $object["url"] = $menu_list[$i][CATEGORY::$url];
            array_push($list, $object);
        }
        $json = json_encode($list, JSON_UNESCAPED_UNICODE);
        $save_data = array();
        $save_data[MENU_CACHE::$menu] = $json;
        $save_data[MENU_CACHE::$website_id] = $website_id;
        $menu_cache_where = array();
        $menu_cache_where[MENU_CACHE::$website_id] = array(
            "eq",
            $website_id
        );
        $info = MU(MENU_CACHE::$_table_name)->where($menu_cache_where)
            ->order(MENU_CACHE::$id . " desc")
            ->find();
        if ($info) {
            $cache_where = array();
            $cache_where[MENU_CACHE::$id] = array(
                "eq",
                $info[MENU_CACHE::$id]
            );
            MU(MENU_CACHE::$_table_name)->where($cache_where)->save($save_data);
        } else {
            MU(MENU_CACHE::$_table_name)->data($save_data)->add();
        }
        return $json;
    }

    public static function get($website_id)
    {
        $where = array();
        $where[MENU_CACHE::$website_id] = array(
            "eq",
            $website_id
        );
        $info = MU(MENU_CACHE::$_table_name)->where($where)
            ->order(MENU_CACHE::$id . " desc")
            ->find();
        if ($info) {
            return self::create($website_id);
        } else {
            return $info[MENU_CACHE::$menu];
        }
    }

    public static function clean($website_id)
    {
        $where = array();
        $where[WEBSITE::$id] = array(
            "eq",
            $website_id
        );
        $data = array();
        $data[WEBSITE::$menu_list] = "";
        $data[WEBSITE::$admin_menu_list] = "";
        MU(WEBSITE::$_table_name)->where($where)->save($data);
    }

    public static function getMenuList($website_id)
    {
        $where = array();
        $where[WEBSITE::$id] = array(
            "eq",
            $website_id
        );
        $where[WEBSITE::$is_del] = array(
            "eq",
            0
        );
        $menu_list_string = MU(WEBSITE::$_table_name)->where($where)->getField(WEBSITE::$menu_list);
        if ($menu_list_string == "" || $menu_list_string == null) {
            $menu_list_string = self::BuildMenuList($website_id, "0");
            $menu_list_string = json_encode($menu_list_string, JSON_UNESCAPED_UNICODE);
            $data = array();
            $data["menu_list"] = $menu_list_string;
            MU(WEBSITE::$_table_name)->where($where)->save($data);
        }
        return json_decode($menu_list_string);
    }

    public static function getAdminMenuList($website_id)
    {
        $where = array();
        $where[WEBSITE::$id] = array(
            "eq",
            $website_id
        );
        $where[WEBSITE::$is_del] = array(
            "eq",
            0
        );
        $admin_menu_list_string = MU(WEBSITE::$_table_name)->where($where)->getField(WEBSITE::$admin_menu_list);
        if ($admin_menu_list_string == "" || $admin_menu_list_string == null) {
            $admin_menu_list_string = self::BuildAdminMenuList($website_id, "0", 0);
            $admin_menu_list_string = json_encode($admin_menu_list_string, JSON_UNESCAPED_UNICODE);
            $data = array();
            $data["admin_menu_list"] = $admin_menu_list_string;
            MU(WEBSITE::$_table_name)->where($where)->save($data);
        }
        return json_decode($admin_menu_list_string);
    }

    private static function BuildMenuList($website_id, $pid)
    {
        self::init($website_id);
        $where = array();
        $where[CATEGORY::$is_del] = array(
            "eq",
            0
        );
        $where[CATEGORY::$is_hidden] = array(
            "eq",
            0
        );
        $where[CATEGORY::$pid] = array(
            "eq",
            $pid
        );
        $where[CATEGORY::$website_id] = array(
            "eq",
            $website_id
        );
        $menu_list = MU(CATEGORY::$_table_name)->where($where)
            ->order(CATEGORY::$sort . " asc, " . CATEGORY::$id . " asc")
            ->select();
        for ($i = 0; $i < count($menu_list); $i = $i + 1) {
            $object = $menu_list[$i];
            $url = trim($object[CATEGORY::$url]);
            if ($url == "") {
                if ($object[CATEGORY::$type] == "Index/Index/index") {
                    $url = "./index.php";
                } else {
                    $url = "./index.php?m=Index&c=Index&a=category&id=" . $object[CATEGORY::$id];
                }
            }
            $object[CATEGORY::$url] = $url;
            $object["sub_menu"] = self::BuildMenuList($website_id, $object[CATEGORY::$id]);
            $menu_list[$i] = $object;
        }
        return $menu_list;
    }

    private static function BuildAdminMenuList($websiteId, $pid, $level)
    {
        self::init($websiteId);
        $where = array();
        $where[CATEGORY::$is_del] = array(
            "eq",
            0
        );
        $where[CATEGORY::$pid] = array(
            "eq",
            $pid
        );
        $where[CATEGORY::$website_id] = array(
            "eq",
            $websiteId
        );
        $menu_list = MU(CATEGORY::$_table_name)->where($where)
            ->order(CATEGORY::$sort . " asc, " . CATEGORY::$id . " asc")
            ->select();
        $admin_menu_list = array();
        for ($i = 0; $i < count($menu_list); $i = $i + 1) {
            $object = $menu_list[$i];
            $url = trim($object[CATEGORY::$url]);
            if ($url == "") {
                if ($object[CATEGORY::$type] != "Index/Category/index") {
                    if ((int) $object[CATEGORY::$pid] == 0) {
                        $url = TDUU($object[CATEGORY::$type], array(), "index.php");
                    } else {
                        $url = TDUU($object[CATEGORY::$type], array(
                            "id" => $object[CATEGORY::$id]
                        ), "index.php");
                    }
                } else {
                    $url = TDUU("Index/Category/index", array(
                        "id" => $object[CATEGORY::$id]
                    ), "index.php");
                }
            }
            $object[CATEGORY::$url] = $url;
            $object["level"] = $level;
            $object["sub_menu"] = self::BuildAdminMenuList($websiteId, $object[CATEGORY::$id], $level + 1);
            array_push($admin_menu_list, $object);
        }
        return $admin_menu_list;
    }
}