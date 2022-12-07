<?php

function MU($table_name = "")
{
    return new MU($table_name);
}

class MU extends TDORM
{

    public function data($array)
    {
        if ($array == null || empty($array) || ! isset($array["id"]) || $array["id"] == "") {
            $id = Malltodo::get_unique_id();
            $array["id"] = $id;
        }
        return parent::data($array);
    }
}