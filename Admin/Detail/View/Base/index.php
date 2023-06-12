<?php
require_once dirname(dirname(dirname(__DIR__))) . '/Index/View/Index/header.php';
?>
<div style="padding:15px;">
<div class="main_title"><?=$page_action?>管理</div><a target="_blank" class="note_marker" href="<?=DocU(TD_MODULE_NAME . "/" . TD_CONTROLLER_NAME . "/". TD_ACTION_NAME) ?>">(操作指南)</a>
<a onclick="malltodoJs.sub_window('新建<?=$page_action?>', '<?=TDU(TD_MODULE_NAME . "/" . TD_CONTROLLER_NAME . "/add")?>')" class="main_button">新建</a>

<div style="clear: both;">
	<form method="GET" action="<?=TDU(TD_MODULE_NAME . '/' . TD_CONTROLLER_NAME . '/' . TD_ACTION_NAME)?>" id="search_form">
		<input type="hidden" name="m" value="<?=TD_MODULE_NAME?>">
		<input type="hidden" name="c" value="<?=TD_CONTROLLER_NAME?>">
		<input type="hidden" name="a" value="<?=TD_ACTION_NAME?>">

		<div style="float: left; margin-top:5px; margin-bottom:5px;">
			<input placeholder="标题关键字" name="title" value="<?=TDI('get.' . DETAIL::$title)?>" type="text" class="input_text" style="float: left;margin-right: 10px;width: 240px;">
		</div>

		<div style="float: left; margin-top:5px; margin-bottom:5px; margin-right:10px;">
			<?=TDWIDGET::select(DETAIL::$category_id, TDI('get.' . DETAIL::$category_id), $category_map)?>
		</div>

		<div style="float: left;  margin-top:5px; margin-bottom:5px;">
			<a class="main_button" style="float: left;" value="查询" type="submit" id="search_btn">查询</a>
		</div>
	</form>
</div>

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