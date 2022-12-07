<?php

function static_resources()
{
    $ext = "?t=006";
    $resource = "";
    $resource = "<link rel=\"stylesheet\" type=\"text/css\" href=\"" . TD_URL . "/Public/css/css.css" . $ext . "\"/>\n";
    $resource = $resource . "<script type=\"text/javascript\" src=\"" . TD_URL . "/Public/js/jquery-1.12.4.min.js" . $ext . "\"></script>\n";
    $resource = $resource . "<script type=\"text/javascript\" src=\"" . TD_URL . "/Public/js/jquery.slimscroll.min.js" . $ext . "\"></script>\n";
    $resource = $resource . "<link rel=\"stylesheet\" type=\"text/css\" href=\"" . TD_URL . "/Public/css/pintuer.css" . $ext . "\" />\n";
    $resource = $resource . "<link rel=\"stylesheet\" type=\"text/css\" href=\"" . TD_URL . "/Public/css/animate.min.css" . $ext . "\" />\n";
    $resource = $resource . "<script type=\"text/javascript\" src=\"" . TD_URL . "/Public/js/jquery.cookie.js" . $ext . "\"></script>\n";
    $resource = $resource . "<link rel=\"stylesheet\" type=\"text/css\" href=\"" . TD_URL . "/Public/css/zTreeStyle/zTreeStyle.css" . $ext . "\" />\n";
    $resource = $resource . "<script type=\"text/javascript\" src=\"" . TD_URL . "/Public/js/jquery.ztree.all.min.js" . $ext . "\"></script>\n";
    $resource = $resource . "<script type=\"text/javascript\" src=\"" . TD_URL . "/Public/js/layer.js" . $ext . "\"></script>\n";
    $resource = $resource . "<script type=\"text/javascript\" src=\"" . TD_URL . "/Public/js/http.js" . $ext . "\"></script>\n";
    $resource = $resource . "<script type=\"text/javascript\" src=\"" . TD_URL . "/Public/js/drop.js" . $ext . "\"></script>\n";
    $resource = $resource . "<script type=\"text/javascript\" src=\"" . TD_URL . "/Public/js/js.js" . $ext . "\"></script>\n";
    $resource = $resource . "<script type=\"text/javascript\" src=\"" . TD_URL . "/Public/jedate/jquery.jedate.js" . $ext . "\"></script>\n";
    $resource = $resource . "<link type=\"text/css\" rel=\"stylesheet\" href=\"" . TD_URL . "/Public/jedate/skin/jedate.css" . $ext . "\">\n";
    $resource = $resource . "<link href=\"" . TD_URL . "/Public/ui-c/form/form.css" . $ext . "\" rel=\"stylesheet\" type=\"text/css\" />\n";
    $resource = $resource . "<link href=\"" . TD_URL . "/Public/ui-c/form/select.css" . $ext . "\" rel=\"stylesheet\" type=\"text/css\" />\n";
    $resource = $resource . "<link href=\"" . TD_URL . "/Public/ui-c/form/radio.css" . $ext . "\" rel=\"stylesheet\" type=\"text/css\" />\n";
    $resource = $resource . "<link href=\"" . TD_URL . "/Public/ui-c/form/checkbox.css" . $ext . "\" rel=\"stylesheet\" type=\"text/css\" />\n";
    $resource = $resource . "<link href=\"" . TD_URL . "/Public/ui-c/form/open.css" . $ext . "\" rel=\"stylesheet\" type=\"text/css\" />\n";
    $resource = $resource . "<script src=\"" . TD_URL . "/Public/ui-c/ui-c.js" . $ext . "\"></script>\n";
    $resource = $resource . "<script type=\"text/javascript\" src=\"" . TD_URL . "/Public/ui-c/form/form.js" . $ext . "\"></script>\n";
    $resource = $resource . "<script type=\"text/javascript\" src=\"" . TD_URL . "/Public/ui-c/form/select.js" . $ext . "\"></script>\n";
    $resource = $resource . "<script type=\"text/javascript\" src=\"" . TD_URL . "/Public/ui-c/form/radio.js" . $ext . "\"></script>\n";
    $resource = $resource . "<script type=\"text/javascript\" src=\"" . TD_URL . "/Public/ui-c/form/checkbox.js" . $ext . "\"></script>\n";
    $resource = $resource . "<script type=\"text/javascript\" src=\"" . TD_URL . "/Public/ui-c/form/open.js" . $ext . "\"></script>\n";
    $resource = $resource . "<script type=\"text/javascript\" src=\"" . TD_URL . "/Public/js/jquery-ui.min.js" . $ext . "\"></script>\n";
    $resource = $resource . "<link rel=\"stylesheet\" type=\"text/css\" href=\"" . TD_URL . "/Public/css/jquery-ui.css" . $ext . "\" />\n";
    $resource = $resource . "<script type=\"text/javascript\" src=\"" . TD_URL . "/Public/editor/ueditor.config.js" . $ext . "\"></script>\n";
    $resource = $resource . "<script type=\"text/javascript\" src=\"" . TD_URL . "/Public/editor/ueditor.all.js" . $ext . "\"></script>\n";
    $resource = $resource . "<script type=\"text/javascript\" src=\"" . TD_URL . "/Public/js/vue.min.js" . $ext . "\"></script>\n";
    $resource = $resource . "<script>\n";
    $resource = $resource . "function getObjectURL(file) {\n";
    $resource = $resource . "var url = null;\n";
    $resource = $resource . "if (window.createObjectURL != undefined) { // basic\n";
    $resource = $resource . "url = window.createObjectURL(file);\n";
    $resource = $resource . "} else if (window.URL != undefined) { // mozilla(firefox)\n";
    $resource = $resource . "url = window.URL.createObjectURL(file);\n";
    $resource = $resource . "} else if (window.webkitURL != undefined) { // webkit or chrome\n";
    $resource = $resource . "url = window.webkitURL.createObjectURL(file);\n";
    $resource = $resource . "}\n";
    $resource = $resource . "return url;\n";
    $resource = $resource . "}\n";
    $resource = $resource . "</script>\n";
    echo $resource;
}

