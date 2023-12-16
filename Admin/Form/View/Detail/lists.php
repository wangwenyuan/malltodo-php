<?php
require_once dirname(dirname(dirname(__DIR__))) . '/Index/View/Index/sub_header.php';
?>
<div style="padding:15px;">
<div class="main_title">表单内容</div><a target="_blank" class="note_marker" href="<?=DocU(TD_MODULE_NAME . "/" . TD_CONTROLLER_NAME . "/". TD_ACTION_NAME) ?>">(操作指南)</a>

<div style="clear: both;">
	<form method="GET" action="<?=TDU(TD_MODULE_NAME . '/' . TD_CONTROLLER_NAME . '/' . TD_ACTION_NAME)?>" id="search_form">
		<input type="hidden" name="m" value="<?=TD_MODULE_NAME?>">
		<input type="hidden" name="c" value="<?=TD_CONTROLLER_NAME?>">
		<input type="hidden" name="a" value="<?=TD_ACTION_NAME?>">
		<input type="hidden" name="fid" value="<?php echo TDI("get.fid")?>" />


<?php
for($i=0; $i<count($search_field_list); $i=$i+1){
	$field_name = $search_field_list[$i][FORM_FIELDS::$field_name];
	$name = $search_field_list[$i][FORM_FIELDS::$name];
	echo '<div style="float: left; margin-top:5px; margin-bottom:5px; margin-right:10px;">';
	if($search_field_list[$i]['field_type'] == 'text' || $search_field_list[$i]['field_type'] == 'textarea'){
		echo TDWIDGET::text($field_name, TDI("get.".$field_name), $name);
	}
	if($search_field_list[$i]['field_type'] == 'select'){
		$field_select = $search_field_list[$i]['field_select'];
    	$field_select_arr = explode("|", $field_select);
    	$field_select_map = array();
    	$field_select_map[""] = $name;
    	for ($n = 0; $n < count($field_select_arr); $n = $n + 1) {
        	$field_select_map[$field_select_arr[$n]] = $field_select_arr[$n];
    	}
		echo TDWIDGET::select($search_field_list[$i][FORM_FIELDS::$field_name], TDI('get.'.$search_field_list[$i][FORM_FIELDS::$field_name]), $field_select_map);
	}
	if($search_field_list[$i]['field_type'] == 'date'){
		echo TDWIDGET::date($search_field_list[$i][FORM_FIELDS::$field_name], TDI('get.'.$search_field_list[$i][FORM_FIELDS::$field_name]), $name);
	}
    echo '</div>';
}
?>
		<div style="float: left;  margin-top:5px; margin-bottom:5px;">
			<a class="main_button" style="float: left;" value="查询" id="search_btn" onclick="$('#search_form').submit()">查询</a>
		</div>
	</form>
</div>

<div class="clear_5px"></div>
  <table width="100%" cellpadding="0" cellspacing="0" class="main_table">
    <tr class="main_table_header">
      <?php
      	for($i=0; $i<count($list_field_list); $i=$i+1){
			echo '<td>'.$list_field_list[$i][FORM_FIELDS::$name].'</td>';
		}
      ?>
      <td width="100px">操作</td>
    </tr>

    <?php
    if (count($list) == 0) {
        echo '<tr><td colspan='.(count($list_field_list)+1).'>该表单内没有信息</td></tr>';
    } else {
        for ($i = 0; $i < count($list); $i = $i + 1) {
            $td_html = "";
            for($n=0; $n<count($list_field_list); $n=$n+1){
                $field_name = $list_field_list[$n]['field_name'];
                if($list_field_list[$n]['field_type'] != 'date_part'){
                    $td_html = $td_html . "<td>".$list[$i][$field_name]."</td>";
                }else{
                    $td_html = $td_html . "<td>".$list[$i][$field_name."_1"]." 至 ".$list[$i][$field_name."_2"]."</td>";
                }
            }
            $arr = array();
            $arr['fid'] = TDI("get.fid");
            $arr['id'] = $list[$i]['id'];
            echo "<tr>".$td_html."<td><a href=\"javascript:malltodoJs.sub_window('表单详情', '" . TDU(TD_MODULE_NAME . '/' . TD_CONTROLLER_NAME . '/detail', $arr) . "')\">查看详情</a> <a href=\"javascript:malltodoJs.del('" . TDU(TD_MODULE_NAME . '/' . TD_CONTROLLER_NAME . '/del', $arr) . "','" . $list[$i]['id'] . "')\">删除</a></td>
          		  </tr>";
        }
    }
    ?>
    </table>
</div>
<?php
require_once dirname(dirname(dirname(__DIR__))) . '/Index/View/Index/sub_bottom.php';
?>