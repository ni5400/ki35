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
//基类
class CommonController extends Controller {

    public  function _initialize(){

        if(!isset(session('admin_auth')['user_id'])){
            redirect(U('Login/index'));
        }

        //帐号status==0则停用
        $map['id']=session('admin_auth')['user_id'];
        $status=M('User')->where($map)->field('status')->find();
        if($status['status']==0){
            session('admin_auth',null);
            $this->success('您的帐号已停用',U('Login/index'));
        }


    }

}