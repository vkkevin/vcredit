<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>学分认定详细信息</title>
    <link rel="stylesheet" type="text/css" href=<?php echo APP_CSS_PATH."reset.css"; ?> />
    <link rel="stylesheet" type="text/css" href=<?php echo APP_CSS_PATH."common.css"; ?> />
    <link rel="stylesheet" type="text/css" href=<?php echo APP_CSS_PATH."thems.css"; ?> >
    <script type="text/javascript" src=<?php echo APP_JS_PATH."jquery-1.8.3.min.js"; ?> ></script>
<script type="text/javascript">
$(function(){
	//自适应屏幕宽度
	window.onresize=function(){ location = location };
	
	var main_h = $(window).height();
	$('.hy_list').css('height',main_h+'px');
	
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
                    <a href="?c=Admin&a=list_credit_need">学分认证管理</a>
                    <span><img src=<?php echo APP_IMAGE_PATH."icon3.png"; ?> alt=""/></span>
                    <a href="?c=Admin&a=show_credit&id=<?php echo $item['credit']['id']; ?>" >详细信息</a>
                </div>
                <!--当前位置-->
            </div>

            <!--学生信息-->
                <div class="list-title">
                    <span><img src=<?php echo APP_IMAGE_PATH."icon3.png"; ?> alt=""/></span>
                    <span>学生信息</span>
                </div>
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
                        <td colspan="5"><?php echo $item['student']['remark']; ?></td>
                    </tr>
                </table>
            <!--学生信息-->

            <!--活动信息-->
            <div class="list-title">
                <span><img src=<?php echo APP_IMAGE_PATH."icon3.png"; ?> alt=""/></span>
                <span>活动信息</span>
            </div>
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
                    <th>备注</th>
                    <td><?php echo $item['activity']['remark']; ?></td>
                </tr>
            </table>
            <!--活动信息-->

            <!--学分认定信息-->
                <div class="list-title">
                    <span><img src=<?php echo APP_IMAGE_PATH."icon3.png"; ?> alt=""/></span>
                    <span>学分认定信息</span>
                </div>
                <table width="762" cellpadding="0" cellspacing="0" class="list_hy">
                    <tr>
                        <th>认定学分</th>
                        <th>认定原因</th>
                        <th>提交时间</th>
                        <th>提交者</th>
                        <th>认定时间</th>
                        <th>认定者</th>
                        <th>备注</th>
                    </tr>
                    <tr>
                        <td><?php echo $item['credit']['cogizance_credit']; ?></td>
                        <td><?php echo $item['credit']['cogizance_cause']; ?></td>
                        <td><?php echo $item['credit']['submit_time']; ?></td>
                        <td><?php echo $item['credit']['submit_id']; ?></td>
                        <td><?php echo $item['credit']['cogizance_time']; ?></td>
                        <td><?php echo $item['credit']['cogizant_id']; ?></td>
                        <td><?php echo $item['credit']['remark']; ?></td>
                    </tr>
                </table>
            <!--学生学分信息-->

            <!--右边底部-->
            <div class="r_foot">
            	<div class="r_foot_m">
                    <a href="" class="btn">刷新</a>
<?php
    switch($item['credit']['cogizance_state']){
        case '-1':
?>
                    <span>学分认证管理 <img src=<?php echo APP_IMAGE_PATH."icon3.png"; ?> alt=""/> </span>
                    <a href="?c=Admin&a=del_credit&id=<?php echo $item['credit']['id'];?>" class="btn">删除</a>
<?php
            break;
        case '0':
        case '1':
?>
                    <span>学分认证管理 <img src=<?php echo APP_IMAGE_PATH."icon3.png"; ?> alt=""/> </span>
                    <a href="?c=Admin&a=affirm_credit&id=<?php echo $item['credit']['id'];?>" class="btn">认证</a>
                    <a href="?c=Admin&a=veto_credit&id=<?php echo $item['credit']['id'];?>" class="btn">否决</a>
<?php
            break;
        case '2':
        default:break;
    }
?>
                </div>
            </div>
            <!--右边底部-->
        </div>
        <!--详细信息-->
    </div>
</div>
</body>
</html>
