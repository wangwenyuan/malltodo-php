<?php
require_once __DIR__ . '/BaseTDController.php';

class IndexTDController extends BaseTDController
{

    public function index()
    {
        $where = array();
        $where[RENOVATION::$type] = array(
            "eq",
            "Index/Index/index"
        );
        $where[RENOVATION::$is_default] = array(
            "eq",
            1
        );
        $where[RENOVATION::$is_del] = array(
            "eq",
            0
        );
        $where[RENOVATION::$platform] = array(
            "eq",
            "pc"
        );
        $where[RENOVATION::$website_id] = array(
            "eq",
            TDSESSION("website_id")
        );
        $map = MU(RENOVATION::$_table_name)->where($where)->find();
        if ($map != null) {
            $where = array();
            $where[CATEGORY::$type] = array(
                "eq",
                "Index/Index/index"
            );
            $where[CATEGORY::$is_del] = array(
                "eq",
                0
            );
            $where[CATEGORY::$website_id] = array(
                "eq",
                TDSESSION("website_id")
            );
            $category = MU(CATEGORY::$_table_name)->where($where)->find();
            $title = trim($category[CATEGORY::$seo_title]);
            $keywords = trim($category[CATEGORY::$seo_keywords]);
            $description = trim($category[CATEGORY::$seo_description]);
            $html = RenovationWidget::buildPage($map[RENOVATION::$id], $title, $keywords, $description);
            echo $html;
            exit();
        } else {
            echo RenovationWidget::noTemplateNotice("尚未配置首页默认模板");
        }
    }

    public function category()
    {
        $id = trim(TDI("get.id"));
        $where = array();
        $where[CATEGORY::$is_del] = array(
            "eq",
            0
        );
        $where[CATEGORY::$id] = array(
            "eq",
            $id
        );
        $where[CATEGORY::$website_id] = array(
            "eq",
            TDSESSION("website_id")
        );
        $category = MU(CATEGORY::$_table_name)->where($where)->find();
        if ($category == null) {
            echo RenovationWidget::noTemplateNotice("尚未创建栏目模板或当前栏目未绑定栏目模板");
            return;
        }

        // 页面类型，0 普通类型，列表页+详情页； 1 单页面； 2 自定义页面
        $category_type = trim($category[CATEGORY::$category_type]);
        $pc_list_renovation_id = trim($category[CATEGORY::$pc_list_renovation_id]);
        $mobile_list_renovation_id = trim($category[CATEGORY::$mobile_list_renovation_id]);
        $pc_custom_id = trim($category[CATEGORY::$pc_custom_id]);
        $mobile_custom_id = trim($category[CATEGORY::$mobile_custom_id]);

        $pc_renovation_id = "0"; // pc端列表页模板
        $mobile_renovation_id = "0"; // mobile端列表页模板
        $type = trim($category[CATEGORY::$type]);
        // 获取页面模板
        // 1)普通类型
        if ($category_type == "0") {
            $pc_renovation_id = $pc_list_renovation_id;
            $mobile_renovation_id = $mobile_list_renovation_id;
        }

        if ($category_type == "1") {
            $pc_renovation_id = $pc_list_renovation_id;
            $mobile_renovation_id = $mobile_list_renovation_id;
        }

        if ($category_type == "2") {
            $pc_renovation_id = $pc_custom_id;
            $mobile_renovation_id = $mobile_custom_id;
            if ($pc_renovation_id == "0") { // 未选择自定义页面模板
                echo RenovationWidget::noTemplateNotice("尚未创建栏目模板或当前栏目未绑定栏目模板");
                return;
            }
        }

        $renovation = null;
        $where = array();
        if ($category_type != "2") {
            $where[RENOVATION::$type] = array(
                "eq",
                $type
            );
        }
        $where[RENOVATION::$platform] = array(
            "eq",
            "pc"
        );
        $where[RENOVATION::$id] = array(
            "eq",
            $pc_renovation_id
        );
        $where[RENOVATION::$website_id] = array(
            "eq",
            TDSESSION("website_id")
        );
        $renovation = MU(RENOVATION::$_table_name)->where($where)->find();
        if ($renovation == null) {
            echo RenovationWidget::noTemplateNotice("尚未创建栏目模板或当前栏目未绑定栏目模板");
            return;
        } else {
            $title = trim($category[CATEGORY::$seo_title]);
            $keywords = trim($category[CATEGORY::$seo_keywords]);
            $description = trim($category[CATEGORY::$seo_description]);
            $html = RenovationWidget::buildPage($renovation[RENOVATION::$id], $title, $keywords, $description);
            echo $html;
        }
    }

