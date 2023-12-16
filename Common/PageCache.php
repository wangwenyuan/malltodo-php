<?php
class PageCache
{   
    public static function clearPageCache(){
        $dir = TDConfig::$config["page_cache_path"] . "/index/";
        deldir($dir);
        $dir = TDConfig::$config["page_cache_path"] . "/category/";
        deldir($dir);
        $dir = TDConfig::$config["page_cache_path"] . "/detail/";
        deldir($dir);
    }
    
    public static function getIndexPageCache($website_id)
    {
        $urlinput = array();
        $urlinput["m"] = "Index";
        $urlinput["c"] = "Index";
        $urlinput["a"] = "index";
        if(file_exists(TDConfig::$config["page_cache_path"] . "/index/".$website_id.".temp")){
            return file_get_contents(TDConfig::$config["page_cache_path"] . "/index/".$website_id.".temp");
        }else{
            create_dir(TDConfig::$config["page_cache_path"] . "/index/");
            $where = array();
            $where[RENOVATION::$type] = array(
                "eq",
                "Index/Index/index"
            );
            $where[RENOVATION::$is_default] = array(
                "eq",
                1
            );
            $where[RENOVATION::$is_del] = array(
                "eq",
                0
            );
            $where[RENOVATION::$platform] = array(
                "eq",
                "pc"
            );
            $where[RENOVATION::$website_id] = array(
                "eq",
                $website_id
            );
            $map = MU(RENOVATION::$_table_name)->where($where)->find();
            if ($map != null) {
                $where = array();
                $where[CATEGORY::$type] = array(
                    "eq",
                    "Index/Index/index"
                );
                $where[CATEGORY::$is_del] = array(
                    "eq",
                    0
                );
                $where[CATEGORY::$website_id] = array(
                    "eq",
                    $website_id
                );
                $category = MU(CATEGORY::$_table_name)->where($where)->find();
                $title = trim($category[CATEGORY::$seo_title]);
                $keywords = trim($category[CATEGORY::$seo_keywords]);
                $description = trim($category[CATEGORY::$seo_description]);
                $html = RenovationWidget::buildPage($map[RENOVATION::$id], $title, $keywords, $description, $website_id, $urlinput);
            } else {
                $html = RenovationWidget::noTemplateNotice("尚未配置首页默认模板");
            }
            file_put_contents(TDConfig::$config["page_cache_path"] . "/index/".$website_id.".temp", $html);
        }
        return file_get_contents(TDConfig::$config["page_cache_path"] . "/index/".$website_id.".temp");
    }
    
