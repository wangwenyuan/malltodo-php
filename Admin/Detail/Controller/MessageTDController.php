<?php
require_once dirname(dirname(__DIR__)) . '/Index/Controller/CommonTDController.php';

class MessageTDController extends CommonTDController
{

    public function _td_init()
    {
        if (parent::_td_init()) {
            $this->assign("page_action", "客户留言");
            return true;
        } else {
            return false;
        }
    }

    public function index()
    {
        $where = array();
        $where[MESSAGE::$is_del] = array(
            "eq",
            0
        );
        $count = MU(MESSAGE::$_table_name)->where($where)->count();
        $page = $this->page($count, 16);
        $this->assign("page", $page->show());
        $list = MU(MESSAGE::$_table_name)->where($where)
            ->limit($page->firstRow . "," . $page->listRows)
            ->order(MESSAGE::$id . " desc")
            ->select();
        $this->assign("list", $list);
        $this->display();
    }

    public function del()
    {
        if (TD_IS_POST) {
            $id = trim(TDI("post.id"));
            $where = array();
            $where[MESSAGE::$id] = array(
                "eq",
                $id
            );
            $where[MESSAGE::$website_id] = array(
                "eq",
                TDSESSION("website_id")
            );
            $data = array();
            $data[MESSAGE::$is_del] = 1;
            MU(MESSAGE::$_table_name)->where($where)->save($data);
            $this->success("删除成功");
        }
    }
}