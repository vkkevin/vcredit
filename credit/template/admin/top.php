<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>完满学分-头部</title>
<link rel="stylesheet" type="text/css" href="<?php echo APP_CSS_PATH."reset.css"; ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo APP_CSS_PATH."common.css"; ?>" />
<script type="text/javascript">

var admin_info = new Array();
admin_info['role'] = <?php echo "'$item[role]'"; ?>;
admin_info['name'] = <?php echo "'$item[name]'"; ?>;

function login_info(){
	var promat_str = <?php
                        if($item['role'] === 'normal'){
                            echo "'您好，认证管理员';\n";
                        }else{
                            echo "'您好，超级管理员';\n";
                        }
                    ?>
	alert(promat_str);
}
</script>
</head>

<body>
<div class="head clearfix">
	<div class="logo">
    	<a href=""><img src="<?php echo APP_IMAGE_PATH."logo1.png"; ?>" alt="完满教育学分管理"/></a>
    </div>
	<div class="login-info">
		<span>欢迎您，<a href="" onclick="login_info()"><?php echo $item['name']; ?></a> &nbsp;&nbsp;</span>
	</div>
</div>
</body>
</html>
