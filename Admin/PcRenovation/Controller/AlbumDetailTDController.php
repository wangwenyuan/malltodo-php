<?php
require_once __DIR__ . "/BaseRenovation.php";

class AlbumDetailTDController extends BaseRenovation
{

    public function _td_init()
    {
        if (parent::_td_init()) {
            $this->type = "Index/Album/detail";
            $this->platform = "pc";
            $this->assign("page_action", "公司相册详情页");
            return true;
        } else {
            return false;
        }
    }
}