<?php
require_once __DIR__ . "/BaseRenovation.php";

class BusinessTDController extends BaseRenovation
{

    public function _td_init()
    {
        if (parent::_td_init()) {
            $this->type = "Index/Business/index";
            $this->platform = "pc";
            $this->assign("page_action", "业务范围栏目");
            return true;
        } else {
            return false;
        }
    }
}