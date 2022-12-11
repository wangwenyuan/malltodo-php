<?php

class IndexTDController extends TDCONTROLLER
{

    public function index()
    {
        $this->display();
    }

    public function second()
    {
        $this->display();
    }

    public function third()
    {
        if (TD_IS_POST) {
            $db_host = trim(TDI("post.db_host"));
            if ($db_host == "") {
                $this->error("数据库主机地址不能为空");
                return;
            }
            $db_username = trim(TDI("post.db_username"));
            if ($db_username == "") {
                $this->error("数据库用户名不能为空");
                return;
            }
            $db_password = trim(TDI("post.db_password"));
            if ($db_password == "") {
                $this->error("数据库密码不能为空");
                return;
            }
            $db_name = trim(TDI("post.db_name"));
            if ($db_name == "") {
                $this->error("数据库名不能为空");
                return;
            }
            $db_port = trim(TDI("post.db_port"));
            if ($db_port == "") {
                $this->error("数据库端口不能为空");
                return;
            }

            $admin_username = trim(TDI("post.admin_username"));
            $admin_password = trim(TDI("post.admin_password"));
            if ($admin_username == "") {
                $this->error("用户名不能为空");
                return;
            }

            if ($admin_password == "") {
                $this->error("密码不能为空");
                return;
            }
            // 写入配置文件
            $config_content = '<?php
                                TDConfig::$db_host = "' . $db_host . '";
                                TDConfig::$db_port = "' . $db_port . '";
                                TDConfig::$db_name = "' . $db_name . '";
                                TDConfig::$db_username = "' . $db_username . '";
                                TDConfig::$db_password = "' . $db_password . '";
                                TDConfig::$table_pre = "javatodo_";
                                TDConfig::$todo_pre = "";';
            if (! is_writable("./Common/database.config.php")) {
                chmod("./Common/database.config.php", 0777);
            }
            file_put_contents('./Common/database.config.php', $config_content);
            // 获取所有的sql文件
            $path = "./Install/database";
            $dh = opendir($path);
            $conn = new PDO("mysql:host=" . $db_host . ";port=" . $db_port . ";dbname=" . $db_name . ";charset=utf8", $db_username, $db_password);
            while ($file = readdir($dh)) {
                if (strpos($file, ".sql") === false) {
                    continue;
                } else {
                    $fullpath = $path . "/" . $file;
                    $sql = file_get_contents($fullpath);
                    // pdo执行sql文件，生成数据表
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                }
            }
            // 生成lock文件
            file_put_contents("./runtime/lock", "");
            // 写入超级管理员用户名和密码
            TDConfig::$db_host = $db_host;
            TDConfig::$db_port = $db_port;
            TDConfig::$db_name = $db_name;
            TDConfig::$db_username = $db_username;
            TDConfig::$db_password = $db_password;
            TDConfig::$table_pre = "javatodo_";
            $data = array();
            $data[ADMIN::$username] = $admin_username;
            $data[ADMIN::$password] = TDCREATEPASSWORD($admin_password);
            MU(ADMIN::$_table_name)->data($data)->add();
            // 删除安装文件
            deldir("./Install");
        } else {
            $this->display();
        }
    }
}