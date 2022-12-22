<?php
require_once dirname(dirname(dirname(__DIR__))) . '/Index/View/Index/header.php';
?>
<div style="padding:15px;">
<div class="main_title"><?=$page_action?>管理</div>
<a onclick="malltodoJs.sub_window('新建<?=$page_action?>', '<?=TDU(TD_MODULE_NAME . "/" . TD_CONTROLLER_NAME . "/add")?>')" class="main_button">新建</a>
<div class="clear_5px"></div>
  <table width="100%" cellpadding="0" cellspacing="0" class="main_table">
    <tr class="main_table_header">
      <td>标题</td>
      <td>所属栏目</td>
      <td>发布时间</td>
      <td>排序</td>
      <td width="100px">操作</td>
    </tr>

    <?php
    if (count($list) == 0) {
        echo "<tr><td colspan=5>尚未创建任何信息</td></tr>";
    } else {
        for ($i = 0; $i < count($list); $i = $i + 1) {
            $jsonObject = $list[$i];
            echo "<tr>";
            echo "<td>" . $jsonObject[DETAIL::$title] . "</td>";
            echo "<td>" . $jsonObject[CATEGORY::$category_name] . "</td>";
            echo "<td>" . date("Y-m-d H:i:s", $jsonObject[DETAIL::$release_time]) . "</td>";
            echo "<td>" . $jsonObject[CATEGORY::$sort] . "</td>";
            $edit_url = TDU(TD_MODULE_NAME . "/" . TD_CONTROLLER_NAME . "/edit", array(
                "id" => $jsonObject["id"]
            ));
            $del_url = TDU(TD_MODULE_NAME . "/" . TD_CONTROLLER_NAME . "/del");
            echo "<td><a href=\"javascript:malltodoJs.sub_window('编辑', '" . $edit_url . "')\">修改</a> <a href=\"javascript:malltodoJs.del('" . $del_url . "','" . $jsonObject[DETAIL::$id] . "')\">删除</a></td>";
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