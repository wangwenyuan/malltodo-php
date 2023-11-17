<?php

class BaseIndex
{

    public $parameter = array(
        "is_pic" => array(
            "_title" => "只调含标题图片的信息",
            "0" => "否",
            "1" => "是"
        ),
        "recommend_level" => array(
            "_title" => "调用的信息的推荐等级",
            "0" => "不推荐",
            "1" => "一级推荐",
            "2" => "二级推荐",
            "3" => "三级推荐",
            "4" => "四级推荐",
            "5" => "五级推荐",
            "6" => "六级推荐",
            "7" => "七级推荐",
            "8" => "八级推荐",
            "9" => "九级推荐"
        ),
        "category_id" => array(
            "_title" => "所属栏目",
            "0" => "所有栏目"
        )
    );

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

    public $type = "";

    public $category_type = "";

    public function __construct()
    {
        $websiteId = TDSESSION("website_id");
        require_once dirname(dirname(__DIR__)) . "/MenuCache.php";
        $all_category_list = MenuCache::getAdminMenuList($websiteId);
        $this->get_admin_menu_list($all_category_list);
        $all_category_list = $this->admin_menu_list;
        for ($i = 0; $i < count($all_category_list); $i = $i + 1) {
            if ($all_category_list[$i]->type == $this->category_type) {
                $_category_name = $all_category_list[$i]->category_name;
                $_split_sign = "——";
                for ($n = 0; $n < (int) $all_category_list[$i]->level; $n = $n + 1) {
                    $_split_sign = $_split_sign . "——";
                }
                $_category_name = $_split_sign . " " . $_category_name;
                $this->parameter["category_id"][$all_category_list[$i]->id] = $_category_name;
            }
        }
    }

    public function getValue($selfParameter, $bind_loop_list)
    {
        if ($selfParameter == null) {
            return null;
        }

        $where = array();
        $where[DETAIL::$is_del] = array(
            "eq",
            0
        );
        $where[DETAIL::$type] = array(
            "eq",
            $this->type
        );
        $is_pic = $selfParameter->is_pic;
        if ($is_pic == null) {
            return null;
        }
        if ($is_pic != "0") {
            $where[DETAIL::$pic] = array(
                "neq",
                ""
            );
        }
        $recommend_level = $selfParameter->recommend_level;
        if ($recommend_level == null) {
            return null;
        }
        if ($recommend_level != "0") {
            $where[DETAIL::$recommend_level] = array(
                "eq",
                $recommend_level
            );
        }

        if ((int) $selfParameter->category_id != 0) {
            $category_id = $selfParameter->category_id;
            $category_ids = array();
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
        }

        $page_size = "100";
        if ($bind_loop_list != null && count($bind_loop_list) > 0) {
            for ($i = 0; $i < count($bind_loop_list); $i = $i + 1) {
                $bind_loop = $bind_loop_list[$i];
                $arr = explode(":", $bind_loop);
                if (trim($arr[0]) == "list") {
                    $page_size = $arr[1] . "";
                    break;
                }
            }
        }
        $list = MU(DETAIL::$_table_name)->where($where)
            ->limit($page_size)
            ->order('sort desc , ' . DETAIL::$id . " desc")
            ->select();
        for ($i = 0; $i < count($list); $i = $i + 1) {
            $time = $list[$i][DETAIL::$release_time];
            $list[$i]["release_time_year"] = date("Y", $list[$i][DETAIL::$release_time]);
            $list[$i]["release_time_month"] = date("m", $list[$i][DETAIL::$release_time]);
            $list[$i]["release_time_day"] = date("d", $list[$i][DETAIL::$release_time]);
            $list[$i]["release_time_hour"] = date("H", $list[$i][DETAIL::$release_time]);
            $list[$i]["release_time_minute"] = date("i", $list[$i][DETAIL::$release_time]);
            $list[$i]["release_time_second"] = date("s", $list[$i][DETAIL::$release_time]);
            $list[$i]["release_time"] = date("Y-m-d H:i:s", $time);
            if ($list[$i][DETAIL::$url] == "") {
                $url = "./index.php?m=Index&c=Index&a=detail&id=" . $list[$i][DETAIL::$id];
                $list[$i][DETAIL::$url] = $url;
            } else {
                $url = $list[$i][DETAIL::$url];
                $url = htmlspecialchars_decode($url);
                $list[$i][DETAIL::$url] = $url;
            }
        }
        $object = array();
        $object["list"] = $list;
        return $object;
    }
}