function check_mobile_format($mobile)
{
    return strlen($mobile) == 11 && preg_match("/^((13[0-9]|15[0-9]|16[0-9]|17[0-9]|18[0-9]|19[0-9])+\\d{8})$/", $mobile);
}

function check_email_format($email)
{
    return strlen($email) > 6 && preg_match("/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/", $email);
}

function trim_array($arr)
{
    if (count($arr) == 0) {
        return $arr;
    } else {
        $data = array();
        foreach ($arr as $k => $v) {
            $data[$k] = trim($v);
        }
        return $data;
    }
}

function deldir($path)
{
    $dh = opendir($path);
    while ($file = readdir($dh)) {
        if ($file != "." && $file != ".." && $file != "index.html") {
            $fullpath = $path . "/" . $file;
            if (! is_dir($fullpath)) {
                unlink($fullpath);
            } else {
                deldir($fullpath);
            }
        }
    }
}

function is_mobile()
{
    $user_merchant = $_SERVER['HTTP_USER_AGENT'];
    $mobile_merchants = array(
        "240x320",
        "acer",
        "acoon",
        "acs-",
        "abacho",
        "ahong",
        "airness",
        "alcatel",
        "amoi",
        "android",
        "anywhereyougo.com",
        "applewebkit/525",
        "applewebkit/532",
        "asus",
        "audio",
        "au-mic",
        "avantogo",
        "becker",
        "benq",
        "bilbo",
        "bird",
        "blackberry",
        "blazer",
        "bleu",
        "cdm-",
        "compal",
        "coolpad",
        "danger",
        "dbtel",
        "dopod",
        "elaine",
        "eric",
        "etouch",
        "fly ",
        "fly_",
        "fly-",
        "go.web",
        "goodaccess",
        "gradiente",
        "grundig",
        "haier",
        "hedy",
        "hitachi",
        "htc",
        "huawei",
        "hutchison",
        "inno",
        "ipad",
        "ipaq",
        "iphone",
        "ipod",
        "jbrowser",
        "kddi",
        "kgt",
        "kwc",
        "lenovo",
        "lg ",
        "lg2",
        "lg3",
        "lg4",
        "lg5",
        "lg7",
        "lg8",
        "lg9",
        "lg-",
        "lge-",
        "lge9",
        "longcos",
        "maemo",
        "mercator",
        "meridian",
        "micromax",
        "midp",
        "mini",
        "mitsu",
        "mmm",
        "mmp",
        "mobi",
        "mot-",
        "moto",
        "nec-",
        "netfront",
        "newgen",
        "nexian",
        "nf-browser",
        "nintendo",
        "nitro",
        "nokia",
        "nook",
        "novarra",
        "obigo",
        "palm",
        "panasonic",
        "pantech",
        "philips",
        "phone",
        "pg-",
        "playstation",
        "pocket",
        "pt-",
        "qc-",
        "qtek",
        "rover",
        "sagem",
        "sama",
        "samu",
        "sanyo",
        "samsung",
        "sch-",
        "scooter",
        "sec-",
        "sendo",
        "sgh-",
        "sharp",
        "siemens",
        "sie-",
        "softbank",
        "sony",
        "spice",
        "sprint",
        "spv",
        "symbian",
        "tablet",
        "talkabout",
        "tcl-",
        "teleca",
        "telit",
        "tianyu",
        "tim-",
        "toshiba",
        "tsm",
        "up.browser",
        "utec",
        "utstar",
        "verykool",
        "virgin",
        "vk-",
        "voda",
        "voxtel",
        "vx",
        "wap",
        "wellco",
        "wig browser",
        "wii",
        "windows ce",
        "wireless",
        "xda",
        "xde",
        "zte"
    );
    $is_mobile = false;
    foreach ($mobile_merchants as $device) {
        if (stristr($user_merchant, $device)) {
            $is_mobile = true;
            break;
        }
    }
    return $is_mobile;
}

