<?php
require_once __DIR__ . "/Base.php";

class NewsTDController extends Base
{

    public function _td_init()
    {
        if (parent::_td_init()) {
            $this->categoryType = "Index/News/index";
            $this->detailType = "Index/News/detail";
            $this->assign("page_action", "新闻");
            return true;
        } else {
            return false;
        }
    }
}