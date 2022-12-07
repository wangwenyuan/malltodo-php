<?php
require_once dirname(dirname(__DIR__)) . '/Index/Controller/CommonTDController.php';

class WeixinTDController extends CommonTDController
{

    public function index()
    {
        $info = TDORM(WEIXIN::$_table_name)->order("id desc")->find();
        if (TD_IS_POST) {
            $data = TDI("post.");
            if ($data[WEIXIN::$appid] == "") {
                $this->error("微信公众号的appid不能为空");
            }
            if ($data[WEIXIN::$appsecret] == "") {
                $this->error("微信公众号的appsecret不能为空");
            }
            if ($info) {
                TDORM(WEIXIN::$_table_name)->where(array(
                    "id" => array(
                        "eq",
                        $info[WEIXIN::$id]
                    )
                ))->save($data);
            } else {
                TDORM(WEIXIN::$_table_name)->data($data)->add();
            }
            $this->success("设置成功");
        } else {
            $this->assign("info", $info);
            $this->display();
        }
    }
}