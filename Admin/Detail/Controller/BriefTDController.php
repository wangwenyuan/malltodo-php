<?php
require_once __DIR__ . "/Base.php";

class BriefTDController extends Base
{

    public function _td_init()
    {
        if (parent::_td_init()) {
            $this->categoryType = "Index/Brief/index";
            $this->detailType = "Index/Brief/detail";
            $this->assign("page_action", "公司简介");
            return true;
        } else {
            return false;
        }
    }
}