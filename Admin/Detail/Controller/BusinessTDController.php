<?php
require_once __DIR__ . "/Base.php";

class BusinessTDController extends Base
{

    public function _td_init()
    {
        if (parent::_td_init()) {
            $this->categoryType = "Index/Business/index";
            $this->detailType = "Index/Business/detail";
            $this->assign("page_action", "业务范围");
            return true;
        } else {
            return false;
        }
    }
}