<?php
require_once dirname(dirname(__DIR__)) . '/Index/Controller/CommonTDController.php';

require_once dirname(dirname(dirname(__DIR__))) . '/Common/MenuCache.php';

class Base extends CommonTDController
{

    protected $categoryType = "";

    protected $detailType = "";

    private $admin_menu_list = array();

    private function get_admin_menu_list($_admin_menu_list)
    {
        for ($i = 0; $i < count($_admin_menu_list); $i = $i + 1) {
            array_push($this->admin_menu_list, $_admin_menu_list[$i]);
            if (count($_admin_menu_list[$i]->sub_menu) > 0) {
                $this->get_admin_menu_list($_admin_menu_list[$i]->sub_menu);
            }
        }
    }

    public function index()
    {
        $where = array();
        $where["n." . DETAIL::$is_del] = array(
            "eq",
            0
        );
        $where["n." . DETAIL::$type] = array(
            "eq",
            $this->detailType
        );
        $where["n." . DETAIL::$website_id] = array(
            "eq",
            TDSESSION("website_id")
        );
        $count = MU(DETAIL::$_table_name)->alias("n")
            ->where($where)
            ->count();
        $page = $this->page($count, 16);
        $list = MU(DETAIL::$_table_name)->alias("n")
            ->join(CATEGORY::$_table_name, " as c on n.category_id = c.id", "left")
            ->where($where)
            ->limit($page->firstRow . "," . $page->listRows)
            ->order(DETAIL::$id . " desc")
            ->field("n.*, c.category_name")
            ->select();
        $this->assign("list", $list);
        $this->assign("page", $page->show());
        $this->display("Detail/Base/index");
    }

