<?php

class RenovationWidget
{

    public static function getWidgets($domain, $category)
    {
        return Malltodo::getWidgets($domain, $category);
    }

    public static function getWidget($rootUrl, $widget_category, $widget_name, $widget_sign, $widget_json)
    {
        return self::getBaseWidget($rootUrl, $widget_category, $widget_name, $widget_sign, $widget_json);
    }

    public static function getBaseWidget($domain, $widget_category, $widget_name, $shijian, $jsonString)
    {
        return Malltodo::getBaseWidget($domain, $widget_category, $widget_name, $shijian, $jsonString);
    }

    public static function buildHtmlCSSTemplate($domain, $domsJSONString, $domsSortString)
    {
        return Malltodo::buildHtmlCSSTemplate($domain, $domsJSONString, $domsSortString);
    }

    public static function buildPage($id, $seo_title = "", $seo_keywords = "", $seo_description = "")
    {
        $where = array();
        $where[RENOVATION::$id] = array(
            "eq",
            $id
        );
        $where[RENOVATION::$is_del] = array(
            "eq",
            0
        );
        $map = MU(RENOVATION::$_table_name)->where($where)->find();
        if (! $map) {
            return "";
        }
        $body_html = self::buildHtmlCSS($id, 0);
        $header_html = self::buildHtmlCSS($map[RENOVATION::$header_id], 0);
        $bottom_html = self::buildHtmlCSS($map[RENOVATION::$bottom_id], 0);
        $title = $seo_title;
        $keywords = $seo_keywords;
        $description = $seo_description;
        if (trim($seo_title) == "" && trim($seo_keywords) == "" && trim($seo_description) == "") {
            $title = $map[RENOVATION::$title];
            $keywords = $map[RENOVATION::$keywords];
            $description = $map[RENOVATION::$description];
        }
        $body_color = $map[RENOVATION::$background_color];
        $body_image = $map[RENOVATION::$background_image];
        $body_repeat = $map[RENOVATION::$background_repeat];

        // 初始化body样式
        if ($body_image != "") {
            $background_image = "";
            $background_image = "background-image:" . htmlspecialchars_decode($body_image) . ";";
            if ($body_repeat == "repeat") {
                $background_image = "background-repeat:repeat; background-size:auto; " . $background_image;
            } else {
                $background_image = "background:center center no-repeat; background-size:cover; background-repeat:no-repeat; " . $background_image;
            }

            $body_color = "		<style>\r\n" . "			body {\r\n" . $background_image . "				margin: 0rem;\r\n" . "				padding: 0rem;\r\n" . "			}\r\n" . "		</style>\r\n";
        } else {
            $body_color = "		<style>\r\n" . "			body {\r\n" . "				background: " . $body_color . ";\r\n" . "				margin: 0rem;\r\n" . "				padding: 0rem;\r\n" . "			}\r\n" . "		</style>\r\n";
        }

        // 组装页面
        $string = "<!DOCTYPE html>\r\n" . "<html>\r\n" . "	<head>\r\n" . "		<meta charset=\"utf-8\">\r\n" . "		<meta name=\"viewport\" content=\"width=device-width, initial-scale=1, user-scalable=0\">\r\n" . "		<title>" . $title . "</title>\r\n" . "		<meta name=\"keywords\" content=\"" . $keywords . "\">\r\n" . "		<meta name=\"description\" content=\"" . $description . "\">\r\n" . "		<script src=\"" . TD_URL . "/Public/js/jquery-1.12.4.min.js\"></script>\r\n" . "		<script src=\"" . TD_URL . "/Public/js/layer.js\"></script>\r\n" . "		<script src=\"" . TD_URL . "/Public/js/http.js\"></script>\r\n" . "		<script src=\"" . TD_URL . "/Public/js/js.js\"></script>\r\n" . "		<script src=\"" . TD_URL . "/Public/js/drop.js\"></script>\r\n" . "		<link href=\"" . TD_URL . "/Public/css/swiper.min.css\" rel=\"stylesheet\" />\r\n" . "		<script src=\"" . TD_URL . "/Public/js/swiper.min.js\"></script>\r\n" . "		<script src=\"" . TD_URL . "/Public/js/vue.min.js\"></script>\r\n		<script charset=\"utf-8\" src=\"https://map.qq.com/api/gljs?v=1.exp&libraries=service&key=JYZBZ-7B2AX-GY24G-7GSPN-I2R36-KOFRO\"></script>\r\n  " . $body_color . "	</head>\r\n" . "	<body>\r\n";

        $string = $string . "<style>\r\n";
        $string = $string . "#malltodo_mask{ position: fixed; top: 0rem; left: 0rem; background: center center no-repeat #FFFFFF url(" . TD_URL . "/Public/images/loading.gif); background-size: auto; z-index: 100000;} \r\n";
        $string = $string . "</style>\r\n";
        $string = $string . "<link rel=\"stylesheet\" type=\"text/css\" href=\"" . TD_URL . "/Public/css/index.css\" />\r\n";
        $string = $string . "<link rel=\"stylesheet\" type=\"text/css\" href=\"" . TD_URL . "/Public/css/pintuer.css\" />\r\n";
        $string = $string . "<link rel=\"stylesheet\" type=\"text/css\" href=\"" . TD_URL . "/Public/css/animate.min.css\" />\r\n";
        $string = $string . "<script>\r\n";
        $string = $string . "var malltodo_windows_width = parseInt($(window).width());\r\n";
        if (is_mobile()) {
            $string = $string . "$('html').css({'font-size': (malltodo_windows_width / 304)*16 + 'px'});\r\n";
        }
        $string = $string . "</script>\r\n";
        $string = $string . "<div id=\"malltodo_mask\"></div>\r\n";
        $string = $string . "<script>\r\n";
        $string = $string . "$(\"#malltodo_mask\").width($(window).width());$(\"#malltodo_mask\").height($(window).height());\r\n";
        $string = $string . "$(function(){\$(\"#malltodo_mask\").fadeOut(500, function(){\$(\"#malltodo_mask\").hide();})})\r\n";
        $string = $string . "var malltodo_soft = 'index';\r\n";
        $string = $string . "</script>\r\n";
        $string = $string . $header_html . $body_html . $bottom_html;

        // 统计代码
        $code = "\r\n<div style='display:none'>\r\n";
        $websiteId = TDSESSION("website_id");
        $website_where = array();
        $website_where[WEBSITE::$id] = array(
            "eq",
            $websiteId
        );
        $websiteInfo = MU(WEBSITE::$_table_name)->where($website_where)->find();
        if ($websiteInfo) {
            $code = $code . htmlspecialchars_decode($websiteInfo[WEBSITE::$statistics_code]);
        }
        $code = $code . "\r\n</div>\r\n";
        $string = $string . $code;
        $string = $string . "</body>\r\n" . "</html>";
        $string = str_replace("javatodo-navigation", "a", $string);
        return $string;
    }

