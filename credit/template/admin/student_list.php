<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>学生列表</title>
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
		<!--会议列表-->
        <div class="hy_list">
        	<div class="box_t">
            	<span class="name">学生列表</span>
                <!--当前位置-->
                <div class="position">
                	<a href="?c=Admin&a=content"><img src=<?php echo APP_IMAGE_PATH."icon5.png"; ?> alt=""/></a>
                    <a href="?c=Admin&a=content">首页</a>
                    <span><img src=<?php echo APP_IMAGE_PATH."icon3.png"; ?> alt=""/></span>
                    <a href="?c=Admin&a=list_student">学生管理</a>
                    <span><img src=<?php echo APP_IMAGE_PATH."icon3.png"; ?> alt=""/></span>
                    <a href="?c=Admin&a=list_student">学生列表</a>
                </div>
                <!--当前位置-->
            </div>

            <!--查询-->
            <div class="search">
				<form action="?c=Admin&a=search_student" method="post" id="search_form">
            	<span>按姓名查询：</span>
                <div class="s_text"><input name="where[s_name]" type="text"></div>
				<!-- <select name="s_logic">
					<option value="or">或</option>
					<option value="and">和</option>
				</select> -->
				<span>按<select name="where[s_condition]">
					<option value="department">院系</option>
					<option value="specialty">专业</option>
					<option value="class">班级</option>
					<option value="instructor">辅导员</option>
				</select>查询：</span>
				<div class="s_text"><input name="where[s_condition_text]" type="text"></div>
				<span>按学号查询：</span>
				<div class="s_text"><input name="where[s_id]" type="text"></div>
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
                <th scope="col"><div>学号</div></th>
                <th class="zt" scope="col"><div>姓名</div></th>
                <th scope="col">性别</th>
                <th scope="col">院系</th>
                <th scope="col">专业</th>
                <th scope="col">班级</th>
                <th scope="col">辅导员</th>
				<!-- <th scope="col">备注</th> -->
				<th	scope="col">操作</th>
              </tr>
<?php
    if($item['students'] == false){
        exit('Error');
    }
	foreach($item['students'] as $stu){
?>
		<tr>
			<td class="xz"><input name="check_data[]" type="checkbox" value=<?php echo $stu['id']; ?> ></td>
			<td><?php echo $stu['id']; ?></td>
			<td><?php echo $stu['name']; ?></td>
			<td><?php echo $stu['sex']=='man'?'男':'女'; ?></td>
			<td><?php echo $stu['department']; ?></td>
			<td><?php echo $stu['specialty']; ?></td>
			<td><?php echo $stu['class']; ?></td>
			<td><?php echo $stu['instructor']; ?></td>
			<!-- <td><?php // echo $stu['remark']; ?></td> -->
			<td>
				<a href="?c=Admin&a=show_student&id=<?php echo $stu['id'] ?>" class="btn">查看</a>
				<a href="?c=Admin&a=change_student&id=<?php echo $stu['id'] ?>" class="btn">修改</a>
				<a href="?c=Admin&a=del_student&id=<?php echo $stu['id'] ?>" class="btn">删除</a>
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
                <a href="#" onclick="operation_batch('del_student_batch')" class="btn">删除</a>
                <a href="?c=Admin&a=list_student" class="btn">刷新</a>

                <!--分页-->
                <div class="page">
                	<a href="?c=Admin&a=list_student&p=<?php echo $item[page]<3?1:$item[page]-1; ?>" class="prev">
						<img src=<?php echo APP_IMAGE_PATH."icon7.png"; ?> alt=""/>
					</a>
<?php
	$total_page = floor(($item['stu_num']-1) / 10 + 1);
	for($p = 1; $p <= $total_page; $p++){
		$class_name = ($p == $item['page']?'now':'');
		echo "<a href='?c=Admin&a=list_student&p=$p' class='$class_name'>$p</a>";
	}
 ?>
                    <a href="?c=Admin&a=list_student&p=<?php echo $item[page]<$total_page?$item[page]+1:$total_page; ?>" class="next">
						<img src=<?php echo APP_IMAGE_PATH."icon8.png"; ?> alt=""/>
					</a>
                </div>
                <!--分页-->
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
