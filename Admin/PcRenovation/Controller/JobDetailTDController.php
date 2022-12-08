<?php
require_once __DIR__ . "/BaseRenovation.php";

class JobDetailTDController extends BaseRenovation
{

    public function _td_init()
    {
        if (parent::_td_init()) {
            $this->type = "Index/Job/detail";
            $this->platform = "pc";
            $this->assign("page_action", "招聘详情页");
            return true;
        } else {
            return false;
        }
    }
}