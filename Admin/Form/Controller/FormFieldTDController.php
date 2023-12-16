<?php
require_once dirname(dirname(__DIR__)) . '/Index/Controller/CommonTDController.php';

class FormFieldTDController extends CommonTDController
{
    private $fid = 0;
    
    private $fname = "";
    
    private $ftable_name = "";
    
    public function _td_init()
    {
        parent::_td_init();
        $this->fid = TDI("get.fid");
        if ($this->fid == 0) {
            $this->error("请选择自定义表单");
        }
        $where = array();
        $where['id'] = array(
            "eq",
            $this->fid
        );
        $where['is_del'] = array(
            "eq",
            0
        );
        $finfo = MU(FORM::$_table_name)->where($where)->find();
        if (! $finfo) {
            $this->error("不存在该自定义表单");
        }
        $this->fname = $finfo['name'];
        $this->ftable_name = $finfo['table_name'];
        $this->assign("fname", $this->fname);
    }
    
    public function index()
    {
        $where = array();
        $where['fid'] = array(
            "eq",
            $this->fid
        );
        $where['is_del'] = array(
            "eq",
            0
        );
        $count = MU(FORM_FIELDS::$_table_name)->where($where)->count();
        $Page = new TDPAGE($count, 16);
        $show = $Page->show();
        $list = MU(FORM_FIELDS::$_table_name)->where($where)
        ->limit($Page->firstRow . ',' . $Page->listRows)
        ->order('id asc')
        ->select();
        $this->assign("list", $list);
        $this->assign("page", $show);
        $this->assign("action_title", "“" . $this->fname . "表单”字段列表");
        $this->display();
    }
    
    public function add()
    {
        if (TD_IS_POST) {
            $data = $this->check();
            $id = MU(FORM_FIELDS::$_table_name)->data($data)->add();
            if ($id) {
                add_field($this->ftable_name, $data['field_name'], $data['field_type']);
                $this->success("添加成功");
            } else {
                $this->error("添加失败");
            }
        } else {
            $this->assign("action_title", "添加“" . $this->fname . "表单”字段");
            $this->display();
        }
    }
    
    public function edit()
    {
        $where = array();
        $where['fid'] = array(
            "eq",
            $this->fid
        );
        $where['id'] = array(
            "eq",
            TDI("get.id")
        );
        $field_info = MU(FORM_FIELDS::$_table_name)->where($where)->find();
        if (! $field_info) {
            $this->error("非法进入");
        }
        if ($field_info['type'] == 1) {
            $this->error("系统字段不允许修改");
        }
        if (TD_IS_POST) {
            $data = $this->check(TDI("get.id"));
            //如果字段名未发生修改则直接修改数据
            if($data[FORM_FIELDS::$field_name] == $field_info[FORM_FIELDS::$field_name]){
                $res = MU(FORM_FIELDS::$_table_name)->where($where)->save($data);
            }else{
                $res = MU(FORM_FIELDS::$_table_name)->where($where)->save(array("is_del"=>1));
                unset($data[FORM_FIELDS::$id]);
                $res = MU(FORM_FIELDS::$_table_name)->data($data)->add();
            }
            if ($res === false) {
                $this->error("修改失败");
            } else {
                //alter_field($this->ftable_name, $field_info['field_name'], $data['field_name'], $field_info['field_type'], $data['field_type']);
                add_field($this->ftable_name, $data['field_name'], $field_info['field_type']);
                $this->success("修改成功");
            }
        } else {
            $this->assign("info", $field_info);
            $this->assign("action_title", "修改“" . $this->fname . "表单”字段");
            $this->display("add");
        }
    }
    
    public function del()
    {
        $where = array();
        $where['fid'] = array(
            "eq",
            $this->fid
        );
        $where['id'] = array(
            "eq",
            TDI("post.id")
        );
        $field_info = MU(FORM_FIELDS::$_table_name)->where($where)->find();
        if (! $field_info) {
            $this->error("非法进入");
        }
        if ($field_info['type'] == 1) {
            $this->error("系统字段不允许删除");
        }
        if (TD_IS_POST) {
            $fid = TDI("get.fid");
            $id = TDI("post.id");
            $res = MU(FORM_FIELDS::$_table_name)->where(array(
                "id" => array(
                    "eq",
                    $id
                ),
                "fid" => array(
                    "eq",
                    $fid
                )
            ))->save(array(
                "is_del" => 1
            ));
            //delete_field($this->ftable_name, $field_info[FORM_FIELDS::$field_name], $field_info[FORM_FIELDS::$field_type]);
            if ($res === false) {
                $this->error("删除失败");
            } else {
                $this->success("删除成功");
            }
        }
    }
    
    private function check($id = "")
    {
        $data = trim_array(TDI("post."));
        $name = trim(TDI("post.name"));
        $data['name'] = $name;
        if ($name == "") {
            $this->error("字段标识不能为空");
        }
        $field_name = trim(TDI("post.field_name"));
        if ($field_name == "") {
            $this->error("字段名不能为空");
        }
        if (! check_field_name($field_name)) {
            $this->error("字段名只能是字母，最多25位");
        }
        // 检测字段名是否已经存在
        $model_field_where = array();
        $model_field_where['fid'] = array(
            "eq",
            $this->fid
        );
        $model_field_where['field_name'] = array(
            "eq",
            $field_name
        );
        if ($id) {
            $model_field_where['id'] = array(
                "neq",
                $id
            );
            $info = MU(FORM_FIELDS::$_table_name)->where($model_field_where)->find();
        } else {
            $info = MU(FORM_FIELDS::$_table_name)->where($model_field_where)->find();
        }
        
        if ($info) {
            $this->error("该字段名已经存在");
        }
        $data['field_name'] = $field_name;
        $data['fid'] = $this->fid;
        return $data;
    }
    
    
    
    public function addTitle()
    {
        if (TD_IS_POST) {
            $data = $this->checkTitle();
            $data["type"] = 3;
            $id = MU(FORM_FIELDS::$_table_name)->data($data)->add();
            if ($id) {
                $this->success("添加成功");
            } else {
                $this->error("添加失败");
            }
        } else {
            $this->assign("action_title", "添加“" . $this->fname . "表单”小标题");
            $this->display();
        }
    }
    
    public function editTitle()
    {
        $where = array();
        $where['fid'] = array(
            "eq",
            $this->fid
        );
        $where['id'] = array(
            "eq",
            TDI("get.id")
        );
        $field_info = MU(FORM_FIELDS::$_table_name)->where($where)->find();
        if (! $field_info) {
            $this->error("非法进入");
        }
        if ($field_info['type'] == 1) {
            $this->error("系统字段不允许删除");
        }
        if (TD_IS_POST) {
            $data = $this->checkTitle(TDI("get.id"));
            $data["type"] = 3;
            $res = MU(FORM_FIELDS::$_table_name)->where($where)->save($data);
            if ($res === false) {
                $this->error("修改失败");
            } else {
                $this->success("修改成功");
            }
        } else {
            $this->assign("info", $field_info);
            $this->assign("action_title", "修改“" . $this->fname . "表单”小标题");
            $this->display("addTitle");
        }
    }
    
    private function checkTitle($id = "")
    {
        $data = trim_array(TDI("post."));
        $name = trim(TDI("post.name"));
        $data['name'] = $name;
        if ($name == "") {
            $this->error("字段标识不能为空");
        }
        // 检测字段名是否已经存在
        $data['fid'] = $this->fid;
        return $data;
    }
}