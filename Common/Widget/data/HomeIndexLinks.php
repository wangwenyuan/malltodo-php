<?php

class HomeIndexLinks
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
        )
    );

    public $type = "";

    public function getValue($selfParameter, $bind_loop_list, $website_id, $urlinput)
    {
        $where = array();
        $where[LINKS::$is_del] = array(
            "eq",
            0
        );
        $is_pic = $selfParameter->is_pic;
        if ($is_pic != "0") {
            $where[LINKS::$pic] = array(
                "neq",
                ""
            );
        }
        $recommend_level = $selfParameter->recommend_level;
        if ($recommend_level != "0") {
            $where[LINKS::$recommend_level] = array(
                "eq",
                $recommend_level
            );
        }
        $page_size = "100";
        if ($bind_loop_list != null && count($bind_loop_list) > 0) {
            $bind_loop = $bind_loop_list[0];
            $arr = explode(":", $bind_loop);
            $page_size = $arr[1] . "";
        }
        $list = MU(LINKS::$_table_name)->where($where)
            ->limit($page_size)
            ->order(LINKS::$id . " desc")
            ->select();
        $object = array();
        $object["list"] = $list;
        return $object;
    }
}