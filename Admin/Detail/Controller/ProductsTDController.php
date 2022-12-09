<?php
require_once __DIR__ . "/Base.php";

class ProductsTDController extends Base
{

    public function _td_init()
    {
        if (parent::_td_init()) {
            $this->categoryType = "Index/Products/index";
            $this->detailType = "Index/Products/detail";
            $this->assign("page_action", "产品");
            return true;
        } else {
            return false;
        }
    }
}