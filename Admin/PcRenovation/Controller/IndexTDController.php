<?php
require_once __DIR__ . "/BaseRenovation.php";

class IndexTDController extends BaseRenovation
{

    public function _td_init()
    {
        if (parent::_td_init()) {
            $this->type = "Index/Index/index";
            $this->platform = "pc";
            $this->assign("page_action", "首页页面");
            $this->need_default = true;
            return true;
        } else {
            return false;
        }
    }
}