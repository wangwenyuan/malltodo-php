<?php

class BaseIndexList
{

    public $parameter = array();

    public function getValue($selfParameter, $bind_loop_list)
    {
        $p = 1;
        if (TDI("get.p")) {
            $p = (int) TDI("get.p");
        }
        if ($p == 0) {
            $p = 1;
        }
        $category_id = TDI("get.id");
        $where = array();
        // 栏目内容
        $where[CATEGORY::$is_del] = array(
            "eq",
            0
        );
        $where[CATEGORY::$id] = array(
            "eq",
            $category_id
        );
        $category = MU(CATEGORY::$_table_name)->where($where)->find();
        if ($category == null) {
            return null;
        }

        // 信息内容
        $where = array();
        $where[DETAIL::$is_del] = array(
            "eq",
            0
        );
        $category_ids = array();
        $websiteId = TDSESSION("website_id");
        require_once dirname(dirname(__DIR__)) . "/MenuCache.php";
        $all_category_list = MenuCache::getAdminMenuList($websiteId);
        $this->get_admin_menu_list($all_category_list);
        $all_category_list = $this->admin_menu_list;
        $pointer_category_level = 0;
        $open = 0; // 是否装载的开关

        for ($i = 0; $i < count($all_category_list); $i = $i + 1) {
            $cur_category_id = $all_category_list[$i]->id;
            $cur_level = $all_category_list[$i]->level;

            if ($cur_category_id == $category_id) {
                $pointer_category_level = $cur_level;
                $open = 1;
                array_push($category_ids, $cur_category_id);
                continue;
            }
            if ($open == 1) { // 说明开关处于开启状态
                if ($cur_level > $pointer_category_level) { // 说明当前栏目是目标栏目的子栏目
                    array_push($category_ids, $cur_category_id);
                } else { // 说明当前栏目不是目标栏目的子栏目
                    $open = 0;
                    break;
                }
            }
        }

        $where[DETAIL::$category_id] = array(
            "in",
            $category_ids
        );

        $count = MU(DETAIL::$_table_name)->where($where)->count();

        $page_size = 100;
        if ($bind_loop_list != null && count($bind_loop_list) > 0) {
            for ($i = 0; $i < count($bind_loop_list); $i = $i + 1) {
                $bind_loop = $bind_loop_list[$i];
                $arr = explode(":", $bind_loop);
                if ($arr[0] == "list") {
                    $page_size = $arr[1] . "";
                    break;
                }
            }
        }

        $page = new TDPAGE($count, $page_size);

        $list = MU(DETAIL::$_table_name)->where($where)
            ->limit($page->firstRow . "," . $page->listRows)
            ->order($category[CATEGORY::$order_by])
            ->select();

        for ($i = 0; $i < count($list); $i = $i + 1) {
            $list[$i][DETAIL::$release_time] = date("Y-m-d H:i:s", $list[$i][DETAIL::$release_time]);
            $list[$i]["release_time_year"] = date("Y", $list[$i][DETAIL::$release_time]);
            $list[$i]["release_time_month"] = date("m", $list[$i][DETAIL::$release_time]);
            $list[$i]["release_time_day"] = date("d", $list[$i][DETAIL::$release_time]);
            $list[$i]["release_time_hour"] = date("H", $list[$i][DETAIL::$release_time]);
            $list[$i]["release_time_minute"] = date("i", $list[$i][DETAIL::$release_time]);
            $list[$i]["release_time_second"] = date("s", $list[$i][DETAIL::$release_time]);
            if ($list[$i][DETAIL::$url] == "") {
                $url = "./index.php?m=Index&c=Index&a=detail&id=" . $list[$i][DETAIL::$id];
                $list[$i][DETAIL::$url] = $url;
            }
        }
        $object = array();
        $object["category"] = $category;

        $object[CATEGORY::$id] = $category[CATEGORY::$id];
        $object[CATEGORY::$category_name] = $category[CATEGORY::$category_name];
        $object[CATEGORY::$category_sub_name] = $category[CATEGORY::$category_sub_name];
        $object[CATEGORY::$detail] = htmlspecialchars_decode($category[CATEGORY::$detail]);
        $object[CATEGORY::$pic] = $category[CATEGORY::$pic];
        $object[CATEGORY::$pid] = $category[CATEGORY::$pid];
        $object[CATEGORY::$smalltext] = $category[CATEGORY::$smalltext];
        $object["list"] = $list;
        $object["page"] = $page->show();

        require_once __DIR__ . "/HomeIndexBread.php";
        $object["bread"] = HomeIndexBread::getBread($category_id, $category[CATEGORY::$category_name], $category[CATEGORY::$pid], "-&gt");
        $object["left_menus"] = self::getLeftMenus($category);
        // System.out.println(object);
        return $object;
    }

    public static function getLeftMenus($category)
    {
        $list = array();
        $pid = $category[CATEGORY::$pid];
        $_list = array();
        if ($pid != "0") {
            // 获取该栏目的父栏目
            $where = array();
            $where[CATEGORY::$id] = array(
                "eq",
                $category[CATEGORY::$pid]
            );
            $where[CATEGORY::$is_del] = array(
                "eq",
                0
            );
            $where[CATEGORY::$is_hidden] = array(
                "eq",
                0
            );
            $pid_category = MU(CATEGORY::$_table_name)->where($where)->find();
            if ($pid_category != null) {
                $category = $pid_category;
            }
        }
        if ($category[CATEGORY::$url] == "") {
            $url = "./index.php?m=Index&c=Index&a=category&id=" . $category[CATEGORY::$id];
            $category[CATEGORY::$url] = $url;
        } else {
            $url = $category[CATEGORY::$url];
            $url = htmlspecialchars_decode($url);
            $category[CATEGORY::$url] = $url;
        }
        array_push($list, $category);
        // 获取该栏目的所有子栏目
        $where = array();
        $where[CATEGORY::$pid] = array(
            "eq",
            $category[CATEGORY::$id]
        );
        $where[CATEGORY::$is_del] = array(
            "eq",
            0
        );
        $where[CATEGORY::$is_hidden] = array(
            "eq",
            0
        );
        $_list = MU(CATEGORY::$_table_name)->where($where)
            ->order(CATEGORY::$sort . " asc")
            ->select();
        for ($i = 0; $i < count($_list); $i = $i + 1) {
            if ($_list[$i][CATEGORY::$url] == "") {
                $url = "./index.php?m=Index&c=Index&a=category&id=" . $_list[$i][CATEGORY::$id];
                $_list[$i][CATEGORY::$url] = $url;
                array_push($list, $_list[$i]);
            } else {
                $url = $_list[$i][CATEGORY::$url];
                $url = htmlspecialchars_decode($url);
                $_list[$i][CATEGORY::$url] = $url;
                array_push($list, $_list[$i]);
            }
        }
        return $list;
    }

    private $admin_menu_list = array();

    private function get_admin_menu_list($_admin_menu_list)
    {
        for ($i = 0; $i < count($_admin_menu_list); $i = $i + 1) {
            array_push($this->admin_menu_list, $_admin_menu_list[$i]);
            if (count($_admin_menu_list[$i]->sub_menu) > 0) {
                $this->get_admin_menu_list($_admin_menu_list[$i]->sub_menu);
            }
        }
    }
}