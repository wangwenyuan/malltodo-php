<?php
require_once dirname(dirname(dirname(__DIR__))) . '/Index/View/Index/header.php';
?>
<style>
.ui-c-element{ float:left}
.ui-c-note{ height:30px; line-height:30px; font-size:12px; float:left; padding-left:10px;}
</style>
<div style="padding:15px;">
	<div class="main_title">拼多多参数设置</div>
	<div class="clear_5px"></div>
	<div>
        <form method="post" action="" id="html_form">
            <table width="100%" cellpadding="0" cellspacing="0" class="small_main_table">
                <tr><td align="right" width="150px">client_id：</td><td align="left"><?=TDWIDGET::text(PDD::$client_id, $info[PDD::$client_id])?></td></tr>
                <tr><td align="right" width="150px">client_secret：</td><td align="left"><?=TDWIDGET::text(PDD::$client_secret, $info[PDD::$client_secret])?></td></tr>
                <tr><td align="right" width="150px">pid：</td><td align="left"><?=TDWIDGET::text(PDD::$pid, $info[PDD::$pid])?></td></tr>
                <tr><td></td><td><input type="button" class="anniu" id="add" value="提交" /></td></tr>
            </table>
        </form>
	</div>
</div>
<?php
require_once dirname(dirname(dirname(__DIR__))) . '/Index/View/Index/bottom.php';
?>