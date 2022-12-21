<?php

class BindData
{

    public static function bind($dom, $bind_loop_list)
    {
        $object = new stdClass();
        $category = $dom->category;
        $javatodo_bind_param_key = "javatodo-bind-param";
        $bind_param = $dom->$javatodo_bind_param_key;
        if ($category == "home_menu_pc" || $category == "home_menu_mobile" || $category == "home_bottom_menu_pc" || $category == "home_bottom_menu_mobile") {
            require_once __DIR__ . "/Widget/data/HomeMenu.php";
            $class = new HomeMenu();
            $object = $class->getValue($bind_param, $bind_loop_list);
        }

        if ($category == "home_index_bread_pc") {
            require_once __DIR__ . "/Widget/data/HomeIndexBread.php";
            $class = new HomeIndexBread();
            $object = $class->getValue($bind_param, $bind_loop_list);
        }

        if ($category == "home_index_products_pc" || $category == "home_index_products_mobile") {
            require_once __DIR__ . "/Widget/data/HomeIndexProducts.php";
            $class = new HomeIndexProducts();
            $object = $class->getValue($bind_param, $bind_loop_list);
        }
        if ($category == "home_index_products_list_pc" || $category == "home_index_products_list_mobile" || $category == "home_index_products_page_pc" || $category == "home_index_products_page_mobile") {
            require_once __DIR__ . "/Widget/data/HomeIndexProductsList.php";
            $class = new HomeIndexProductsList();
            $object = $class->getValue($bind_param, $bind_loop_list);
        }
        if ($category == "home_index_products_detail_pc" || $category == "home_index_products_detail_mobile") {
            require_once __DIR__ . "/Widget/data/HomeIndexProductsDetail.php";
            $class = new HomeIndexProductsDetail();
            $object = $class->getValue($bind_param, $bind_loop_list);
        }

        if ($category == "home_index_news_pc" || $category == "home_index_news_mobile") {
            require_once __DIR__ . "/Widget/data/HomeIndexNews.php";
            $class = new HomeIndexNews();
            $object = $class->getValue($bind_param, $bind_loop_list);
        }
        if ($category == "home_index_news_list_pc" || $category == "home_index_news_list_mobile" || $category == "home_index_news_page_pc" || $category == "home_index_news_page_mobile") {
            require_once __DIR__ . "/Widget/data/HomeIndexNewsList.php";
            $class = new HomeIndexNewsList();
            $object = $class->getValue($bind_param, $bind_loop_list);
        }
        if ($category == "home_index_news_detail_pc" || $category == "home_index_news_detail_mobile") {
            require_once __DIR__ . "/Widget/data/HomeIndexNewsDetail.php";
            $class = new HomeIndexNewsDetail();
            $object = $class->getValue($bind_param, $bind_loop_list);
        }

        if ($category == "home_index_business_pc" || $category == "home_index_business_mobile") {
            require_once __DIR__ . "/Widget/data/HomeIndexBusiness.php";
            $class = new HomeIndexBusiness();
            $object = $class->getValue($bind_param, $bind_loop_list);
        }
        if ($category == "home_index_business_list_pc" || $category == "home_index_business_list_mobile" || $category == "home_index_business_page_pc" || $category == "home_index_business_page_mobile") {
            require_once __DIR__ . "/Widget/data/HomeIndexBusinessList.php";
            $class = new HomeIndexBusinessList();
            $object = $class->getValue($bind_param, $bind_loop_list);
        }
        if ($category == "home_index_business_detail_pc" || $category == "home_index_business_detail_mobile") {
            require_once __DIR__ . "/Widget/data/HomeIndexBusinessDetail.php";
            $class = new HomeIndexBusinessDetail();
            $object = $class->getValue($bind_param, $bind_loop_list);
        }

        if ($category == "home_index_album_pc" || $category == "home_index_album_mobile") {
            require_once __DIR__ . "/Widget/data/HomeIndexAlbum.php";
            $class = new HomeIndexAlbum();
            $object = $class->getValue($bind_param, $bind_loop_list);
        }
        if ($category == "home_index_album_list_pc" || $category == "home_index_album_list_mobile" || $category == "home_index_album_page_pc" || $category == "home_index_album_page_mobile") {
            require_once __DIR__ . "/Widget/data/HomeIndexAlbumList.php";
            $class = new HomeIndexAlbumList();
            $object = $class->getValue($bind_param, $bind_loop_list);
        }
        if ($category == "home_index_album_detail_pc" || $category == "home_index_album_detail_mobile") {
            require_once __DIR__ . "/Widget/data/HomeIndexAlbumDetail.php";
            $class = new HomeIndexAlbumDetail();
            $object = $class->getValue($bind_param, $bind_loop_list);
        }

        if ($category == "home_index_job_pc" || $category == "home_index_job_mobile") {
            require_once __DIR__ . "/Widget/data/HomeIndexJob.php";
            $class = new HomeIndexJob();
            $object = $class->getValue($bind_param, $bind_loop_list);
        }
        if ($category == "home_index_job_list_pc" || $category == "home_index_job_list_mobile" || $category == "home_index_job_page_pc" || $category == "home_index_job_page_mobile") {
            require_once __DIR__ . "/Widget/data/HomeIndexJobList.php";
            $class = new HomeIndexJobList();
            $object = $class->getValue($bind_param, $bind_loop_list);
        }
        if ($category == "home_index_job_detail_pc" || $category == "home_index_job_detail_mobile") {
            require_once __DIR__ . "/Widget/data/HomeIndexJobDetail.php";
            $class = new HomeIndexJobDetail();
            $object = $class->getValue($bind_param, $bind_loop_list);
        }

        if ($category == "home_index_message_pc" || $category == "home_index_message_mobile") {
            require_once __DIR__ . "/Widget/data/HomeIndexMessage.php";
            $class = new HomeIndexMessage();
            $object = $class->getValue($bind_param, $bind_loop_list);
        }
        if ($category == "home_index_message_list_pc" || $category == "home_index_message_list_mobile") {
            require_once __DIR__ . "/Widget/data/HomeIndexMessageList.php";
            $class = new HomeIndexMessageList();
            $object = $class->getValue($bind_param, $bind_loop_list);
        }

        if ($category == "home_index_search_pc" || $category == "home_index_search_mobile") {
            require_once __DIR__ . "/Widget/data/HomeIndexSearch.php";
            $class = new HomeIndexSearch();
            $object = $class->getValue($bind_param, $bind_loop_list);
        }
        if ($category == "home_index_search_list_pc" || $category == "home_index_search_list_mobile") {
            require_once __DIR__ . "/Widget/data/HomeIndexSearchList.php";
            $class = new HomeIndexSearchList();
            $object = $class->getValue($bind_param, $bind_loop_list);
        }

        if ($category == "home_index_case_pc" || $category == "home_index_case_mobile") {
            require_once __DIR__ . "/Widget/data/HomeIndexCase.php";
            $class = new HomeIndexCase();
            $object = $class->getValue($bind_param, $bind_loop_list);
        }
        if ($category == "home_index_case_list_pc" || $category == "home_index_case_list_mobile" || $category == "home_index_case_page_pc" || $category == "home_index_case_page_mobile") {
            require_once __DIR__ . "/Widget/data/HomeIndexCaseList.php";
            $class = new HomeIndexCaseList();
            $object = $class->getValue($bind_param, $bind_loop_list);
        }
        if ($category == "home_index_case_detail_pc" || $category == "home_index_case_detail_mobile") {
            require_once __DIR__ . "/Widget/data/HomeIndexCaseDetail.php";
            $class = new HomeIndexCaseDetail();
            $object = $class->getValue($bind_param, $bind_loop_list);
        }

        if ($category == "home_index_links_pc" || $category == "home_index_links_mobile") {
            require_once __DIR__ . "/Widget/data/HomeIndexLinks.php";
            $class = new HomeIndexLinks();
            $object = $class->getValue($bind_param, $bind_loop_list);
        }

        if ($category == "home_index_brief_pc" || $category == "home_index_brief_mobile") {
            require_once __DIR__ . "/Widget/data/HomeIndexBrief.php";
            $class = new HomeIndexBrief();
            $object = $class->getValue($bind_param, $bind_loop_list);
        }
        if ($category == "home_index_brief_list_pc" || $category == "home_index_brief_list_mobile" || $category == "home_index_brief_page_pc" || $category == "home_index_brief_page_mobile") {
            require_once __DIR__ . "/Widget/data/HomeIndexBriefList.php";
            $class = new HomeIndexBriefList();
            $object = $class->getValue($bind_param, $bind_loop_list);
        }
        if ($category == "home_index_brief_detail_pc" || $category == "home_index_brief_detail_mobile") {
            require_once __DIR__ . "/Widget/data/HomeIndexBriefDetail.php";
            $class = new HomeIndexBriefDetail();
            $object = $class->getValue($bind_param, $bind_loop_list);
        }

        if ($category == "home_index_contactus_pc" || $category == "home_index_contactus_mobile") {
            require_once __DIR__ . "/Widget/data/HomeIndexContactUs.php";
            $class = new HomeIndexContactUs();
            $object = $class->getValue($bind_param, $bind_loop_list);
        }
        if ($category == "home_index_contactus_list_pc" || $category == "home_index_contactus_list_mobile" || $category == "home_index_contactus_page_pc" || $category == "home_index_contactus_page_mobile") {
            require_once __DIR__ . "/Widget/data/HomeIndexContactUsList.php";
            $class = new HomeIndexContactUsList();
            $object = $class->getValue($bind_param, $bind_loop_list);
        }
        if ($category == "home_index_contactus_detail_pc" || $category == "home_index_contactus_detail_mobile") {
            require_once __DIR__ . "/Widget/data/HomeIndexContactUsDetail.php";
            $class = new HomeIndexContactUsDetail();
            $object = $class->getValue($bind_param, $bind_loop_list);
        }

        return $object;
    }
}