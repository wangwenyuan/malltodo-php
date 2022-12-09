<?php
require_once dirname(dirname(__DIR__)) . '/Index/Controller/CommonTDController.php';

class LinksTDController extends CommonTDController
{

    public function _td_init()
    {
        if (parent::_td_init()) {
            $this->assign("page_action", "友情链接");
            return true;
        } else {
            return false;
        }
    }

    public function index()
    {
        $where = array();
        $where[LINKS::$is_del] = array(
            "eq",
            0
        );
        $where[LINKS::$website_id] = array(
            "eq",
            TDSESSION("website_id")
        );
        $count = MU(LINKS::$_table_name)->where($where)->count();
        $page = $this->page($count, 16);
        $list = MU(LINKS::$_table_name)->where($where)
            ->order($page->firstRow . "," . $page->listRows)
            ->order(LINKS::$id . " desc")
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
            $where[LINKS::$id] = array(
                "eq",
                $id
            );
            $where[LINKS::$is_del] = array(
                "eq",
                0
            );
            $where[LINKS::$website_id] = array(
                "eq",
                TDSESSION("website_id")
            );
            $info = MU(LINKS::$_table_name)->where($where)->find();
        }
        if (TD_IS_POST) {
            $data = trim_array(TDI("post."));
            if ($data[LINKS::$name] == "") {
                $this->error("链接名称不能为空");
                return;
            }
            if ($data[LINKS::$url] == "") {
                $this->error("链接不能为空");
                return;
            }
            if ($id == "") {
                $data[LINKS::$website_id] = TDSESSION("website_id");
                MU(LINKS::$_table_name)->data($data)->add();
            } else {
                MU(LINKS::$_table_name)->where($where)->save($data);
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
        if (TD_IS_POST) {
            $id = trim(TDI("post.id"));
            $where = array();
            $where[LINKS::$id] = array(
                "eq",
                $id
            );
            $where[LINKS::$website_id] = array(
                "eq",
                TDSESSION("website_id")
            );
            $data = array();
            $data[LINKS::$is_del] = 1;
            MU(LINKS::$_table_name)->where($where)->save($data);
            $this->success("删除成功");
        }
    }
}