    public static function buildList($id)
    {
        $where = array();
        $where[RENOVATION::$id] = array(
            "eq",
            $id
        );
        $where[RENOVATION::$is_del] = array(
            "eq",
            0
        );
        $map = MU(RENOVATION::$_table_name)->where($where)->find();
        if (! $map) {
            return "";
        }
        $body_html = self::buildHtmlCSS($id, 1);
        return $body_html;
    }

    private static function buildHtmlCSS($id, $type)
    {
        $where = array();
        $where[RENOVATION::$id] = array(
            "eq",
            $id
        );
        $where[RENOVATION::$is_del] = array(
            "eq",
            0
        );
        $map = MU(RENOVATION::$_table_name)->where($where)->find();
        if (! $map) {
            return "";
        }
        $html = "";
        $doms_string = "";
        $doms = new stdClass();
        if ($type == 0) {
            $html = $map["html"];
            $html = htmlspecialchars_decode($html);
            $doms_string = $map["doms"];
            $doms_string = htmlspecialchars_decode($doms_string);
            $doms = json_decode($doms_string);
        }
        if ($type == 1) {
            $html = $map["list_html"];
            $html = htmlspecialchars_decode($html);
            $doms_string = $map["list_dom"];
            $doms = json_decode($doms_string);
        }

        $bindDataMap = new stdClass();
        $doms_sort = array();
        foreach ($doms as $key => $v) {
            if ($key == "category") {
                continue;
            }
            if ($key == "name") {
                continue;
            }
            if ($key == "sign") {
                continue;
            }
            if ($key == "javatodo-bind-loop") {
                continue;
            }
            if ($key == "javatodo-bind-param") {
                continue;
            }
            $dom = $doms->$key;
            $category = $dom->category;
            if ($category == "base") {
                continue;
            }
            array_push($doms_sort, $key);
            $bind_loop_list = self::getBindLoopList($dom);
            require_once __DIR__ . "/BindData.php";
            $bindData = BindData::bind($dom, $bind_loop_list);
            $bindDataMap->$key = $bindData;
        }
        return self::buildOneWidgetHtmlCSS($html, $doms, $doms_sort, $bindDataMap, $type);
    }

    private static function buildOneWidgetHtmlCSS($html, $doms, $doms_sort, $bindDataMap, $type)
    {
        return Malltodo::buildOneWidgetHtmlCSS($html, json_encode($doms, JSON_UNESCAPED_UNICODE), json_encode($doms_sort, JSON_UNESCAPED_UNICODE), json_encode($bindDataMap, JSON_UNESCAPED_UNICODE), $type . "");
    }

    public static function parseTemplateMenuDom($html, $dom)
    {
        $bind_loop_list = self::getBindLoopList($dom);
        require_once __DIR__ . "/BindData.php";
        $bindData = BindData::bind($dom, $bind_loop_list);
        $category = $dom->category;
        if ($category == "base") {
            return "";
        }
        $html = Malltodo::parseTemplateMenuDom($html, json_encode($dom, JSON_UNESCAPED_UNICODE), json_encode($bindData, JSON_UNESCAPED_UNICODE));
        return $html;
    }

    private static function getBindLoopList($dom)
    {
        return Malltodo::getBindLoopList($dom);
    }

    public static function noTemplateNotice($string = "")
    {
        if ($string == "") {
            $string = "尚未配置默认模版";
        }
        return "<!DOCTYPE html>\r\n" . "<html>\r\n" . "	<head>\r\n" . "		<meta charset=\"utf-8\">\r\n" . "		<meta name=\"viewport\" content=\"width=device-width, initial-scale=1, user-scalable=0\">\r\n" . "		<title>" . $string . "</title>\r\n" . "	</head>\r\n" . "	<body>\r\n" . "		<div style=\"text-align: center; padding-top: 200px;\">\r\n" . "			" . $string . "\r\n" . "		</div>\r\n" . "	</body>\r\n" . "</html>";
    }
}