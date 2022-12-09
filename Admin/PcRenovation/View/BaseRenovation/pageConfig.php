    <div class="ui-c-box" style="font-size: 0.9375rem"><strong>页面设置</strong></div>
    <div class="ui-c-box">
    <div class="ui-c-box-left">模版名称</div>
    <div class="ui-c-box-right"><input id="malltodo_name" type="text" class="ui-c-input" placeholder="请输入" value="<?=$info["name"]?>"
        onkeyup="set_malltodo_config_value('name')" onchange="set_malltodo_config_value('name')" /></div>
        <div class="ui-c-clear"></div>
        </div>
        <?php
        if (TD_CONTROLLER_NAME != "Bottom" && TD_CONTROLLER_NAME != "Header") {
            ?>
            <div class="ui-c-box">
            <div class="ui-c-box-left">页面标题</div>
            <div class="ui-c-box-right"><input id="malltodo_title" type="text" class="ui-c-input" placeholder="请输入" value="<?=$info["title"]?>"
                onkeyup="set_malltodo_config_value('title')" onchange="set_malltodo_config_value('title')" /></div>
                <div class="ui-c-clear"></div>
                </div>
                <div class="ui-c-box">
                <div class="ui-c-box-left">页面关键字</div>
                <div class="ui-c-box-right"><input id="malltodo_keywords" type="text" class="ui-c-input" placeholder="请输入" value="<?=$info["keywords"]?>"
                    onkeyup="set_malltodo_config_value('keywords')" onchange="set_malltodo_config_value('keywords')" /></div>
                    <div class="ui-c-clear"></div>
                    </div>
                    <div class="ui-c-box">
                    <div class="ui-c-box-left">页面描述</div>
                    <div class="ui-c-box-right">
                    <textarea id="malltodo_description" class="ui-c-input" style="height:200px;" onkeyup="set_malltodo_config_value('description')" onchange="set_malltodo_config_value('description')"><?=$info["description"]?></textarea>
                    </div>
                    <div class="ui-c-clear"></div>
                    </div>
                    <div class="ui-c-box">
                    <div class="ui-c-box-left">页面背景色：</div>
                    <div class="ui-c-box-right">
                    <input id="malltodo_background_color" style="margin-top: 0.125rem;" name="background_color" type="color" value="<?php

            echo ($info["background_color"] == "" ? "#FFFFFF" : $info["background_color"])?>" onchange="set_malltodo_config_value('background_color')" /></div>
                    <div class="ui-c-clear"></div>
                    </div>
                    <div class="ui-c-box">
                    <div class="ui-c-box-left">顶部模块：</div>
                    <div class="ui-c-box-right">
                    <select id="malltodo_header_id" name="header_id" class="ui-c-select"  onchange="set_malltodo_config_value('header_id')">
                    <?php
            for ($i = 0; $i < count($header_list); $i = $i + 1) {
                echo "<option value=\"" . $header_list[$i]["id"] . "\">" . $header_list[$i]["name"] . "</option>";
            }
            ?>
                    </select>
                    </div>
                    <div class="ui-c-clear"></div>
                    </div>
                    <div class="ui-c-box">
                    <div class="ui-c-box-left">底部模块：</div>
                    <div class="ui-c-box-right">
                    <select id="malltodo_bottom_id" name="bottom_id" class="ui-c-select"  onchange="set_malltodo_config_value('bottom_id')">
                    <?php
            for ($i = 0; $i < count($bottom_list); $i = $i + 1) {
                echo "<option value=\"" . $bottom_list[$i]["id"] . "\">" . $bottom_list[$i]["name"] . "</option>";
            }
            ?>
                    </select>
                    </div>
                    <div class="ui-c-clear"></div>
                    </div>
                    <?php
        }
        ?>
    <script>
    function set_malltodo_config_value(id){
        var zhi = $("#malltodo_"+id).val();
        if(id == "background_color"){
            zhi = color_to_hex(zhi);
            if($(".ui-c-renovation-phone-body").length == 0){
                $('body').css('background-color', zhi);
                $("#phone_body").css('background-color', zhi);
            }else{
                $(".ui-c-renovation-phone-body").css('background-color', zhi);
                $("#phone_body").css('background-color', zhi);
            }
        }else if(id == "title"){
            $(".ui-c-renovation-phone-title").html("");
            $(".ui-c-renovation-phone-title").html(zhi);
        }
        malltodo_page_config[id] = zhi;
    }
    </script>