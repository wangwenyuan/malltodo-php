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
        )
    );

    public $type = "";

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
            ->order(DETAIL::$id . " desc")
            ->select();
        for ($i = 0; $i < count($list); $i = $i + 1) {
            $time = $list[$i][DETAIL::$release_time];
            $list[$i]["release_time"] = date("Y-m-d", $time);
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