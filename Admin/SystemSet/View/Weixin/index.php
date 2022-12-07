<?php
require_once dirname(dirname(dirname(__DIR__))) . '/Index/View/Index/header.php';
?>
<style>
.ui-c-element{ float:left}
.ui-c-note{ height:30px; line-height:30px; font-size:12px; float:left; padding-left:10px;}
</style>
<div style="padding:15px;">
	<div class="main_title">微信参数设置</div>
	<div class="clear_5px"></div>
	<div>
        <form method="post" action="" id="html_form">
            <table width="100%" cellpadding="0" cellspacing="0" class="small_main_table">
                <tr><td></td><td>微信公众账号设置</td></tr>
                <tr><td align="right" width="150px">开发者ID(AppID)：</td><td align="left"><?=TDWIDGET::text(WEIXIN::$appid, $info[WEIXIN::$appid])?></td></tr>
                <tr><td align="right" width="150px">开发者密码(AppSecret)：</td><td align="left"><?=TDWIDGET::text(WEIXIN::$appsecret, $info[WEIXIN::$appsecret])?></td></tr>
                <tr><td></td><td><input type="button" class="anniu" id="add" value="提交" /></td></tr>
            </table>
        </form>
	</div>
</div>
<?php
require_once dirname(dirname(dirname(__DIR__))) . '/Index/View/Index/bottom.php';
?>