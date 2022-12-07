<?php

class Malltodo
{

    private static $serviceHost = "http://api.malltodo.com/";

    // private static $serviceHost = "http://127.0.0.1:9500/";
    private static function urlencodeParam($param)
    {
        foreach ($param as $k => $v) {
            $param[$k] = urlencode($v);
        }
        return $param;
    }

    private static function getServiceUrl($serviceName, $getParam = array())
    {
        $getParam = self::urlencodeParam($getParam);
        $url = self::$serviceHost . $serviceName;
        $paramString = "";
        foreach ($getParam as $k => $v) {
            if ($paramString == "") {
                $paramString = $paramString . "?" . $k . "=" . $v;
            } else {
                $paramString = $paramString . "&" . $k . "=" . $v;
            }
        }
        return $url . $paramString;
    }

    private static function postToService($serviceUrl, $postData = array())
    {
        // $postData = self::urlencodeParam($postData);
        foreach ($postData as $k => $v) {
            $postData[$k] = $v;
        }
        $ret_content = http_post($serviceUrl, $postData);
        return str_replace(".jsp", ".php", $ret_content);
    }

    public static function get_unique_id()
    {
        $url = self::$serviceHost . "getUniqueID";
        $content = http_get($url);
        $arr = json_decode($content);
        if ($arr->status == 1) {
            return $arr->uniqueID;
        } else {
            $ret_arr = array();
            $ret_arr["status"] = 0;
            $ret_arr["info"] = "获取唯一ID失败";
            exit(json_encode($ret_arr));
        }
    }

    public static function getWidgets($domain, $category)
    {
        $retMap = array();
        $getParam = array();
        $getParam["domain"] = $domain;
        $getParam["widgetCategory"] = $category;
        $jsonHtmlString = http_get(self::getServiceUrl("getWidgets", $getParam));
        if ($jsonHtmlString != "") {
            $retMap = json_decode($jsonHtmlString);
        }
        return $retMap;
    }

    public static function getBaseWidget($domain, $widget_category, $widget_name, $shijian, $jsonString)
    {
        $getParam = array();
        $getParam["domain"] = $domain;
        $getParam["widgetCategory"] = $widget_category;
        $getParam["widgetName"] = $widget_name;
        if ($shijian != "") {
            $getParam["timeId"] = $shijian;
        }
        $postData = array();
        // $jsonString = str_replace("[]", "{}", $jsonString);
        $postData["jsonString"] = $jsonString;
        $postData = self::urlencodeParam($postData);
        $jsonHtmlString = self::postToService(self::getServiceUrl("getBaseWidget", $getParam), $postData);
        if ($jsonHtmlString != "") {
            $retObject = json_decode($jsonHtmlString);
            $_domObject = $retObject->dom;
            $dom_object = new stdClass();
            $object_index_key = "object-index";
            $dom_object_index = $_domObject->$object_index_key;
            for ($i = 0; $i < count($dom_object_index); $i = $i + 1) {
                $_key = $dom_object_index[$i];
                $dom_object->$_key = $_domObject->$_key;
            }
            $_key = "javatodo-bind-loop-index";
            $_javatodo_bind_loop_index = $_domObject->$_key;
            $_key = "javatodo-bind-loop";
            $_javatodo_bind_loop = $_domObject->$_key;
            $javatodo_bind_loop = new stdClass();
            for ($i = 0; $i < count($_javatodo_bind_loop_index); $i = $i + 1) {
                $_key = $_javatodo_bind_loop_index[$i];
                $javatodo_bind_loop->$_key = $_javatodo_bind_loop->$_key;
            }
            $_key = "javatodo-bind-loop";
            $dom_object->$_key = $javatodo_bind_loop;
            $retObject->dom = $dom_object;
            return $retObject;
        } else {
            return array();
        }
    }

    public static function getBindLoopList($domJSONObject)
    {
        $list = array();
        $getParam = array();
        $postData = array();
        $domJSONObjectString = json_encode($domJSONObject, JSON_UNESCAPED_UNICODE);
        $postData["domJSONObjectString"] = $domJSONObjectString;
        // var_dump($domJSONObject);
        // exit();
        $postData = self::urlencodeParam($postData);
        $jsonHtmlString = self::postToService(self::getServiceUrl("getBindLoopList", $getParam), $postData);
        if ($jsonHtmlString != "") {
            $array = json_decode($jsonHtmlString);
            for ($i = 0; $i < count($array); $i = $i + 1) {
                array_push($list, $array[$i]);
            }
        }
        return $list;
    }

    public static function getSystemWidget($widget_name, $widget_id)
    {
        $getParam = array();
        $getParam["widget_name"] = $widget_name;
        $getParam["widget_id"] = $widget_id;
        $ret_content = http_get(self::getServiceUrl("getSystemWidget", $getParam));
        return str_replace(".jsp", ".php", $ret_content);
    }

    public static function buildOneWidgetHtmlCSS($htmlString, $domJSONString, $domsSort, $bindDataMapString, $typeString)
    {
        $getParam = array();
        $postData = array();

        // $domJSONString = str_replace("[]", "{}", $domJSONString);
        $postData["domJSONString"] = $domJSONString;
        $postData["domsSort"] = $domsSort;
        // $bindDataMapString = str_replace("[]", "{}", $bindDataMapString);
        $postData["bindDataMapString"] = $bindDataMapString;
        $postData["typeString"] = $typeString;
        $postData = self::urlencodeParam($postData);
        $postData["htmlString"] = $htmlString;
        return self::postToService(self::getServiceUrl("buildOneWidgetHtmlCSS", $getParam), $postData);
    }

    public static function parseTemplateMenuDom($htmlString, $domJSONString, $bindDataJSONString)
    {
        $getParam = array();
        $postData = array();
        $postData["domJSONString"] = $domJSONString;
        $postData["bindDataJSONString"] = $bindDataJSONString;
        $postData = self::urlencodeParam($postData);
        $postData["htmlString"] = $htmlString;
        return self::postToService(self::getServiceUrl("parseTemplateMenuDom", $getParam), $postData);
    }

    public static function buildHtmlCSSTemplate($domain, $domsJSONString, $domsSortString)
    {
        $getParam = array();
        $postData = array();
        $postData["domain"] = $domain;
        $postData["domsJSONString"] = $domsJSONString;
        $postData["domsSortString"] = $domsSortString;
        return self::postToService(self::getServiceUrl("buildHtmlCSSTemplate", $getParam), $postData);
    }
}