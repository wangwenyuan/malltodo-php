<?php
require_once dirname(dirname(dirname(__DIR__))) . '/Index/View/Index/sub_header.php';
?>

<link href="<?=TD_URL?>/Public/css/renovation.css" rel="stylesheet" type="text/css" />
<style>
.selected_button{
	height: 25px;
	line-height: 25px;
	display: block;
	text-align: center;
	color: #FFF;
	background: red;
	border: red 2px solid;
	float: left;
	margin-left: 5px;
	margin-right: 5px;
	margin-bottom: 10px;
	padding-left: 10px;
	padding-right: 10px;
	font-size: 14px;
	text-decoration: none;
	cursor: pointer;
}
.main_button{
	float: left;
	margin-left: 5px;
	margin-right: 5px;
	margin-bottom: 10px;
}
</style>
	<div style="padding:15px">
		<div>
<?php
$_url = TDU(TD_MODULE_NAME . "/ShowLink/index", array(
    "href_dom_id" => TDI("get.href_dom_id")
));
if (TD_ACTION_NAME == "index") {
    echo '<a class="selected_button" href="' . $_url . '">官网页面</a>';
} else {
    echo '<a class="main_button" href="' . $_url . '">官网页面</a>';
}
$_url = TDU(TD_MODULE_NAME . "/ShowLink/custom", array(
    "href_dom_id" => TDI("get.href_dom_id")
));
if (TD_ACTION_NAME == "custom") {
    echo '<a class="selected_button" href="' . $_url . '">自定义页面</a>';
} else {
    echo '<a class="main_button" href="' . $_url . '">自定义页面</a>';
}
?>
			<div style="clear:both"></div>
		</div>
		<div>
<?php
if (TD_ACTION_NAME == "index") {
    require_once __DIR__ . '/index.php';
} else if (TD_ACTION_NAME == "custom") {
    require_once __DIR__ . '/custom.php';
}
?>
		</div>
	</div>
<script>
	function link_selected(url){
		parent.get_link("<?=TDI("get.href_dom_id")?>", url);
	}
</script>

<?php
require_once dirname(dirname(dirname(__DIR__))) . '/Index/View/Index/sub_bottom.php';
?>