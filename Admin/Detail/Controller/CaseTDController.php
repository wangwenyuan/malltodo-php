<?php
require_once __DIR__ . "/Base.php";

class CaseTDController extends Base
{

    public function _td_init()
    {
        if (parent::_td_init()) {
            $this->categoryType = "Index/Case/index";
            $this->detailType = "Index/Case/detail";
            $this->assign("page_action", "应用案例");
            return true;
        } else {
            return false;
        }
    }
}