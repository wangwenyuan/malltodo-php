<?php
require_once dirname(dirname(__DIR__)) . '/Index/Controller/CommonTDController.php';

class JdTDController extends CommonTDController
{

    public function index()
    {
        $info = TDORM(JD::$_table_name)->order("id desc")->find();
        if (TD_IS_POST) {
            $data = TDI("post.");
            if ($info) {
                TDORM(JD::$_table_name)->where(array(
                    "id" => array(
                        "eq",
                        $info[JD::$id]
                    )
                ))->save($data);
            } else {
                TDORM(JD::$_table_name)->data($data)->add();
            }
            $this->success("设置成功");
        } else {
            $this->assign("info", $info);
            $this->display();
        }
    }
}