// 判断是否是微信浏览器
function is_weixin()
{
    if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false) {
        return true;
    }
    return false;
}

// 判断是否是微信小程序
function is_weixin_miniprogram()
{
    if (strpos($_SERVER['HTTP_USER_AGENT'], 'miniProgram') !== false) {
        return true;
    }
    return false;
}

// 生成目录
function create_dir($src)
{
    $arr = explode("/", trim($src));
    $dis = "";
    for ($i = 0; $i < count($arr); $i = $i + 1) {
        if ($arr[$i] == '.' || $arr[$i] == '..' || $arr[$i] == "") {
            continue;
        }
        if ($dis == '') {
            $dis = $arr[$i];
        } else {
            $dis = $dis . "/" . $arr[$i];
        }
        if (! is_dir($dis)) {
            mkdir($dis);
        }
    }
}

function http_post($url, $data, $ssl = null)
{
    $curl = curl_init(); // 启动一个CURL会话
    curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // 对认证证书来源的检查
                                                   // curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 1); // 从证书中检查SSL加密算法是否存在
    curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览器
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转
    curl_setopt($curl, CURLOPT_AUTOREFERER, 1); // 自动设置Referer
    curl_setopt($curl, CURLOPT_POST, 1); // 发送一个常规的Post请求
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data); // Post提交的数据包
    curl_setopt($curl, CURLOPT_TIMEOUT, 30); // 设置超时限制防止死循环
    curl_setopt($curl, CURLOPT_HEADER, 0); // 显示返回的Header区域内容
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回

    if ($ssl != null) {
        $sslCertPath = $ssl["ssl_cert_path"];
        $sslKeyPath = $ssl["ssl_key_path"];
        curl_setopt($curl, CURLOPT_SSLCERTTYPE, 'PEM');
        curl_setopt($curl, CURLOPT_SSLCERT, $sslCertPath);
        curl_setopt($curl, CURLOPT_SSLKEYTYPE, 'PEM');
        curl_setopt($curl, CURLOPT_SSLKEY, $sslKeyPath);
    }

    $tmpInfo = curl_exec($curl); // 执行操作
    if (curl_errno($curl)) {
        echo 'Errno' . curl_error($curl); // 捕抓异常
    }
    curl_close($curl); // 关闭CURL会话
    return $tmpInfo; // 返回数据
}

// curl get数据
function http_get($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览器
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转
    curl_setopt($ch, CURLOPT_AUTOREFERER, 1); // 自动设置Referer
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    $neirong = curl_exec($ch);
    if (curl_errno($ch)) {
        // echo 'Errno' . curl_error($ch); // 捕抓异常
        curl_close($ch);
        return "";
    }
    curl_close($ch);
    return $neirong;
}

// 导出csv文件
function export_csv($filename, $arr)
{
    $str = '';
    foreach ($arr as $k => $v) {
        foreach ($v as $kk => $vv) {
            $arr[$k][$kk] = iconv('utf-8', 'gb2312', $arr[$k][$kk]);
            $arr[$k][$kk] = "\t" . $arr[$k][$kk];
        }
        $str = $str . implode(',', $arr[$k]) . PHP_EOL;
    }
    header("Content-Type: application/vnd.ms-excel; charset=GB2312");
    header("Content-Disposition: attachment;filename=" . $filename);
    header('Cache-Control:must-revalidate,post-check=0,pre-check=0');
    header('Expires:0');
    header('Pragma:public');
    die($str);
}

function create_password($password)
{
    return md5("malltodo" . md5("javatodo" . $password));
}

// 获取当前站点
function get_home_website_id()
{
    if (TDSESSION("website_id")) {
        return TDSESSION("website_id");
    }
    $domain = $_SERVER['HTTP_HOST'];
    $where = array();
    $where[WEBSITE::$website_host] = array(
        "eq",
        $domain
    );
    $where[WEBSITE::$is_del] = array(
        "eq",
        0
    );
    $website_info = MU(WEBSITE::$_table_name)->where($where)->find();
    if (! $website_info) {
        $where = array();
        $where[WEBSITE::$is_del] = array(
            "eq",
            0
        );
        $website_info = MU(WEBSITE::$_table_name)->where($where)
            ->order(WEBSITE::$id . " asc")
            ->find();
        if ($website_info) {
            TDSESSION("website_id", $website_info[WEBSITE::$id]);
        } else {
            $data = array();
            $data[WEBSITE::$website_host] = "/";
            $data[WEBSITE::$website_name] = "默认站点";
            $data[WEBSITE::$addtime] = time();
            $id = MU(WEBSITE::$_table_name)->data($data)->add();
            TDSESSION("website_id", $id);
        }
    } else {
        TDSESSION("website_id", $website_info[WEBSITE::$id]);
    }
    return TDSESSION("website_id");
}
?>