    public function add()
    {
        $id = trim(TDI("get.id"));
        $where = array();
        $info = array();
        if ($id != "") {
            $where[DETAIL::$id] = array(
                "eq",
                $id
            );
            $where[DETAIL::$is_del] = array(
                "eq",
                0
            );
            $where[DETAIL::$type] = array(
                "eq",
                $this->detailType
            );
            $where[DETAIL::$website_id] = array(
                "eq",
                TDSESSION("website_id")
            );
            $info = MU(DETAIL::$_table_name)->where($where)->find();
            if ($info == null) {
                $this->error("该内容不存在或已被删除");
                return;
            }
            $info[DETAIL::$detail] = htmlspecialchars_decode($info[DETAIL::$detail]);
        }

        // 获取栏目
        $_admin_menu_list = MenuCache::getAdminMenuList(TDSESSION("website_id"));
        $this->get_admin_menu_list($_admin_menu_list);
        $admin_menu_list = json_decode(json_encode($this->admin_menu_list, JSON_UNESCAPED_UNICODE), true);
        $menu_json = array();
        for ($i = 0; $i < count($admin_menu_list); $i = $i + 1) {
            $jsonObject = $admin_menu_list[$i];
            $sign = "";
            for ($n = 0; $n < $jsonObject["level"]; $n = $n + 1) {
                $sign = $sign . "——";
            }
            $_id = $jsonObject[CATEGORY::$id];
            $name = $jsonObject[CATEGORY::$category_name];
            $name = $sign . $name;
            $type = $jsonObject[CATEGORY::$type];
            if ($type == $this->categoryType) {
                $menu_json[$_id] = $name;
            }
        }

        // 获取所有的默认模板
        $where = array();
        $where[RENOVATION::$type] = array(
            "eq",
            $this->detailType
        );
        $where[RENOVATION::$is_del] = array(
            "eq",
            0
        );
        $where[RENOVATION::$website_id] = array(
            "eq",
            TDSESSION("website_id")
        );
        $_renovation_list = MU(RENOVATION::$_table_name)->where($where)
            ->order(RENOVATION::$id . " asc")
            ->select();
        $pc_renovation_map = array();
        $mobile_renovation_map = array();
        $pc_renovation_map["0"] = "默认模板";
        $mobile_renovation_map["0"] = "默认模板";
        for ($i = 0; $i < count($_renovation_list); $i = $i + 1) {
            if ($_renovation_list[$i][RENOVATION::$id] == "pc") {
                $pc_renovation_map[$_renovation_list[$i][RENOVATION::$id]] = $_renovation_list[$i][RENOVATION::$name];
            } else {
                $mobile_renovation_map[$_renovation_list[$i][RENOVATION::$id]] = $_renovation_list[$i][RENOVATION::$name];
            }
        }
        // 获取所有的自定义模板
        $where = array();
        $where[RENOVATION::$type] = array(
            "eq",
            "Index/Index/custom"
        );
        $where[RENOVATION::$is_del] = array(
            "eq",
            0
        );
        $where[RENOVATION::$website_id] = array(
            "eq",
            TDSESSION("website_id")
        );
        $_custom_list = MU(RENOVATION::$_table_name)->where($where)
            ->order(RENOVATION::$id . " asc")
            ->select();
        $pc_custom_map = array();
        $mobile_custom_map = array();
        for ($i = 0; $i < count($_custom_list); $i = $i + 1) {
            if ($_renovation_list[$i][RENOVATION::$id] == "pc") {
                $pc_custom_map[$_custom_list[$i][RENOVATION::$id]] = $_custom_list[$i][RENOVATION::$name];
            } else {
                $mobile_custom_map[$_custom_list[$i][RENOVATION::$id]] = $_custom_list[$i][RENOVATION::$name];
            }
        }
        if (TD_IS_POST) {
            $_data = trim_array(TDI("post."));
            $category_id = trim(TDI("post.category_id"));
            if (! isset($menu_json[$category_id])) {
                $this->error("请选择正确的栏目");
                return;
            }
            $title = trim(TDI("post." . DETAIL::$title));
            if ($title == "") {
                $this->error("标题不能为空");
                return;
            }
            if ($_data[DETAIL::$seo_title] == "") {
                $_data[DETAIL::$seo_title] = $title;
            }
            if ($_data[DETAIL::$seo_keywords] == "") {
                $_data[DETAIL::$seo_keywords] = $title;
            }
            if ($_data[DETAIL::$seo_description] == "") {
                $_data[DETAIL::$seo_description] = $title;
            }
            if ($_data[DETAIL::$release_time] == "") {
                $_data[DETAIL::$release_time] = time();
            } else {
                $_data[DETAIL::$release_time] = strtotime($_data[DETAIL::$release_time]);
            }
            $_data[DETAIL::$sort] = (int) trim(TDI("post.sort"));
            $_data[DETAIL::$admin_id] = TDSESSION("admin_id");
            $renovation_type = (int) trim(TDI("post.renovation_type"));
            if ($renovation_type == 0) { // 普通模板
                $pc_renovation_id = trim(TDI("post.pc_renovation_id"));
                $mobile_renovation_id = trim(TDI("post.mobile_renovation_id"));
                if (! isset($pc_renovation_map[$pc_renovation_id])) {
                    $this->error("电脑端模板选择有误");
                    return;
                }
                $_data[DETAIL::$renovation_type] = $renovation_type;
                $_data[DETAIL::$pc_renovation_id] = (int) $pc_renovation_id;
                $_data[DETAIL::$mobile_renovation_id] = (int) $mobile_renovation_id;
                $_data[DETAIL::$pc_custom_id] = "0";
                $_data[DETAIL::$mobile_custom_id] = "0";
            } else { // 自定义模板
                $pc_custom_id = trim(TDI(DETAIL::$pc_custom_id));
                $mobile_custom_id = trim(TDI(DETAIL::$mobile_custom_id));
                if (! isset($pc_custom_map[$pc_custom_id])) {
                    $this->error("电脑端自定义模板选择有误");
                    return;
                }
                $_data[DETAIL::$renovation_type] = $renovation_type;
                $_data[DETAIL::$pc_renovation_id] = "0";
                $_data[DETAIL::$mobile_renovation_id] = "0";
                $_data[DETAIL::$pc_custom_id] = $pc_custom_id;
                $_data[DETAIL::$mobile_custom_id] = $mobile_custom_id;
            }
            $_data[DETAIL::$type] = $this->detailType;
            if ($id == "") {
                $_data[DETAIL::$website_id] = TDSESSION("website_id");
                MU(DETAIL::$_table_name)->data($_data)->add();
                $this->success("添加成功");
                return;
            } else {
                $where = array();
                $where[DETAIL::$id] = array(
                    "eq",
                    $id
                );
                $where[DETAIL::$website_id] = array(
                    "eq",
                    TDSESSION("website_id")
                );
                MU(DETAIL::$_table_name)->where($where)->save($_data);
                $this->success("修改成功");
                return;
            }
        } else {
            $this->assign("category_map", $menu_json);
            $this->assign("pc_renovation", $pc_renovation_map);
            $this->assign("mobile_renovation", $mobile_renovation_map);
            $this->assign("pc_custom", $pc_custom_map);
            $this->assign("mobile_custom", $mobile_custom_map);

            $this->assign("info", $info);
            $this->display("Detail/Base/add");
        }
    }

    public function edit()
    {
        $this->add();
    }

    public function del()
    {
        if (TD_IS_POST) {
            $id = trim(TDI("post.id"));
            $where = array();
            $where[DETAIL::$id] = array(
                "eq",
                $id
            );
            $where[DETAIL::$website_id] = array(
                "eq",
                TDSESSION("website_id")
            );
            $data = array();
            $data[DETAIL::$is_del] = 1;
            MU(DETAIL::$_table_name)->where($where)->save($data);
            $this->success("删除成功");
        }
    }
}