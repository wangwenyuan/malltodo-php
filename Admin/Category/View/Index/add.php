<?php
require_once dirname(dirname(dirname(__DIR__))) . '/Index/View/Index/sub_header.php';
?>



<style>
.ui-c-element{ float:left}
.ui-c-note{ height:30px; line-height:30px; font-size:12px; float:left; padding-left:10px;}
</style>
<div style="padding:15px;">
	<div class="main_title">栏目设置</div>
	<div class="clear_5px"></div>
	<div>
<?php
$json = array();
$json["0"] = "普通类型（即列表页+详情页）";
$json["1"] = "单页面";
$json["2"] = "自定义页面";
$order_by_json = array();
$order_by_json["id desc"] = "添加的先后次序，倒序";
$order_by_json["id asc"] = "添加的先后次序，正序";
$order_by_json["release_time desc"] = "发布时间的先后次序，倒序";
$order_by_json["release_time asc"] = "发布时间的先后次序，正序";
?>

<form method="post" action="" id="html_form">
    <table width="100%" cellpadding="0" cellspacing="0" class="small_main_table">
        <tr><td align="right" width="150px">SEO标题：</td><td align="left"><?=TDWIDGET::text(CATEGORY::$seo_title, $info[CATEGORY::$seo_title])?></td></tr>
        <tr><td align="right" width="150px">SEO关键字：</td><td align="left"><?=TDWIDGET::text(CATEGORY::$seo_keywords, $info[CATEGORY::$seo_keywords])?></td></tr>
        <tr><td align="right" width="150px">SEO描述：</td><td align="left"><?=TDWIDGET::textarea(CATEGORY::$seo_description, $info[CATEGORY::$seo_description])?></td></tr>
        <tr><td align="right" width="150px">栏目名称：</td><td align="left"><?=TDWIDGET::text(CATEGORY::$category_name, $info[CATEGORY::$category_name])?>（必填）</td></tr>
        <tr><td align="right" width="150px">栏目别名：</td><td align="left"><?=TDWIDGET::text(CATEGORY::$category_sub_name, $info[CATEGORY::$category_sub_name])?></td></tr>
        <tr><td align="right" width="150px">所属模型：</td><td align="left"><?=TDWIDGET::select(CATEGORY::$type, $info[CATEGORY::$type], MenuCache::$home_menu)?></td></tr>
        <tr class="type_no_index"><td align="right" width="150px">上级栏目：</td><td align="left"><?=TDWIDGET::select(CATEGORY::$pid, $info[CATEGORY::$pid], _menu_json)?></td></tr>
        <tr><td align="right" width="150px">栏目图片：</td><td align="left"><?=TDWIDGET::upload(CATEGORY::$pic, $info[CATEGORY::$pic])?></td></tr>
        <tr><td align="right" width="150px">排序：</td><td align="left"><?=TDWIDGET::text(CATEGORY::$sort, $info[CATEGORY::$sort])?>（值越小栏目越靠前）</td></tr>
        <tr><td align="right" width="150px">外部跳转链接：</td><td align="left"><?=TDWIDGET::text(CATEGORY::$url, $info[CATEGORY::$url])?>（如果该链接不为空，则进入该栏目时自动跳转至该链接上。链接前面请添加“http://”或“https://”）</td></tr>
        <tr class="type_no_index"><td align="right" width="150px">栏目类型：</td><td align="left"><?=TDWIDGET::select(CATEGORY::$category_type, $info[CATEGORY::$category_type], $json)?></td></tr>
        <tr class="type_no_index category_type_0 category_type_1"><td align="right" width="150px">电脑端栏目页模版：</td><td align="left"><?=TDWIDGET::select(CATEGORY::$pc_list_renovation_id, $info[CATEGORY::$pc_list_renovation_id], array())?></td></tr>
        <tr class="type_no_index category_type_0"><td align="right" width="150px">电脑端详情页模版：</td><td align="left"><?=TDWIDGET::select(CATEGORY::$pc_page_renovation_id, $info[CATEGORY::$pc_page_renovation_id], array())?></td></tr>
        <tr class="type_no_index category_type_0"><td align="right" width="150px">排序方式：</td><td align="left"><?=TDWIDGET::select(CATEGORY::$order_by, $info[CATEGORY::$order_by], $order_by_json)?></td></tr>
        <tr class="type_no_index category_type_1"><td align="right" width="150px">栏目简介：</td><td align="left"><?=TDWIDGET::textarea(CATEGORY::$smalltext, $info[CATEGORY::$smalltext])?></td></tr>
        <tr class="type_no_index category_type_1"><td align="right" width="150px">栏目详情：</td><td align="left"><div style="max-width:800px"><?=TDWIDGET::editor(CATEGORY::$detail, htmlspecialchars_decode($info[CATEGORY::$detail]))?></div></td></tr>
        <tr class="type_no_index category_type_2"><td align="right" width="150px">电脑端自定义页模版：</td><td align="left"><?=TDWIDGET::select(CATEGORY::$pc_custom_id, $info[CATEGORY::$pc_custom_id], array())?></td></tr>
        <tr><td></td><td><input type="button" class="anniu" id="add" value="提交" /></td></tr>
    </table>

    <script>
    function category_type_fun(){
    	$(".category_type_0").hide();
    	$(".category_type_1").hide();
    	$(".category_type_2").hide();
    	var zhi = $("#category_type").val();
    	$(".category_type_"+zhi).show();
    }
    category_type_fun();
    $("#category_type").change(function(){
    	category_type_fun();
    })

    var pc_renovation = <?=json_encode($pc_renovation, JSON_UNESCAPED_UNICODE)?>;
    var mobile_renovation = <?=json_encode($mobile_renovation, JSON_UNESCAPED_UNICODE)?>;
    var menu_json = <?=json_encode($menu_json, JSON_UNESCAPED_UNICODE)?>;

    function renovation_change(){

    	var zhi = $("#type").val();
    	if(zhi == "Index/Index/index"){
    		$(".type_no_index").hide();
    	}else{
    		$(".type_no_index").show();
    		category_type_fun();
    	}

    	$("#pc_list_renovation_id").html("");
    	$("#pc_page_renovation_id").html("");
    	$("#mobile_list_renovation_id").html("");
    	$("#mobile_page_renovation_id").html("");
    	var zhi_arr = zhi.split("/");
    	var list_sign = zhi_arr[0]+"/"+zhi_arr[1]+"/index";
    	var detail_sign = zhi_arr[0]+"/"+zhi_arr[1]+"/detail";

    	var pc_list_html = "<option value=''>请选择模板</option>";
    	var mobile_list_html = "<option value=''>请选择模板</option>";
    	var pc_detail_html = "<option value=''>请选择模板</option>";
    	var mobile_detail_html = "<option value=''>请选择模板</option>";

    	for(var id in pc_renovation){
    		if(pc_renovation[id]["type"] == list_sign){
    			pc_list_html = pc_list_html + "<option value='"+id+"'>"+pc_renovation[id]["name"]+"</option>";
    		}
    		if(pc_renovation[id]["type"] == detail_sign){
    			pc_detail_html = pc_detail_html + "<option value='"+id+"'>"+pc_renovation[id]["name"]+"</option>";
    		}
    	}

    	for(var id in mobile_renovation){
    		if(mobile_renovation[id]["type"] == list_sign){
    			mobile_list_html = mobile_list_html + "<option value='"+id+"'>"+mobile_renovation[id]["name"]+"</option>";
    		}
    		if(mobile_renovation[id]["type"] == detail_sign){
    			mobile_detail_html = mobile_detail_html + "<option value='"+id+"'>"+mobile_renovation[id]["name"]+"</option>";
    		}
    	}
    	$("#pc_list_renovation_id").html(pc_list_html);
    	$("#pc_page_renovation_id").html(pc_detail_html);
    	$("#mobile_list_renovation_id").html(mobile_list_html);
    	$("#mobile_page_renovation_id").html(mobile_detail_html);

    	var pc_list_renovation_id = "<?=$info[CATEGORY::$pc_list_renovation_id]?>";
    	if(pc_list_renovation_id != ""){
    		$("#pc_list_renovation_id").val(pc_list_renovation_id);
    	}

    	var pc_page_renovation_id = "<?=$info[CATEGORY::$pc_page_renovation_id]?>";
    	if(pc_page_renovation_id != ""){
    		$("#pc_page_renovation_id").val(pc_page_renovation_id);
    	}

    	//修改栏目上级可选内容
    	var pid_option_html = '<option value="0">顶级栏目</option>';
    	var pid_arr = [0];
    	for(var id in menu_json){
    		if(menu_json[id]["type"] == $("#type").val()){
    			pid_option_html = pid_option_html + '<option value="'+id+'">'+menu_json[id]["name"]+'</option>';
    			pid_arr.push(id);
    		}
    	}
    	$('#pid').html(pid_option_html);

    	if(pid_arr.includes('<?=$info[CATEGORY::$pid]?>')){
    		$('#pid').val(<?=$info[CATEGORY::$pid]?>);
    	}else{
    		$('#pid').val(0);
    	}
    	ui_c.render();
    }

    renovation_change();

    $("#type").change(function(){
    	renovation_change();
    })

    function custom_init(){
    	var sign = "Index/Index/custom";
    	var pc_custom_html = "<option value=''>请选择模板</option>";
    	var mobile_custom_html = "<option value=''>请选择模板</option>";
    	for(var id in pc_renovation){
    		if(pc_renovation[id]["type"] == sign){
    			pc_custom_html = pc_custom_html + "<option value='"+id+"'>"+pc_renovation[id]["name"]+"</option>";
    		}
    	}

    	for(var id in mobile_renovation){
    		if(mobile_renovation[id]["type"] == sign){
    			mobile_custom_html = mobile_custom_html + "<option value='"+id+"'>"+mobile_renovation[id]["name"]+"</option>";
    		}
    	}

    	$("#pc_custom_id").html("");
    	$("#mobile_custom_id").html("");
    	$("#pc_custom_id").html(pc_custom_html);
    	$("#mobile_custom_id").html(mobile_custom_html);

    	var pc_custom_id = "<?=$info[CATEGORY::$pc_custom_id]?>";
    	if(pc_custom_id != ""){
    		$("#pc_custom_id").val(pc_custom_id);
    	}

    	var mobile_custom_id = "<?=$info[CATEGORY::$mobile_custom_id]?>";
    	if(mobile_custom_id != ""){
    		$("#mobile_custom_id").val(mobile_custom_id);
    	}

    	ui_c.render();
    }
    custom_init();
    </script>

</form>
	</div>
</div>



<?php
require_once dirname(dirname(dirname(__DIR__))) . '/Index/View/Index/sub_bottom.php';
?>