<?php

class HomeIndexBread
{

    public $parameter = array();

    public function getValue($selfParameter, $bind_loop_list)
    {
        $category_id = "";
        if (trim(TDI("get.a")) == "category") { // 说明是栏目
            $category_id = trim(TDI("get.id"));
        } else if (trim(TDI("get.a")) == "detail") { // 说明是内容
            $detail_id = trim(TDI("get.id"));
            $_where = array();
            $_where[DETAIL::$id] = array(
                "eq",
                $detail_id
            );
            $_where[DETAIL::$is_del] = array(
                "eq",
                0
            );
            $detail = MU(DETAIL::$_table_name)->where($_where)->find();
            if ($detail == null) {
                return null;
            }
            $category_id = $detail[DETAIL::$category_id];
        }

        $where = array();
        $where[CATEGORY::$id] = array(
            "eq",
            $category_id
        );
        $where[CATEGORY::$is_del] = array(
            "eq",
            0
        );
        $category = MU(CATEGORY::$_table_name)->where($where)->find();
        if ($category == null) {
            return null;
        }

        $object = array();
        $object["category"] = $category;
        $object["url"] = "./index.php?m=Index&c=Index&a=category&id=" . $category_id;
        $object["category_name"] = $category[CATEGORY::$category_name];
        $object["category_sub_name"] = $category[CATEGORY::$category_sub_name];
        $object["bread"] = self::getBread($category_id, $category[CATEGORY::$category_name], $category[CATEGORY::$pid], "-&gt");

        return $object;
    }

    private $_category_ids = array();

    private function _getBread($category_id, $category_name, $category_pid, $separator)
    {
        if (in_array($category_id, $this->_category_ids)) {
            return "";
        } else {
            array_push($this->_category_ids, $category_id);
        }
        $html = "<a href='./index.php?m=Index&c=Index&a=category&id=" . $category_id . "' target='_blank'>" . $category_name . "</a>";
        if ($separator == "") {
            $separator = "-&gt";
        }
        if ($category_pid == "0") {
            return $separator . $html;
        } else {
            $where = array();
            $where[CATEGORY::$id] = array(
                "eq",
                $category_pid
            );
            $where[CATEGORY::$is_del] = array(
                "eq",
                0
            );
            $category = MU(CATEGORY::$_table_name)->where($where)->find();
            if ($category == null) {
                return "";
            } else {
                $category_id = trim($category[CATEGORY::$id]);
                $category_name = trim($category[CATEGORY::$category_name]);
                $category_pid = trim($category[CATEGORY::$pid]);
                return $this->_getBread($category_id, $category_name, $category_pid, $separator);
            }
        }
    }

    public static function getBread($category_id, $category_name, $category_pid, $separator)
    {
        $class = new HomeIndexBread();
        return "<a href='./index.jsp' target='_blank'>首页</a>" . $class->_getBread($category_id, $category_name, $category_pid, $separator);
    }
}