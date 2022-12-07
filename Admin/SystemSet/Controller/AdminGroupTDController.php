<?php
require_once dirname(dirname(__DIR__)) . '/Index/Controller/CommonTDController.php';

class AdminGroupTDController extends CommonTDController
{

    public static function get_admin_group()
    {
        $arr = TDS("admin_group");
        if ($arr == null || ! $arr || count($arr) == 0) {
            $admin_group = new AdminGroupTDController();
            $admin_group->build_admin_group_cache();
        }
        $arr = TDS("admin_group");
        return $arr;
    }

    public function index()
    {
        $arr = self::get_admin_group();
        $this->assign("list", $arr);
        $this->display();
    }

    public function add()
    {
        $id = (int) TDI("get.id");
        $info = null;
        $where = array();
        if ($id) {
            $where[ADMIN_GROUP::$id] = array(
                "eq",
                $id
            );
            $where[ADMIN_GROUP::$is_del] = array(
                "eq",
                0
            );
            $info = TDORM(ADMIN_GROUP::$_table_name)->where($where)->find();
            if (! $info) {
                $this->error("不存在该信息或已被删除");
            }
        }
        if (TD_IS_POST) {
            $name = TDI("post." . ADMIN_GROUP::$name);
            if ($name == "") {
                $this->error("岗位名称不能为空");
            }
            $save_data = array();
            $save_data[ADMIN_GROUP::$name] = $name;
            $save_data[ADMIN_GROUP::$pid] = (int) TDI("post." . ADMIN_GROUP::$pid);
            $save_data[ADMIN_GROUP::$sort] = (int) TDI("post." . ADMIN_GROUP::$sort);
            if ($id) {
                if ($this->check($id, $save_data[ADMIN_GROUP::$pid])) {
                    TDORM(ADMIN_GROUP::$_table_name)->where($where)->save($save_data);
                    $this->build_admin_group_cache();
                    $this->success("修改成功");
                } else {
                    $this->error("您选择的上级岗位有误");
                }
            } else {
                TDORM(ADMIN_GROUP::$_table_name)->data($save_data)->add();
                $this->build_admin_group_cache();
                $this->success("添加成功");
            }
        } else {
            $this->assign("info", $info);
            $map = array();
            $map[0] = "顶级岗位";
            $admin_group = TDS("admin_group");
            for ($i = 0; $i < count($admin_group); $i = $i + 1) {
                $_id = $admin_group[$i][ADMIN_GROUP::$id];
                $_name = $admin_group[$i][ADMIN_GROUP::$name];
                $level = $admin_group[$i]["level"];
                $_name = "——" . $_name;
                for ($n = 0; $n < $level; $n = $n + 1) {
                    $_name = "——" . $_name;
                }
                $map[$_id] = $_name;
            }
            $this->assign("map", $map);
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
            $id = (int) trim(TDI("post.id"));
            $where = array();
            $where[ADMIN_GROUP::$id] = array(
                "eq",
                $id
            );
            $where[ADMIN_GROUP::$is_del] = array(
                "eq",
                0
            );
            $category_info = TDORM(ADMIN_GROUP::$_table_name)->where($where)->find();
            if (! $category_info) {
                $this->error("该岗位不存加或已被删除");
            }
            $pid = $category_info[ADMIN_GROUP::$pid];

            TDORM()->startTrans();
            // 删除当前栏目
            $ret1 = TDORM(ADMIN_GROUP::$_table_name)->where($where)->save(array(
                ADMIN_GROUP::$is_del => 1
            ));
            // 将当前栏目的子栏目的父级栏目设置为当前栏目的父栏目
            $where = array();
            $where[ADMIN_GROUP::$pid] = array(
                "eq",
                $id
            );
            $ret2 = TDORM(ADMIN_GROUP::$_table_name)->where($where)->save(array(
                ADMIN_GROUP::$pid => $pid
            ));

            if ($ret1 === false || $ret2 === false) {
                TDORM()->rollback();
                $this->error("删除失败");
            } else {
                TDORM()->commit();
                $this->build_admin_group_cache();
                $this->success("删除成功");
            }
        }
    }

    private $admin_group_arr = array();

    public function build_admin_group_cache()
    {
        $this->admin_group_arr = array();
        $this->get_admin_group_structure(0, 0);
        TDS("admin_group", $this->admin_group_arr);
    }

    public function get_admin_group_structure($pid, $level)
    {
        $where = array();
        $where[ADMIN_GROUP::$pid] = array(
            "eq",
            $pid
        );
        $where[ADMIN_GROUP::$is_del] = array(
            "eq",
            0
        );
        $_list = TDORM(ADMIN_GROUP::$_table_name)->where($where)
            ->order(ADMIN_GROUP::$sort . " asc, " . ADMIN_GROUP::$id . " asc")
            ->select();
        $arr = array();
        for ($i = 0; $i < count($_list); $i = $i + 1) {
            $_list[$i]["level"] = $level;
            array_push($this->admin_group_arr, $_list[$i]);
            $_list[$i]["subcategorys"] = $this->get_admin_group_structure($_list[$i][ADMIN_GROUP::$id], $level + 1);
            array_push($arr, $_list[$i]);
        }
        return $arr;
    }

    private function check($id, $pid)
    {
        $id = (int) trim($id);
        $pid = (int) trim($pid);
        if ($id == $pid) {
            return false;
        }
        while (true) {
            $where = array();
            $where[ADMIN_GROUP::$id] = array(
                "eq",
                $pid
            );
            $where[ADMIN_GROUP::$is_del] = array(
                "eq",
                0
            );
            $_pid = TDORM(ADMIN_GROUP::$_table_name)->where($where)->getField(ADMIN_GROUP::$pid);
            if ($_pid == null) {
                return true;
            }
            if ($_pid == 0) {
                return true;
            }
            if ($_pid == $id) {
                return false;
            }
            $pid = $_pid;
        }
    }
}