    public static function getCategoryPageCache($website_id, $category_id, $p){
        $urlinput = array();
        $urlinput["m"] = "Index";
        $urlinput["c"] = "Index";
        $urlinput["a"] = "category";
        $urlinput["id"] = $category_id;
        $urlinput["p"] = $p;
        if(file_exists(TDConfig::$config["page_cache_path"] . "/category/" . $category_id . "_" . $p . ".temp")){
            return file_get_contents(TDConfig::$config["page_cache_path"] . "/category/" . $category_id . "_" . $p . ".temp");
        }else{
            create_dir(TDConfig::$config["page_cache_path"] . "/category/");
            $id = $category_id;
            $where = array();
            $where[CATEGORY::$is_del] = array(
                "eq",
                0
            );
            $where[CATEGORY::$id] = array(
                "eq",
                $id
            );
            $where[CATEGORY::$website_id] = array(
                "eq",
                $website_id
            );
            $category = MU(CATEGORY::$_table_name)->where($where)->find();
            if ($category == null) {
                $html = RenovationWidget::noTemplateNotice("尚未创建栏目模板或当前栏目未绑定栏目模板");
                file_put_contents(TDConfig::$config["page_cache_path"] . "/category/" . $category_id . "_" . $p . ".temp", $html);
                return file_get_contents(TDConfig::$config["page_cache_path"] . "/category/" . $category_id . "_" . $p . ".temp");
            }
            
            // 页面类型，0 普通类型，列表页+详情页； 1 单页面； 2 自定义页面
            $category_type = trim($category[CATEGORY::$category_type]);
            $pc_list_renovation_id = trim($category[CATEGORY::$pc_list_renovation_id]);
            $mobile_list_renovation_id = trim($category[CATEGORY::$mobile_list_renovation_id]);
            $pc_custom_id = trim($category[CATEGORY::$pc_custom_id]);
            $mobile_custom_id = trim($category[CATEGORY::$mobile_custom_id]);
            
            $pc_renovation_id = "0"; // pc端列表页模板
            $mobile_renovation_id = "0"; // mobile端列表页模板
            $type = trim($category[CATEGORY::$type]);
            // 获取页面模板
            // 1)普通类型
            if ($category_type == "0") {
                $pc_renovation_id = $pc_list_renovation_id;
                $mobile_renovation_id = $mobile_list_renovation_id;
            }
            
            if ($category_type == "1") {
                $pc_renovation_id = $pc_list_renovation_id;
                $mobile_renovation_id = $mobile_list_renovation_id;
            }
            
            if ($category_type == "2") {
                $pc_renovation_id = $pc_custom_id;
                $mobile_renovation_id = $mobile_custom_id;
                if ($pc_renovation_id == "0") { // 未选择自定义页面模板
                    $html = RenovationWidget::noTemplateNotice("尚未创建栏目模板或当前栏目未绑定栏目模板");
                    file_put_contents(TDConfig::$config["page_cache_path"] . "/category/" . $category_id . "_" . $p . ".temp", $html);
                    return file_get_contents(TDConfig::$config["page_cache_path"] . "/category/" . $category_id . "_" . $p . ".temp");
                }
            }
            
            $renovation = null;
            $where = array();
            if ($category_type != "2") {
                $where[RENOVATION::$type] = array(
                    "eq",
                    $type
                );
            }
            $where[RENOVATION::$platform] = array(
                "eq",
                "pc"
            );
            $where[RENOVATION::$id] = array(
                "eq",
                $pc_renovation_id
            );
            $where[RENOVATION::$website_id] = array(
                "eq",
                $website_id
            );
            $renovation = MU(RENOVATION::$_table_name)->where($where)->find();
            if ($renovation == null) {
                $html = RenovationWidget::noTemplateNotice("尚未创建栏目模板或当前栏目未绑定栏目模板");
                file_put_contents(TDConfig::$config["page_cache_path"] . "/category/" . $category_id . "_" . $p . ".temp", $html);
                return file_get_contents(TDConfig::$config["page_cache_path"] . "/category/" . $category_id . "_" . $p . ".temp");
            } else {
                $title = trim($category[CATEGORY::$seo_title]);
                $keywords = trim($category[CATEGORY::$seo_keywords]);
                $description = trim($category[CATEGORY::$seo_description]);
                $html = RenovationWidget::buildPage($renovation[RENOVATION::$id], $title, $keywords, $description, $website_id, $urlinput);
                file_put_contents(TDConfig::$config["page_cache_path"] . "/category/" . $category_id . "_" . $p . ".temp", $html);
                return file_get_contents(TDConfig::$config["page_cache_path"] . "/category/" . $category_id . "_" . $p . ".temp");
            }
        }
    }
    
