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
        if(!IS_POST) $this->error('非法操作');
        $data=array(
            'username'=>$username=I('post.username'),
            'byname'=>$byname=I('post.byname'),
            'password'=>$password=I('post.password'),
            'group'=>$group=I('post.group'),
            'status'=>$status=I('status','','intval')
        );
        if(!$group) $this->error('未选择分组');
        //写入model
        $User=D('User');
        $addResult=$User->register($username,$byname,$password,$status);
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

    //修改管理员处理
    public function manager_editHandel(){
        if(!IS_POST) $this->error('非法操作');
        $data=array(
            'id'=>$uid=I('post.id'),
            'user_byname'=>$byname=I('post.byname'),
            'group'=>$group=I('post.group'),
            'status'=>$status=I('status','','intval')
        );
        if(!$group) $this->error('分组未选择');
        if($_POST['password']) $data['password']=sha1(I('post.password'));
        $User = D("User"); // 实例化User对象
        if (!$User->create($data)){
            $this->error($User->getError());
        }else{
            $groupMap['uid']=$uid;
            $groupData['group_id']=$group;
            if(M('AuthGroupAccess')->where($groupMap)->save($groupData) || $User->save($data) ){
                $this->success('修改成功',U('Setting/manager'));
            }else{
                $this->error('修改失败或数据未更改');
            }
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
            'status'=>$status=I('status','','intval')
        );
        P($_POST);
        P($data);
        die;
        //写入model
        $User=D('User');
        $addResult=$User->register($username,$byname,$password,$status);
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