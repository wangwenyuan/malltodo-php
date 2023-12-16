<?php
require_once dirname(dirname(dirname(__DIR__))) . '/Index/View/Index/header.php';
?>
<div style="padding:15px;">
<div class="main_title">表单管理</div><a target="_blank" class="note_marker" href="<?=DocU(TD_MODULE_NAME . "/" . TD_CONTROLLER_NAME . "/". TD_ACTION_NAME) ?>">(操作指南)</a>
<a onclick="malltodoJs.sub_window('新建表单', '<?=TDU(TD_MODULE_NAME . "/" . TD_CONTROLLER_NAME . "/add")?>')" class="main_button">新建</a>
<div class="clear_5px"></div>
  <table width="100%" cellpadding="0" cellspacing="0" class="main_table">
    <tr class="main_table_header">
      <td>表单名称</td>
      <td>表名称</td>
      <td>字段管理</td>
      <td>表单链接</td>
      <td width="100px">操作</td>
    </tr>

    <?php
    if (count($list) == 0) {
        echo '<tr><td colspan=5>尚未创建表单</td></tr>';
    } else {
        for ($i = 0; $i < count($list); $i = $i + 1) {
            echo "<tr>";
            echo "<td>" . $list[$i][FORM::$name] . "</td>";
            echo "<td>" . $list[$i][FORM::$table_name] . "</td>";
            echo "<td><a href=\"javascript:malltodoJs.max_sub_window('编辑', '" . TDU(TD_MODULE_NAME . "/FormField/index", array("fid"=>$list[$i][FORM::$id])) . "')\">字段管理</a> </td>";
            echo "<td><a target='_blank' href=\"".TDUU("Index/Form/index", array('id'=>$list[$i][FORM::$id]), 'index.php')."\" />表单链接</td>";
            $arr = array();
            $arr["id"] = $list[$i][FORM::$id];
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