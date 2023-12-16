<?php
require_once dirname(dirname(dirname(__DIR__))) . '/Index/View/Index/sub_header.php';
?>
<form method="post" action="" id="html_form">
    <table width="100%" cellpadding="0" cellspacing="0" class="small_main_table">
        <tr><td align="right" width="150px">字段标识：</td><td align="left"><?=TDWIDGET::text(FORM_FIELDS::$name, $info[FORM_FIELDS::$name])?> <span class="ui-c-note">（必填）</span></td></tr>
        <tr><td align="right" width="150px">字段名：</td><td align="left"><?=TDWIDGET::text(FORM_FIELDS::$field_name, $info[FORM_FIELDS::$field_name])?> <span class="ui-c-note">（必填，且不能是"id", "create_time", "ip", "is_del"）</span></td></tr>
        <tr><td align="right" width="150px">字段类型：</td><td align="left"><?=TDWIDGET::select(FORM_FIELDS::$field_type, $info[FORM_FIELDS::$field_type], TDConfig::$config["field"])?> <span class="ui-c-note">（必填）</span></td></tr>
        <tr id="xuanzexiang"><td align="right" width="150px">选择项：</td><td align="left"><?=TDWIDGET::textarea(FORM_FIELDS::$field_select, $info[FORM_FIELDS::$field_select])?> <span class="ui-c-note">（不同的值之间用“|”隔开）</span></td></tr>
        <tr><td align="right" width="150px">默认值：</td><td align="left"><?=TDWIDGET::text(FORM_FIELDS::$field_value, $info[FORM_FIELDS::$field_value])?> <span class="ui-c-note"></span></td></tr>
		<tr><td align="right" width="150px">值验证：</td><td align="left"><?=TDWIDGET::select(FORM_FIELDS::$verification, $info[FORM_FIELDS::$verification], TDConfig::$config["verification"])?> <span class="ui-c-note"></span></td></tr>
		<?php 
		$valMap = array(0=>'否', "1"=>'是');
		?>
		<tr><td align="right" width="150px">是否必填：</td><td align="left"><?=TDWIDGET::select(FORM_FIELDS::$is_required, $info[FORM_FIELDS::$is_required], $valMap)?> <span class="ui-c-note"></span></td></tr>
		<tr id="is_search_box"><td align="right" width="150px">是否筛选项：</td><td align="left"><?=TDWIDGET::select(FORM_FIELDS::$is_search, $info[FORM_FIELDS::$is_search], $valMap)?> <span class="ui-c-note"></span></td></tr>
		<tr id="is_list_box"><td align="right" width="150px">是否加入列表：</td><td align="left"><?=TDWIDGET::select(FORM_FIELDS::$is_in_list, $info[FORM_FIELDS::$is_in_list], $valMap)?> <span class="ui-c-note"></span></td></tr>
		<tr><td></td><td><input type="button" class="anniu" id="add" value="提交" /></td></tr>
    </table>
</form>
<script>
function field_type_change(){
	if($("#field_type").val() == "select" || $("#field_type").val() == "checkbox"){
		$('#xuanzexiang').show();
	}else{
		$('#xuanzexiang').hide();
	}
	if($("#field_type").val() == "text" || $("#field_type").val() == "select" || $("#field_type").val() == "textarea"){
		$("#is_search_box").show();
	}else{
		$("#is_search_box").hide();
	}
	if($("#field_type").val() == "text" || $("#field_type").val() == "select" || $("#field_type").val() == "date" || $("#field_type").val() == "date_part" || $("#field_type").val() == "textarea" || $("#field_type").val() == "checkbox"){
		$("#is_list_box").show();
	}else{
		$("#is_list_box").hide();
	}
}
$("#field_type").change(function(){
	field_type_change();
})

field_type_change();
</script>
<?php
require_once dirname(dirname(dirname(__DIR__))) . '/Index/View/Index/sub_bottom.php';
?>