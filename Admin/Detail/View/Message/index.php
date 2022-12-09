<?php
require_once dirname(dirname(dirname(__DIR__))) . '/Index/View/Index/header.php';
?>
<div style="padding:15px;">
            <div class="main_title"><?=$page_action?>管理</div>
            <div class="clear_5px"></div>
              <table width="100%" cellpadding="0" cellspacing="0" class="main_table">
                <tr class="main_table_header">
                  <td>姓名</td>
                  <td>手机号</td>
                  <td>邮箱</td>
                  <td>IP</td>
                  <td>提交时间</td>
                  <td width="50px">操作</td>
                </tr>
                <?php
                if (count($list) == 0) {
                    echo "<tr><td colspan=6>尚未有任何留言信息</td></tr>";
                } else {
                    for ($i = 0; $i < count($list); $i = $i + 1) {
                        $jsonObject = $list[$i];
                        echo "<tr>";
                        echo "<td>" . $jsonObject[MESSAGE::$name] . "</td>";
                        echo "<td>" . $jsonObject[MESSAGE::$tel] . "</td>";
                        echo "<td>" . $jsonObject[MESSAGE::$email] . "</td>";
                        echo "<td>" . $jsonObject[MESSAGE::$ip] . "</td>";
                        echo "<td>" . date("Y-m-d H:i:s", $jsonObject[MESSAGE::$addtime]) . "</td>";
                        echo "<td><a href=\"javascript:malltodoJs.del('" . TDU(TD_MODULE_NAME . "/" . TD_CONTROLLER_NAME . "/del") . "','" . $jsonObject["id"] . "')\">删除</a></td>";
                        echo "</tr>";
                        echo "<tr><td colspan=6>" . $jsonObject[MESSAGE::$message] . "</td></tr>";
                    }
                }
                ?>
                </table>
                <div class="page"><?=$page?></div>
            </div>
<?php
require_once dirname(dirname(dirname(__DIR__))) . '/Index/View/Index/bottom.php';
?>