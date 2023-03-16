<?php
require_once dirname(dirname(__DIR__)) . '/Index/Controller/CommonTDController.php';

class ShowLinkTDController extends CommonTDController
{

    private $platform = "pc";

    public function index()
    {
        $linkMap = array();
        require_once dirname(dirname(dirname(__DIR__))) . '/Common/MenuCache.php';
        foreach (MenuCache::$home_menu as $key => $val) {
            $linkMap[$val] = TDUU($key, array(), "index.php");
        }
        $this->assign("linkMap", $linkMap);
        $this->display("list");
    }

    public function category()
    {
        $this->list();
    }

    public function custom()
    {
        $where = array();
        $where[RENOVATION::$is_del] = array(
            "eq",
            0
        );
        $where[RENOVATION::$type] = array(
            "eq",
            "Index/Index/custom"
        );
        $where[RENOVATION::$platform] = array(
            "eq",
            $this->platform
        );
        $list = MU(RENOVATION::$_table_name)->where($where)
            ->order(RENOVATION::$id . " desc")
            ->field(RENOVATION::$id . "," . RENOVATION::$name)
            ->select();
        $this->assign("list", $list);
        $this->list();
    }

    private function list()
    {
        $href_dom_id = TDI("get.href_dom_id");
        $this->assign("href_dom_id", $href_dom_id);
        $this->display("PcRenovation/ShowLink/list");
    }
}