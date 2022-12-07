<?php
require_once __DIR__ . "/BaseRenovation.php";

class HeaderTDController extends BaseRenovation
{

    public function _td_init()
    {
        if (parent::_td_init()) {
            $this->type = "header";
            $this->platform = "pc";
            $this->assign("page_action", "顶部模块");
            return true;
        } else {
            return false;
        }
    }
}