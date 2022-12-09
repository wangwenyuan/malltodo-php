<?php
require_once dirname(dirname(dirname(__DIR__))) . '/Index/View/Index/sub_header.php';
?>

<style>
.ui-c-element{ float:left}
.ui-c-note{ height:30px; line-height:30px; font-size:12px; float:left; padding-left:10px;}
.renovation_type_0{ display:none}
.renovation_type_1{ display:none}
</style>
<div style="padding:15px;">
	<div class="main_title"><?=$page_action?>内容</div>
	<div class="clear_5px"></div>
	<div>

<form method="post" action="" id="html_form">
    <table width="100%" cellpadding="0" cellspacing="0" class="small_main_table">
        <tr><td align="right" width="150px">链接名称：</td><td align="left"><?=TDWIDGET::text(LINKS::$name, $info[LINKS::$name])?>（必填）</td></tr>
        <tr><td align="right" width="150px">展示图片：</td><td align="left"><?=TDWIDGET::upload(LINKS::$pic, $info[LINKS::$pic])?></td></tr>
        <tr><td align="right" width="150px">跳转链接：</td><td align="left"><?=TDWIDGET::text(LINKS::$url, $info[LINKS::$url])?>（如果该链接不为空，则进入该栏目时自动跳转至该链接上。链接前面请添加“http://”或“https://”）</td></tr>
        <tr><td align="right" width="150px">推荐等级：</td><td align="left"><?=TDWIDGET::select(LINKS::$recommend_level, $info[LINKS::$recommend_level], TDConfig::$config['detail_recommend_level'])?></td></tr>
        <tr><td align="right" width="150px">排序：</td><td align="left"><?=TDWIDGET::text(LINKS::$sort, $info[LINKS::$sort])?>（值越大越靠前）</td></tr>
        <tr><td></td><td><input type="button" class="anniu" id="add" value="提交" /></td></tr>
    </table>

    <script>
    function change_renovation_type(){
    	$(".renovation_type_0").hide();
    	$(".renovation_type_1").hide();
    	var zhi = $("#renovation_type").val();
    	if(zhi == 0){
    		$(".renovation_type_0").show();
    	}else{
    		$(".renovation_type_1").show();
    	}
    }
    change_renovation_type();
    $("#renovation_type").change(function(){
    	change_renovation_type();
    })
    </script>

</form>
	</div>
</div>

<?php
require_once dirname(dirname(dirname(__DIR__))) . '/Index/View/Index/sub_bottom.php';
?>