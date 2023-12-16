<?php
require_once dirname(dirname(dirname(__DIR__))) . '/Index/View/Index/sub_header.php';
?>
<div style="padding:15px;">
<div class="main_title">字段管理</div><a target="_blank" class="note_marker" href="<?=DocU(TD_MODULE_NAME . "/" . TD_CONTROLLER_NAME . "/". TD_ACTION_NAME) ?>">(操作指南)</a>
<a onclick="malltodoJs.sub_window('新建字段', '<?=TDU(TD_MODULE_NAME . "/" . TD_CONTROLLER_NAME . "/add", array('fid'=>TDI('get.fid')))?>')" class="main_button">新建字段</a>
<a onclick="malltodoJs.sub_window('新建小标题', '<?=TDU(TD_MODULE_NAME . "/" . TD_CONTROLLER_NAME . "/addTitle", array('fid'=>TDI('get.fid')))?>')" class="main_button" style="margin-right:10px;">新建小标题</a>
<div class="clear_5px"></div>
  <table width="100%" cellpadding="0" cellspacing="0" class="main_table">
    <tr class="main_table_header">
      <td>字段标识</td>
      <td>字段名</td>
      <td>字段类型</td>
      <td>是否必填</td>
      <td>是否搜索项</td>
      <td>列表是否展示</td>
      <td>验证类型</td>
      <td>是否系统字段</td>
      <td width="100px">操作</td>
    </tr>

    <?php
    if (count($list) == 0) {
        echo '<tr><td colspan=9>尚未创建字段</td></tr>';
    } else {
        for ($i = 0; $i < count($list); $i = $i + 1) {
            $arr = array("fid"=>TDI('get.fid'), 'id'=>$list[$i]['id']);
            if($list[$i]['type'] == 1){
                $caozuo = "系统保留字段";
            }else if($list[$i]['type'] == 2){
                $caozuo = "<a href=\"javascript:malltodoJs.sub_window('编辑字段', '" . TDU(TD_MODULE_NAME . "/" . TD_CONTROLLER_NAME . "/edit", $arr) . "')\">修改</a> <a href=\"javascript:malltodoJs.del('" . TDU(TD_MODULE_NAME . "/" . TD_CONTROLLER_NAME . "/del", $arr) . "','" . $list[$i][FORM_FIELDS::$id] . "')\">删除</a>";
            }else if($list[$i]['type'] == 3){
                $caozuo = "<a href=\"javascript:malltodoJs.sub_window('编辑小标题', '" . TDU(TD_MODULE_NAME . "/" . TD_CONTROLLER_NAME . "/editTitle", $arr) . "')\">修改</a> <a href=\"javascript:malltodoJs.del('" . TDU(TD_MODULE_NAME . "/" . TD_CONTROLLER_NAME . "/del", $arr) . "','" . $list[$i][FORM_FIELDS::$id] . "')\">删除</a>";
            }
            if($list[$i]['type'] == 1 || $list[$i]['type'] == 2){
                echo '<tr>
            		  <td>'.$list[$i]['name'].'</td>
            		  <td>'.$list[$i]['field_name'].'</td>
            		  <td>'.TDConfig::$config["field"][$list[$i]['field_type']].'</td>
            		  <td>'.($list[$i]['is_required'] ? "是" : "否").'</td>
            		  <td>'.($list[$i]['is_search'] ? "是" : "否").'</td>
					  <td>'.($list[$i]['is_in_list'] ? "是" : "否").'</td>
            		  <td>'.TDConfig::$config["verification"][$list[$i]['verification']].'</td>
            		  <td>'.(($list[$i]['type'] == 1) ? "是" : "否").'</td>
            		  <td>'.$caozuo.'</td>
          		  </tr>';
            }else{
                echo '<tr>
            		  <td colspan="8">'.$list[$i]['name'].'  ----（小标题）</td>
            		  <td>'.$caozuo.'</td>
          		  </tr>';
            }
        }
    }
    ?>
    </table>
</div>
<?php
require_once dirname(dirname(dirname(__DIR__))) . '/Index/View/Index/sub_bottom.php';
?>