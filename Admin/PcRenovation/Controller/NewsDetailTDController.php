<?php
require_once __DIR__ . "/BaseRenovation.php";

class NewsDetailTDController extends BaseRenovation
{

    public function _td_init()
    {
        if (parent::_td_init()) {
            $this->type = "Index/News/detail";
            $this->platform = "pc";
            $this->assign("page_action", "新闻详情页");
            return true;
        } else {
            return false;
        }
    }
}