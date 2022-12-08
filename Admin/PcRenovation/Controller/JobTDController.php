<?php
require_once __DIR__ . "/BaseRenovation.php";

class JobTDController extends BaseRenovation
{

    public function _td_init()
    {
        if (parent::_td_init()) {
            $this->type = "Index/Job/index";
            $this->platform = "pc";
            $this->assign("page_action", "招聘栏目");
            return true;
        } else {
            return false;
        }
    }
}