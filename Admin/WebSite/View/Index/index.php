<?php
require_once dirname(dirname(dirname(__DIR__))) . '/Index/View/Index/header.php';
?>
<div style="padding:15px;">
<div class="main_title">站点管理</div>
<a onclick="malltodoJs.sub_window('新建站点', '<?=TDU(TD_MODULE_NAME . "/" . TD_CONTROLLER_NAME . "/add")?>')" class="main_button">新建</a>
<div class="clear_5px"></div>
  <table width="100%" cellpadding="0" cellspacing="0" class="main_table">
    <tr class="main_table_header">
      <td>站点名称</td>
      <td>站点域名</td>
      <td width="100px">操作</td>
    </tr>

    <?php
    if (count($list) == 0) {
        echo '<tr><td colspan=3>尚未创建成员</td></tr>';
    } else {
        for ($i = 0; $i < count($list); $i = $i + 1) {
            echo "<tr>";
            echo "<td>" . $list[$i][WEBSITE::$website_name] . "</td>";
            echo "<td>" . $list[$i][WEBSITE::$website_host] . "</td>";
            $arr = array();
            $arr["id"] = $list[$i][WEBSITE::$id];
            echo "<td><a href=\"javascript:malltodoJs.sub_window('编辑', '" . TDU(TD_MODULE_NAME . "/" . TD_CONTROLLER_NAME . "/edit", $arr) . "')\">修改</a> <a href=\"javascript:malltodoJs.del('" . TDU(TD_MODULE_NAME . "/" . TD_CONTROLLER_NAME . "/del") . "','" . $list[$i][ADMIN::$id] . "')\">删除</a></td>";
            echo "</tr>";
        }
    }
    ?>
    </table>
</div>
<?php
require_once dirname(dirname(dirname(__DIR__))) . '/Index/View/Index/bottom.php';
?>