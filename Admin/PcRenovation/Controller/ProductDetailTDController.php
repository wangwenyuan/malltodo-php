<?php
require_once __DIR__ . "/BaseRenovation.php";

class ProductDetailTDController extends BaseRenovation
{

    public function _td_init()
    {
        if (parent::_td_init()) {
            $this->type = "Index/Product/detail";
            $this->platform = "pc";
            $this->assign("page_action", "产品详情页面");
            return true;
        } else {
            return false;
        }
    }
}