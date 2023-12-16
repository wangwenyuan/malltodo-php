<?php

class CommonTDController extends TDCONTROLLER
{

    public function _td_init()
    {
        $website_id = get_home_website_id();
        if(TD_IS_POST){
            foreach($_POST as $k=>$v){
                $v = str_replace("\n", "", $v);
                $v = str_replace("\r", "", $v);
                $_POST[$k] = $v;
            }
        }
        if (TD_MODULE_NAME == "Index" && TD_CONTROLLER_NAME == "Index" && (TD_ACTION_NAME == "login" || TD_ACTION_NAME == "signOut" || TD_ACTION_NAME == "verify")) {
            return true;
        } else {
            if (TDSESSION("admin_id")) {
                if(TD_MODULE_NAME == "Index" && TD_CONTROLLER_NAME == "RebuildCache"){
                    return true;
                }
                return $this->auth();
            } else {
                TDREDIRECT(TDU("Index/Index/login"));
            }
        }
    }

    private function auth()
    {
        $role_id = TDSESSION("role_id");
        if ($role_id == "" || $role_id == "0") {
            return true;
        }
        if (TD_MODULE_NAME == "Renovation" && TD_ACTION_NAME == "pageConfig") {
            return true;
        }
        if (TD_MODULE_NAME == "SystemSet" && TD_CONTROLLER_NAME == "Admin" && TD_ACTION_NAME == "material") {
            return true;
        }

        if (TD_MODULE_NAME == "Index" && TD_CONTROLLER_NAME == "Index" && TD_ACTION_NAME == "index") {
            return true;
        }

        $where = array();
        $where[ROLE_AUTH::$role_id] = array(
            "eq",
            $role_id
        );
        $where[ROLE_AUTH::$m] = array(
            "eq",
            TD_MODULE_NAME
        );
        $where[ROLE_AUTH::$c] = array(
            "eq",
            TD_CONTROLLER_NAME
        );
        $where[ROLE_AUTH::$a] = array(
            "eq",
            TD_ACTION_NAME
        );
        $info = TDORM(ROLE_AUTH::$_table_name)->where($where)->find();
        if (! $info) {
            $this->error("您没有该权限，无法执行此操作");
            return false;
        } else {
            return true;
        }
    }
}