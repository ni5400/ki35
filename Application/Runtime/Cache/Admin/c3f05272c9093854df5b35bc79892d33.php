<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" conten="width=device-width,initial-scale=1">
    <title>三五青年</title>
    <link href="/./Application/Admin/View/static/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/./Application/Admin/View/static/css/base.css" rel="stylesheet" type="text/css" />
    <script language="JavaScript" src="/./Application/Admin/View/static/js/jquery.min.js"></script>
    <script language="JavaScript" src="/./Application/Admin/View/static/js/bootstrap.min.js"></script>
    <link href="/./Application/Admin/View/static/css/form.css" rel="stylesheet" type="text/css" />
<!-- 日期插件-->
<script src="/Data/My97DatePicker/WdatePicker.js"></script>



</head>
<body>
<!--top-->

<div id="frame-top">
    <div class="topleft">
        <a href="main.html" target="_parent"><img src="/./Application/Admin/View/static/images/logo2.png" title="系统首页" /></a>
    </div>

    <ul class="home-nav">
        <li>
            <a href="<?php echo U('Index/index');?>"  <?php if(CONTROLLER_NAME =='Index'): ?>class="selected"<?php endif; ?>>
                <img src="/./Application/Admin/View/static/images/icon01.png" title="工作台" />
                <h2>工作台</h2>
            </a>
        </li>
        <li>
            <a href="imgtable.html"><img src="/./Application/Admin/View/static/images/icon02.png" title="模型管理" /><h2>模型管理</h2></a>
        </li>
        <li>
            <a href="imglist.html"><img src="/./Application/Admin/View/static/images/icon03.png" title="模块设计" /><h2>模块设计</h2></a>
        </li>
        <li>
            <a href="tools.html" ><img src="/./Application/Admin/View/static/images/icon04.png" title="常用工具" /><h2>常用工具</h2></a>
        </li>
        <li>
            <a href="computer.html"><img src="/./Application/Admin/View/static/images/icon05.png" title="文件管理" /><h2>文件管理</h2></a>
        </li>
        <li>
            <a href="<?php echo U('Setting/index');?>"  <?php if(CONTROLLER_NAME =='Setting'): ?>class="selected"<?php endif; ?> /><img src="/./Application/Admin/View/static/images/icon06.png" title="系统设置" /><h2>系统设置</h2></a>
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
        
    <div class="lefttop"><i class="icon-cogs"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></i>　系统设置</div>
