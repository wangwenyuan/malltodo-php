<?php
/*
 * 用于生成宝塔一键部署的文件
 */
require_once './phptodo/PHPTODO.php';
require_once './Common/function.php';
require_once '../malltodo-php.database.config/bt.php';

class Bt
{

    private $target = "D:/malltodo_bt";

    // 生成宝塔数据库配置文件
    private function create_bt_database_config()
    {
        $config_content = '<?php
TDConfig::$db_host = "localhost";
TDConfig::$db_port = "3306";
TDConfig::$db_name = "BT_DB_NAME";
TDConfig::$db_username = "BT_DB_USERNAME";
TDConfig::$db_password = "BT_DB_PASSWORD";
TDConfig::$table_pre = "javatodo_";
TDConfig::$todo_pre = "";';
        if (! is_writable($this->target . "/Common/database.config.php")) {
            chmod($this->target . "/Common/", 0777);
        }
        file_put_contents($this->target . '/Common/database.config.php', $config_content);
    }

    // 生成宝塔自动安装文件
    private function create_bt_auto_install()
    {
        $content = '{
	"php_ext":"",
	"chmod":[],
	"success_url":"/admin.php",
	"php_versions":"56,70,71,72,73",
	"db_config":"/Common/database.config.php",
	"admin_username":"admin",
	"admin_password":"111111",
	"run_path":"/",
	"remove_file":[],
	"enable_functions":[]
}';
        file_put_contents($this->target . "/auto_install.json", $content);
    }

    // 生成宝塔自动安装数据库文件
    private function create_bt_install_sql()
    {
        $path = "./Install/database";
        $dh = opendir($path);
        while ($file = readdir($dh)) {
            if (strpos($file, ".sql") === false) {
                continue;
            } else {
                $fullpath = $path . "/" . $file;
                $sql = file_get_contents($fullpath);
                file_put_contents($this->target . "/import.sql", $sql . ";" . PHP_EOL, FILE_APPEND);
            }
        }
        $sql = "INSERT INTO `javatodo_admin` (`id`, `mobile`, `username`, `password`, `name`, `alias`, `hader_img`, `department`, `role_id`, `sort`, `position`, `gender`, `email`, `biz_mail`, `telephone`, `is_leader_in_dept`, `direct_leader`, `external_position`, `address`, `main_department`, `apptoken`, `is_del`) VALUES ('1', '', 'admin', '7681c526a4414ffa6d20ef756e8a9c46', '', '', '', '', '0', 0, '', 1, '', '', '', '', '', '', '', '', '', 0);";
        file_put_contents($this->target . "/import.sql", $sql . ";" . PHP_EOL, FILE_APPEND);
    }

    public function build()
    {
        if (defined("MALLTODO_BT")) {
            if (is_dir($this->target)) { // 删除该文件夹
                deldir($this->target);
            }
            $res = copy_dir(__DIR__, $this->target);
            if ($res) {
                chmod($this->target . "/", 0777);
                // 删除bt.php
                unlink($this->target . "/bt.php");
                // 删除database.php
                unlink($this->target . "/database.php");
                unlink($this->target . "/.buildpath");
                unlink($this->target . "/.project");
                // 删除Install文件夹
                deldir($this->target . "/Install");
                // 生成lock文件
                file_put_contents($this->target . "/runtime/lock", "");
                // 生成宝塔数据库配置文件
                $this->create_bt_database_config();
                // 生成自动安装文件
                $this->create_bt_auto_install();
                // 生成自动安装数据库文件
                $this->create_bt_install_sql();
                // 删除readme_images文件夹
                deldir($this->target . "/readme_images");
                // 删除readme.md文件
                unlink($this->target . "/README.md");
                echo "success";
            }
        } else {
            exit();
        }
    }
}

$bt = new Bt();
$bt->build();