<?php
require_once __DIR__ . '/BaseTDController.php';

class UploadTDController extends TDCONTROLLER
{

    public function index()
    {
        $admin_id = TDSESSION("admin_id");
        $store_id = TDSESSION("store_id");
        $uid = TDSESSION("uid");
        $agent_id = "";
        $merchant_id = "";
        if ($admin_id == "" && $store_id == "" && $uid == "") {
            $this->error("无权上传");
            return;
        }

        $upload = new TDUPLOAD();
        $upload->maxSize = TDConfig::$upload["maxSize"];
        $upload->exts = TDConfig::$upload["exts"];
        $upload->rootPath = TDConfig::$upload["rootPath"];
        $info = $upload->uploadOne($_FILES['imgFile']);
        if (! $info) {
            // var_dump($upload->getError());
            $this->error($upload->getError());
            exit();
        } else {
            $data = array();
            $data[FILE::$admin_id] = $admin_id;
            $data[FILE::$store_id] = $store_id;
            $data[FILE::$uid] = $uid;
            $data[FILE::$agent_id] = $agent_id;
            $data[FILE::$merchant_id] = $merchant_id;
            $data[FILE::$url] = TDConfig::$upload["picUrl"] . $info["savepath"] . $info["savename"];
            $data[FILE::$name] = $info["name"];
            $data[FILE::$ext] = $info["ext"];
            $data[FILE::$show_pic] = $data[FILE::$url];
            $data[FILE::$addtime] = time();
            $data[FILE::$filesize] = $info["size"];
            MU(FILE::$_table_name)->data($data)->add();
            $ret = array();
            $ret["error"] = 0;
            $ret["url"] = TDConfig::$upload["picUrl"] . $info["savepath"] . $info["savename"];
            echo json_encode($ret, JSON_UNESCAPED_UNICODE);
        }
    }

    public function base64()
    {
        $admin_id = TDSESSION("admin_id");
        $store_id = TDSESSION("store_id");
        $uid = TDSESSION("uid");
        $agent_id = "";
        $merchant_id = "";
        if ($admin_id == "" && $store_id == "" && $uid == "") {
            $this->error("无权上传");
            return;
        }
        if (TD_IS_POST) {
            $base64 = TDI("post.base64");
            $base64_arr = explode(";base64,", $base64);
            if (count($base64_arr) < 2) {
                return;
            }
            $tou = $base64_arr[0];
            $base64 = $base64_arr[1];
            $tou_arr = explode("/", $tou);
            if (count($tou_arr) < 2) {
                return;
            }
            $houzhui = $tou_arr[1];
            if (! ($houzhui == "jpg" || $houzhui == "jpeg" || $houzhui == "gif" || $houzhui == "png" || $houzhui == "mp4")) {
                $this->error("该文件不允许上传");
                return;
            }
            $save_dir = date("Y-m-d", time());
            $save_path = TDConfig::$upload["rootPath"] . $save_dir;
            if (! is_dir($save_path)) {
                mkdir($save_path, 0777, true);
                chmod($save_path, 0777);
            }
            $shijian = microtime();
            $shijian_arr = explode(" ", $shijian);
            $save_file = $shijian_arr[1] . (substr($shijian_arr[0], 2, 9)) . rand(10000, 99999) . rand(1000, 9999) . "." . $houzhui;

            file_put_contents($save_path . "/" . $save_file, base64_decode($base64));

            $data = array();
            $data[FILE::$admin_id] = $admin_id;
            $data[FILE::$store_id] = $store_id;
            $data[FILE::$uid] = $uid;
            $data[FILE::$agent_id] = $agent_id;
            $data[FILE::$merchant_id] = $merchant_id;
            $data[FILE::$url] = TDConfig::$upload["picUrl"] . $save_dir . "/" . $save_file;
            $data[FILE::$name] = $save_file;
            $data[FILE::$ext] = $houzhui;
            $data[FILE::$show_pic] = $data[FILE::$url];
            $data[FILE::$addtime] = time();
            $data[FILE::$filesize] = filesize($save_path . "/" . $save_file);
            MU(FILE::$_table_name)->data($data)->add();
            $ret = array();
            $ret["error"] = 0;
            $ret["url"] = TDConfig::$upload["picUrl"] . $save_dir . "/" . $save_file;
            echo json_encode($ret, JSON_UNESCAPED_UNICODE);
        }
    }
}