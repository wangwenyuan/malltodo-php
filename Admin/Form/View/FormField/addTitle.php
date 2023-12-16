<?php
require_once dirname(dirname(dirname(__DIR__))) . '/Index/View/Index/sub_header.php';
?>
<form method="post" action="" id="html_form">
    <table width="100%" cellpadding="0" cellspacing="0" class="small_main_table">
        <tr><td align="right" width="150px">小标题名称：</td><td align="left"><?=TDWIDGET::text(FORM_FIELDS::$name, $info[FORM_FIELDS::$name])?> <span class="ui-c-note">（必填）</span></td></tr>
        <tr><td></td><td><input type="button" class="anniu" id="add" value="提交" /></td></tr>
    </table>
</form>
<?php
require_once dirname(dirname(dirname(__DIR__))) . '/Index/View/Index/sub_bottom.php';
?>