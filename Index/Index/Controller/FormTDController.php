<?php

class FormTDController extends TDCONTROLLER
{

    public function _td_init()
    {
        get_home_website_id();
    }

    public function index()
    {
        $id = TDI("get.id");
        $where = array();
        $where['id'] = array(
            "eq",
            $id
        );
        $where['is_del'] = array(
            "eq",
            0
        );
        $form_info = MU("form")->where($where)->find();
        if (! $form_info) {
            $this->error("该自定义表单不存在");
        }
        if (TD_IS_POST) {
            $input_data = TDI("post.");
            if (TDI("post.malltodo_xieyi") != "on") {
                $this->error("需要先同意隐私协议");
            }
            foreach ($input_data as $k => $v) {
                if (is_array($v)) {
                    $input_data[$k] = implode("|", $v);
                }
            }
            $input_data['ip'] = get_client_ip();
            $input_data['create_time'] = date("Y-m-d H:i:s", time());
            $table_name = $form_info['table_name'];
            $ret = check_customer_form($table_name, $input_data);
            if ($ret['status'] == 0) {
                $this->error($ret['info']);
            }
            $id = MU($table_name)->data($input_data)->add();
            if ($id) {
                $this->success("提交成功");
            } else {
                $this->error("提交失败");
            }
        } else {
            $form_html = create_customer_form_table($id, TDU("Index/Form/index", array(
                "id" => $id
            )));
            $this->assign("form_html", $form_html);
            $this->assign("form_name", $form_info['name']);
            $this->display();
        }
    }
    
    public function detail()
    {
        $id = TDI("get.id");
        $where = array();
        $where['id'] = array(
            "eq",
            $id
        );
        $where['is_del'] = array(
            "eq",
            0
        );
        $form_info = MU("form")->where($where)->find();
        $this->assign("detail", htmlspecialchars_decode($form_info["detail"]));
        $this->display();
    }
}