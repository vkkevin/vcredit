<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>登录</title>
<link rel="stylesheet" type="text/css" href=<?php echo APP_CSS_PATH."reset.css"; ?> />
<link rel="stylesheet" type="text/css" href=<?php echo APP_CSS_PATH."common.css"; ?> />
<link rel="stylesheet" type="text/css" href=<?php echo APP_CSS_PATH."thems.css"; ?> >
<script type="text/javascript" src=<?php echo APP_JS_PATH."jquery-1.8.3.min.js"; ?> ></script>
<!--框架高度设置-->
<script type="text/javascript">
$(function(){
	//自适应屏幕宽度
	window.onresize=function(){ location=location };

	var w_height=$(window).height();
	$('.bg_img').css('height',w_height+'px');

	var bg_wz=1920-$(window).width();
	$('.bg_img img').css('margin-left','-'+bg_wz/2+'px')

	$('.language .lang').click(function(){
		$(this).siblings('.lang_ctn').toggle();
	});
})

// function login_submit(){
// 	var login_form = document.getElementById("login_form");
// 	login_form.submit();
// }
</script>
<!--框架高度设置-->
<style>
	.login_title {
		font-size: 20px;
	}
</style>
</head>

<body onload="Resize();">
<!--登录-->
<div class="login">
	<div class="bg_img"><img src=<?php echo APP_IMAGE_PATH."login_bg.jpg"; ?> /></div>
	<div class="logo">
    	<p>&nbsp;</p>
    	<p class="login_title">信息工程系完满教育学分管理系统<br/>
    	</p>
    </div>
    <div class="login_m">
    	<form id="login_form" action="?c=Admin&a=validate_login" method="post">
    	<ul>
        	<li class="wz">用户名</li>
            <li><input name="userid" type="text"></li>
            <li class="wz">密码</li>
            <li><input name="password" type="password"></li>
            <li class="l_btn">
            	<button>
					<!-- <a onclick="login_submit()" href="#"> -->
						登录
					<!-- </a> -->
				</button>
            </li>
        </ul>
        </form>
    </div>
</div>
<!--登录-->
</body>
</html>
