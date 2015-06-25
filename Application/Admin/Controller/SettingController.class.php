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
use MyLibrary\Page;

class SettingController extends CommonController {

    //显示设置页板首页
    public function index(){
        $this->display();
    }
    //显示角色列表
    public function role(){
        $User = D('AuthGroup');
        $count      = $User->count();// 查询满足要求的总记录数
        $Page       = new Page($count,8);  // 每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = $User->order('id')->limit($Page->firstRow.','.$Page->listRows)->select();
        //P($list); die;
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display();
    }
    //角色添加
    public function role_add(){
        $this->display();
    }

    //修改角色
    public function role_edit($role_id){

        $map['id']=I('role_id','','htmlspecialchars,intval');
        if($map['id']==1) $this->error('管理员禁止操作');
        $AuthGroup = D('AuthGroup');
        if($role=$AuthGroup->getRole($map)){
            $this->assign('role',$role);
        }else{
            $this->error('数据不存在,请重试');
        }
        $this->display();
    }

    //管理员列表
    public function manager(){

        $this->display();
    }
    //管理员添加
    public function manager_add(){
        $GroupList=$Group=D('AuthGroup')->getList($Field="id,title,status,type");
//        P($GroupList);
        $this->assign('group',$GroupList);
        $this->display();
    }

    //节点列表
    public function node(){
        $this->display();
    }

    //节点添加
    public function node_add(){
        $this->display();
    }
}