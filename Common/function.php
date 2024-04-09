<?php

function static_resources()
{
    $ext = "?t=007";
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

// 复制文件夹（包含文件夹里面的文件以及子文件夹）
function copy_dir($src, $dst)
{
    if (empty($src) || empty($dst)) {
        return false;
    }
    $dir = opendir($src);
    dir_mkdir($dst);
    while (false !== ($file = readdir($dir))) {
        if (($file != '.') && ($file != '..') && ($file != '.git') && ($file != '.settings')) {
            $srcRecursiveDir = $src . DIRECTORY_SEPARATOR . $file;
            $dstRecursiveDir = $dst . DIRECTORY_SEPARATOR . $file;
            if (is_dir($srcRecursiveDir)) {
                copy_dir($srcRecursiveDir, $dstRecursiveDir);
            } else {
                copy($srcRecursiveDir, $dstRecursiveDir);
            }
        }
    }
    closedir($dir);
    return true;
}

/**
 * 创建文件夹
 *
 * @param string $path
 *            文件夹路径
 * @param int $mode
 *            访问权限
 * @param bool $recursive
 *            是否递归创建
 * @return bool
 */
function dir_mkdir($path = '', $mode = 0755, $recursive = true)
{
    clearstatcache();

    if (! is_dir($path)) {
        mkdir($path, $mode, $recursive);
        return chmod($path, $mode);
    }

    return true;
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
    if(is_dir($src)){
        return TRUE;
    }
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
        if($src[0] == '/' && $dis[0] != '/'){
            $dis = '/'.$dis;
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
        //echo 'Errno' . curl_error($curl); // 捕抓异常
        $arr = array("status"=>0, "info"=>"error", "url"=>"");
        echo json_encode($arr, JSON_UNESCAPED_UNICODE);
        exit();
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
        $arr = array("status"=>0, "info"=>"error", "url"=>"");
        echo json_encode($arr, JSON_UNESCAPED_UNICODE);
        exit();
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
    return TDCREATEPASSWORD($password);
}

// 获取当前站点
function get_home_website_id()
{
    if(strpos($_SERVER["PHP_SELF"], "index.php") === FALSE){
        if (TDSESSION("website_id")) {
            return TDSESSION("website_id");
        }
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

function get_all_website()
{
    if (! TDS("website_cache")) {
        $where = array();
        $where[WEBSITE::$is_del] = array(
            "eq",
            0
        );
        $list = MU(WEBSITE::$_table_name)->where($where)
            ->order(WEBSITE::$id . " desc")
            ->select();
        $map = array();
        for ($i = 0; $i < count($list); $i = $i + 1) {
            $map[$list[$i][WEBSITE::$id]] = $list[$i][WEBSITE::$website_name];
        }
        TDS("website_cache", $map);
    }
    return TDS("website_cache");
}

function DocU($uri, $param = array())
{
    $param[TDConfig::$todo_pre . "m"] = "Index";
    $param[TDConfig::$todo_pre . "c"] = "Index";
    $param[TDConfig::$todo_pre . "a"] = "index";
    
    if (is_string($uri) && trim($uri) != "") {
        $uri_arr = explode("/", $uri);
        if (count($uri_arr) == 3) {
            $param["module"] = trim($uri_arr[0]);
            $param["controller"] = trim($uri_arr[1]);
            $param["action"] = trim($uri_arr[2]);
        }
    }
    $url = "http://www.malltodo.com/doc.php";
    $paramar = "";
    foreach ($param as $key => $val) {
        if ($paramar == "") {
            $paramar = "?" . $key . "=" . $val;
        } else {
            $paramar = $paramar . "&" . $key . "=" . $val;
        }
    }
    $url = $url . $paramar;
    return $url;
}

function checkIsInstall()
{
    if (file_exists(TDConfig::$todo_runtime_path . "lock")) {
        return true;
    } else {
        if (TD_URL == "http://127.0.0.1/malltodo-php-dev" || file_exists(dirname(__DIR__) . "/SQLiteDB/SQLiteConfig.php")) {
            return true;
        } else {
            return false;
        }
    }
}

function create_database_sql()
{
    if(TDConfig::$db_type == "mysql"){
        $sql = "SELECT table_name from information_schema.`TABLES` where TABLE_SCHEMA = '" . TDConfig::$db_name . "';";
        $list = MU()->query($sql);
        for ($i = 0; $i < count($list); $i = $i + 1) {
            $table_name = $list[$i]["table_name"];
            $table_name = str_replace(TDConfig::$table_pre, "", $table_name);
            $file_data_before = "<?php" . PHP_EOL . "$" . "table_columns = array(" . PHP_EOL;
            $file_data = "";
            $file_data_after = ");";
            
            $file_column_before = "<?php" . PHP_EOL . "class ". strtoupper($table_name) ."{" . PHP_EOL;
            $file_column = '    public static $_table_name = "' . $table_name . '";'.PHP_EOL;
            $file_column_after = "};";
            
            $sql = "SELECT * FROM information_schema.columns where table_schema = '" . TDConfig::$db_name . "' and table_name = '" . TDConfig::$table_pre . $table_name . "'";
            $column_list = MU()->query($sql);
            $column_data_types = array();
            for ($n = 0; $n < count($column_list); $n = $n + 1) {
                $data_type = $column_list[$n]["DATA_TYPE"];
                if (strpos($data_type, "int") === false && strpos($data_type, "decimal") === false && strpos($data_type, "float") === false && strpos($data_type, "double") === false) { // 说明是字符串类型
                    if ($column_list[$n]["COLUMN_DEFAULT"] == null) {
                        $file_data = $file_data . "    " . '"' . $column_list[$n]["COLUMN_NAME"] . '" => array("' . $data_type . '", "")';
                    } else {
                        $file_data = $file_data . "    " . '"' . $column_list[$n]["COLUMN_NAME"] . '" => array("' . $data_type . '", "' . $column_list[$n]["COLUMN_DEFAULT"] . '")';
                    }
                } else {
                    if ($column_list[$n]["COLUMN_DEFAULT"] == null) {
                        $file_data = $file_data . "    " . '"' . $column_list[$n]["COLUMN_NAME"] . '" => array("' . $data_type . '", 0)';
                    } else {
                        $file_data = $file_data . "    " . '"' . $column_list[$n]["COLUMN_NAME"] . '" => array("' . $data_type . '", ' . $column_list[$n]["COLUMN_DEFAULT"] . ')';
                    }
                }
                $file_column = $file_column . '	public static $'.$column_list[$n]["COLUMN_NAME"].' = "'.$column_list[$n]["COLUMN_NAME"].'";';
                $column_data_types[$column_list[$n]["COLUMN_NAME"]] = $data_type;
                if ($n < count($column_list) - 1) {
                    $file_data = $file_data . "," . PHP_EOL;
                } else {
                    $file_data = $file_data . PHP_EOL;
                }
                $file_column = $file_column . PHP_EOL;
            }
            $file_data = $file_data_before . $file_data . $file_data_after;
            $file_column = $file_column_before . $file_column . $file_column_after;
            file_put_contents(__DIR__ ."/database/" . $table_name . ".data.php", $file_data);
            file_put_contents(__DIR__ ."/database/" . $table_name . ".columns.php", $file_column);
        }
    }else if(TDConfig::$db_type == "sqlite"){
        $sql = "SELECT * FROM sqlite_master WHERE type = 'table'";
        $list = MU()->query($sql);
        for($i=0; $i<count($list); $i=$i+1){
            $table_name = $list[$i]["name"];
            $table_name = str_replace(TDConfig::$table_pre, "", $table_name);
            $file_data_before = "<?php" . PHP_EOL . "$" . "table_columns = array(" . PHP_EOL;
            $file_data = "";
            $file_data_after = ");";
            
            $file_column_before = "<?php" . PHP_EOL . "class ". strtoupper($table_name) ."{" . PHP_EOL;
            $file_column = '    public static $_table_name = "' . $table_name . '";'.PHP_EOL;
            $file_column_after = "};";
            
            $sql = "PRAGMA table_info('" . TDConfig::$table_pre . $table_name . "')";
            $column_list = MU()->query($sql);
            $column_data_types = array();
            for ($n = 0; $n < count($column_list); $n = $n + 1) {
                $data_type = $column_list[$n]["type"];
                if (strpos($data_type, "int") === false && strpos($data_type, "decimal") === false && strpos($data_type, "float") === false && strpos($data_type, "double") === false) { // 说明是字符串类型
                    if ($column_list[$n]["dflt_value"] == null) {
                        $file_data = $file_data . "    " . '"' . $column_list[$n]["name"] . '" => array("' . $data_type . '", "")';
                    } else {
                        $file_data = $file_data . "    " . '"' . $column_list[$n]["name"] . '" => array("' . $data_type . '", "' . str_replace("'", "", $column_list[$n]["dflt_value"]) . '")';
                    }
                } else {
                    if ($column_list[$n]["dflt_value"] == null) {
                        $file_data = $file_data . "    " . '"' . $column_list[$n]["name"] . '" => array("' . $data_type . '", 0)';
                    } else {
                        $file_data = $file_data . "    " . '"' . $column_list[$n]["name"] . '" => array("' . $data_type . '", ' . str_replace("'", "", $column_list[$n]["dflt_value"]) . ')';
                    }
                }
                $file_column = $file_column . '	public static $'.$column_list[$n]["name"].' = "'.$column_list[$n]["name"].'";';
                $column_data_types[$column_list[$n]["name"]] = $data_type;
                if ($n < count($column_list) - 1) {
                    $file_data = $file_data . "," . PHP_EOL;
                } else {
                    $file_data = $file_data . PHP_EOL;
                }
                $file_column = $file_column . PHP_EOL;
            }
            $file_data = $file_data_before . $file_data . $file_data_after;
            $file_column = $file_column_before . $file_column . $file_column_after;
            file_put_contents(__DIR__ ."/database/" . $table_name . ".data.php", $file_data);
            file_put_contents(__DIR__ ."/database/" . $table_name . ".columns.php", $file_column);
        }
    }
}

//生成表单数据表
function create_form_table($table_name)
{
    $table_name = TDConfig::$table_pre . $table_name;
    if(TDConfig::$db_type == "sqlite"){
        $sql = "CREATE TABLE `" . $table_name . "` ( `id` char(25) NOT NULL DEFAULT '', `create_time` datetime NOT NULL, `ip` varchar(25) NOT NULL, `is_del` tinyint(4) NOT NULL DEFAULT '0', PRIMARY KEY (`id`))";
    }else{
        $sql = "CREATE TABLE `" . $table_name . "` ( `id` char(25) NOT NULL DEFAULT '', `create_time` datetime NOT NULL, `ip` varchar(25) NOT NULL, `is_del` tinyint(4) NOT NULL DEFAULT '0', PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8";
    }
    $res = MU()->execute($sql);
    create_database_sql();
}

//修改表名称
function alter_table_name($old_table_name, $new_table_name)
{
    $old_table_name = TDConfig::$table_pre . $old_table_name;
    $new_table_name = TDConfig::$table_pre . $new_table_name;
    $sql = "ALTER TABLE " . $old_table_name . " RENAME TO " . $new_table_name;
    $res = MU()->execute($sql);
    create_database_sql();
}

function delete_table($table_name)
{
    $table_name = TDConfig::$table_pre . $table_name;
    $sql = "drop table " . $table_name;
    $res = MU()->execute($sql);
}

function add_field($table_name, $field_name, $type)
{
    $table_name = TDConfig::$table_pre . $table_name;
    if ($type == "date_part") {
        $sql = "ALTER TABLE `" . $table_name . "` ADD  `" . $field_name . "_1` VARCHAR( 99 ) NOT NULL DEFAULT '',";
        $sql = $sql . " ADD  `" . $field_name . "_2` VARCHAR( 99 ) NOT NULL DEFAULT ''";
    } else if ($type == "editor") {
        $sql = "ALTER TABLE  `" . $table_name . "` ADD  `" . $field_name . "` TEXT NOT NULL DEFAULT ''";
    } else {
        $sql = "ALTER TABLE  `" . $table_name . "` ADD  `" . $field_name . "` VARCHAR( 1000 ) NOT NULL DEFAULT ''";
    }
    $res = MU()->execute($sql);
    create_database_sql();
}

/*
function alter_field($table_name, $old_field_name, $new_field_name, $old_type, $new_type)
{
    $table_name = TDConfig::$table_pre . $table_name;
    if(TDConfig::$db_type == "mysql"){
        if ($old_type == "date_part") {
            $sql = "alter table `" . $table_name . "` drop column `" . $old_field_name . "_1`";
            MU()->execute($sql);
            $sql = "alter table `" . $table_name . "` drop column `" . $old_field_name . "_2`";
            MU()->execute($sql);
        } else {
            $sql = "alter table `" . $table_name . "` drop column `" . $old_field_name . "`";
            MU()->execute($sql);
        }
        if ($new_type == "date_part") {
            $sql = "ALTER TABLE `" . $table_name . "` ADD  `" . $new_field_name . "_1` VARCHAR( 99 ) NOT NULL,";
            $sql = $sql . " ADD  `" . $new_field_name . "_2` VARCHAR( 99 ) NOT NULL";
        } else if ($new_type == "editor") {
            $sql = "ALTER TABLE  `" . $table_name . "` ADD  `" . $new_field_name . "` TEXT NOT NULL";
        } else {
            $sql = "ALTER TABLE  `" . $table_name . "` ADD  `" . $new_field_name . "` VARCHAR( 1000 ) NOT NULL";
        }
    }else if(TDConfig::$db_type == "sqlite"){
        if ($new_type == "date_part") {
            $sql = "ALTER TABLE `" . $table_name . "` ADD  `" . $new_field_name . "_1` VARCHAR( 99 ) NOT NULL DEFAULT '',";
            $sql = $sql . " ADD  `" . $new_field_name . "_2` VARCHAR( 99 ) NOT NULL DEFAULT ''";
        } else if ($new_type == "editor") {
            $sql = "ALTER TABLE  `" . $table_name . "` ADD  `" . $new_field_name . "` TEXT NOT NULL DEFAULT ''";
        } else {
            $sql = "ALTER TABLE  `" . $table_name . "` ADD  `" . $new_field_name . "` VARCHAR( 1000 ) NOT NULL DEFAULT ''";
        }
    }
    $res = MU()->execute($sql);
    create_database_sql();
}

function delete_field($table_name, $field_name, $type)
{
    $table_name = TDConfig::$table_pre . $table_name;
    if(TDConfig::$db_type == "mysql"){
        if ($type == "date_part") {
            $sql = "alter table `" . $table_name . "` drop column " . $field_name . "_1";
            MU()->execute($sql);
            $sql = "alter table `" . $table_name . "` drop column " . $field_name . "_2";
            MU()->execute($sql);
        } else {
            $sql = "alter table `" . $table_name . "` drop column " . $field_name;
            MU()->execute($sql);
        }
    }
    //sqlite3无法删除字段，所以不做处理
}
*/

function check_table_name($table_name)
{
    if (! preg_match("/^[a-zA-Z]{1,9}$/", $table_name)) {
        return array(
            "status" => 0,
            'info' => '表名称只能由字母组成，长度不能超过9位'
        );
    }
    
    if (in_array($table_name, TDConfig::$config['default_table'])) {
        return array(
            "status" => 0,
            'info' => '该数据表已经存在'
        );
    }
    $where = array();
    $where[FORM::$table_name] = array(
        "eq",
        $table_name
    );
    $info = MU(FORM::$_table_name)->where($where)->find();
    if ($info) {
        return array(
            "status" => 0,
            'info' => '该数据表已经存在'
        );
    }
    $info = MU(FORM::$_table_name)->where($where)->find();
    if ($info) {
        return array(
            "status" => 0,
            'info' => '该数据表已经存在'
        );
    }
    return array(
        "status" => 1,
        'info' => '该数据表不存在'
    );
}

function check_field_name($field_name)
{
    $field_arr = array("id", "create_time", "ip", "is_del");
    if(in_array($field_name, $field_arr)){
        return false;
    }
    return preg_match("/^[a-zA-Z]{1,25}$/", $field_name);
}

function create_customer_form_table($fid, $url)
{
    $fields_array = MU("form_fields")->where(array(
        "fid" => $fid,
        "is_del" => 0
    ))->select();
    $form_html_start = '<form action="" id="html_form" method="post">';
    $form_html_end = '</form>';
    
    $form_html = '';
    for ($i = 0; $i < count($fields_array); $i = $i + 1) {
        $required = "";
        if ($fields_array[$i]["is_required"] == 1) {
            $required = "<font style='color:red'>* </font>";
        }
        
        if ($fields_array[$i]["type"] == 3) {
            $form_html = $form_html . "<div class='head_title'>" . $fields_array[$i]["name"] . "</div>";
        }
        
        if ($fields_array[$i]['field_type'] == 'text') {
            $form_html = $form_html . '<div class="layui-form-item"><label class="layui-form-label">' . $required . $fields_array[$i]['name'] . '：</label><div class="layui-input-inline">' . TDWIDGET::text($fields_array[$i]['field_name'], '') . '</div><div class = "div_clear"></div></div>';
        }
        
        if ($fields_array[$i]['field_type'] == 'password') {
            $form_html = $form_html . '<div class="layui-form-item"><label class="layui-form-label">' . $required . $fields_array[$i]['name'] . '：</label><div class="layui-input-inline">' . TDWIDGET::password($fields_array[$i]['field_name'], '') . '</div><div class = "div_clear"></div></div>';
        }
        
        if ($fields_array[$i]['field_type'] == 'select') {
            $field_select = $fields_array[$i]['field_select'];
            $field_select_arr = explode("|", $field_select);
            $field_select_map = array();
            for ($n = 0; $n < count($field_select_arr); $n = $n + 1) {
                $field_select_map[$field_select_arr[$n]] = $field_select_arr[$n];
            }
            $form_html = $form_html . '<div class="layui-form-item"><label class="layui-form-label">' . $required . $fields_array[$i]['name'] . '：</label><div class="layui-input-inline">' . TDWIDGET::select($fields_array[$i]['field_name'], '', $field_select_map) . '</div><div class = "div_clear"></div></div>';
        }
        
        if ($fields_array[$i]['field_type'] == 'checkbox') {
            $field_select = $fields_array[$i]['field_select'];
            $field_select_arr = explode("|", $field_select);
            $field_select_map = $field_select_arr;
            $form_html = $form_html . '<div class="layui-form-item"><label class="layui-form-label">' . $required . $fields_array[$i]['name'] . '：</label><div class="layui-input-inline">' . TDWIDGET::checkbox($fields_array[$i]['field_name'], $field_select_map, array()) . '</div><div class = "div_clear"></div></div>';
        }
        
        if ($fields_array[$i]['field_type'] == 'date') {
            $form_html = $form_html . '<div class="layui-form-item"><label class="layui-form-label">' . $required . $fields_array[$i]['name'] . '：</label><div class="layui-input-inline">' . TDWIDGET::date($fields_array[$i]['field_name'], '') . '</div><div class = "div_clear"></div></div>';
        }
        
        if ($fields_array[$i]['field_type'] == 'date_part') {
            $form_html = $form_html . '<div class="layui-form-item"><label class="layui-form-label">' . $required . $fields_array[$i]['name'] . '：</label><div class="layui-input-inline">' . TDWIDGET::date_part($fields_array[$i]['field_name'], '', '') . '</div><div class = "div_clear"></div></div>';
        }
        
        if ($fields_array[$i]['field_type'] == 'upload') {
            $form_html = $form_html . '<div class="layui-form-item"><label class="layui-form-label">' . $required . $fields_array[$i]['name'] . '：</label><div class="layui-input-inline">' . TDWIDGET::upload($fields_array[$i]['field_name'], '') . '</div><div class = "div_clear"></div></div>';
        }
        
        if ($fields_array[$i]['field_type'] == 'textarea') {
            $form_html = $form_html . '<div class="layui-form-item"><label class="layui-form-label">' . $required . $fields_array[$i]['name'] . '：</label><div class="layui-input-inline">' . TDWIDGET::text($fields_array[$i]['field_name'], '') . '</div><div class = "div_clear"></div></div>';
        }
        
        if ($fields_array[$i]['field_type'] == 'editor') {
            $form_html = $form_html . '<div class="layui-form-item"><label class="layui-form-label">' . $required . $fields_array[$i]['name'] . '：</label><div class="layui-input-inline">' . TDWIDGET::editor($fields_array[$i]['field_name'], '') . '</div><div class = "div_clear"></div></div>';
        }
    }
    
    $form_html = $form_html . '<div style="clear:both;"></div>';
    $form_html = $form_html . '<div class="layui-form-item" id="xieyi_box">';
    $form_html = $form_html . '<label class="layui-form-label">隐私协议：</label>';
    $form_html = $form_html . '<div class="layui-input-inline">';
    $form_html = $form_html . TDWIDGET::checkbox("malltodo_xieyi", array("同意协议内容")) .'   <span class="xieyi_span"><a href="' . TDUU('Index/Form/detail', array(
        'id' => $fid
    ), 'index.php') . '" target="_blank">查看协议</a></span>     </div></div>';
    $form_html = $form_html . '<div style="clear:both;"></div>';
    
    $form_html = $form_html_start . $form_html . $form_html_end;
    $form_html = $form_html . '<div style="clear:both;"></div><div class="form_btn"><input type="button" class="anniu" value="提交" id="add" /></div>';
    return $form_html;
}

function get_client_ip($type = 0, $adv = false)
{
    $type      = $type ? 1 : 0;
    static $ip = null;
    if (null !== $ip) {
        return $ip[$type];
    }
    
    if ($adv) {
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            $pos = array_search('unknown', $arr);
            if (false !== $pos) {
                unset($arr[$pos]);
            }
            
            $ip = trim($arr[0]);
        } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
    } elseif (isset($_SERVER['REMOTE_ADDR'])) {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    // IP地址合法验证
    $long = sprintf("%u", ip2long($ip));
    $ip   = $long ? array($ip, $long) : array('0.0.0.0', 0);
    return $ip[$type];
}

function check_customer_form($table_name, $input_data)
{
    $fid = MU("form")->where(array(
        "table_name" => array(
            "eq",
            $table_name
        )
    ))->getField("id");
    $fields_array = MU("form_fields")->where(array(
        "fid" => $fid,
        "is_del" => 0
    ))->select();
    for ($i = 0; $i < count($fields_array); $i = $i + 1) {
        if (($fields_array[$i]['is_required'] == 1) && (trim($input_data[$fields_array[$i]['field_name']]) == "") && $fields_array[$i]['field_type'] != "date_part") {
            return array(
                "status" => 0,
                'info' => $fields_array[$i]['name'] . "是必填项"
            );
        }
        if (($fields_array[$i]['is_required'] == 1) && (trim($input_data[$fields_array[$i]['field_name'] . "_1"]) == "") && (trim($input_data[$fields_array[$i]['field_name'] . "_2"]) == "") && $fields_array[$i]['field_type'] == "date_part") {
            return array(
                "status" => 0,
                'info' => $fields_array[$i]['name'] . "是必填项"
            );
        }
        if ($fields_array[$i]['verification'] == "mobile") {
            $mobile_field_value = $input_data[$fields_array[$i]['field_name']];
            if (! check_mobile_format($mobile_field_value)) {
                return array(
                    "status" => 0,
                    'info' => $fields_array[$i]['name'] . "中所填写的手机号格式不正确"
                );
            }
        }
        if ($fields_array[$i]['verification'] == "email") {
            $email_field_value = $input_data[$fields_array[$i]['field_name']];
            if (! check_email_format($email_field_value)) {
                return array(
                    "status" => 0,
                    'info' => $fields_array[$i]['name'] . "中所填写的邮箱格式不正确"
                );
            }
        }
    }
    return array(
        "status" => 1,
        'info' => '验证通过'
    );
}


?>