<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
<title><?php echo $form_name;?></title>
<?php static_resources();?>
<style>
/**
html,body {
    width: 100%;
    height: 100%;
    background-image: url('__PUBLIC__/images/login_bg.png');
    background-repeat: no-repeat;
    background-size: cover;
    overflow: hidden;
}
**/

.layui-form-item {
    clear: both;
}

.layui-form-label {
    float: left;
    display: block;
    padding: 5px 15px;
    width: 80px;
    line-height: 20px;
    text-align: right;
}

.layui-form-item .layui-input-inline {
    float: left;
    margin-right: 10px;
}

.layui-input-inline {
    display: inline-block;
    vertical-align: middle;
}

.xieyi_span{
    position:absolute;
    margin-left: 10px;
    margin-top: 4px;
}
.div_clear{ clear:both; height: 15px;}
.xieyi_span a{ color: black; }
.form_btn{ padding-left: 110px;}

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
	.content_box{ width:98%; margin:auto; background:white; padding:15px; box-sizing: border-box;}
}

@media screen and (max-width:479px) {
	.layui-form-label {
        text-align: left;
    }
    .layui-form-label {
        padding: 5px 0px;
        width: auto;
    }
    .form_btn{ padding-left: 0px;}
}
</style>
</head>

<body>
<div class="content_box">
	<?php echo $form_html; ?>
</div>

<script>

function resize(){
	var windows_height = $(window).height();
	//console.log(windows_height);
	var box_height = parseInt(windows_height * 70 / 100);
	//$('.content_box').height(box_height-25);
	var box_margin_top = parseInt(windows_height - box_height)/2;
	box_margin_top = box_margin_top + 25;
	//$('.content_box').css('margin-top', box_margin_top+'px');
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


$("#add").click(function () {
    loading = layer.load(2, {
        shade: [0.2, '#000']
    });
	var url=document.location.href;
	var data=$("#html_form").serialize();
	var ret=malltodoJs.ajax(url,data);
	if(ret=='error'){
        layer.close(loading);
		layer.msg('网络错误');
	}else{
        layer.close(loading);
		layer.msg(ret.info,{
			time:2000
		},function(){
			if(parseInt(ret.status)){
				parent.location.reload();
			}
		})
	}
})
</script>
</body>
</html>