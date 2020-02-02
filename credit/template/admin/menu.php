<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>完满学分-菜单</title>
<link rel="stylesheet" type="text/css" href=<?php echo APP_CSS_PATH."reset.css"; ?> />
<link rel="stylesheet" type="text/css" href=<?php echo APP_CSS_PATH."common.css"; ?> />
<script type="text/javascript" src=<?php echo APP_JS_PATH."jquery-1.8.3.min.js"; ?> ></script>
<!--框架高度设置-->
<script type="text/javascript">
$(function(){
	$('.sidenav li').click(function(){
		$(this).siblings('li').removeClass('now');
		$(this).addClass('now');
	});

	$('.erji li').click(function(){
		$(this).siblings('li').removeClass('now_li');
		$(this).addClass('now_li');
	});

	window.onresize=function(){ location=location };
	var main_h = $(window).height();
	$('.sidenav').css('height',main_h+'px');
})
</script>
<!--框架高度设置-->
</head>

<body>
<div id="left_ctn">
    <ul class="sidenav">
<?php
    if(!isset($item))
        $item = array();

	foreach ($item['menu'] as $menu1) {
?>
		<li>
			<a <?php if(isset($menu1['url'])) echo "href=$menu1[url]"; ?> target=<?php echo isset($menu1['target'])?$menu1['target']:'""'; ?> >
				<div class="nav_m">
					<span><?php if(isset($menu1['name'])) echo $menu1['name']; ?></span>
					<?php if(!isset($menu1['url'])) echo '<i>&nbsp;</i>'; ?>
				</div>
			</a>
			<ul class="erji">
<?php
		if(isset($menu1['menu'])){
			foreach ($menu1['menu'] as $menu2) {
?>
				<li>
					<span><a href=<?php echo isset($menu2['url'])?$menu2['url']:''; ?> target=<?php echo isset($menu2['target'])?$menu2['target']:''; ?> ><?php echo isset($menu2['name'])?$menu2['name']:''; ?></a></span>
				</li>
<?php
			}
		}
?>
			</ul>
		</li>
<?php
	}
?>
    </ul>
</div>
</body>
</html>
