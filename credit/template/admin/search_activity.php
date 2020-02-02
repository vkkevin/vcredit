<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>活动列表</title>
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

	var search_w = $(window).width()-40;
	$('.search').css('width',search_w+'px');
	$('.list_hy').css('width',search_w+'px');
});

/* 批量操作数据 */
function operation_batch(operation){
	var op_batch_form = document.getElementById('op_batch_form');
	op_batch_form.action = "?c=Admin&a="+operation;
	op_batch_form.submit();
}

/* 全选 */
function check_all(){
	var checkall = document.getElementById('checkall');
	var check_data = document.getElementsByName('check_data[]');
	for(var i = 0; i < check_data.length; i++){
		if(check_data[i].type == 'checkbox'){
			check_data[i].checked = checkall.checked;
		}
	}
}

function search_data(){
	var search_form = document.getElementById('search_form');
	search_form.submit();
}

</script>
<!--框架高度设置-->
</head>

<body onLoad="Resize();">
<div id="right_ctn">
	<div class="right_m">
		<!--活动列表-->
        <div class="hy_list">
        	<div class="box_t">
            	<span class="name">活动列表</span>
                <!--当前位置-->
                <div class="position">
                	<a href="?c=Admin&a=content"><img src=<?php echo APP_IMAGE_PATH."icon5.png"; ?> alt=""/></a>
                    <a href="?c=Admin&a=content">首页</a>
                    <span><img src=<?php echo APP_IMAGE_PATH."icon3.png"; ?> alt=""/></span>
                    <a href="?c=Admin&a=list_activity">活动管理</a>
                    <span><img src=<?php echo APP_IMAGE_PATH."icon3.png"; ?> alt=""/></span>
                    <a href="?c=Admin&a=list_activity">活动列表</a>
                </div>
                <!--当前位置-->
            </div>

            <!--查询-->
            <div class="search">
				<form action="?c=Admin&a=search_activity" method="post" id="search_form">
            	<span>按名称查询：</span>
                <div class="s_text"><input name="where[s_name]" type="text"></div>
				<!-- <select name="s_logic">
					<option value="or">或</option>
					<option value="and">和</option>
				</select> -->
				<span>按<select name="where[s_condition]">
					<option value="type">类型</option>
					<option value="date">日期</option>
				</select>查询：</span>
				<div class="s_text"><input name="where[s_condition_text]" type="text"></div>
                <a onclick="search_data()" class="btn" href="#">查询</a>
				</form>
            </div>
            <!--查询-->

            <div class="space_hx">&nbsp;</div>
            <!--列表-->
            <form action="#" method="post" id="op_batch_form">
            <table cellpadding="0" cellspacing="0" class="list_hy">
              <tr>
                <th class="xz" scope="col">选择</th>
                <th scope="col"><div>名称<a href="" class="up">&nbsp;</a><a href="" class="down">&nbsp;</a></div></th>
                <th class="zt" scope="col"><div>简介<a href="" class="up">&nbsp;</a><a href="" class="down">&nbsp;</a></div></th>
                <th scope="col">类型</th>
                <th scope="col">标准学分</th>
                <th scope="col">日期</th>
                <th scope="col">地点</th>
                <th scope="col">人数</th>
				<!-- <th scope="col">备注</th> -->
				<th	scope="col">操作</th>
              </tr>
<?php
    if($item['activities'] == false){
        exit('Error');
    }
	foreach($item['activities'] as $act){
?>
		<tr>
			<td class="xz"><input name="check_data[]" type="checkbox" value=<?php echo $act['id']; ?> ></td>
			<td><?php echo $act['name']; ?></td>
			<td><?php echo $act['introduction']; ?></td>
			<td><?php echo $act['type']; ?></td>
			<td><?php echo $act['stdcredit']; ?></td>
			<td><?php echo $act['date']; ?></td>
			<td><?php echo $act['locale']; ?></td>
			<td><?php echo $act['people_number']; ?></td>
			<!-- <td><?php // echo $act['remark']; ?></td> -->
			<td>
				<a href="?c=Admin&a=show_activity&id=<?php echo $act['id'] ?>" class="btn">查看</a>
				<a href="?c=Admin&a=change_activity&id=<?php echo $act['id'] ?>" class="btn">修改</a>
				<a href="?c=Admin&a=del_activity&id=<?php echo $act['id'] ?>" class="btn">删除</a>
			</td>
	  	</tr>
<?php
	}
?>
            </table>
            <!--列表-->
            <!--右边底部-->
            <div class="r_foot">
            	<div class="r_foot_m">
            	<span>
                	<input id="checkall" onclick="check_all()" type="checkbox" value="">
                    <em>全部选中</em>
                </span>
                <a href="#" onclick="operation_batch('del_activity_batch')" class="btn">删除</a>
                <a href="?c=Admin&a=list_activity" class="btn">刷新</a>
                </div>
            </div>
            </form>
            <!--右边底部-->
        </div>
        <!--会议列表-->
    </div>
</div>
</body>
</html>
