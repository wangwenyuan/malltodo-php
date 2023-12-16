<?php
require_once dirname(dirname(dirname(__DIR__))) . '/Index/View/Index/header.php';
?>
<div style="padding:15px;">
<div class="main_title">表单内容</div><a target="_blank" class="note_marker" href="<?=DocU(TD_MODULE_NAME . "/" . TD_CONTROLLER_NAME . "/". TD_ACTION_NAME) ?>">(操作指南)</a>
<div class="clear_5px"></div>
  <table width="100%" cellpadding="0" cellspacing="0" class="main_table">
    <tr class="main_table_header">
      <td>表单名称</td>
      <td width="100px">查看内容</td>
    </tr>

    <?php
    if (count($list) == 0) {
        echo '<tr><td colspan=2>尚未创建表单</td></tr>';
    } else {
        for ($i = 0; $i < count($list); $i = $i + 1) {
            echo "<tr>
            		  <td>".$list[$i]['name']."</td>
            		  <td><a href=\"javascript:malltodoJs.max_sub_window('".$list[$i]['name']."', '" . TDU(TD_MODULE_NAME . "/" . TD_CONTROLLER_NAME . "/lists", array('fid'=>$list[$i][FORM::$id])) . "')\">查看内容</a></td>
          		  </tr>";
        }
    }
    ?>
    </table>
</div>
<?php
require_once dirname(dirname(dirname(__DIR__))) . '/Index/View/Index/bottom.php';
?>