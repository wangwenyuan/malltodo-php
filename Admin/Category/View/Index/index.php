<?php
require_once dirname(dirname(dirname(__DIR__))) . '/Index/View/Index/header.php';
?>
<style>
.ui-c-element {
    width: 3rem;
}
.ui-c-input{
	text-align: center;
	padding-left: 0;
}
</style>
<div style="padding:15px;">
<div class="main_title">栏目设置</div>
<a onclick="malltodoJs.max_sub_window('新建栏目', '<?=TDU(TD_MODULE_NAME . "/" . TD_CONTROLLER_NAME . "/add")?>')" class="main_button">新建</a>
<div class="clear_5px"></div>
  <table width="100%" cellpadding="0" cellspacing="0" class="main_table">
    <tr class="main_table_header">
      <td>栏目名称</td>
      <td>类型</td>
      <td>是否隐藏</td>
      <td>排序</td>
      <td width="200px">操作</td>
    </tr>

    <?php
    if (count($list) == 0) {
        echo '<tr><td colspan=5>尚未创建成员</td></tr>';
    } else {
        for ($i = 0; $i < count($list); $i = $i + 1) {
            $jsonObject = $list[$i];
            echo "<tr>";
            $sign = "";
            for ($n = 0; $n < $jsonObject["level"]; $n = $n + 1) {
                $sign = $sign . "——";
            }
            echo "<td>" . $sign . " " . $jsonObject[CATEGORY::$category_name] . "</td>";
            echo "<td>" . MenuCache::$home_menu[$jsonObject[CATEGORY::$type]] . "</td>";
            $is_hidden_word = "隐藏，<a href='javascript:adjust(\"" . $jsonObject[CATEGORY::$id] . "\")'>设置为显示</a>";
            if ($jsonObject[CATEGORY::$is_hidden] == "0") {
                $is_hidden_word = "显示，<a href='javascript:adjust(\"" . $jsonObject[CATEGORY::$id] . "\")'>设置为隐藏</a>";
            }
            echo "<td>" . $is_hidden_word . "</td>";
            echo "<td>" . TDWIDGET::text($jsonObject["id"] . "_" . CATEGORY::$sort, $jsonObject[CATEGORY::$sort]) . "</td>";
            $arr = array();
            $arr["id"] = $list[$i][WEBSITE::$id];
            if ($jsonObject[CATEGORY::$type] == "Index/Index/index") {
                echo "<td><a href=\"javascript:malltodoJs.max_sub_window('编辑', '" . TDU(TD_MODULE_NAME . "/" . TD_CONTROLLER_NAME . "/edit", $arr) . "')\">修改</a> <a href=\"javascript:malltodoJs.del('" . TDU(TD_MODULE_NAME . "/" . TD_CONTROLLER_NAME . "/del") . "','" . $list[$i][CATEGORY::$id] . "')\">删除</a></td>";
            } else {
                $parr = array();
                $parr["pid"] = $list[$i][WEBSITE::$id];
                echo "<td><a href=\"javascript:malltodoJs.max_sub_window('添加栏目', '" . TDU(TD_MODULE_NAME . "/" . TD_CONTROLLER_NAME . "/add", $parr) . "')\">添加下级栏目</a> <a href=\"javascript:malltodoJs.max_sub_window('编辑', '" . TDU(TD_MODULE_NAME . "/" . TD_CONTROLLER_NAME . "/edit", $arr) . "')\">修改</a> <a href=\"javascript:malltodoJs.del('" . TDU(TD_MODULE_NAME . "/" . TD_CONTROLLER_NAME . "/del") . "','" . $list[$i][CATEGORY::$id] . "')\">删除</a></td>";
            }
            echo "</tr>";
        }
    }
    ?>
    </table>
<script>
$(".ui-c-input").blur(function(){
	var id = $(this).attr("id");
	var arr = id.split("_");
	id = arr[0];
	var zhi = $(this).val();
	http.post("<?=TDU("Category/Index/adjustSort")?>", {"id":id, "sort":zhi}, function(data){
		if(data["status"] == 1){
			window.location.reload();
		}
	})
})

function adjust(id){
	http.post("<?=TDU("Category/Index/adjustHidden")?>", {"id":id}, function(data){
		if(data["status"] == 1){
			window.location.reload();
		}
	})
}
</script>
</div>
<?php
require_once dirname(dirname(dirname(__DIR__))) . '/Index/View/Index/bottom.php';
?>