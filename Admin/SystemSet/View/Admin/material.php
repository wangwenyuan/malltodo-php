<?php
require_once dirname(dirname(dirname(__DIR__))) . '/Index/View/Index/sub_header.php';
?>
<form method="post" action="" id="html_form">
    <table width="100%" cellpadding="0" cellspacing="0" class="small_main_table">
        <tr><td align="right" width="150px">登录用户名：</td><td align="left"><?=TDWIDGET::text(ADMIN::$username, $info[ADMIN::$username])?></td></tr>
        <tr><td align="right" width="150px">登录密码：</td><td align="left"><?=TDWIDGET::password(ADMIN::$password, "")?> <div style="clear:both;"></div><br />(留空表示不修改密码，密码必需包含大小写字母和数字以及特殊字符，且密码要大于8位)</td></tr>
        <tr><td align="right" width="150px">联系方式：</td><td align="left"><?=TDWIDGET::text(ADMIN::$mobile, $info[ADMIN::$mobile])?></td></tr>
        <tr><td></td><td><input type="button" class="anniu" id="add" value="提交" /></td></tr>
    </table>
</form>
<?php
require_once dirname(dirname(dirname(__DIR__))) . '/Index/View/Index/sub_bottom.php';
?>