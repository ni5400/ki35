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

class AuthGroupController extends CommonController {

    public function index()
    {
        $this->display();
    }

    //添加角色分组
    public function group_addHandle()
    {
       if(!IS_POST) $this->error('非法操作');
        $data=array(
            'title'=>I('title','','htmlspecialchars'),
            'status'=> I('status','0','intval'),
            'type'=>0
        );
        $Group=D('AuthGroup');
        $result=$Group->add_group($data);
        if($msg = $Group->getError()) {
            $this->error($msg); //抛出错误信息
        }
        if($result){
            $this->success('创建角色成功',U('Setting/role'));
        }else{
            $this->error('添加失败，请重试');
        }
    }

    //修改分组list
    public function group_editHandle()
    {
        if(!IS_POST) $this->error('非法操作');
        $map['id']=I('post.id');
        $map['status']=I('post.status');
        if($role_edit=D('AuthGroup')->updata($map)){
             $this->success('修改成功',U('Setting/role'));
        }else{
            $this->error('数据修改失败,请重试');
        }
    }
    //删除角色操作
    public function role_del()
    {
        if(!IS_AJAX) $this->error('非法操作');
        $role_id= I('post.id');
        $AuthGroup=M('AuthGroup')->where('id='.$role_id)->delete();
        echo $AuthGroup ? 'true':'false';
    }

    //检测角色是否重复
    public function checkRole()
    {
        if(!IS_AJAX) $this->error('非法操作');
        $data=array(
            'title'=>I('post.title')
        );
        $Role=D('AuthGroup');
        if($Role->create($data)){
            echo 'true';
        }else{
            echo 'false';
        }
    }

    //权限配置
    public function role_nodeHandle()
    {
        $data=array(
            'id'=>I('id','','intval'),
            'node'=>I('node','','intval')
        );
        $map['id']=$data['id'];
        $map['rules']='';
        //重新权限id
        foreach($data['node'] as $key=>$value){
            $map['rules'].=$value.',';
        }
        //对掉结尾的逗号
        $map['rules']=substr($map['rules'],0,-1);
//        echo $map['rules'];
        $Role=D('AuthGroup');
        if($Role->save($map)){
            $this->success('权限配置成功',U('Setting/role'));
        }else{
            $this->error('权限修改失败，请重试');
        }
    }



}