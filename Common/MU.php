<?php
global $TDORMHANDLE_DATA;
$TDORMHANDLE_DATA = null;

global $TDORMHANDLE_TEMPLATE;
$$TDORMHANDLE_TEMPLATE = null;

function MU($table_name = "")
{
    if (file_exists(dirname(__DIR__) . "/SQLiteDB/SQLiteConfig.php")) {
        global $TDORMHANDLE; // phptodo中的数据库连接句柄
        global $TDORMHANDLE_DATA; // data数据库的连接句柄
        global $TDORMHANDLE_TEMPLATE; // template数据库的连接句柄
        if ($table_name == RENOVATION::$_table_name) {
            TDConfig::$sqlite_db = SQLiteConfig::$template_db;
            if ($TDORMHANDLE_TEMPLATE == null) {
                $TDORMHANDLE_TEMPLATE = new PDO("sqlite:" . TDConfig::$sqlite_db);
                $TDORMHANDLE_TEMPLATE->exec("set names utf8");
            }
            $TDORMHANDLE = $TDORMHANDLE_TEMPLATE;
        } else {
            TDConfig::$sqlite_db = SQLiteConfig::$data_db;
            if ($TDORMHANDLE_DATA == null) {
                $TDORMHANDLE_DATA = new PDO("sqlite:" . TDConfig::$sqlite_db);
                $TDORMHANDLE_DATA->exec("set names utf8");
            }
            $TDORMHANDLE = $TDORMHANDLE_DATA;
        }
    }
    return new MU($table_name);
}

class MU extends TDORM
{

    public function data($array)
    {
        if ($array == null || empty($array) || ! isset($array["id"]) || $array["id"] == "") {
            $id = Malltodo::get_unique_id();
            $array["id"] = $id;
        }
        return parent::data($array);
    }
}