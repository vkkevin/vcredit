<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 18-3-15
 * Time: 下午5:58
 */
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>js on</title>
        <script type="text/javascript">
            function onoff(id){
                var flag = 0;
                var onMenu = document.getElementById(id);
                if(onMenu.style.display === 'block'){
                    flag = 1;
                }

                var menu = document.getElementsByClassName('menu');
                for(var i = 0; i < menu.length; i++) {
                    menu[i].style.display = 'none';
                }

                var menu2 = document.getElementsByClassName('menu2');
                for(var i = 0; i < menu2.length; i++) {
                    menu2[i].style.display = 'none';
                }

                if(flag === 0) {
                    onMenu.style.display = 'block';
                }
            }

            function onoff2(id){
                var flag = 0;
                var onMenu = document.getElementById(id);
                if(onMenu.style.display === 'block'){
                    flag = 1;
                }

                var menu = document.getElementsByClassName('menu2');
                for(var i = 0; i < menu.length; i++) {
                    menu[i].style.display = 'none';
                }

                if(flag === 0) {
                    onMenu.style.display = 'block';
                }
            }
        </script>
        <style>
            a{
                width: 100%;
                float: left;
            }
            .menu {
                display: none;
            }
            .menu2 {
                display: none;
            }
        </style>
    </head>
    <body>
        <a href="#" onclick="onoff(1)">test1</a>
        <div id="1" class="menu">
            <a href="#" onclick="onoff2('1_1')">test1_1</a>
            <div id="1_1" class="menu2">
                <a>t1</a>
                <a>t1</a>
                <a>t1</a>
            </div>
            <a href="#" onclick="onoff2('1_2')">test1_2</a>
            <div id="1_2" class="menu2">
                <a>t2</a>
                <a>t2</a>
                <a>t2</a>
            </div>
        </div>
        <a href="#" onclick="onoff(2)">test2</a>
        <div id="2" class="menu">
            <a href="#" onclick="onoff2('2_1')">test2_1</a>
            <div id="2_1" class="menu2">
                <a>t3</a>
                <a>t3</a>
                <a>t3</a>
            </div>
            <a href="#" onclick="onoff2('2_2')">test2_2</a>
            <div id="2_2" class="menu2">
                <a>t4</a>
                <a>t4</a>
                <a>t4</a>
            </div>
        </div>
    </body>
</html>
