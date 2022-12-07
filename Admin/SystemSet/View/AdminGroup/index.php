<?php
require_once dirname(dirname(dirname(__DIR__))) . '/Index/View/Index/header.php';
?>
<div style="padding:15px;">
<div class="main_title">岗位管理</div>
<a onclick="phptodo.sub_window('新建岗位', '<?=TDU("SystemSet/AdminGroup/add")?>')" class="main_button">新建</a>
<div class="clear_5px"></div>
  <table width="100%" cellpadding="0" cellspacing="0" class="main_table">
    <tr class="main_table_header">
      <td>岗位名称</td>
      <td width="100px">排序</td>
      <td width="100px">权限设置</td>
      <td width="100px">操作</td>
    </tr>
    <?php
    if (count($list) == 0) {
        echo "<tr><td colspan=4>尚未创建岗位</td></tr>";
    }
    for ($i = 0; $i < count($list); $i = $i + 1) {
        echo "<tr>";
        $level = $list[$i]["level"];
        $name = $list[$i][ADMIN_GROUP::$name];
        $name = " " . $name;
        for ($n = 0; $n < $level; $n = $n + 1) {
            $name = "——" . $name;
        }
        echo "<td>" . $name . "</td>";
        echo "<td>" . $list[$i][ADMIN_GROUP::$sort] . "</td>";
        $param = array();
        $param["gid"] = $list[$i][ADMIN_GROUP::$id];
        echo "<td><a href=\"javascript:phptodo.sub_window('权限设置', '" . TDU("SystemSet/Role/index", $param) . "')\">权限设置</a></td>";
        $param = array();
        $param["id"] = $list[$i][ADMIN_GROUP::$id];
        echo "<td><a href=\"javascript:phptodo.sub_window('编辑', '" . TDU("SystemSet/AdminGroup/edit", $param) . "')\">修改</a> <a href=\"javascript:phptodo.del('" . TDU("SystemSet/AdminGroup/del") . "','" . $list[$i][ADMIN_GROUP::$id] . "')\">删除</a></td>";
        echo "</tr>";
    }
    ?>
    </table>
</div>
<?php
require_once dirname(dirname(dirname(__DIR__))) . '/Index/View/Index/bottom.php';
?>