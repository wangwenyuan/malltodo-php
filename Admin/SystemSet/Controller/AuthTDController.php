<?php
require_once dirname(dirname(__DIR__)) . '/Index/Controller/CommonTDController.php';

class AuthTDController extends CommonTDController
{

    public function index()
    {
        $rid = TDI("get.rid");
        if ($rid == 0 || $rid == "") {
            $this->error("请选择权限");
        }
        $where = array();
        $where[ROLE::$id] = array(
            "eq",
            $rid
        );
        $where[ROLE::$is_del] = array(
            "eq",
            0
        );
        $role_info = MU(ROLE::$_table_name)->where($where)->find();
        if (! $role_info) {
            $this->error("不存在该权限");
            return;
        }

        if (TD_IS_POST) {
            $auth_where = array();
            $auth_where[ROLE_AUTH::$role_id] = array(
                "eq",
                $rid
            );
            MU(ROLE_AUTH::$_table_name)->where($auth_where)->delete();
            $list = TDI("post.r");
            for ($i = 0; $i < count($list); $i = $i + 1) {
                $string = $list[$i];
                $string_arr = explode("+", $string);
                $data = array();
                $data[ROLE_AUTH::$role_id] = $rid;
                if (count($string_arr) > 0 && $string_arr[0] != "") {
                    $data[ROLE_AUTH::$m] = $string_arr[0];
                }
                if (count($string_arr) > 1 && $string_arr[1] != "") {
                    $data[ROLE_AUTH::$c] = $string_arr[1];
                }
                if (count($string_arr) > 2 && $string_arr[2] != "") {
                    $data[ROLE_AUTH::$a] = $string_arr[2];
                }
                MU(ROLE_AUTH::$_table_name)->data($data)->add();
            }
            $this->success("设置成功");
        } else {
            $auth_where = array();
            $auth_where[ROLE_AUTH::$role_id] = array(
                "eq",
                $rid
            );
            $list = MU(ROLE_AUTH::$_table_name)->where($auth_where)->select();
            $arr = array();
            for ($i = 0; $i < count($list); $i = $i + 1) {
                $string = "";
                if ($list[$i][ROLE_AUTH::$m] != "") {
                    $string = $list[$i][ROLE_AUTH::$m];
                }
                if ($list[$i][ROLE_AUTH::$c] != "") {
                    $string = $list[$i][ROLE_AUTH::$m] . "+" . $list[$i][ROLE_AUTH::$c];
                }
                if ($list[$i][ROLE_AUTH::$a] != "") {
                    $string = $list[$i][ROLE_AUTH::$m] . "+" . $list[$i][ROLE_AUTH::$c] . "+" . $list[$i][ROLE_AUTH::$a];
                }
                array_push($arr, $string);
            }
            $this->assign("role", TDConfig::$menu["admin_home"]);
            $this->assign("role_list", $arr);
            $this->display();
        }
    }
}