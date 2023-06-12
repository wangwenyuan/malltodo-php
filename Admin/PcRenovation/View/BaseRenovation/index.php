<?php
require_once dirname(dirname(dirname(__DIR__))) . '/Index/View/Index/header.php';
?>


<div style="padding:15px;">
            <div class="main_title"><?=$page_action?>设计</div><a target="_blank" class="note_marker" href="<?=DocU(TD_MODULE_NAME . "/" . TD_CONTROLLER_NAME . "/". TD_ACTION_NAME) ?>">(操作指南)</a>
            <a onclick="malltodoJs.max_sub_window('新建<?=$page_action?>设计', '<?=TDU(TD_MODULE_NAME . "/" . TD_CONTROLLER_NAME . "/add")?>')" class="main_button">新建</a>
            <div class="clear_5px"></div>
              <table width="100%" cellpadding="0" cellspacing="0" class="main_table">
                <tr class="main_table_header">
                  <td>页面名称</td>
                  <td>创建时间</td>
                  <td>最后修改时间</td>
                  <?php
                if (isset(TDConfig::$menu["admin_home"][TD_MODULE_NAME][TD_CONTROLLER_NAME]["setDefault"])) {
                    ?>
                	  <td>是否开启</td>
                  <?php
                }
                ?>
                  <td>操作</td>
                </tr>
                <?php
                for ($i = 0; $i < count($list); $i = $i + 1) {
                    $jsonObject = $list[$i];
                    echo "<tr>";
                    echo "<td>" . $jsonObject[RENOVATION::$name] . "</td>";
                    echo "<td>" . date("Y-m-d H:i:s", $jsonObject[RENOVATION::$addtime]) . "</td>";
                    echo "<td>" . date("Y-m-d H:i:s", $jsonObject[RENOVATION::$last_edit_time]) . "</td>";
                    $checked = "";
                    if ((int) $jsonObject[RENOVATION::$is_default] == 1) {
                        $checked = "checked=\"checked\"";
                    }
                    if (isset(TDConfig::$menu["admin_home"][TD_MODULE_NAME][TD_CONTROLLER_NAME]["setDefault"])) {
                        echo "<td><div><input onclick=\"changeDefault('" . $jsonObject["id"] . "')\" class=\"ui-c-open\" type=\"checkbox\" name=\"open\" " . $checked . " /></div></td>";
                    }
                    echo "<td><a href=\"javascript:malltodoJs.max_sub_window('编辑', '" . TDU(TD_MODULE_NAME . "/" . TD_CONTROLLER_NAME . "/edit", array(
                        "id" => $jsonObject["id"]
                    )) . "')\">修改</a> <a href=\"javascript:malltodoJs.del('" . TDU(TD_MODULE_NAME . "/" . TD_CONTROLLER_NAME . "/del") . "','" . $jsonObject["id"] . "')\">删除</a></td>";
                    echo "</tr>";
                }
                if (count($list) == 0) {
                    echo "<tr>";
                    if (isset(TDConfig::$menu["admin_home"][TD_MODULE_NAME][TD_CONTROLLER_NAME]["setDefault"])) {
                        echo "<td colspan=5>尚未创建任何模板</td>";
                    } else {
                        echo "<td colspan=4>尚未创建任何模板</td>";
                    }
                    echo "</tr>";
                }
                ?>
                </table>
                <div class="page"><?=$page?></div>
            </div>

<script>
function changeDefault(id){
	var url = "<?=TDU(TD_MODULE_NAME . "/" . TD_CONTROLLER_NAME . "/setDefault")?>";
	$.ajax({
		async : true,
		type : "POST",
		dataType : "json",
		url : url,
		data : {
			id:id
		},
		success : function(data){
			layer.msg(data["info"], {
                time: 2000
            }, function () {
            	window.location.reload();
            })
		},
		error : function(){
			layer.msg("网络错误", {
                time: 2000
            }, function () {
            	window.location.reload();
            })
		}
	});
}
</script>


<?php
require_once dirname(dirname(dirname(__DIR__))) . '/Index/View/Index/bottom.php';
?>