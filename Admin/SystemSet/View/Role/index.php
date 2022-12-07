<?php
require_once dirname(dirname(dirname(__DIR__))) . '/Index/View/Index/sub_header.php';
?>
<form method="post" action="" id="html_form">
    <table width="100%" cellpadding="0" cellspacing="0" class="small_main_table">

<?php
foreach ($role as $k => $v) {
    if ($k == '_name' || $k == '_isshow' || $k == '_auth' || $k == '_icon') {
        continue;
    }
    foreach ($v as $kk => $vv) {
        if ($kk == '_isshow' || $kk == '_auth' || $kk == '_icon' || $kk == '_name') {
            continue;
        }
        echo '<tr><td align="right" width="100px" valign="top">' . $vv['_name'] . '：</td><td align="left">';
        foreach ($vv as $kkk => $vvv) {
            if ($kkk == '_isshow' || $kkk == '_auth' || $kkk == '_icon') {
                continue;
            }
            if ($kkk == '_name') {
                if (in_array($k . '+' . $kk, $role_list)) {
                    $checked = 'checked = "checked"';
                } else {
                    $checked = '';
                }
                echo '<input type="checkbox" name="r[]" value="' . $k . '+' . $kk . '" class="' . $k . ' ' . $k . '_' . $kk . '" title="' . $vvv . '" data-level="2" ' . $checked . ' >' . $vvv . '<br />';
            } else {
                if (in_array($k . '+' . $kk . '+' . $kkk, $role_list)) {
                    $checked = 'checked = "checked"';
                } else {
                    $checked = '';
                }
                echo '<input type="checkbox" name="r[]" value="' . $k . '+' . $kk . '+' . $kkk . '" class="' . $k . ' ' . $k . '_' . $kk . ' ' . $k . '_' . $kk . '_' . $kkk . '" title="' . $vvv . '" data-level="3" ' . $checked . ' >' . $vvv . "&nbsp;&nbsp;";
            }
        }
        echo '</td></tr>';
    }
}
?>
        <tr><td></td><td><input type="button" class="anniu" id="add" value="提交" /></td></tr>
    </table>
</form>
<script>
$("input[type='checkbox']").change(function(){
	var zhi = $(this).val();
	var zhi_arr = new Array();
	zhi_arr = zhi.split('+');
	if(zhi_arr.length == 2){
		if($(this).prop('checked')){
			$('.'+zhi_arr[0]+"_"+zhi_arr[1]).prop('checked', true);
		}else{
			$('.'+zhi_arr[0]+"_"+zhi_arr[1]).prop('checked', false);
		}
	}
})
</script>
<?php
require_once dirname(dirname(dirname(__DIR__))) . '/Index/View/Index/sub_bottom.php';
?>