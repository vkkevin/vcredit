<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加活动</title>
<link rel="stylesheet" type="text/css" href=<?php echo APP_CSS_PATH."reset.css"; ?> />
<link rel="stylesheet" type="text/css" href=<?php echo APP_CSS_PATH."common.css"; ?> />
<link rel="stylesheet" type="text/css" href=<?php echo APP_CSS_PATH."thems.css"; ?> >
<script type="text/javascript" src=<?php echo APP_JS_PATH."jquery-1.8.3.min.js"; ?> ></script>
<?php
	echo "<script type='text/javascript'>\n"
		."\tvar credit_arr = new Array();\n";
	foreach ($item['activities'] as $v) {
		echo "\tcredit_arr[$v[id]] = $v[stdcredit];\n";
	}
	echo "</script>\n";
?>
<script type="text/javascript">
$(function(){
	//自适应屏幕宽度
	window.onresize=function(){ location=location };

	var main_h = $(window).height();
	$('.hy_list').css('height',main_h-45+'px');

	var main_w = $(window).width();
	$('.xjhy').css('width',main_w-40+'px');

});

$(function(){
	select_activity();
})

function add_credit(){
	var cdt_form = document.getElementById("credit_form");
	cdt_form.submit();
}

function select_activity(){
	var activity_id = document.getElementsByName("cdtInfo[activity_id]");
	var prompt_credit = document.getElementById("prompt_credit");
	prompt_credit.innerText = '建议学分:'+credit_arr[activity_id[0].value];
}
</script>
</head>

<body onLoad="Resize();">
<div id="right_ctn">
	<div class="right_m">
    	<div class="box_t">
			<span class="name">添加学分认定</span><!--当前位置-->
			<div class="position">
            	<a href="?c=Admin&a=content"><img src=<?php echo APP_IMAGE_PATH."icon5.png"; ?> alt=""/></a>
                <a href="?c=Admin&a=content">首页</a>
                <span><img src=<?php echo APP_IMAGE_PATH."icon3.png"; ?> alt=""/></span>
                <a href="?c=Admin&a=list_credit_need">学分认定管理</a>
                <span><img src=<?php echo APP_IMAGE_PATH."icon3.png"; ?> alt=""/></span>
                <a href="?c=Admin&a=add_credit_cogizance">添加学分认定</a>
			</div>
        </div>
<?php
	// 将 php 中的数据传至 js 中

?>
        <form action="?c=Admin&a=add_credit_cogizance_exec" method="post" id="credit_form">
          <ul class="hypz">
				<li class="clearfix"><span class="title">学号：</span>
				  <div class="li_r">
					  <input  name="cdtInfo[student_id]" type="text">
				  </div>
				</li>
                <li class="clearfix"><span class="title">活动：</span>
                	<div class="li_r">
                        <select name="cdtInfo[activity_id]" onchange="select_activity()">
<?php
	foreach ($item[activities] as $v) {
		echo "<option value='$v[id]'>$v[name]</option>";
	}
?>
						</select>
                    </div>
                </li>
				<li class="clearfix"><span class="title">认定学分：</span>
					<div class="li_r">
						<input  name="cdtInfo[cogizance_credit]" type="text">
						<span id="prompt_credit" class="prompt"></span>
					</div>
				</li>
				<li class="clearfix"><span class="title">认定原因：</span>
					<div class="li_r">
						<input  name="cdtInfo[cogizance_cause]" type="text">
					</div>
				</li>
				<li class="clearfix"><span class="title">备注：</span>
					<div class="li_r">
						<input  name="cdtInfo[remark]" type="text">
					</div>
				</li>
                <p align="right"><li class="tj_btn"><a href="#" onclick="add_credit()">保存</a></li></p>
            </ul>
        </form>
	</div>
</div>
</body>
</html>
