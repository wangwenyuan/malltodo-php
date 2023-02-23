<?php
require_once 'CommonTDController.php';

class IndexTDController extends CommonTDController
{

    public function index()
    {
        $this->display();
    }

    public function login()
    {
        if (TD_IS_POST) {
            $verify = new TDVERIFY();
            if (! $verify->check(TDI("post.verify"))) {
                $this->error('验证码错误');
                return;
            }
            // 如果admin数据表的数据为空，则创建一条默认的admin登录账号
            if (TDORM(ADMIN::$_table_name)->count() == 0) {
                $default_admin_data = array();
                $default_admin_data[ADMIN::$username] = "admin";
                $default_admin_data[ADMIN::$password] = create_password("111111");
                MU(ADMIN::$_table_name)->data($default_admin_data)->add();
            }
            $username = TDI("post." . ADMIN::$username);
            $password = TDI("post." . ADMIN::$password);
            $where = array();
            $where[ADMIN::$username] = array(
                "eq",
                $username
            );
            $where[ADMIN::$password] = array(
                "eq",
                create_password($password)
            );
            $where[ADMIN::$is_del] = array(
                "eq",
                0
            );
            $info = TDORM(ADMIN::$_table_name)->where($where)->find();
            if ($info) {
                TDSESSION("admin_id", $info[ADMIN::$id]);
                TDSESSION("admin_name", $info[ADMIN::$username]);
                TDSESSION("role_id", $info[ADMIN::$role_id]);
                $this->success("登录成功", TDU("Index/Index/index"));
                return;
            } else {
                $this->error("用户名或密码错误");
                return;
            }
        } else {
            $this->display();
        }
    }

    public function verify()
    {
        $config = array(
            'fontSize' => 30, // 验证码字体大小
            'length' => 3, // 验证码位数
            'useNoise' => false // 关闭验证码杂点
        );
        $Verify = new TDVERIFY($config);
        $Verify->entry();
    }

    public function signOut()
    {
        TDSESSION(null);
        $this->success("退出成功", TDU("Index/Index/login"));
    }
}