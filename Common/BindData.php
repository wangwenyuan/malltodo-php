<?php

class BindData
{

    public static function bind($dom, $bind_loop_list, $website_id, $urlinput)
    {
        $object = new stdClass();
        $category = $dom->category;
        $javatodo_bind_param_key = "javatodo-bind-param";
        $bind_param = $dom->$javatodo_bind_param_key;
        if ($category == "home_menu_pc" || $category == "home_menu_mobile" || $category == "home_bottom_menu_pc" || $category == "home_bottom_menu_mobile") {
            require_once __DIR__ . "/Widget/data/HomeMenu.php";
            $class = new HomeMenu($website_id);
            $object = $class->getValue($bind_param, $bind_loop_list, $website_id, $urlinput);
        }

        if ($category == "home_index_bread_pc") {
            require_once __DIR__ . "/Widget/data/HomeIndexBread.php";
            $class = new HomeIndexBread($website_id);
            $object = $class->getValue($bind_param, $bind_loop_list, $website_id, $urlinput);
        }

        if ($category == "home_index_products_pc" || $category == "home_index_products_mobile") {
            require_once __DIR__ . "/Widget/data/HomeIndexProducts.php";
            $class = new HomeIndexProducts($website_id);
            $object = $class->getValue($bind_param, $bind_loop_list, $website_id, $urlinput);
        }
        if ($category == "home_index_products_list_pc" || $category == "home_index_products_list_mobile" || $category == "home_index_products_page_pc" || $category == "home_index_products_page_mobile") {
            require_once __DIR__ . "/Widget/data/HomeIndexProductsList.php";
            $class = new HomeIndexProductsList($website_id);
            $object = $class->getValue($bind_param, $bind_loop_list, $website_id, $urlinput);
        }
        if ($category == "home_index_products_detail_pc" || $category == "home_index_products_detail_mobile") {
            require_once __DIR__ . "/Widget/data/HomeIndexProductsDetail.php";
            $class = new HomeIndexProductsDetail($website_id);
            $object = $class->getValue($bind_param, $bind_loop_list, $website_id, $urlinput);
        }

        if ($category == "home_index_news_pc" || $category == "home_index_news_mobile") {
            require_once __DIR__ . "/Widget/data/HomeIndexNews.php";
            $class = new HomeIndexNews($website_id);
            $object = $class->getValue($bind_param, $bind_loop_list, $website_id, $urlinput);
        }
        if ($category == "home_index_news_list_pc" || $category == "home_index_news_list_mobile" || $category == "home_index_news_page_pc" || $category == "home_index_news_page_mobile") {
            require_once __DIR__ . "/Widget/data/HomeIndexNewsList.php";
            $class = new HomeIndexNewsList($website_id);
            $object = $class->getValue($bind_param, $bind_loop_list, $website_id, $urlinput);
        }
        if ($category == "home_index_news_detail_pc" || $category == "home_index_news_detail_mobile") {
            require_once __DIR__ . "/Widget/data/HomeIndexNewsDetail.php";
            $class = new HomeIndexNewsDetail($website_id);
            $object = $class->getValue($bind_param, $bind_loop_list, $website_id, $urlinput);
        }

        if ($category == "home_index_business_pc" || $category == "home_index_business_mobile") {
            require_once __DIR__ . "/Widget/data/HomeIndexBusiness.php";
            $class = new HomeIndexBusiness($website_id);
            $object = $class->getValue($bind_param, $bind_loop_list, $website_id, $urlinput);
        }
        if ($category == "home_index_business_list_pc" || $category == "home_index_business_list_mobile" || $category == "home_index_business_page_pc" || $category == "home_index_business_page_mobile") {
            require_once __DIR__ . "/Widget/data/HomeIndexBusinessList.php";
            $class = new HomeIndexBusinessList($website_id);
            $object = $class->getValue($bind_param, $bind_loop_list, $website_id, $urlinput);
        }
        if ($category == "home_index_business_detail_pc" || $category == "home_index_business_detail_mobile") {
            require_once __DIR__ . "/Widget/data/HomeIndexBusinessDetail.php";
            $class = new HomeIndexBusinessDetail($website_id);
            $object = $class->getValue($bind_param, $bind_loop_list, $website_id, $urlinput);
        }

        if ($category == "home_index_album_pc" || $category == "home_index_album_mobile") {
            require_once __DIR__ . "/Widget/data/HomeIndexAlbum.php";
            $class = new HomeIndexAlbum($website_id);
            $object = $class->getValue($bind_param, $bind_loop_list, $website_id, $urlinput);
        }
        if ($category == "home_index_album_list_pc" || $category == "home_index_album_list_mobile" || $category == "home_index_album_page_pc" || $category == "home_index_album_page_mobile") {
            require_once __DIR__ . "/Widget/data/HomeIndexAlbumList.php";
            $class = new HomeIndexAlbumList($website_id);
            $object = $class->getValue($bind_param, $bind_loop_list, $website_id, $urlinput);
        }
        if ($category == "home_index_album_detail_pc" || $category == "home_index_album_detail_mobile") {
            require_once __DIR__ . "/Widget/data/HomeIndexAlbumDetail.php";
            $class = new HomeIndexAlbumDetail($website_id);
            $object = $class->getValue($bind_param, $bind_loop_list, $website_id, $urlinput);
        }

        if ($category == "home_index_job_pc" || $category == "home_index_job_mobile") {
            require_once __DIR__ . "/Widget/data/HomeIndexJob.php";
            $class = new HomeIndexJob($website_id);
            $object = $class->getValue($bind_param, $bind_loop_list, $website_id, $urlinput);
        }
        if ($category == "home_index_job_list_pc" || $category == "home_index_job_list_mobile" || $category == "home_index_job_page_pc" || $category == "home_index_job_page_mobile") {
            require_once __DIR__ . "/Widget/data/HomeIndexJobList.php";
            $class = new HomeIndexJobList($website_id);
            $object = $class->getValue($bind_param, $bind_loop_list, $website_id, $urlinput);
        }
        if ($category == "home_index_job_detail_pc" || $category == "home_index_job_detail_mobile") {
            require_once __DIR__ . "/Widget/data/HomeIndexJobDetail.php";
            $class = new HomeIndexJobDetail($website_id);
            $object = $class->getValue($bind_param, $bind_loop_list, $website_id, $urlinput);
        }

        if ($category == "home_index_message_pc" || $category == "home_index_message_mobile") {
            require_once __DIR__ . "/Widget/data/HomeIndexMessage.php";
            $class = new HomeIndexMessage($website_id);
            $object = $class->getValue($bind_param, $bind_loop_list, $website_id, $urlinput);
        }
        if ($category == "home_index_message_list_pc" || $category == "home_index_message_list_mobile") {
            require_once __DIR__ . "/Widget/data/HomeIndexMessageList.php";
            $class = new HomeIndexMessageList($website_id);
            $object = $class->getValue($bind_param, $bind_loop_list, $website_id, $urlinput);
        }

        if ($category == "home_index_search_pc" || $category == "home_index_search_mobile") {
            require_once __DIR__ . "/Widget/data/HomeIndexSearch.php";
            $class = new HomeIndexSearch($website_id);
            $object = $class->getValue($bind_param, $bind_loop_list, $website_id, $urlinput);
        }
        if ($category == "home_index_search_list_pc" || $category == "home_index_search_list_mobile") {
            require_once __DIR__ . "/Widget/data/HomeIndexSearchList.php";
            $class = new HomeIndexSearchList($website_id);
            $object = $class->getValue($bind_param, $bind_loop_list, $website_id, $urlinput);
        }

        if ($category == "home_index_case_pc" || $category == "home_index_case_mobile") {
            require_once __DIR__ . "/Widget/data/HomeIndexCase.php";
            $class = new HomeIndexCase($website_id);
            $object = $class->getValue($bind_param, $bind_loop_list, $website_id, $urlinput);
        }
        if ($category == "home_index_case_list_pc" || $category == "home_index_case_list_mobile" || $category == "home_index_case_page_pc" || $category == "home_index_case_page_mobile") {
            require_once __DIR__ . "/Widget/data/HomeIndexCaseList.php";
            $class = new HomeIndexCaseList($website_id);
            $object = $class->getValue($bind_param, $bind_loop_list, $website_id, $urlinput);
        }
        if ($category == "home_index_case_detail_pc" || $category == "home_index_case_detail_mobile") {
            require_once __DIR__ . "/Widget/data/HomeIndexCaseDetail.php";
            $class = new HomeIndexCaseDetail($website_id);
            $object = $class->getValue($bind_param, $bind_loop_list, $website_id, $urlinput);
        }

        if ($category == "home_index_links_pc" || $category == "home_index_links_mobile") {
            require_once __DIR__ . "/Widget/data/HomeIndexLinks.php";
            $class = new HomeIndexLinks($website_id);
            $object = $class->getValue($bind_param, $bind_loop_list, $website_id, $urlinput);
        }

        if ($category == "home_index_brief_pc" || $category == "home_index_brief_mobile") {
            require_once __DIR__ . "/Widget/data/HomeIndexBrief.php";
            $class = new HomeIndexBrief($website_id);
            $object = $class->getValue($bind_param, $bind_loop_list, $website_id, $urlinput);
        }
        if ($category == "home_index_brief_list_pc" || $category == "home_index_brief_list_mobile" || $category == "home_index_brief_page_pc" || $category == "home_index_brief_page_mobile") {
            require_once __DIR__ . "/Widget/data/HomeIndexBriefList.php";
            $class = new HomeIndexBriefList($website_id);
            $object = $class->getValue($bind_param, $bind_loop_list, $website_id, $urlinput);
        }
        if ($category == "home_index_brief_detail_pc" || $category == "home_index_brief_detail_mobile") {
            require_once __DIR__ . "/Widget/data/HomeIndexBriefDetail.php";
            $class = new HomeIndexBriefDetail($website_id);
            $object = $class->getValue($bind_param, $bind_loop_list, $website_id, $urlinput);
        }

        if ($category == "home_index_contactus_pc" || $category == "home_index_contactus_mobile") {
            require_once __DIR__ . "/Widget/data/HomeIndexContactUs.php";
            $class = new HomeIndexContactUs($website_id);
            $object = $class->getValue($bind_param, $bind_loop_list, $website_id, $urlinput);
        }
        if ($category == "home_index_contactus_list_pc" || $category == "home_index_contactus_list_mobile" || $category == "home_index_contactus_page_pc" || $category == "home_index_contactus_page_mobile") {
            require_once __DIR__ . "/Widget/data/HomeIndexContactUsList.php";
            $class = new HomeIndexContactUsList($website_id);
            $object = $class->getValue($bind_param, $bind_loop_list, $website_id, $urlinput);
        }
        if ($category == "home_index_contactus_detail_pc" || $category == "home_index_contactus_detail_mobile") {
            require_once __DIR__ . "/Widget/data/HomeIndexContactUsDetail.php";
            $class = new HomeIndexContactUsDetail($website_id);
            $object = $class->getValue($bind_param, $bind_loop_list, $website_id, $urlinput);
        }

        return $object;
    }
}