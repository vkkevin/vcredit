<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加学生</title>
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

function change_student(){
	var stu_form = document.getElementById("student_form");
	stu_form.submit();
}

</script>
<style>
	.hypz li .input_radio input{
		width: 25px;
	}
</style>
</head>

<body onLoad="Resize();">
<div id="right_ctn">
	<div class="right_m">


        	<div class="box_t">
				<span class="name">修改学生数据</span><!--当前位置-->
				<div class="position">
                	<a href="?c=Admin&a=content"><img src=<?php echo APP_IMAGE_PATH."icon5.png"; ?> alt=""/></a>
                    <a href="?c=Admin&a=content">首页</a>
                    <span><img src=<?php echo APP_IMAGE_PATH."icon3.png"; ?> alt=""/></span>
                    <a href="?c=Admin&a=list_student">学生管理</a>
                    <span><img src=<?php echo APP_IMAGE_PATH."icon3.png"; ?> alt=""/></span>
                    <a href="?c=Admin&a=change_student&id=<?php echo $item['student']['id']; ?>">修改学生</a>
				</div>
            </div>


            <form action="?c=Admin&a=change_student_exec" method="post" id="student_form">
              <ul class="hypz">
                    <li class="clearfix"><span class="title">姓名：</span>
                      <div class="li_r">
                            <input name="stuInfo[name]" type="text" value=<?php echo $item['student']['name'];?> >
                        </div>
                    </li>
                    <li class="clearfix"><span class="title">学号：</span>
                      <div class="li_r">
                            <input name="stuInfo[id]" type="text" value=<?php echo $item['student']['id'];?> >
                        </div>
                    </li>
					<li class="clearfix"><span class="title">性别：</span>
                      	<div class="li_r input_radio">
                            <input name="stuInfo[sex]" type="radio" value="man" <?php if($item['student']['sex'] == 'man') echo "checked='checked'"; ?> >男
                            <input name="stuInfo[sex]" type="radio" value="woman" <?php if($item['student']['sex'] == 'woman') echo "checked='checked'"; ?> >女
                        </div>
                    </li>
                    <li class="clearfix"><span class="title">院系：</span>
                      <div class="li_r">
                            <input  name="stuInfo[department]" type="text" value=<?php echo $item['student']['department'];?> >
                            &nbsp;</div>
                    </li>
                     <li class="clearfix"><span class="title">专业：</span>
                       <div class="li_r">
                            <input  name="stuInfo[specialty]" type="text" value=<?php echo $item['student']['specialty'];?> >
                            &nbsp;</div>
                    </li>
                     <li class="clearfix"><span class="title">班级：</span>
                       <div class="li_r">
                            <input  name="stuInfo[class]" type="text" value=<?php echo $item['student']['class'];?> >
                            &nbsp;</div>
                    </li>
                     <li class="clearfix"><span class="title">辅导员：</span>
                       <div class="li_r">
                            <input  name="stuInfo[instructor]" type="text" value=<?php echo $item['student']['instructor'];?> >
                            &nbsp;</div>
                    </li>
                     <li class="clearfix"><span class="title">备注：</span>
                       <div class="li_r">
                            <input  name="stuInfo[remark]" type="text" value=<?php echo $item['student']['remark'];?> >
						</div>
                    </li>


                    <p align="right"><li class="tj_btn"><a onclick="change_student()">保存</a></li></p>
                </ul>


            </form>




	</div>
</div>
</body>
</html>
