<?php
require_once __DIR__ . "/BaseRenovation.php";

class BriefTDController extends BaseRenovation
{

    public function _td_init()
    {
        if (parent::_td_init()) {
            $this->type = "Index/Brief/index";
            $this->platform = "pc";
            $this->assign("page_action", "公司简介栏目");
            return true;
        } else {
            return false;
        }
    }
}