    public static function getDetailPageCache($website_id, $detail_id) {
        $urlinput = array();
        $urlinput["m"] = "Index";
        $urlinput["c"] = "Index";
        $urlinput["a"] = "detail";
        $urlinput["id"] = $detail_id;
        if(file_exists(TDConfig::$config["page_cache_path"] . "/detail/" . $detail_id . ".temp")){
            return file_get_contents(TDConfig::$config["page_cache_path"] . "/detail/" . $detail_id . ".temp");
        }else{
            create_dir(TDConfig::$config["page_cache_path"] . "/detail/");
            $id = $detail_id;
            $where = array();
            $where[DETAIL::$is_del] = array(
                "eq",
                0
            );
            $where[DETAIL::$id] = array(
                "eq",
                $id
            );
            $where[DETAIL::$website_id] = array(
                "eq",
                $website_id
            );
            $detail = MU(DETAIL::$_table_name)->where($where)->find();
            
            if ($detail == null) {
                $html = RenovationWidget::noTemplateNotice("尚未创建详情页模板或当前栏目未绑定详情页模板");
                file_put_contents(TDConfig::$config["page_cache_path"] . "/detail/" . $detail_id . ".temp", $html);
                return file_get_contents(TDConfig::$config["page_cache_path"] . "/detail/" . $detail_id . ".temp");
            }
            
            // 模板类型：0 普通模板； 1 自定义模板
            $renovation_type = trim($detail[DETAIL::$renovation_type]);
            $type = trim($detail[DETAIL::$type]);
            
            $pc_renovation_id = "0";
            $mobile_renovation_id = "0";
            
            if ($renovation_type == "0") {
                $pc_renovation_id = $detail[DETAIL::$pc_renovation_id];
                $mobile_renovation_id = $detail[DETAIL::$mobile_renovation_id];
            }
            
            if ($renovation_type == "1") {
                $pc_renovation_id = $detail[DETAIL::$pc_custom_id];
                $mobile_renovation_id = $detail[DETAIL::$mobile_custom_id];
                if ($pc_renovation_id == "0") {
                    $html = RenovationWidget::noTemplateNotice("尚未创建详情页模板或当前栏目未绑定详情页模板");
                    file_put_contents(TDConfig::$config["page_cache_path"] . "/detail/" . $detail_id . ".temp", $html);
                    return file_get_contents(TDConfig::$config["page_cache_path"] . "/detail/" . $detail_id . ".temp");
                }
            }
            
            $category = null;
            if ($pc_renovation_id == "0" || $mobile_renovation_id == "0") {
                $where = array();
                $category_id = $detail[DETAIL::$category_id];
                $where[CATEGORY::$id] = array(
                    "eq",
                    $category_id
                );
                $where[CATEGORY::$is_del] = array(
                    "eq",
                    0
                );
                $where[CATEGORY::$website_id] = array(
                    "eq",
                    $website_id
                );
                $category = MU(CATEGORY::$_table_name)->where($where)->find();
                if ($category == null) {
                    $html = RenovationWidget::noTemplateNotice("尚未创建详情页模板或当前栏目未绑定详情页模板");
                    file_put_contents(TDConfig::$config["page_cache_path"] . "/detail/" . $detail_id . ".temp", $html);
                    return file_get_contents(TDConfig::$config["page_cache_path"] . "/detail/" . $detail_id . ".temp");
                }
                if ($pc_renovation_id == "0") {
                    $pc_renovation_id = $category[CATEGORY::$pc_page_renovation_id];
                }
                if ($mobile_renovation_id == "0") {
                    $mobile_renovation_id = $category[CATEGORY::$mobile_page_renovation_id];
                }
            }
            
            $where = array();
            if ($renovation_type == "0") {
                $where[RENOVATION::$type] = array(
                    "eq",
                    $type
                );
            }
            $where[RENOVATION::$platform] = array(
                "eq",
                "pc"
            );
            $where[RENOVATION::$id] = array(
                "eq",
                $pc_renovation_id
            );
            $where[RENOVATION::$is_del] = array(
                "eq",
                0
            );
            $where[RENOVATION::$website_id] = array(
                "eq",
                $website_id
            );
            $renovation = MU(RENOVATION::$_table_name)->where($where)->find();
            if ($renovation == null) {
                $html = RenovationWidget::noTemplateNotice("尚未创建详情页模板或当前栏目未绑定详情页模板");
                file_put_contents(TDConfig::$config["page_cache_path"] . "/detail/" . $detail_id . ".temp", $html);
                return file_get_contents(TDConfig::$config["page_cache_path"] . "/detail/" . $detail_id . ".temp");
            } else {
                $pc_renovation_id = $renovation[RENOVATION::$id];
                $title = trim($detail[DETAIL::$seo_title]);
                $keywords = trim($detail[DETAIL::$seo_keywords]);
                $description = trim($detail[DETAIL::$seo_description]);
                $html = RenovationWidget::buildPage($renovation[RENOVATION::$id], $title, $keywords, $description, $website_id, $urlinput);
                file_put_contents(TDConfig::$config["page_cache_path"] . "/detail/" . $detail_id . ".temp", $html);
                return file_get_contents(TDConfig::$config["page_cache_path"] . "/detail/" . $detail_id . ".temp");
            }
        }
    }
}