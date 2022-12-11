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
        $count = MU(ADMIN::$_table_name)->alias("a")
            ->where($where)
            ->count();

        $page = new TDPAGE($count, 16);
        $list = MU(ADMIN::$_table_name)->alias("a")
            ->join(ROLE::$_table_name, "as ag on a." . ADMIN::$role_id . " = ag." . ROLE::$id, "left")
            ->where($where)
            ->order(ADMIN::$id . " desc")
            ->field("a.*, ag." . ROLE::$role_name . " as role_name")
            ->limit($page->firstRow . "," . $page->listRows)
            ->select();
        $this->assign("page", $page->show());
        $this->assign("list", $list);
        $this->display();
    }

    public function add()
    {
        $id = trim(TDI("get.id"));
        $info = array();
        $where = array();
        if ($id != "") {
            $where[ADMIN::$id] = array(
                "eq",
                $id
            );
            $where[ADMIN::$is_del] = array(
                "eq",
                0
            );
            $info = MU(ADMIN::$_table_name)->where($where)->find();
            if (! $info) {
                $this->error("该成员不存在或已被删除");
                return;
            }
        }
        $map = array();
        $map[0] = "超级管理员";
        $role_where = array();
        $role_where[ROLE::$is_del] = array(
            "eq",
            0
        );
        $role_list = MU(ROLE::$_table_name)->where($role_where)->select();
        for ($i = 0; $i < count($role_list); $i = $i + 1) {
            $map[$role_list[$i]["id"]] = $role_list[$i][ROLE::$role_name];
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
            if ($id != "") {
                $where[ADMIN::$id] = array(
                    "neq",
                    $id
                );
            }
            $check_info = MU(ADMIN::$_table_name)->where($where)->find();
            if ($check_info) {
                $this->error("该用户名已存在");
                return;
            }
            // 检测密码
            if ($id != "") {
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
            $role_id = TDTRIM(TDI("post." . ADMIN::$role_id));
            if (! isset($map[$role_id])) {
                $this->error("不存在该岗位");
                return;
            }
            // 记入数据库
            if ($id != "") {
                $where = array();
                $where[ADMIN::$id] = array(
                    "eq",
                    $id
                );
                MU(ADMIN::$_table_name)->where($where)->save($data);
                $this->success("修改成功");
            } else {
                MU(ADMIN::$_table_name)->data($data)->add();
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
            $id = TDTRIM(TDI("post.id"));
            $where = array();
            $where[ADMIN::$id] = array(
                "eq",
                $id
            );
            MU(ADMIN::$_table_name)->where($where)->save(array(
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
            $id
        );
        $where[ADMIN::$is_del] = array(
            "eq",
            0
        );
        $info = MU(ADMIN::$_table_name)->where($where)->find();
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
            $check = MU(ADMIN::$_table_name)->where($where)->find();
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
            if (isset($data[ADMIN::$role_id])) {
                unset($data[ADMIN::$role_id]);
            }
            MU(ADMIN::$_table_name)->where($where)->save($data);
            $this->success("修改成功");
        } else {
            $this->assign("info", $info);
            $this->display();
        }
    }
}