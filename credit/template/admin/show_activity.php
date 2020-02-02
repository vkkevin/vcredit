<?php
    if(!isset($item) || !is_array($item)){
        exit();
    }
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>活动详细信息</title>
    <link rel="stylesheet" type="text/css" href=<?php echo APP_CSS_PATH."reset.css"; ?> />
    <link rel="stylesheet" type="text/css" href=<?php echo APP_CSS_PATH."common.css"; ?> />
    <link rel="stylesheet" type="text/css" href=<?php echo APP_CSS_PATH."thems.css"; ?> >
    <script type="text/javascript" src=<?php echo APP_JS_PATH."jquery-1.8.3.min.js"; ?> ></script>
<script type="text/javascript">
$(function(){
	//自适应屏幕宽度
	window.onresize=function(){ location = location };
	
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

function check_all(){
    var checkall = document.getElementById('checkall');
    var check_data = document.getElementsByName('check_data[]');
    for(var i = 0; i < check_data.length; i++){
        if(check_data[i].type === 'checkbox'){
            check_data[i].checked = checkall.checked;
        }
    }
}
</script>
<style>
    .list-title {
        text-align: left;
        color: black;
        font-size: 20px;
        padding-top: 30px;
        padding-left: 20px;
    }

    .list-participator {
        margin-bottom: 100px;
    }
</style>
<!--框架高度设置-->
</head>

<body onLoad="Resize();">
<div id="right_ctn">
	<div class="right_m">
		<!--详细信息-->
        <div class="hy_list">
        	<div class="box_t">
            	<span class="name">详细信息</span>
                <!--当前位置-->
                <div class="position">
                    <a href="?c=Admin&a=content"><img src=<?php echo APP_IMAGE_PATH."icon5.png"; ?> alt=""/></a>
                    <a href="?c=Admin&a=content">首页</a>
                    <span><img src=<?php echo APP_IMAGE_PATH."icon3.png"; ?> alt=""/></span>
                    <a href="?c=Admin&a=list_activity">活动管理</a>
                    <span><img src=<?php echo APP_IMAGE_PATH."icon3.png"; ?> alt=""/></span>
                    <a href="?c=Admin&a=show_activity&id=<?php echo $item['activity']['id']; ?>" >详细信息</a>
                </div>
                <!--当前位置-->
            </div>

            <!--活动信息列表-->
                <table width="762" cellpadding="0" cellspacing="0" class="list_hy">
                    <tr>
                        <th width="59" class="xz">活动号</th>
                        <td width="86"><?php echo $item['activity']['id']; ?></td>
                        <th width="59" class="xz">活动名称</th>
                        <td width="86"><?php echo $item['activity']['name']; ?></td>
                        <th width="74" class="zt">简介</th>
                        <td width="174"><?php echo $item['activity']['introduction']; ?></td>
                        <th width="56">活动类型</th>
                        <td width="130"><?php echo $item['activity']['type']; ?></td>
                        <th width="47">标准学分</th>
                        <td width="134"><?php echo $item['activity']['stdcredit']; ?></td>
                    </tr>
                    <tr>
                        <th>日期</th>
                        <td><?php echo $item['activity']['date']; ?></td>
                        <th>地点</th>
                        <td><?php echo $item['activity']['locale']; ?></td>
                        <th>标准人数</th>
                        <td><?php echo $item['activity']['people_number']; ?></td>
                        <th>实际人数</th>
                        <td><?php echo $item['activity']['actual_people_number']; ?></td>
                        <th>备注</th>
                        <td><?php echo $item['activity']['remark']; ?></td>
                    </tr>
                </table>
            <!--活动信息列表-->

            <!--活动学分信息列表-->
                <div class="list-title">
                    <span><img src=<?php echo APP_IMAGE_PATH."icon3.png"; ?> alt=""/></span>
                    <span>活动学分信息</span>
                </div>
<!--                <form action="" method="post" id="op_batch_form">-->
<!--                    <input name="activity_id" type="hidden" value=--><?php //echo $item['activity']['id'];?><!-- />-->
                    <table width="762" cellpadding="0" cellspacing="0" class="list_hy">
                        <tr>
<!--                            <th>选择</th>-->
                            <th>学号</th>
                            <th>姓名</th>
                            <th>认定学分</th>
                            <th>认定原因</th>
                            <th>提交时间</th>
                            <th>提交者</th>
                            <th>认定时间</th>
                            <th>认定者</th>
                            <th>备注</th>
                        </tr>
<?php
    foreach($item['credits']['adopt'] as $c){
?>
                        <tr>
<!--                            <td class="xz">-->
<!--                                <input name="check_data[]" type="checkbox" value=--><?php //echo $c['id'];?><!-- />-->
<!--                            </td>-->
                            <td><?php echo $c['student_id']; ?></td>
                            <td><?php echo $c['student_name']; ?></td>
                            <td><?php echo $c['cogizance_credit']; ?></td>
                            <td><?php echo $c['cogizance_cause']; ?></td>
                            <td><?php echo $c['submit_time']; ?></td>
                            <td><?php echo $c['submit_id']; ?></td>
                            <td><?php echo $c['cogizance_time']; ?></td>
                            <td><?php echo $c['cogizant_id']; ?></td>
                            <td><?php echo $c['remark']; ?></td>
                        </tr>
<?php
    }
?>
                    </table>
<!--                </form>-->
            <!--活动学分信息列表-->

            <!--未认定活动学分信息列表-->
            <div class="list-title">
                <span><img src=<?php echo APP_IMAGE_PATH."icon3.png"; ?> alt=""/></span>
                <span>未认定学分信息</span>
            </div>
            <form action="" method="post" id="op_batch_form">
                <input name="activity_id" type="hidden" value=<?php echo $item['activity']['id'];?> />
                <table width="762" cellpadding="0" cellspacing="0" class="list_hy">
                    <tr>
                        <th>选择</th>
                        <th>学号</th>
                        <th>姓名</th>
                        <th>认定学分</th>
                        <th>认定原因</th>
                        <th>提交时间</th>
                        <th>提交者</th>
                        <th>备注</th>
                    </tr>
<?php
    foreach($item['credits']['need'] as $c){
?>
                        <tr>
                            <td class="xz">
                                <input name="check_data[]" type="checkbox" value=<?php echo $c['id'];?> />
                            </td>
                            <td><?php echo $c['student_id']; ?></td>
                            <td><?php echo $c['student_name']; ?></td>
                            <td><?php echo $c['cogizance_credit']; ?></td>
                            <td><?php echo $c['cogizance_cause']; ?></td>
                            <td><?php echo $c['submit_time']; ?></td>
                            <td><?php echo $c['submit_id']; ?></td>
                            <td><?php echo $c['remark']; ?></td>
                        </tr>
<?php
    }
?>
                </table>
            </form>
            <!--未认定活动学分信息列表-->

            <!--参与活动学生信息列表-->
            <div class="list-title">
                <span><img src=<?php echo APP_IMAGE_PATH."icon3.png"; ?> alt=""/></span>
                <span>参与活动学生</span>
            </div>
            <table class="list-participator list_hy" width="762" cellpadding="0" cellspacing="0">
                <tr>
                    <th>学号</th>
                    <th>姓名</th>
                    <th>系部</th>
                    <th>专业</th>
                    <th>班级</th>
                    <th>辅导员</th>
                </tr>
<?php
    foreach($item['students'] as $s){
?>
        <tr>
                        <td><?php echo $s['id']; ?></td>
                        <td><?php echo $s['name']; ?></td>
                        <td><?php echo $s['department']; ?></td>
                        <td><?php echo $s['specialty']; ?></td>
                        <td><?php echo $s['class']; ?></td>
                        <td><?php echo $s['instructor']; ?></td>
                    </tr>
<?php
    }
?>
            </table>
            <!--参与活动学生信息列表-->

            <!--右边底部-->
            <div class="r_foot">
            	<div class="r_foot_m">
                    <span>
                        <input id="checkall" onclick="check_all()" type="checkbox" value="" />
                        <em>全部选中</em>
                    </span>
                    <a href="" class="btn">刷新</a>
                    <a href="#" onclick="operation_batch('change_add_credits_batch')" class="btn">修改学分</a>

                    <span>活动管理 <img src=<?php echo APP_IMAGE_PATH."icon3.png"; ?> alt=""/> </span>
                    <a href="?c=Admin&a=change_activity&id=<?php echo $item['activity']['id'];?>" class="btn">修改</a>
                    <a href="?c=Admin&a=del_activity&id=<?php echo $item['activity']['id'];?>" class="btn">删除</a>
                </div>
            </div>
            <!--右边底部-->
        </div>
        <!--详细信息-->
    </div>
</div>
</body>
</html>
