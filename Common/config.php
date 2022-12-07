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
$admin_home['PcRenovation']['Index'] = [
    '_isshow' => true,
    '_auth' => true,
    '_name' => '官网首页',
    'index' => '首页模板',
    'add' => '新增首页模板',
    'edit' => '编辑首页模板',
    'del' => '删除首页模板',
    'setDefault' => '模板开启开关'
];
$admin_home['PcRenovation']['News'] = [
    '_isshow' => true,
    '_auth' => true,
    '_name' => '新闻栏目页面',
    'index' => '新闻栏目模版',
    'add' => '新增新闻栏目模版',
    'edit' => '编辑新闻栏目模版',
    'del' => '删除新闻栏目模版'
];
$admin_home['PcRenovation']['NewsDetail'] = [
    '_isshow' => true,
    '_auth' => true,
    '_name' => '新闻详情页面',
    'index' => '新闻详情模版',
    'add' => '新增新闻详情模版',
    'edit' => '编辑新闻详情模版',
    'del' => '删除新闻详情模版'
];
$admin_home['PcRenovation']['Product'] = [
    '_isshow' => true,
    '_auth' => true,
    '_name' => '产品栏目页面',
    'index' => '产品栏目模版',
    'add' => '新增产品栏目模版',
    'edit' => '编辑产品栏目模版',
    'del' => '删除产品栏目模版'
];
$admin_home['PcRenovation']['ProductDetail'] = [
    '_isshow' => true,
    '_auth' => true,
    '_name' => '产品详情页面',
    'index' => '产品详情模版',
    'add' => '新增产品详情模版',
    'edit' => '编辑产品详情模版',
    'del' => '删除产品详情模版'
];
$admin_home['PcRenovation']['Brief'] = [
    '_isshow' => true,
    '_auth' => true,
    '_name' => '公司简介栏目页面',
    'index' => '公司简介栏目模版',
    'add' => '新增公司简介栏目模版',
    'edit' => '编辑公司简介栏目模版',
    'del' => '删除公司简介栏目模版'
];
$admin_home['PcRenovation']['BriefDetail'] = [
    '_isshow' => true,
    '_auth' => true,
    '_name' => '公司简介详情页面',
    'index' => '公司简介详情模版',
    'add' => '新增公司简介详情模版',
    'edit' => '编辑公司简介详情模版',
    'del' => '删除公司简介详情模版'
];
$admin_home['PcRenovation']['Business'] = [
    '_isshow' => true,
    '_auth' => true,
    '_name' => '业务范围栏目页面',
    'index' => '业务范围栏目模版',
    'add' => '新增业务范围栏目模版',
    'edit' => '编辑业务范围栏目模版',
    'del' => '删除业务范围栏目模版'
];
$admin_home['PcRenovation']['BusinessDetail'] = [
    '_isshow' => true,
    '_auth' => true,
    '_name' => '业务范围详情页面',
    'index' => '业务范围详情模版',
    'add' => '新增业务范围详情模版',
    'edit' => '编辑业务范围详情模版',
    'del' => '删除业务范围详情模版'
];
$admin_home['PcRenovation']['Case'] = [
    '_isshow' => true,
    '_auth' => true,
    '_name' => '应用案例栏目页面',
    'index' => '应用案例栏目模版',
    'add' => '新增应用案例栏目模版',
    'edit' => '编辑应用案例栏目模版',
    'del' => '删除应用案例栏目模版'
];
$admin_home['PcRenovation']['CaseDetail'] = [
    '_isshow' => true,
    '_auth' => true,
    '_name' => '应用案例详情页面',
    'index' => '应用案例详情模版',
    'add' => '新增应用案例详情模版',
    'edit' => '编辑应用案例详情模版',
    'del' => '删除应用案例详情模版'
];
$admin_home['PcRenovation']['Album'] = [
    '_isshow' => true,
    '_auth' => true,
    '_name' => '公司相册栏目页面',
    'index' => '公司相册栏目模版',
    'add' => '新增公司相册栏目模版',
    'edit' => '编辑公司相册栏目模版',
    'del' => '删除公司相册栏目模版'
];
$admin_home['PcRenovation']['AlbumDetail'] = [
    '_isshow' => true,
    '_auth' => true,
    '_name' => '公司相册详情页面',
    'index' => '公司相册详情模版',
    'add' => '新增公司相册详情模版',
    'edit' => '编辑公司相册详情模版',
    'del' => '删除公司相册详情模版'
];
$admin_home['PcRenovation']['Message'] = [
    '_isshow' => true,
    '_auth' => true,
    '_name' => '客户留言页面',
    'index' => '客户留言模版',
    'add' => '新增客户留言模版',
    'edit' => '编辑客户留言模板',
    'del' => '删除客户留言模板',
    'setDefault' => '模板开启开关'
];
$admin_home['PcRenovation']['Job'] = [
    '_isshow' => true,
    '_auth' => true,
    '_name' => '招聘栏目页面',
    'index' => '招聘栏目模版',
    'add' => '新增招聘栏目模版',
    'edit' => '编辑招聘栏目模版',
    'del' => '删除招聘栏目模版'
];
$admin_home['PcRenovation']['JobDetail'] = [
    '_isshow' => true,
    '_auth' => true,
    '_name' => '招聘详情页面',
    'index' => '招聘详情模版',
    'add' => '新增招聘详情模版',
    'edit' => '编辑招聘详情模版',
    'del' => '删除招聘详情模版'
];
$admin_home['PcRenovation']['ContactUs'] = [
    '_isshow' => true,
    '_auth' => true,
    '_name' => '联系我们栏目页面',
    'index' => '联系我们栏目模版',
    'add' => '新增联系我们栏目模版',
    'edit' => '编辑联系我们栏目模版',
    'del' => '删除联系我们栏目模版'
];
$admin_home['PcRenovation']['ContactUsDetail'] = [
    '_isshow' => true,
    '_auth' => true,
    '_name' => '联系我们详情页面',
    'index' => '联系我们详情模版',
    'add' => '新增联系我们详情模版',
    'edit' => '编辑联系我们详情模版',
    'del' => '删除联系我们详情模版'
];
$admin_home['PcRenovation']['Custom'] = [
    '_isshow' => true,
    '_auth' => true,
    '_name' => '自定义页面',
    'index' => '自定义模版',
    'add' => '新增自定义模版',
    'edit' => '编辑自定义模版',
    'del' => '删除自定义模版'
];
TDConfig::$menu["admin_home"] = $admin_home;