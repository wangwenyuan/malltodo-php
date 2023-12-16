<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
<title>隐私协议</title>
<?php static_resources();?>
<style>
html,body {
    width: 100%;
    height: 100%;
    background-image: url('__PUBLIC__/images/login_bg.png');
    background-repeat: no-repeat;
    background-size: cover;
    overflow: hidden;
}

@media screen and (min-width:990px) {
	.layui-form-item .layui-input-inline{
	  width:350px;
	}
	.layui-form-label{ font-weight:bold;}
	.layui-form-item{ width:480px; float:left; clear:none;}
	.head_title{ font-size:20px; text-align:center; line-height:72px; clear:both;}
	.content_box{ width:990px; margin:auto; background:white; padding:15px; overflow:hidden; overflow-y:scroll;}
}

@media screen and (max-width:989px) {
	.layui-form-item .layui-input-inline{
	  width:auto;
	}
	.layui-form-label{ font-weight:bold;}
	.layui-form-item{ width:auto;}
	.head_title{ font-size:20px; text-align:center; line-height:72px; clear:both; width:auto;}
	.content_box{ width:94%; margin:auto; background:white; padding:15px; overflow:hidden; overflow-y:scroll; box-sizing: border-box;}
}


</style>
</head>

<body>
<div class="content_box">
	<h2 style="text-align:center;">隐私协议</h2>
	<?php echo $detail;?>
</div>

<script src="__PUBLIC__/layui/layui.js"></script>
<script>
layui.use('form',function() {
    var form = layui.form,
        jq = layui.jquery;
});

function resize(){
	var windows_height = $(window).height();
	console.log(windows_height);
	var box_height = parseInt(windows_height * 70 / 100);
	$('.content_box').height(box_height);
	var box_margin_top = parseInt(windows_height - box_height)/2;
	box_margin_top = box_margin_top;
	$('.content_box').css('margin-top', box_margin_top+'px');
}
resize();
$(window).resize(function(){
	resize();
})

$(function(){
	var len = $('.upload_img').length;
	for(var i=0; i<len; i=i+1){
		var width = $('.upload_img').eq(i).width();
		width = width + 100;
		$('.upload_img').css('margin-left', '-100px');
	}
})
</script>
</body>
</html>