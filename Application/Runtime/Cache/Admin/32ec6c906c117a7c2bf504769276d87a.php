<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>三五青年管理系统</title>
    <link href="/./Application/Admin/View/static/css/login.css" rel="stylesheet" type="text/css" />
    <script language="JavaScript" src="/./Application/Admin/View/static/js/jquery.js"></script>
    <script language="JavaScript" src="/./Application/Admin/View/static/js/jquery-validate.js"></script>
    <script src="/./Application/Admin/View/static/js/cloud.js" type="text/javascript"></script>
    <script src="/./Application/Admin/View/static/js/login.js" type="text/javascript"></script>

    <script language="javascript">
        var ThinkPHP = {
            'Code' : '<?php echo U("Login/code/","","");?>',
            'checkCode' : '<?php echo U("Login/checkCode/","","");?>'
        }
        $(function(){
            $('.loginbox').css({'position':'absolute','left':($(window).width()-692)/2});
            $(window).resize(function(){
                $('.loginbox').css({'position':'absolute','left':($(window).width()-692)/2});
            })
        });
    </script>
</head>
<body style="background-color:#1c77ac; background-image:url(/./Application/Admin/View/static/images/light.png); background-repeat:no-repeat; background-position:center top; overflow:hidden;">

<div id="mainBody">
    <div id="cloud1" class="cloud"></div>
    <div id="cloud2" class="cloud"></div>
</div>

<div class="logintop">
    <span>内容管理系统</span>
    <ul>
        <li><a href="javascript:void(0)">回首页</a></li>
        <li><a href="javascript:void(0)">帮助</a></li>
        <li><a href="javascript:void(0)">关于</a></li>
    </ul>
</div>
<div class="loginbody">
    <span class="systemlogo"></span>

    <div class="loginbox">
        <form name="login" method="post" action="<?php echo U('Login/checkLogin');?>">
            <ul>
                <li><input name="username" type="text" class="loginuser" placeholder="用户名"></li>
                <li><input name="password" type="password" class="loginpwd"  placeholder="密码" /></li>
                <li class="code_span"><input name="code" type="text" class="logincode"  placeholder="验证码"/>
                    <img src="<?php echo U('Login/code','','');?>" alt="" class="login-code">
                </li>
                <li><input type="submit" class="loginbtn" value="登录"/></li>

            </ul>
        </form>
    </div>
</div>

<div class="loginbm">版权所有  2015  <a href="http://www.ki35.com">www.ki35.com</a>  仅供学习交流，勿用于任何商业用途</div>
</body>

</html>