<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改密码</title>
<link rel="stylesheet" type="text/css" href=<?php echo APP_CSS_PATH."changepwd.css"; ?> />
<link rel="stylesheet" type="text/css" href=<?php echo APP_CSS_PATH."reset.css"; ?> />
<link rel="stylesheet" type="text/css" href=<?php echo APP_CSS_PATH."common.css"; ?> />
<link rel="stylesheet" type="text/css" href=<?php echo APP_CSS_PATH."thems.css"; ?> >
<script type="text/javascript" src=<?php echo APP_JS_PATH."jquery.min.js"; ?> ></script>
</head>
<body>
	<div id="pageAll" class="right_m">
		<div class="box_t">
			<span class="name">重置密码</span><!--当前位置-->
			<div class="position">
            	<a href="?c=Admin&a=content"><img src=<?php echo APP_IMAGE_PATH."icon5.png"; ?> alt=""/></a>
                <a href="?c=Admin&a=content">首页</a>
                <span><img src=<?php echo APP_IMAGE_PATH."icon3.png"; ?> alt=""/></span>
                <a href="?c=Admin&a=change_password">重置密码</a>
			</div>
        </div>

		<div class="page ">
			<!-- 修改密码页面样式 -->
			<div class="bacen">
				<form method="post" action="?c=Admin&a=change_password_exec">
					<p align="center">密码长度必须大于等于六位</p>
					<div class="bbD">
						输入原始密码：<input name="password[old]" type="password" class="input3" onblur="checkpwd1()" id="pwd1" />
						<img class="imga" src=<?php echo APP_IMAGE_PATH."changepwd/ok.png"; ?> />
						<img class="imgb" src=<?php echo APP_IMAGE_PATH."changepwd/no.png"; ?> />
					</div>
					<div class="bbD">
						&nbsp;
						输入新密码：<input name="password[new1]" type="password" class="input3" onblur="checkpwd2()" id="pwd2" />
						<img class="imga" src=<?php echo APP_IMAGE_PATH."changepwd/ok.png"; ?> />
						<img class="imgb" src=<?php echo APP_IMAGE_PATH."changepwd/no.png"; ?> />
					</div>
					<div class="bbD">
						再次确认密码：<input name="password[new2]" type="password" class="input3" onblur="checkpwd3()" id="pwd3" />
						<img class="imga" src=<?php echo APP_IMAGE_PATH."changepwd/ok.png"; ?> />
						<img class="imgb" src=<?php echo APP_IMAGE_PATH."changepwd/no.png"; ?> />
					</div>
					<div class="bbD">
						<p class="bbDP">
							<button id="submit" class="btn_ok btn_yes" href="#">提交</button>
							<a class="btn_ok btn_no" href="#">取消</a>
						</p>
					</div>
				</form>
			</div>

			<!-- 修改密码页面样式end -->
		</div>
	</div>
</body>
<script type="text/javascript">
function checkpwd1(){
var user = document.getElementById('pwd1').value.trim();
 if (user.length >= 6 && user.length <= 12) {
  $("#pwd1").parent().find(".imga").show();
  $("#pwd1").parent().find(".imgb").hide();
  var btn = document.getElementById('submit');
  btn.setAttribute("disabled","");
 }else{
  $("#pwd1").parent().find(".imgb").show();
  $("#pwd1").parent().find(".imga").hide();
  var btn = document.getElementById('submit');
  btn.setAttribute("disabled","disabled");
 };
}
function checkpwd2(){
var user = document.getElementById('pwd2').value.trim();
 if (user.length >= 6 && user.length <= 12) {
  $("#pwd2").parent().find(".imga").show();
  $("#pwd2").parent().find(".imgb").hide();
  var btn = document.getElementById('submit');
  btn.setAttribute("disabled","");
 }else{
  $("#pwd2").parent().find(".imgb").show();
  $("#pwd2").parent().find(".imga").hide();
  var btn = document.getElementById('submit');
  btn.setAttribute("disabled","disabled");
 };
}
function checkpwd3(){
var user = document.getElementById('pwd3').value.trim();
var pwd = document.getElementById('pwd2').value.trim();
 if (user.length >= 6 && user.length <= 12 && user == pwd) {
  $("#pwd3").parent().find(".imga").show();
  $("#pwd3").parent().find(".imgb").hide();
  var btn = document.getElementById('submit');
  btn.setAttribute("disabled","");
 }else{
   $("#pwd3").parent().find(".imgb").show();
  $("#pwd3").parent().find(".imga").hide();
  var btn = document.getElementById('submit');
  btn.setAttribute("disabled","disabled");
 };
}
</script>
</html>
