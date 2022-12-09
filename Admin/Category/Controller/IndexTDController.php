<?php
use function TDUPLOAD\check;

require_once dirname(dirname(__DIR__)) . '/Index/Controller/CommonTDController.php';
require_once './Common/MenuCache.php';

class IndexTDController extends CommonTDController
{

    public function index()
    {
        MenuCache::init(TDSESSION("website_id"));
        $admin_menu_list = MenuCache::getAdminMenuList(TDSESSION("website_id"));
        $admin_menu_list = json_decode(json_encode($admin_menu_list, JSON_UNESCAPED_UNICODE), true);
        $this->assign("list", $admin_menu_list);
        $this->display();
    }

    public function add()
    {
        $where = array();
        $info = array();
        if (TDI("get." . CATEGORY::$id) != "") {
            $where[CATEGORY::$id] = array(
                "eq",
                trim(TDI("get." . CATEGORY::$id))
            );
            $where[CATEGORY::$is_del] = array(
                "eq",
                0
            );
            $info = MU(CATEGORY::$_table_name)->where($where)->find();
            if ($info == null) {
                $this->error("不存在该栏目或已被删除");
                return;
            }
        }
        // 获取所有的pc端模版
        $pc_renovation_where = array();
        $pc_renovation_where[RENOVATION::$platform] = array(
            "eq",
            "pc"
        );
        $pc_renovation_where[RENOVATION::$is_del] = array(
            "eq",
            0
        );
        $pc_renovation_list = MU(RENOVATION::$_table_name)->where($pc_renovation_where)->select();
        $pc_renovation = array();
        for ($i = 0; $i < count($pc_renovation_list); $i = $i + 1) {
            $object = array();
            $object[RENOVATION::$name] = $pc_renovation_list[$i][RENOVATION::$name];
            $object[RENOVATION::$type] = $pc_renovation_list[$i][RENOVATION::$type];
            $pc_renovation[$pc_renovation_list[$i][RENOVATION::$id]] = $object;
        }
        // 获取所有的手机端模版
        $mobile_renovation_where = array();
        $mobile_renovation_where[RENOVATION::$platform] = array(
            "eq",
            "mobile"
        );
        $mobile_renovation_where[RENOVATION::$is_del] = array(
            "eq",
            0
        );
        $mobile_renovation_list = MU(RENOVATION::$_table_name)->where($mobile_renovation_where)->select();
        $mobile_renovation = array();
        for ($i = 0; $i < count(mobile_renovation_list); $i = $i + 1) {
            $object = array();
            $object[RENOVATION::$name] = $mobile_renovation_list[$i][RENOVATION::$name];
            $object[RENOVATION::$type] = $mobile_renovation_list[$i][RENOVATION::$type];
            $mobile_renovation[$mobile_renovation_list[$i][RENOVATION::$id]] = $object;
        }

        $admin_menu_list = MenuCache::getAdminMenuList(TDSESSION("website_id"));
        $menu_json = array();
        $_menu_json = array();
        $_menu_json["0"] = "顶级栏目";
        $admin_menu_list = json_decode(json_encode($admin_menu_list, JSON_UNESCAPED_UNICODE), true);
        for ($i = 0; $i < count($admin_menu_list); $i = $i + 1) {
            $jsonObject = $admin_menu_list[$i];
            $sign = "";
            for ($n = 0; $n < $jsonObject["level"]; $n = $n + 1) {
                $sign = $sign . "——";
            }
            $id = $jsonObject[CATEGORY::$id];
            $name = $jsonObject[CATEGORY::$category_name];
            $name = $sign . $name;
            $type = $jsonObject[CATEGORY::$type];
            $object = array();
            $object["id"] = $id;
            $object["name"] = $name;
            $object["type"] = $type;
            $_menu_json[$id] = $name;
            $menu_json[$id] = $object;
        }

        // 获取栏目页
        if (TD_IS_POST) {
            $_input = trim_array(TDI("post."));
            $data = $_input;
            if ($data[CATEGORY::$seo_title] == "") {
                $this->error("seo标题不能为空");
                return;
            }
            if ($data[CATEGORY::$category_name] == "") {
                $this->error("栏目名称不能为空");
                return;
            }
            $type = $data[CATEGORY::$type];
            if (! isset(MenuCache::$home_menu[$key])) {
                $this->error("您选择的模型有误");
                return;
            }

            // 下级栏目的模型与上级栏目应该一致
            $pid = TDI("get." . CATEGORY::$pid);
            if ($pid != "" && $pid != "0") {
                // 获取上级的栏目模型
                $pid_type = $menu_json[$pid]["type"];
                $id_type = TDI("post." . CATEGORY::$type);
                if ($pid_type != $id_type) {
                    $this->error("下级栏目模型要与上级栏目模型一致");
                    return;
                }
            }

            if ($type == "Index/Index/index") {
                $data[CATEGORY::$pid] = "0";
                $data[CATEGORY::$category_type] = "0";
                $data[CATEGORY::$pc_list_renovation_id] = "0";
                $data[CATEGORY::$pc_page_renovation_id] = "0";
                $data[CATEGORY::$mobile_list_renovation_id] = "0";
                $data[CATEGORY::$mobile_page_renovation_id] = "0";
                $data[CATEGORY::$mobile_custom_id] = "0";
                $data[CATEGORY::$pc_custom_id] = "0";
            }

            // 加入数据库
            if (TDI("get." . CATEGORY::$id) != "") { // 修改
                                                     // 检测上级id是否符合规定
                if (! check(TDI("get." . CATEGORY::$id), $pid)) {
                    $this->error("上级id选择错误");
                    return;
                }
                MU(CATEGORY::$_table_name)->where($where)->save($data);
            } else { // 添加
                MU(CATEGORY::$_table_name)->data($data)->add();
            }
            MenuCache::clean(TDSESSION("website_id"));
            $this->success("设置成功");
            return;
        } else {
            $this->assign("info", $info);
            $this->assign("pc_renovation", $pc_renovation);
            $this->assign("mobile_renovation", $mobile_renovation);
            $this->assign("_menu_json", $_menu_json);
            $this->assign("menu_json", $menu_json);
            $this->display("add");
        }
    }

