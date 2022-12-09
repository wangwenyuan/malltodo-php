<?php

class MessageTDController extends BaseTDController
{

    public function index()
    {
        if (TD_IS_POST) {
            $name = trim(TDI("post.name"));
            if ($name == "") {
                $this->error("姓名不能为空");
                return;
            }
            $tel = trim(TDI("post.tel"));
            if ($tel == "") {
                $this->error("手机号不能为空");
                return;
            }
            if (! check_mobile_format($tel)) {
                $this->error("手机号格式有误");
                return;
            }
            $email = trim(TDI("post.email"));
            $yanzhengma = trim(TDI("post.yanzhengma"));
            if (! $this->check_verify($yanzhengma)) {
                $this->error("验证码输入错误");
                return;
            }
            $message = trim(TDI("post.message"));
            if ($message == "") {
                $this->error("留言内容不能为空");
                return;
            }

            // 存入数据库
            $data = TDI("post.");
            $data[MESSAGE::$ip] = $_SERVER['REMOTE_ADDR'];
            $data[MESSAGE::$addtime] = time();
            $data[MESSAGE::$website_id] = TDSESSION("website_id");
            $id = MU(MESSAGE::$_table_name)->data($data)->add();
            if ($id == null) {
                $this->error("提交失败");
                return;
            } else {
                $this->success("提交成功");
                return;
            }
        } else {
            $this->homePagePage("Index/Message/index");
        }
    }
}