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
        <tr><td align="right" width="150px">SEO标题：</td><td align="left"><?=TDWIDGET::text(DETAIL::$seo_title, $info[DETAIL::$seo_title])?></td></tr>
        <tr><td align="right" width="150px">SEO关键字：</td><td align="left"><?=TDWIDGET::text(DETAIL::$seo_keywords, $info[DETAIL::$seo_keywords])?></td></tr>
        <tr><td align="right" width="150px">SEO描述：</td><td align="left"><?=TDWIDGET::textarea(DETAIL::$seo_description, $info[DETAIL::$seo_description])?></td></tr>
        <tr><td align="right" width="150px">内容标题：</td><td align="left"><?=TDWIDGET::text(DETAIL::$title, $info[DETAIL::$title])?>（必填）</td></tr>
        <tr><td align="right" width="150px">展示图片：</td><td align="left"><?=TDWIDGET::upload(DETAIL::$pic, $info[DETAIL::$pic])?></td></tr>
        <tr><td align="right" width="150px">外部跳转链接：</td><td align="left"><?=TDWIDGET::text(DETAIL::$url, $info[DETAIL::$url])?>（如果该链接不为空，则进入该栏目时自动跳转至该链接上。链接前面请添加“http://”或“https://”）</td></tr>
        <tr><td align="right" width="150px">所属栏目：</td><td align="left"><?=TDWIDGET::select(DETAIL::$category_id, $info[DETAIL::$category_id], $category_map)?>（必选）</td></tr>
        <tr><td align="right" width="150px">内容简介：</td><td align="left"><?=TDWIDGET::textarea(DETAIL::$smalltext, $info[DETAIL::$smalltext])?></td></tr>
        <tr><td align="right" width="150px">内容详情：</td><td align="left"><div style="width:600px"><?=TDWIDGET::editor(DETAIL::$detail, htmlspecialchars_decode($info[DETAIL::$detail]))?></div></td></tr>
        <?php
        $arr = array(
            "0" => "普通模板",
            "1" => "自定义模板"
        );
        ?>
        <tr><td align="right" width="150px">模板类型：</td><td align="left"><?=TDWIDGET::select(DETAIL::$renovation_type, $info[DETAIL::$renovation_type], $arr)?></td></tr>
        <tr class="renovation_type_0"><td align="right" width="150px">电脑端模版：</td><td align="left"><?=TDWIDGET::select(DETAIL::$pc_renovation_id, $info[DETAIL::$pc_renovation_id], $pc_renovation)?></td></tr>
        <tr class="renovation_type_1"><td align="right" width="150px">电脑端自定义页模版：</td><td align="left"><?=TDWIDGET::select(DETAIL::$pc_custom_id, $info[DETAIL::$pc_custom_id], $pc_custom)?></td></tr>
        <tr><td align="right" width="150px">推荐等级：</td><td align="left"><?=TDWIDGET::select(DETAIL::$recommend_level, $info[DETAIL::$recommend_level], TDConfig::$config['detail_recommend_level'])?></td></tr>
        <tr><td align="right" width="150px">排序：</td><td align="left"><?=TDWIDGET::text(DETAIL::$sort, $info[DETAIL::$sort])?>（值越大越靠前）</td></tr>
        <?php
        if (isset($info[DETAIL::$release_time]) && $info[DETAIL::$release_time]) {
            $info[DETAIL::$release_time] = date("Y-m-d H:i:s", $info[DETAIL::$release_time]);
        } else {
            $info[DETAIL::$release_time] = date("Y-m-d H:i:s", time());
        }
        ?>
        <tr><td align="right" width="150px">发布时间：</td><td align="left"><?=TDWIDGET::date(DETAIL::$release_time, $info[DETAIL::$release_time])?></td></tr>
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
    
    ue_detail.addListener("contentChange", function() {
    	if (ue_detail == null) {
    		return;
    	} else {
    		var zhi = ue_detail.getContent();
    		var article_pic_url = $('#pic').val();
    		if(article_pic_url == ""){
    			var pic_url = $(zhi).find('img:first').attr('src');
    			$('#pic').val(pic_url);
				$('#pic_phptodo_upload_file_outerbox').css({'background-image':'url('+pic_url+')'});
    		}
    	}
    });
    
    </script>

</form>
	</div>
</div>

<?php
require_once dirname(dirname(dirname(__DIR__))) . '/Index/View/Index/sub_bottom.php';
?>