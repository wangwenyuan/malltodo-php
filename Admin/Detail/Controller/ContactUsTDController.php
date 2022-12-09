<?php
require_once __DIR__ . "/Base.php";

class ContactUsTDController extends Base
{

    public function _td_init()
    {
        if (parent::_td_init()) {
            $this->categoryType = "Index/ContactUs/index";
            $this->detailType = "Index/ContactUs/detail";
            $this->assign("page_action", "联系我们");
            return true;
        } else {
            return false;
        }
    }
}