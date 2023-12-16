<?php
require_once dirname(dirname(dirname(__DIR__))) . '/Index/View/Index/sub_header.php';
?>
<form method="post" action="" id="html_form">
    <table width="100%" cellpadding="0" cellspacing="0" class="small_main_table">
        <tr><td align="right" width="150px">首页</td><td align="left" id="index_box"> 待刷新 </td></tr>
        <tr><td align="right" width="150px">列表页</td><td align="left" id="category_box"> 待刷新 </td></tr>
        <tr><td align="right" width="150px">详情页</td><td align="left" id="detail_box"> 待刷新 </td></tr>
    </table>
</form>

<script>

$(function(){
	var urlarr = <?php echo json_encode($linkArr, JSON_UNESCAPED_UNICODE); ?>;
	var postList = new Array();
	for(var key in urlarr){
    	for(var i=0; i<urlarr[key].length; i=i+1){
    		var id = 0;
    		if(key != "index"){
    			id = urlarr[key][i]["id"];
    		}
    		var input_data = {
        		"type": key,
        		"website_id": urlarr[key][i]["website_id"],
        		"id": id,
        		"i": i
        	};
        	postList.push(input_data);
    	}
    }
    var i = 0;
    var timer = setInterval(function(){
    	if(i < postList.length){
    		http.post("<?php echo TDU("Index/RebuildCache/rebuildCache")?>", postList[i], function(data){
        		var info = data['info'];
        		var retArr = info.split('--');
        		var retKey = retArr[0];
        		var retI   = parseInt(retArr[1]);
        		if((retI+1) < urlarr[retKey].length){
        			$("#"+retKey+"_box").html((retI+1)+"/"+(urlarr[retKey].length)+"（正在刷新）");
        		}else{
        			$("#"+retKey+"_box").html((retI+1)+"/"+(urlarr[retKey].length)+"（刷新完成）");
        		}
        	});
        	i = i + 1;
    	}else{
    		clearInterval(timer);
    	}
    }, 2000);
})
</script>

<?php
require_once dirname(dirname(dirname(__DIR__))) . '/Index/View/Index/sub_bottom.php';
?>