    public function edit()
    {
        $this->add();
    }

    public function adjustHidden()
    {
        if (TD_IS_POST) {
            $id = TDI("post.id");
            $where = array();
            $where[CATEGORY::$id] = array(
                "eq",
                $id
            );
            $info = MU(CATEGORY::$_table_name)->where($where)->find();
            if ($info == null) {
                $this->error("设置失败");
                return;
            }
            $save_data = array();
            if ($info[CATEGORY::$is_hidden] == "0") {
                $save_data[CATEGORY::$is_hidden] = 1;
            } else {
                $save_data[CATEGORY::$is_hidden] = 0;
            }
            MU(CATEGORY::$_table_name)->where($where)->save($save_data);
            MenuCache::clean(TDSESSION("website_id"));
            $this->success("设置成功");
        }
    }

    public function adjustSort()
    {
        if (TD_IS_POST) {
            $id = TDI("post.id");
            $sort = TDI("post.sort");
            $where = array();
            $where[CATEGORY::$id] = array(
                "eq",
                $id
            );
            $save_data = array();
            $save_data[CATEGORY::$sort] = $sort;
            // var_dump($where);
            // var_dump($save_data);
            MU(CATEGORY::$_table_name)->where($where)->save($save_data);
            MenuCache::clean(TDSESSION("website_id"));
            $this->success("设置成功");
        }
    }

    public function del()
    {
        if (TD_IS_POST) {
            $id = TDI("post.id");
            $where = array();
            $where[CATEGORY::$id] = array(
                "eq",
                $id
            );
            $data = array();
            $data[CATEGORY::$is_del] = 1;
            MU(CATEGORY::$_table_name)->where($where)->save($data);
            MenuCache::clean(TDSESSION("website_id"));
            $this->success("删除成功");
        }
    }

    private function check($id, $pid)
    {
        $id = trim($id);
        $pid = trim($pid);
        if ($id == $pid) {
            return false;
        }
        while (true) {
            $where = array();
            $where[CATEGORY::$id] = array(
                "eq",
                $pid
            );
            $where[CATEGORY::$is_del] = array(
                "eq",
                0
            );
            $_pid = MU(CATEGORY::$_table_name)->where($where)->getField(CATEGORY::$pid);
            if ($_pid == null) {
                return true;
            }
            if ($_pid == "0") {
                return true;
            }
            if ($_pid == $id) {
                return false;
            }
            $pid = $_pid;
        }
    }
}