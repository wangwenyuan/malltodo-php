<?php

class BaseIndexDetail
{

    public $parameter = array();

    public function getValue($selfParameter, $bind_loop_list)
    {
        $id = TDI("get.id");
        $where = array();
        $where[DETAIL::$id] = array(
            "eq",
            $id
        );
        $where[DETAIL::$is_del] = array(
            "eq",
            0
        );
        $detail = MU(DETAIL::$_table_name)->where($where)->find();
        if (! $detail) {
            return null;
        }

        $where = array();
        $category_id = $detail[DETAIL::$category_id];
        $where[CATEGORY::$is_del] = array(
            "eq",
            0
        );
        $where[CATEGORY::$id] = array(
            "eq",
            $category_id
        );
        $category = MU(CATEGORY::$_table_name)->where($where)->find();
        if (! $category) {
            return null;
        }
        $object = array();
        $object["info"] = $detail;
        $object[DETAIL::$category_id] = $detail[DETAIL::$category_id];
        $object[DETAIL::$detail] = htmlspecialchars_decode($detail[DETAIL::$detail]);
        $object[DETAIL::$pic] = $detail[DETAIL::$pic];
        $object[DETAIL::$release_time] = date("Y-m-d H:i:s", $detail[DETAIL::$release_time]);
        $object[DETAIL::$smalltext] = $detail[DETAIL::$smalltext];
        $object[DETAIL::$title] = $detail[DETAIL::$title];
        $object[DETAIL::$views] = $detail[DETAIL::$views];

        $websiteId = TDSESSION("website_id");
        $object["pre"] = $this->getPre($detail, $category, $websiteId);
        $object["next"] = $this->getNext($detail, $category, $websiteId);

        $object["category"] = $category;
        $object[CATEGORY::$category_name] = $category[CATEGORY::$category_name];
        $object[CATEGORY::$category_sub_name] = $category[CATEGORY::$category_sub_name];

        $object["category_detail"] = $category[CATEGORY::$detail];
        $object["category_pic"] = $category[CATEGORY::$pic];
        $object["category_pid"] = $category[CATEGORY::$pid];
        $object["category_smalltext"] = $category[CATEGORY::$smalltext];

        require_once __DIR__ . "/BaseIndexList.php";
        $object["left_menus"] = BaseIndexList::getLeftMenus($category);

        return $object;
    }

    private function getPre($detail, $category, $websiteId)
    {
        $detail_id = $detail[DETAIL::$id];
        $category_id = $category[CATEGORY::$id];
        $release_time = $detail[DETAIL::$release_time];

        $where = array();
        $where[DETAIL::$is_del] = array(
            "eq",
            0
        );
        $category_ids = array();

        require_once dirname(dirname(__DIR__)) . "/MenuCache.php";
        $all_category_list = MenuCache::getAdminMenuList($websiteId);
        $all_category_list = json_decode(json_encode($all_category_list), true);
        $all_category_list = $this->getNoTreeCategorys($all_category_list);
        $pointer_category_level = 0;
        $open = 0; // 是否装载的开关
        for ($i = 0; $i < count($all_category_list); $i = $i + 1) {
            $cur_category_id = $all_category_list[$i]["id"];
            $cur_level = $all_category_list[$i]["level"];
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

        $order_by = $category[CATEGORY::$order_by];
        $_order_by = "";
        if ($order_by == "id desc") {
            $where[DETAIL::$id] = array(
                "gt",
                $detail_id
            );
            $_order_by = "id asc";
        } else if ($order_by == "id asc") {
            $where[DETAIL::$id] = array(
                "lt",
                $detail_id
            );
            $_order_by = "id desc";
        } else if ($order_by == "release_time desc") {
            $where[DETAIL::$release_time] = array(
                "gt",
                $release_time
            );
            $_order_by = "release_time asc";
        } else if ($order_by == "release_time asc") {
            $where[DETAIL::$release_time] = array(
                "lt",
                $release_time
            );
            $_order_by = "release_time desc";
        }

        $map = MU(DETAIL::$_table_name)->where($where)
            ->order($_order_by)
            ->find();
        if ($map == null) {
            return "<a target='_blank' href='./index.php?m=Index&c=Index&a=category&id=" . $category_id . "'>返回列表</a>";
        } else {
            return "<a target='_blank' href='./index.php?m=Index&c=Index&a=detail&id=" . $map[DETAIL::$id] . "'>" . $map[DETAIL::$title] . "</a>";
        }
    }

    private function getNext($detail, $category, $websiteId)
    {
        $detail_id = $detail[DETAIL::$id];
        $category_id = $category[CATEGORY::$id];
        $release_time = $detail[DETAIL::$release_time];

        $where = array();
        $where[DETAIL::$is_del] = array(
            "eq",
            0
        );
        $category_ids = array();

        require_once dirname(dirname(__DIR__)) . "/MenuCache.php";
        $all_category_list = MenuCache::getAdminMenuList($websiteId);
        $all_category_list = json_decode(json_encode($all_category_list), true);
        $all_category_list = $this->getNoTreeCategorys($all_category_list);
        $pointer_category_level = 0;
        $open = 0; // 是否装载的开关

        for ($i = 0; $i < count($all_category_list); $i = $i + 1) {
            $cur_category_id = $all_category_list[$i]["id"];
            $cur_level = $all_category_list[$i]["level"];
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

        $order_by = $category[CATEGORY::$order_by];
        if ($order_by == "id desc") {
            $where[DETAIL::$id] = array(
                "lt",
                $detail_id
            );
        } else if ($order_by == "id asc") {
            $where[DETAIL::$id] = array(
                "gt",
                $detail_id
            );
        } else if ($order_by == "release_time desc") {
            $where[DETAIL::$release_time] = array(
                "lt",
                $release_time
            );
        } else if ($order_by == "release_time asc") {
            $where[DETAIL::$release_time] = array(
                "gt",
                $release_time
            );
        }

        $map = MU(DETAIL::$_table_name)->where($where)
            ->order($order_by)
            ->find();
        if ($map == null) {
            return "<a target='_blank' href='./index.php?m=Index&c=Index&a=category&id=" . $category_id . "'>返回列表</a>";
        } else {
            return "<a target='_blank' href='./index.php?m=Index&c=Index&a=detail&id=" . $map[DETAIL::$id] . "'>" . $map[DETAIL::$title] . "</a>";
        }
    }

    private $no_tree_categorys = null;

    private function build_no_tree_categorys($all_category_list)
    {
        for ($i = 0; $i < count($all_category_list); $i = $i + 1) {
            $arr = array();
            $arr["id"] = $all_category_list[$i][DETAIL::$id];
            $arr["level"] = $all_category_list[$i]["level"];
            array_push($this->no_tree_categorys, $arr);
            if (count($all_category_list[$i]["sub_menu"]) > 0) {
                $this->build_no_tree_categorys($all_category_list[$i]["sub_menu"]);
            }
        }
    }

    private function getNoTreeCategorys($all_category_list)
    {
        if ($this->no_tree_categorys == null) {
            $this->no_tree_categorys = array();
            $this->build_no_tree_categorys($all_category_list);
        }
        return $this->no_tree_categorys;
    }
}