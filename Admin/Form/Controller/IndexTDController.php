<?php
require_once dirname(dirname(__DIR__)) . '/Index/Controller/CommonTDController.php';

class IndexTDController extends CommonTDController
{

    public function index()
    {
        // 获取所有的自定义表单
        $where = array();
        $where['is_del'] = array(
            "eq",
            0
        );
        $count = MU(FORM::$_table_name)->where($where)
        ->order(FORM::$id . " desc")
        ->count();
        $page = new TDPAGE($count, 16);
        $list = MU(FORM::$_table_name)->where($where)
        ->limit($page->firstRow . "," . $page->listRows)
        ->select();
        $this->assign("list", $list);
        $this->assign("page", $page->show());
        $this->display();
    }
    
    public function add()
    {
        if (TD_IS_POST) {
            $name = trim(TDI("post.name"));
            if ($name == "") {
                $this->error("表单名称不能为空");
            }
            // 检测table_name
            $table_name = TDI("post.table_name");
            $check_ret = check_table_name($table_name);
            if (! $check_ret['status']) {
                $this->error($check_ret['info']);
            }
            // 检测名称是否存在
            $info = MU(FORM::$_table_name)->where(array(
                "name" => array(
                    "eq",
                    $name
                ),
                "is_del" => array(
                    "eq",
                    0
                )
            ))->find();
            if ($info) {
                $this->error("该表单已经存在");
            }
            $info = MU(FORM::$_table_name)->where(array(
                "table_name" => array(
                    "eq",
                    $table_name
                )
            ))->find();
            if ($info) {
                $this->error("该数据表已经存在");
            }
            // 新建自定义表单数据表
            create_form_table($table_name);
            // 新建表明
            $data = array();
            $data['name'] = $name;
            $data['table_name'] = $table_name;
            $data['detail'] = TDI("post.detail");
            $id = MU(FORM::$_table_name)->data($data)->add();
            if ($id) {
                $this->success("添加成功");
            } else {
                $this->error("添加失败");
            }
        } else {
            $this->assign("action_title", "添加表单");
            $this->display();
        }
    }
    
    public function edit()
    {
        $id = TDI("get.id");
        $info = MU(FORM::$_table_name)->where(array(
            "id" => array(
                "eq",
                $id
            )
        ))->find();
        if (! $info) {
            $this->error("不存在该自定义表单");
        }
        if (TD_IS_POST) {
            $name = trim(TDI("post.name"));
            if ($name == "") {
                $this->error("表单名称不能为空");
            }
            // 检测名称是否存在
            $info = MU(FORM::$_table_name)->where(array(
                "id" => array(
                    "neq",
                    $id
                ),
                "name" => array(
                    "eq",
                    $name
                ),
                "is_del" => array(
                    "eq",
                    0
                )
            ))->find();
            if ($info) {
                $this->error("该表单名称已经存在");
                return;
            }
            $res = MU(FORM::$_table_name)->where(array(
                "id" => array(
                    "eq",
                    $id
                )
            ))->save(array(
                "name" => $name,
                "detail" => TDI("post.detail")
            ));
            if ($res === false) {
                $this->error("修改失败");
            } else {
                $this->success("修改成功");
            }
        } else {
            $this->assign("action_title", "编辑表单");
            $this->assign("info", $info);
            $this->display("add");
        }
    }
    
    public function del()
    {
        if (TD_IS_POST) {
            $id = TDI("post.id");
            $res = MU("form")->where(array(
                "id" => array(
                    "eq",
                    $id
                )
            ))->save(array(
                "is_del" => 1
            ));
            if ($res === false) {
                $this->error("删除失败");
            } else {
                $this->success("删除成功");
            }
        }
    }

}