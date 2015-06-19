<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>三五青年</title>
    <link href="/./Application/Admin/View/static/css/index.css" rel="stylesheet" type="text/css" />
    <script language="JavaScript" src="/./Application/Admin/View/static/js/jquery.js"></script>
    <block name="head"></block>
</head>
<body>
<!--top-->

<div id="frame-top">
    <div class="topleft">
        <a href="main.html" target="_parent"><img src="/./Application/Admin/View/static/images/logo2.png" title="系统首页" /></a>
    </div>

    <ul class="nav">
        <li>
            <a href="default.html" target="rightFrame" class="selected">
                <img src="/./Application/Admin/View/static/images/icon01.png" title="工作台" />
                <h2>工作台</h2>
            </a>
        </li>
        <li>
            <a href="imgtable.html" target="rightFrame"><img src="/./Application/Admin/View/static/images/icon02.png" title="模型管理" /><h2>模型管理</h2></a>
        </li>
        <li>
            <a href="imglist.html"  target="rightFrame"><img src="/./Application/Admin/View/static/images/icon03.png" title="模块设计" /><h2>模块设计</h2></a>
        </li>
        <li>
            <a href="tools.html"  target="rightFrame"><img src="/./Application/Admin/View/static/images/icon04.png" title="常用工具" /><h2>常用工具</h2></a>
        </li>
        <li>
            <a href="computer.html" target="rightFrame"><img src="/./Application/Admin/View/static/images/icon05.png" title="文件管理" /><h2>文件管理</h2></a>
        </li>
        <li>
            <a href="tab.html"  target="rightFrame"><img src="/./Application/Admin/View/static/images/icon06.png" title="系统设置" /><h2>系统设置</h2></a>
        </li>
    </ul>

    <div class="topright">
        <ul>
            <li><span><img src="/./Application/Admin/View/static/images/help.png" title="帮助"  class="helpimg"/></span><a href="#">帮助</a></li>
            <li><a href="#">关于</a></li>
            <li><a href="<?php echo U('Login/login_out');?>" target="_parent">退出</a></li>
        </ul>

        <div class="user">
            <span><?php echo ($_SESSION['admin_auth']['user_byname']); ?></span>
            <i>消息</i>
            <b>5</b>
        </div>

    </div>
</div>


<!--top.end-->
<!--main.start-->
<div id="frame-main">
    <!--main.left.start-->
    <div id="frame-left">
        
<div class="lefttop"><span></span>工作台</div>
    <dl class="leftmenu">
        <dd>
            <div class="title">
                <span><img src="/./Application/Admin/View/static/images/leftico01.png" /></span>个人信息
            </div>
            <ul class="menuson">
                <li><cite></cite><a href="index.html" target="rightFrame">修改个信息</a><i></i></li>
                <li class="active"><cite></cite><a href="right.html" target="rightFrame">登陆日志</a><i></i></li>
                <li><cite></cite><a href="imgtable.html" target="rightFrame">操作日志</a><i></i></li>
                <li><cite></cite><a href="form.html" target="rightFrame">修改密码</a><i></i></li>
            </ul>
        </dd>
        <dd>
            <div class="title">
                <span><img src="/./Application/Admin/View/static/images/leftico02.png" /></span>快捷菜单
            </div>
            <ul class="menuson">
                <li><cite></cite><a href="#">编辑内容</a><i></i></li>
                <li><cite></cite><a href="#">发布信息</a><i></i></li>
                <li><cite></cite><a href="#">档案列表显示</a><i></i></li>
            </ul>
        </dd>
        <dd><div class="title"><span><img src="/./Application/Admin/View/static/images/leftico03.png" /></span>编辑器</div>
            <ul class="menuson">
                <li><cite></cite><a href="#">自定义</a><i></i></li>
                <li><cite></cite><a href="#">常用资料</a><i></i></li>
                <li><cite></cite><a href="#">信息列表</a><i></i></li>
                <li><cite></cite><a href="#">其他</a><i></i></li>
            </ul>
        </dd>
        <dd><div class="title"><span><img src="/./Application/Admin/View/static/images/leftico04.png" /></span>日期管理</div>
            <ul class="menuson">
                <li><cite></cite><a href="#">自定义</a><i></i></li>
                <li><cite></cite><a href="#">常用资料</a><i></i></li>
                <li><cite></cite><a href="#">信息列表</a><i></i></li>
                <li><cite></cite><a href="#">其他</a><i></i></li>
            </ul>
        </dd>
    </dl>

