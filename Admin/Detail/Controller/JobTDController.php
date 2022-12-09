<?php
require_once __DIR__ . "/Base.php";

class JobTDController extends Base
{

    public function _td_init()
    {
        if (parent::_td_init()) {
            $this->categoryType = "Index/Job/index";
            $this->detailType = "Index/Job/detail";
            $this->assign("page_action", "人力招聘");
            return true;
        } else {
            return false;
        }
    }
}