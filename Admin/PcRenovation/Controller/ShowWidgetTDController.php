<?php
require_once dirname(dirname(__DIR__)) . '/Index/Controller/CommonTDController.php';

class ShowWidgetTDController extends CommonTDController
{

    public function index()
    {
        $category = TDI("get.category");
        $widget_map = RenovationWidget::getWidgets(TD_URL, $category);
        $map = array();
        foreach ($widget_map as $key => $v) {
            $css = $widget_map->$key->css;
            $html = $widget_map->$key->html;
            $html = "<style>\n" . $css . "\n</style>\n" . htmlspecialchars_decode($html);
            $map[$key] = $html;
        }
        $this->assign("map", $map);
        $this->assign("category", $category);
        $this->display();
    }

    public function create()
    {
        $category = trim(TDI("get.category"));
        $name = trim(TDI("get.name"));
        $sign = trim(TDI("get.sign"));
        $json = trim(TDI("post.json"));
        if ($json != "") {
            $json = htmlspecialchars_decode($json);
        }
        $object = RenovationWidget::getBaseWidget(TD_URL, $category, $name, $sign, $json);
        $html = $object->html;
        $html = htmlspecialchars_decode($html);
        $system_html = $object->system_html;
        if ($category == "home_menu_mobile" || $category == "home_menu_pc") {
            $menu_system_html = Malltodo::getSystemWidget("menu", $sign);
            $system_html = $menu_system_html . $system_html;
        }
        $system_html = "<div class=\"ui-c-box\"><div class=\"ui-c-box-left\" style=\"font-size: 1rem\"><strong>" . $name . "</strong></div><div class=\"ui-c-box-right\"><a class=\"main_del_button\" onclick=\"del_dom('" . $object->dom->sign . "')\">删除</a></div><div class=\"ui-c-clear\"></div></div>" . $system_html;

        // 获取组件额外参数
        $jsonObject = null;

        if ($category == "home_menu_mobile" || $category == "home_menu_pc" || $category == "home_bottom_menu_mobile" || $category == "home_bottom_menu_pc") {
            require_once "./Common/Widget/data/HomeMenu.php";
            $class = new HomeMenu();
            $jsonObject = $class->parameter;
        }

        if ($category == "home_index_brief_pc") {
            require_once "./Common/Widget/data/HomeIndexBrief.php";
            $class = new HomeIndexBrief();
            $jsonObject = $class->parameter;
        }

        if ($category == "home_index_products_pc") {
            require_once "./Common/Widget/data/HomeIndexProducts.php";
            $class = new HomeIndexProducts();
            $jsonObject = $class->parameter;
        }

        if ($category == "home_index_news_pc") {
            require_once "./Common/Widget/data/HomeIndexNews.php";
            $class = new HomeIndexNews();
            $jsonObject = $class->parameter;
        }

        if ($category == "home_index_business_pc") {
            require_once "./Common/Widget/data/HomeIndexBusiness.php";
            $class = new HomeIndexBusiness();
            $jsonObject = $class->parameter;
        }

        if ($category == "home_index_album_pc") {
            require_once "./Common/Widget/data/HomeIndexAlbum.php";
            $class = new HomeIndexAlbum();
            $jsonObject = $class->parameter;
        }

        if ($category == "home_index_job_pc") {
            require_once "./Common/Widget/data/HomeIndexJob.php";
            $class = new HomeIndexJob();
            $jsonObject = $class->parameter;
        }

        if ($category == "home_index_case_pc") {
            require_once "./Common/Widget/data/HomeIndexCase.php";
            $class = new HomeIndexCase();
            $jsonObject = $class->parameter;
        }

        if ($category == "home_index_links_pc") {
            require_once "./Common/Widget/data/HomeIndexLinks.php";
            $class = new HomeIndexLinks();
            $jsonObject = $class->parameter;
        }

        if ($category == "home_index_contactus_pc") {
            require_once "./Common/Widget/data/HomeIndexContactUs.php";
            $class = new HomeIndexContactUs();
            $jsonObject = $class->parameter;
        }

        if ($jsonObject != null) {
            $system_html = $system_html . $this->getModelSystemHtml($jsonObject, $object->dom->sign);
        }
        if ($category == "home_menu_mobile" || $category == "home_menu_pc" || $category == "home_bottom_menu_pc" || $category == "home_bottom_menu_mobile") {
            $html = RenovationWidget::parseTemplateMenuDom($html, $object->dom);
        }
        $css = $object->css;
        $html = "<style>\n" . $css . "\n</style>\n" . $html;
        $object->html = $html;
        $object->system_html = $system_html;
        echo json_encode($object, JSON_UNESCAPED_UNICODE);
        exit();
    }

    private function getModelSystemHtml($param, $sign)
    {
        if (count($param) == 0) {
            return "";
        }
        $system_html = "<div class=\"ui-c-box\" style=\"font-size: 0.9375rem\">\r\n" . " <strong>数据参数</strong>\r\n" . "</div>";
        foreach ($param as $key => $val) {
            $obj = $param[$key];
            $title = $obj["_title"];
            $system_html = $system_html . "<div class=\"ui-c-box\">\r\n" . "	<div class=\"ui-c-box-left\">" . $title . "：</div>\r\n" . "	<div class=\"ui-c-box-right\">";
            $system_html = $system_html . "<select class=\"ui-c-select\" id=\"javatodomodel" . $key . $sign . "\"  onchange=\"change_model_param('" . $sign . "', '" . $key . "')\">";
            foreach ($obj as $k => $v) {
                if ($k === "_title") {
                    continue;
                } else {
                    $system_html = $system_html . "<option value=\"" . $k . "\">" . $obj[$k] . "</option>";
                }
            }
            $system_html = $system_html . "</select>";
            $system_html = $system_html . "</div>\r\n" . "	<div class=\"ui-c-clear\"></div>\r\n" . "</div>";
            $system_html = $system_html . "<script>change_model_param('" . $sign . "', '" . $key . "')</script>";
        }
        return $system_html;
    }
}