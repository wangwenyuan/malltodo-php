<table width="100%" cellpadding="0" cellspacing="0" class="main_table">
      	<tr class="main_table_header">
          	<td>自定义页面名称</td>
          	<td>链接</td>
          	<td width="50px">操作</td>
      	</tr>
    <?php
    if (count($list) == 0) {
        $_url = TDU(TD_MODULE_NAME . "/Custom/index");
        echo "<tr><td colspan='5'>您尚未创建自定义页面，<a target='_blank' href='" . $_url . "'>前去创建自定义页面</a></td></tr>";
    } else {
        for ($i = 0; $i < count($list); $i = $i + 1) {
            $object = $list[$i];
            echo "<tr>";
            echo "<td>" . $object[RENOVATION::$name] . "</td>";
            $url = TDUU("Index/Index/custom", array(
                "id" => $object["id"]
            ), "index.php");
            echo "<td>" . $url . "</td>";
            echo "<td><a style=\"cursor:pointer\" onclick=\"link_selected('" . $url . "')\">选中</a></td>";
            echo "</tr>";
        }
    }
    ?>
</table>