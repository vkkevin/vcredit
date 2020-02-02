<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>学生详细信息</title>
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
</script>
<style>
    .list-title {
        text-align: left;
        color: black;
        font-size: 20px;
        padding-top: 30px;
        padding-left: 20px;
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
                    <a href="?c=Admin&a=list_student">学生管理</a>
                    <span><img src=<?php echo APP_IMAGE_PATH."icon3.png"; ?> alt=""/></span>
                    <a href="?c=Admin&a=show_student&id=<?php echo $item['student']['id']; ?>" >详细信息</a>
                </div>
                <!--当前位置-->
            </div>

            <!--学生信息列表-->
                <table width="762" cellpadding="0" cellspacing="0" class="list_hy">
                    <tr>
                        <th width="59" class="xz">姓名</th>
                        <td width="86"><?php echo $item['student']['name']; ?></td>
                        <th width="74" class="zt">系部专业</th>
                        <td width="174"><?php echo $item['student']['department']." ".$item['student']['specialty']; ?></td>
                        <th width="56">班级</th>
                        <td width="130"><?php echo $item['student']['class']; ?></td>
                        <th width="47">学号</th>
                        <td width="134"><?php echo $item['student']['id']; ?></td>
                    </tr>
                    <tr>
                        <th class="xz">辅导员</th>
                        <td><?php echo $item['student']['instructor']; ?></td>
                        <th>备注</th>
                        <td colspan="3"><?php echo $item['student']['remark']; ?></td>
                        <th>已得学分</th>
                        <td><?php echo $item['student']['total_credit']; ?></td>
                    </tr>
                </table>
            <!--学生信息列表-->

            <!--学生学分信息列表-->
                <div class="list-title">
                    <span><img src=<?php echo APP_IMAGE_PATH."icon3.png"; ?> alt=""/></span>
                    <span>学生学分信息</span>
                </div>
                <table width="762" cellpadding="0" cellspacing="0" class="list_hy">
                    <tr>
                        <th>活动号</th>
                        <th>活动名称</th>
                        <th>活动类型</th>
                        <th>认定学分</th>
                        <th>认定原因</th>
                        <th>提交时间</th>
                        <th>提交者</th>
                        <th>认定时间</th>
                        <th>认定者</th>
                        <th>备注</th>
                    </tr>
<?php
    foreach($item['credits'] as $c){
?>
                    <tr>
                        <td><?php echo $c['activity_id']; ?></td>
                        <td><?php echo $c['activity_name']; ?></td>
                        <td><?php echo $c['activity_type']; ?></td>
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
            <!--学生学分信息列表-->

            <!--右边底部-->
            <div class="r_foot">
            	<div class="r_foot_m">
                    <a href="" class="btn">刷新</a>
                    <span>学生管理 <img src=<?php echo APP_IMAGE_PATH."icon3.png"; ?> alt=""/> </span>
                    <a href="?c=Admin&a=change_student&id=<?php echo $item['student']['id'];?>" class="btn">修改</a>
                    <a href="?c=Admin&a=del_student&id=<?php echo $item['student']['id'];?>" class="btn">删除</a>
                </div>
            </div>
            <!--右边底部-->
        </div>
        <!--详细信息-->
    </div>
</div>
</body>
</html>
