<table width="100%" cellpadding="0" cellspacing="0" class="main_table">
      	<tr class="main_table_header">
          	<td width="100px">页面名称</td>
          	<td>链接</td>
          	<td width="50px">操作</td>
      	</tr>
    <?php
    foreach ($linkMap as $key => $val) {
        echo "<tr>";
        echo "<td>" . $key . "</td>";
        echo "<td>" . $val . "</td>";
        echo "<td><a style=\"cursor:pointer\" onclick=\"link_selected('" . $val . "')\">选中</a></td>";
        echo "</tr>";
    }
    ?>
</table>