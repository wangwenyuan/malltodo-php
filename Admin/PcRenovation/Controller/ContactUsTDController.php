<?php
require_once __DIR__ . "/BaseRenovation.php";

class ContactUsTDController extends BaseRenovation
{

    public function _td_init()
    {
        if (parent::_td_init()) {
            $this->type = "Index/ContactUs/index";
            $this->platform = "pc";
            $this->assign("page_action", "联系我们栏目");
            return true;
        } else {
            return false;
        }
    }
}