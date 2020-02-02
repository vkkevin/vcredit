<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改活动信息</title>
<link rel="stylesheet" type="text/css" href=<?php echo APP_CSS_PATH."reset.css"; ?> />
<link rel="stylesheet" type="text/css" href=<?php echo APP_CSS_PATH."common.css"; ?> />
<link rel="stylesheet" type="text/css" href=<?php echo APP_CSS_PATH."thems.css"; ?> >
<script type="text/javascript" src=<?php echo APP_JS_PATH."jquery-1.8.3.min.js"; ?> ></script>
<script type="text/javascript">
$(function(){
	//自适应屏幕宽度
	window.onresize=function(){ location=location };

	var main_h = $(window).height();
	$('.hy_list').css('height',main_h-45+'px');

	var main_w = $(window).width();
	$('.xjhy').css('width',main_w-40+'px');

});

function change_activity(){
	var act_form = document.getElementById("activity_form");
	act_form.submit();
}

</script>
</head>

<body onLoad="Resize();">
<div id="right_ctn">
	<div class="right_m">
    	<div class="box_t">
			<span class="name">修改活动信息</span><!--当前位置-->
			<div class="position">
            	<a href="?c=Admin&a=content"><img src=<?php echo APP_IMAGE_PATH."icon5.png"; ?> alt=""/></a>
                <a href="?c=Admin&a=content">首页</a>
                <span><img src=<?php echo APP_IMAGE_PATH."icon3.png"; ?> alt=""/></span>
                <a href="?c=Admin&a=list_activity">活动管理</a>
                <span><img src=<?php echo APP_IMAGE_PATH."icon3.png"; ?> alt=""/></span>
                <a href="?c=Admin&a=change_activity&id=<?php echo $item['activity']['id']; ?>">修改活动</a>
			</div>
        </div>

        <form action="?c=Admin&a=change_activity_exec" method="post" id="activity_form">
          <ul class="hypz">
				<li class="clearfix"><span class="title">活动ID：</span>
				  <div class="li_r">
					  <input  name="actInfo[id]" type="text" value="<?php echo $item['activity']['id']; ?>" >
				  </div>
				</li>
                <li class="clearfix"><span class="title">活动名称：</span>
                	<div class="li_r">
                        <input  name="actInfo[name]" type="text" value="<?php echo $item['activity']['name']; ?>" >
                    </div>
                </li>
				<li class="clearfix"><span class="title">活动简介：</span>
					<div class="li_r">
						<input  name="actInfo[introduction]" type="text" value="<?php echo $item['activity']['introduction']; ?>" >
					</div>
				</li>
				<li class="clearfix"><span class="title">活动类型：</span>
					<div class="li_r">
						<select name="actInfo[type_id]">
<?php
 	foreach ($item['typeInfo'] as $v) {
		if($v['name'] == $item['activity']['type']){
			echo "<option selected='selected' value=".$v['id'].">".$v['name']."</option>";
		}else{
 			echo "<option value=".$v['id'].">".$v['name']."</option>";
		}
	}
?>
						</select>
					</div>
				</li>
				<li class="clearfix"><span class="title">标准学分：</span>
					<div class="li_r">
						<input  name="actInfo[stdcredit]" type="text" value="<?php echo $item['activity']['stdcredit']; ?>" >
					</div>
				</li>
				<li class="clearfix"><span class="title">活动日期：</span>
					<div class="li_r">
						<input  name="actInfo[date]" type="date" value="<?php echo $item['activity']['date']; ?>" >
					</div>
				</li>
				<li class="clearfix"><span class="title">活动地点：</span>
					<div class="li_r">
						<input  name="actInfo[locale]" type="text" value="<?php echo $item['activity']['locale']; ?>" >
					</div>
				</li>
				<li class="clearfix"><span class="title">活动人数：</span>
					<div class="li_r">
						<input  name="actInfo[people_number]" type="text" value="<?php echo $item['activity']['people_number']; ?>" >
					</div>
				</li>
				<li class="clearfix"><span class="title">备注：</span>
					<div class="li_r">
						<input  name="actInfo[remark]" type="text" value="<?php echo $item['activity']['remark']; ?>" >
					</div>
				</li>
                <p align="right"><li class="tj_btn"><a onclick="change_activity()">保存</a></li></p>
            </ul>
        </form>
	</div>
</div>
</body>
</html>
