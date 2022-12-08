<?php
require_once __DIR__ . "/BaseRenovation.php";

class NewsTDController extends BaseRenovation
{

    public function _td_init()
    {
        if (parent::_td_init()) {
            $this->type = "Index/News/index";
            $this->platform = "pc";
            $this->assign("page_action", "新闻栏目");
            return true;
        } else {
            return false;
        }
    }
}