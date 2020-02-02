<?php

if(!defined('BASE_PATH')){
  exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>测试</title>
</head>
<frameset rows="50,*" cols="*" frameborder="no" border="0" framespacing="0">
  <frame src="?c=Test&a=top" name="topFrame" scrolling="no">
  <frameset cols="225,*" name="btFrame" frameborder="no" border="0" framespacing="0">
    <frame src="?c=Test&a=menu&class=<?php echo $item['class']?>" noresize name="menu" scrolling="yes">
    <frame src="?c=Test&a=content" class="frame_r" noresize name="main" scrolling="yes">
  </frameset>
</frameset>
<noframes>
<body>您的浏览器不支持框架！</body>
</noframes>
</html>
