<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=8" >
<title>数据库管理</title>
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
	$('.sjbf').css('width',main_w-40+'px');
});

function upload_file(){
    var input_file = document.getElementById('upload');
    input_file.click();
}

function submit_file(){
    var submit_file = document.getElementById('file_form');
    submit_file.submit();
}
</script>
<style type="text/css">
    #upload{
        display: none;
    }
</style>
</head>

<body onLoad="Resize();">
<div id="right_ctn">
	<div class="right_m">
		<!--数据库操作-->
        <div class="hy_list">
        	<div class="box_t">
            	<span class="name">数据库备份/还原</span>
                <!--当前位置-->
                <div class="position">
                	<a href=""><img src=<?php echo APP_IMAGE_PATH."icon5.png"; ?> alt=""/></a>
                    <a href="">首页</a>
                    <span><img src=<?php echo APP_IMAGE_PATH."icon3.png"; ?> alt=""/></span>
                    <a href="">系统维护</a>
                    <span><img src=<?php echo APP_IMAGE_PATH."icon3.png"; ?> alt=""/></span>
                    <a href="">数据库管理</a>
                </div>
                <!--当前位置-->
            </div>
            <div class="space_hx">&nbsp;</div>
            <!--导入数据库-->
            <form id="file_form" action="?c=Test&a=upload_exec" method="post">
            <div class="sjbf">
 				<div class="sjbf_a" style=" height:100px;">
                	<div class=" space_hx">&nbsp;</div>
                    <div class=" space_hx">&nbsp;</div>
                    <a href="" class="btn_bg btn_l">导出</a>
                </div>
                <div class="sjbf_b">
                	<ul class="clearfix">
                    	<li class="sjbf_b1">选择数据库备份文件：</li>
                        <li class="sjbf_b2">
                        	<input id="upload" name="" value="请选择路径" type="file">
                        </li>
                        <li class="sjbf_b3">
                        	<a href="#" class="btn_bg btn_h" onclick="upload_file()">浏览</a>
                        </li>
                    </ul>
                    <div class="space_hx">&nbsp;</div>
                	<a href="#" class="btn_bg btn_l" onclick="submit_file()">导入</a>
                </div>
            </div>
            </form>
            <!--导入数据库-->
        </div>
        <!--数据库操作-->
    </div>
</div>
</body>
</html>
