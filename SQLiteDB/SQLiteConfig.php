<?php

class SQLiteConfig
{

    public static $data_db = "";

    public static $template_db = "";
}

function get_domain_prefix()
{
    $domain = $_SERVER["HTTP_HOST"];
    if ($domain == "www.malltodo.com" || $domain == "malltodo.com" || $domain == "www.malltodo.cn") {
        return "main";
    }
    if (strpos($domain, ".template.malltodo.com") !== FALSE) {
        return str_replace(".template.malltodo.com", "", $domain);
    } else if (strpos($domain, ".template.malltodo.cn") !== FALSE) {
        return str_replace(".template.malltodo.cn", "", $domain);
    } else {
        if (strpos($domain, ".malltodo.com") !== FALSE || strpos($domain, ".malltodo.cn") !== FALSE || $domain == "malltodo.com") {
            return "main";
        } else {
            return "default";
        }
    }
}

function setTemplate($template_code)
{
    TDS("template_code", $template_code);
}

function getTemplate()
{
    $template_code = TDS("template_code");
    if ($template_code) {
        return $template_code;
    } else {
        return get_domain_prefix();
    }
}

function setSQLiteConfig()
{
    $template_code = getTemplate();
    if (file_exists(__DIR__ . "/" . $template_code . "/")) {
        TDConfig::$db_type = "sqlite";
        TDConfig::$table_pre = "javatodo_";
        if ($template_code == "main") {
            SQLiteConfig::$data_db = __DIR__ . "/main/db/malltodo.db";
            SQLiteConfig::$template_db = __DIR__ . "/main/db/malltodo.db";
            TDConfig::$upload["rootPath"] = dirname(__DIR__) . "/entrance/template/main/Uploads/";
            TDConfig::$upload["picUrl"] = "./template/main/Uploads/"; // 图片链接前缀
        } else {
            SQLiteConfig::$data_db = __DIR__ . "/default/db/data.db";
            SQLiteConfig::$template_db = __DIR__ . "/" . $template_code . "/" . "db/template.db";
            TDConfig::$upload["rootPath"] = dirname(__DIR__) . "/entrance/template/default/Uploads/";
            TDConfig::$upload["picUrl"] = "./template/default/Uploads/"; // 图片链接前缀
        }
    } else {
        exit();
    }
}

setSQLiteConfig();