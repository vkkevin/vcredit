<?php
if(!defined('BASE_PATH')){
  echo "<script>window.parent.location.href='http://myphp.com/mymgt/?c=Admin&a=index'</script>";
  exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>完满学分-后台管理</title>
<style>
body
{
  scrollbar-base-color:#C0D586;
  scrollbar-arrow-color:#FFFFFF;
  scrollbar-shadow-color:DEEFC6;
}
</style>
</head>
<frameset rows="50,*" cols="*" frameborder="no" border="0" framespacing="0">
  <frame src="?c=Admin&a=top" name="topFrame" scrolling="no">
  <frameset cols="225,*" name="btFrame" frameborder="no" border="0" framespacing="0">
    <frame src="?c=Admin&a=menu" noresize name="menu" scrolling="yes">
    <frame src="?c=Admin&a=content" class="frame_r" noresize name="main" scrolling="yes">
  </frameset>
</frameset>
<noframes>
<body>您的浏览器不支持框架！</body>
</noframes>
</html>
