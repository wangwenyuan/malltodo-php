<?php
require_once __DIR__ . "/BaseRenovation.php";

class AlbumTDController extends BaseRenovation
{

    public function _td_init()
    {
        if (parent::_td_init()) {
            $this->type = "Index/Album/index";
            $this->platform = "pc";
            $this->assign("page_action", "公司相册栏目");
            return true;
        } else {
            return false;
        }
    }

    public static function getAlbumListDom($param, $doms)
    {}
}