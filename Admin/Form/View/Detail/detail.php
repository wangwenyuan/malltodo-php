<?php
require_once dirname(dirname(dirname(__DIR__))) . '/Index/View/Index/sub_header.php';
?>
<div style="padding:15px;">
<div class="main_title">表单内容</div>

<div class="clear_5px"></div>
  <table width="100%" cellpadding="0" cellspacing="0" class="main_table">
    <?php
  for($i=0; $i<count($field_list); $i=$i+1){

	if($list_field_list[$n]['field_type'] != 'date_part'){
		$td_html = $td_html . "<td>".$list[$i][$field_name]."</td>";
	}else{
		$td_html = $td_html . "<td>".$list[$i][$field_name."_1"]." 至 ".$list[$i][$field_name."_2"]."</td>";
	}

    echo '<tr><td>'.$field_list[$i]['name'].'</td>';
	if($field_list[$i]['field_type'] == "date_part"){
		echo '<td>'.$info[$field_list[$i]['field_name']."_1"].' 至 '.$info[$field_list[$i]['field_name']."_2"].'</td>';
	}else if($field_list[$i]['field_type'] == "upload"){
		echo '<td><img src="'.$info[$field_list[$i]['field_name']].'" width="350px" /></td>';
	}else{
		echo '<td>'.$info[$field_list[$i]['field_name']].'</td>';
	}
            
    echo '</tr>';
  }
  ?>
  	<tr><td>IP</td><td><?php echo $info["ip"]?></td></tr>
  	<tr><td>创建时间</td><td><?php echo $info["create_time"]?></td></tr>
  </table>
</div>
<?php
require_once dirname(dirname(dirname(__DIR__))) . '/Index/View/Index/sub_bottom.php';
?>