<dl class="leftmenu">
    <dd>
        <div class="dh-title">
            <i class="icon-cogs"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span></i>
            基本设置
        </div>
        <ul class="menuson" style="display: none">
            <li><i class="icon-cogs"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span></i><a href="index.html" >基本设置</a></li>
            <li><i class="icon-cogs"><span class="glyphicon glyphicon-retweet" aria-hidden="true"></span></i><a href="right.html" >SEO优化</a></li>
            <li><i class="icon-cogs"><span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span></i><a href="imgtable.html" >服务器优化</a></li>
            <li><i class="icon-cogs"><span class="glyphicon glyphicon-phone" aria-hidden="true"></span></i><a href="form.html" >安全中心</a></li>
            <li><i class="icon-cogs"><span class="glyphicon glyphicon-tasks" aria-hidden="true"></span></i><a href="form.html" >图片处理</a></li>
            <li><i class="icon-cogs"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></i><a href="form.html" >邮件发送</a></li>
            <li><i class="icon-cogs"><span class="glyphicon glyphicon-comment" aria-hidden="true"></span></i><a href="form.html" >验证码设置</a></li>
            <li><i class="icon-cogs"><span class="glyphicon glyphicon-picture" aria-hidden="true"></span></i><a href="form.html" >水印设置</a></li>
        </ul>
    </dd>
    <dd>
        <div class="dh-title">
            <i class="icon-cogs"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></i>
            管理员设置
        </div>
        <ul class="menuson" style="display: block">
            <li <?php if(ACTION_NAME =='manager'): ?>class="active"<?php endif; ?> >
                <a href="<?php echo U('Setting/manager');?>">
                    <i class="icon-cogs">
                        <span class="glyphicon glyphicon-tasks"></span>
                    </i>管理员列表
                </a>
            </li>
            <li <?php if(ACTION_NAME =='manager_add'): ?>class="active"<?php endif; ?> >
                <a href="<?php echo U('Setting/manager_add');?>">
                    <i class="icon-cogs">
                        <span class="glyphicon glyphicon-plus"></span>
                    </i>新增管理员
                </a>
            </li>
            <li  <?php if(ACTION_NAME =='role'): ?>class="active"<?php endif; ?>  >
                <a href="<?php echo U('Setting/role');?>">
                    <i class="icon-cogs"><span class="glyphicon glyphicon-list"></span></i>
                    角色列表
                </a>
            </li>
            <li <?php if(ACTION_NAME =='role_add'): ?>class="active"<?php endif; ?>>
                <a href="<?php echo U('Setting/role_add');?>">
                    <i class="icon-cogs"><span class="glyphicon glyphicon-edit"></span>
                    </i>新增角色
                </a>
            </li>
            <li <?php if(ACTION_NAME =='node'): ?>class="active"<?php endif; ?>>
            <a href="<?php echo U('Setting/node');?>">
                <i class="icon-cogs"><span class="glyphicon glyphicon-th-list"></span>
                </i>节点管理
            </a>
            </li>
            <li <?php if(ACTION_NAME =='node_add'): ?>class="active"<?php endif; ?>>
            <a href="<?php echo U('Setting/node_add');?>">
                <i class="icon-cogs"><span class="glyphicon glyphicon-plus-sign"></span>
                </i>新增节点
            </a>
            </li>
        </ul>
    </dd>
    <dd>
        <div class="dh-title">
            <i class="icon-cogs"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></i>
            会员管理
        </div>
        <ul class="menuson">
            <li><a href="#"><i class="icon-cogs"><span class="glyphicon glyphicon-align-center"></span></i>管理员列表</a></li>
            <li><a href="#"><i class="icon-cogs"><span class="glyphicon glyphicon-align-right"></span></i>新增管理员</a></li>
            <li><a href="#"><i class="icon-cogs"><span class="glyphicon glyphicon-list"></span></i>角色管理</a></li>
            <li><a href="#"><i class="icon-cogs"><span class="glyphicon glyphicon-edit"></span></i>新增角色</a></li>
        </ul>
    </dd>
    <dd>
        <div class="dh-title">
            <i class="icon-cogs"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span></i>
            其它设置
        </div>
        <ul class="menuson">
            <li><a href="#"><i class="icon-cogs"><span class="glyphicon glyphicon-align-center"></span></i>管理员列表</a></li>
            <li><a href="#"><i class="icon-cogs"><span class="glyphicon glyphicon-align-right"></span></i>新增管理员</a></li>
            <li><a href="#"><i class="icon-cogs"><span class="glyphicon glyphicon-list"></span></i>角色管理</a></li>
            <li><a href="#"><i class="icon-cogs"><span class="glyphicon glyphicon-edit"></span></i>新增角色</a></li>
            <li><a href="#"><i class="icon-cogs"><span class="glyphicon glyphicon-map-marker"></span></i>新增角色</a></li>
        </ul>
    </dd>
</dl>

