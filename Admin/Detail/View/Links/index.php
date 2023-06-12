<?php
require_once dirname(dirname(dirname(__DIR__))) . '/Index/View/Index/header.php';
?>
<div style="padding:15px;">
<div class="main_title"><?=$page_action?>管理</div><a target="_blank" class="note_marker" href="<?=DocU(TD_MODULE_NAME . "/" . TD_CONTROLLER_NAME . "/". TD_ACTION_NAME) ?>">(操作指南)</a>
<a onclick="malltodoJs.sub_window('新建<?=$page_action?>', '<?=TDU(TD_MODULE_NAME . "/" . TD_CONTROLLER_NAME . "/add")?>')" class="main_button">新建</a>
<div class="clear_5px"></div>
  <table width="100%" cellpadding="0" cellspacing="0" class="main_table">
    <tr class="main_table_header">
      <td width="100px">图片</td>
      <td>名称</td>
      <td>跳转链接</td>
      <td width="100px">操作</td>
    </tr>
    <?php
    if (count($list) == 0) {
        echo "<tr><td colspan=4>尚未创建任何信息</td></tr>";
    } else {
        for ($i = 0; $i < count($list); $i = $i + 1) {
            $jsonObject = $list[$i];
            echo "<tr>";
            echo "<td><img src='" . $jsonObject[LINKS::$pic] . "' width='90px' height='40px' /></td>";
            echo "<td>" . $jsonObject[LINKS::$name] . "</td>";
            echo "<td>" . $jsonObject[LINKS::$url] . "</td>";
            echo "<td><a href=\"javascript:malltodoJs.sub_window('编辑', '" . TDU(TD_MODULE_NAME . "/" . TD_CONTROLLER_NAME . "/edit", array(
                "id" => $jsonObject["id"]
            )) . "')\">修改</a> <a href=\"javascript:malltodoJs.del('" . TDU(TD_MODULE_NAME . "/" . TD_CONTROLLER_NAME . "/del") . "','" . $jsonObject["id"] . "')\">删除</a></td>";
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