/**
 * Created by zhibo on 15-6-16.
 */
$(function(){
    function change_code(){
        var time = new Date().getTime();
        $(".login-code").attr("src",ThinkPHP['Code']+'&'+Math.random());
        return false;
    }
    //刷新验证码
    $('.login-code').click(function(){
        change_code();
    });
    // validate插件护展验证规则字符验证，只能包含英文、数字、下划线等字符。
    jQuery.validator.addMethod("stringCheck", function(value, element) {
        return this.optional(element) || /^[a-zA-Z0-9\-_]+$/.test(value);
    }, "用户名不能有特殊字符");
    //验证规则

    $('form[name=login]').validate({
        errorElement:'span',   //错语标签
        errorClass:'error',    //错误css
        success:function(span){
            span.removeClass('error');
            span.addClass('success');
        },    //验证成功后移除error,添加success样式
        rules:{
            username:{required:true,rangelength:[5,20],stringCheck:true},
            password:{required:true,rangelength:[5,20]},
            code:{required:true,rangelength:[4,4],
                remote:{
                    url:ThinkPHP['checkCode'],
                    type:'post',
                    dataType:'json',
                    data:{ username:function(){return $('.logincode').val();}},
                    complete:function(data){
                        if(data.responseText=='false'){
                            change_code();
                        }
                    }
                }
            }
        },
        messages:{
            username:{required:'用户名不能为空',rangelength:'用户名长度5-20位'},
            password:{ required:'密码不能为空', rangelength:'用户名长度5-20位'},
            code:{required:'验证码不能为空',rangelength:'验证码长度为4位',remote:'验证码错误'}
        }
    });

})