<?php
require_once 'database.config.php';
// 配置runtime路径
TDConfig::$todo_runtime_path = dirname(__DIR__) . "/runtime/";

TDConfig::$todo_database_orm_path = __DIR__ . "/database/";
if (file_exists(TDConfig::$todo_database_orm_path . "_init.php")) {
    require_once TDConfig::$todo_database_orm_path . "_init.php";
}

TDConfig::$app_path = dirname(__DIR__) . "/";
TDConfig::$url = TD_URL . "/malltodo-php/phptodo/";

// 配置项目菜单
TDConfig::$menu = array();

// 系统设置
$admin_home = array();

$admin_home['WebSite'] = array();
$admin_home['WebSite']['_name'] = "站群设置";
$admin_home['WebSite']['_isshow'] = true;
$admin_home['WebSite']['_auth'] = true;
$admin_home['WebSite']['_icon'] = "icon-user";
$admin_home['WebSite']['Index'] = [
    '_isshow' => true,
    '_auth' => true,
    '_name' => '站点管理',
    'index' => '站点管理',
    'add' => '新增站点',
    'edit' => '编辑站点',
    'del' => '删除站点'
];

$admin_home['PcRenovation'] = array();
$admin_home['PcRenovation']['_name'] = "响应式模板";
$admin_home['PcRenovation']['_isshow'] = true;
$admin_home['PcRenovation']['_auth'] = true;
$admin_home['PcRenovation']['_icon'] = "icon-gear";
$admin_home['PcRenovation']['Header'] = [
    '_isshow' => true,
    '_auth' => true,
    '_name' => '顶部模块',
    'index' => '顶部模块设计',
    'add' => '新增顶部模块设计',
    'edit' => '编辑顶部模块设计',
    'del' => '删除顶部模块设计'
];
$admin_home['PcRenovation']['Bottom'] = [
    '_isshow' => true,
    '_auth' => true,
    '_name' => '底部模块',
    'index' => '底部模块设计',
    'add' => '新增底部模块设计',
    'edit' => '编辑底部模块设计',
    'del' => '删除底部模块设计'
];

TDConfig::$menu["admin_home"] = $admin_home;