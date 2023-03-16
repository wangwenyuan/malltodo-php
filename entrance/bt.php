<?php
/*
 * 用于生成宝塔一键部署的文件
 */
require_once '../phptodo/PHPTODO.php';
require_once '../Common/function.php';
require_once '../../malltodo-php.database.config/bt.php';
require_once './build.php';

class Bt
{

    private $target = "D:/malltodo_bt";

    // 生成宝塔自动安装文件（v1.2版本之后用该方法）
    private function create_bt_auto_install()
    {
        $content = '{
	"php_ext":"",
	"chmod":[],
	"success_url":"/admin.php",
	"php_versions":"56,70,71,72,73",
	"db_config":"",
	"admin_username":"admin",
	"admin_password":"111111",
	"run_path":"/",
	"remove_file":[],
	"enable_functions":[]
}';
        file_put_contents($this->target . "/auto_install.json", $content);
    }

    // v1.2版本之后的生成脚本
    public function build()
    {
        $build = new Build();
        if (defined("MALLTODO_BT")) {
            if (is_dir($this->target)) { // 删除该文件夹
                $build->_cleandir($this->target);
            }
            $res = copy_dir(dirname(__DIR__), $this->target);
            if ($res) {
                chmod($this->target . "/", 0777);
                // 删除bt.php
                unlink($this->target . "/www/bt.php");
                unlink($this->target . "/www/build.php");
                unlink($this->target . "/www/buildDemo.php");
                // 删除database.php
                unlink($this->target . "/www/database.php");
                unlink($this->target . "/www/.buildpath");
                unlink($this->target . "/www/.project");
                unlink($this->target . "/www/.htaccess");
                unlink($this->target . "/www/nginx.htaccess");
                // 删除模板文件夹
                $build->deleteTemplate($this->target);
                $build->deleteTemplate($this->target);
                $build->deleteTemplate($this->target);

                $this->create_bt_auto_install();

                $build->_deletedir($this->target . "/readme_images");
                unlink($this->target . "/README.md");
                echo "success";
            }
        } else {
            exit();
        }
    }
}

if (strpos($_SERVER["PHP_SELF"], "bt.php") !== FALSE) {
    $bt = new Bt();
    $bt->build();
}