    public function detail()
    {
        $id = TDI("get.id");
        $where = array();
        $where[DETAIL::$is_del] = array(
            "eq",
            0
        );
        $where[DETAIL::$id] = array(
            "eq",
            $id
        );
        $where[DETAIL::$website_id] = array(
            "eq",
            TDSESSION("website_id")
        );
        $detail = MU(DETAIL::$_table_name)->where($where)->find();

        if ($detail == null) {
            echo RenovationWidget::noTemplateNotice("尚未创建详情页模板或当前栏目未绑定详情页模板");
            return;
        }

        // 模板类型：0 普通模板； 1 自定义模板
        $renovation_type = trim($detail[DETAIL::$renovation_type]);
        $type = trim($detail[DETAIL::$type]);

        $pc_renovation_id = "0";
        $mobile_renovation_id = "0";

        if ($renovation_type == "0") {
            $pc_renovation_id = $detail[DETAIL::$pc_renovation_id];
            $mobile_renovation_id = $detail[DETAIL::$mobile_renovation_id];
        }

        if ($renovation_type == "1") {
            $pc_renovation_id = $detail[DETAIL::$pc_custom_id];
            $mobile_renovation_id = $detail[DETAIL::$mobile_custom_id];
            if ($pc_renovation_id == "0") {
                echo RenovationWidget::noTemplateNotice("尚未创建详情页模板或当前栏目未绑定详情页模板");
                return;
            }
        }

        $category = null;
        if ($pc_renovation_id == "0" || $mobile_renovation_id == "0") {
            $where = array();
            $category_id = $detail[DETAIL::$category_id];
            $where[CATEGORY::$id] = array(
                "eq",
                $category_id
            );
            $where[CATEGORY::$is_del] = array(
                "eq",
                0
            );
            $where[CATEGORY::$website_id] = array(
                "eq",
                TDSESSION("website_id")
            );
            $category = MU(CATEGORY::$_table_name)->where($where)->find();
            if ($category == null) {
                echo RenovationWidget::noTemplateNotice("尚未创建详情页模板或当前栏目未绑定详情页模板");
                return;
            }
            if ($pc_renovation_id == "0") {
                $pc_renovation_id = $category[CATEGORY::$pc_page_renovation_id];
            }
            if ($mobile_renovation_id == "0") {
                $mobile_renovation_id = $category[CATEGORY::$mobile_page_renovation_id];
            }
        }

        $where = array();
        if ($renovation_type == "0") {
            $where[RENOVATION::$type] = array(
                "eq",
                $type
            );
        }
        $where[RENOVATION::$platform] = array(
            "eq",
            "pc"
        );
        $where[RENOVATION::$id] = array(
            "eq",
            $pc_renovation_id
        );
        $where[RENOVATION::$is_del] = array(
            "eq",
            0
        );
        $where[RENOVATION::$website_id] = array(
            "eq",
            TDSESSION("website_id")
        );
        $renovation = MU(RENOVATION::$_table_name)->where($where)->find();
        if ($renovation == null) {
            RenovationWidget::noTemplateNotice("尚未创建详情页模板或当前栏目未绑定详情页模板");
            return;
        } else {
            $pc_renovation_id = $renovation[RENOVATION::$id];
            $title = trim($detail[DETAIL::$seo_title]);
            $keywords = trim($detail[DETAIL::$seo_keywords]);
            $description = trim($detail[DETAIL::$seo_description]);
            $html = RenovationWidget::buildPage($renovation[RENOVATION::$id], $title, $keywords, $description);
            echo $html;
            return;
        }
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