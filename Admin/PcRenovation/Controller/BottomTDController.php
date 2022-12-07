<?php
require_once __DIR__ . "/BaseRenovation.php";

class BottomTDController extends BaseRenovation
{

    public function _td_init()
    {
        if (parent::_td_init()) {
            $this->type = "bottom";
            $this->platform = "pc";
            $this->assign("page_action", "底部模块");
            return true;
        } else {
            return false;
        }
    }
}