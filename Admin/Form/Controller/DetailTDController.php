<?php
require_once dirname(dirname(__DIR__)) . '/Index/Controller/CommonTDController.php';

class DetailTDController extends CommonTDController
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
        ->order("id desc")
        ->count();
        $page = new TDPAGE($count, 16);
        $list = MU(FORM::$_table_name)->where($where)
        ->limit($page->firstRow . "," . $page->listRows)
        ->select();
        $this->assign("list", $list);
        $this->assign("page", $page->show());
        $this->display();
    }
    
    public function lists()
    {
        $fid = TDI("get.fid");
        $where['id'] = array(
            "eq",
            $fid
        );
        $where['is_del'] = array(
            "eq",
            0
        );
        $table_name = MU(FORM::$_table_name)->where($where)->getField("table_name");
        // 获取检索字段
        $where = array();
        $where['fid'] = array(
            "eq",
            $fid
        );
        $where['is_del'] = array(
            "eq",
            0
        );
        $where['field_type'] = array(
            "in",
            array(
                'text',
                'select',
                'textarea'
            )
        );
        $where['type'] = array(
            "eq",
            2
        );
        $where['is_search'] = array(
            "eq",
            1
        );
        $search_field_list = MU(FORM_FIELDS::$_table_name)->where($where)
        ->order("id asc")
        ->select();
        $this->assign("search_field_list", $search_field_list);
        
        // 组合查询条件
        $data_where = array();
        for ($i = 0; $i < count($search_field_list); $i = $i + 1) {
            if ($search_field_list[$i]['field_type'] == 'text' || $search_field_list[$i]['field_type'] == 'textarea') {
                if(TDI('get.' . $search_field_list[$i]['field_name']) != ''){
                    $data_where[$search_field_list[$i]['field_name']] = array(
                        "like",
                        '%' . TDI('get.' . $search_field_list[$i]['field_name']) . '%'
                    );
                }
            } else {
                if(TDI('get.' . $search_field_list[$i]['field_name']) != ''){
                    $data_where[$search_field_list[$i]['field_name']] = array(
                        "eq",
                        TDI('get.' . $search_field_list[$i]['field_name'])
                    );
                }
            }
        }
        
        // 获取列表展示字段
        $where = array();
        $where['fid'] = array(
            "eq",
            $fid
        );
        $where['is_del'] = array(
            "eq",
            0
        );
        $where['field_type'] = array(
            "in",
            array(
                'text',
                'select',
                'date',
                'date_part',
                'textarea',
                'checkbox'
            )
        );
        $where['type'] = array(
            "eq",
            2
        );
        $where['is_in_list'] = array(
            "eq",
            1
        );
        $list_field_list = MU(FORM_FIELDS::$_table_name)->where($where)
        ->order("id asc")
        ->select();
        $this->assign("list_field_list", $list_field_list);
        
        $data_where['is_del'] = array(
            "eq",
            0
        );
        $count = MU($table_name)->where($data_where)->count();
        $page = new TDPAGE($count, 16);
        $list = MU($table_name)->where($data_where)
        ->limit($page->firstRow . "," . $page->listRows)
        ->order("id desc")
        ->select();
        $this->assign("list", $list);
        $this->assign("page", $page->show());
        $this->display();
    }
    
    public function detail()
    {
        $fid = TDI("get.fid");
        $where['id'] = array(
            "eq",
            $fid
        );
        $where['is_del'] = array(
            "eq",
            0
        );
        $table_name = MU(FORM::$_table_name)->where($where)->getField("table_name");
        
        $where = array();
        $where['id'] = array(
            "eq",
            TDI("get.id")
        );
        $where['is_del'] = array(
            "eq",
            0
        );
        $info = MU($table_name)->where($where)->find();
        // 获取字段名
        $where = array();
        $where['fid'] = array(
            "eq",
            $fid
        );
        $where['is_del'] = array(
            "eq",
            0
        );
        $where['type'] = array(
            "neq",
            3
        );
        $filed_list = MU(FORM_FIELDS::$_table_name)->where($where)->select();
        $this->assign("info", $info);
        $this->assign("field_list", $filed_list);
        $this->display();
    }
    
    public function del()
    {
        $fid = TDI("get.fid");
        $where['id'] = array(
            "eq",
            $fid
        );
        $where['is_del'] = array(
            "eq",
            0
        );
        $table_name = MU(FORM::$_table_name)->where($where)->getField("table_name");
        
        $id = TDI("post.id");
        $where = array();
        $where['id'] = array(
            "eq",
            $id
        );
        $save_data = array();
        $save_data['is_del'] = 1;
        $res = MU($table_name)->where($where)->save($save_data);
        if ($res === false) {
            $this->error("删除失败");
        } else {
            $this->success("删除成功");
        }
    }

}