</div>
    <!--main.left.edn-->
    <!--main.right.begin-->
    <div id="frame-right">
    
    <div class="place">
        <span>位置：</span>
        <ul class="placeul">
            <li><a href="#">首页<?php echo ACTION_NAME;?></a></li>
        </ul>
    </div>
    <div class="mainindex">

        <div class="welinfo">
            <span><img src="/./Application/Admin/View/static/images/sun.png" alt="天气" /></span>
            <b>Admin早上好，欢迎使用信息管理系统</b>(admin@uimaker.com)
            <a href="#">帐号设置</a>
        </div>

        <div class="welinfo">
            <span><img src="/./Application/Admin/View/static/images/time.png" alt="时间" /></span>
            <i>您上次登录的时间：2013-10-09 15:22</i> （不是您登录的？<a href="#">请点这里</a>）
        </div>

        <div class="xline"></div>

        <ul class="iconlist">

            <li><img src="/./Application/Admin/View/static/images/ico01.png" /><p><a href="#">管理设置</a></p></li>
            <li><img src="/./Application/Admin/View/static/images/ico02.png" /><p><a href="#">发布文章</a></p></li>
            <li><img src="/./Application/Admin/View/static/images/ico03.png" /><p><a href="#">数据统计</a></p></li>
            <li><img src="/./Application/Admin/View/static/images/ico04.png" /><p><a href="#">文件上传</a></p></li>
            <li><img src="/./Application/Admin/View/static/images/ico05.png" /><p><a href="#">目录管理</a></p></li>
            <li><img src="/./Application/Admin/View/static/images/ico06.png" /><p><a href="#">查询</a></p></li>

        </ul>

        <div class="ibox"><a class="ibtn"><img src="/./Application/Admin/View/static/images/iadd.png" />添加新的快捷功能</a></div>

        <div class="xline"></div>
        <div class="box"></div>

        <div class="welinfo">
            <span><img src="/./Application/Admin/View/static/images/dp.png" alt="提醒" /></span>
            <b>Uimaker信息管理系统使用指南</b>
        </div>

        <ul class="infolist">
            <li><span>您可以快速进行文章发布管理操作</span><a class="ibtn">发布或管理文章</a></li>
            <li><span>您可以快速发布产品</span><a class="ibtn">发布或管理产品</a></li>
            <li><span>您可以进行密码修改、账户设置等操作</span><a class="ibtn">账户管理</a></li>
        </ul>

        <div class="xline"></div>

        <div class="uimakerinfo"><b>查看Uimaker网站使用指南，您可以了解到多种风格的B/S后台管理界面,软件界面设计，图标设计，手机界面等相关信息</b>(<a href="http://www.uimaker.com" target="_blank">www.uimaker.com</a>)</div>

        <ul class="umlist">
            <li><a href="#">如何发布文章</a></li>
            <li><a href="#">如何访问网站</a></li>
            <li><a href="#">如何管理广告</a></li>
            <li><a href="#">后台用户设置(权限)</a></li>
            <li><a href="#">系统设置</a></li>
        </ul>
    </div>

</div>

    <!--main.right.end-->
</div>
<!--main.end-->
<script type="text/javascript">
    $(function(){
        //导航切换
        $(".menuson li").click(function(){
            $(".menuson li.active").removeClass("active")
            $(this).addClass("active");
        });

        $('.title').click(function(){
            var $ul = $(this).next('ul');
            $('dd').find('ul').slideUp();
            if($ul.is(':visible')){
                $(this).next('ul').slideUp();
            }else{
                $(this).next('ul').slideDown();
            }
        });
    })
</script>
</body>
</html>