</div>
    <!--main.left.edn-->
    <!--main.right.begin-->
    <div id="frame-right">

    <div class="place">
        <div class="w-nav"  data-toggle="tooltip" data-placement="top" title="点击隐藏菜单，试试吧"><i class="icon-cogs"><span class="glyphicon glyphicon-th-list"></span></i></div>
        <ul class="placeul" style="color: #CCC;">
            <li><a href="">首页</a> ／ <a href="#">登陆页面</a></li>
        </ul>
    </div>
    <div class="mainindex">
        

    <div class="form_title"><i class="icon-cogs"><span class="glyphicon glyphicon-th-list"></span></i>管理员列表</div>
   <div class="form_con">
        <!--搜索表单-->
        <form class="form-inline" action="<?php echo U('Setting/manager');?>" method="get">
            <div class="form-group  form_layout">
                <label >排序</label>
                <select class="form-control input-sm" name="order">
                    <option value="">---排序---</option>
                    <option value="1">注册时间倒序</option>
                    <option value="2">注册时间正序</option>
                    <option value="3">ID</option>
                    <option value="4">ID倒序</option>
                    <option value="5">登陆时间</option>
                    <option value="6">登陆时间倒序</option>
                </select>
            </div>
            <div class="form-group form_layout">
                <label>ID</label>
                <input type="text" class="form-control input-sm length-50" name="id">
            </div>
            <div class="form-group form_layout">
                <label >用户名</label>
                <input type="text" class="form-control input-sm length-80"  placeholder="用户名" name="username">
            </div>
            <div class="form-group  form_layout">
                <label >姓名</label>
                <input type="text" class="form-control input-sm length-80"  placeholder="姓名" name="byname">
            </div>
            <div class="form-group form_layout">
                <label >登陆时间</label>
                <div class="input-group">
                    <input id="d5221"  name="date_from" class=" form-control input-sm length-100" type="text" onFocus="var d5222=$dp.$('d5222');WdatePicker({skin:'whyGreen',onpicked:function(){d5222.focus();},maxDate:'#F{$dp.$D(\'d5222\')}'})"/>
                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar" ></i></span>
                </div>
                至
                <div class="input-group">
                    <input id="d5222" name="date_to" class=" form-control input-sm length-100" type="text" onFocus="WdatePicker({skin:'whyGreen',minDate:'#F{$dp.$D(\'d5221\')}'})"/>
                    <span class="input-group-addon" ><i class="glyphicon glyphicon-list-alt"></i></span>
                 </div>
            </div>
            <div class="form-group  form_layout">
                <label >状态</label>
                <select class="form-control input-sm" name="status">
                    <option value="">选择</option>
                    <option value="true">正常</option>
                    <option value="false">停用</option>
                </select>
            </div>
            <div class="form-group  form_layout">
                <button type="submit" class="btn btn-sm btn-success">提交</button>
            </div>
        </form>
       <!--搜索表单结束-->
       <legend style="margin-bottom: 10px;"></legend>
       <!--列表开始-->
       <table class="table table-striped table-hover  table-bordered">
           <tr style="background: #efefef;">
               <th><input type="checkbox"  value="option1"></th>
               <th>ID</th>
               <th>用户名</th>
               <th>姓名</th>
               <th>角色</th>
               <th>最后登陆时间</th>
               <th>登陆IP</th>
               <th>注册时间</th>
               <th>登陆次数</th>
               <th>状态</th>
               <th>管理操作</th>
               <th>详细信息</th>
           </tr>
           <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
               <td><input type="checkbox"  value="option1"></td>
               <td><?php echo ($vo["id"]); ?></td>
               <td><?php echo ($vo["user_name"]); ?></td>
               <td><?php echo ($vo["user_byname"]); ?></td>
               <td><?php echo ($vo["role_name"]); ?></td>
               <td><?php echo ($vo["login_time"]); ?></td>
               <td><?php echo ($vo["reg_time"]); ?></td>
               <td><?php echo ($vo["reg_time"]); ?></td>
               <td><?php echo ($vo["login_count"]); ?></td>
               <td class="btn_edit">
                   <?php if($vo['status']==1): ?><i class="glyphicon glyphicon-ok" style="color: #5d9912" data-toggle="tooltip" data-placement="right" title="正常"></i>
                   <?php else: ?>
                   <i class="glyphicon glyphicon-remove" style="color: #a80804"  data-toggle="tooltip" data-placement="right" title="已停用"></i><?php endif; ?>
               </td>
               <td class="btn_edit">
                   <button class="btn btn-sm btn-success "  data-toggle="tooltip" data-placement="left" title="修改"><i class="glyphicon glyphicon-pencil"></i></button>
                   <button class="btn btn-sm btn-danger btn-remove"  data-toggle="tooltip" data-placement="right" title="删除"  <?php if($vo['id']==1): ?>disabled<?php endif; ?> data="<?php echo ($vo["id"]); ?>" ><i class="glyphicon glyphicon-trash"></i></button>
               </td>
               <td>
                   其它信息
               </td>

           </tr><?php endforeach; endif; else: echo "" ;endif; ?>

       </table>
       <!--列表结束-->
       <!--操作-->

       <div class="btn-group" role="group">
           <div class="btn-group dropup">

               <button type="button" class="btn btn-sm btn-primary">操作</button>
               <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                   <span class="caret"></span>
               </button>
               <ul class="dropdown-menu">
                   <li><a href="#">新增</a></li>
                   <li><a href="#">新增</a></li>
               </ul>
           </div>


           <button type="button" class="btn btn-primary btn-sm ">删除</button>
           <button type="button" class="btn btn-primary btn-sm">移动</button>


       </div>
       <!--操作-->
       <!--分页-->
       <?php echo ($page); ?>
       <!--分页-->
   </div>
   <!--dialog-->
