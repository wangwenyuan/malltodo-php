<?php
require_once __DIR__ . "/Base.php";

class AlbumTDController extends Base
{

    public function _td_init()
    {
        if (parent::_td_init()) {
            $this->categoryType = "Index/Album/index";
            $this->detailType = "Index/Album/detail";
            $this->assign("page_action", "公司相册");
            return true;
        } else {
            return false;
        }
    }
}