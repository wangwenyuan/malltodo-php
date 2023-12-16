<?php
require_once dirname(dirname(dirname(__DIR__))) . '/Index/View/Index/sub_header.php';
?>
<form method="post" action="" id="html_form">
    <table width="100%" cellpadding="0" cellspacing="0" class="small_main_table">
        <tr><td align="right" width="150px">表单名称：</td><td align="left"><?=TDWIDGET::text(FORM::$name, $info[FORM::$name])?> <span class="ui-c-note">（必填）</span></td></tr>
        <?php
        if(TD_ACTION_NAME != 'edit'){
        ?>
        <tr><td align="right" width="150px">数据表名称：</td><td align="left"><?=TDWIDGET::text(FORM::$table_name, $info[FORM::$table_name])?> <span class="ui-c-note">（必填）</span></td></tr>
        <?php
        }
        ?>
        <tr><td align="right" width="150px">隐私政策：</td><td align="left"><div style="width:600px"><?=TDWIDGET::editor(FORM::$detail, htmlspecialchars_decode($info[FORM::$detail]))?></div></td></tr>
        <tr><td></td><td><input type="button" class="anniu" id="add" value="提交" /></td></tr>
    </table>
</form>
<?php
require_once dirname(dirname(dirname(__DIR__))) . '/Index/View/Index/sub_bottom.php';
?>