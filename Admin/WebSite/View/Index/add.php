<?php
require_once dirname(dirname(dirname(__DIR__))) . '/Index/View/Index/sub_header.php';
?>
<form method="post" action="" id="html_form">
    <table width="100%" cellpadding="0" cellspacing="0" class="small_main_table">
        <tr><td align="right" width="150px">站点名称：</td><td align="left"><?=TDWIDGET::text(WEBSITE::$website_name, $info[WEBSITE::$website_name])?> <span class="ui-c-note">（必填）</span></td></tr>
        <tr><td align="right" width="150px">站点域名：</td><td align="left"><?=TDWIDGET::text(WEBSITE::$website_host, $info[WEBSITE::$website_host])?> <span class="ui-c-note">（必填）</span></td></tr>
        <tr><td align="right" width="150px">统计代码：</td><td align="left"><?=TDWIDGET::textarea(WEBSITE::$statistics_code, $info[WEBSITE::$statistics_code])?></td></tr>
        <tr><td></td><td><input type="button" class="anniu" id="add" value="提交" /></td></tr>
    </table>
</form>
<?php
require_once dirname(dirname(dirname(__DIR__))) . '/Index/View/Index/sub_bottom.php';
?>