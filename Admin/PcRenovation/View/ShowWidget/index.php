<?php
require_once dirname(dirname(dirname(__DIR__))) . '/Index/View/Index/sub_header.php';
?>
<link href="<?=TD_URL?>/Public/css/renovation.css" rel="stylesheet" type="text/css" />
<style>
	td {
	    background: #FFF;
	    padding-top: 9px;
	    padding-bottom: 9px;
	    padding-left: 15px;
	    padding-right: 15px;
	}
	.widget_box{ width:90%; height:auto; margin:auto; border: #0D79B5 0.25rem dashed;}
	.widget_box:hover{ border: #0D79B5 0.25rem solid; cursor: pointer;}
	.widget_title{ width: auto; height: 1.875rem; margin: auto; line-height: 1.875rem; font-size: 0.875rem; text-align: center;}
</style>
	<div style="padding-top:20px">
<?php
foreach ($map as $key => $val) {
    $html = $map[$key];
    ?>
			<div style="width:auto; height:auto; margin:auto; margin-bottom:30px" onclick="widget_selected('<?=$category?>', '<?=$key?>')">
				<div class="widget_box"><?=$html?></div>
				<div class="widget_title"><?=$key?></div>
			</div>
<?php
}
?>
	</div>

<script>
	$(".widget_box").children().removeAttr('onclick');
	function widget_selected(widget_category, widget_name){
		parent.get_widget(widget_category, widget_name);
	}
</script>
<?php
require_once dirname(dirname(dirname(__DIR__))) . '/Index/View/Index/sub_bottom.php';
?>