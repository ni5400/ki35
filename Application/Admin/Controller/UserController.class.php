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

class UserController extends CommonController {

    public function index(){
        $this->display();
    }
    //ajax检测用户是否存在
    public function checkUser(){
        if(!IS_AJAX) $this->error('非法操作');
        if(D('User')->checkUsername(I('post.username'))){
            echo 'false';
        }else{
            echo 'true';
        };
    }
    //添加管理员处理
    public function manager_addHandel(){
        $data=array(
            'username'=>$username=I('post.username'),
            'byname'=>$byname=I('post.byname'),
            'password'=>$password=I('post.password'),
            'group'=>$group=I('post.group')
        );
        //写入model
        $User=D('User');
        $addResult=$User->register($username,$byname,$password);
        if($msg=$User->getError()){
            $this->error($msg);  //自动验证未通过抛出错误
        }
        //写入user表后执行写入AuthGroupAccess
        if($addResult){
            $groupData=array(
                'uid'=>$addResult,
                'group_id'=>$group
            );
            //角色id插入表AuthGroupAccess
            if($AuthGroupAccess=M('AuthGroupAccess')->add($groupData)){
                $this->success('添加成功',U('Setting/manager'));
            }else{
                $this->error('写入AuthGroupAccess表失败');
            }
        }else{
            $this->error('写入User表失败');
        }

    }

    /**
     * 添加管理员处理表单
     * 由于用户对应多角色存在bug暂时弃用
     */
    public function manager_addHandel2(){
        //先判断是否选择分组（分组是数组集）若分组未选择抛出错误提示
        $groupPost=$_POST['group'];
        foreach($groupPost as $key=>$value ){
            if($value=='')  $this->error('角色未选择');
        }
        $data=array(
            'username'=>$username=I('post.username'),
            'byname'=>$byname=I('post.byname'),
            'password'=>$password=I('post.password'),
        );
        //写入model
        $User=D('User');
        $addResult=$User->register($username,$byname,$password);
        //自动验证未通过抛出错误
        if($msg=$User->getError()){
            $this->error($msg);
        }
        //写入user表后执行写入AuthGroupAccess
        if($addResult){
            $groupPost=array_unique($groupPost);
            $group=array();
            foreach($groupPost as $key=>$value ){
                $group[$key]['uid']=$addResult;
                $group[$key]['group_id']=$value;
            }
            //角色id插入表AuthGroupAccess
            if($AuthGroupAccess=M('AuthGroupAccess')->addAll($group)){
               $this->success('添加成功',U('Setting/role'));
            }else{
                $this->error('写入AuthGroupAccess表失败');
            }
        }else{
            $this->error('写入User表失败');
        }

    }


}