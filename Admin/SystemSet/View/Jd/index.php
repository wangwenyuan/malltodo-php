<?php
require_once dirname(dirname(dirname(__DIR__))) . '/Index/View/Index/header.php';
?>
<div style="padding:15px;">
	<div class="main_title">京东参数设置</div>
	<div class="clear_5px"></div>
	<div>
        <form method="post" action="" id="html_form">
            <table width="100%" cellpadding="0" cellspacing="0" class="small_main_table">
                <tr><td align="right" width="150px">appkey：</td><td align="left"><?=TDWIDGET::text(JD::$app_key, $info[JD::$app_key])?></td></tr>
                <tr><td align="right" width="150px">secretkey：</td><td align="left"><?=TDWIDGET::text(JD::$app_secret, $info[JD::$app_secret])?></td></tr>
                <tr><td align="right" width="150px">网站ID/APP ID：</td><td align="left"><?=TDWIDGET::text(JD::$site_id, $info[JD::$site_id])?> <div style="clear: both"></div><br /> <span style="color:red">入口：京东联盟-推广管理-网站管理/APP管理-查看网站ID/APP ID（1、接口禁止使用导购媒体id；2、投放链接的网址或应用必须与传入的网站ID/AppID备案一致，否则订单会判“无效-来源与备案网址不符”）</span> </td></tr>
                <tr><td></td><td><input type="button" class="anniu" id="add" value="提交" /></td></tr>
            </table>
        </form>
	</div>
</div>
<?php
require_once dirname(dirname(dirname(__DIR__))) . '/Index/View/Index/bottom.php';
?>