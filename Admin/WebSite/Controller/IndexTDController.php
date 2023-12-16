<?php
require_once dirname(dirname(__DIR__)) . '/Index/Controller/CommonTDController.php';

class IndexTDController extends CommonTDController
{

    public function index()
    {
        $where = array();
        $where[WEBSITE::$is_del] = array(
            "eq",
            0
        );
        $count = MU(WEBSITE::$_table_name)->where($where)->count();
        $page = new TDPAGE($count, 16);
        $list = TDORM(WEBSITE::$_table_name)->where($where)
            ->limit($page->firstRow . "," . $page->listRows)
            ->order(WEBSITE::$id . " desc")
            ->select();
        $this->assign("list", $list);
        $this->assign("page", $page->show());
        $this->display();
    }

    public function add()
    {
        $id = trim(TDI("get." . WEBSITE::$id));
        $where = array();
        $info = array();
        if ($id != "") {
            $where[WEBSITE::$id] = array(
                "eq",
                $id
            );
            $where[WEBSITE::$is_del] = array(
                "eq",
                0
            );
            $info = MU(WEBSITE::$_table_name)->where($where)->find();
            if (! $info) {
                $this->error("该站点不存在或已被删除");
                return;
            }
        }
        if (TD_IS_POST) {
            $website_name = trim(TDI("post." . WEBSITE::$website_name));
            $website_host = trim(TDI("post." . WEBSITE::$website_host));
            $website_host = str_replace("http://", "", $website_host);
            $website_host = str_replace("https://", "", $website_host);

            if ($website_name == "") {
                $this->error("站点名称不能为空");
                return;
            }
            if ($website_host == "") {
                $this->error("站点域名不能为空");
                return;
            }

            // 判断该域名是否存在
            $check_where = array();
            $check_where[WEBSITE::$is_del] = array(
                "eq",
                0
            );
            $check_where[WEBSITE::$website_host] = array(
                "eq",
                $website_host
            );
            if ($id != "") {
                $check_where[WEBSITE::$id] = array(
                    "neq",
                    $id
                );
            }
            $checkInfo = MU(WEBSITE::$_table_name)->where($check_where)->find();
            if ($checkInfo) {
                $this->error("该域名已存在");
                return;
            }

            $data = array();
            $data[WEBSITE::$website_name] = $website_name;
            $data[WEBSITE::$website_host] = $website_host;
            $data[WEBSITE::$statistics_code] = trim(TDI("post." . WEBSITE::$statistics_code));
            $data[WEBSITE::$admin_id] = TDSESSION("admin_id");

            if ($id == "") {
                $data[WEBSITE::$addtime] = time();
                MU(WEBSITE::$_table_name)->data($data)->add();
                TDS("website_cache", null); // 清空缓存
                //清理模板缓存
                PageCache::clearPageCache();
                $this->success("添加成功");
                return;
            } else {
                MU(WEBSITE::$_table_name)->where($where)->save($data);
                TDS("website_cache", null); // 清空缓存
                //清理模板缓存
                PageCache::clearPageCache();
                $this->success("修改成功");
                return;
            }
        } else {
            $this->assign("info", $info);
            $this->display("add");
        }
    }

    public function edit()
    {
        $this->add();
    }

    public function del()
    {
        if (TD_IS_POST) {
            $id = trim(TDI("post." . WEBSITE::$id));
            $where = array();
            $where[WEBSITE::$id] = array(
                "eq",
                $id
            );
            $data = array();
            $data[WEBSITE::$is_del] = 1;
            MU(WEBSITE::$_table_name)->where($where)->save($data);
            if (TDSESSION("website_id") == $id) {
                TDSESSION("website_id", null);
            }
            TDS("website_cache", null); // 清空缓存
            //清理模板缓存
            PageCache::clearPageCache();
            $this->success("删除成功");
            return;
        }
    }

    public function switch_websites()
    {
        if (TD_IS_POST) {
            $website_id = TDI("post.website_id");
            $where = array();
            $where[WEBSITE::$id] = array(
                "eq",
                $website_id
            );
            $where[WEBSITE::$is_del] = array(
                "eq",
                0
            );
            $website_info = MU(WEBSITE::$_table_name)->where($where)->find();
            if ($website_info == null) {
                $this->error("该站点不存在或已被删除");
            } else {
                TDSESSION("website_id", $website_id);
                $this->success("站点切换成功");
            }
        }
    }
}