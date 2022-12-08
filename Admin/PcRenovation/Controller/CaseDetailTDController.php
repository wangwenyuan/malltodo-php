<?php
require_once __DIR__ . "/BaseRenovation.php";

class CaseDetailTDController extends BaseRenovation
{

    public function _td_init()
    {
        if (parent::_td_init()) {
            $this->type = "Index/Case/detail";
            $this->platform = "pc";
            $this->assign("page_action", "应用案例详情页");
            return true;
        } else {
            return false;
        }
    }
}