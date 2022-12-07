<?php
require_once dirname(dirname(dirname(__DIR__))) . '/Index/View/Index/header.php';
?>
<div style="padding:15px;">
<div class="main_title">成员管理</div>
<a onclick="phptodo.sub_window('新建成员', '<?=TDU("SystemSet/Admin/add")?>')" class="main_button">新建</a>
<div class="clear_5px"></div>
  <table width="100%" cellpadding="0" cellspacing="0" class="main_table">
    <tr class="main_table_header">
      <td>登录用户名</td>
      <td>所在岗位</td>
      <td>联系方式</td>
      <td width="100px">操作</td>
    </tr>

    <?php
    if (count($list) == 0) {
        echo '<tr><td colspan=4>尚未创建成员</td></tr>';
    } else {
        for ($i = 0; $i < count($list); $i = $i + 1) {
            echo "<tr>";
            echo "<td>" . $list[$i][ADMIN::$username] . "</td>";
            echo "<td>" . $list[$i]["group_name"] . "</td>";
            echo "<td>" . $list[$i][ADMIN::$mobile] . "</td>";
            $arr = array();
            $arr["id"] = $list[$i][ADMIN::$id];
            echo "<td><a href=\"javascript:phptodo.sub_window('编辑', '" . TDU("SystemSet/Admin/edit", $arr) . "')\">修改</a> <a href=\"javascript:phptodo.del('" . TDU("SystemSet/Admin/del") . "','" . $list[$i][ADMIN::$id] . "')\">删除</a></td>";
            echo "</tr>";
        }
    }
    ?>
    </table>
</div>
<?php
require_once dirname(dirname(dirname(__DIR__))) . '/Index/View/Index/bottom.php';
?>