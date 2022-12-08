<?php
require_once __DIR__ . "/BaseRenovation.php";

class BusinessDetailTDController extends BaseRenovation
{

    public function _td_init()
    {
        if (parent::_td_init()) {
            $this->type = "Index/Business/detail";
            $this->platform = "pc";
            $this->assign("page_action", "业务范围详情页");
            return true;
        } else {
            return false;
        }
    }
}