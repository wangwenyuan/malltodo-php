<?php
require_once __DIR__ . "/BaseRenovation.php";

class CustomTDController extends BaseRenovation
{

    public function _td_init()
    {
        if (parent::_td_init()) {
            $this->type = "Index/Index/custom";
            $this->platform = "pc";
            $this->assign("page_action", "自定义页面");
            return true;
        } else {
            return false;
        }
    }
}