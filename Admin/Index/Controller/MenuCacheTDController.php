<?php
require_once 'CommonTDController.php';
require_once './Common/MenuCache.php';

class MenuCacheTDController extends CommonTDController
{

    public function index()
    {
        echo MenuCache::create(TDSESSION("website_id"));
        exit();
    }

    public function opt()
    {
        if (TD_IS_POST) {
            $opt = trim(TDI("post.opt"));
            $type = trim(TDI("post.type"));
            if (isset(MenuCache::$home_menu[$type]) && $type != "Index/Category/index") {
                $this->error("栏目类型有误");
                return;
            }
            $table_pid = trim(TDI("post.pid"));
            $table_id = trim(TDI("post.id"));
            $opt_value = trim(TDI("post.opt_value"));
            if ($opt == "add") {
                $this->add($type, $table_pid, $opt_value, TDSESSION("website_id"));
            } else {
                $this->edit($type, $table_id, $table_pid, $opt_value, TDSESSION("website_id"));
            }
            MenuCache::clean(TDSESSION("website_id"));
            $this->success("设置成功");
        }
    }

    public function hide()
    {
        if (TD_IS_POST) {
            $table_id = trim(TDI("post.id"));
            $where = array();
            $where[CATEGORY::$id] = array(
                "eq",
                table_id
            );
            $where[CATEGORY::$website_id] = array(
                "eq",
                session("website_id")
            );
            $data = array();
            $data[CATEGORY::$is_hidden] = 1;
            MU(CATEGORY::$_table_name)->where($where)->save($data);
            MenuCache::clean(TDSESSION("website_id"));
            $this->success("设置成功");
        }
    }

    public function show()
    {
        if (TD_IS_POST) {
            $table_id = trim(TDI("post.id"));
            $where = array();
            $where[CATEGORY::$id] = array(
                "eq",
                $table_id
            );
            $where[CATEGORY::$website_id] = array(
                "eq",
                TDSESSION("website_id")
            );
            $data = array();
            $data[CATEGORY::$is_hidden] = 0;
            MU(CATEGORY::$_table_name)->where($where)->save($data);
            MenuCache::clean(TDSESSION("website_id"));
            $this->success("设置成功");
        }
    }

    public function del()
    {
        if (TD_IS_POST) {
            $table_id = trim(TDI("post.id"));
            $where = array();
            $where[CATEGORY::$id] = array(
                "eq",
                $table_id
            );
            $where[CATEGORY::$website_id] = array(
                "eq",
                TDSESSION("website_id")
            );
            $info = MU(CATEGORY::$_table_name)->where($where)->find();
            if ($info != null && info[CATEGORY::$pid] == "0") { // pid=0时，只有"Index/Category/index"可删除
                $type = $info[CATEGORY::$type];
                if ($type != "Index/Category/index") {
                    $this->error("该栏目只允许隐藏，不能允许删除");
                    return;
                }
            }
            $data = array();
            $data[CATEGORY::$is_del] = 1;
            MU(CATEGORY::$_table_name)->where($where)->save($data);
            // 该栏目的下级子栏目上移一级
            $where = array();
            $where[CATEGORY::$pid] = array(
                "eq",
                $table_id
            );
            $where[CATEGORY::$website_id] = array(
                "eq",
                TDSESSION("website_id")
            );
            $data = array();
            $data[CATEGORY::$pid] = $info[CATEGORY::$pid];
            MU(CATEGORY::$_table_name)->where($where)->save($data);
            MenuCache::clean(TDSESSION("website_id"));
            $this->success("设置成功");
        }
    }

    public function adjust()
    {
        if (TD_IS_POST) {
            $ids = TDI("post.ids");
            $ids = htmlspecialchars_decode(ids);
            $list = json_decode($ids, true);
            for ($i = 0; $i < count($list); $i = $i + 1) {
                $id = $list[$i];
                if ($id == 0) {
                    continue;
                } else {
                    $where = array();
                    $where[CATEGORY::$id] = array(
                        "eq",
                        $id
                    );
                    $where[CATEGORY::$website_id] = array(
                        "eq",
                        TDSESSION("website_id")
                    );
                    $data = array();
                    $data[CATEGORY::$sort] = $i;
                    MU(CATEGORY::$_table_name)->where($where)->save($data);
                }
            }
            MenuCache::clean(TDSESSION("website_id"));
            $this->success("调整成功");
        }
    }

    private function add($type, $table_pid, $category_name, $website_id)
    {
        // 一个type只允许存在一个pid=0的数据，Index/Category/index类型的除外
        if (($table_pid == "0" || $table_pid == "") && $type != "Index/Category/index") {
            $table_pid = "0";
            $where = array();
            $where[CATEGORY::$pid] = array(
                "eq",
                table_pid
            );
            $where[CATEGORY::$is_del] = array(
                "eq",
                0
            );
            $where[CATEGORY::$type] = array(
                "eq",
                type
            );
            $where[CATEGORY::$website_id] = array(
                "eq",
                website_id
            );
            $info = MU(CATEGORY::$_table_name)->where($where)->find();
            if ($info == null) {
                $data = array();
                $data[CATEGORY::$category_name] = $category_name;
                $data[CATEGORY::$pid] = $table_pid;
                $data[CATEGORY::$type] = $type;
                $data[CATEGORY::$website_id] = $website_id;
                MU(CATEGORY::$_table_name)->data($data)->add();
            }
        } else {
            $data = array();
            $data[CATEGORY::$category_name] = $category_name;
            $data[CATEGORY::$pid] = $table_pid;
            $data[CATEGORY::$type] = $type;
            $data[CATEGORY::$website_id] = $website_id;
            MU(CATEGORY::$_table_name)->data($data)->add();
        }
    }

    private function edit($type, $table_id, $table_pid, $category_name, $website_id)
    {
        if ($table_id == "") {
            $table_id = "0";
        }
        if ($table_pid == "") {
            $table_pid == "0";
        }
        $where = array();
        $where[CATEGORY::$id] = array(
            "eq",
            table_id
        );
        $where[CATEGORY::$type] = array(
            "eq",
            type
        );
        $where[CATEGORY::$website_id] = array(
            "eq",
            website_id
        );
        $info = MU(CATEGORY::$_table_name)->where($where)->find();
        if ($info == null) {
            $this->add($type, $table_pid, $category_name, $website_id);
        } else {
            $data = array();
            $data["category_name"] = $category_name;
            $data["pid"] = $table_pid;
            $data[CATEGORY::$website_id] = $website_id;
            MU(CATEGORY::$_table_name)->where($where)->save($data);
        }
    }
}