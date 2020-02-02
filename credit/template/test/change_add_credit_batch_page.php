<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" />
        <title>批量修改学分</title>
    </head>
    <body>
        <form action="?c=Admin&a=change_add_credits_batch_exec" method="post">
            <input name="cogizance_credit" type="text" value=""/>
            <input name="activity_id" type="hidden" value=<?php echo $item['activity_id'];?> />
<?php
    foreach($item['credits'] as $cdtInfo) {
?>
            <input name="cdtIds[]" type="hidden" value=<?php echo $cdtInfo['id'];?> />
<?php
    }
?>
            <input name="submit" type="submit" value="提交"/>
        </form>
    </body>
</html>