<div class="modal fade" id="my-modal" style="top:50%; margin-top:-120px;">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">警告框</h4>
            </div>
            <div class="modal-body">
                <p>确定要进行删除操作吗？删除后不可恢复</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" > 取消</button>
                <button type="button" class="btn btn-primary true-remove">删除</button>
            </div>
        </div>
    </div>
</div>
<!--dialog-->
<!--dialog删除-->
<div class="modal fade bs-example-modal-sm" id="error-dialog" tabindex="-1" style="top:50%; margin-top:-120px;">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" >操作提示</h4>
            </div>
            <div class="modal-body del-result">
                ...
            </div>
        </div>
    </div>
</div>
<!--dialog-->
<script>

    $('.btn-remove').click(function(){
        var thisClick=$(this).parents('tr');
        var getId=$(this).attr('data');
        var Url="<?php echo U('Setting/user_del');?>";
        $('#my-modal').modal('show');
        $('.true-remove').click(function(){
            $.ajax({
                url : Url,
                type : 'POST',
                data : { id:getId },
                beforeSend : function () {
                    $('#my-modal').modal('hide');
                },
                success: function(data, response, status){

                    if(data){
                        $('.del-result').html('删除成功');
                        $('#error-dialog').modal('show');
                        setTimeout(function(){
                            $('.del-result').html('...');
                            $('#error-dialog').modal('hide');
                            thisClick.remove();
                        },2000);
                    }else{
                        alert(data)
                        $('.del-result').html('删除失败,请重试');
                        $('#error-dialog').modal('show');
                        setTimeout(function(){
                            $('.del-result').html('...');
                            $('#error-dialog').modal('hide');
                        },2000);
                    }
                }
            });


        })
    })


</script>

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
        //左侧侧导
        $('.dh-title').click(function(){
            var $ul = $(this).next('ul');
            $('dd').find('ul').slideUp();
            if($ul.is(':visible')){
                $(this).next('ul').slideUp();
            }else{
                $(this).next('ul').slideDown();
            }
        });
        //点击按扭隐藏左侧菜单
        $('.w-nav').click(function(){
           if( $('#frame-left').is(":hidden")){
               $('#frame-left').show();
               $('#frame-right').css('padding-left','187px');
            }else{
                $('#frame-left').hide();
               $('#frame-right').css('padding-left','0');
            }
        });
        $("[data-toggle='tooltip']").tooltip(); //隐藏菜单按扭提示
    })
</script>
</body>
</html>