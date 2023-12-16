<?php
require_once __DIR__ . '/CommonTDController.php';

class RebuildCacheTDController extends CommonTDController
{
    
    public function index()
    {
        $linkArr = array();
        $linkArr["index"] = array();
        $linkArr["category"] = array();
        $linkArr["detail"] = array();
        $where = array();
        $where[RENOVATION::$type] = array(
            "eq",
            "Index/Index/index"
        );
        $where[RENOVATION::$is_del] = array(
            "eq",
            0
        );
        $index_page_list = MU(RENOVATION::$_table_name)->where($where)->select();
        for($i=0; $i<count($index_page_list); $i=$i+1){
            $arr = array();
            $arr["website_id"] = $index_page_list[$i][RENOVATION::$website_id];
            array_push($linkArr["index"], $arr);
        }
        
        $where = array();
        $where[CATEGORY::$is_del] = array("eq", 0);
        $where[CATEGORY::$url] = array("eq", "");
        $category_list = MU(CATEGORY::$_table_name)->where($where)->select();
        for($i=0; $i<count($category_list); $i=$i+1){
            $arr = array();
            $arr["website_id"] = $category_list[$i][CATEGORY::$website_id];
            $arr["id"] = $category_list[$i][CATEGORY::$id];
            array_push($linkArr["category"], $arr);
        }
        
        $where = array();
        $where[DETAIL::$is_del] = array("eq", 0);
        $where[DETAIL::$url] = array("eq", "");
        $detail_list = MU(DETAIL::$_table_name)->where($where)->select();
        for($i=0; $i<count($detail_list); $i=$i+1){
            $arr = array();
            $arr["website_id"] = $detail_list[$i][DETAIL::$website_id];
            $arr["id"] = $detail_list[$i][DETAIL::$id];
            array_push($linkArr["detail"], $arr);
        }
        $this->assign("linkArr", $linkArr);
        $this->display();
    }
    
    public function rebuildCache(){
        if(TD_IS_POST){
            $website_id = TDI("post.website_id");
            $type = TDI("post.type");
            $id = TDI("post.id");
            $i = TDI("post.i");
            if($type == "index"){
                PageCache::getIndexPageCache($website_id);
            }else if($type == "category"){
                PageCache::getCategoryPageCache($website_id, trim($id), 1);
            }else if($type == "detail"){
                PageCache::getDetailPageCache($website_id, trim($id));
            }
            
            $this->success($type."--".$i);
        }
    }
}