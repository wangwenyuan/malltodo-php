<?php
require_once dirname(dirname(__DIR__)) . '/Index/Controller/CommonTDController.php';

class RoleTDController extends CommonTDController
{

    public function index()
    {
        $gid = (int) TDI("get.gid");
        if ($gid == 0 || $gid == "") {
            $this->error("请选择岗位");
        }
        $where = array();
        $where[ADMIN_GROUP::$id] = array(
            "eq",
            $gid
        );
        $where[ADMIN_GROUP::$is_del] = array(
            "eq",
            0
        );
        $admin_group_info = TDORM(ADMIN_GROUP::$_table_name)->where($where)->find();
        if (! $admin_group_info) {
            $this->error("不存在该岗位");
            return;
        }

        if (TD_IS_POST) {
            $auth_where = array();
            $auth_where[ADMIN_AUTH::$group_id] = array(
                "eq",
                $gid
            );
            TDORM(ADMIN_AUTH::$_table_name)->where($auth_where)->delete();
            $list = TDI("post.r");
            for ($i = 0; $i < count($list); $i = $i + 1) {
                $string = $list[$i];
                $string_arr = explode("+", $string);
                $data = array();
                $data[ADMIN_AUTH::$group_id] = $gid;
                if (count($string_arr) > 0 && $string_arr[0] != "") {
                    $data[ADMIN_AUTH::$m] = $string_arr[0];
                }
                if (count($string_arr) > 1 && $string_arr[1] != "") {
                    $data[ADMIN_AUTH::$c] = $string_arr[1];
                }
                if (count($string_arr) > 2 && $string_arr[2] != "") {
                    $data[ADMIN_AUTH::$a] = $string_arr[2];
                }
                TDORM(ADMIN_AUTH::$_table_name)->data($data)->add();
            }
            $this->success("设置成功");
        } else {
            $auth_where = array();
            $auth_where[ADMIN_AUTH::$group_id] = array(
                "eq",
                $gid
            );
            $list = TDORM(ADMIN_AUTH::$_table_name)->where($auth_where)->select();
            $arr = array();
            for ($i = 0; $i < count($list); $i = $i + 1) {
                $string = "";
                if ($list[$i][ADMIN_AUTH::$m] != "") {
                    $string = $list[$i][ADMIN_AUTH::$m];
                }
                if ($list[$i][ADMIN_AUTH::$c] != "") {
                    $string = $list[$i][ADMIN_AUTH::$m] . "+" . $list[$i][ADMIN_AUTH::$c];
                }
                if ($list[$i][ADMIN_AUTH::$a] != "") {
                    $string = $list[$i][ADMIN_AUTH::$m] . "+" . $list[$i][ADMIN_AUTH::$c] . "+" . $list[$i][ADMIN_AUTH::$a];
                }
                array_push($arr, $string);
            }
            $this->assign("role", TDConfig::$menu["admin_menu_auth"]);
            $this->assign("role_list", $arr);
            $this->display();
        }
    }
}