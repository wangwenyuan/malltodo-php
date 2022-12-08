<?php
require_once __DIR__ . "/BaseRenovation.php";

class ContactUsDetailTDController extends BaseRenovation
{

    public function _td_init()
    {
        if (parent::_td_init()) {
            $this->type = "Index/ContactUs/detail";
            $this->platform = "pc";
            $this->assign("page_action", "联系我们详情页");
            return true;
        } else {
            return false;
        }
    }
}