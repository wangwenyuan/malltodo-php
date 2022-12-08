<?php
require_once __DIR__ . "/BaseRenovation.php";

class ProductTDController extends BaseRenovation
{

    public function _td_init()
    {
        if (parent::_td_init()) {
            $this->type = "Index/Product/index";
            $this->platform = "pc";
            $this->assign("page_action", "产品列表页面");
            return true;
        } else {
            return false;
        }
    }
}