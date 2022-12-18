<?php
require_once dirname(dirname(__DIR__)) . '/Index/Controller/CommonTDController.php';

class BaseRenovation extends CommonTDController
{

    protected $type = "";

    protected $platform = "";

    protected $need_default = false;

    public function index()
    {
        $where = array();
        $where[RENOVATION::$type] = array(
            "eq",
            $this->type
        );
        $where[RENOVATION::$is_del] = array(
            "eq",
            0
        );
        $where[RENOVATION::$platform] = array(
            "eq",
            $this->platform
        );
        $where[RENOVATION::$website_id] = array(
            "eq",
            TDSESSION("website_id")
        );
        $count = MU(RENOVATION::$_table_name)->where($where)->count();
        $page = new TDPAGE($count, 16);
        $list = MU(RENOVATION::$_table_name)->where($where)
            ->limit($page->firstRow . "," . $page->listRows)
            ->order(RENOVATION::$id . " desc")
            ->select();
        $this->assign("page", $page->show());
        $this->assign("list", $list);
        $this->display("PcRenovation/BaseRenovation/index");
    }

    public function add()
    {
        $id = TDI("get." . RENOVATION::$id);
        $info = array();
        $where = array();
        if ($id != "") {
            $where[RENOVATION::$id] = array(
                "eq",
                $id
            );
            $where[RENOVATION::$type] = array(
                "eq",
                $this->type
            );
            $where[RENOVATION::$is_del] = array(
                "eq",
                0
            );
            $where[RENOVATION::$platform] = array(
                "eq",
                $this->platform
            );
            $info = MU(RENOVATION::$_table_name)->where($where)->find();
            if (! $info) {
                $this->error("该信息不存在");
                return;
            }
        }

        if (TD_IS_POST) {
            $name = trim(TDI("post." . RENOVATION::$name));
            if ($name == "") {
                // $this->error("模板名称不能为空");
                // return;
                $name = date("Y-m-d H:i:s", time()) . "新建模板";
            }
            $data = array();
            $data[RENOVATION::$type] = $this->type;
            $data[RENOVATION::$doms] = TDI("post." . RENOVATION::$doms);
            $data[RENOVATION::$doms_sort] = TDI("post." . RENOVATION::$doms_sort);
            $data[RENOVATION::$html] = RenovationWidget::buildHtmlCSSTemplate(TD_URL, htmlspecialchars_decode($data[RENOVATION::$doms]), htmlspecialchars_decode($data[RENOVATION::$doms_sort]));
            $data[RENOVATION::$name] = TDI("post." . RENOVATION::$name);
            $data[RENOVATION::$title] = TDI("post." . RENOVATION::$title);
            $data[RENOVATION::$keywords] = TDI("post." . RENOVATION::$keywords);
            $data[RENOVATION::$description] = TDI("post." . RENOVATION::$description);
            $data[RENOVATION::$background_color] = TDI("post." . RENOVATION::$background_color);
            $data[RENOVATION::$bottom_id] = TDI("post." . RENOVATION::$bottom_id);
            $data[RENOVATION::$header_id] = TDI("post." . RENOVATION::$header_id);
            $data[RENOVATION::$platform] = $this->platform;

            /*
             * // 菜品搜索页面
             * if (this.type.equals("Index/Product/index")) {
             * JSONObject productObject = ProductController.getProductListDom(servlet.getServletContext().getRealPath("/"), T.getRootUrl(request), JSONObject.parseObject(T.htmlspecialchars_decode(I("doms"))));
             * data.put(RENOVATION.is_list, 1);
             * data.put(RENOVATION.list_dom, productObject.getString("list_dom"));
             * data.put(RENOVATION.list_html, productObject.getString("list_html"));
             * }
             */

            if ($id != "") { // 说明是修改
                $data[RENOVATION::$last_edit_time] = time();
                if (isset($data[RENOVATION::$is_default])) {
                    unset($data[RENOVATION::$is_default]);
                }
                MU(RENOVATION::$_table_name)->where($where)->save($data);
                $this->success("修改成功");
            } else {
                $data[RENOVATION::$addtime] = time();
                $data[RENOVATION::$last_edit_time] = time();

                // 判断模板数量，如果是第一个则直接设置为默认模板
                $where = array();
                $where[RENOVATION::$website_id] = array(
                    "eq",
                    TDSESSION("website_id")
                );
                $where[RENOVATION::$type] = array(
                    "eq",
                    $this->type
                );
                $where[RENOVATION::$is_default] = array(
                    "eq",
                    1
                );
                $where[RENOVATION::$is_del] = array(
                    "eq",
                    0
                );
                $where[RENOVATION::$platform] = array(
                    "eq",
                    $this->platform
                );
                $count = MU(RENOVATION::$_table_name)->where($where)->count();
                if ($count == 0) {
                    if ($this->need_default) {
                        $data[RENOVATION::$is_default] = 1;
                    } else {
                        $data[RENOVATION::$is_default] = 0;
                    }
                } else {
                    $data[RENOVATION::$is_default] = 0;
                }
                $data[RENOVATION::$website_id] = TDSESSION("website_id");
                MU(RENOVATION::$_table_name)->data($data)->add();
                $this->success("添加成功");
            }
        } else {
            $this->assign("info", $info);
            if ($this->platform == "pc") {
                $this->display("PcRenovation/BaseRenovation/add");
            }
        }
    }

