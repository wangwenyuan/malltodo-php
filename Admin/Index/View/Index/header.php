<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理后台</title>
<?php
static_resources();
?>
<style>
.top_menu{ width:160px;}
.ui-c-element{ float:left}
.tab_website .ui-c-element{ width:100%;}
.ui-c-note{ height:30px; line-height:30px; font-size:12px; float:left; padding-left:10px;}
</style>
</head>

<body>
<div id="main_content">
  <table width="100%" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="2"><div class="header">
          <div class="logo"><strong id="logo_name">MALLTODO</strong></div>
          <div class="top_menu"><a href="<?=TDU("Index/Index/index")?>">工作面板</a></div>
          <div class="tab_website" style="float:left; width:350px;">
          	<div style="width:80px; float:left; font-size:14px; line-height:50px;">当前站点：</div><div style="width:240px; padding-top:10px; float:left;"><?=TDWIDGET::select("current_website_id", TDSESSION("website_id"), get_all_website())?></div>
          	<script>
          		$("#current_website_id").change(function(){
          			http.post("<?=TDU("WebSite/Index/switch_websites")?>", {"website_id":$(this).val()}, function(data){
          				layer.msg(data["info"], {
                            time: 2000
                        }, function () {
                            window.location.reload();
                        })
          			});
          		})
          	</script>
          </div>
          <div class="header_right">当前管理员： <a href="javascript:malltodoJs.sub_window('修改资料', '<?=TDU("SystemSet/Admin/material")?>')"> <?=TDSESSION("admin_name")?></a> &nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:sign_out()">退出</a></div>
        <div class="clear"></div>
        </div></td>
    </tr>

<script>
function sign_out(){
	layer.msg('您确定要退出？', {
        time: 0,
        btn: ['确定', '取消'],
        yes: function (index) {
            layer.close(index);
            var url = "<?=TDU("Index/Index/signOut")?>";
    		$.ajax({
    			async : true,
    			type : "POST",
    			dataType : "json",
    			url : url,
    			data : {
    			},
    			success : function(data){
    				if(data["url"]){
    					window.location.href = data["url"];
    				}
    			},
    			error : function(){
    				ret = 'error';
    			}
    		});
        }
    });
}
</script>
    <tr>
      <td id="zuoce" valign="top"><div class="zuo" id="zuo">
          <div class="zuo_kuang_tou">
            <div> <font id="zuo_main_lanmu">营销型网站</font> <span class="icon-arrow-circle-left zuo_main_icon"></span> </div>
          </div>
          <div class="clear"></div>
            <div class="zuo_kuang">
            <?php
            $menu = TDConfig::$menu["admin_home"];
            foreach ($menu as $key => $submenu) {
                if (! $submenu['_isshow']) {
                    continue;
                }
                ?>
            	<div class="zuo_ul">
            		<div class="zuo_tou ul_guanbi"><?=$submenu["_name"]?></div>
            		<?php
                foreach ($submenu as $subkey => $sub_submenu) {
                    if ($subkey == '_name' || $subkey == '_isshow' || $subkey == '_auth' || $subkey == '_icon') {
                        continue;
                    }
                    if (! $sub_submenu['_isshow']) {
                        continue;
                    }
                    ?>
            			<div class="zuo_li <?=$key?>_<?=$subkey?>" data-url='<?=TDU($key . "/" . $subkey . "/index")?>'><?=$sub_submenu["_name"]?></div>
            		<?php
                }
                ?>
            	</div>
            <?php
            }
            ?>
            </div>
        </div>
        <div class="zuo_xiao" id="zuo_xiao">
          <div class="zuo_kuang_tou" style="width:50px; height:45px;"> <span class="icon-arrow-circle-right zuo_main_icon"></span> </div>
          <div class="clear"></div>
            <div class="zuo_kuang">
            <?php
            $menu = TDConfig::$menu["admin_menu_auth"];
            foreach ($menu as $key => $submenu) {
                if (! $submenu['_isshow']) {
                    continue;
                }
                ?>
            	<div class="small_div"><span class="<?=$submenu['_icon']?> small_tubiao"></span>
            		<div class="small_nei_div">
            			<div class="small_a_div small_head_div"><?=$submenu['_name']?></div>
            			<?php
                foreach ($submenu as $subkey => $sub_submenu) {
                    if ($subkey == '_name' || $subkey == '_isshow' || $subkey == '_auth' || $subkey == '_icon') {
                        continue;
                    }
                    if (! $sub_submenu['_isshow']) {
                        continue;
                    }
                    ?>
            				<div class="small_a_div"><a href='<?=TDU($key . "/" . $subkey . "/index")?>'><?=$sub_submenu["_name"]?></a> </div>
            			<?php
                }
                ?>
            			<div class="clear"></div>
            		</div>
            	</div>
            <?php
            }
            ?>
            </div>
        </div></td>
      <td id="youce" valign="top"><div class="you" id="you">
      <div id="you_content">