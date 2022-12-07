<?php
require_once dirname(dirname(__DIR__)) . '/Index/Controller/CommonTDController.php';

class AdminTDController extends CommonTDController
{

    public function index()
    {
        $where = array();
        if (TDI("get." . ADMIN::$username) != "") {
            $where["a." . ADMIN::$username] = array(
                "like",
                "%" . TDI("get." . ADMIN::$username) . "%"
            );
        }
        if (TDI("get." . ADMIN::$mobile) != "") {
            $where["a." . ADMIN::$mobile] = array(
                "like",
                "%" . TDI("get." . ADMIN::$mobile) . "%"
            );
        }
        $where["a." . ADMIN::$is_del] = array(
            "eq",
            0
        );
        $count = TDORM(ADMIN::$_table_name)->alias("a")
            ->where($where)
            ->count();

        $page = new TDPAGE($count, 16);
        $list = TDORM(ADMIN::$_table_name)->alias("a")
            ->join(ADMIN_GROUP::$_table_name, "as ag on a." . ADMIN::$group_id . " = ag." . ADMIN_GROUP::$id, "left")
            ->where($where)
            ->order(ADMIN::$id . " desc")
            ->field("a.*, ag." . ADMIN_GROUP::$name . " as group_name")
            ->limit($page->firstRow . "," . $page->listRows)
            ->select();
        $this->assign("page", $page->show());
        $this->assign("list", $list);
        $this->display();
    }

    public function add()
    {
        $id = (int) trim(TDI("get.id"));
        $info = array();
        $where = array();
        if ($id) {
            $where[ADMIN::$id] = array(
                "eq",
                $id
            );
            $where[ADMIN::$is_del] = array(
                "eq",
                0
            );
            $info = TDORM(ADMIN::$_table_name)->where($where)->find();
            if (! $info) {
                $this->error("该成员不存在或已被删除");
                return;
            }
        }
        $map = array();
        $map[0] = "超级管理员";
        require_once 'AdminGroupTDController.php';
        $arr = AdminGroupTDController::get_admin_group();
        for ($i = 0; $i < count($arr); $i = $i + 1) {
            $_id = $arr[$i][ADMIN_GROUP::$id];
            $_name = $arr[$i][ADMIN_GROUP::$name];
            $level = $arr[$i]["level"];
            $_name = "—— " . $_name;
            for ($n = 0; $n < $level; $n = $n + 1) {
                $_name = "—— " . $_name;
            }
            $map[$_id] = $_name;
        }
        if (TD_IS_POST) {
            $data = TDTRIM(TDI("post."));
            $username = $data[ADMIN::$username];
            $where = array();
            $where[ADMIN::$username] = array(
                "eq",
                $username
            );
            $where[ADMIN::$is_del] = array(
                "eq",
                0
            );
            if ($id) {
                $where[ADMIN::$id] = array(
                    "neq",
                    $id
                );
            }
            $check_info = TDORM(ADMIN::$_table_name)->where($where)->find();
            if ($check_info) {
                $this->error("该用户名已存在");
                return;
            }
            // 检测密码
            if (! $id) {
                $password = TDTRIM(TDI("post.password"));
                if ($password == "") {
                    $this->error("密码不能为空");
                    return;
                }
                // 检测密码是否符合要求
                if (! TDCHECKPASSWORD($password)) {
                    $this->error("密码必需包含大小写字母和数字以及特殊字符，且密码要大于8位");
                    return;
                }
                $data[ADMIN::$password] = TDCREATEPASSWORD($password);
            } else {
                if (TDTRIM(TDI(ADMIN::$password)) == "") {
                    unset($data[ADMIN::$password]);
                } else {
                    $data[ADMIN::$password] = TDCREATEPASSWORD(TDTRIM(TDI(ADMIN::$password)));
                }
            }
            // 检测管理员组
            $group_id = (int) TDTRIM(TDI("post." . ADMIN::$group_id));
            if (! isset($map[$group_id])) {
                $this->error("不存在该岗位");
                return;
            }
            // 记入数据库
            if ($id) {
                $where = array();
                $where[ADMIN::$id] = array(
                    "eq",
                    $id
                );
                TDORM(ADMIN::$_table_name)->where($where)->save($data);
                $this->success("修改成功");
            } else {
                TDORM(ADMIN::$_table_name)->data($data)->add();
                $this->success("新建成功");
            }
        } else {
            $this->assign("info", $info);
            $this->assign("map", $map);
            $this->display("add");
        }
    }

    public function edit()
    {
        $this->add();
    }

    public function del()
    {
        if (TD_IS_POST) {
            $id = (int) TDTRIM(TDI("post.id"));
            if ($id == 1) {
                $this->error("主管理员不能删除");
                return;
            }
            $where = array();
            $where[ADMIN::$id] = array(
                "eq",
                $id
            );
            TDORM(ADMIN::$_table_name)->where($where)->save(array(
                ADMIN::$is_del => 1
            ));
            $this->success("删除成功");
        }
    }

    public function material()
    {
        $id = TDSESSION("admin_id");
        $info = array();
        $where = array();
        $where[ADMIN::$id] = array(
            "eq",
            (int) $id
        );
        $where[ADMIN::$is_del] = array(
            "eq",
            0
        );
        $info = TDORM(ADMIN::$_table_name)->where($where)->find();
        if (! $info) {
            $this->error("该成员不存在或已被删除");
        }
        if (TD_IS_POST) {
            $data = TDTRIM(TDI("post."));
            $username = $data[ADMIN::$username];
            $where = array();
            $where[ADMIN::$username] = array(
                "eq",
                $username
            );
            $where[ADMIN::$is_del] = array(
                "eq",
                0
            );
            $where[ADMIN::$id] = array(
                "neq",
                $id
            );
            $check = TDORM(ADMIN::$_table_name)->where($where)->find();
            if (! $check) {
                $this->error("该用户名已存在");
                return;
            }
            // 检测密码
            $password = $data[ADMIN::$password];
            if ($password == "") {
                unset($data[ADMIN::$password]);
            } else {
                if (! TDCHECKPASSWORD($password)) {
                    $this->error("密码必需包含大小写字母和数字以及特殊字符，且密码要大于8位");
                    return;
                } else {
                    $data[ADMIN::$password] = TDCREATEPASSWORD($password);
                }
            }
            // 不能修改所属的管理员组
            if (isset($data[ADMIN::$group_id])) {
                unset($data[ADMIN::$group_id]);
            }
            TDORM(ADMIN::$_table_name)->where($where)->save($data);
            $this->success("修改成功");
        } else {
            $this->assign("info", $info);
            $this->display();
        }
    }
}