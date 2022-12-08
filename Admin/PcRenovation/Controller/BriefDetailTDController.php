<?php
require_once __DIR__ . "/BaseRenovation.php";

class BriefDetailTDController extends BaseRenovation
{

    public function _td_init()
    {
        if (parent::_td_init()) {
            $this->type = "Index/Brief/detail";
            $this->platform = "pc";
            $this->assign("page_action", "公司简介详情页");
            return true;
        } else {
            return false;
        }
    }
}