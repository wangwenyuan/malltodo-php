<?php
require_once dirname(dirname(dirname(__DIR__))) . '/Index/View/Index/header.php';
?>
<div style="padding:15px;">
<div class="main_title">权限分配</div><a target="_blank" class="note_marker" href="<?=DocU(TD_MODULE_NAME . "/" . TD_CONTROLLER_NAME . "/". TD_ACTION_NAME) ?>">(操作指南)</a>
<a onclick="malltodoJs.sub_window('新建', '<?=TDU(TD_MODULE_NAME . "/" . TD_CONTROLLER_NAME . "/add")?>')" class="main_button">新建</a>
<div class="clear_5px"></div>
  <table width="100%" cellpadding="0" cellspacing="0" class="main_table">
    <tr class="main_table_header">
      <td>名称</td>
      <td width="100px">权限设置</td>
      <td width="100px">操作</td>
    </tr>
    <?php
    if (count($list) == 0) {
        echo "<tr><td colspan=3>尚未创建任何内容</td></tr>";
    } else {
        for ($i = 0; $i < count($list); $i = $i + 1) {
            echo "<tr>";
            echo "<td>" . $list[$i][ROLE::$role_name] . "</td>";
            $auth_url = TDU(TD_MODULE_NAME . "/Auth/index", array(
                "rid" => $list[$i][ROLE::$id]
            ));
            echo "<td><a href=\"javascript:malltodoJs.sub_window('权限设置', '" . $auth_url . "')\">权限设置</a></td>";
            $edit_url = TDU(TD_MODULE_NAME . "/" . TD_CONTROLLER_NAME . "/edit", array(
                "id" => $list[$i][ROLE::$id]
            ));
            $del_url = TDU(TD_MODULE_NAME . "/" . TD_CONTROLLER_NAME . "/del");
            echo "<td><a href=\"javascript:malltodoJs.sub_window('编辑', '" . $edit_url . "')\">修改</a> <a href=\"javascript:malltodoJs.del('" . $del_url . "','" . $list[$i]["id"] . "')\">删除</a></td>";
            echo "</tr>";
        }
    }
    ?>
    </table>
    <div class="page"><?=$page?></div>
</div>
<?php
require_once dirname(dirname(dirname(__DIR__))) . '/Index/View/Index/bottom.php';
?>