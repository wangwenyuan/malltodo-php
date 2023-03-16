<?php
/*
 * 用于生成开源库的文件
 */
require_once '../phptodo/PHPTODO.php';
require_once '../Common/function.php';
require_once '../../malltodo-php.database.config/bt.php';

class Build
{

    private $target = "D:/phpstudy_pro/WWW/malltodo-demo";

    public function _cleandir($path)
    {
        $dh = opendir($path);
        while ($file = readdir($dh)) {
            if ($file != "." && $file != ".." && $file != "index.html" && $file != ".git" && $file != ".settings") {
                $fullpath = $path . "/" . $file;
                if (! is_dir($fullpath)) {
                    @unlink($fullpath);
                } else {
                    $this->_cleandir($fullpath);
                }
            }
        }
    }

    public function _deletedir($path)
    {
        $dh = opendir($path);
        while ($file = readdir($dh)) {
            if ($file != "." && $file != "..") {
                $fullpath = $path . "/" . $file;
                if (! is_dir($fullpath)) {
                    @unlink($fullpath);
                } else {
                    $this->_deletedir($fullpath);
                }
            }
        }
        rmdir($path);
    }

    public function deleteTemplate($base_path)
    {
        $path = $base_path . "/template";
        $this->_deletedir($path . "/-tools");
        $this->_deletedir($path . "/base");
        $this->_deletedir($base_path . "/www/template/base");
    }

    public function create()
    {
        if (is_dir($this->target)) { // 删除该文件夹
            $this->_cleandir($this->target);
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

            $this->_deletedir($this->target . "/readme_images");
            unlink($this->target . "/README.md");

            // 删除模板文件夹
            $this->deleteTemplate($this->target);
            $this->deleteTemplate($this->target);
            $this->deleteTemplate($this->target);
            echo "success";
        }
    }
}

if (strpos($_SERVER["PHP_SELF"], "buildDemo.php") !== FALSE) {
    $build = new Build();
    $build->create();
}