    public function edit()
    {
        $this->add();
    }

    public function setDefault()
    {
        if (TD_IS_POST) {
            $id = TDI("get." . RENOVATION::$id);
            $where = array();
            $where[RENOVATION::$id] = array(
                "eq",
                $id
            );
            $where[RENOVATION::$is_del] = array(
                "eq",
                0
            );
            $where[RENOVATION::$website_id] = array(
                "eq",
                TDSESSION("website_id")
            );
            $info = MU(RENOVATION::$_table_name)->where($where)->find();
            if (! $info) {
                $this->error("不存在该模板");
                return;
            }
            if ((int) $info[RENOVATION::$is_default] == 1) {
                $this->error("该模板已是默认值");
                return;
            } else {
                $data = array();
                $data[RENOVATION::$is_default] = 1;
                MU(RENOVATION::$_table_name)->where($where)->save($data);
                // 其他模板设置为非默认模板
                $where = array();
                $where[RENOVATION::$is_del] = array(
                    "eq",
                    0
                );
                $where[RENOVATION::$type] = array(
                    "eq",
                    $info[RENOVATION::$type]
                );
                $where[RENOVATION::$id] = array(
                    "neq",
                    $id
                );
                $where[RENOVATION::$website_id] = array(
                    "eq",
                    TDSESSION("website_id")
                );
                $data = array();
                $data[RENOVATION::$is_default] = 0;
                MU(RENOVATION::$_table_name)->where($where)->save($data);
                $this->success("设置成功");
                return;
            }
        }
    }

    public function del()
    {
        if (TD_IS_POST) {
            $id = TDI("post." . RENOVATION::$id);
            $where = array();
            $where[RENOVATION::$id] = array(
                "eq",
                $id
            );
            $where[RENOVATION::$type] = array(
                "eq",
                $this->type
            );
            $where[RENOVATION::$platform] = array(
                "eq",
                $this->platform
            );
            $where[RENOVATION::$website_id] = array(
                "eq",
                TDSESSION("website_id")
            );
            $data = array();
            if ($this->need_default) {
                $is_default = MU(RENOVATION::$_table_name)->where($where)->getField(RENOVATION::$is_default);
                if ((int) $is_default == 1) {
                    $this->error("当前模板是默认模板，请先取消该默认模板后再删除");
                    return;
                }
            }
            $data[RENOVATION::$is_del] = 1;
            MU(RENOVATION::$_table_name)->where($where)->save($data);
            $this->success("删除成功");
        }
    }

    public function pageConfig()
    {
        $id = TDI("get." . RENOVATION::$id);
        $info = array();
        if ($id != "") {
            $where = array();
            $where[RENOVATION::$id] = array(
                "eq",
                $id
            );
            $info = MU(RENOVATION::$_table_name)->where($where)->find();
        }
        $this->assign("info", $info);
        // 获取所有的顶部模块
        $header_where = array();
        $header_where[RENOVATION::$is_del] = array(
            "eq",
            0
        );
        $header_where[RENOVATION::$type] = array(
            "eq",
            "header"
        );
        $header_where[RENOVATION::$platform] = array(
            "eq",
            $this->platform
        );
        $header_where[RENOVATION::$website_id] = array(
            "eq",
            TDSESSION("website_id")
        );
        $header_list = MU(RENOVATION::$_table_name)->where($header_where)->select();
        $header_arr = array();
        $header_object = array();
        $header_object["id"] = 0;
        $header_object["name"] = "自定义顶部模块";
        array_push($header_arr, $header_object);
        for ($i = 0; $i < count($header_list); $i = $i + 1) {
            $obj = array();
            $obj["id"] = $header_list[$i][RENOVATION::$id];
            $obj["name"] = $header_list[$i][RENOVATION::$name];
            array_push($header_arr, $obj);
        }
        $this->assign("header_list", $header_arr);
        // 获取所有的底部菜单
        $bottom_where = array();
        $bottom_where[RENOVATION::$is_del] = array(
            "eq",
            0
        );
        $bottom_where[RENOVATION::$type] = array(
            "eq",
            "bottom"
        );
        $bottom_where[RENOVATION::$platform] = array(
            "eq",
            $this->platform
        );
        $bottom_where[RENOVATION::$website_id] = array(
            "eq",
            TDSESSION("website_id")
        );
        $list = MU(RENOVATION::$_table_name)->where($bottom_where)->select();

        $arr = array();
        $object = array();
        $object["id"] = 0;
        $object["name"] = "自定义底部模块";
        array_push($arr, $object);
        for ($i = 0; $i < count($list); $i = $i + 1) {
            $obj = array();
            $obj["id"] = $list[$i][RENOVATION::$id];
            $obj["name"] = $list[$i][RENOVATION::$name];
            array_push($arr, $obj);
        }
        $this->assign("bottom_list", $arr);
        $this->display("PcRenovation/BaseRenovation/pageConfig");
    }
}