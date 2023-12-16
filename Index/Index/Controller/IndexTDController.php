<?php
require_once __DIR__ . '/BaseTDController.php';

class IndexTDController extends BaseTDController
{

    public function index()
    {
        echo PageCache::getIndexPageCache(TDSESSION("website_id"));
    }

    public function category()
    {
        $p = (int)(trim(TDI("p")));
        if($p == 0){
            $p = 1;
        }
        $where = array();
        $where['website_id'] = array("eq", TDSESSION("website_id"));
        $where['id'] = array("eq", TDI("get.id"));
        $map = MU(CATEGORY::$_table_name)->where($where)->find();
        if($map != null){
            if($map[CATEGORY::$url] != ''){
                TDREDIRECT($map[CATEGORY::$url]);
                return ;
            }
        }
        echo PageCache::getCategoryPageCache(TDSESSION("website_id"), trim(TDI("get.id")), $p);
    }

    public function detail()
    {
        $where = array();
        $where['website_id'] = array("eq", TDSESSION("website_id"));
        $where['id'] = array("eq", TDI("get.id"));
        $map = MU(DETAIL::$_table_name)->where($where)->find();
        if($map != ''){
            if($map[DETAIL::$url] != ''){
                TDREDIRECT($map[DETAIL::$url]);
                return ;
            }
        }
        echo PageCache::getDetailPageCache(TDSESSION("website_id"), trim(TDI("get.id")));
    }

    public function verify()
    {
        $config = array(
            'fontSize' => 30, // 验证码字体大小
            'length' => 5, // 验证码位数
            'useNoise' => false // 关闭验证码杂点
        );
        $Verify = new TDVERIFY($config);
        $Verify->entry();
    }
}