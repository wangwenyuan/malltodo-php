<?php

function get_domain_prefix()
{
    $domain = $_SERVER["HTTP_HOST"];
    if (strpos($domain, ".template.malltodo.com") !== FALSE) {
        return str_replace(".template.malltodo.com", "", $domain);
    } else if (strpos($domain, ".template.malltodo.cn") !== FALSE) {
        return str_replace(".template.malltodo.cn", "", $domain);
    } else {
        return "default";
    }
}
$_domain_prefix = get_domain_prefix();
$base_path = __DIR__ . "/" . $_domain_prefix . "/";
if (file_exists($base_path)) {
    TDConfig::$db_type = "sqlite";
    TDConfig::$table_pre = "javatodo_";
    TDConfig::$sqlite_db = $base_path . "db/malltodo.db";
    TDConfig::$upload["rootPath"] = dirname(__DIR__) . "/entrance/template/" . $_domain_prefix . "/Uploads/";
    TDConfig::$upload["picUrl"] = "./template/" . $_domain_prefix . "/Uploads/"; // 图片链接前缀
} else {
    exit();
}
