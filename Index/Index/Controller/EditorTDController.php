<?php

class EditorTDController extends TDCONTROLLER
{

    public function index()
    {
        $admin_id = TDSESSION("admin_id");
        $store_id = TDSESSION("store_id");
        $uid = TDSESSION("uid");
        $agent_id = "";
        $merchant_id = "";
        if ($admin_id == "" && $store_id == "" && $uid == "") {
            $this->error("无进入权限");
            return;
        }
        $editor = new TDEDITOR();
        if (TDI("get.action") == "config") {
            $editor->config();
        } else if (TDI("get.action") == "uploadimage") {
            $upload = new TDUPLOAD();
            $upload->maxSize = TDConfig::$upload["maxSize"];
            $upload->exts = TDConfig::$upload["exts"];
            $upload->rootPath = TDConfig::$upload["rootPath"];
            $info = $upload->uploadOne($_FILES['upfile']);
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

                $_info = array();
                $_info["state"] = "SUCCESS";
                $_info["url"] = TDConfig::$upload["picUrl"] . $info["savepath"] . $info["savename"];
                $_info["title"] = $info["savename"];
                $_info["original"] = $info["name"];
                $_info["type"] = "." . $info["ext"];
                $_info["size"] = $info["size"];
                echo json_encode($_info, JSON_UNESCAPED_UNICODE);
            }
        } else if (TDI("get.action") == "uploadvideo") {
            $upload = new TDUPLOAD();
            $upload->maxSize = TDConfig::$upload["maxSize"];
            $upload->exts = TDConfig::$upload["exts"];
            $upload->rootPath = TDConfig::$upload["rootPath"];
            $info = $upload->uploadOne($_FILES['upfile']);
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
                
                $_info = array();
                $_info["state"] = "SUCCESS";
                $_info["url"] = TDConfig::$upload["picUrl"] . $info["savepath"] . $info["savename"];
                $_info["title"] = $info["savename"];
                $_info["original"] = $info["name"];
                $_info["type"] = "." . $info["ext"];
                $_info["size"] = $info["size"];
                echo json_encode($_info, JSON_UNESCAPED_UNICODE);
            }
        }
    }
}