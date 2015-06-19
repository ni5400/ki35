<?php
/**
 * Created by PhpStorm.
 * User: zhibo
 * 15-6-15 下午9:02
 * Mail:ni5400@163.com
 * Web:http://www.ki35.com
 */

namespace Admin\Controller;
use Think\Controller;
use MyLibrary\Image;

//登陆页面操作
class LoginController extends Controller {

    /**
     * 登陆页面显示
     */
    public function index(){
        if(isset(session('admin_auth')['user_id'])){
            $this->error('帐户已登陆，请注销后再尝试');
        }
        $this->display();
    }

    //显示验证码
    public function code(){
        ob_clean();
        $Code=new Image();
        $Code::code();
    }

    //校验验证码
    public function checkCode(){
        if(!IS_AJAX) $this->error('非法操作');
        $code=I('post.code','','trim,htmlspecialchars,strtolower,md5');
        echo  $code == session('code') ? 'true' : 'false';
    }

    //验证登陆
    public function checkLogin(){
        if(!IS_POST) $this->error('非法操作');
        //较验验证码
        $Code=I('post.code','','trim,htmlspecialchars,strtolower,md5');
        if($Code != session('code')) $this->error('验证码错误');
        $data=array(
            'user_name'=>$username=I('post.username'),
            'password'=>$password=I('post.password'),
            'code'=>$code=I('post.code','','trim')
        );
        //连续登陆失败五次，限制一小时内不能在登陆
        if(session('login_error')['error_count']>5 && (time()-session('login_error')['last_login_time'])<3600){
           $this->error('密码错误次数过多,请一小时后再进行尝试');
        }
        //检验登陆
        $User=D('User');
        $authInfo=$User->checkLogin($username,$password,$code);
        //登陆信息写入userlogin表里
        $Error_login=D('UserLogin');
        if($msg = $User->getError()) {
            $Error_login->addLogin($username,$msg);
            $this->error($msg); //抛出错误信息
        }
        if(!$authInfo) $this->error('用户不存在或已停用');
        if($authInfo['password'] !=sha1($password)){
            //密码校验失败
            $error_count=session('login_error')['error_count'];
            $error_login=array(
                'error_count'=>$error_count+1,
                $username=>$username,
                'last_login_time'=>time(),
            );
            session('login_error',$error_login);
            $Error_login->addLogin($username,'密码错误');
            $this->error('密码错误');
        }else{
            //密码较验后，更新登陆信息如果成功----
            if($User->update($authInfo['id'],$authInfo['login_count'])){
                $session_auth=array(
                    'user_id'=>$authInfo['id'],
                    'user_name'=>$authInfo['user_name'],
                    'user_byname'=>$authInfo['user_byname']
                );
                session('admin_auth',$session_auth);
                session('login_error',null); //清空登陆失败的session
                $Error_login->addLogin($username,'登陆成功');
                $this->success('登陆成功!',U('Index/index'));
            }else{
                $Error_login->addLogin($username,'更新登陆日志未成功造成登陆失败');
                $this->error('更新登陆日志未成功造成登陆失败');
            }


        }
    }

    public function login_out(){
        //v退出登陆的信息写到用户日志里
        D('UserLogin')->addLogin(session('admin_auth')['user_name'],'用户注销');
        session('admin_auth',null);
        $this->success('注销成功',U('Login/index'));
    }

}