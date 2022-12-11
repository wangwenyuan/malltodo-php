<?php
require_once dirname(dirname(__DIR__)) . '/Index/Controller/CommonTDController.php';

class RoleTDController extends CommonTDController
{

    public function index()
    {
        $where = array();
        $where[ROLE::$is_del] = array(
            "eq",
            0
        );
        $count = MU(ROLE::$_table_name)->where($where)->count();
        $page = $this->page($count, 16);
        $list = MU(ROLE::$_table_name)->where($where)
            ->order($page->firstRow . "," . $page->listRows)
            ->order(ROLE::$id . " desc")
            ->select();
        $this->assign("list", $list);
        $this->assign("page", $page->show());
        $this->display();
    }

    public function add()
    {
        $id = trim(TDI("get.id"));
        $where = array();
        $info = array();
        if ($id != "") {
            $where[ROLE::$id] = array(
                "eq",
                $id
            );
            $where[ROLE::$is_del] = array(
                "eq",
                0
            );
            $info = MU(ROLE::$_table_name)->where($where)->find();
        }
        if (TD_IS_POST) {
            $data = trim_array(TDI("post."));
            if ($data[ROLE::$role_name] == "") {
                $this->error("名称不能为空");
                return;
            }
            if ($id == "") {
                MU(ROLE::$_table_name)->data($data)->add();
            } else {
                MU(ROLE::$_table_name)->where($where)->save($data);
            }
            $this->success("设置成功");
        } else {
            $this->assign("info", $info);
            $this->display("add");
        }
    }

    public function edit()
    {
        $this->add();
    }

    public function del()
    {
        if (IS_POST) {
            $id = trim(TDI("post.id"));
            $where = array();
            $where[ROLE::$id] = array(
                "eq",
                $id
            );
            $data = array();
            $data[ROLE::$is_del] = 1;
            MU(ROLE::$_table_name)->where($where)->save($data);
            $this->success("删除成功");
        }
    }
}